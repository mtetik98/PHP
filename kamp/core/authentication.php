<?php

$auth = [];
//==== Roles ====
//Define your roles here
$auth['guest'] = [];
$auth['begeleider'] = [];
$auth['bestuurslid'] = [];
//$auth['admin'] = [];

//==== Pages ====
//Define pages for each role. Is a user is not authenticated to visit a page
//he is automatically redirected to the first page in the list of pages he is
//allowed to visit.
array_push($auth['guest'], 'login');
array_push($auth['guest'], 'home');
array_push($auth['guest'], 'aanmelden');

array_push($auth['begeleider'], 'account');
array_push($auth['begeleider'], 'logout');
array_push($auth['bestuurslid'], 'aanmeldingen');


array_push($auth['bestuurslid'], 'home');
array_push($auth['bestuurslid'], 'users');
array_push($auth['bestuurslid'], 'newuser');
array_push($auth['bestuurslid'], 'delete');
array_push($auth['bestuurslid'], 'kampen');
array_push($auth['bestuurslid'], 'newkamp');
array_push($auth['bestuurslid'], 'eigenaren');
array_push($auth['bestuurslid'], 'neweigenaar');
array_push($auth['bestuurslid'], 'account');
array_push($auth['bestuurslid'], 'logout');
array_push($auth['bestuurslid'], 'aanmelden');
array_push($auth['bestuurslid'], 'aanmeldingen');

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
