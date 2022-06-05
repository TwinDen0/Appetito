<?php
include '../connect.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id` = '$id'");
$recipe = mysqli_fetch_assoc($query);
$steps = $recipe['steps'];
$countSteps = substr_count($steps, '$');
$steps = substr($steps, 0, strlen($steps)-1);
for ($i=strlen($steps)-1; $i > -1; $i--) {
  if($steps[$i] != '$'){
    $steps = substr($steps, 0, strlen($steps)-1);
  }
  else {
    break;
  }
}
unlink('../images/recipes/'.$id.'-'.$countSteps.'.jpg');
mysqli_query($conn, "UPDATE `recipes` SET `steps` = '$steps' WHERE `id` = '$id'");
?>
