<?php
session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width">
		<title>Рецепт</title>
		<link href = "style/styleRecipe.css" rel = "stylesheet" type = "text/css"/>
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
		<script type="text/javascript" src="../scripts/elementUpdate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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

		<?php
		include 'connect.php';
		session_start();
		$mail = $_SESSION['mail'];
		$id = (int) $_GET['id'];

		$query = mysqli_query($conn, "SELECT * FROM `recipes` WHERE `id`=$id");
		$recipe = mysqli_fetch_assoc($query);

		$user = $recipe['author'];
		$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail`='$user'");
		$author = mysqli_fetch_assoc($query);

	  $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
	  $user = mysqli_fetch_assoc($query);
	  $favoriteRecipes = $user['favoriteRecipes'];
		if(strpos($favoriteRecipes, ",".$id.",") === false) $like = 0;
		else $like = 1;

		echo '
		<div class = "avtor">автор:</div>
		<img src="images/recipes/плашка-18.png" class = "fireAva">
		<img src="images/avatars/'.$author['avatar'].'" class = "boxAva">
		<div class = "avtorName">'.$author['name'].'</div>';
		 ?>

				<div id='phpCode'>
        <div class = "main">
					<?php
						$time =  $recipe['time'];
						$hours = intdiv($time,60);
						if($hours < 1) $hours = '00';
						if($hours > 0 && $hours < 10) $hours = '0'.$hours;
						$minutes = $time % 60;
						if($minutes > 1 && $minutes < 10) $minutes = '0'.$minutes;

						echo '
							<div class = "mainPhotoRecipe" style="background: url(./images/recipes/' . $recipe['image'] . ') no-repeat center center; background-size: cover;"></div>

				<div style = "display:flex;width: 100%;justify-content: center;align-items: center;">

					<div class = "header">' . $recipe['name'] . '</div>


					<div class="like">';

						if ($_SESSION['auth'] == false){?>
						<?php
						} else {

							if($like == "0"){
								echo '<button class="like-toggle basic2">♥</button>';
							}else{
								echo '<button class="like-toggle basic2 like-active">♥</button>';
							};
						}
							echo'
					</div>
				</div>';
				if($_SESSION['mail']=="appetito@mail.ru")
				echo '<div class = "addFoodBox" style="margin-top: 2%; margin-bottom: 2%">
												<button class = "addFood" style = "margin:0 auto" onclick="GoChange('.$recipe['id'].')">Редактировать</button>
				 </div>';
	            echo'<div class = "description">' . $recipe['description'] . '</div>
	            <div class = "Line">
	                <div class = "onLine">
	                    <div class = "textOnLine">Время приготовления: ' . $hours . ':' . $minutes . '</div>
	                    <div class = "textOnLine">Вид кухни: ' . $recipe['kitchen'] . '</div>
	                </div>
	            </div>
						';
					?>



			<script>

				$(function(){
					$('.like-toggle').click(function(){
						$(this).toggleClass('like-active');
						$(this).next().toggleClass('hidden');
						var location = window.location.href;
						var url = new URL(location);
						var id = url.searchParams.get("id");
						$.post('php/likeRecipe.php', {'id':id},function() {});
					});
				});
			</script>

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

					<?php
					if ($_SESSION['auth'] == false){?>
					<?php
					} else {
					?>
						<div class = "addFoodBox">
										<?php echo '<button class = "addFood" onclick="AddIngredients(' . $id . ');">Добавить ингредиенты в список покупок</button>' ?>
						</div>
						<?php
					};
					?>

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

							<?php
							if ($_SESSION['auth'] == false){?>
							<?php
							} else {
							?>

								<?php session_start(); ?>
								<div class = "formAva" <?php echo 'style = "background: url(./images/avatars/' . $_SESSION['avatar'] . ') no-repeat center center; background-size: cover;"' ?>></div>
								<form action="../php/sendReview.php" class = "formFidback">
										<?php echo '<input name="id" value="'.$id.'" style="display:none;">'; ?>
										<textarea type="text" name="text" placeholder="Ваш комментарий..." class = "textarea"></textarea>
										<input class = "sendMes" type="submit" value="Отправить">
								</form>
								<?php
								};
								?>
							</div>

							<?php
								$reviews =  $recipe['reviews'];
								if (!$reviews) echo '<div style="margin:auto; padding: 5%">Пока пусто</div>';
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
											</div>';

										echo (' <div class = "editFidback">
											<a class = "znak_edit" href="edit.php?id='.$id.'">&#9998;</a>
											<a class = "znak_edit" href="del.php?id='.$id.'">&#9746;</a>
										</div>');

										echo '
										</div>';
										$mailRev = '';
										$rev = '';
										$mailOrRev = 1;
									}
								}
							?>
            </div>
        </div>
				</div>
				<script>
					function AddIngredients(id){
						$.post('php/addIngredientsFromRecipe.php', {'id':id},function() {elementUpdate('#phpCode'); alert("Продукты успешно добавленны в ваш список покупок!");});
					}
					function GoChange(id){
						location.href='./changerecipe.php?id='+id;
					}
				</script>


				<?php
					include 'menuMobile.php';
					?>

    </body>
