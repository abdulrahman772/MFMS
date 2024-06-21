<?php
session_start();
$nonavsid ='';
if (isset($_SESSION['username'])) {
  $page_title ='القائمة الرئيسية-ادارة المرضى';
include "init.php";
?>
    <style>
        @font-face {
            font-family: myfont;
            src: url("layout/fonts/fontmfms.ttf");
        }
    </style>
<body class="body_home" dir="rtl" style="background: white;">
<header class="" style="margin-top:0;padding:5px;">
<p class="w3-center" style=padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> القائمة الرئيسية </p>
</header>
<div class="container-fluid home_body">
<div class="row text-center">

  <div class="col-sm-4 col-md-3">
  <a href="add_doctor.php">
      <button class="allwork" >
          <img src="layout/image/19.png" alt="iconsick" class="allicon imgsick">
          <p>ادارة الدكاترة</p>
  </button>
  </a>
  </div>
  <div class="col-sm-4 col-md-3">
  <a href="add_patient.php">
      <button class="allwork" >
          <img src="layout/image/20.png" alt="iconsick" class="allicon imgsick">
            <p>ادارة المرضى</p>
  </button>
  </a>
  </div>
  <div class="col-sm-4 col-md-3">
  <a href="xray_a.php?do=manage">
      <button class="allwork" >
      <img src="layout/image/10.png" alt="iconsick" class="allicon imgsick" >
    <p> الاشعة الغير جاهزة</p>
    <?php
    $status = 1 ;
    $stmt = $con->prepare("SELECT COUNT(xrayid) FROM add_xray WHERE status = ? ");
    $stmt->execute(array($status));


  ?>
   :<?php echo $stmt->fetchColumn ();
  ?>
  </button>
  </a>
  </div>
  <div class="col-sm-4 col-md-3">
  <a href="user.php?do=Edit&id=<?php echo $_SESSION['ID'] ?>">
      <button class="allwork" >
          <img src="layout/image/1.ico" alt="iconsick" class="allicon imgsick">
        <p>بياناتي الشخصية   </p>
  </button>
  </a>
  </div>

</div>
</div>
</div>



<?php
  include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
