<?php
	class Aanmelding extends Model{

		protected $voornaam;
		protected $achternaam;
		protected $leeftijd;
		protected $kamp;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($voornaam, $achternaam, $leeftijd, $kampId) {
	        $aanmelding = new Aanmelding();
	        $aanmelding->voornaam = $voornaam;
	        $aanmelding->achternaam = $achternaam;
	        $aanmelding->leeftijd = $leeftijd;
	        $aanmelding->kamp = $kampId;
	        $aanmelding->save();
	    }

		public function getId(){
			return $this->id;
		}

		public function getVoornaam(){
			return $this->voornaam;
		}

		public function getAchternaam(){
			return $this->achternaam;
		}

		public function getLeeftijd(){
			return $this->leeftijd;
		}

		public function getKampId(){
			return $this->kamp;
		}

		public function setVoornaam($voornaam){
	        $this->voornaam = $voornaam;
	    }

	    public function setAchternaam($achternaam){
	        $this->achternaam = $achternaam;
	    }

	    public function setLeeftijd($leeftijd){
	        $this->leeftijd = $leeftijd;
	    }

	    public function setKampId($id){
	    	$this->kamp = $id;
	    }
	}
?>