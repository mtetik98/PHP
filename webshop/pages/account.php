<?php
	if(isset($_POST['gebruikersnaam'])){
		$user = htmlspecialchars($_POST['gebruikersnaam']);
		App::getUser()->setUsername($user);
		App::getUser()->save();
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		App::getUser()->setEmail($email);
		App::getUser()->save();
	}
	if(isset($_POST['wachtwoord']) && !empty($_POST['wachtwoord'])){
		$pass = htmlspecialchars($_POST['wachtwoord']);
		App::getUser()->setPassword($pass);
		App::getUser()->save();
		App::redirect('logout');
	}
?>
<div id="center">
	<form action="?page=account" method="POST">
		Gebruikersnaam: <input type="text" class="" name="gebruikersnaam" value="<?= App::getUser()->getUsername(); ?>">
		<input type="submit" value="Wijzig">
	</form>
	<form action="?page=account" method="POST">
		Email: <input type="email" class="inputs2" name="email" value="<?= App::getUser()->getEmail(); ?>">
		<input type="submit" value="Wijzig">
	</form>
	<form action="?page=account" method="POST">
		Wachtwoord: <input type="password" class="inputs" name="wachtwoord" placeholder="*****">
		<input type="submit" value="Wijzig">
	</form>
	Role: <input type="text" class="inputs3" value="<?= App::getUser()->getRole(); ?>" disabled>
</div>