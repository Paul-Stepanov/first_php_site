<?php

require_once '../functions/functions.php';

$title = 'Log out'; // генерируем title страницы

require_once "../components/checkHeader.php";

require_once "../Class/DBConnect.php";  // подключение БД

htmlFormLogOut(); // отрисовка формы выхода

if (isset($_POST['submit'])) {
   if ($_POST['logout'] == 'yes') {
      setcookie('username', '', time() - (60 * 60 * 24 * 30));
      setcookie('user_id', '', time() - (60 * 60 * 24 * 30));
      $_SESSION[] = array();
      session_destroy();
   }
   $uri = uriCreate('logout.php', 'index.php');
   header('Location: http://' . $uri);
}

require_once "../components/footer.php"; // подключение footer

