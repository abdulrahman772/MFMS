<?php
session_start();
$nonavbar ='';
if (isset($_SESSION['username'])) {
  $page_title ='Dashboard | doctor';
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
              <a href="view_patient.php">
                <button class="allwork" >
                    <img src="layout/image/16.png" alt="iconsick" class="allicon imgsick">
                    <p>المرضى  </p>
                </button>
              </a>
            </div>
            <div class="col-md-3 col-sm-4">
            <a href="add_test.php?do=editdoctor">
                <button class="allwork" >
                    <img src="layout/image/1.ico" alt="iconsick" class="allicon imgsick">
                  <p>بياناتي الشخصية   </p>
            </button>
            </a>
            </div>

            <div class="col-sm-3 col-md-4">
            <a href="add_test.php?do=appointment&id=<?php echo $_SESSION['ID'] ?>">
              <?php
              $status = 1 ;
              $doctorid =$_SESSION['ID'];
              $stmt = $con->prepare("SELECT COUNT(appointmentid) FROM appointment INNER JOIN patient ON appointment.patientid=patient.patientid
                WHERE doctorstatus = ? AND doctorid =? ");
              $stmt->execute(array($status,$doctorid));
            ?>
                <button class="allwork" >
                    <img src="layout/image/11.png" alt="iconsick" class="allicon imgsick">
                  <p> اجمالي المواعيد:<?php echo $stmt->fetchColumn ();?> </p>
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
