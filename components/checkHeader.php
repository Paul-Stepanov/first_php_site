<?php // проверка на наличие куки и сессии

if (isset($_COOKIE['username'])) $cookie = $_COOKIE['username'];
if (isset($_SESSION['username'])) $session = $_SESSION['username'];
if (isset($cookie)) {
   $userName = $cookie;
   require_once "../components/headerLogIn.php";
} else require_once "../components/headerLogOut.php"; // загружаем header


