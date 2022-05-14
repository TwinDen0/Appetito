<?php
session_start();

include 'connect.php';

$usmail = htmlspecialchars(trim($_POST['mail']));
$pass = htmlspecialchars(trim($_POST['pass']));

$_SESSION['mail'] = htmlspecialchars(trim($_POST['mail']));
$_SESSION['pass'] = htmlspecialchars(trim($_POST['pass']));

$query = "SELECT * FROM `users` WHERE `mail`='$usmail'";
$result = mysqli_query($conn,$query);
$row = $result->fetch_assoc();
$hashpass = $row['pass'];
$name = $row['name'];
$surname = $row['surname'];
$avatar = $row['avatar'];

if(password_verify($pass,$hashpass)){
    $_SESSION['auth'] = true;
    $_SESSION['mail'] = $usmail;

    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['avatar'] = $avatar;

    $_SESSION['comments'] = $row['comments'];
    $_SESSION['likes'] = $row['likes'];

    header('Location: /');
} else {
    $_SESSION['error'] = 'Введена неверная почта или пароль';
    header('Location: ../login.php');
}


?>
