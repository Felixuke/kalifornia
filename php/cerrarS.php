<?php
if (!isset($_SESSION)) {
  session_start();
}
  $_SESSION['usuario'] = NULL;
  unset($_SESSION['usuario']);
  unset($_SESSION['mail']);
  unset($_SESSION['janders']);
  session_destroy();
  header("location: ../index.php");
?>