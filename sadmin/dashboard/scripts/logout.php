<?php
  session_start();
  unset($_SESSION['userId']);
  unset($_SESSION['username']);
  unset($_SESSION['nCreate']);
  unset($_SESSION['nRead']);
  unset($_SESSION['nUpdate']);
  unset($_SESSION['nDelete']);
  unset($_SESSION['nExecute']);
  unset($_SESSION['nMenu']);
  unset($_SESSION['nHome']);
  unset($_SESSION['nPosts']);
  unset($_SESSION['nPages']);
  unset($_SESSION['nUsers']);
  session_abort();
  header("Location: ../../index.php");

?>
