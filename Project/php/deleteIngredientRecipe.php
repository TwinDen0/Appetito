<?php
include '../connect.php';

$id = $_POST['id'];
$idIng = $_POST['idIng'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
$recipe = mysqli_fetch_assoc($query);
$ingredients = $recipe['ingredients'];
$quantityIngredients = $recipe['quantityIngredients'];

$quantity4Price = array();
$quan = '';
for($i = 0; $i < strlen($quantityIngredients); $i++){
  if($quantityIngredients[$i]!=","){
    $quan = $quan.$quantityIngredients[$i];
  }
  if($quantityIngredients[$i]=="," && $quan){
    $quantity4Price[count($quantity4Price)] = $quan;
    $quan = '';
  }
}
$ingredients4Price = array();
$ing = '';
for($i = 0; $i < strlen($ingredients); $i++){
  if($ingredients[$i]!=","){
    $ing = $ing.$ingredients[$i];
  }
  if($ingredients[$i]=="," && $ing){
    $ingredients4Price[count($ingredients4Price)] = $ing;
    $ing = '';
  }
}
$ingredients = '';
$quantityIngredients = '';
for ($i=0; $i < count($ingredients4Price); $i++) {
  if($ingredients4Price[$i] != $idIng){
    $ingredients = $ingredients.",".$ingredients4Price[$i].",";
    $quantityIngredients = $quantityIngredients.",".$quantity4Price[$i].",";
  }
}

mysqli_query($conn, "UPDATE `recipes` SET `ingredients` = '$ingredients' WHERE `id` = '$id'");
mysqli_query($conn, "UPDATE `recipes` SET `quantityIngredients` = '$quantityIngredients' WHERE `id` = '$id'");
?>
