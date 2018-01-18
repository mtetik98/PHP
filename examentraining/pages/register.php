<?php

if(isset($_POST['username'])) {

    $inputUser = htmlspecialchars($_POST['username']);
    $inputPass = htmlspecialchars($_POST['password']);
    $inputPas2 = htmlspecialchars($_POST['repeat']);
    $inputMail = htmlspecialchars($_POST['email']);

    //Validate input
    $errors = [];

    if(strlen($inputPass) < 8) {
      array_push($errors, "Password should be at least 8 characters!");
    }

    if($inputPass != $inputPas2) {
      array_push($errors, "Passwords do not match!");
    }

    if(count($errors) > 0) {
      foreach($errors as $error) {
        App::addError($error);
      }
    } else {
      //Register user
      $user = User::register($inputUser, $inputMail, $inputPass, 'user');
      if($user) {
          echo $user->getUsername();

          // session_start();
          // $_SESSION['username'] = $user->getUsername();
          // $_SESSION['role'] = $user->getRole();
          App::redirect("home");
      }
    }
}
?>
<div class="container">
    <h1>
        REGISTER
    </h1>

    <form action="?page=register" method="POST">

        <input type="text" placeholder="Username" required name="username"/><br/>
        <input type="email" placeholder="E-mail" required name="email"/><br/>
        <input type="password" placeholder="Password" required name="password"/><br/>
        <input type="password" placeholder="Repeat" required name="repeat"/><br/>

        <input type="submit" value="Register"/>
    </form>

</div>
