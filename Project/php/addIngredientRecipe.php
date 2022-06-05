<?php
include '../connect.php';

$id = $_POST['id'];
$idIng = $_POST['idIng'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
$recipe = mysqli_fetch_assoc($query);
$ingredients = $recipe['ingredients'];
$quantityIngredients = $recipe['quantityIngredients'];

if(!strstr($ingredients, ",".$idIng.",")){
  $ingredients = ",".$idIng.",".$ingredients;
  mysqli_query($conn, "UPDATE `recipes` SET `ingredients` = '$ingredients' WHERE `id` = '$id'");
  $quantityIngredients = ",0.001,".$quantityIngredients;
  mysqli_query($conn, "UPDATE `recipes` SET `quantityIngredients` = '$quantityIngredients' WHERE `id` = '$id'");
}
?>
