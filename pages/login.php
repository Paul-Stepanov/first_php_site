<?php

require_once '../functions/functions.php';

$title = 'Log in'; // генерируем title страницы

require_once "../components/checkHeader.php";

require_once "../Class/DBConnect.php";  // подключение БД

htmlFormLogIn(); // отрисовка формы логинизации

if (isset($_POST['submit'])) {
   if (isset($_POST['username']) && isset($_POST['pass1'])) {
      $userName = trim($_POST['username']);
      $passWord = trim($_POST['pass1']);
      $sql = new DB();
      $data = $sql->selectUser($userName, md5($passWord));
      if ($data) {
         setcookie('username', $userName, time() + (60 * 60 * 24 * 30));
         setcookie('user_id', $data['user_id'], time() + (60 * 60 * 24 * 30));
         $_SESSION['username'] = $userName;
         $_SESSION['user_id'] = $data['user_id'];
         $uri = uriCreate('login.php', 'index.php');
         header('Location: http://' . $uri);
      }
   }
}

require_once "../components/footer.php"; // подключение footer

