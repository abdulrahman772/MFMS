<?php
session_start();
session_unset();
session_destroy();
  header('Location: http://localhost:8080/MFMS/index.php');
exit();
?>