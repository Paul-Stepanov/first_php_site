<!doctype html>
<html lang="ru">
<head>
   <meta http-equiv="Cache-Control" content="private">
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../style/css/style.css">
   <title><?= $title ?></title>
</head>
<body>
<header class="header">
   <nav class="header__nav nav">
      <ul class="nav__items">
         <li class="nav__item"><a href="../pages/index.php">Главная</a></li>
         <li class=" nav__item"><a href="../pages/profile.php">Профиль</a></li>
         <li class="nav__item"><a href="../pages/login.php">Авторизация</a></li>
         <li class=" nav__item"><a href="../pages/signin.php">Регистрация</a></li>
         <li class=" nav__item"><a href="../pages/logout.php">Выход (<?= $userName ?>)</a></li>
      </ul>
   </nav>
</header>
