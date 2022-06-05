<?php
session_start();
$SelectedIng = '';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
		<meta http-equiv="imagetoolbar" content="no" />
        <meta name = "viewport" content = "width=device-width">
		<title>Все рецепты</title>
		<link href = "style/styleAllRecipe.css" rel = "stylesheet" type = "text/css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&&display=swap" rel="stylesheet">
	</head>

<?php include 'header.php'; ?>

<body>
	<?php
		include 'connect.php';
		session_start();
		$mail = $_SESSION['mail'];
		$sort = $_GET['sort'];
		$category = $_GET['category'];

		$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
		$selectedIngredientInSearch = mysqli_fetch_assoc($query);
		$selectedIngredientInSearch = $selectedIngredientInSearch['SelectedIngredientInSearch'];
	?>


	<div class = "recipe">
		<div class = "upeerText">
			<div class = "headingFilter">Все рецепты:</div>
		</div>

<!-- рецепты-->
				<div id = "recipeB" class = "box" style = " padding: 1%;
															border-radius: 20px;
															display: flex;
															background-color: #fffcf4;
															filter: drop-shadow(0px 0px 5px rgba(184, 175, 143, 0.5));
				">
					<div class="select">
						<select name="sortRecipes" id="sortRecipes">
							<?php $sortRecipes = $_GET['sortRecipes']; ?>

							<option value="0" <?php if($sortRecipes!="0") echo 'selected="selected"' ?>>По алфавиту</option>
							<option value="1" <?php if($sortRecipes=="1") echo 'selected="selected"' ?>>По популярности</option>
							<option value="2" <?php if($sortRecipes=="2") echo 'selected="selected"' ?>>По времени приготовления</option>
							<option value="3" <?php if($sortRecipes=="3") echo 'selected="selected"' ?>>По каллорийности</option>
							<option value="4" <?php if($sortRecipes=="4") echo 'selected="selected"' ?>>По цене</option>
							<option value="5" <?php if($sortRecipes=="5") echo 'selected="selected"' ?>>По дате добавления</option>
						</select>
					</div>


					<div class="select">
						<select name="sortKitchen" id="sortKitchen">
							<?php $kitchen = $_GET['kitchen']; ?>
							<option value="Любое" <?php echo 'selected="selected"' ?>>Любое</option>
							<option value="Другое" <?php if($kitchen=="Другое") echo 'selected="selected"' ?>>Другое</option>
							<option value="Завтрак" <?php if($kitchen=="Завтрак") echo 'selected="selected"' ?>>Завтрак</option>
							<option value="Первые блюда" <?php if($kitchen=="Первые блюда") echo 'selected="selected"' ?>>Первые блюда</option>
							<option value="Вторые блюда" <?php if($kitchen=="Вторые блюда") echo 'selected="selected"' ?>>Вторые блюда</option>
							<option value="Закуски" <?php if($kitchen=="Закузки") echo 'selected="selected"' ?>>Закуски</option>
							<option value="Салаты" <?php if($kitchen=="Салаты") echo 'selected="selected"' ?>>Салаты</option>
							<option value="Соусы, кремы" <?php if($kitchen=="Соусы, кремы") echo 'selected="selected"' ?>>Соусы, кремы</option>
							<option value="Напитки" <?php if($kitchen=="Напитки") echo 'selected="selected"' ?>>Напитки</option>
							<option value="Десерты" <?php if($kitchen=="Десерты") echo 'selected="selected"' ?>>Десерты</option>
							<option value="Выпечка" <?php if($kitchen=="Выпечка") echo 'selected="selected"' ?>>Выпечка</option>
							<option value="Торты" <?php if($kitchen=="Торты") echo 'selected="selected"' ?>>Торты</option>
						</select>
					</div>

					<div class="addSearchSringBlock">
						<input class="addSearchSring" type="text" placeholder="Поиск..." id="inputSearch">
						<div class="search-btn"></div>
						<script>
							function search() {
								let input = document.getElementById("inputSearch");
								let filter = input.value.toUpperCase();
								let ul = document.getElementById("recipe");
								let ing = ul.getElementsByTagName("ing");

								// Перебирайте все элементы списка и скрывайте те, которые не соответствуют поисковому запросу
								for (let i = 0; i < ing.length; i++) {
										let a = ing[i].getElementsByTagName("a")[0];
										if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
												ing[i].style.display = "";
										} else {
												ing[i].style.display = "none";
										}
								}
							}
							document.addEventListener('keyup', search);
						</script>
					</div>
				</div>

			<div class="allbox">
				<div class = "boxRecipe" id="recipe">
					<?php
						switch($sortRecipes){
							case "0":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `name`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `name`");
								break;
							case "1":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `likes` DESC");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `likes` DESC");
								break;
							case "2":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `time`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `time`");
								break;
							case "3":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `calories`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `calories`");
								break;
							case "4":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `price`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `price`");
								break;
							case "5":
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `id`");
								break;
							default :
								if($kitchen=="Любое" || $kitchen=="")
									$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `name`");
								else
									$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `kitchen` = '$kitchen' ORDER BY `name`");
								break;
						}
						while($recipe = mysqli_fetch_assoc($query)){
								$time =  $recipe['time'];
								$hours = intdiv($time,60);
								if($hours < 1) $hours = '00';
								if($hours > 0 && $hours < 10) $hours = '0'.$hours;
								$minutes = $time % 60;
								if($minutes > 1 && $minutes < 10) $minutes = '0'.$minutes;
								if($recipe['confirmed']==1) echo '
								<ing>
                  					<div onmouseover = "hoverOnRecipe ('.$recipe['id'].')" onmouseout = "hoverOffRecipe ('.$recipe['id'].')" id = "recipeReady'.$recipe['id'].'" class = "recipeReady" style="display:flex;" onclick="GoToRecipe(' . $recipe['id'] . ')">
										<div class = "recipeReady_img" id = "recipe__img'.$recipe['id'].'" style="background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover;"> </div>

										<div id = "recipe__description'.$recipe['id'].'" class = "recipe__description"> ' . $recipe['description'] . ' </div>

										<div class = "recipeReady_descript" id = "recipe__parameter'.$recipe['id'].'">
											<div> <a>' . $recipe['name'] . '</a> </div>
											<div> Время приготовления: ' . $hours . ':' . $minutes . '</div>
											<div> Каллорийность: ' . $recipe['calories'] . '</div>
											<div> Стоимость: ' . $recipe['price'] . '</div>
											<div> Лайков: ' . $recipe['likes'] . '</div>
										</div>
									</div>
								</ing>';
							}

					?>
				</div>
				<script src="scripts/price.js"></script>
			</div>
		</div>
		</div>
		</div>
		<script>

		let sortRecipes=document.getElementById('sortRecipes');
		let sortKitchen=document.getElementById('sortKitchen');

		sortRecipes.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
		    window.history.replaceState('1', 'Title', '?sortRecipes='+sortRecipes.value+'&kitchen='+sortKitchen.value);
		    elementUpdate('#recipe');
		});

		sortKitchen.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
		    window.history.replaceState('1', 'Title', '?kitchen='+sortKitchen.value+'&sortRecipes='+sortRecipes.value);
		    elementUpdate('#recipe');
		});

		function GoToRecipe(id){
			location.href = "./recipe.php?id=" + id;
		}
		async function elementUpdate(selector) {
			try {
			var html = await (await fetch(location.href)).text();
			var newdoc = new DOMParser().parseFromString(html, 'text/html');
			document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
			console.log('Элемент '+selector+' был успешно обновлен');
			return true;
			} catch(err) {
			console.log('При обновлении элемента '+selector+' произошла ошибка:');
			console.dir(err);
			return false;
			}
		}
		</script>

		<?php
        include 'menuMobile.php';
        ?>

    </body>
</html>
