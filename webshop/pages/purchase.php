<?php
	if(isset($_SESSION['cartt'])){
		global $arr;
		$unique = array_unique($_SESSION['cartt']);
		$totaal = 0;
		$user = $_SESSION['userid'];
		$order = Bestelling::register('1', $user);

		foreach($unique as $unq){
			$pr = Product::findById($unq);
			$arr = count(array_keys($_SESSION['cartt'], $pr->getId()));
			
			$totaal += $arr*$pr->getPrijs();
			$order_nr = $order->getId();

			// echo $pr->getNaam() . ' ';
			// echo $arr . ' ';
			// echo $pr->getPrijs() . ' ';
			// echo number_format($arr*$pr->getPrijs(), 2) . '<br>';
			Bestelling_has_product::register($order_nr, $pr->getId(), $arr);
		}
		unset($_SESSION['cartt']);
		App::redirect('home&purchase=success');
		
	}else{
		App::redirect('home');
	}
?>