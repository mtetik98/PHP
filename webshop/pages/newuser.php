<?php
	if(!empty($_POST['gebruikersnaam']) && !empty($_POST['wachtwoord']) && !empty($_POST['email'])){
		$username = htmlspecialchars($_POST['gebruikersnaam']);
		$password = htmlspecialchars($_POST['wachtwoord']);
		$email = $_POST['email'];
		$role = $_POST['role'];

		User::register($username, $email, $password, $role);
		App::addError('User toegevoegd');
	}
?>
<form action="?page=newuser" method="POST">
	<table>
		<tr>
			<td>Gebruikersnaam:</td>
			<td><input type="text" name="gebruikersnaam"/></td>
		</tr>
		<tr>
			<td>Wachtwoord:</td>
			<td><input type="password" name="wachtwoord"/></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="email" name="email"/></td>
		</tr>
		<tr>
			<td>Role:</td>
			<td>
				<select name="role">
					<option value="admin">Admin</option>
					<option value="bestuurslid">Bestuurslid</option>
					<option value="begeleider">Begeleider</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><a href="?page=users"><input type="button" value="Terug"></a></td>
			<td><input type="submit" value="Aanmaken"></td></tr>
	</table>
</form>