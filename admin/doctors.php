<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='Admin | Doctor';

include "init.php";






  <?php
include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
?>
