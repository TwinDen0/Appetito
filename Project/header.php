<!DOCTYPE html>
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
			  <div onclick="location.href='../index.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-10.png">
				<div class = "linkText">Главная страница</div>
			  </div>

			  <div class = "split"></div>

			  <div onclick="location.href='../inventory.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-07.png">
				<div class = "linkText">Инвентарь</div>
			  </div>

			  <div class = "split"></div>

			  <div class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-06.png">
				<div class = "linkText">Все рецепты</div>
			  </div>

			  <div class = "split"></div>

			  <div onclick="location.href='../searchRecipe.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-09.png">
				<div class = "linkText">Поиск рецептов</div>
			  </div>

			  <div class = "split"></div>

			  <div onclick="location.href='../shoppingList.php'" class = "linkHeader">
				<img class = "linkImg" src = "./header/иконки-08.png">
				<div class = "linkText">Список покупок</div>
			  </div>

              <div class = "split"></div>
				<div style = "justify-content: space-around;" class = "linkHeader">
				<a  onclick="location.href='../reg.php'"href="#" class = "btnHeader">Войти</a>
				<?php session_start(); ?>
				<div onclick="location.href='../profile.php'">
					<img <?php echo 'src = "./images/avatars/' . $_SESSION['avatar'] . '"' ?> class = "profile">
				</div>  
			</div>

			</div>
        </ul>
	</header>
