<?php
  session_start();
  $usname = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style_registration.css">
    <link href="https://fonts.googleapis.com/css2?
    family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=PT+Sans+Narrow:wght@400;700&family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <title> Регистрация </title>
</head>

<body>
    <div class="parents">
        <div class="registration">
            <?php
                if($_SESSION['error']){
                    echo'<div class="error"> ' . $_SESSION['error'] . '</div>';
                }
            ?>
            <div class="reg_zagolovok"><b>Регистрация</b></div>
            <form action="reg.php" method="post">
                <div class="name_reg"><b>Никнейм:</b></div>
                <input  name="name" maxlength="10" class="col-75" type="text" placeholder="Иван" required>

                <div class="name_reg" style="top: 120px;"><b>Почта:</b></div>
                <input  name="mail" class="col-75" type="email" placeholder="email@gmail.com" style="top: 120px;" required>

                <div class="name_reg" style="top: 240px;"><b>Пароль:</b></div>
                <div class="password">
                    <input  name="pass" maxlength="50" type="password" id="password-input" class="col-75" name="lastname" placeholder="********" style="top: 240px;" required>
                </div>

                <label class="checkbox_reg">
                    <input type="checkbox" required/>
                    <div class="checkbox__checkmark" >
                    </div>
                    <div class="checkbox__body">
                        Регистрируясь, вы соглашаетесь с
                        <a href="/privacy_policy.php" style="text-decoration: none;"><b>Политикой конфиденциальности.</b></a>
                    </div>
                </label>
                <input class="button" type="submit" name = "" value="ЗАРЕГИСТРИРОВАТЬСЯ"/>
            </form>
            <div class="question">Уже зерегистрированы?
            <a href="login.php" style="text-decoration: none; "><b>Вход</b></a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$_SESSION['error'] = '';
session_write_close();
?>
