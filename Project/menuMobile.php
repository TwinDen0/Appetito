<head>
		<link href = "style/styleMenu.css" rel = "stylesheet" type = "text/css"/>
</head>

<script>
	function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
}
</script>


<img class = "menu800" src="images/profile/menu2-02.png">

<div onclick="myFunction()" class="dropbtn"></div>
		<div id="myDropdown" class="dropdown-content">
			<a onclick="location.href='./index.php'" class = "textMenu" href="#">Главная</a>
			<div class = "splitHorizontal"></div>

			<?php if ($_SESSION['auth'] == false){?>
				<a onclick="location.href='./login.php'" class = "textMenu" href="#">Вход</a>
				<div class = "splitHorizontal"></div>
				<a onclick="location.href='./registration.php'" class = "textMenu" href="#">Регистрация</a>
			<?php 
				} else {
				?>
					<a onclick="location.href='./profile.php'" class = "textMenu" href="#">Профиль</a>
			<?php
			};
			?>

			<div class = "splitHorizontal"></div>
			<a onclick="location.href='./addrecipe.php'" class = "textMenu" href="#">Добавить свой рецепт</a>
			<div class = "splitHorizontal"></div>
			<a onclick="location.href='./inventory.php'" class = "textMenu" href="#">Инвентарь</a>
			<div class = "splitHorizontal"></div>
			<a onclick="location.href='./allrecipe.php'" class = "textMenu" href="#">Все рецепты</a>
			<div class = "splitHorizontal"></div>
			<a onclick="location.href='./searchRecipe.php'" class = "textMenu" href="#">Найти рецепт</a>
			<div class = "splitHorizontal"></div>
			<a onclick="location.href='./shoppingList.php'" class = "textMenu"href="#">Список покупок</a>

			<?php if ($_SESSION['auth'] == false){?>
				
			<?php 
				} else {
				?>
				<div class = "splitHorizontal"></div>
					<a onclick="location.href='./exit.php'" class = "textMenu" href="#">Выход</a>
			<?php
			};
			?>

		</div>