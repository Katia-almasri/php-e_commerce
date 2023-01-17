<?php

	class Company{
		
		private $name;
		private $branch;
		private $location;
		private $date_launch;
		private $lisence_number;
		private $date_of_login;
		private $owner;
		private $psd;
		private $sell = [];
		private $email;
		private $aboutUs;
		private $level;
		private $num_follower;
		private $imgURL;
		
		public function __construct($name, $branch, $location, $date_launch, $lisence_number, $date_of_login, $owner, $email, $aboutUs, $psd, $level, $num_follower,$imgURL){
			$this->owner = $owner;
			$this->name = $name;
			$this->location = $location;
			$this->lisence_number = $lisence_number;
			$this->date_of_login = $date_of_login;
			$this->psd = $psd;
			$this->date_launch = $date_launch;
			$this->email = $email;
			$this->aboutUs = $aboutUs;
			$this->branch = $branch;
			$this->level = $level;
			$this->num_follower = $num_follower;
			$this->imgURL = $imgURL;
			
		}
		//setter
		public function setName($name){
			$this->name = $name;
		}
		
		public function addSell($item){
			$this->sell[] = $item;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		public function setAbouteUs($aboutUs){
			$this->aboutUs = $aboutUs;
		}
		//getter
		public function getName(){
			return $this->name;
		}

		public function getLocation(){
			return $this->location;
		}
		
		public function getLisenceNumber(){
			return $this->lisence_number;
		}

		public function getDateLogin(){
			return $this->date_of_login;
		}

		public function getPSD(){
			return $this->psd;
		}

		public function getDateLaunch(){
			return $this->date_launch;
		}

		public function getEmail(){
			return $this->email;
		}

		public function getAboutUs(){
			return $this->aboutUs;
		}

		public function getBranch(){
			return $this->branch;
		}

		public function getLevel(){
			return $this->level;
		}

		public function getNumFollower(){
			return $this->num_follower;
		}

		public function getOwner(){
			return $this->owner;
		}
	}

?>