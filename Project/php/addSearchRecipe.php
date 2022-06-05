<?php
session_start();
include '../connect.php';

$mail = $_SESSION['mail'];
$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
$selectedIngredientInSearch = mysqli_fetch_assoc($query);
$selectedIngredientInSearch = $selectedIngredientInSearch['SelectedIngredientInSearch'];

if(!strstr($selectedIngredientInSearch, ",".$id.",")){
  $selectedIngredientInSearch = $selectedIngredientInSearch.",".$id.",";
  mysqli_query($conn, "UPDATE `users` SET `SelectedIngredientInSearch` = '$selectedIngredientInSearch' WHERE `mail` = '$mail'");
}
?>
