<?php
include '../connect.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
$recipe = mysqli_fetch_assoc($query);
$steps = $recipe['steps'];

$steps = $steps."$";
mysqli_query($conn, "UPDATE `recipes` SET `steps` = '$steps' WHERE `id` = '$id'");
?>
