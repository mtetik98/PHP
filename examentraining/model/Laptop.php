<?php
	class Laptop extends Model{

		protected $kloksnelheid;
		protected $merk;
		protected $cores;
		protected $geheugen;
		protected $schermgrootte;
		protected $opslag;
		protected $ssd;
		protected $user;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public function getUser(){
			return $this->belongsTo("User");
		}

		public static function createForm(){
			$form = new Form();
			$form->addField(new FormField("merk", "text", "merk"));			
			$form->addField(new FormField("cores", "text", "cores"));
			$form->addField(new FormField("kloksnelheid", "text", "kloksnelheid(Ghz)"));
			$form->addField(new FormField("geheugen", "text", "geheugen(GB)"));
			$form->addField(new FormField("schermgrootte", "text", "scherm(inch)"));
			$form->addField(new FormField("opslag", "text", "opslag(GB)"));
			$form->addField(new FormField("ssd", "checkbox", "ssd"));

			return $form;
		}

		public function getMerk(){
			return $this->merk;
		}

		public function getCores(){
			return $this->cores;
		}

		public function getKloksnelheid(){
			return $this->kloksnelheid;
		}

		public function getGeheugen(){
			return $this->geheugen;
		}

		public function getSchermgrootte(){
			return $this->schermgrootte;
		}

		public function getOpslag(){
			return $this->opslag;
		}

		public function getSSD(){
			return $this->ssd;
		}

	}
?>