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


 function redirecthome($theMsg, $url=null, $seconds = 1 ){

   if ($url === null ) {
     $url = 'view_patient.php';
   }
   elseif ($url === 'nnn') {
       $url = 'dashboard.php';
   }
   elseif ($url === 'mmm') {
       $url = 'dashboard.php';
   }
   else {
     if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
       $url = $_SERVER['HTTP_REFERER'];
     }
     else {
     $url = 'view_patient.php';
     }

   }
 echo $theMsg;
 //header("refresh:$seconds;url=$url");
 exit();




 }

  ?>
