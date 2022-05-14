<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_login.css">
    <link href="https://fonts.googleapis.com/css2?
    family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=PT+Sans+Narrow:wght@400;700&family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <title>Подтверждение почты</title>
</head>
<body>
  <script type="text/javascript" src="scripts/profile.js"></script>
  <?php $id = $_GET['id']; ?>
  <div class="parents">
      <div class="login" style="height: 150px;">
  <?php
    session_start();
    $mail = $_SESSION['mail'];
    $token=$_GET['token'];

    include 'connect.php';

    $query = "SELECT * FROM `users` WHERE `mail`='$mail'";
    $result = mysqli_query($conn,$query);
    $row = $result->fetch_assoc();

    if($token == $row['token']){
      $query = "UPDATE `users` SET `confirmed`='1' WHERE `mail`='$mail'";
      $result = mysqli_query($conn,$query);

      $name = $row['name'];
      $_SESSION['auth'] = true;
      $_SESSION['mail'] = $mail;
      $_SESSION['name'] = $name;

    }
    if($token == $row['token']):
  ?>
  <div class="log_zagolovok"><b>Почта подтверждена!</b></div>
<?php else: ?>
  <div class="log_zagolovok" style="line-height: 40px;"><b>Мы прислали вам на почту письмо с подтверждением!</b></div>
<?php endif; ?>
</div>
</div>
</body>
</html>
