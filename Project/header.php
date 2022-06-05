<!DOCTYPE html>
<?php
  ini_set('session.cookie_domain', 'buonappetito.site');
  session_set_cookie_params(7200, "/", "buonappetito.site", false, false);
  session_start();
?>
<html>
	<head>
		<meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Laila:wght@600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
	</head>

    <header>
	<ul class = "menuHeader">
		<div class = "containerHeader">
			<?php
			if(( $_SERVER['REQUEST_URI'] != "/")){
				if( $_SERVER['REQUEST_URI'] != "/index.php"){
			?>

				<div onclick="location.href='./index.php'" class = "linkHeader">
					<img class = "linkImg" src = "./header/иконки-10.png">
					<div class = "linkText">Главная страница</div>
				</div>

				<div class = "split"></div>
			<?php
				}
			}
			?>

			<?php if($_SERVER['REQUEST_URI'] != "/inventory.php"){ ?>

				<div onclick="location.href='./inventory.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-07.png">
				<div class = "linkText">Инвентарь</div>
				</div>

				<div class = "split"></div>
			<?php } ?>

			<?php if( $_SERVER['REQUEST_URI'] != "/allrecipe.php"){?>

			  <div onclick="location.href='./allrecipe.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-08.png">
				<div class = "linkText">Все рецепты</div>
			  </div>

			  <div class = "split"></div>
			<?php } ?>

			<?php if( $_SERVER['REQUEST_URI'] != "/searchRecipe.php"){?>

				<div onclick="location.href='./searchRecipe.php'" class = "linkHeader">
					<img class = "linkImg" src = "./header/иконки-09.png">
					<div class = "linkText">Поиск рецептов</div>
				</div>

				<div class = "split"></div>
			<?php } ?>

			<?php if( $_SERVER['REQUEST_URI'] != "/shoppingList.php"){?>

				<div onclick="location.href='./shoppingList.php'" class = "linkHeader">
					<img class = "linkImg" src = "./header/иконки-06.png">
					<div class = "linkText">Список покупок</div>
				</div>

				<?php if($_SERVER['REQUEST_URI'] != "/profile.php"){ ?>
					<div class = "split"></div>
				<?php } ?>

			<?php } ?>

	<!-- регистрация и вход !-->

				<?php if($_SERVER['REQUEST_URI'] != "/profile.php"){ ?>

					<div style = "justify-content: space-around;" class = "linkHeader">

						<?php if( $_SESSION['auth'] == true ) { ?>

							<div onclick="location.href='./profile.php'" class = "nameheader"> <?php echo($_SESSION['name']) ?> </div>
							<div style = "margin-left: 15px;" onclick="location.href='./profile.php'">
								<div <?php echo 'style = "
								background: url(./images/avatars/' . $_SESSION['avatar'] . ');
								background-size: cover;
								background-repeat:no-repeat;
								background-position: center center;
								"'?> class = "profile"></div>
							</div>
							<a  style = "margin-left: 25px;" onclick="location.href='../exit.php'"href="#" class = "btnHeader2">Выйти</a>

						<?php } else { ?>
							<a  onclick="location.href='../login.php'"href="#" class = "btnHeader">Войти</a>
							<a  style = "margin-left: 25px;" onclick="location.href='../registration.php'"href="#" class = "btnHeader2">  Регистрация</a>
						<?php } ?>

					</div>
				<?php } ?>
			</div>
        </ul>
	</header>
