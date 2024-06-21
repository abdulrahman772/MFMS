<?php
session_start();
$nonavbar ='';
if (isset($_SESSION['username'])) {
  $page_title ='القائمة الرئيسية- المرضى';
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

<p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> القائمة الرئيسية </p>

  </header>

<div class="container-fluid home_body">
<div class="row text-center">
<div class="col-sm-4 col-md-3">

        <a href="filemed.php?do=test&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
          <button class="allwork" >
              <img src="layout/image/4.ico" alt="iconsick" class="allicon imgsick">
              <p>الفحوصات  </p>
          </button>
        </a>

  </div>
  <div class="col-sm-4 col-md-3">
<a href="filemed.php?do=med&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
      <button class="allwork" >
          <img src="layout/image/2.ico" alt="iconsick" class="allicon imgsick">

        <p> الادوية </p>
  </button>

</a>

  </div>
  <div class="col-sm-4 col-md-3">
<a href="filemed.php?do=report&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
      <button class="allwork" >
          <img src="layout/image/12.png" alt="iconsick" class="allicon imgsick">

        <p>التقارير  </p>
  </button>

</a>

  </div>
  <div class="col-sm-4 col-md-3">
<a href="filemed.php?do=xray&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
      <button class="allwork" >
          <img src="layout/image/10.png" alt="iconsick" class="allicon imgsick">
        <p>الاشعة  </p>
  </button>
</a>

  </div>
  <div class="col-sm-4 col-md-3">
<a href="appointment.php?do=addappointment&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
      <button class="allwork" >
          <img src="layout/image/3.ico" alt="iconsick" class="allicon imgsick">

        <p>حجز موعد </p>
  </button>

</a>

  </div>
  <div class="col-sm-4 col-md-3">
  <a href="appointment.php?do=showappointment&id=<?php echo $_SESSION['IDD'] ?>" class="a_css">
      <button class="allwork" >
          <img src="layout/image/11.png" alt="iconsick" class="allicon imgsick">

        <p>المواعيد  </p>
  </button>

  </a>

  </div>
  <div class="col-sm-4 col-md-3">
<a href="filemed.php?do=editpatient" class="a_css">
      <button class="allwork" >
          <img src="layout/image/1.ico" alt="iconsick" class="allicon imgsick">

        <p>بياناتي الشخصية   </p>
  </button>

</a>

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
