<?php

if (isset($_POST['submit'])) {
   define("SUBMIT", $_POST['submit']);
   define("FIRSTNAME", $_POST['first_name']);
   define("LASTNAME", $_POST['last_name']);
   if (isset($_POST['gender'])) {
      define("GENDER", $_POST['gender']);
   } else define("GENDER", '');
   define("BIRTH", $_POST['date_of_birth']);
   define("EMAIL", $_POST['email']);
   define("COUNTRY", $_POST['country']);
   define("CITY", $_POST['city']);
   if (isset($_FILES['photo_upload'])) {
      define("PHOTO", $_FILES['photo_upload']);
   } else define("PHOTO", '');
}