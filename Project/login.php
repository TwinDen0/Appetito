<?php
  session_start();
 ?>

<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style_login.css">
    <link href="https://fonts.googleapis.com/css2?
    family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=PT+Sans+Narrow:wght@400;700&family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <title> Вход </title>
</head>

<body>
    <div class="parents">
        <div class="login">
            <?php
                if($_SESSION['error']){
                    echo'<div class="error"> ' . $_SESSION['error'] . '</div>';
                }
            ?>
            <div class="log_zagolovok"><b>Вход</b></div>
            <form action="log.php" method="post">
                <div class="name_log"><b>Почта:</b></div>
                <input name="mail" class="col-75"  required type="email" placeholder="email@gmail.com" required>

                <div class="name_log" style="top: 120px;"><b>Пароль:</b></div>
                <div class="password">
                    <input name="pass" type="password" maxlength="50" id="password-input" class="col-75" placeholder="********" style="top: 120px;" required>
                </div>

                <input class="button" type="submit" name = "" value="ВХОД"/>
            </form>

            <div class="question">Не зарегистрированы?
            <a href="registration.php" style="text-decoration: none; "><b>Регистрация</b></a>
            </div>

        </div>
    </div>

</body>
</html>
<?php
$_SESSION['error'] = '';
session_write_close();
?>
