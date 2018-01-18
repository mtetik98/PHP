<?php
	if(isset($_SESSION['cartt'])){
        $count = count($_SESSION['cartt']);
    }
    if(!isset($count)){
    	App::addError('Uw winkelwagen is op dit moment leeg');
    }
    if(isset($count)){
    	if($count == 0){
    		App::addError('Uw winkelwagen is op dit moment leeg');
    	}
    }
?>
<style>
	body{
		background-color: #ddd;
	}
    .badge:after{
        content: '<?= $count; ?>';
    }
</style>
<table id="shopping_cart">
	<tr>
		<th>Product</th>
		<th>Aantal</th>
		<th>Prijs</th>
		<th></th>
		<th>Totaal</th>
	</tr>
<?php
	if(!isset($_SESSION['cartt'])){
		// echo 'Uw winkelwagen is leeg.';
	}else{
		$id = $_SESSION['cartt'];
		global $arr;

		$unique = array_unique($_SESSION['cartt']);
		$totaal = 0;

		foreach($unique as $unq){
			$pr = Product::findById($unq);
			$arr = count(array_keys($_SESSION['cartt'], $pr->getId()));
			
			$totaal += $arr*$pr->getPrijs();
			

			echo '<tr>';
			echo 	'<td>' . $pr->getNaam() . '</td>';
			echo 	'<td>' . $arr . '</td>';
			echo 	'<td>&euro; ' . $pr->getPrijs() . '</td>';
			echo 	'<td><a ' . App::link('delete&product_id=' . $pr->getId()) . '><i class="fa fa-remove"></i></a></td>';
			echo 	'<td>&euro; ' . number_format($arr*$pr->getPrijs(), 2) . '</td>';
			echo '</tr>';
		}
	}
?>
	<tr style="background-color: lightblue;">
		<td></td>
		<td></td>
		<td></td>
		<td><strong>Totaal:</strong></td>
		<td>&euro; <strong><?php if(!isset($totaal)){ echo $totaal = 0; }else{ echo number_format($totaal, 2); } ?></strong></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><a <?= App::link('purchase') ?>><button class="btn-order">Bestellen</button></a></td>
	</tr>
</table>