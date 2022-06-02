<?php
session_start();
include 'connect.php';

$mail = $_SESSION['mail'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail`='$mail'");
$user = mysqli_fetch_assoc($query);
$id = $user['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Личный кабинет</title>
		<link href = "style/styleProfile.css" rel = "stylesheet" type = "text/css"/>
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
		<link href = "style/styleMenu.css" rel = "stylesheet" type = "text/css"/>
		<link href = "style/addFile.css" rel = "stylesheet" type = "text/css"/>
		<script src="scripts/script.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
	</head>

	<?php
	include 'header.php';
    ?>

    <body>

		<div id="massage" class="ava_massage">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			<form action="../php/avatar.php" class="ava_ava_add" method="post" enctype="multipart/form-data">
			<label class = "heading_add">Изображение профиля</label>

			<div class="ava_input__wrapper">
				<input  type="file" name="avatar" id="input__file" class="ava_input ava_input__file" multiple>
				<label for="input__file" class="ava_input__file-button">
					<span class="ava_input__file-icon-wrapper">
					<img class="ava_input__file-icon" src="images/profile/add.png" alt="Выбрать файл" width="25"></span>
					<span class="ava_input__file-button-text">Выберите файл</span>
				</label>
			</div>

			<button type="submit" class = "ava_add">Добавить</button>
			</form>
		</div>

		<div id="replaceName" class="ava_massage">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	    <form action="../php/replaceName.php" class="ava_ava_add" method="post" enctype="multipart/form-data">
        <label class = "heading_add">Новое имя</label>

        <div class="ava_input__wrapper">
          <input maxlength="10" type="text" name="name" id="input__file" class="input__file" multiple>
        </div>
        <button type="submit" class = "ava_add">Изменить</button>
	    </form>
		</div>

		<div class = "wapper"></div>

		<img class = "wapper800" src="images/profile/fon800.png">
		<img class = "fonUp800" src="images/profile/fonUp.png">
		
		

			<img class = "img" src="images/profile/inform.png">

			<div class = "textInfomation">
				<div class = "userName"><?php echo $_SESSION['name']; ?>
					<img src = "images/profile/pencil.png" class = "edit" onclick="document.getElementById('replaceName').style.display = 'flex';">
				</div>
				<but class="button_add_recipe" onclick="GoToAddRecipe();">
					<div class="add_recipe">Добавить свой рецепт</div>
					<div class="add_recipe_background"></div>
				</div>
			</div>

			<div class = "information800">
				<button class = "edit800" value="Редактировать" onclick="document.getElementById('replaceName').style.display = 'flex';">Изменить имя</button>
				<div class = "textInfomation">
					<div class = "userName"><?php echo $_SESSION['name']; ?></div>
				</div>

				<div class = "boxFire" id ="ava800">
				<img src="images/profile/ava_fon.png" class = "fonAva">
				<div class="avatar">
					<div class="boxAva" <?php echo 'style = "background: url(./images/avatars/' . $_SESSION['avatar'] . ') no-repeat center center; background-size: cover;"' ?> onclick="document.getElementById('massage').style.display = 'flex';"></div>
				</div>
			</div>

			</div>

			<div class = "boxFire" id = "ava_desktop">
				<img src="images/profile/ava_fon.png" class = "fonAva">
				<div class="avatar">
					<div class="boxAva" <?php echo 'style = "background: url(./images/avatars/' . $_SESSION['avatar'] . ') no-repeat center center; background-size: cover;"' ?> onclick="document.getElementById('massage').style.display = 'flex';"></div>
				</div>
			</div>

			<div class = "recipe">
				<div class = "heading">Избранные рецепты:</div>
				<div class = "listDesktop">
					<div class = "recipeList" id="favoriteRecipeList">
						<?php
						$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$id'");
						$favoriteRecipes = mysqli_fetch_assoc($query);
						$favoriteRecipes = $favoriteRecipes['favoriteRecipes'];
						$inv = '';
						for($i = 0; $i < strlen($favoriteRecipes); $i++){
							if($favoriteRecipes[$i]!=","){
								$rec = $rec.$favoriteRecipes[$i];
							}
							if($favoriteRecipes[$i]=="," && $rec){
								$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`='$rec'");
								$recipe = mysqli_fetch_assoc($query);
								echo '
								<div class = "recipe_img_name">
									<div class = "recipeBox" style = "background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover; cursor:pointer;" onclick="GoToRecipe('.$recipe['id'].');"></div>
									<div class = "recipeBox_Text"><p>'.$recipe['name'].'</p></div>
								</div>';
								$rec = '';
							}
						}
						?>
					</div>
				</div>

				<div class = "heading">Мои рецепты:</div>
				<div class = "listDesktop">
					<div class = "recipeList" id="myRecipeList">
						<?php
						$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$id'");
						$myRecipes = mysqli_fetch_assoc($query);
						$myRecipes = $myRecipes['myRecipes'];
						$inv = '';
						for($i = 0; $i < strlen($myRecipes); $i++){
							if($myRecipes[$i]!=","){
								$rec = $rec.$myRecipes[$i];
							}
							if($myRecipes[$i]=="," && $rec){
								$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`='$rec'");
								$recipe = mysqli_fetch_assoc($query);
								echo '
								<div class = "recipe_img_name">
									<div class = "recipeBox" style = "background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover; cursor:pointer;" onclick="GoToRecipe('.$recipe['id'].');"></div>
									<div class = "recipeBox_Text"><p>'.$recipe['name'].'</p></div>
								</div>';
								$rec = '';
							}
						}
						?>
					</div>
				</div>
			</div>

			<div class="tabs">
				<input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
				<label class = "tabsText" for="tab-btn-1">Сохраненные рецепты</label>
				<input type="radio" name="tab-btn" id="tab-btn-2" value="">
				<label class = "tabsText" for="tab-btn-2">Мои рецепты</label>
			
				<div id="content-1" class = "list1">
				  <div class = "recipeList">
				  <?php
						$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$id'");
						$favoriteRecipes = mysqli_fetch_assoc($query);
						$favoriteRecipes = $favoriteRecipes['favoriteRecipes'];
						$inv = '';
						for($i = 0; $i < strlen($favoriteRecipes); $i++){
							if($favoriteRecipes[$i]!=","){
								$rec = $rec.$favoriteRecipes[$i];
							}
							if($favoriteRecipes[$i]=="," && $rec){
								$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`='$rec'");
								$recipe = mysqli_fetch_assoc($query);
								echo '
								<div class = "recipe_img_name">
									<div class = "recipeBox" style = "background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover; cursor:pointer;" onclick="GoToRecipe('.$recipe['id'].');"></div>
									<div class = "recipeBox_Text"><p>'.$recipe['name'].'</p></div>
								</div>';
								$rec = '';
							}
						}
						?>
				  </div>
			  </div>

				<div id="content-2" class = "list2">
					<div class = "recipeList">
					<?php
						$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$id'");
						$myRecipes = mysqli_fetch_assoc($query);
						$myRecipes = $myRecipes['myRecipes'];
						$inv = '';
						for($i = 0; $i < strlen($myRecipes); $i++){
							if($myRecipes[$i]!=","){
								$rec = $rec.$myRecipes[$i];
							}
							if($myRecipes[$i]=="," && $rec){
								$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`='$rec'");
								$recipe = mysqli_fetch_assoc($query);
								echo '
								<div class = "recipe_img_name">
									<div class = "recipeBox" style = "background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover; cursor:pointer;" onclick="GoToRecipe('.$recipe['id'].');"></div>
									<div class = "recipeBox_Text"><p>'.$recipe['name'].'</p></div>
								</div>';
								$rec = '';
							}
						}
						?>
					</div>
				</div>
			  </div>


			<script>
			(function() {
					function scrollHorizontally1(e) {
							e = window.event || e;
							var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
							document.getElementById('favoriteRecipeList').scrollLeft += (delta * 70); // Multiplied by 40
							e.preventDefault();
					}
					function scrollHorizontally2(e) {
							e = window.event || e;
							var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
							document.getElementById('myRecipeList').scrollLeft += (delta * 70); // Multiplied by 40
							e.preventDefault();
					}
					if (document.getElementById('favoriteRecipeList').addEventListener) {
							// IE9, Chrome, Safari, Opera
							document.getElementById('favoriteRecipeList').addEventListener('mousewheel', scrollHorizontally1, false);
							// Firefox
							document.getElementById('favoriteRecipeList').addEventListener('DOMMouseScroll', scrollHorizontally1, false);
					} else {
							// IE 6/7/8
							document.getElementById('favoriteRecipeList').attachEvent('onmousewheel', scrollHorizontally1);
					}
					if (document.getElementById('myRecipeList').addEventListener) {
							// IE9, Chrome, Safari, Opera
							document.getElementById('myRecipeList').addEventListener('mousewheel', scrollHorizontally2, false);
							// Firefox
							document.getElementById('myRecipeList').addEventListener('DOMMouseScroll', scrollHorizontally2, false);
					} else {
							// IE 6/7/8
							document.getElementById('myRecipeList').attachEvent('onmousewheel', scrollHorizontally2);
					}
				})();

				function GoToAddRecipe(){
					location.href = "http://project/addRecipe.php";
				}
				function GoToRecipe(id){
					location.href = "http://project/recipe.php?id=" + id;
				}
				function AddPhoto(){
					let massage = document.getElementById('massage');
					massage.style.display = 'flex';
				}
			</script>

		<?php
        include 'menuMobile.php';
        ?>
    </body>
</html>
