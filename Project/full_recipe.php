<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Инвентарь</title>
    <link rel="stylesheet" href="style/style.css">
    <script type="text/javascript" src="../scripts/elementUpdate.js"></script>
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
</head>

<?php
include 'header.php';
  ?>

<body>
    <div class="main">
      <div class="title">Кухонные принадлежности:</div>
      <?php
        include 'connect.php';
        session_start();
        $mail = $_SESSION['mail'];
        $trash = $_GET['idInv'];
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
        $myInventory = mysqli_fetch_assoc($query);
        $myInventory = $myInventory['myInventory'];

        // взять рецепты с таблицы

        // вывести от 0 до максимального размера
        // если больше 50 то переносится на новую стр, на которой от 50-100 и т.д.

      ?>
      <div class="recipe">
        <div class="jpg_recipe"></div>
        <div class="title_recipe"></div>
        <div class="text_recipe"></div>
      </div>

    </div>
</body>
</html>
