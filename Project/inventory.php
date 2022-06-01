<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Инвентарь</title>
    <link rel="stylesheet" href="style/inventory.css">
    <script type="text/javascript" src="../scripts/elementUpdate.js"></script>
		<link href = "style/styleHeader.css" rel = "stylesheet" type = "text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&&display=swap" rel="stylesheet">
</head>

<?php
include 'header.php';
include 'menuMobile.php';
?>

<?php
 if ($_SESSION['auth'] == false){?>
    <div class="error">Ошибка, вы не вошли в аккаунт!</div>
<?php 
  } else {
?>

<body>
    <div class="main">
        <div class="kichenText">Мои кухонные принадлежности:</div>
          <div class="Choose" id="Choose">
              <?php
                include 'connect.php';
                session_start();
                $mail = $_SESSION['mail'];
                $trash = $_GET['idInv'];
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
                $myInventory = mysqli_fetch_assoc($query);
                $myInventory = $myInventory['myInventory'];

                if (isset($_GET['idInvAdd'])) {
                  $id = $_GET['idInvAdd'];
                  $myInventory = str_replace(",".$id.",",'',$myInventory);
                  $myInventory = ','.$id.','.$myInventory;
                  if(!$out) $out = '';
                  mysqli_query($conn, "UPDATE `users` SET `myInventory` = '$myInventory' WHERE `mail` = '$mail'");
                  mysqli_query($conn, "UPDATE `inventory` SET `popularity` = `popularity` + 1 WHERE `id` = '$id'");
                }
                if (isset($_GET['idInv'])) {
                  $id = $_GET['idInv'];
                  $myInventory = str_replace(",".$id.",",'',$myInventory);
                  if(!$out) $out = '';
                  mysqli_query($conn, "UPDATE `users` SET `myInventory` = '$myInventory' WHERE `mail` = '$mail'");
                  mysqli_query($conn, "UPDATE `inventory` SET `popularity` = `popularity` - 1 WHERE `id` = '$id'");
                }

                echo '
                <div class="chosenText">Выбрано: ' . substr_count($myInventory, ',')/2 . '</div>
                <div class="kichenUtensils">
                    <div class="block" id="selectInv"> ';
                for($i = 0; $i <  strlen($myInventory); $i++){
                  if($myInventory[$i] != "," && $myInventory[$i-1] == ",") {
                    $id = $myInventory[$i];
                    if($myInventory[$i] != "," && $myInventory[$i+1] != ",") {
                      $id = $id.$myInventory[$i+1];
                      $i+=1;
                    }
                    if($myInventory[$i] != "," && $myInventory[$i+1] != "," && $myInventory[$i+2] != ",") {
                      $id = $id.$myInventory[$i+2];
                      $i+=1;
                    }
                    $query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `id` = '$id'");
                    $row = mysqli_fetch_assoc($query);
                    echo '
                    <div class="kichenBlockY">
                    <div class="kichenBlock" onclick = "ClickSelect(' . $row['id'] . ')" style = "background: url(./images/inventory/' . $row['image'] . ') no-repeat center center; background-size: cover;"></div>
                    <div class="kichenUtensil"><span class="text">' . $row['name'] . '</span></div>
                    </div>';
                  }
                };
               ?>
            </div>
          </div>
          </div>

          <div class="addListBlock">
              <div class="addNameBlock">
                  <div class="addName">
                      <span class="chosenText">Добавить к списку:</span>
                  </div>
                  <div class="popularity">
                      <div class="addSearchSringBlock">
                          <input class="addSearchSring" type="text" placeholder="Поиск..." id="inputSearch">
                      </div>
                      <script>
                        function search() {
                          let input = document.getElementById("inputSearch");
                          let filter = input.value.toUpperCase();
                          let ul = document.getElementById("addBlock");
                          let inv = ul.getElementsByTagName("inv");

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
                        document.addEventListener('keyup', search);
                      </script>
                      <div class="select">
                          <select name="sort" id="sort">
                            <?php $sort = $_GET['sort']; ?>
                              <option value="0" <?php if($sort!="0") echo 'selected="selected"' ?>>По алфавиту</option>
                              <option value="1" <?php if($sort=="1") echo 'selected="selected"' ?>>По популярности</option>
                              <option value="2" <?php if($sort=="2") echo 'selected="selected"' ?>>По дате добавления</option>
                          </select>
                          <script>
                            let el=document.querySelector('#sort');
                            el.addEventListener('change', function(){
                              //location.href = "//project/inventory.php?sort=" + el.value;
                              window.history.replaceState('1', 'Title', '?sort='+el.value);
                              elementUpdate('#addBlock');
                            });
                            function ClickSelect(id){
                              window.history.replaceState('1', 'Title', '?idInv='+id+'&sort='+el.value);
                              elementUpdate('#Choose');
                              elementUpdate('#addBlock');
                              window.history.replaceState('1', 'Title', '?sort='+el.value);
                            }
                            function ClickInv(id){
                              window.history.replaceState('1', 'Title', '?idInvAdd='+id+'&sort='+el.value);
                              elementUpdate('#Choose');
                              elementUpdate('#addBlock');
                              window.history.replaceState('1', 'Title', '?sort='+el.value);
                            }
                          </script>
                      </div>
                  </div>
              </div>
          </div>

          <div class="addKichenUtensils">
            <div class="addBlock" id="addBlock">
            <?php
              $sort = $_GET['sort'];
              switch($sort){
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

              if(!mysqli_num_rows($query)) echo 'Пока пусто';
              while($row = mysqli_fetch_assoc($query)){
              for($i = 0; $i <  strlen($myInventory); $i++){
                if($myInventory[$i] != "," && $myInventory[$i-1] == ",") {
                  $id = $myInventory[$i];
                  if($myInventory[$i] != "," && $myInventory[$i+1] != ",") {
                    $id = $id.$myInventory[$i+1];
                    $i+=1;
                  }
                  if($myInventory[$i] != "," && $myInventory[$i+1] != "," && $myInventory[$i+2] != ",") {
                    $id = $id.$myInventory[$i+2];
                    $i+=1;
                  }
                  if($row['id'] == $id) {
                    $none = true;
                    break;
                  }
                }
              }
              if(!$none)
              echo
              '<inv>
                <div class="addKichenBlockL">
                <div class="addKichenBlock" onclick = "ClickInv(' . $row['id'] . ')" style = " background: url(./images/inventory/' . $row['image'] . ') no-repeat center center; background-size: cover;"></div>
                  <div class="addKichenUtensil"><span class="addText"><a>' . $row['name'] . '</a></span></div>
                  </div>
              </inv>';
              $none = false;
            };
            ?>
            </div>
          </div>
        </div>
    </div>
    <script>
    (function() {
        function scrollHorizontally(e) {
            e = window.event || e;
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            document.getElementById('selectInv').scrollLeft += (delta * 70); // Multiplied by 40
            e.preventDefault();
        }

        if (document.getElementById('selectInv').addEventListener) {
            // IE9, Chrome, Safari, Opera
            document.getElementById('selectInv').addEventListener('mousewheel', scrollHorizontally, false);
            // Firefox
            document.getElementById('selectInv').addEventListener('DOMMouseScroll', scrollHorizontally, false);
        } else {
            // IE 6/7/8
            document.getElementById('selectInv').attachEvent('onmousewheel', scrollHorizontally);
        }
      })();
    </script>

        <?php
        include 'menuMobile.php';
        ?>

</body>

<?php
 };
?>

</html>
