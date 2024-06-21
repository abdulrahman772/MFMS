<?php
include 'C:\xampp\htdocs\MFMS\admin\cont.php';
$tpl = 'include/templt/';
$css  = 'layout/css/';
$js = 'layout/js/' ;
$img = 'layout/image/' ;
$func = 'include/fun/';
include $func . 'function.php';
include $tpl .'header.php';
if (!isset($nonavsid)) {
include $tpl .'navsid.php';  // code...
};
//include $tpl .'sider.php';
?>
