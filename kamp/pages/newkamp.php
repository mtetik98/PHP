<?php
	if(!empty($_POST['naam'])){
		$naam = htmlspecialchars($_POST['naam']);
		$datumVan = $_POST['datumVan'];
		$datumTot = $_POST['datumTot'];
		$maxAantal = $_POST['maxAantal'];
		$begeleider = $_POST['begeleider'];
		$eigenaar = $_POST['eigenaar'];

		//Kamp::register($naam, $datumVan, $datumTot, $maxAantal);
      	Kamp::register($naam, $datumVan, $datumTot, $maxAantal, $begeleider, $eigenaar);
		App::addError('Kamp toegevoegd');
	}
	$users = User::find();
	$eigenaren = Eigenaar::find();
?>
<form action="?page=newkamp" method="POST">
	<table>
		<tr>
			<td>Naam:</td>
			<td><input type="text" name="naam"/></td>
		</tr>
		<tr>
			<td>Datum Van:</td>
			<td><input type="date" name="datumVan"/></td>
		</tr>
		<tr>
			<td>Datum Tot:</td>
			<td><input type="date" name="datumTot"/></td>
		</tr>
		<tr>
			<td>Max Aantal:</td>
			<td><input type="number" name="maxAantal"/></td>
		</tr>
		<tr>
			<td>Begeleider:</td>
			<td>
				<select name="begeleider">
					<?php
						foreach($users as $user){
							echo "<option value=" . $user->getId() . ">" . $user->getUsername() . " (" . $user->getRole() . ")</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Eigenaar:</td>
			<td>
				<select name="eigenaar">
					<?php
						foreach($eigenaren as $eigenaar){
							echo "<option value=" . $eigenaar->getId() . ">" . $eigenaar->getNaam() . "</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><a href="?page=kampen"><input type="button" value="Terug"></a></td>
			<td><input type="submit" value="Aanmaken"></td>
		</tr>
	</table>
</form>