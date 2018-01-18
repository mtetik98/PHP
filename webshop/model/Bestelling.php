<?php
	class Bestelling extends Model{

		protected $id;
		protected $betaald;
		protected $user;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($betaald, $user) {
	        $bestelling = new Bestelling();
	        $bestelling->betaald = $betaald;
	        $bestelling->user = $user;
	        $bestelling->save();
	        return $bestelling;
	    }

		public function getId(){
			return $this->id;
		}

		public function getBetaald(){
			return $this->betaald;
		}

		public function getUser(){
			return $this->belongsTo("User");
		}

		public function setBetaald($betaald){
	        $this->betaald = $betaald;
	    }

	    public function setUser($user){
	        $this->user = $user;
	    }

	    // public static function change($id, $naam, $datumVan, $datumTot, $maxAantal, $begeleider){
	    //     $kamp = Kamp::findById($id);
	    //     $kamp->setNaam($naam);
	    //     $kamp->setDatumVan($datumVan);
	    //     $kamp->setDatumTot($datumTot);
	    //     $kamp->setMaxAantal($maxAantal);
	        
	    //     $kamp->save();
	    //     App::redirect("kampen");
	    // }

	    // public function getChangeForm() {
	    //     $form = new Form();
	    //     $naamField = new FormField("naam", "text", "naam", Kamp::getNaam());
	    //     $naamField->required();

	    //     $datumVan = new Formfield("datumVan", "date", "datumVan", Kamp::getDatumVan());
	    //   	$datumVan->required();

	    //   	$datumTot = new Formfield("datumTot", "date", "datumTot", Kamp::getDatumTot());
	    //   	$datumTot->required();

	    //   	$maxAantal = new Formfield("maxAantal", "number", "maxAantal", Kamp::getMaxAantal());
	    //   	$maxAantal->required();

	    //   	$begeleider = new Formfield("begeleider", "text", "begeleider", Kamp::getBegeleider()->getUsername());

	    //   	$eigenaar = new Formfield("eigenaar", "text", "eigenaar", Kamp::getEigenaar()->getNaam());

	    //     $form->addField($naamField);
	    //     $form->addField($datumVan);
	    //     $form->addField($datumTot);
	    //     $form->addField($maxAantal);
	    //     $form->addField($begeleider);
	    //     $form->addField($eigenaar);

	    //     return $form;
	    // }

	}
?>