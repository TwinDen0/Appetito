<?php
  session_start();

  $_SESSION['auth'] = false;
  $_SESSION['mail'] = '';

  $_SESSION['name'] = '';
  $_SESSION['surname'] = '';
  $_SESSION['avatar'] = '';

  $_SESSION['comments'] = '';
  $_SESSION['likes'] = '';

  header('Location: /');
?>