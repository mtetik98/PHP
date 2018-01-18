<?php
	if(isset($_GET['id'])){
		if(isset($_POST['voornaam'])){
			$id = $_GET['id'];

			$voornaam = $_POST['voornaam'];
			$achternaam = $_POST['achternaam'];
			$leeftijd = $_POST['leeftijd'];
			Aanmelding::register($voornaam, $achternaam, $leeftijd, $id);
			App::addError('aanmelding toegevoegd');
		}
	}
?>
<table>
	<form method="POST">
		<tr>
			<td>Voornaam:</td>
			<td><input type="text" name="voornaam"/></td>
		</tr>
		<tr>
			<td>Achternaam:</td>
			<td><input type="text" name="achternaam"/></td>
		</tr>
		<tr>
			<td>Leeftijd:</td>
			<td><input type="number" name="leeftijd"/></td>
		</tr>
		<tr>
			<td><a href="?page=home"><input type="button" value="Terug"/></a></td>
			<td><input type="submit" value="Aanmelden"/></td>
		</tr>
	</form>
</table>