<?php
	if(isset($_GET['add_product_id'])){
		$id = $_GET['add_product_id'];
		$product = Product::findById($id);

		$pId = $product->getId();
		$pNaam = $product->getNaam();
		$pPrijs = $product->getPrijs();

		if(empty($_SESSION['cartt'])){
			$_SESSION['cartt'] = array();
		}
		array_push($_SESSION['cartt'], $pId);

		App::redirect('home');
	}
?>