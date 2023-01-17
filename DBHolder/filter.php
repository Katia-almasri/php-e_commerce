<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	if(isset($_POST['f']))
		{
			$filterAs = $_POST['f'];
			$Product = new ProductManager();
			$data = '';
			switch($filterAs){
				case'cost':
				$data = $Product->selectQuery("SELECT * FROM `procomp` UNION
					SELECT * FROM `proclient` ORDER BY cost DESC

					");
				break;

				case'date_of_expose':
				$data = $Product->selectQuery("SELECT * FROM `procomp` UNION SELECT *
					 FROM `proclient` ORDER BY date_of_expose DESC");
				break;

				case'num_likes':
				$data = $Product->selectQuery("SELECT * FROM `procomp` UNION SELECT *
					 FROM `proclient` ORDER BY num_likes DESC");
				break;

				case'num_sell':
				$data = $Product->selectQuery("SELECT * FROM `procomp` UNION SELECT *
					 FROM `proclient` ORDER BY num_sell DESC");
				break;

				case'category':
				$data = $Product->selectQuery("SELECT item_cat.item_name,item_cat.cat_id, category.cat_id, category.name, procomp.pro_name, procomp.amount, procomp.cost, product.item_id  FROM procomp, product, item_cat, category WHERE procomp.pro_id = product.pro_id AND product.item_id = item_cat.item_id AND item_cat.cat_id = category.cat_id ORDER BY category.name DESC" );
				break;
			}
			
			if($data!==NULL)
				print_r($data);
				
			
		}






?>