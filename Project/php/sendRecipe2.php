<?php
  session_start();
  include '../connect.php';

  $mail = $_SESSION['mail'];

  $query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id` DESC");
  $recipe = mysqli_fetch_assoc($query);
  $id = $recipe['id'] + 1;

  move_uploaded_file($photo['tmp_name'], $uploadfile);
  $name = htmlspecialchars(trim($_POST['name']));
  $name = str_replace("%20" , " " , $name);
  $description = htmlspecialchars(trim($_POST['description']));
  $description = str_replace("%20" , " " , $description);
  $time = htmlspecialchars(trim($_POST['time']));
  $calories = htmlspecialchars(trim($_POST['calories']));
  $kitchen = htmlspecialchars(trim($_POST['kitchen']));
  $kitchen = str_replace("%20" , " " , $kitchen);
  $ingredients = htmlspecialchars(trim($_POST['ingredients']));
  $inventory = htmlspecialchars(trim($_POST['inventory']));
  $steps =  htmlspecialchars(trim($_POST['steps']));

  $steps = str_replace("%20" , " " , $steps);
  $likes = 0;
  $reviews = '';
  //image
  $query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id` DESC");
  $recipe = mysqli_fetch_assoc($query);
  $id = $recipe['id'] + 1;
  $image = $id.'.jpg';

  if($ingredients && $inventory && $steps){
    $quantityIngredients = $_POST['quantityIngredients'];
    $price = 100;
    $sql = "INSERT INTO `recipes` (`id`, `name`, `image`, `description`, `author`, `steps`, `time`, `calories`, `price`, `kitchen`, `likes`, `ingredients`, `quantityIngredients`, `inventory`, `reviews`) VALUES (NULL, '$name', '$image', '$description', '$mail', '$steps','$time','$calories','$price','$kitchen','$likes','$ingredients','$quantityIngredients','$inventory','$reviews');";
    $conn->query($sql);
    $conn->close();
  }
?>
