<?php
function getTitle()
{
 global $page_title ;
   if (isset($page_title )) {
     echo $page_title ;
   }
   else {
     echo "defoult";
   }
 }

function checkitem($select, $from, $value){
global $con;

$stmt = $con->prepare("SELECT $select FROM $from WHERE $select =? ");
$stmt->execute(array($value));
  $count = $stmt->rowCount();
return $count ;



}


function redirecthome($theMsg, $url=null, $seconds = 2 ){

  if ($url === null ) {
    $url = 'user.php';
  }
  elseif ($url === 'mmm') {
    $url = 'add_patient.php';
  }
  elseif ($url === 'nnn') {
      $url = 'add_doctor.php';
  }
  elseif ($url === 'xxx') {
      $url = 'xray_a.php';
  }
  elseif ($url === 'user') {
      $url = 'user.php';
  }
  else {
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
      $url = $_SERVER['HTTP_REFERER'];
    }
    else {
      $url = 'user.php';
    }

  }
echo $theMsg;
//header("refresh:$seconds,url:$url");
exit();




}





  ?>
