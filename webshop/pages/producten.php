<?php
	if(!empty($_POST['productNaam']) && !empty($_POST['productOmschrijving']) && !empty($_POST['productPrijs'])){
		$productNaam = htmlspecialchars($_POST['productNaam']);
		$productOmschrijving = htmlspecialchars($_POST['productOmschrijving']);
		$productPrijs = $_POST['productPrijs'];
		$productCategorie = $_POST['categorie'];

		Product::register($productNaam, $productOmschrijving, $productPrijs, $productCategorie);
		App::addError('Product toegevoegd');
		App::refresh();
	}
	if(!empty($_POST['categorieNaam'])){
		$categorieNaam = htmlspecialchars($_POST['categorieNaam']);

		Categorie::register($categorieNaam);
		App::addError('Categorie toegevoegd');
		App::refresh();
	}
	$categorie = Categorie::find();
	$product = Product::find();
?>
<div class="mid-left">
	<form action="?page=producten" method="POST">
		<table>
			<tr>
				<td><h2>Product</h2></td>
			</tr>
			<tr>
				<td>Naam:</td>
				<td><input type="text" name="productNaam"/></td>
			</tr>
			<tr>
				<td>Omschrijving:</td>
				<td><textarea name="productOmschrijving"></textarea></td>
			</tr>
			<tr>
				<td>Prijs:</td>
				<td><input type="text" name="productPrijs"/></td>
			</tr>
			<tr>
				<td>Categorie:</td>
				<td>
					<select name="categorie">
						<?php foreach($categorie as $cat){ ?>
							<option value="<?= $cat->getId(); ?>"><?= $cat->getNaam(); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Aanmaken"></td>
			</tr>
		</table>
	</form>
</div>
<div class="mid-right">
	<form action="?page=producten" method="POST">
		<table>
			<tr>
				<td><h2>Categorie</h2></td>
			</tr>
			<tr>
				<td>Naam:</td>
				<td><input type="text" name="categorieNaam"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Aanmaken"></td>
			</tr>
		</table>
	</form>
</div>
<div class="bottom-left">
	<table>
		<tr>
			<td><h2>Producten</h2></td>
		</tr>
		<tr>
			<th>Naam</th>
			<th>Omschrijving</th>
			<th>Prijs</th>
			<th>Categorie</th>
			<th></th>
		</tr>
		<?php foreach($product as $producten){ ?>
			<tr>
				<td><?= $producten->getNaam(); ?></td>
				<td><?= $producten->getOmschrijving(); ?></td>
				<td><?= $producten->getPrijs(); ?></td>
				<td><?= $producten->getCategorie()->getNaam(); ?></td>
				<td><a <?= App::link('delete&pID=' . $producten->getId()) ?> class="fa fa-remove"></a>
			</tr>
		<?php } ?>
	</table>
</div>
<div class="bottom-right">
	<table>
		<tr>
			<td><h2>Categorieën</h2></td>
		</tr>
		<tr>
			<th>Naam</th>
			<th></th>
		</tr>
		<?php foreach($categorie as $categorieen){ ?>
			<tr>
				<td><?= $categorieen->getNaam(); ?></td>
				<td><a <?= App::link('delete&cID=' . $categorieen->getId()) ?> class="fa fa-remove"></a>
			</tr>
		<?php } ?>
	</table>
</div>