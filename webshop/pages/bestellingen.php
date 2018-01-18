<!-- <table>
	<tr>
		<th>#Bestelling</th>
		<th>Betaald</th>
		<th>Product</th>
		<th>Aantal</th>
	</tr>
<?php
	$user = $_SESSION['userid'];
	$orders = Bestelling::findBy('user', $user);
	global $date;

	foreach($orders as $order):
		$id = $order->getId();
		$orderHasProducts = Bestelling_has_product::findBy('bestelling', $id);
		$betaald = $order->getBetaald();?>

		<tr>
			<td>#<strong><?= $id; ?></strong></td>
			<td>
				<?php if($betaald == 1){
					echo '<i class="fa fa-check-circle" style="color: green;font-size: 20px;"></i>';
				}else{
					echo '';
				} ?>
			</td>
			<td>-</td>
			<td>-</td>
			<?php foreach($orderHasProducts as $OHP): ?>
				<?php $date = $OHP->getDatum(); ?>
				<tr>
					<td><?= $date; ?></td>
					<td></td>
					<td><?= $OHP->getProductId()->getNaam(); ?></td>
					<td><?= $OHP->getAantal(); ?></td>
				</tr>
			<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>
</table> -->
<?php
	$user = $_SESSION['userid'];
	$orders = Bestelling::findBy('user', $user);
?>
<table>
	<tr>
		<th>#Bestelling</th>
		<th>Betaald</th>
		<th>Bedrag</th>
		<th></th>
	</tr>
	<?php foreach($orders as $order): ?>
		<?php
			$prijs = 0;
			$orderID = $order->getId();
			$ord = Bestelling_has_product::findBy('bestelling', $orderID);

			foreach($ord as $product){
				$price = $product->getAantal() * $product->getProductId()->getPrijs();
				$prijs += $price;				
			}
		?>
		<tr class="href">
			<td><?= $order->getId(); ?></td>
			<td><?php if($betaald == 1){echo '<i class="fa fa-check-circle" style="color: green;font-size: 20px;"></i>';} ?></td>
			<td>&euro; <?= number_format($prijs, 2); ?></td>
			<td><a <?= App::link('factuur&factuur=' . $orderID); ?>><i class="fa fa-eye"></i></a></td>
		</tr>
	<?php endforeach; ?>

</table>