<?php

class DB
{
   // переменные для подключения к БД
   private $host = 'localhost';
   private $userName = 'root';
   private $passWord = '';
   private $dbName = 'mysite';

   // создание подключения к БД
   private function conn()
   {
      $db = new mysqli($this->host, $this->userName, $this->passWord, $this->dbName);
      if ($db->connect_error) {
         die($db->connect_error);
      } else {
         return $db;
      }
   }

   // вставка пользователя в таблицу users
   public function insertUser($userName, $passWord)
   {
      $sql = $this->conn();
      $query = "INSERT INTO `users` VALUES (null, '$userName', '$passWord', now())";
      $sql->query($query);
   }

   // создание массива со всеми записями
   public function select($table): array
   {
      $outputData = [];
      $sql = $this->conn();
      $query = "SELECT * FROM `$table`";
      $data = $sql->query($query);
      while ($row = $data->fetch_assoc()) {
         array_push($outputData, $row);
      }
      return $outputData;
   }

   // проверка уникальности имени пользователя
   public function selectUserName($user)
   {
      $sql = $this->conn();
      $query = "SELECT * FROM `users` WHERE `username` = '$user'";
      $data = $sql->query($query);
      if ($data->num_rows !== 0) {
         return $data->fetch_assoc();
      }
   }

   // проверка уникальности пользователя
   public function selectUser($user, $pass)
   {
      $sql = $this->conn();
      $query = "SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$pass'";
      $data = $sql->query($query);
      if ($data->num_rows !== 0) {
         return $data->fetch_assoc();
      }
   }

   // вставка данных в profile
   public function insertProfile($data)
   {
      $sql = $this->conn();
      $query = "INSERT INTO `profiles` VALUES ('{$data['user_id']}', null, '{$data['first_name']}', '{$data['last_name']}','{$data['gender']}','{$data['date_of_birth']}','{$data['email']}','{$data['country']}','{$data['city']}','{$data['photo_upload']}')";
      $sql->query($query);
   }


   public function updateProfile($data)
   {
      $sql = $this->conn();
      $query = "UPDATE `profiles` SET `first_name` = '{$data['first_name']}', `last_name` = '{$data['last_name']}',`gender` ='{$data['gender']}',`date_of_birth` = '{$data['date_of_birth']}', `email` = '{$data['email']}', `country` = '{$data['country']}', `city` = '{$data['city']}',`foto` = '{$data['photo_upload']}' WHERE `user_id` = {$data['user_id']}";
      $sql->query($query);
   }
}