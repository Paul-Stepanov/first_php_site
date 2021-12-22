<?php

require_once '../functions/functions.php';

$title = 'Sign in';

require_once "../components/checkHeader.php";

require_once "../Class/DBConnect.php";  // подключение БД

htmlFormSignIn();

if (isset($_POST['submit'])) {
   if ($_POST['username'] && $_POST['pass1'] && $_POST['pass2'] && ($_POST['pass1'] == $_POST['pass2'])) {
      $userName = ucfirst(strtolower(trim($_POST['username'])));
      $passWord = strtolower(trim($_POST['pass1']));
      $sql = new DB();
      $data = $sql->selectUserName($userName);
      if (!isset($data)) {
         $sql->insertUser($userName, md5($passWord));
         $uri = uriCreate('signin.php', 'login.php');
         header('Location: http://' . $uri);
      }
   }
}

// загружаем footer
require_once "../components/footer.php";
