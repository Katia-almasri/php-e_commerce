<?php
	require_once 'AdminManager.php';


		function marktechLikes(){
			$admin = new AdminManager();
			$numLikes = $admin->selectQuery("SELECT likes FROM marktech");
			return $numLikes;
		}

		function getNumberCustomers($every){
			$admin = new AdminManager();
			if($every ==='year')
				$num_cust = $admin->selectQuery("SELECT COUNT(client_id) FROM client GROUP BY YEAR(date_of_login) ORDER BY date_of_login DESC");
			elseif ($every==='month') 
				$num_cust = $admin->selectQuery("SELECT COUNT(client_id) FROM client GROUP BY MONTH(date_of_login) ORDER BY date_of_login DESC ");

			else
				$num_cust = $admin->selectQuery("SELECT COUNT(client_id) FROM client GROUP BY DAY(date_of_login) ORDER BY date_of_login DESC ");

			return $num_cust;
		}

		function getNumberCompanies($type){
			$admin = new AdminManager();
			if($every ==='year')
				$num_cust = $admin->selectQuery("SELECT COUNT(com_id) FROM company GROUP BY YEAR(date_of_login) ORDER BY date_of_login DESC ");
			elseif ($every==='month') 
				$num_cust = $admin->selectQuery("SELECT COUNT(com_id) FROM company GROUP BY MONTH(date_of_login) ORDER BY date_of_login DESC");

			else
				$num_cust = $admin->selectQuery("SELECT COUNT(com_id) FROM company GROUP BY DAY(date_of_login) ORDER BY date_of_login DESC ");

			return $num_cust;
		}


		function getNumberOfClientOrders($type){
			$admin = new AdminManager();
			$numClientORders = '';
			if($type==='year')
			$numClientORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order, date_order FROM order_client GROUP BY YEAR(date_order) ORDER BY date_order DESC");
			else if ($type ==='month')
				$numClientORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order, date_order FROM order_client GROUP BY MONTH(date_order) ORDER BY date_order DESC");
			else
				$numClientORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order , date_order FROM order_client GROUP BY YEAR(date_order) ORDER BY date_order DESC");
			return $numClientORders;
		}

		function getNumberOfCompanyOrders($type){
			$admin = new AdminManager();
			$numCompanyORders = '';
			if($type==='year')
			$numCompanyORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order , date_order FROM order_comp GROUP BY YEAR(date_order) ORDER BY date_order DESC");
			else if ($type ==='month')
				$numCompanyORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order, date_order FROM order_comp GROUP BY MONTH(date_order) ORDER BY date_order DESC");
			else
				$numCompanyORders = $admin->selectQuery("SELECT SUM(order_id) AS num_order, date_order FROM order_comp GROUP BY YEAR(date_order) ORDER BY date_order DESC");
			return $numCompanyORders;
		}

		function getMostRatedProduct($type){
				/////
		}

		function getMostSold($type){   //which company
			$admin = new AdminManager();
			$most_sold = '';
			if($type==='year')
				$most_sold = $admin->selectQuery("SELECT t.* FROM (SELECT num_sell AS num_sell,pro_name AS pro_name,  date_of_expose AS d_x FROM procomp UNION SELECT num_sell AS num_sell, pro_name AS pro_name , date_of_expose AS d_x FROM proclient) t GROUP BY YEAR(t.d_x) ORDER BY t.num_sell DESC");
			else if($type==='month')
				$most_sold = $admin->selectQuery("SELECT t.* FROM (SELECT num_sell AS num_sell,pro_name AS pro_name,  date_of_expose AS d_x FROM procomp UNION SELECT num_sell AS num_sell, pro_name AS pro_name , date_of_expose AS d_x FROM proclient) t GROUP BY MONTH(t.d_x) ORDER BY t.num_sell DESC");
			else
				$most_sold = $admin->selectQuery("SELECT t.* FROM (SELECT num_sell AS num_sell,pro_name AS pro_name,  date_of_expose AS d_x FROM procomp UNION SELECT num_sell AS num_sell, pro_name AS pro_name , date_of_expose AS d_x FROM proclient) t GROUP BY DAY(t.d_x) ORDER BY t.num_sell DESC");
			return $most_sold;
		}

		function getMostCompanySellsProduct($type){
			$admin = new AdminManager();
			$mostCompany = '';

			if($type==='year')
				$mostCompany = $admin->selectQuery("SELECT company.name, SUM(procomp.num_sell) AS sum_num, procomp.date_of_expose FROM company INNER JOIN procomp ON company.com_id = procomp.com_id GROUP BY company.name ORDER BY YEAR(procomp.date_of_expose)");
			else if($type==='month')

				$mostCompany = $admin->selectQuery("SELECT company.name, SUM(procomp.num_sell) AS sum_num, procomp.date_of_expose FROM company INNER JOIN procomp ON company.com_id = procomp.com_id GROUP BY company.name ORDER BY MONTH(procomp.date_of_expose)");
			else
				$mostCompany = $admin->selectQuery("SELECT company.name, SUM(procomp.num_sell) AS sum_num, procomp.date_of_expose FROM company INNER JOIN procomp ON company.com_id = procomp.com_id GROUP BY company.name ORDER BY DAY(procomp.date_of_expose)");
			return $mostCompany;
		}

		function getMostClientBuying($type){
			$admin = new AdminManager();
			$mostClient = '';

			if($type==='year')
				$mostClient = $admin->selectQuery("SELECT client.username, SUM(order_client.order_id) AS number_orders FROM client INNER JOIN order_client ON order_client.client_id = client.client_id GROUP BY client.username ORDER BY YEAR(number_orders) DESC");
			else if($type==='month')

				$mostClient = $admin->selectQuery("SELECT client.username, SUM(order_client.order_id) AS number_orders FROM client INNER JOIN order_client ON order_client.client_id = client.client_id GROUP BY client.username ORDER BY MONTH(number_orders) DESC");
			else
				$mostClient = $admin->selectQuery("SELECT client.username, SUM(order_client.order_id) AS number_orders FROM client INNER JOIN order_client ON order_client.client_id = client.client_id GROUP BY client.username ORDER BY DAY(number_orders) DESC");
			return $mostClient;
		}

		
		
		function adminIncomeFromShipperClient($type){
			$admin = new AdminManager();
			$tot_cost = '';
			if($type==='year')
				$tot_cost = $admin->selectQuery("SELECT SUM(order_shipping_cost) AS order_sum , date_order FROM order_comp GROUP BY YEAR(date_order)");
			else if($type ==='month')
				$tot_cost = $admin->selectQuery("SELECT SUM(order_shipping_cost) AS order_sum , date_order FROM order_comp GROUP BY MONTH(date_order)");
			else
				$tot_cost = $admin->selectQuery("SELECT SUM(order_shipping_cost) AS order_sum , date_order FROM order_comp GROUP BY DAY(date_order)");
			return $tot_cost;

		}

		function adminIncomeFromShipperCompany($type){
			$admin = new AdminManager();
			$admin_profit_from_shipping = '';
			if($type==='year')
				$admin_profit_from_shipping = $admin->selectQuery("SELECT  SUM(admin_profit_from_shipping), date_order FROM order_comp GROUP BY YEAR(date_order)");
			else if($type==='month')
				$admin_profit_from_shipping = $admin->selectQuery("SELECT  SUM(dmin_profit_from_shipping), date_order FROM order_comp GROUP BY MONTH(date_order)");
			else
				$admin_profit_from_shipping = $admin->selectQuery("SELECT  SUM(dmin_profit_from_shipping), date_order FROM order_comp GROUP BY DAY(date_order)");
			return $admin_profit_from_shipping;

		}

		function getNumberRejectedAddition($type){
			$numRejected = '';
			$admin = new AdminManager();
			if($type ==='year')
				$numRejected = $admin->selectQuery("SELECT COUNT(is_accepted) AS rejected, date_of_not FROM notification WHERE is_accepted = 0 AND is_procecced = 1 GROUP BY YEAR(date_of_not)");

			else if($type ==='month')
				$numRejected = $admin->selectQuery("SELECT SUM(is_accepted)  AS rejected, date_of_not WHERE is_accepted = 0 AND is_procecced = 1 GROUP BY MONTH(date_of_not)");
			else
				$numRejected = $admin->selectQuery("SELECT SUM(is_accepted)  AS rejected, date_of_not WHERE is_accepted = 0 AND is_procecced = 1 GROUP BY DAY(date_of_not)");
			return $numRejected;

		}

		function getNumberAcceptedAddition($type){
			$numRejected = '';
			$admin = new AdminManager();
			if($type ==='year')
				$numRejected = $admin->selectQuery("SELECT SUM(is_accepted)  AS rejected, date_of_not WHERE is_accepted = 1 AND is_procecced = 1 GROUP BY YEAR(date_of_not)");

			else if($type ==='month')
				$numRejected = $admin->selectQuery("SELECT SUM(is_accepted)  AS rejected, date_of_not WHERE is_accepted = 1 AND is_procecced = 1 GROUP BY MONTH(date_of_not)");
			else
				$numRejected = $admin->selectQuery("SELECT SUM(is_accepted)  AS rejected, date_of_not WHERE is_accepted = 1 AND is_procecced = 1 GROUP BY DAY(date_of_not)");
			return $numRejected;

		}

		function adminProfitFromAnnouncment($type){
			$admin = new AdminManager();
			$tot_cost = '';
			if($type==='year')
				$tot_cost = $admin->selectQuery("SELECT SUM(time_an.cost) AS tot, announcement.start_of_ann FROM announcement INNER JOIN time_an ON time_an.time_an_id = announcement.time_an_id GROUP BY YEAR(announcement.start_of_ann)");
			else if($type==='month')
				$tot_cost = $admin->selectQuery("SELECT SUM(time_an.cost) AS tot, announcement.start_of_ann FROM announcement INNER JOIN time_an ON time_an.time_an_id = announcement.time_an_id GROUP BY MONTH(announcement.start_of_ann)");
			else
				$tot_cost = $admin->selectQuery("SELECT SUM(time_an.cost) AS tot, announcement.start_of_ann FROM announcement INNER JOIN time_an ON time_an.time_an_id = announcement.time_an_id GROUP BY DAY(announcement.start_of_ann)");
			return $tot_cost;


		}
		function adminProfitFromOrdersCompany($type){
			$admin = new AdminManager();
			$tot_cost = '';
			if($type ==='year')
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_comp GROUP BY YEAR(date_order)");
			else if($type==='month')
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_comp GROUP BY MONTH(date_order)");
			else
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_comp GROUP BY DAY(date_order)");
			return $tot_cost;
		}

		function adminProfitFromOrdersClient($type){
			$admin = new AdminManager();
			$tot_cost = '';
			if($type ==='year')
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_client GROUP BY YEAR(date_order)");
			else if($type==='month')
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_client GROUP BY MONTH(date_order)");
			else
				$tot_cost = $admin->selectQuery("SELECT SUM(tot_admin_profit) AS tot_admin_profit, date_order FROM order_client GROUP BY DAY(date_order)");
			return $tot_cost;
		}



		function getSales(){
			$admin = new AdminManager();
			//tot cost all to web
			$tot_cost = $admin->selectQuery("SELECT sum_client.cost_with_shipment+sum_company.cost_with_shipment AS cost_with_shipment FROM (SELECT cost_with_shipment FROM order_client) sum_client,  (SELECT cost_with_shipment FROM order_comp) sum_company");
			if($tot_cost!==NULL)
				return $tot_cost;
		}

		function getProductsMostSells(){
			$admin = new AdminManager();
			$getMostSells = $admin->selectQuery("SELECT num_sell, pro_name FROM procomp UNION SELECT pro_name , num_sell  FROM proclient ORDER BY num_sell");
			if($getMostSells!==NULL)
				return $getMostSells;
		}

		function getProductsMostLikes(){

			///? most liked or rated?
			$admin = new AdminManager();
			$getMostLikes = $admin->selectQuery("SELECT * FROM (SELECT pro_name, num_likes AS 'num_likes' FROM procomp ORDER BY num_likes), (SELECT pro_name, num_likes AS 'num_likes' FROM proclient ORDER BY num_likes) ORDER BY num_likes");
			if($getMostLikes!==NULL)
				return $getMostLikes;
		}

		$arr1 = getProductsMostSells('year');
		//$arr2 = getNumberOfClientOrders('day');
		//print_r($arr2);
		print_r($arr1);
		


?>

