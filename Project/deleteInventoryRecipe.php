<?php
include '../connect.php';

$id = $_POST['id'];
$idInv = $_POST['idInv'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
$recipe = mysqli_fetch_assoc($query);
$inventory = $recipe['inventory'];

if(!strstr($inventory, ",".$idInv.",")){
  $inventory = ",".$idInv.",".$inventory;
  mysqli_query($conn, "UPDATE `recipes` SET `inventory` = '$inventory' WHERE `id` = '$id'");
}
?>
