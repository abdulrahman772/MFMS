<?php
include 'cont.php';
$tpl = 'include/templt/';
$css  = 'layout/css/';
$js = 'layout/js/' ;
$img = 'layout/image/' ;
$func = 'include/fun/';


include $func . 'function.php';
include $tpl .'header.php';
if (!isset($nonavsid)) {
include $tpl .'navsid.php';  // code...
}
elseif (!isset($nnonavsid)) {
    include $tpl .'navsid2.php';  // code...
}
elseif (isset($n)) {
    include $tpl .'navsid2.php';  // code...
};

?>
