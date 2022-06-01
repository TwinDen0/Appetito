<?php
$SelectedIng = '';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
		<meta http-equiv="imagetoolbar" content="no" />
        <meta name = "viewport" content = "width=device-width">
		<title>Поиск рецепта</title>
		<link href = "style/styleSearch.css" rel = "stylesheet" type = "text/css"/>
	</head>


	<?php
	include 'header.php';
    ?>

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

		<div class = "main800" style="display: flex">
			<div class = "ingredients">
				<div class = "upeerText">
					<div class = "headingFilter">Фильтры для поиска рецептов:</div>
				</div>


				<div class = "boxFilter">
					<div class = "upTextFilter">
						<div class = "upTextFilter_1">Подобрать на основе ваших</div>
						
						<label class="checkbox_reg">
							<input type="checkbox" required/>
							<div class="checkbox__checkmark" >
							</div>
							<div  id = "er" class="checkbox__body" onclick="location.href='../inventory.php'">
								кухонных принадлежностей
							</div>
						</label>
					</div>

					
					<div class="values">
						<div class = "val">Подходящая цена:</div>
						<span id="range1">
							0
						</span>
						<span >
							₽
						</span>
						<span> &dash; </span>
						<span id="range2">
							5000
						</span>
						<span >
							₽
						</span>
					</div>

					<div class="container">
						<div class="slider-track"></div>
						<input type="range" min="0" max="5000" value="1500" id="slider-1" oninput="slideOne()">
						<input type="range" min="0" max="5000" value="3000" id="slider-2" oninput="slideTwo()">
					</div>
					<script src="scripts/price.js"></script>



					<div class = "choice">
						<div class = "choiceText">Выбери продкуты:</div>
						<!-- Количоство выбранных ингредиентов -->
						<div class = "choiceSelect">Выбранно <?php echo substr_count($selectedIngredientInSearch, ',')/2; ?></div>
						

						<label class="checkbox_choice">
							<input type="checkbox" name="selectIngredients" value="+" id="onlySelect" required/>
							<div class="checkbox__checkmark_choice">
							</div>
						</label>


					</div>
					
					<!-- Выбор категорий -->
					<div class = "boxIngredient">
						<div class = "textCut">категория:</div>
						<div class = "boxScroll" id = "boxScroll">
							<img src="images/category/all.png" class = "categoryImage"  title="Все продукты" onclick="ClickCategory('');">
							<img src="images/category/mushroom.png" class = "categoryImage" title="Грибы" onclick="ClickCategory('Грибы');">
							<img src="images/category/milk.png" class = "categoryImage" title="Молочные продукты" onclick="ClickCategory('Молочное');">
							<img src="images/category/groats.png" class = "categoryImage" title="Крупы и злаки" onclick="ClickCategory('Крупыизлаки');">
							<img src="images/category/pasta.png"" class = "categoryImage" title="Макароны" onclick="ClickCategory('Макароны');">
							<img src="images/category/oil.png" class = "categoryImage" title="Масла" onclick="ClickCategory('Маслорастительное');">
							<img src="images/category/bobs.png" class = "categoryImage" title="Бобовые" onclick="ClickCategory('Бобовые');">
							<img src="images/category/jam.png" class = "categoryImage" title="Джемы" onclick="ClickCategory('Джемы');">
							<img src="images/category/chicken.png" class = "categoryImage" title="Птица" onclick="ClickCategory('Птица');">
							<img src="images/category/fish.png" class = "categoryImage" title="Рыба и морепродуты" onclick="ClickCategory('Рыбаиморепродукты');">
							<img src="images/category/egg.png" class = "categoryImage" title="Яйца" onclick="ClickCategory('Яйца');">
							<img src="images/category/flour.png" class = "categoryImage" title="Мука" onclick="ClickCategory('Мука');">
							<img src="images/category/bread.png" class =  "categoryImage" title="Мучное" onclick="ClickCategory('Хлеб');">
							<img src="images/category/meat.png" class = "categoryImage" title="Мясо" onclick="ClickCategory('Мясо');">
							<img src="images/category/carrot.png" class = "categoryImage" title="Овощи" onclick="ClickCategory('Овощи');">
							<img src="images/category/nut.png" class = "categoryImage" title="Орехи" onclick="ClickCategory('Орехи');">
							<img src="images/category/sauce.png" class = "categoryImage" title="Соусы" onclick="ClickCategory('Соусы');">
							<img src="images/category/spices.png" class = "categoryImage" title="Специи" onclick="">
							<img src="images/category/cheese.png" class = "categoryImage" title="Сыры" onclick="ClickCategory('Сыры');">
							<img src="images/category/apple.png" class = "categoryImage" title="Фрукты" onclick="ClickCategory('Фрукты');">
							<img src="images/category/blackberry.png" class = "categoryImage" title="Ягоды" onclick="ClickCategory('Ягоды');">
							<img src="images/category/green.png" class = "categoryImage" title="Зелень" onclick="ClickCategory('Зелень');">
						</div>
					</div>

					<div class = "search_Box">
						<div class="select">
							<select name="sort" id="sort">
								<?php $sort = $_GET['sort']; ?>
									<option value="0" <?php if($sort!="0") echo 'selected="selected"' ?>>По алфавиту</option>
									<option value="1" <?php if($sort=="1") echo 'selected="selected"' ?>>По возрастанию стоимости</option>
									<option value="2" <?php if($sort=="2") echo 'selected="selected"' ?>>По убыванию стоимости</option>
									<option value="3" <?php if($sort=="3") echo 'selected="selected"' ?>>По дате добавления</option>
							</select>
						</div>

					<!-- Сортировки добавленные из css сторонних -->
						<div class = "box">
							<div class="addSearchSringBlock" style = "height: 40px;">
								<input class="addSearchSring" type="text" placeholder="Поиск..." id="inputSearch">
								<div class="search-btn"></div>
								<script>
									function search() {
										let input = document.getElementById("inputSearch");
										let filter = input.value.toUpperCase();
										let ul = document.getElementById("selectionBox");
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
					</div>
					

					
				

				<div class = "selectoinBox" id="selectionBox">
					<?php
						if($_GET['selectAdd']){
							$id = $_GET['selectAdd'];
							if(!strstr($selectedIngredientInSearch, ",".$id.",")){
								$selectedIngredientInSearch = $selectedIngredientInSearch.",".$id.",";
								mysqli_query($conn, "UPDATE `users` SET `SelectedIngredientInSearch` = '$selectedIngredientInSearch' WHERE `mail` = '$mail'");
							}
						}

						if($_GET['selectDelete']){
							$id = $_GET['selectDelete'];
							$selectedIngredientInSearch = str_replace(",".$id."," , '' , $selectedIngredientInSearch);
							mysqli_query($conn, "UPDATE `users` SET `SelectedIngredientInSearch` = '$selectedIngredientInSearch' WHERE `mail` = '$mail'");
						}
					?>
					<!-- Продукты-->
					<div class = "boxFood" id = "boxFood">
						<?php
							switch($sort){
								case "0":
									if($category)
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `category`='$category' ORDER BY `name`");
									else
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `name`");
									break;
								case "1":
									if($category)
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `category`='$category' ORDER BY `price`");
									else
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `price`");
									break;
								case "2":
									if($category)
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `category`='$category' ORDER BY `price` DESC");
									else
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `price` DESC");
									break;
								case "3":
									if($category)
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `category`='$category' ORDER BY `id` DESC");
									else
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `id` DESC");
									break;
								default :
									if($category)
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `category`='$category' ORDER BY `name`");
									else
									$query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `name`");
									break;
							}

							while($row = mysqli_fetch_assoc($query)){
								$idIngredient = ",".$row['id'].",";
							if($_GET['onlySelect'] == 'v' && strstr($selectedIngredientInSearch, $idIngredient)){
									echo
									'<ing><div class="productBox">
									 	<div class = "foodImage" style = "background: url(./images/ingredients/' . $row['image'] . ') no-repeat center center; background-size: cover;" onclick="ClickIngredient(' . $row['id'] . ');" id="ingredient' . $row['id'] . '">';
									if(strstr($selectedIngredientInSearch, $idIngredient)) echo '
									<img src="images/галочка.png" class = "addTrue">
									'; else  echo '<img src="images/no.png" class = "addTrue">';
									echo '<div class = "nameFood"> <a>' . $row['name'] . '</a></div>
									</div></div></ing>';
								}
								if($_GET['onlySelect'] == '-' || !$_GET['onlySelect']){
									echo
									'<ing><div class="productBox">
										 <div class = "foodImage" style = "background: url(./images/ingredients/' . $row['image'] . ') no-repeat center center; background-size: cover;" onclick="ClickIngredient(' . $row['id'] . ');" id="ingredient' . $row['id'] . '">';
									if(strstr($selectedIngredientInSearch, $idIngredient)) echo '
									<img id="ingredientImg' . $row['id'] . '" src="images/галочка.png" class = "addTrue">
									'; else  echo '<img id="ingredientImg' . $row['id'] . '" src="images/no.png" class = "addTrue">';
									echo '<div class = "nameFood"> <a>' . $row['name'] . '</a></div>
									</div></div></ing>';
								}
							};
						?>
					</div>
				</div>
			</div>
		</div>
	

			<div class = "recipe">
				<div class = "upeerText">
					<div id = "headingFil" class = "headingFilter">Подходящие рецепты:</div>
				</div>
				
<!-- рецепты-->
				<div id = "recipeB" class = "box" style = "display:flex;">
					<div class="select">
							<select name="sort" id="sortRecipes">
								<?php $sortRecipes = $_GET['sortRecipes']; ?>
									<option value="0" <?php if($sortRecipes!="0") echo 'selected="selected"' ?>>По алфавиту</option>
									<option value="1" <?php if($sortRecipes=="1") echo 'selected="selected"' ?>>По популярности</option>
									<option value="2" <?php if($sortRecipes=="2") echo 'selected="selected"' ?>>По времени приготовления</option>
									<option value="3" <?php if($sortRecipes=="3") echo 'selected="selected"' ?>>По каллорийности</option>
									<option value="4" <?php if($sortRecipes=="4") echo 'selected="selected"' ?>>По цене</option>
									<option value="5" <?php if($sortRecipes=="5") echo 'selected="selected"' ?>>По дате добовления</option>
							</select>
					</div>
					<label class="checkbox_reg">
							<input type="checkbox" name="selectIngredients" value="1" id="extra">
							<div class="checkbox__checkmark" id = "left">
							</div>
							<div class="checkbox__bodyProd">
								 С недостающими продуктами
							</div>
					</label>
				</div>
				<div class = "boxRecipe" id="recipe">
					<?php
						$extra = $_GET['extra'];
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
							$recipesInventory = $recipe['inventory'];
							$recipesIngredients = $recipe['ingredients'];
							$inv = '';
							$ing = '';
							for($i = 0; $i < strlen($selectedIngredientInSearch); $i++){
								if($selectedIngredientInSearch[$i]!=","){
									$ing = $ing.$selectedIngredientInSearch[$i];
								}
								if($selectedIngredientInSearch[$i]=="," && $ing){
									$recipesIngredients = str_replace(",".$ing."," , '' , $recipesIngredients);
									$ing = '';
								}
							}
							for($i = 0; $i < strlen($myInventory); $i++){
								if($myInventory[$i]!=","){
									$inv = $inv.$myInventory[$i];
								}
								if($myInventory[$i]=="," && $inv){
									$recipesInventory = str_replace(",".$inv."," , '' , $recipesInventory);
									$inv = '';
								}
							}
							if((!$recipesIngredients && !$recipesInventory)||
							($extra=='1' && substr_count($recipesIngredients, ',')/2 <= 4 && substr_count($recipesInventory, ',')/2 <= 4)){
								$time =  $recipe['time'];
								$hours = intdiv($time,60);
								if($hours < 1) $hours = '00';
								if($hours > 0 && $hours < 10) $hours = '0'.$hours;
								$minutes = $time % 60;
								if($minutes > 1 && $minutes < 10) $minutes = '0'.$minutes;
								echo '
									<div onmouseover = "hoverOnRecipe ('.$recipe['id'].')" onmouseout = "hoverOffRecipe ('.$recipe['id'].')" id = "recipeReady'.$recipe['id'].'" class = "recipeReady" style="display:flex;" onclick="GoToRecipe(' . $recipe['id'] . ')">
										<div class = "recipeReady_img" id = "recipe__img'.$recipe['id'].'" style="background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover;"></div>
					
										<div id = "recipe__description'.$recipe['id'].'" class = "recipe__description"> ' . $recipe['description'] . ' </div>

										<div class = "recipeReady_descript" id = "recipe__parameter'.$recipe['id'].'">
											<div> ' . $recipe['name'] . '</div>
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
								';
							}
						}
					?>
				</div>
				</div>
						
			</div>
		</div>
		<script>
		  let category = '';
		  let el=document.querySelector('#sort');
		  el.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
		    window.history.replaceState('1', 'Title', '?sort='+el.value+'&category='+category+'&sortRecipes='+sortRecipes.value+'&onlySelect='+valueOnlySelect+'&extra='+extraRecipes);
				localStorage.setItem('boxFood', 0);
		    elementUpdate('#selectionBox');
		  });
			let sortRecipes=document.querySelector('#sortRecipes');
		  sortRecipes.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
		    window.history.replaceState('1', 'Title', '?sort='+el.value+'&category='+category+'&onlySelect='+valueOnlySelect+'&sortRecipes='+sortRecipes.value+'&extra='+extraRecipes);
		    elementUpdate('#recipe');
		  });
			let onlySelect=document.querySelector('#onlySelect');
			let valueOnlySelect = '-';
		  onlySelect.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
				if (onlySelect.checked) valueOnlySelect = 'v'; else valueOnlySelect = '-';
				window.history.replaceState('1', 'Title', '?sort='+el.value+'&category='+category+'&sortRecipes='+sortRecipes.value+'&onlySelect='+valueOnlySelect+'&extra='+extraRecipes);
				localStorage.setItem('boxFood', 0);
		    elementUpdate('#selectionBox');
		  });
			let extra=document.querySelector('#extra');
			let extraRecipes = '0';
		  extra.addEventListener('change', function(){
		    //location.href = "//project/ingentory.php?sort=" + el.value;
				if (extra.checked) extraRecipes = '1'; else extraRecipes = '0';
				window.history.replaceState('1', 'Title', '?sort='+el.value+'&category='+category+'&sortRecipes='+sortRecipes.value+'&extra='+extraRecipes);
		    elementUpdate('#recipe');
		  });
		  function ClickCategory(categ){
		    window.history.replaceState('1', 'Title', '?category='+categ+'&sort='+el.value+'&sortRecipes='+sortRecipes.value+'&onlySelect='+valueOnlySelect+'&extra='+extraRecipes);
		    category = categ;
				localStorage.setItem('boxFood', 0);
		    elementUpdate('#selectionBox');
		  }
			function ClickIngredient(id){

				let ingredient = document.querySelector('#ingredientImg'+id);
				if(ingredient.src == 'http://project/images/no.png')
					window.history.replaceState('1', 'Title', '?category='+category+'&sort='+el.value+'&sortRecipes='+sortRecipes.value+'&onlySelect='+valueOnlySelect+'&selectAdd='+id+'&extra='+extraRecipes);
				else
					window.history.replaceState('1', 'Title', '?category='+category+'&sort='+el.value+'&sortRecipes='+sortRecipes.value+'&onlySelect='+valueOnlySelect+'&selectDelete='+id+'&extra='+extraRecipes);
				console.log(ingredient.src);
					let boxFood = document.querySelector('#boxFood');
				localStorage.setItem('boxFood', boxFood.scrollTop);
		    	elementUpdate('#selectionBox');
				elementUpdate('#recipe');
		  }
			function GoToInventory(){
				location.href = "http://project/inventory.php";
			}
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


			(function() {
					function scrollHorizontally1(e) {
							e = window.event || e;
							var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
							document.getElementById('boxScroll').scrollLeft += (delta * 70); // Multiplied by 40
							e.preventDefault();
					}
					if (document.getElementById('boxScroll').addEventListener) {
							// IE9, Chrome, Safari, Opera
							document.getElementById('boxScroll').addEventListener('mousewheel', scrollHorizontally1, false);
							// Firefox
							document.getElementById('boxScroll').addEventListener('DOMMouseScroll', scrollHorizontally1, false);
					} else {
							// IE 6/7/8
							document.getElementById('boxScroll').attachEvent('onmousewheel', scrollHorizontally1);
					}
				})();
		</script>

		<?php
        include 'menuMobile.php';
        ?>

    </body>
</html>
