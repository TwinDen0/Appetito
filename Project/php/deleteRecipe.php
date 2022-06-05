<?php
include '../connect.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "DELETE FROM `recipes` WHERE `id`='$id'");
 ?>
