<?php
include '../connect.php';
session_start();
$mail = $_SESSION['mail'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
$shoppingList = mysqli_fetch_assoc($query);
$shoppingList = $shoppingList['ShoppingList'];

$idRecipe = $_POST['id'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$idRecipe'");
$recipe = mysqli_fetch_assoc($query);
$ingredients = $recipe['ingredients'];
$quantityIngredients = $recipe['quantityIngredients'];

$quantityArray = array();
$quan = '';
for($i = 0; $i < strlen($quantityIngredients); $i++){
  if($quantityIngredients[$i]!=","){
    $quan = $quan.$quantityIngredients[$i];
  }
  if($quantityIngredients[$i]=="," && $quan){
    $quantityArray[count($quantityArray)] = $quan;
    $quan = '';
  }
}
$ingredientsArray = array();
$ing = '';
for($i = 0; $i < strlen($ingredients); $i++){
  if($ingredients[$i]!=","){
    $ing = $ing.$ingredients[$i];
  }
  if($ingredients[$i]=="," && $ing){
    $ingredientsArray[count($ingredientsArray)] = $ing;
    $ing = '';
  }
}

for($i=0; $i < count($ingredientsArray); $i++){
  $id = $ingredientsArray[$i];
  $quantityIng = $quantityArray[$i];
  $find=",".$id ."-";
  if(strpos($shoppingList, $find) === false){
    $shoppingList = ",".$id ."-".$quantityIng.",".$shoppingList;
  }else{
    $shoppingList = str_replace(",".$id ."-" , ",".$id ."?" , $shoppingList);
    for($z=0; $z < strlen($shoppingList); $z++) {
      if($shoppingList[$z]=="?"){
        $quan = '';
        for ($j=$z + 1; $j < strlen($shoppingList); $j++) {
          if($shoppingList[$j] == ","){
            $quans = $quan + $quantityIng;
            $shoppingList = str_replace(",".$id ."?".$quan."," , ",".$id ."-".$quans."," , $shoppingList);
            break;
          }
          $quan = $quan.$shoppingList[$j];
        }
        break;
      }
    }
  }
}

mysqli_query($conn, "UPDATE `users` SET `ShoppingList` = '$shoppingList' WHERE `mail` = '$mail'");
 ?>
