<?php
session_start();
$nonavbar ='';
if (isset($_SESSION['username'])) {
  $page_title ='patient | appointment';
  include "init.php";
  $do = isset($_GET['do']) ? $_GET['do'] : 'addappointment' ;
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  ?>
<style>
    @font-face {
        font-family: myfont;
        src: url("layout/fonts/fontmfms.ttf");
    }
    ::-webkit-scrollbar{
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-thumb {
        cursor: pointer;
        background: #00669b;
        border-radius: 50px;
    }
</style>
<body class="body_home" dir="rtl" style="font-family: myfont;background: white;">

  <?php
  //**************************************************************************************************
  if ($do == 'addappointment') {
    $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $stmt = $con->prepare("SELECT * FROM patient WHERE  patientid=?  LIMIT 1 ");
      $stmt->execute(array($patientid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
  ?>
  <div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
      <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">حجز موعد  </p>
    </header>
      <div class="container-fluid">
          <div class="row">
              <style>
                  .form-control,
                  .is-focused .form-control {
                      background-image: linear-gradient(to top, #00669b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
                  }
                  .form-control{
                      color: #00669b;
                      padding: 10px;
                  }
                  .form-control:read-only {
                      background-image: linear-gradient(to top, #00669b 2px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
                  }
                  option{
                      background: white;
                      color: #00669b;
                  }
              </style>
            <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="?do=insertapp" method="POST">
                <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="">
                    <input type="hidden" name="patientid" value="<?php echo $patientid  ?>"/>
                    <div class="form-group">
                        <select name="doctorapp" class="form-control" onChange="getdoctor(this.value);" required="required" style="color: #00669b; width:100%;" autofocus>
                            <option value="" style="color: red;">اسم الدكتور</option>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM doctor ");
                            $stmt->execute();
                            $row = $stmt->fetchAll();
                            foreach ($row as $row ) {
                            ?>
                            <option style="" value="<?php echo htmlentities($row['doctorname']);?>">
                            <?php echo htmlentities($row['doctorname']);?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <style>
                    .ok {
                        width: 100%;
                        padding: 10px;
                        color: #fff;
                        background-color: #00669b;
                        border-radius: 5px;
                        border:none;
                    }
                    .ok:hover,.ok:focus {
                        opacity: 0.8;
                    }
                </style>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="margin-top: 50px;">
                        <input type="submit" value="حجز" class="ok"/>
                    </div>
                </div>
            </form>
      </div>
  </div>
  </div>

  <?php
  }}
  //*******************************************************************************************************
  elseif ($do == 'insertapp') {
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
  $patientid=$_POST['patientid'];
    $doctorapp=$_POST['doctorapp'];
    $stmtt = $con->prepare("SELECT * FROM doctor WHERE  doctorname=?  LIMIT 1 ");
    $stmtt->execute(array($doctorapp));
    $row = $stmtt->fetch();
    $count = $stmtt->rowCount();
      if ($stmtt->rowCount() > 0) {
    $doctorid = $row['doctorid'] ;
$doctorstatus = 1;
  $stmt = $con->prepare("INSERT INTO
                               appointment(patientid, doctorid, doctorstatus, dateappointment )
                                 VALUES(:zuid, :zdoc, :zst, now()) ");
    $stmt->execute(array(
    'zuid'    =>$patientid,
      'zdoc' =>$doctorid,
      'zst' =>$doctorstatus,
    ));
  echo "  <div class='container-fluid text-center'>";
    $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
    redirecthome($theMsg);
    echo "</div>";
  }
}}
  //************************************************************************
elseif ($do == 'showappointment') {
  $status = 1 ;
  $stmt = $con->prepare("SELECT * FROM appointment  INNER JOIN doctor ON appointment.doctorid=doctor.doctorid
    WHERE patientstatus = ?  ORDER BY appointmentid DESC");
  $stmt->execute(array($status));
  $row = $stmt->fetchAll();
    $count = $stmt->rowCount();
  if ($stmt->rowCount() > 0) {
    ?>
    <div class="">
    <header class="" style="margin-top:0; padding: 5px;">
        <p class="text-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> المواعيد </p>
    </header>
    <div class="">
        <div class="table">
          <br>
          <table class="main-table text-center table table-bordered" dir="rtl">
            <tr style="background-color:#00669b; color:#fff;">
                <td>#ID</td>
                <td>اسم الدكتور  </td>
                <td>التاريخ </td>
                <td>وقت الدوام </td>
            </tr>
            <?php
            $counter =0;
            foreach ($row as $row ) {
              echo "<tr style='color: #00669b;'>";
              echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
              echo "<td>" . $row['doctorname'] . "</td>";
              echo "<td>" . $row['dateappointment'] . "</td>";
              echo "<td>    من الساعة 4 عصرا الى الساعة 8 مساء </td>";
            echo "</tr>";
            }
             ?>
          </table>
        </div>
</div>
</div>
  <?php
  }
  else {
    echo "  <div class='container-fluid text-center'>";
  $theMsg ='<div class="alert alert-danger"> لا يوجد لديك مواعيد</div>';
     redirecthome($theMsg, 'back',1);
    echo "</div>";
  }
}
  //************************************************************************
  include $tpl . 'footer.php';
  }
  else {
    header('Location: login.php');
    exit();
  }
  ?>
