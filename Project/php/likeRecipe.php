<?php
  include '../connect.php';
  session_start();
  $mail = $_SESSION['mail'];
  $id = $_POST['id'];
  $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
  $user = mysqli_fetch_assoc($query);
  $favoriteRecipes = $user['favoriteRecipes'];

  $query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
  $recipe = mysqli_fetch_assoc($query);
  $likes = $recipe['likes'];

  if(strpos($favoriteRecipes, ",".$id.",") === false){
    $likes += 1;
    $favoriteRecipes = ",".$id.",".$favoriteRecipes;
  }else{
    $likes -= 1;
    $favoriteRecipes = str_replace(",".$id ."," , "" , $favoriteRecipes);
  }
  mysqli_query($conn, "UPDATE `recipes` SET `likes` = '$likes' WHERE `id` = '$id'");
  mysqli_query($conn, "UPDATE `users` SET `favoriteRecipes` = '$favoriteRecipes' WHERE `mail` = '$mail'");
?>
