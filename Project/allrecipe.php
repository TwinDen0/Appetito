<?php
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
	</head>


	<?php include 'header.php'; ?>

  <body>
	<div class = "wapper"></div>
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
					<div style = "margin-top: 9%" class = "headingFilter">Все рецепты:</div>
				</div>
				
<!-- рецепты-->
				<div id = "recipeB" class = "box" style = "display:flex;">
					<div class="select">
							<select name="sortRecipes" id="sortRecipes">
								<?php
                 $sortRecipes = $_GET['sortRecipes'];
                ?>
                
									<option value="0" <?php if($sortRecipes!="0") echo 'selected="selected"' ?>>По алфавиту</option>
									<option value="1" <?php if($sortRecipes=="1") echo 'selected="selected"' ?>>По популярности</option>
									<option value="2" <?php if($sortRecipes=="2") echo 'selected="selected"' ?>>По времени приготовления</option>
									<option value="3" <?php if($sortRecipes=="3") echo 'selected="selected"' ?>>По каллорийности</option>
									<option value="4" <?php if($sortRecipes=="4") echo 'selected="selected"' ?>>По цене</option>
									<option value="5" <?php if($sortRecipes=="5") echo 'selected="selected"' ?>>По дате добовления</option>
							</select>
					</div>
          <div class="addSearchSringBlock" style = "height: 40px;">
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


				<div class = "boxRecipe" id="recipe">
					<?php
						switch($sortRecipes){
							case "0":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `name`");
								break;
							case "1":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `likes` DESC");
								break;
							case "2":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `time`");
								break;
							case "3":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `calories`");
								break;
							case "4":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `price`");
								break;
							case "5":
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id` DESC");
								break;
							default :
								$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `name`");
								break;
						}
						while($recipe = mysqli_fetch_assoc($query)){
								$time =  $recipe['time'];
								$hours = intdiv($time,60);
								if($hours < 1) $hours = '00';
								if($hours > 0 && $hours < 10) $hours = '0'.$hours;
								$minutes = $time % 60;
								if($minutes > 1 && $minutes < 10) $minutes = '0'.$minutes;
								echo '
									<ing>
                  <div class = "recipeReady" style="display:flex;" onclick="GoToRecipe(' . $recipe['id'] . ')">
										<div class = "recipeReady_img" style="background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover;"> </div>
										<div class = "recipeReady_descript">
											<div><a>' . $recipe['name'] . '</a></div>
											<div> ' . $recipe['description'] . ' </div>
											<div> Время приготовления: ' . $hours . ':' . $minutes . '</div>
											<div> Каллорийность: ' . $recipe['calories'] . '</div>
											<div> Стоимость: ' . $recipe['price'] . '</div>';
											if($extra=='1' && substr_count($recipesIngredients, ',')/2 > 0)
											echo '<div style="height:20px"> Не хватает  ингредиентов: ' . substr_count($recipesIngredients, ',')/2 . '</div>';
											if($extra=='1' && substr_count($recipesInventory, ',')/2 > 0)
											echo '<div style="height:20px"> Не хватает принадлежностей:' . substr_count($recipesInventory, ',')/2 . '</div>';
											echo'
										</div>
									</div>
                  </ing>
								';
							}
						
					?>
				</div>
				</div>

			</div>
		</div>
		<script>

			let sortRecipes=document.getElementById('sortRecipes');
		  sortRecipes.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
		    window.history.replaceState('1', 'Title', '?sortRecipes='+sortRecipes.value);
		    elementUpdate('#recipe');
		  });

			function GoToRecipe(id){
				location.href = "http://project/recipe.php?id=" + id;
			}
			async function elementUpdate(selector) {
			  try {
			    var html = await (await fetch(location.href)).text();
			    var newdoc = new DOMParser().parseFromString(html, 'text/html');
			    document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
			    console.log('Элемент '+selector+' был успешно обновлен');
					let boxFood = document.querySelector('#boxFood');
					boxFood.scrollTop = localStorage.getItem('boxFood');
			    return true;
			  } catch(err) {
			    console.log('При обновлении элемента '+selector+' произошла ошибка:');
			    console.dir(err);
			    return false;
			  }
			}
		</script>
    </body>
</html>
