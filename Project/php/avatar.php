<?php
  session_start();
  $image = $_POST['avatar'];

  function loadAvatar($avatar){
    $type = $avatar['type'];
    $name = md5(microtime()).'.'.substr($type, strlen("image/"));
    $dir = '../images/avatars/';
    $uploadfile = $dir.$name;
    $email = $_SESSION['mail'];

    if(move_uploaded_file($avatar['tmp_name'], $uploadfile)){
      $mysql = new mysqli('127.0.0.1','mysql','','buon_appetito');
      $result = $mysql->query("SELECT * FROM `users` WHERE `mail` = '$email'");
      $oldAvatar = $result->fetch_assoc();
      if($oldAvatar['avatar'] != "default.jpg") unlink('../images/avatars/'.$oldAvatar['avatar']);
      $mysql->query("UPDATE `users` SET `avatar` = '$name' WHERE `mail` = '$email'");
      $mysql->close();
      $_SESSION['avatar']=$name;
    } else {
      return false;
    }
    return true;
  };

  $avatar = $_FILES['avatar'];

  loadAvatar($avatar);
  header('Location: ../profile.php');
?>
