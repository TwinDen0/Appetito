<?php
  include '../connect.php';
  session_start();
  $mail = $_SESSION['mail'];
  $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
  $shoppingList = mysqli_fetch_assoc($query);
  $shoppingList = $shoppingList['ShoppingList'];

  $id = $_POST['id'];
  $quantityIng = $_POST['quantity'];
  $shoppingList = str_replace(",".$id ."-".$quantityIng."," , '' , $shoppingList);
  mysqli_query($conn, "UPDATE `users` SET `ShoppingList` = '$shoppingList' WHERE `mail` = '$mail'");
 ?>
