<?php
  session_start();
  $name = $_POST['name'];
  $mail = $_SESSION['mail'];
  
  $mysql = new mysqli('127.0.0.1','mysql','','buon_appetito');
  $mysql->query("UPDATE `users` SET `name` = '$name' WHERE `mail` = '$mail'");
  $_SESSION['name']=$name;
  $mysql->close();

  header('Location: ../profile.php');
 ?>
