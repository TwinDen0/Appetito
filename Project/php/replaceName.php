<?php
  session_start();
  $name = $_POST['name'];
  $mail = $_SESSION['mail'];

  $name = htmlspecialchars($name);

  $mysql = new mysqli('localhost','m105407_dbuser','KD~o~jy&E:~t!%bX','m105407_db');
  $mysql->query("UPDATE `users` SET `name` = '$name' WHERE `mail` = '$mail'");
  $_SESSION['name']=$name;
  $mysql->close();

  header('Location: ../profile.php');
 ?>
