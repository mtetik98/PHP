<?php
	class Product extends Model{

		protected $id;
		protected $naam;
		protected $omschrijving;
		protected $prijs;
		protected $categorie;

		protected static function newModel($obj){
			return true;
		}

		function __construct(){
			
		}

		public static function register($naam, $omschrijving, $prijs, $categorie) {
	        $product = new Product();
	        $product->naam = $naam;
	        $product->omschrijving = $omschrijving;
	        $product->prijs = $prijs;
	        $product->categorie = $categorie;
	        $product->save();
	    }

		public function getId(){
			return $this->id;
		}

		public function getNaam(){
			return $this->naam;
		}

		public function getOmschrijving(){
			return $this->omschrijving;
		}

		public function getPrijs(){
			return $this->prijs;
		}

		public function getCategorie(){
			return $this->belongsTo("Categorie");
		}

		public function setNaam($naam){
	        $this->naam = $naam;
	    }

	    public function setOmschrijving($omschrijving){
	        $this->omschrijving = $omschrijving;
	    }

	    public function setPrijs($prijs){
	        $this->prijs = $prijs;
	    }

	    public function setCategorie($categorie){
	        $this->categorie = $categorie;
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