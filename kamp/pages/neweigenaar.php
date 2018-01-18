<?php
	if(!empty($_POST['naam'])){
		$naam = htmlspecialchars($_POST['naam']);
		$email = $_POST['email'];
		$telefoon = $_POST['telefoon'];

		//Kamp::register($naam, $datumVan, $datumTot, $maxAantal);
      	Eigenaar::register($naam, $email, $telefoon);
		App::addError('Eigenaar toegevoegd');
	}
?>
<form action="?page=neweigenaar" method="POST">
	<table>
		<tr>
			<td>Naam:</td>
			<td><input type="text" name="naam"/></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="email" name="email"/></td>
		</tr>
		<tr>
			<td>Telefoon:</td>
			<td><input type="text" name="telefoon"/></td>
		</tr>
		<tr>
			<td><a href="?page=eigenaren"><input type="button" value="Terug"></a></td>
			<td><input type="submit" value="Aanmaken"></td>
		</tr>
	</table>
</form>