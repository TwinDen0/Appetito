<?php
session_start();
include '../connect.php';

$author = $_SESSION['mail'];
$name = htmlspecialchars(trim($_GET['name']));
$name = str_replace("%20" , " " , $name);
$description = htmlspecialchars(trim($_GET['description']));
$description = str_replace("%20" , " " , $description);
$time = htmlspecialchars(trim($_GET['time']));
$calories = htmlspecialchars(trim($_GET['calories']));
$kitchen = htmlspecialchars(trim($_GET['kitchen']));
$kitchen = str_replace("%20" , " " , $kitchen);
$ingredients = htmlspecialchars(trim($_GET['ingredients']));
$inventory = htmlspecialchars(trim($_GET['inventory']));
$steps =  htmlspecialchars(trim($_GET['steps']));
$steps = str_replace("%20" , " " , $steps);
$likes = 0;
$reviews = '';

//image
$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id` DESC");
$recipe = mysqli_fetch_assoc($query);
$id = $recipe['id'] + 1;
$image = $id.'.jpg';

//price
$quantityIngredients = array();
$quanIng = '';
for($i = 0; $i < strlen($ingredients); $i++){
  if($ingredients[$i]!=","){
    $quanIng = $quanIng.$ingredients[$i];
  }
  if($ingredients[$i]=="," && $quanIng){
    $quantityIngredients[count($quantityIngredients)] = $quanIng;
    $quanIng = '';
  }
}

$quantityIngredients = $_GET['quantityIngredients'];
$price = 100;
$sql = "INSERT INTO `recipes` (`id`, `name`, `image`, `description`, `author`, `steps`, `time`, `calories`, `price`, `kitchen`, `likes`, `ingredients`, `quantityIngredients`, `inventory`, `reviews`) VALUES (NULL, '$name', '$image', '$description', `$author`, '$steps','$time','$calories','$price','$kitchen','$likes','$ingredients','$quantityIngredients','$inventory','$reviews');";
$conn->query($sql);
$conn->close();

header('Location: ../recipe.php?id='.$id);
?>
