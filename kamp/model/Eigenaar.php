<?php
	class Eigenaar extends Model{

		protected $id;
		protected $naam;
		protected $email;
		protected $telefoon;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($naam, $email, $telefoon) {
	        $eigenaar = new Eigenaar($naam);
	        $eigenaar->email = $email;
	        $eigenaar->telefoon = $telefoon;
	        $eigenaar->save();
	    }

		public static function createForm(){
			$form = new Form();
			$form->addField(new FormField("titel", "text", "titel"));			
			$form->addField(new FormField("auteur", "text", "auteur"));

			return $form;
		}

		public function getId(){
			return $this->id;
		}

		public function getNaam(){
			return $this->naam;
		}

		public function getEmail(){
			return $this->email;
		}

		public function getTelefoon(){
			return $this->telefoon;
		}

		public function setNaam($naam){
	        $this->naam = $naam;
	    }

	    public function setEmail($email){
	        $this->email = $email;
	    }

	    public function setTelefoon($telefoon){
	        $this->telefoon = $telefoon;
	    }

	    public static function change($id, $naam, $email, $telefoon){
	        $eigenaar = Eigenaar::findById($id);
	        $eigenaar->setNaam($naam);
	        $eigenaar->setEmail($email);
	        $eigenaar->setTelefoon($telefoon);
	        
	        $eigenaar->save();
	        App::redirect("eigenaren");
	    }

	    public function getChangeForm() {
	        $form = new Form();
	        $naam = new FormField("naam", "text", "naam", $this->getNaam());
	        $naam->required();

	        $email = new Formfield("email", "email", "email", Eigenaar::getEmail());
	      	$email->required();

	      	$telefoon = new Formfield("telefoon", "text", "telefoon", Eigenaar::getTelefoon());
	      	$telefoon->required();

	        $form->addField($naam);
	        $form->addField($email);
	        $form->addField($telefoon);

	        return $form;
	    }

	}
?>