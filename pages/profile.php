<?php

require_once '../functions/functions.php'; // подключение функций

$title = 'Profile'; // генерация тайтла страницы

require_once "../components/checkHeader.php"; // подключение хидера в зависимости от существования куки и сессии

require_once "../Class/DBConnect.php";  // подключение объекта БД

$userId = checkCookies(); // возвращает юзер айди из куки или сессии

$sql = new DB(); // создание коннекта с базой данных

$profileData = $sql->select('profiles'); // создание массива со всеми данными из таблицы профиля

$index = getProfileIndex($profileData, $userId); // полученрие индекса массива с анкетой профиля

$formData = getProfileData($profileData, $index); // формирвание анкетных данных для авторизированного пользователя

$avaFolder = $_SERVER['DOCUMENT_ROOT'] . "/first_php_site-master/img/avatar/id_" . "$userId"; // генерация пути для аватарок

$avatar = getAvatar($formData, $userId); // подготовка аватара для формы

htmlFormProfile($formData, $avatar);

if (isset($_POST['submit'])) { // проверяем отправлялась ли форма
    require_once "../variable/profile_var.php"; // подключение констант

    if (FIRSTNAME && LASTNAME && BIRTH && EMAIL) { // проверка заполнения обязательных полей формы
        $data = array(
            'user_id' => trim($userId),
            'first_name' => trim(FIRSTNAME),
            'last_name' => trim(LASTNAME),
            'gender' => trim(GENDER),
            'date_of_birth' => trim(BIRTH),
            'email' => trim(EMAIL),
            'country' => trim(COUNTRY),
            'city' => trim(CITY),
            'photo_upload' => $userId . stristr(trim(PHOTO['name']), '.')
        ); // создание массива для генерации запроса к базе данных

        $avaFile = $avaFolder . '/' . $userId . stristr(trim(PHOTO['name']), '.'); // генерация пути перемещения загруженной аватарки

        if (!file_exists($avaFolder)) {
            mkdir($avaFolder); // создание папки для хранения аватарок если такой папки нет
        }
        if (PHOTO['name'] && PHOTO['size'] != 0) {
            move_uploaded_file(PHOTO['tmp_name'], "$avaFile"); // перемещение загруженной аватарки в папку юзера(при ее отправки с формой)
        }
        $check = checkProfile($profileData, $userId); // проверка на наличие данных в таблице профилей с указанным ай ди
        if (!$check) {
            $sql->insertProfile($data); // создание профиля в базе данных если такого профиля еще нет
        } else {
            $sql->updateProfile($data); // обновление данных профиля
        }
        header("Refresh:0");
    }
}

require_once "../components/footer.php"; // загружаем footer
