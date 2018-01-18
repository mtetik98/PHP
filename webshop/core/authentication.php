<?php

$auth = [];
//==== Roles ====
//Define your roles here
$auth['guest'] = [];
$auth['user'] = [];
$auth['admin'] = [];
//$auth['admin'] = [];

//==== Pages ====
//Define pages for each role. Is a user is not authenticated to visit a page
//he is automatically redirected to the first page in the list of pages he is
//allowed to visit.
array_push($auth['guest'], 'login');
array_push($auth['guest'], 'home');
array_push($auth['guest'], 'register');

array_push($auth['user'], 'home');
array_push($auth['user'], 'bestellingen');
array_push($auth['user'], 'account');
array_push($auth['user'], 'logout');
array_push($auth['user'], 'cart');
array_push($auth['user'], 'shopping_cart');
array_push($auth['user'], 'purchase');
array_push($auth['user'], 'factuur');

array_push($auth['admin'], 'home');
array_push($auth['admin'], 'delete');
array_push($auth['admin'], 'producten');
array_push($auth['admin'], 'bestellingen');
array_push($auth['admin'], 'klanten');
array_push($auth['admin'], 'account');
array_push($auth['admin'], 'logout');
array_push($auth['admin'], 'cart');
array_push($auth['admin'], 'shopping_cart');
array_push($auth['admin'], 'purchase');
array_push($auth['admin'], 'factuur');
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
