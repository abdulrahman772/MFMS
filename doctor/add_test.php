<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='test | Patient';
  include "init.php";
  $do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
  $doctorid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
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
<body class="body_home" dir="rtl" style="font-family: myfont;background: #fff;">
      <?php
  //**************************************************************************************************
  if ($do == 'medpatient') {
    $doctorid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
    $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $stmt = $con->prepare("SELECT * FROM patient WHERE  $patientid=?  LIMIT 1 ");
      $stmt->execute(array($patientid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
  ?>

  <div class="" style="">
   <header class="" style="margin-top:0;padding: 5px;">
<p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">اضافة علاج جديد </p>
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
              </style>
              <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="?do=medinsert" method="POST">
                  <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="">
                      <input type="hidden" name="patientid" value="<?php echo $patientid  ?>"/>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">اسم العلاج</label>
                            <input class="form-control" type="text" name="medname" required autofocus style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">الوصف</label>
                          <textarea class="form-control"  name="meddis" required  style=""></textarea>
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
                          <input type="submit" value="حـفـظ" class="ok"/>
                      </div>
                  </div>
              </form>
      </div>

  </div>
  <?php
  }}
  //*******************************************************************************************************
  elseif ($do == 'medinsert') {
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
      $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $patientid=$_POST['patientid'];
    $medname=$_POST['medname'];
    $meddis=$_POST['meddis'];

  $formErrors = array();
  if (empty($medname)) {
    $formErrors[] = ' يرجى ادخال اسم<strong> العلاج</strong>';
  }
  if (empty($meddis)) {
    $formErrors[] = ' يرحى ادخال <strong>الوصف </strong>';
  }
  foreach($formErrors as $error) {
     echo "  <div class='container text-center'>";
     $theMsg= '<div class="alert alert-danger">' . $error . '</div>';
        redirecthome($theMsg, 'back');
       echo "</div";
   }

    $stmt = $con->prepare("INSERT INTO
                                  medicine(patientid, doctorid, medname, meddis, meddate)
                                  VALUES(:zuid, :zudi, :zup, :zdoc, now()) ");
    $stmt->execute(array(
      'zuid'    =>$patientid,
	  'zudi'    =>$_SESSION['ID'],
	  'zup'    =>$medname,
    'zdoc'   =>$meddis,
    ));
  echo "  <div class='container-fluid text-center'>";
    $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
    redirecthome($theMsg);
    echo "</div>";
  }
  else {
    echo "  <div class='container-fluid text-center'>";
      $theMsg ='<div class="alert alert-danger">لايمكنك الدخول </div>';
       redirecthome($theMsg);
      echo "</div>";
  }
  }
  //*******************************************************************************************************
  elseif ($do == 'addxray') {
    $doctorid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
    $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $stmt = $con->prepare("SELECT * FROM patient WHERE  $patientid=?  LIMIT 1 ");
      $stmt->execute(array($patientid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
  ?>
  <div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> اضافة اشعة  </p>
    </header>
      <div class="container-fluid">
          <div class="row">
              <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;"  action="?do=xrayinsert" method="POST">
                  <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="">
                      <input type="hidden" name="patientid" value="<?php echo $patientid  ?>"/>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating"> اسم الاشعة</label>
                          <input class="form-control" type="text" name="xrayname" required autofocus style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating"> نوع الاشعة</label>
                          <input class="form-control" type="text" name="xraytype" required style="">
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
                      <input type="submit" value="حـفـظ" class="ok"/>
                    </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <?php
  }
  }
  //************************************************************************
elseif ($do == 'xrayinsert') {
if ($_SERVER['REQUEST_METHOD'] =='POST'){
    $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$patientid=$_POST['patientid'];
  $xrayname=$_POST['xrayname'];
  $xraytype=$_POST['xraytype'];
  $status = 1;
  $formErrors = array();
  if (empty($xrayname)) {
    $formErrors[] = ' يرجى ادخال اسم<strong> الاشعة</strong>';
  }
  if (empty($xraytype)) {
    $formErrors[] = ' يرحى ادخال <strong>نوع الاشعة  </strong>';
  }
  foreach($formErrors as $error) {
     echo "  <div class='container-fluid text-center'>";
     $theMsg= '<div class="alert alert-danger">' . $error . '</div>';
        redirecthome($theMsg, 'back');
       echo "</div>";
   }
  $stmt = $con->prepare("INSERT INTO
                                add_xray(xrayname, xraytype, patientid, doctorid, status, datexray)
                                VALUES(:zuid, :ztudi, :zup, :zudi, :zdoc, now()) ");
  $stmt->execute(array(
    'zuid'    =>$xrayname,
    'ztudi'    =>$xraytype,
    'zup'    =>$patientid,
  'zudi'    =>$_SESSION['ID'],
  'zdoc'   =>$status,
  ));
echo "  <div class='container-fluid text-center'>";
  $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
  redirecthome($theMsg);
  echo "</div>";
}
else {
  echo "  <div class='container-fluid text-center'>";
    $theMsg ='<div class="alert alert-danger">لايمكنك الدخول </div>';
     redirecthome($theMsg);
    echo "</div>";
}
}
  //********************************************************************************
elseif ($do == 'addreport') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM patient WHERE  $patientid=?  LIMIT 1 ");
  $stmt->execute(array($patientid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0) {
  ?>
  <div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> اضافة تقرير   </p>
    </header>
      <div class="container-fluid">
          <div class="row">
              <form  class="text-center" style=" margin:0; padding:10px 0 0 0; width:100%;" action="?do=insertreport" method="POST">
                  <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                      <input type="hidden" name="patientid" value="<?php echo $patientid  ?>"/>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">اكتب التقرير</label>
                          <textarea class="form-control" name="reportname" required style=""></textarea>
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
                      <input type="submit" value="حـفـظ" class="ok"/>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <?php
}}
  //**************************************************************************************
elseif ($do == 'insertreport') {
  if ($_SERVER['REQUEST_METHOD'] =='POST'){
      $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $patientid=$_POST['patientid'];
    $reportname=$_POST['reportname'];
    $formErrors = array();
    if (empty($reportname)) {
      $formErrors[] = '    يرجى اضافة <strong> التقرير</strong>';
    }
    foreach($formErrors as $error) {
       echo "  <div class='container-fluid text-center'>";
       $theMsg= '<div class="alert alert-danger">' . $error . '</div>';
          redirecthome($theMsg, 'back');
         echo "</div>";
     }
    $stmt = $con->prepare("INSERT INTO
                                  report(reportname, patientid, doctorid, reportdate)
                                  VALUES(:zuid, :ztudi, :zup, now()) ");
    $stmt->execute(array(
      'zuid'    =>$reportname,
      'ztudi'    =>$patientid,
      'zup'    =>$_SESSION['ID'],
    )
  );
  echo "  <div class='container-fluid text-center'>";
    $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
    redirecthome($theMsg);
    echo "</div>";
  }
  else {
    echo "  <div class='container-fluid text-center'>";
      $theMsg ='<div class="alert alert-danger">لايمكنك الدخول </div>';
       redirecthome($theMsg);
      echo "</div>";
  }
}

  //************************************************************************
elseif ($do == 'appointment') {
  $status = 1 ;
  $doctorid =$_SESSION['ID'];
  $stmt = $con->prepare("SELECT * FROM appointment INNER JOIN patient ON appointment.patientid=patient.patientid
    WHERE doctorstatus = ? AND doctorid =? ");
  $stmt->execute(array($status,$doctorid));
  $row = $stmt->fetchAll();
    $count = $stmt->rowCount();
if ($stmt->rowCount() > 0) {
    ?>
    <div class="" style="">
      <header class="" style="margin-top:0;padding: 5px;">
    <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> المواعيد   </p>
      </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="table">
                  <br>
                  <table class="main-table text-center table table-bordered" dir="rtl">
                    <tr style="background-color:#00669b; color:#fff;">
                        <td>#ID</td>
                        <td> رقم المريض   </td>
                        <td> اسم المريض </td>
                        <td> التاريخ</td>
                        <td> التحكم </td>
                    </tr>
                    <?php
                    $counter =0;
                    foreach ($row as $row ) {
                      echo "<tr style='color: #00669b;'>";
                      echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                      echo "<td>" . $row['patientid'] . "</td>";
                      echo "<td>" . $row['patientname'] . "</td>";
                      echo "<td>" . $row['dateappointment'] . "</td>";
                      echo "<td>
                      <a href='add_test.php?do=acappointment&idd=" .$row['appointmentid'] . "' class='btn btn-success'><i class='fa fa-edit'></i> اضافة </a>
                      </td>";
                    echo "</tr>";
                    }
                     ?>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
else {
  echo "  <div class='container-fluid text-center'>";
$theMsg ='<div class="alert alert-danger">لا يوجد لديك مواعيد</div>';
   redirecthome($theMsg, 'mmm',1);
  echo "</div>";
}}

  //*******************************************************************************************
 elseif ($do == 'acappointment') {
    $appointmentid = isset($_GET['idd']) && is_numeric($_GET['idd']) ? intval($_GET['idd']) : 0;
  $dstatus = 0 ;
   $pstatus = 1 ;
    $stmt = $con->prepare("UPDATE appointment SET doctorstatus = ?, patientstatus = ?, dateappointment = now() WHERE appointmentid = ?  ");
   $stmt->execute(array($dstatus,$pstatus,$appointmentid));
  echo "  <div class='container-fluid text-center'>";
  $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم الحـفـظ </div>';
   redirecthome($theMsg, 'back',1);
echo "</div>";
 }
  //******************************************************************************************
  elseif ($do == 'editdoctor') {
    $doctorid =$_SESSION['ID'];
      $stmt = $con->prepare("SELECT * FROM doctor WHERE  doctorid=? ");
      $stmt->execute(array($doctorid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
      if ($stmt->rowCount() > 0) {?>
    <div class="" style="">
          <header class="" style=" margin-top:0;padding: 5px;">
            <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> بياناتي الشخصية   </p>
          </header>

      <div class="container-fluid">
          <div class="row">
              <form  class="text-center" style=" margin:0; padding:170px 0 0 0; width:100%;" action="?do=Updatadoctor" method="POST" enctype="multipart/form-data">
                  <?php
                  echo  "<img src='..\imagedoctor\\".$_SESSION['imagedoctor']."' width='150px' height='150px' style='z-index:10;top:170px;right:30%;border-radius:100px;margin:-5px 0 0 -3px;position: absolute;'>" ;
                  ?>
                  <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                      <input type="hidden" name="doctorid" value="<?php echo $doctorid ?>"/>
                      <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                          <input autocomplete="off" class="form-control" type="text" value="<?php echo $row['doctorname'] ?>" name="doctorname" required  style=""">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                          <input class="form-control" type="text" value="<?php echo $row['phone'] ?>" name="phone" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                          <input class="form-control" type="text" value="<?php echo $row['username'] ?>" name="username" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">البريد الالكتروني</label>
                          <input class="form-control" type="email" value="<?php echo $row['email'] ?>" name="email" required style=""">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                          <input class="form-control" type="password" autocomplete="new-password" name="newpassword" required  style="">
                          <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                      </div>
                      <style>
                          .custom-file-label {
                              color: #aaa;
                              border-bottom: 1px solid #d2d2d2;
                              border-radius: 0;
                          }
                          .custom-file-label:hover,.custom-file-label:focus {
                              transition: .5ms;
                              background-image: linear-gradient(to top, #00669b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
                          }
                      </style>
                      <div class="form-group" style="margin-top: 40px;">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile" name="imagedoctor">
                              <label class="custom-file-label" for="customFile">اختار الصورة</label>
                          </div>
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
                        <input type="submit" value="حـفـظ" class="ok"/>
                    </div>
                  </div>
             </form>
          </div>
      </div>
    </div>

    <?php
    } else {
      echo "  <div class='container-fluid text-center'>";
          $theMsg ='<div class="alert alert-danger">هذا الرقم غير صحيح</div>';
        redirecthome($theMsg, 'nnn');
        echo "</div>";
    }
    }
    //************************************************************************
    elseif ($do == 'Updatadoctor') {
      echo "<h1 class='text-center'>تعديل البيانات الشخصية   </h1>";
      if ($_SERVER['REQUEST_METHOD'] =='POST'){
        $doctorid =$_POST['doctorid'];
        $userid =$_POST['userid'];
        $doctorname =$_POST['doctorname'];
        $phone =$_POST['phone'];
        $email =$_POST['email'];
        $username =$_POST['username'];
        $pass ='';
        if (empty($_POST['newpassword'])) {
          $pass =$_POST['oldpassword'];
        }
        else {
          $pass =sha1($_POST['newpassword']);
        }
        $imagename = $_FILES ['imagedoctor']['name'];
        $imagesize = $_FILES ['imagedoctor']['size'];
        $imagetmp = $_FILES ['imagedoctor']['tmp_name'];
        $imagetype = $_FILES ['imagedoctor']['type'];

        $imagee = rand(0, 100000000) . '_' . $imagename ;

        $formErrors = array();

        if (strlen($username) < 4) {
          $formErrors[] =  'اسم المستخدم لايمكن ان يكون اقل من   <strong>4 حروف</strong>';
        }

        if (strlen($username) > 20) {
          $formErrors[] = 'اسم المستخدم لايمكن ان يكون اكبر من <strong>20 حرف</strong>';
        }

        if (empty($username)) {
          $formErrors[] = 'اسم المستخدم لايمكن ان يكون  <strong>فارغ</strong>';
        }

        if (empty($doctorname)) {
          $formErrors[] = 'الاسم الكامل لايمكن ان يكون <strong>فارغ</strong>';
        }

        if (empty($phone)) {
          $formErrors[] = ' رقم الهاتف لايمكن ان يكون <strong>فارغ </strong>';
        }

        foreach($formErrors as $error) {
          echo "  <div class='container-fluid text-center'>";
            $theMsg = '<div class="alert alert-danger">' . $error . '</div>';
            redirecthome($theMsg, 'back');
            echo "</div>";
        }

        if (empty($formErrors)) {

          $stmt2 = $con->prepare("SELECT
                        *
                      FROM
                        doctor
                      WHERE
                        username = ?
                      AND
                        doctorid != ?");

          $stmt2->execute(array($username, $doctorid));

          $count = $stmt2->rowCount();

          if ($count == 1) {

            echo "  <div class='container-fluid text-center'>";
            $theMsg = '<div class="alert alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
            redirecthome($theMsg, 'back');
          echo "</div>";

          } else {
        move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imagedoctor\\" . $imagee);
        $stmt = $con->prepare("UPDATE doctor SET username = ?, password = ?,email = ?, doctorname = ?, phone = ?, imagedoctor = ? WHERE doctorid = ? ");
        $stmt->execute(array($username, $pass, $email, $doctorname, $phone, $imagee, $doctorid));
        echo "  <div class='container-fluid text-center'>";
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التعديل </div>';
         redirecthome($theMsg, 'back');
         echo "</div>";
    }}
    }
      else {
        echo "  <div class='container-fluid text-center'>";
          $theMsg = '<div class="alert alert-danger">لايمكنك الدخول </div>';
          redirecthome($theMsg, 'back');
          echo "</div>";
      }
    }
  //*********************************************************8
  elseif ($do == 'test') {
    echo "  <div class='container-fluid text-center'>";
        $theMsg ='<div class="alert alert-danger">عذرا الصفحة قيد التطوير</div>';
      redirecthome($theMsg, 'nnn',5);
      echo "</div>";
  }
  //***********************************************************************
  include $tpl . 'footer.php';
  }
  else {
    header('Location: login.php');
    exit();
  }
  ?>
