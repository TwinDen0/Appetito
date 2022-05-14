<?php
$back = $_SERVER['HTTP_REFERER'];

include '../connect.php';
session_start();
$mail = $_SESSION['mail'];
$id = $_GET['id'];
$review = filter_var(trim($_GET['text']), FILTER_SANITIZE_STRING);
$review = str_replace("$", '' , $review);
if($review){
  $review = $mail."$".$review."$";

  $query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
  $recipe = mysqli_fetch_assoc($query);
  $review = $review.$recipe['reviews'];
  $query = mysqli_query($conn, "UPDATE `recipes` SET `reviews` = '$review' WHERE `id` = '$id'");
}
header('Location: '.$back);
?>
