<?php

$auth = [];
//Define your roles here
$auth['guest'] = [];
$auth['user'] = [];
$auth['admin'] = [];

//Define pages for each role. Is a user is not authenticated to visit a page
//he is automatically redirected to the first page in the list of pages he is
//allowed to visit.
array_push($auth['guest'], 'login');
array_push($auth['guest'], 'register');

array_push($auth['user'], 'home');
array_push($auth['user'], 'account');
array_push($auth['user'], 'logout');
array_push($auth['user'], 'overzicht');

array_push($auth['admin'], 'home');
array_push($auth['admin'], 'account');
array_push($auth['admin'], 'logout');
array_push($auth['admin'], 'alle_laptops');

//Determine page
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

//Determine role
if(!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'guest';
}

//Check to see if the role can visit the requested page
if(array_search($page, $auth[$_SESSION['role']]) === false) {
    //If not, redirect him to the first page in the list
    header("location: ?page=" . $auth[$_SESSION['role']][0]);
    exit();
}
