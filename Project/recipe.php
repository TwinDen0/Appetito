<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width">
		<title>Рецепт</title>
		<link href = "style/styleRecipe.css" rel = "stylesheet" type = "text/css"/>
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
		<script type="text/javascript" src="../scripts/elementUpdate.js"></script>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&&display=swap" rel="stylesheet">
	</head>

 	<header>
		<?php
		include 'header.php';
		?>
    </header>

    <body>

	<div class = "wapper"></div>

				<div id='phpCode'>
        <div class = "main">
					<?php
						include 'connect.php';
						session_start();
						$mail = $_SESSION['mail'];
						$id = $_GET['id'];

						$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`='$id'");
						$recipe = mysqli_fetch_assoc($query);

						$time =  $recipe['time'];
						$hours = intdiv($time,60);
						if($hours < 1) $hours = '00';
						if($hours > 0 && $hours < 10) $hours = '0'.$hours;
						$minutes = $time % 60;
						if($minutes > 1 && $minutes < 10) $minutes = '0'.$minutes;

						echo '
							<div class = "mainPhotoRecipe" style="background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover;"></div>
	            <div class = "header">' . $recipe['name'] . '</div>
	            <div class = "description">' . $recipe['description'] . '</div>
	            <div class = "Line">
	                <div class = "onLine">
	                    <div class = "textOnLine">Время приготовления: ' . $hours . ':' . $minutes . '</div>
	                    <div class = "textOnLine">Вид кухни: ' . $recipe['kitchen'] . '</div>
	                </div>
	            </div>
						';
					?>

            <div class = "subheader">Ингредиенты:</div>
            <div class = "box">
                <div class = "boxScroll">
									<?php
										$quantityIngredientsFromDB = $recipe['quantityIngredients'];
										$quantityIngredients = array();
										$quanIng = '';
										for($i = 0; $i < strlen($quantityIngredientsFromDB); $i++){
											if($quantityIngredientsFromDB[$i]!=","){
												$quanIng = $quanIng.$quantityIngredientsFromDB[$i];
											}
											if($quantityIngredientsFromDB[$i]=="," && $quanIng){
												$quantityIngredients[count($quantityIngredients)] = $quanIng;
												$quanIng = '';
											}
										}
										$ingredientsFromDB = $recipe['ingredients'];
										$ingredients = array();
										$ing = '';
										for($i = 0; $i < strlen($ingredientsFromDB); $i++){
											if($ingredientsFromDB[$i]!=","){
												$ing = $ing.$ingredientsFromDB[$i];
											}
											if($ingredientsFromDB[$i]=="," && $ing){
												$ingredients[count($ingredients)] = $ing;
												$ing = '';
											}
										}
										for($i = 0; $i < count($ingredients); $i++){
											$query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `id`='$ingredients[$i]'");
											$ingredient = mysqli_fetch_assoc($query);
											echo '
											<div class = "flex">
												<div class = "foodImadge" style="background: url(./images/ingredients/' . $ingredient['image'] . ') no-repeat center center; background-size: cover;"></div>
												<div class = "foodName">' . $ingredient['name'] . ' - ' . $quantityIngredients[$i] . ' кг </div>
											</div>

											';
										}
									 ?>
                </div>
            </div>

            <div class = "addFoodBox">
							<?php echo '<button class = "addFood" onclick="AddIngredients(' . $id . ');">Добавить ингредиенты в список покупок</button>' ?>
            </div>

            <div class = "backgroundInventory">
                <div class = "subheader">Кухонные принадлежности:</div>
                <div class = "box">
                    <div class = "boxScroll">
											<?php
												$inventory = $recipe['inventory'];
												$inv = '';
												for($i = 0; $i < strlen($inventory); $i++){
													if($inventory[$i]!=","){
														$inv = $inv.$inventory[$i];
													}
													if($inventory[$i]=="," && $inv){
														$query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `id`='$inv'");
														$inventor = mysqli_fetch_assoc($query);
														echo '

														<div class = "flex">
															<div class = "foodImadge" style="background: url(./images/inventory/' . $inventor['image'] . ') no-repeat center center; background-size: cover;"></div>
															<div class = "foodName"> ' . $inventor['name'] . '  </div>
														</div>
														';
														$inv = '';
													}
												}
											 ?>
                    </div>
                </div>
            </div>

            <div class = "subheader">Пошаговая инструкция:</div>
						<?php
							$steps =  $recipe['steps'];
							$step = '';
							$des = '';
							$number = 1;
							for($i = 0; $i < strlen($steps); $i++){
								if($steps[$i]!="$"){
									$des = $des.$steps[$i];
								}
								if($steps[$i]=="$" && $des){
									$numberStep = $number % 2 + 1;
									echo '<div class = "descriptionBox' . $numberStep . '">';
											echo '<div class = "descriptionText">
													<div class = "descriptionHeading">Шаг ' . $number . '</div>
													<div class = "descriptionRecipe">' . $des . '</div>
											</div>';
											echo '<div class = "descriptionImg" style = "background: url(./images/recipes/'.$recipe['id'].'-'.$number.'.jpg'.') no-repeat center center; background-size: cover;"></div>';
									echo '</div>';
									$number += 1;
									$step = '';
									$des = '';
								}
							}
						?>


            <div class = "lineEnd">Приятного аппетита!</div>

            <div class = "fidback">
			<div class = "subheader">Комментарии:</div>

							<div class = "flexFidback">
								<?php session_start(); ?>
								<div class = "formAva" <?php echo 'style = "background: url(./images/avatars/' . $_SESSION['avatar'] . ') no-repeat center center; background-size: cover;"' ?>></div>
								<form action="../php/sendReview.php" class = "formFidback">
										<?php echo '<input name="id" value="'.$id.'" style="display:none;">'; ?>
										<textarea type="text" name="text" placeholder="Ваш комментарий..." class = "textarea"></textarea>
										<input class = "sendMes" type="submit" value="Отправить">
								</form>
							</div>


								<?php
									$reviews =  $recipe['reviews'];
									if (!$reviews) echo 'Пока пусто';
									$mailRev = '';
									$rev = '';
									$mailOrRev = 1;
									for($i = 0; $i < strlen($reviews); $i++){
										if($reviews[$i]!="$" && $mailOrRev == 1){
											$mailRev = $mailRev.$reviews[$i];
										}
										if($reviews[$i]=="$" && $mailOrRev == 1){
											$mailOrRev = 2;
										}
										if($reviews[$i]!="$" && $mailOrRev == 2){
											$rev = $rev.$reviews[$i];
										}
										if($reviews[$i]=="$" && $rev){
											$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail`='$mailRev'");
											$user = mysqli_fetch_assoc($query);
											echo '
											<div class = "allfidbackForm">
												<div class = "avatar" style="background: url(./images/avatars/' . $user['avatar'] . ') no-repeat center center; background-size: cover;"></div>
												<div class = "fidbackForm">
													<div class = "userName">' . $user['name'] . '</div>
													<div class = "messenger">' . $rev . '</div>
												</div>
											</div>';
											$mailRev = '';
											$rev = '';
											$mailOrRev = 1;
										}
									}
								?>
            </div>
        </div>
					<?php
						if($_GET['GoToShoppingList']){
							include 'connect.php';
							session_start();
							$mail = $_SESSION['mail'];
							$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
							$shoppingList = mysqli_fetch_assoc($query);
							$shoppingList = $shoppingList['ShoppingList'];
							for($i = 0; $i < count($ingredients); $i++){
								$shoppingList = str_replace(",". $ingredients[$i] ."-".$quantityIngredients[$i]."," , '' , $shoppingList);
								$shoppingList = $shoppingList.",". $ingredients[$i] ."-".$quantityIngredients[$i].",";
							}
							mysqli_query($conn, "UPDATE `users` SET `ShoppingList` = '$shoppingList' WHERE `mail` = '$mail'");
						}
					 ?>
				</div>
				<script>
					function AddIngredients(id){
						window.history.replaceState('1', 'Title', '?id='+id+'&GoToShoppingList=1');
				    elementUpdate('#phpCode');
						alert("Продукты успешно добавленны в ваш список покупок!");
					}
				</script>


				<?php
					include 'menuMobile.php';
					?>

    </body>
