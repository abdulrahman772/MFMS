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
  ?>
