<main class="main">
   <?php
   require_once "../Class/DBConnect.php";
   require_once "../functions/functions.php";
   ?>
   <h1 class="main__header">Добро пожаловать<?php
      if (isset($cookie)) {
         echo "<span> $cookie </span>";
      } elseif (isset($session)) {
         echo "<span> $session </span>";
      }
      ?>!</h1>
   <?php
   if (isset($_COOKIE['user_id'])) {
      $sql = new DB();
      $profileData = $sql->select('profiles'); // создание массива со всеми данными из таблицы профиля
      $index = getProfileIndex($profileData, $_COOKIE['user_id']); // полученрие индекса массива с анкетой профиля
      $formData = getProfileData($profileData, $index); // формирвание анкетных данных для авторизированного пользователя
      ?>
      <div class="main__photo">
         <img src="../img/avatar/<?php if (isset($formData['foto']) && !empty($formData['foto'])) {
            echo "id_" . $_COOKIE['user_id'] . '/' . $formData['foto'];
         } else {
            echo 'nopic.jpg';
         } ?>" alt="pic" class="main__photo-inner"
              id="avatar">
      </div>
      <?php
   } elseif (isset($_SERVER['user_id'])) {
      $sql = new DB();
      $profileData = $sql->select('profiles'); // создание массива со всеми данными из таблицы профиля
      $index = getProfileIndex($profileData, $_COOKIE['user_id']); // полученрие индекса массива с анкетой профиля
      $formData = getProfileData($profileData, $index); // формирвание анкетных данных для авторизированного пользователя
      ?>
      <div class="main__photo">
         <img src="../img/avatar/<?php if (isset($formData['foto']) && !empty($formData['foto'])) {
            echo "id_" . $_COOKIE['user_id'] . '/' . $formData['foto'];
         } else {
            echo 'nopic.jpg';
         } ?>" alt="pic" class="main__photo-inner"
              id="avatar">
      </div>
      <?php
   }
   ?>
</main>



