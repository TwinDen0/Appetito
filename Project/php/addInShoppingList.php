<?php
  session_start();
  include '../connect.php';
  $mail = $_SESSION['mail'];
  $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `mail` = '$mail'");
  $shoppingList = mysqli_fetch_assoc($query);
  $shoppingList = $shoppingList['ShoppingList'];

  $id = $_POST['id'];
  $quantityIng = $_POST['quantity'];
  $quantityIng = round($quantityIng, 3);
  $find=",".$id ."-";
  if(strpos($shoppingList, $find) === false){
    $shoppingList = ",".$id ."-".$quantityIng.",".$shoppingList;
  }else{
    $shoppingList = str_replace(",".$id ."-" , ",".$id ."?" , $shoppingList);
    for($i=0; $i < strlen($shoppingList); $i++) {
      if($shoppingList[$i]=="?"){
        $quan = '';
        for ($j=$i + 1; $j < strlen($shoppingList); $j++) {
          if($shoppingList[$j] == ","){
            $quans = $quan + $quantityIng;
            $shoppingList = str_replace(",".$id ."?".$quan."," , ",".$id ."-".$quans."," , $shoppingList);
          }
          $quan = $quan.$shoppingList[$j];
        }
        break;
      }
    }
  }
  if($quantityIng > 0 && $quantityIng < 10000) mysqli_query($conn, "UPDATE `users` SET `ShoppingList` = '$shoppingList' WHERE `mail` = '$mail'");
 ?>
