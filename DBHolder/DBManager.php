<?php
	class DBManager{
		private $servername;
		private $username;
		private $password;
		private $dbName;
		
		private $conn;


		function __construct($servername='localhost', $username='root', $password = '123456', $dbName = 'e_commerce_db'){
			$this->servername = $servername;
			$this->username = $username;
			$this->password = $password;
			$this->dbName = $dbName;
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
			
		}
		
		function __destruct(){
			
			
		}
		
		function getUsername(){
			return $this->username;
			
		}
		
		function getServername(){
			return $this->servername;
			
		}
		
		function getPassword(){
			return $this->password;
			
		}
		
		function getDbname(){
			return $this->dbName;
			
		}
		
		
		public function checkConnection($tableName){
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
			if($this->conn->connect_error){
				die('There were some problems!');
				return false;
			}else{
				$sql = '';
				switch($tableName){
					case 'product':
						$sql = "CREATE ".$tableName." (pro_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(20) NOT NULL
						 , item_id INT(2) NOT NULL 
						)";
						//empty table
						break;
					case 'client': //inserting image 
						$sql = "CREATE".$tableName. "(client_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(20)NOT NULL, password VARCHAR(20) NOT NULL, location VARCHAR(60) NOT NULL, email VARCHAR(50) NOT NULL, date_of_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE 
							,
							level INT(1) NOT NULL, gender INT(1), birthdate DATE, work VARCHAR(20), about_you TEXT, image VARCHAR(50) NOT NULL, nu VARCHAR(20) 
						)";
						break;
					case 'Order': //then
						$sql = "CREATE".$tableName."(id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, productID INT(7) UNSIGNED NOT NULL, 
							amount INT(5) UNS7 NOT NULL, customerID INT(7) UNSIGNED NOT NULL, orderedAt TIMESTAMP DEFAULT TIMESTAMP CURRENT_TIMESTAMP ON UPDATE 
							CURRENT_TIMESTAMP 
						)";
						break;
					case 'company': //new 
						$sql = "CREATE".$tableName."(com_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(20) NOT NULL, 
						branch VARCHAR(20),
						location VARCHAR(60) NOT NULL, date_launch DATE , lisence_number INT(7) , date_of_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE, owner VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, about_us TEXT NOT NULL, password VARCHAR(20) NOT NULL,num_follower INT(6), level INT(1) NOT NULL, image VARCHAR(50) NOT NULL
							
						)";
						break;
						//float
					case 'procomp':
						$sql = "CREATE".$tableName."(procomp_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, com_id INT(8) NOT NULL, pro_id INT(8) NOT NULL, date_of_expose TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE 
							CURRENT_TIMESTAMP, amount INT(3) NOT NULL, cost INT(8) NOT NULL, production_date DATE, discount_percent INT(2), date_of_modify TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE, rate DECIMAL(2,2), num_likes INT(6),pro_name VARCHAR(50) NOT NULL, profit_id INT(2) NOT NULL, cur_amount INT(3) NOT NULL, num_sell INT(3) NOT NULL, col INT(20), size VARCHAR(3)
							
						)";
						break;

					case 'proclient':
						$sql = "CREATE".$tableName."(proclient INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, client_id INT(8) NOT NULL, pro_id INT(8) NOT NULL, date_of_expose TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE 
							CURRENT_TIMESTAMP, amount INT(3) NOT NULL, cost INT(8) NOT NULL, production_date DATE, discount_percent INT(2), date_of_modify TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE, rate DECIMAL(2,2), num_likes INT(6),pro_name VARCHAR(50) NOT NULL, profit_id INT(2) NOT NULL, cur_amount INT(3) NOT NULL, num_sell INT(3) NOT NULL, col INT(20), size VARCHAR(3)
							
						)";
						break;
					
				}
				$result = $this->conn->query($sql);
				if($result === false){
					
					return true;
				}
				return false;
			}
			
		}
		
		public function getConn($Query){
			if($this->conn->connect_error === true){
				
				return NULL;
				
			}
			return true;
			
		}
		
		
		public function selectQuery($Query){
			if($this->checkConnection('company')===true){
				
			$result = $this->conn->query($Query);
			if($result!==false && $result->num_rows>0)
			{
				$data = array();
				while($row = $result->fetch_assoc() )
					$data[] = $row;

				return($data);
				
			}
		}
			return NULL;
	}
		
		public function updateQuery($Query){
			$result = $this->conn->query($Query);
			if($result!==0)
				return true;
			return false;
			
		}
		
		public function insertQuery($Query){
			
			$result = $this->conn->query($Query);
			if($result!==false){
			
				return true;
			}
			return false;
		}
		
		public function deleteQuery($Query){
			
			$result = $this->conn->query($Query);
			if($result!==false)
				return true;
			return false;
			
		}
		
		

	}

	
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '123456';
    $DATABASE_NAME = 'e_commerce_db';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
?>