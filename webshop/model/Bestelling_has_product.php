<?php
	class Bestelling_has_product extends Model{

		protected $bestelling;
		protected $product;
		protected $aantal;
		protected $datum;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($bestelling, $product, $aantal) {
	        $bestelling_has_product = new Bestelling_has_product();
	        $bestelling_has_product->bestelling = $bestelling;
	        $bestelling_has_product->product = $product;
	        $bestelling_has_product->aantal = $aantal;
	        $bestelling_has_product->datum = date("Y-m-d");
	        $bestelling_has_product->save();
	    }

		public function getBestellingId(){
			return $this->belongsTo("Bestelling");
		}

		public function getProductId(){
			return $this->belongsTo("Product");
		}

		public function getAantal(){
			return $this->aantal;
		}

		public function getDatum(){
			return $this->datum;
		}

		public function setBestellingId($bestelling){
	        $this->bestelling = $bestelling;
	    }

	    public function setProductId($product){
	        $this->product = $product;
	    }

	    public function setAantal($aantal){
	    	$this->aantal = $aantal;
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