<?php
	$cid = $_GET['cID'];
	$pid = $_GET['pID'];
	$prodId = $_GET['product_id'];

	if(isset($cid)){
		Categorie::findById($cid)->remove();
		App::redirect('producten');
	}
	if(isset($pid)){
		Product::findById($pid)->remove();
		App::redirect('producten');
	}
	if(isset($prodId)){
		$key = array_search($prodId, $_SESSION['cartt']);
		unset($_SESSION['cartt'][$key]);
		print_r($_SESSION['cartt']);
		App::redirect('shopping_cart');
	}
?>