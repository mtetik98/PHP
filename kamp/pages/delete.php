<?php
	$id = $_GET['id'];
	$kid = $_GET['Kid'];
	$eid = $_GET['Eid'];

	if(isset($id)){
		User::findById($id)->remove();
		App::redirect('users');
	}
	if(isset($kid)){
		Kamp::findById($kid)->remove();
		App::redirect('kampen');
	}
	if(isset($eid)){
		Eigenaar::findById($eid)->remove();
		App::redirect('eigenaren');
	}
?>