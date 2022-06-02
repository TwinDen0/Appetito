<?php
session_start();
include '../connect.php';

$mail = $_SESSION['mail'];
$countOfSteps = htmlspecialchars(trim($_POST['stepCount']));
$name = htmlspecialchars(trim($_POST['nameRecipe']));
$name = str_replace("%20" , " " , $name);
$description = htmlspecialchars(trim($_POST['description']));
$description = str_replace("%20" , " " , $description);
$time = htmlspecialchars(trim($_POST['time']));
$calories = htmlspecialchars(trim($_POST['calories']));
$kitchen = htmlspecialchars(trim($_POST['kitchen']));
$kitchen = str_replace("%20" , " " , $kitchen);

$photo = $_FILES['img'];

$query = mysqli_query($conn, "SELECT * FROM `recipes` ORDER BY `id` DESC");
$recipe = mysqli_fetch_assoc($query);
$id = $recipe['id'] + 1;

$nameFile = $id.'.jpg';
$dir = '../images/recipes/';
$uploadfile = $dir.$nameFile;
move_uploaded_file($photo['tmp_name'], $uploadfile);

//загрузка фоток шагов
for($i = 1; $i <= $countOfSteps; $i++){
  $photo = $_FILES['imgStep'.$i];
  $nameFile = $id.'-'.$i.'.jpg';
  $dir = '../images/recipes/';
  $uploadfile = $dir.$nameFile;
  move_uploaded_file($photo['tmp_name'], $uploadfile);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset='utf-8'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
  <div id="twoStep">
    <div id="id" style="display:none"><?php echo $id; ?></div>
    <div id="name" style="display:none"><?php echo $name; ?></div>
    <div id="description" style="display:none"><?php echo $description; ?></div>
    <div id="time" style="display:none"><?php echo $time; ?></div>
    <div id="calories" style="display:none"><?php echo $calories; ?></div>
    <div id="kitchen" style="display:none"><?php echo $kitchen; ?></div>
  </div>
</body>
  <script>
    if(sessionStorage.getItem('ingredients') != null){
      if(sessionStorage.getItem('inventory') != null){
          alert ('Ваш рецепт успешно добавлен!');
          let countOfSteps = sessionStorage.getItem('steps');
          let inventory = sessionStorage.getItem('inventory');
          let ingredients = sessionStorage.getItem('ingredients');
          let quantityIngredients = '';
          let quantityIng = '';
          for (var i = 0; i < ingredients.length; i++) {
            if(ingredients[i]!=','){
              quantityIng = quantityIng+ingredients[i];
            }
            if(ingredients[i]==',' && quantityIng){
              let id = 'selectedIng'+quantityIng;
              let quantityIngredient = sessionStorage.getItem(id);
              if(quantityIngredient == null) quantityIngredient = '0.001';
              quantityIngredients = quantityIngredients+','+quantityIngredient+',';
              quantityIng = '';
            }
          }
          let steps = '';
          for (var i = 0; i < countOfSteps; i++) {
            let id = i + 1;
            let step = sessionStorage.getItem('step'+id);
            steps = steps+step+'$';
          }

          $.post('sendRecipe2.php', {'ingredients': ingredients, 'quantityIngredients': quantityIngredients, 'inventory': inventory, 'steps': steps, 'name': document.getElementById('name').innerHTML, 'description': document.getElementById('description').innerHTML, 'time': document.getElementById('time').innerHTML, 'calories': document.getElementById('calories').innerHTML, 'kitchen': document.getElementById('kitchen').innerHTML});

          sessionStorage.clear();

          location.href = '../recipe.php?id='+document.getElementById('id').innerHTML;
      }else{
        alert('Добавьте кухонные принадлежности!');
        window.history.back();
      }
    }else{
      alert('Добавьте ингредиенты!');
      window.history.back();
    }
  </script>

</html>
