<table>
	<tr>
		<th>Product</th>
		<th>Aantal</th>
		<th>Prijs</th>
		<th>Totaal</th>
	</tr>
	<?php
		global $price;
		$price = 0;
		if(isset($_GET['factuur'])){
			$factuur = Bestelling_has_product::findBy('bestelling', $_GET['factuur']);
			foreach($factuur as $fac): ?>
				<?php
					$prijs = $fac->getAantal() * $fac->getProductId()->getPrijs();
					$price += $prijs;
				?>
				<tr>
					<td><?= $fac->getProductId()->getNaam(); ?></td>
					<td><?= $fac->getAantal(); ?></td>
					<td>&euro; <?= $fac->getProductId()->getPrijs(); ?></td>
					<td>&euro; <?= number_format($prijs, 2); ?></td>
				</tr>
			<?php endforeach;
		}
	?>
		<tr style="border-top: double 3px black;">
			<td></td>
			<td></td>
			<td><strong>Totaal:</strong></td>
			<td><strong>&euro; <?= number_format($price, 2); ?></strong></td>
		</tr>
</table>