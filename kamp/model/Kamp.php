<?php
	class Kamp extends Model{

		protected $id;
		protected $naam;
		protected $datumVan;
		protected $datumTot;
		protected $maxAantal;
		//protected $user;
		//protected $eigenaar;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($naam, $datumVan, $datumTot, $maxAantal, $user, $eigenaar) {
	        $kamp = new Kamp($naam);
	        $kamp->datumVan = $datumVan;
	        $kamp->datumTot = $datumTot;
	        $kamp->maxAantal = $maxAantal;
	        $kamp->user = $user;
	        $kamp->eigenaar = $eigenaar;
	        $kamp->save();
	    }

		public function getId(){
			return $this->id;
		}

		public function getNaam(){
			return $this->naam;
		}

		public function getDatumVan(){
			return $this->datumVan;
		}

		public function getDatumTot(){
			return $this->datumTot;
		}

		public function getMaxAantal(){
			return $this->maxAantal;
		}

		public function getBegeleider(){
			return $this->belongsTo("User");
		}

		public function getEigenaar(){
			return $this->belongsTo("Eigenaar");
			//return $this->eigenaar;
		}

		public function setNaam($naam){
	        $this->naam = $naam;
	    }

	    public function setDatumVan($datumVan){
	        $this->datumVan = $datumVan;
	    }

	    public function setDatumTot($datumTot){
	        $this->datumTot = $datumTot;
	    }

	    public function setMaxAantal($maxAantal){
	        $this->maxAantal = $maxAantal;
	    }

	    public static function change($id, $naam, $datumVan, $datumTot, $maxAantal, $begeleider){
	        $kamp = Kamp::findById($id);
	        $kamp->setNaam($naam);
	        $kamp->setDatumVan($datumVan);
	        $kamp->setDatumTot($datumTot);
	        $kamp->setMaxAantal($maxAantal);
	        
	        $kamp->save();
	        App::redirect("kampen");
	    }

	    public function getChangeForm() {
	        $form = new Form();
	        $naamField = new FormField("naam", "text", "naam", Kamp::getNaam());
	        $naamField->required();

	        $datumVan = new Formfield("datumVan", "date", "datumVan", Kamp::getDatumVan());
	      	$datumVan->required();

	      	$datumTot = new Formfield("datumTot", "date", "datumTot", Kamp::getDatumTot());
	      	$datumTot->required();

	      	$maxAantal = new Formfield("maxAantal", "number", "maxAantal", Kamp::getMaxAantal());
	      	$maxAantal->required();

	      	$begeleider = new Formfield("begeleider", "text", "begeleider", Kamp::getBegeleider()->getUsername());

	      	$eigenaar = new Formfield("eigenaar", "text", "eigenaar", Kamp::getEigenaar()->getNaam());

	        $form->addField($naamField);
	        $form->addField($datumVan);
	        $form->addField($datumTot);
	        $form->addField($maxAantal);
	        $form->addField($begeleider);
	        $form->addField($eigenaar);

	        return $form;
	    }

	}
?>