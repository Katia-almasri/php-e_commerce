<?php
	require_once 'DBManager.php';
	class Product{
		
		private $date_of_expose;
		private $date_of_modify;
		private $num_likes;
		private $pro_name;
		private $amount;
		private $cur_amount;
		private $cost;
	    private $discount_percent;
	    private $rate;
	   	private $item;
		private $production_date;
		private $profit_id;
		private $num_sell;
		private $col;
		private $size;
		
		function __construct( $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size){
			//by default: today`s date
			
			$this->date_of_expose = $date_of_expose;
			$this->amount = $amount;
			$this->cost = $cost;
			$this->production_date = $production_date;
			$this->discount_percent = $discount_percent;
			$this->date_of_modify = $date_of_modify;
			$this->rate = $rate;
			$this->num_likes = $num_likes;
			$this->pro_name = $pro_name;
			$this->profit_id = $profit_id;
			$this->cur_amount = $cur_amount;
			$this->num_sell = $num_sell;
			$this->col = $col;
			$this->size = $size;
		}
		
		public function getDataOfExpose(){
			return $this->date_of_expose;
		}

		public function getDataOfModify(){
			return $this->date_of_modify;
		}

		public function getNumLikes(){
			return $this->num_like;
		}

		public function getName(){
			return $this->name;
		}

		public function getAmount(){
			return $this->amount;
		}

		public function getcurAmount(){
			return $this->cur_amount;
		}

		public function getCost(){
			return $this->cost;
		}

		public function getdiscountPercent(){
			return $this->discount_percent;
		}

		public function getRate(){
			return $this->rate;
		}

		public function getItem(){
			return $this->item;
		}

		public function getProductionDate(){
			return $this->production_date;
		}

		public function getProfitId(){
			return $this->profit_id;
		}

			public function getnumSell(){
			return $this->num_sell;
		}
		}
	
	
?>