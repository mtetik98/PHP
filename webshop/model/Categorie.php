<?php
	class Categorie extends Model{

		protected $id;
		protected $naam;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($naam) {
	        $categorie = new Categorie();
	        $categorie->naam = $naam;
	        $categorie->save();
	    }

		public function getId(){
			return $this->id;
		}

		public function getNaam(){
			return $this->naam;
		}

		public function setNaam($naam){
	        $this->naam = $naam;
	    }
	}
?>