<?php

	class Client{
		
		private $usenrmae;
		private $gender;
		private $birthdate;
		private $work;
		private $about_you;
		private $location1;
		private $level;
		private $date_of_login;
		private $password;
		private $email;
		private $sell = [];
		private $nu;
		
		public function __construct($usenrmae,$gender, $birthdate, $work, $about_you,$location1, $level, $date_of_login, $password, $email,$nu){
			$this->usenrmae = $usenrmae;
			$this->gender = $gender;
			$this->birthdate = $birthdate;
			$this->work = $work;
			$this->about_you = $about_you;
			$this->location1 = $location1;
			$this->level = $level;
			$this->date_of_login = $date_of_login;
			$this->password = $password;
			$this->email = $email;
			$this->nu = $nu;
			
		}
		//setter
		
		public function addSell($item){
			$this->sell[] = $item;
		}
		
		public function getUsername(){
			return $this->usenrmae;
		}

		public function getGender(){
			return $this->gender;
		}

		public function getBirthDate(){
			return $this->birthdate;
		}

		public function getWork(){
			return $this->work;
		}

		public function getLocation1(){
			return $this->location1;
		}

		public function getAboutYou(){
			return $this->about_you;
		}

		public function getLevel(){
			return $this->level;
		}

		public function getDateOfLogin(){
			return $this->date_of_login;
		}

		public function getPassword(){
			return $this->password;
		}

		public function getEmail(){
			return $this->email;
		}
		public function getnu(){
			return $this->nu;
		}


		
	}

?>