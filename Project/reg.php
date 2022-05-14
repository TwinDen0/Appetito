<?php
session_start();
include 'connect.php';

$name = htmlspecialchars(trim($_POST['name']));
$mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
$pass = htmlspecialchars(trim($_POST['pass']));

$_SESSION['name'] = htmlspecialchars(trim($_POST['name']));
$_SESSION['mail'] = htmlspecialchars(trim($_POST['mail']));
$_SESSION['pass'] = htmlspecialchars(trim($_POST['pass']));

$_SESSION['avatar'] = "0";
$avatar = $_SESSION['avatar'];

if(mb_strlen($name) < 2 || mb_strlen($name) > 50){
    $_SESSION['error'] = 'Имя должно быть от 2 до 50 символ';
    header('Location: /registration.php');
    exit();
}

$sql  = "SELECT * FROM `users` WHERE `mail` = '$mail'";
$result = $conn->query($sql);
while ($row=$result->fetch_assoc()) {
    if($row){
        $_SESSION['error'] = 'Вы уже зарегистрированы!';
        header('Location: /registration.php');
        exit();
      }
}

if(mb_strlen($pass) < 5 || mb_strlen($pass) > 20){
    $_SESSION['error'] = 'Пароль должен быть от 5 до 20 символов';
    header('Location: /registration.php');
    exit();
}

$hashpass = password_hash($pass, PASSWORD_BCRYPT);

$token = password_hash($mail, PASSWORD_BCRYPT);;
$avatar = "default.jpg";

$sql = "INSERT INTO `users` (`name`, `mail`,`pass`, `token`,`avatar`) VALUES ('$name', '$mail', '$hashpass', '$token' , '$avatar')";
$_SESSION['auth'] = true;

$message = 'Привет, ' . $name . '! Для подтверждения вашей почты перейдите по http://project/confirmed.php?token=' . $token . '';
mail("$mail", 'Подтвердите ваш email', $message, 'From: travelagencyadventure@gmail.com');

$conn->query($sql);
$conn->close();
header('Location: http://project/confirmed.php');
?>
