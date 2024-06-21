<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='القائمة الرئيسية-الادارة';
include "init.php";
?>
    <style>
        @font-face {
            font-family: myfont;
            src: url("layout/fonts/fontmfms.ttf");
        }
    </style>
    <body class="body_home" dir="rtl" style="background: #fff;">
<header class="" style="margin-top:0;padding:5px;">
    <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> القائمة الرئيسية </p>
</header>
    <div class="container-fluid home_body">
    <div class="row text-center">
      <div class="col-sm-4 col-md-3">
          <a href="user.php">
              <?php
              $stmt = $con->prepare("SELECT COUNT(userid) FROM user ");
              $stmt->execute();
                    ?>
              <button class="allwork" >
                 <img src="layout/image/19.png" alt="iconsick" class="allicon imgsick">
                 <p> اجمالي المستخدمين :<?php echo $stmt->fetchColumn ();?></p>
              </button>
          </a>
      </div>


      <div class="col-sm-4 col-md-3">
          <a href="add_doctor.php">
              <?php
              $stmt = $con->prepare("SELECT COUNT(doctorid) FROM doctor ");
              $stmt->execute();
              ?>
              <button class="allwork" >
                  <img src="layout/image/19.png" alt="iconsick" class="allicon imgsick">
                  <p> اجمالي الدكاترة :<?php echo $stmt->fetchColumn ();?></p>
              </button>
          </a>
      </div>



      <div class="col-sm-4 col-md-3">
          <a href="add_patient.php">
              <?php
              $stmt = $con->prepare("SELECT COUNT(patientid) FROM patient ");
              $stmt->execute();
                     ?>
              <button class="allwork" >
                  <img src="layout/image/20.png" alt="iconsick" class="allicon imgsick">
                  <p>اجمالي المرضى :<?php echo $stmt->fetchColumn ();?></p>
              </button>
          </a>
      </div>

    <div class="col-sm-4 col-md-3">
        <a href="xray_a.php?do=manage">
            <?php
            $status = 1 ;
            $stmt = $con->prepare("SELECT COUNT(xrayid) FROM add_xray WHERE status = ? ");
            $stmt->execute(array($status));
            ?>
            <button class="allwork" >
                <img src="layout/image/10.png" alt="iconsick" class="allicon imgsick" >
                <p> الاشعة الغير جاهزة:<?php echo $stmt->fetchColumn (); ?></p>
            </button>
        </a>
    </div>


        <div class="col-sm-4 col-md-3">
            <a href="user.php?do=Edit&id=<?php echo $_SESSION['ID'] ?>">
                <button class="allwork" >
                    <img src="layout/image/1.ico" alt="iconsick" class="allicon imgsick">
                    <p>بياناتي الشخصية</p>
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
