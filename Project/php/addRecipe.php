<?php
session_start();
include '../connect.php';

$mail = $_SESSION['mail'];
$id = htmlspecialchars(trim($_POST['id']));
$countOfSteps = htmlspecialchars(trim($_POST['stepCount']));
$name = htmlspecialchars(trim($_POST['nameRecipe']));
$name = str_replace("%20" , " " , $name);
$description = htmlspecialchars(trim($_POST['description']));
$description = str_replace("%20" , " " , $description);
$time = htmlspecialchars(trim($_POST['time']));
$calories = htmlspecialchars(trim($_POST['calories']));
$kitchen = htmlspecialchars(trim($_POST['kitchen']));
$kitchen = str_replace("%20" , " " , $kitchen);
$confirmed = 1;
$steps = '';

$photo = $_FILES['img'];

$nameFile = $id.'.jpg';
$dir = '../images/recipes/';
$uploadfile = $dir.$nameFile;
move_uploaded_file($photo['tmp_name'], $uploadfile);

//загрузка фоток шагов
for($i = 1; $i <= $countOfSteps; $i++){
  $photo = $_FILES['imgStep'.$i];
  $nameFile = $id.'-'.$i.'.jpg';
  $dir = '../images/recipes/';
  $uploadfile = $dir.$nameFile;
  move_uploaded_file($photo['tmp_name'], $uploadfile);
}

//шаги
for($i = 1; $i <= $countOfSteps; $i++){
  $stepText = htmlspecialchars(trim($_POST['step'.$i]));
  $steps = $steps.$stepText."$";
}

//количество
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
$quantityIngredients = '';
for ($i=0; $i < count($quantity4Price); $i++) {
  $quantity4Price[$i] = htmlspecialchars(trim($_POST['selectedIng'.$ingredients4Price[$i]]));
  $quantityIngredients = $quantityIngredients.",".$quantity4Price[$i].",";
}

//стоимость
$price = 0;
for ($i=0; $i < count($ingredients4Price); $i++) {
  $query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `id` = '$ingredients4Price[$i]'");
  $row = mysqli_fetch_assoc($query);
  $price += $quantity4Price[$i] * $row['price'];
}


$query = mysqli_query($conn, "UPDATE `recipes` SET `name`='$name',`confirmed`='$confirmed',`description`='$description',`steps`='$steps',`time`='$time',`calories`='$calories',`price`='$price',`kitchen`='$kitchen',`quantityIngredients`='$quantityIngredients' WHERE `id`='$id'");

header('Location: ../recipe.php?id='.$id);
?>
