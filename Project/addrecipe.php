<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить рецепт</title>
    <link rel="stylesheet" href="style/addrecipe.css">
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<?php
include 'header.php';
  ?>

<body>
  <div class="backgroundAddRecipe">

  </div>
  <form action="../php/sendRecipe.php" method="post" enctype="multipart/form-data">
    <div class="main" id="all">
        <div class="addName">Добавить рецепт</div>
        <div class="name">
            <div class="textName">Введите название:</div>
            <input type="text" maxlength="60" name="nameRecipe" id="inputName" class="inputName" style = "resize: none" onchange="Save('inputName','inputName');" required></input>
        </div>

        <div class="name">
            <div class="textName">Добавьте фото:</div>
            <!-- <form id="my-form" enctype="multipart/form-data">
                <input type="file" accept=".jpg, .jpeg, .png" name="img"  id='file_id' class="inputName" style = "resize: none" required>
            </form> -->
              <div class="ava_input__wrapper">
                <input type="file" accept=".jpg, .jpeg, .png" type="file" name="img" id="file_id" style = "resize: none" onchange="uploadImage(event)" class="ava_input ava_input__file" required>
                <label for="input__file" class="ava_input__file-button">
                  <span class="ava_input__file-icon-wrapper">
                  <img class="ava_input__file-icon" src="images/profile/add.png" alt="Выбрать файл" width="25"></span>
                  <span class="ava_input__file-button-text">Выберите файл</span>
                </label>
              </div>
        </div>

        <div style="margin: 0 auto; margin-top:20px;" id="photo"></div>

        <div class="description">
            <div class="descriptionName">Введите описание:</div>
            <textarea name="description" maxlength="450" id="inputDescription" class="inputdescription" style = "resize: none" onchange="Save('inputDescription','inputDescription');" required></textarea>
        </div>

        <div class="calories">
            <div class="textCalories">Введите примерную коллорийность:</div>
            <input type="number" min="0" step="1" type="text" name="calories" id="inputCalories" class="inputCalories" style = "resize: none" onchange="Save('inputCalories','inputCalories');" required></input>
        </div>

        <div class="cookingTime">
            <div class="textCookingTime">Время приготовления (мин):</div>
            <input type="number" min="0" step="5" name="time" id="inputCookingTime" class="inputCookingTime" style = "resize: none" onchange="Save('inputCookingTime','inputCookingTime');" required></input>
        </div>

        <div class="kitchen">
            <div class="textKitchen">Категория:</div>
            <?php $kitchen = $_GET['kitchen']; ?>
            <select name="kitchen" id="kitchen">
                <option value="Другая" <?php echo 'selected="selected"' ?>>Другое</option>
                <option value="Завтрак" <?php if($kitchen=="Завтрак") echo 'selected="selected"' ?>>Завтрак</option>
                <option value="Первые блюда" <?php if($kitchen=="Первые блюда") echo 'selected="selected"' ?>>Первые блюда</option>
                <option value="Вторые блюда" <?php if($kitchen=="Вторые блюда") echo 'selected="selected"' ?>>Вторые блюда</option>
                <option value="Закузки" <?php if($kitchen=="Закузки") echo 'selected="selected"' ?>>Закуски</option>
                <option value="Салаты" <?php if($kitchen=="Салаты") echo 'selected="selected"' ?>>Салаты</option>
                <option value="Соусы, кремы" <?php if($kitchen=="Соусы, кремы") echo 'selected="selected"' ?>>Соусы, кремы</option>
                <option value="Напитки" <?php if($kitchen=="Напитки") echo 'selected="selected"' ?>>Напитки</option>
                <option value="Десерты" <?php if($kitchen=="Десерты") echo 'selected="selected"' ?>>Десерты</option>
                <option value="Выпечка" <?php if($kitchen=="Выпечка") echo 'selected="selected"' ?>>Выпечка</option>
                <option value="Торты" <?php if($kitchen=="Торты") echo 'selected="selected"' ?>>Торты</option>
            </select>
        </div>

        <button type="submit" class="sendRecipe">Отправить рецепт</button>

        <div class="chooseIngredientsText"><div class="chooseIngredientsText1">Выбери Ингредиенты:</div></div>
<!-- Выбранные ингредиенты -->
        <div class="ingredientsMain">
          <div id="ingredientsSelect">
            <?php
            include 'connect.php';
            // session_start();
            $ingredients = $_GET['ingredients'];
            ?>
            <div class="selectedIngredientsName">Выбранные ингредиенты:  <?php echo substr_count($ingredients, ',')/2; ?></div>
            <div class="selectedProducts">
              <div class="selectedProductsBox" id="element">
                <?php
                $ing = '';
                for($i = 0; $i < strlen($ingredients); $i++){
                  if($ingredients[$i]!=","){
                    $ing = $ing.$ingredients[$i];
                  }
                  if($ingredients[$i]=="," && $ing){
                    $query = mysqli_query($conn, "SELECT * FROM `ingredients` WHERE `id`='$ing'");
                    $ingredient = mysqli_fetch_assoc($query);
                    $nameBar = "'".'selectedIng'.$ingredient['id']."'";
                    echo '
                    <div class="selectedProduct">
                      <div class="productBox" style = "background: url(./images/ingredients/' . $ingredient['image'] . ') no-repeat center center; background-size: cover;" onclick="DeleteIngredient('.$ingredient['id'].');"></div>
                        <div class="numberText">количество:</div>
                      <input type="number" min="0.05" value = "0.05" step="0.05" class="number" name="selectedIng'.$ingredient['id'].'" id="selectedIng'.$ingredient['id'].'" onchange="Save('.$nameBar.','.$nameBar.');">
                    </div>';
                    $ing = '';
                  }
                }
                ?>
              </div>
            </div>
          </div>
<!-- Сортировка ингредиентов -->
            <div class="suitable">
                <div class="suitableTextBox" id="otstup">
                    <div class="suitableText">Выбери подходящие:</div>
                    <div class="popularity">
                        <input type="text" placeholder="Поиск..." name="searchIng" id="searchIng" class="input">
                        <script>
          								function search() {
          									let input = document.getElementById("searchIng");
          									let filter = input.value.toUpperCase();
          									let ul = document.getElementById("ingredients");
          									let ing = ul.getElementsByTagName("ing");
                            sessionStorage.setItem('searchIng', '');
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
                        <div class="magGlass"></div>
                        <div class="select">
                          <select name="sort" id="sortIng">
                            <?php $sortIng = $_GET['sortIng']; ?>
                              <option value="0" <?php if($sortIng!="0") echo 'selected="selected"' ?>>По алфавиту</option>
                              <option value="1" <?php if($sortIng=="1") echo 'selected="selected"' ?>>По возрастанию стоимости</option>
                              <option value="2" <?php if($sortIng=="2") echo 'selected="selected"' ?>>По убыванию стоимости</option>
                              <option value="3" <?php if($sortIng=="3") echo 'selected="selected"' ?>>По дате добавления</option>
                          </select>
                        </div>
                    </div>
                </div>
<!-- Все ингредиенты -->
                <div class="suitableProducts" id="ingredients">
                    <div class="suitableProductBox">
                      <?php
                        $mail = $_SESSION['mail'];
                        $sortIng = $_GET['sortIng'];

                        switch($sortIng){
                          case "0":
                            $query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `name`");
                            break;
                          case "1":
                            $query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `price`");
                            break;
                          case "2":
                            $query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `price` DESC");
                            break;
                          case "3":
                            $query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `id` DESC");
                            break;
                          default :
                            $query = mysqli_query($conn, "SELECT * FROM `ingredients` ORDER BY `name`");
                            break;
                        }

                        while($row = mysqli_fetch_assoc($query)){
                          if(strpos($ingredients, ",".$row['id'].",")=== false)
                          echo '<ing>
                          <div class="suitableNamePrd"><div class="suitableProduct" style = "background: url(./images/ingredients/' . $row['image'] . ') no-repeat center center; background-size: cover;" onclick="AddIngredient('.$row['id'].');"></div>
                          <div class="nprod"><a>' . $row['name'] . '</a></div></div>
                          </ing>';
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>
<!-- Выбранные кухонные принадлежности -->
        <div class="kitckenUtensilsText"><div class="kitckenUtensilsText1">Выбери кухонные принадлежности:</div></div>
        <div class="kitckenUtensilsMain">
          <div id="inventorySelect">
            <?php
            $inventory = $_GET['inventory'];
            ?>
            <div class="selectedKitckenUtensilsName">Выбранные кухонные принадлежнсти:  <?php echo substr_count($inventory, ',')/2; ?></div>
            <div class="selectedKitckenUtensils">
              <div class="selectedKitckenUtensilsBox" id="element">
                <?php
                $inv = '';
                for($i = 0; $i < strlen($inventory); $i++){
                  if($inventory[$i]!=","){
                    $inv = $inv.$inventory[$i];
                  }
                  if($inventory[$i]=="," && $inv){
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `id`='$inv'");
                    $inventor = mysqli_fetch_assoc($query);
                    echo '
                    <div class="selectedProduct">
                      <div class="KitckenUtensilBox" style = "background: url(./images/inventory/' . $inventor['image'] . ') no-repeat center center; background-size: cover;" onclick="DeleteInventory('.$inventor['id'].');"></div>
                    </div>';
                    $inv = '';
                  }
                }
                ?>
              </div>
            </div>
          </div>
<!-- Сортировка принадлежностей -->
            <div class="suitable">
              <div class="suitableTextBox">
                <div class="suitableText">Выбери подходящие:</div>
                <div class="popularity">
                  <input type="text" placeholder="Поиск..." name="searchInv" id="searchInv" class="input">
                  <script>
                  function search2() {
                    let input = document.getElementById("searchInv");
                    let filter = input.value.toUpperCase();
                    let ul = document.getElementById("inventory");
                    let inv = ul.getElementsByTagName("inv");
                    sessionStorage.setItem('searchInv', '');

                    // Перебирайте все элементы списка и скрывайте те, которые не соответствуют поисковому запросу
                    for (let i = 0; i < inv.length; i++) {
                      let a = inv[i].getElementsByTagName("a")[0];
                      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        inv[i].style.display = "";
                      } else {
                        inv[i].style.display = "none";
                      }
                    }
                  }
                  document.addEventListener('keyup', search2);
                  </script>
                  <div class="magGlass"></div>
                  <div class="select">
                    <select name="sort" id="sortInv">
                      <?php $sortInv = $_GET['sortInv']; ?>
                      <option value="0" <?php if($sortInv!="0") echo 'selected="selected"' ?>>По алфавиту</option>
                      <option value="1" <?php if($sortInv=="1") echo 'selected="selected"' ?>>По популярности</option>
                      <option value="2" <?php if($sortInv=="2") echo 'selected="selected"' ?>>По дате добавления</option>
                    </select>
                  </div>
                </div>
              </div>
<!-- Все принадлежности -->
              <div class="suitableProducts" id="inventory">
                <div class="suitableProductBox">
                  <?php
                  $sortInv = $_GET['sortInv'];
                  switch($sortInv){
                    case "0":
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` ORDER BY `name`");
                    break;
                    case "1":
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` ORDER BY `popularity` DESC");
                    break;
                    case "2":
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` ORDER BY `id` DESC");
                    break;
                    default :
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` ORDER BY `name`");
                    break;
                  }

                  while($row = mysqli_fetch_assoc($query)){
                    if(strpos($inventory, ",".$row['id'].",")=== false)
                    echo '<inv>
                      <div class="suitableNamePrd">
                        <div class="suitableProduct" style = "background: url(./images/inventory/' . $row['image'] . ') no-repeat center center; background-size: cover;" onclick="AddInventory('.$row['id'].');"></div>
                        <div class="nprod"><a>' . $row['name'] . '</a></div>
                      </div>
                    </inv>';
                  };
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- Шаги -->
        <div class="stepsText"><div class="stepsText1">Напишите шаги:</div></div>
        <div class="stepsMain" id="steps">
          <?php
            $countOfSteps = $_GET['countOfSteps'];
            if(!$_GET['countOfSteps']) $countOfSteps = 1;
            for ($i=0; $i < $countOfSteps; $i++) {
              $idStep = $i + 1;
              echo '
              <div class="step">
                  <div class="stepNumber" onclick="DeleteStep('.$i.');">'.$idStep.'</div>
                  <div class="stepContent">
                      <div class="stepBox" id="stepBox'.$idStep.'">
                        <div class="ava_input__wrapper_2">
                          <input onchange="uploadImageStep(event, '.$idStep.')" type="file" accept=".jpg, .jpeg, .png" type="file" name="imgStep'.$idStep.'" id="imgStep'.$idStep.'" class="ava_input ava_input__file" style = "resize: none">
                          <label for="input__file" class="ava_input__file-button_2" style="cursor:pointer">
                            <span class="ava_input__file-icon-wrapper">
                            <img class="ava_input__file-icon" src="images/profile/add.png" alt="Выбрать файл" width="25"></span>
                            <span class="ava_input__file-button-text_2">Выберите файл</span>
                          </label>
                        </div>
                      </div>
                      <textarea class="inputStep" name="step'.$idStep.'" style = "resize: none" id="step'.$idStep.'" required></textarea>
                      <input id="stepCount" name="stepCount" style="display:none" value="'.$countOfSteps.'" required>
                  </div>
              </div>';
            };
          ?>

            <?php $q = $countOfSteps+1;  echo '<div class="addStep" onclick="AddStep('.$q.');" > Добавить шаг </div>';?>
            <div class="indentStep"></div>
        </div>
        <div class="indentBottom"></div>
    </div>
  </form>
    <script>
      var maxSize = 1048576;

      if(sessionStorage.length == 0) {
        window.location.href = '../addrecipe.php?countOfSteps=1';
        sessionStorage.setItem('steps','1');
        ReplaceAddressBar();
      }

      let sortIng=document.querySelector('#sortIng');
      sortIng.addEventListener('change', function(){
        //location.href = "//project/inventory.php?sort=" + el.value;

        ReplaceAddressBar();

        let searchIng = document.getElementById("searchIng");
        let searchInv = document.getElementById("searchInv");
        searchInv.value = '';
        searchIng.value = '';
        elementUpdate('#ingredients');
      });

      let sortInv=document.querySelector('#sortInv');
      sortInv.addEventListener('change', function(){
        //location.href = "//project/inventory.php?sort=" + el.value;

        ReplaceAddressBar();

        let searchIng = document.getElementById("searchIng");
        let searchInv = document.getElementById("searchInv");
        searchInv.value = '';
        searchIng.value = '';
        elementUpdate('#inventory');
      });

      let kitchen=document.querySelector('#kitchen');
      kitchen.addEventListener('change', function(){
        ReplaceAddressBar();
      });

      function AddIngredient(ingredients){
        let result = sessionStorage.getItem('ingredients') + '';
        result = result.split(','+ingredients+',').join('');
        ingredients = ","+ingredients+","+result;
        sessionStorage.setItem('ingredients', ingredients);

        let id = "selectedIng"+ingredients;
        sessionStorage.removeItem(id);

        ReplaceAddressBar();

        elementUpdate('#ingredientsSelect');
        elementUpdate('#ingredients');
      }
      function DeleteIngredient(ingredients){
        let result = sessionStorage.getItem('ingredients') + '';
        result = result.split(','+ingredients+',').join('');
        sessionStorage.setItem('ingredients', result);

        let id = "selectedIng"+ingredients;
        sessionStorage.removeItem(id);

        ReplaceAddressBar();

        elementUpdate('#ingredientsSelect');
        elementUpdate('#ingredients');
      }
      function AddInventory(inventory){
        let result = sessionStorage.getItem('inventory') + '';
        result = result.split(','+inventory+',').join('');
        inventory = ","+inventory+","+result;
        sessionStorage.setItem('inventory', inventory);

        ReplaceAddressBar();

        elementUpdate('#inventorySelect');
        elementUpdate('#inventory');
      }
      function DeleteInventory(inventory){
        let result = sessionStorage.getItem('inventory') + '';
        result = result.split(','+inventory+',').join('');
        sessionStorage.setItem('inventory', result);

        ReplaceAddressBar();

        elementUpdate('#inventorySelect');
        elementUpdate('#inventory');
      }

      function AddStep(steps){
        sessionStorage.setItem('steps', steps);
        ReplaceAddressBar();
        elementUpdate('#steps');
      }

      function DeleteStep(steps){
        sessionStorage.setItem('steps', steps);

        let id = "step"+(steps+1);
        let step = document.getElementById(id);
        window.sessionStorage.setItem(id, '');

        ReplaceAddressBar();
        elementUpdate('#steps');
      }

      function RelaceTextArea(){
        document.querySelectorAll('textarea, input').forEach(function(e) {
            if(e.type != 'file'){
              if(e.value === '' && window.sessionStorage.getItem(e.name)) e.value = window.sessionStorage.getItem(e.name);
              e.addEventListener('input', function() {
                  window.sessionStorage.setItem(e.name, e.value);
              })
            }
        })
      }

      document.addEventListener("DOMContentLoaded", function() {
          RelaceTextArea();
          ReplaceNumberInput();
          ReplaceAddressBar();
          elementUpdate('#inventorySelect');
          elementUpdate('#inventory');
          elementUpdate('#ingredientsSelect');
          elementUpdate('#ingredients');
          elementUpdate('#steps');
          if(window.sessionStorage.getItem('photo')){
            let name = window.sessionStorage.getItem('photo');
            let res = window.sessionStorage.getItem(name);
            let photo = document.getElementById("photo");
            photo.style.background = 'url('+res+') no-repeat center center';
            photo.style.backgroundSize = 'cover';
            photo.style.width = "500px";
            photo.style.height = "240px";
            const dt = new DataTransfer();
            dt.items.add(dataURLtoFile(res, name));
            const fileList = dt.files;
            document.getElementById('file_id').files = fileList;
          }

          UpdatePhotoSteps();
      });

      function UpdatePhotoSteps(){
        for (var i = 1; i <= document.getElementById("stepCount").value; i++) {
          if(window.sessionStorage.getItem("stepPhoto"+i)){
            let name = window.sessionStorage.getItem("stepPhoto"+i);
            let res = window.sessionStorage.getItem(name);
            let photo = document.getElementById("stepBox"+i);
            photo.style.background = 'url('+res+') no-repeat center center';
            photo.style.backgroundSize = 'cover';
            const dt = new DataTransfer();
            dt.items.add(dataURLtoFile(res, name));
            const fileList = dt.files;
            document.getElementById("imgStep"+i).files = fileList;
          }
        }
      }

      function dataURLtoFile(dataurl, filename) {
       var arr = dataurl.split(','),
           mime = arr[0].match(/:(.*?);/)[1],
           bstr = atob(arr[1]),
           n = bstr.length,
           u8arr = new Uint8Array(n);
       while(n--){
           u8arr[n] = bstr.charCodeAt(n);
       }
       return new File([u8arr], filename, {type:mime});
      }

      function ReplaceNumberInput(){
        for (var i = 1; i < 1000; i++) {
          let id = 'selectedIng'+i;
          if(document.getElementById(id) && sessionStorage.getItem(id)){
            let value = document.getElementById(id);
            value.value = sessionStorage.getItem(id);
          }
        }
        if(document.getElementById('inputCookingTime') && sessionStorage.getItem('inputCookingTime')){
          let value = document.getElementById('inputCookingTime');
          value.value = sessionStorage.getItem('inputCookingTime');
        }
      }

      function Save(name, id){
        let value = document.getElementById(id);
        sessionStorage.setItem(name, value.value);
      }

      function ReplaceAddressBar(){
        window.history.replaceState('1', 'Title', '?sortIng='+sortIng.value+'&sortInv='+sortInv.value+'&ingredients='+sessionStorage.getItem('ingredients')+'&inventory='+sessionStorage.getItem('inventory')+'&kitchen='+kitchen.value+'&countOfSteps='+sessionStorage.getItem('steps')+'&chooseSteps='+sessionStorage.getItem('chooseSteps'));
      }

      async function elementUpdate(selector) {
        try {
          var html = await (await fetch(location.href)).text();
          var newdoc = new DOMParser().parseFromString(html, 'text/html');
          document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
          console.log('Элемент '+selector+' был успешно обновлен');
          RelaceTextArea();
          ReplaceNumberInput();
          if(selector == "#steps") UpdatePhotoSteps();
          return true;
        } catch(err) {
          console.log('При обновлении элемента '+selector+' произошла ошибка:');
          console.dir(err);
          return false;
        }
      }

      function uploadImage(event) {
        var reader = new FileReader();
        var name = event.target.files[0].name;
        reader.addEventListener("load", function () {
            if (this.result && sessionStorage && event.target.files[0].size <= maxSize) {
                try {
                  window.sessionStorage.setItem(name, this.result);
                  window.sessionStorage.setItem('photo', name);
                  let photo = document.getElementById("photo");
                  photo.style.background = 'url('+this.result+') no-repeat center center';
                  photo.style.backgroundSize = 'cover';
                  photo.style.width = "500px";
                  photo.style.height = "240px";
               } catch(error) {
                  alert("Ошибка при отображении фото в окне. Ваше фото добавилось в форму для отправки рецепта, но мы рекомендуем добавить фото с меньшим размером для избежания возникновения ошибок в дальнейшем");
                  console.log("Ошибочка вышла", error);
               }
            }
            if(event.target.files[0].size > maxSize){
               alert("Слишком большое изображение");
               const dt = new DataTransfer();
               event.files = dt.files;
               let photo = document.getElementById("photo");
               photo.style.background = 'none';
               photo.style.height = "0px";
            };
        });
        reader.readAsDataURL(event.target.files[0]);
     }

     function uploadImageStep(event, stepId) {
       var reader = new FileReader();
       var name = event.target.files[0].name;
       reader.addEventListener("load", function () {
           if (this.result && sessionStorage && event.target.files[0].size <= maxSize) {
               try {
                 window.sessionStorage.setItem(name, this.result);
                 window.sessionStorage.setItem("stepPhoto"+stepId, name);
                 let photo = document.getElementById("stepBox"+stepId);
                 photo.style.background = 'url('+this.result+') no-repeat center center';
                 photo.style.backgroundSize = 'cover';
          	   } catch(error) {
                 alert("Ошибка при отображении фото в окне. Ваше фото добавилось в форму для отправки рецепта, но мы рекомендуем добавить фото с меньшим размером для избежания возникновения ошибок в дальнейшем");
                 console.log("Ошибочка вышла", error);
          	   }
           }
           if(event.target.files[0].size > maxSize){
              alert("Слишком большое изображение");
              const dt = new DataTransfer();
              event.files = dt.files;
              let photo = document.getElementById("stepBox"+stepId);
              photo.style.background = 'none';
           };
       });
       reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</body>
<?php
include 'menuMobile.php';
?>
</html>
