<?php
session_start();

$title = 'Home page'; // генерируем title страницы

require_once "../components/checkHeader.php"; // проверка на наличие куки и сессии и подключение header

require_once "../components/main.php"; //загружаем main

require_once "../components/footer.php"; // загружаем footer




