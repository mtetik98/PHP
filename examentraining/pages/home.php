<?php
	echo Laptop::createForm()->getHTML();
	if(isset($_POST['merk'])){
		$_POST['user'] = App::getUser()->getId();
		$_POST['ssd'] = isset($_POST['ssd']) ? 1 : 0;
		Laptop::saveTableRow($_POST);
	}

	// echo Laptop::find()[0]->getUser()->getUsername();
	// print_r(User::find()[0]->getLaptops());