<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/shoppingList.css">
    <script type="text/javascript" src="../scripts/elementUpdate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Список покупок</title>
</head>

<?php
	include 'header.php';
    ?>

  <div class = "wapper"></div>
<?php
 if ($_SESSION['auth'] == false){?>
    <div class="error"><p>Список покупок доступен только зарегестрированным пользователям</p>
                        <p style="color: #f5980e;margin-top: 1%;">Войдите или зарегистрируйтесь</p></div>

                       
              <div class = "blockAuth">
                  <div  onclick="location.href='../login.php'"href="#" class = "btn">Войти</div>
                  <div  onclick="location.href='../registration.php'"href="#" class = "btn">Регистрация</div>
              </div>

<?php 
  } else {
?>

<body>
    
    <div id = "background" onclick = "closeList()" class = "background"></div>
    <div class="main">
        <div class="shoppingList" id = "ShoppingList" >
          <div class = "noteImg">
            <div class="shoppingListBlocks" id="selectList">
              <?php
                include 'connect.php';
                session_start();
                $mail = $_SESSION['mail'];
                $trash = $_GET['iding'];
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
                $shoppingList = mysqli_fetch_assoc($query);
                $shoppingList = $shoppingList['ShoppingList'];
                $idIngredient = "";
                $quantity = "";
                $quantityOrId = 0;

                for($i = 0; $i < strlen($shoppingList); $i++){
                    if($shoppingList[$i] != "-" && $shoppingList[$i] != ",") {
                      if($quantityOrId == 0)
                      $idIngredient = $idIngredient.$shoppingList[$i];
                      else
                      $quantity = $quantity.$shoppingList[$i];
                    }
                    if($shoppingList[$i] == "-") {
                      $quantityOrId = 1;
                    }

                    if($shoppingList[$i] == "," && $idIngredient != "" && $quantity != ""){
                      $query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `id` = '$idIngredient'");
                      $row = mysqli_fetch_assoc($query);
                      echo '
                      <div class="shoppingListBlock">
                        <div class="shoppingListPicture" style = " background: url(./images/ingredients/' . $row['image'] . ') no-repeat center  center; background-size: cover;"></div>
                          <div class="blockText">
                          <div class="nameProductText">' . $row['name'] . '</div>
                          <div class="amountText">Количество: ' . $quantity . ' кг</div>
                          <div class="priceText">Примерная цена: ' . $quantity * $row['price'] . ' руб</div>
                        </div>
                        <img src = "images/shoppingList/off.png" class="cross" onclick = "ClickRemove('. $row['id'] .','. $quantity .')">
                      </div>';
                      $idIngredient = "";
                      $quantity = "";
                      $quantityOrId = 0;
                    }
                };
               ?>
            </div>
            </div>
        </div>
        <div class="chooseProducts">
            <div class="chooseProductsText">Выбери продукты:</div>
            <a class = "look" onclick="ShoppingListOpen()">Смотреть список</a>
            <div class="category">
                <div class="categoryText">категория:</div>
                <div class="categoryBlocks" id = "categoryBlocks">
                    <img title="Все продукты" src="images/category/all.png" class = "categoryBlock1" onclick="ClickCategory('');">
                    <img title="Грибы" src="images/category/mushroom.png" class = "categoryBlock1" onclick="ClickCategory('Грибы');">
                    <img title="Молочное" src="images/category/milk.png" class = "categoryBlock1" onclick="ClickCategory('Молочное');">
                    <img title="Крупы и злаки" src="images/category/groats.png" class = "categoryBlock1" onclick="ClickCategory('Крупыизлаки');">
                    <img title="Макароны" src="images/category/pasta.png" class = "categoryBlock1" onclick="ClickCategory('Макароны');">
                    <img title="Масла" src="images/category/oil.png" class = "categoryBlock1" onclick="ClickCategory('Маслорастительное');">
                    <img title="Джемы" src="images/category/jam.png" class = "categoryBlock1" onclick="ClickCategory('Джемы');">
                    <img title="Птица" src="images/category/chicken.png" class = "categoryBlock1" onclick="ClickCategory('Птица');">
                    <img title="Морепродукты" src="images/category/fish.png" class = "categoryBlock1" onclick="ClickCategory('Рыбаиморепродукты');">
                    <img title="Яйца" src="images/category/egg.png" class = "categoryBlock1" onclick="ClickCategory('Яйца');">
                    <img title="Бобовые" src="images/category/bobs.png" class = "categoryBlock1" onclick="ClickCategory('Бобовые');">
                    <img title="Мука" src="images/category/flour.png" class = "categoryBlock1" onclick="ClickCategory('Мука');">
                    <img title="Мучное" src="images/category/bread.png" class = "categoryBlock1" onclick="ClickCategory('Хлеб');">
                    <img title="Мясо" src="images/category/meat.png" class = "categoryBlock1" onclick="ClickCategory('Мясо');">
                    <img title="Овощи" src="images/category/carrot.png" class = "categoryBlock1" onclick="ClickCategory('Овощи');">
                    <img title="Орехи" src="images/category/nut.png" class = "categoryBlock1" onclick="ClickCategory('Орехи');">
                    <img title="Соусы" src="images/category/sauce.png" class = "categoryBlock1" onclick="ClickCategory('Соусы');">
                    <img title="" src="images/category/spices.png" class = "categoryBlock1" onclick="">
                    <img title="Сыры" src="images/category/cheese.png" class = "categoryBlock1" onclick="ClickCategory('Сыры');">
                    <img title="Фрукты" src="images/category/apple.png" class = "categoryBlock1" onclick="ClickCategory('Фрукты');">
                    <img title="Ягоды" src="images/category/blackberry.png" class = "categoryBlock1" onclick="ClickCategory('Ягоды');">
                    <img title="Зелень" src="images/category/green.png" class = "categoryBlock1" onclick="ClickCategory('Зелень');">
                </div>
            </div>



            <script>
                (function() {
              function scrollHorizontally1(e) {
                  e = window.event || e;
                  var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
                  document.getElementById('categoryBlocks').scrollLeft += (delta * 70); // Multiplied by 40
                  e.preventDefault();
              }
              if (document.getElementById('categoryBlocks').addEventListener) {
                  // IE9, Chrome, Safari, Opera
                  document.getElementById('categoryBlocks').addEventListener('mousewheel', scrollHorizontally1, false);
                  // Firefox
                  document.getElementById('categoryBlocks').addEventListener('DOMMouseScroll', scrollHorizontally1, false);
              } else {
                  // IE 6/7/8
                  document.getElementById('categoryBlocks').attachEvent('onmousewheel', scrollHorizontally1);
              }
            })();
		    </script>


            <div class="popularity">
                <div class="select">
                  <select name="sort" id="sort">
                    <?php $sort = $_GET['sort']; ?>
                      <option value="0" <?php if($sort!="0") echo 'selected="selected"' ?>>По алфавиту</option>
                      <option value="1" <?php if($sort=="1") echo 'selected="selected"' ?>>По возрастанию стоимости</option>
                      <option value="2" <?php if($sort=="2") echo 'selected="selected"' ?>>По убыванию стоимости</option>
                      <option value="3" <?php if($sort=="3") echo 'selected="selected"' ?>>По дате добавления</option>
                  </select>
                </div>
                <input class = "inputSearchText" style = "margin-left:10px" type="text" placeholder="Поиск..." id="inputSearch">
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
            <div class="productSelectionBox" id="selectionBox">
                <div class="productSelectionBox1">
                    <?php
                      $sort = $_GET['sort'];
                      $category = $_GET['category'];
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
                        echo
                        '<ing><div class="productBox">
                            <div class="productName" style = " background: url(./images/ingredients/' . $row['image'] . ') no-repeat center center; background-size: cover;" onclick = "ClickAdd('. $row['id'] .')"></div>
                            <div class="amount">
                                <div class="amountText1">Количество (кг):</div>
                                <input type="number" min="0.001" value = "0.001" step="0.001" class="amountInput" id="inputQuantity' . $row['id'] . '">
                            </div>
                            <div class="productName"><a>' . $row['name'] . '</a></div>
                        </div></ing>';
                      };
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  let category = '';
  let el=document.querySelector('#sort');
  el.addEventListener('change', function(){
    //location.href = "//project/ingentory.php?sort=" + el.value;
    window.history.replaceState('1', 'Title', '?sort='+el.value+'&category='+category);
    elementUpdate('#selectionBox');
  });
  function ClickCategory(categ){
    window.history.replaceState('1', 'Title', '?category='+categ+'&sort='+el.value);
    category = categ;
    elementUpdate('#selectionBox');
  }
  function ClickRemove(id, quantity){
    $.post('php/deleteInShoppingList.php', {'id':id, 'quantity':quantity}, function() {elementUpdate('#selectList');});
  }
  function ClickAdd(id){
    $.post('php/addInShoppingList.php', {'id':id, 'quantity':document.getElementById("inputQuantity"+id).value},function() {elementUpdate('#selectList');});
    document.getElementById("inputQuantity"+id).value = '0.001';
  }
</script>

        <?php
        include 'menuMobile.php';
        ?>

</body>

<?php
 };
?>

</html>
