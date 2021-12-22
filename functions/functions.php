<?php
// ****** functions!!! ************

function getAvatar($formData, $userId): string // срц для загрузки аватарки
{
   if (isset($formData['foto']) && !empty($formData['foto'])) {
      return "id_" . $userId . "/" . $formData['foto'];
   } else return 'nopic.jpg';
}

function getProfileData($data, $index) // возврат пустой строки если профиль пользователя не найден
{
   if ($index >= 0) {
      return $data[$index];
   } else {
      return $data = array();
   }
}

function checkProfile($data, $id): bool // проверка на существование профиля в БД
{
   for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['user_id'] === $id) {
         return true;
      }
   }
   return false;
}

function getProfileIndex($data, $id): int // возвращает индекс массива профиля
{
   for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['user_id'] === $id) {
         return $i;
      }
   }
   return -1;
}

function renderAnArray($array) //отрисовка массива в столбик
{
   echo "<pre>";
   print_r($array);
   echo "</pre>";
}

function checkCookies() // проверка куки и сессии
{
   if (isset($_COOKIE['user_id'])) {
      return $_COOKIE['user_id'];
   } elseif (isset($_SESSION['user_id'])) {
      return $_SESSION['user_id'];
   }
}

function uriCreate($pageOld, $pageNew): string // создание урла перенаправления для заголовка хттп
{
   $uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   $uriArr = explode('/', $uri);
   $key = array_search($pageOld, $uriArr);
   $uriArr[$key] = $pageNew;
   return implode('/', $uriArr);
}

function htmlFormSignIn()
{
   ?>
   <div class="form">
      <h2 class="form__title">Регистрация</h2>
      <form class="form__body" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
         <?php if (!empty($_POST['username'])) {
            echo "<span class='form__error'>Логин уже существует!</span>";
         } elseif (isset($_POST['submit']) && empty($_POST['username'])) {
            echo "<span class='form__error'>Заполните все поля!</span>";
         } ?>
         <label for="username" class="form__label">Логин
            <input type="text" class="form__input" name="username"></label>
         <label for="pass1" class="form__label">Пароль
            <input type="password" class="form__input" name="pass1"></label>
         <label for="pass2" class="form__label">Повторите пароль
            <input class="form__input" name="pass2" type="password"></label>
         <input type="submit" class="form__submit" value="Зарегистрироваться" name="submit">
      </form>
   </div>
   <?php
}

function htmlFormLogIn()
{
   ?>
   <div class="form">
      <h2 class="form__title">Авторизация</h2>
      <form class="form__body" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
         <?php if (isset($_POST['submit'])) echo "<span class='form__error'>Пользователь не зарегистрирован!</span>" ?>
         <label for="username" class="form__label">Логин
            <input type="text" class="form__input" name="username"></label>
         <label for="pass1" class="form__label">Пароль
            <input class="form__input" name="pass1" type="password"></label>
         <input type="submit" class="form__submit" value="Авторизироваться" name="submit">
      </form>
   </div>
   <?php
}

function htmlFormLogOut()
{
   ?>
   <div class="form">
      <h2 class="form__title">Вы уверены что хотите выйти?</h2>
      <form class="form__body form__body--radio-btn" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
         <label for="logout" class="form__label form__label--radio-btn">Да
            <input type="radio" class="form__input form__input--radio-btn" name="logout" value="yes"></label>
         <label for="logout" class="form__label form__label--radio-btn">Нет
            <input type="radio" class="form__input form__input--radio-btn" name="logout" value="no"></label>
         <input type="submit" class="form__submit form__submit--big" value="Выход" name="submit">
      </form>
   </div>
   <?php
}

function htmlFormProfile($data, $avatar)
{
   ?>
   <div class="form">
      <h2 class="form__title">Профиль</h2>
      <div class="form__photo">
         <img src="../img/avatar/<?= $avatar; ?>" alt="pic" class="form__photo-inner" id="avatar">
      </div>
      <form class="form__body" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"
            id="profile_form">
         <label for="first_name" class="form__label">Имя
            <input type="text" class="form__input" name="first_name"
                   value="<?php
                   if (isset($data['first_name'])) {
                      echo "{$data['first_name']}";
                   }
                   ?>"></label>
         <label for="last_name" class="form__label">Фамилия
            <input type="text" class="form__input" name="last_name"
                   value="<?php
                   if (isset($data['last_name'])) {
                      echo "{$data['last_name']}";
                   }
                   ?>"></label>
         <label for="gender" class="form__label">Пол
            <div class="form__wrap-radio-btn">
               <span id="radio-btn1">мужской</span>
               <input id="radio-btn2" class="form__input form__input--radio-btn" name="gender" type="radio" value="male"
                     <?php
                     if (isset($data['gender']) && $data['gender'] == 'male') {
                        echo 'checked';
                     }
                     ?>>
               <span id="radio-btn3">женский</span>
               <input id="radio-btn4" class="form__input form__input--radio-btn" name="gender" type="radio"
                      value="female"
                     <?php
                     if (isset($data['gender']) && $data['gender'] == 'female') {
                        echo 'checked';
                     }
                     ?>>
            </div>
         </label>
         <label for="date_of_birth" class="form__label">Дата рождения
            <input class="form__input" name="date_of_birth" type="date"
                   value="<?php
                   if (isset($data['date_of_birth'])) {
                      echo "{$data['date_of_birth']}";
                   }
                   ?>"></label>
         <label for="email" class="form__label">Email
            <input class="form__input" name="email" type="email"
                   value="<?php
                   if (isset($data['email'])) {
                      echo "{$data['email']}";
                   }
                   ?>"></label>
         <label for="country" class="form__label">Страна
            <input class="form__input" name="country" type="text"
                   value="<?php
                   if (isset($data['country'])) {
                      echo "{$data['country']}";
                   }
                   ?>"></label>
         <label for="city" class="form__label">Город
            <input class="form__input" name="city" type="text"
                   value="<?php
                   if (isset($data['city'])) {
                      echo "{$data['city']}";
                   }
                   ?>"></label>

         <input class="form__input-upload-img" name="photo_upload" type="file" form="profile_form">

         <input type="submit" class="form__submit" value="Save" name="submit">
      </form>
   </div>
   <?php
}

// ****** functions end ************