<?php
session_start();
$status = $_SESSION['status'];
$n ='';
if ($status == 0) {
  $nonavsid ='';
  $nnonavsid ='';
    $n ='';
}
if (isset($_SESSION['username'])) {
  $page_title ='ادارة المرضى';
include "init.php";
$do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
$userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
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
    .ok {
        width: 100%;
        padding: 10px;
        color: #fff;
        background-color: #00669b;
        border-radius: 5px;
        border:none;
        outline: none;
    }
    .ok:hover,.ok:focus {
        transition: .5s;
        opacity: 0.8;
        color: white;
    }
    .custom-file-label {
        color: #aaa;
        border-bottom: 1px solid #d2d2d2;
        border-radius: 0;
    }
    .custom-file-label:hover,.custom-file-label:focus {
        transition: .5ms;
        background-image: linear-gradient(to top, #00669b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
    }
    .form-control,
    .is-focused .form-control {
        background-image: linear-gradient(to top, #00669b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
    }
    .form-control{
        color: #00669b;
    }
    .form-control:read-only {
        background-image: linear-gradient(to top, #00669b 2px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
    }
    .bmd-form-group:not(.has-success):not(.has-danger) [class^='bmd-label'].bmd-label-floating,
    .bmd-form-group:not(.has-success):not(.has-danger) [class*=' bmd-label'].bmd-label-floating {
        color: #aaa;
    }
</style>
<body class="body_home" dir="rtl" style="font-family: myfont;background: white;">
<?php
//**************************************************************************************************
if ($do == 'manage') {
  $stmt = $con->prepare("SELECT * FROM patient ");
  $stmt->execute();
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
  ?>
    <div class="" style="">
        <header class="" style="margin-top:0;padding: 5px;">
            <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">المرضى </p>
        </header>
        <div class="container-fluid">
            <div class="row" dir="rtl">
                <div class="col-sm-5 col-md-4" style="text-align: right;">
                    <a href="add_patient.php?do=addpatient&id=<?php echo $_SESSION['ID'] ?>" class="" style="color: #00669b;"><i class="fa fa-plus"></i> اضافة مريض جديد  </a>
                </div>
            </div>
            <div class="row">
                <?php
                $counter = 0;
                foreach ($row as $row ) {
                    //  print($row['xrayimage']);
                    echo "<div class='col-sm-6 col-md-3' style='margin-top: 10px;'>";
                    echo "<div style='width:99%;padding: 5px;box-shadow: 0 2px 3px #00669b;border-radius: 10px;'>";
                    echo "<div class='' style='border-radius: 10px;padding: 10px;height: 200px;'>";
                    echo "<img src='..\imagepatient\\".$row['imagepatient']."' width='120' style='width:100%;border-radius: 10px;height: 100%;'>" ;
                    echo "</div>";
                    echo "<div class='text-right' style='color: #00669b;padding: 5px;'>";
                    echo "<p>اسم المريض:<span style='color: red;'>". $row['patientname'] . "</span></p>";
                    echo "<p>رقم الهاتف:<span style='color: red;'>". $row['phonepa'] ."</span></p>";
                    echo "<p> اسم المستخدم:<span style='color: red;'>". $row['username'] ."</span></p>";
                    echo "<p> التاريخ:<span style='color: red;'>". $row['datepatient'] ."</span></p>";
                    echo "<p> الجنس:<span style='color: red;'>". $row['gender'] ."</span></p>";
                    echo "<p> العنوان:<span style='color: red;'>". $row['address'] ."</span></p>";
                    echo "<p> المسؤل:<span style='color: red;'>". $row['userid'] ."</span></p>";
                    echo "
                        <a href='add_patient.php?do=editpatient&id=" .$row['patientid'] . "' class='btn btn-success' style='width:100%;'><i class='fa fa-edit'></i> تعديل </a>
                        <a href='add_patient.php?do=Deletepatient&id=" .$row['patientid'] . "' class='btn btn-danger confirm' style='width:100%;'><i class='fa fa-close'></i> حذف </a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

<?php
}
//*************************************************************************************************8
elseif ($do == 'addpatient') {
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM user WHERE  userid=?  LIMIT 1 ");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
      if ($stmt->rowCount() > 0) {
?>
<div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">اضافة مريض جديد </p>
    </header>
    <div class="container-fluid">
        <div class="row">
            <form  class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="?do=insertpatient" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                    <input type="hidden" name="userid" />
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                        <input class="form-control" autocomplete="off" type="text" value="" required name="patientname" style="" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                        <input class="form-control" autocomplete="off" type="text" value="" required name="phonepa" style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                        <input class="form-control" autocomplete="off" type="text" value="" required name="username" style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                        <input class="form-control" autocomplete="new-password"  type="password" value="" required name="password" style="">
                    </div>
                    <div class="form-group">
                        <select  class="form-control " name="patientgender" required placeholder=" النوع" onChange="getdoctor(this.value);" style="color: #00669b; width:100%;">
                            <option value="	<?php $x =' ذكر' ; echo htmlentities($x) ;?>"> ذكر</option>
                            <option value="	<?php $y =' انثى'; echo htmlentities($y);?>"> انثى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">العنوان</label>
                        <input class="form-control" type="text"  value="" required name="patientaddress" style="">
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="imagepatient">
                            <label class="custom-file-label" for="customFile">اختار الصورة</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="margin-top: 50px;">
                        <input type="submit" value="حفظ" class="ok"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}}
//*******************************************************************************************************
elseif ($do == 'insertpatient') {
  if ($_SERVER['REQUEST_METHOD'] =='POST'){
  $patientname=$_POST['patientname'];
  $patientgender=$_POST['patientgender'];
  $patientaddress=$_POST['patientaddress'];
  $phonepa=$_POST['phonepa'];
  $username=$_POST['username'];
  $pass =$_POST['password'];
  $hpass =sha1($pass);
$imagename = $_FILES ['imagepatient']['name'];
  $imagetmp = $_FILES ['imagepatient']['tmp_name'];
$imagep = rand(0, 100000000) . '_' . $imagename ;

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

  if (empty($patientname)) {
    $formErrors[] = 'الاسم الكامل لايمكن ان يكون <strong>فارغ</strong>';
  }

  if (empty($patientgender)) {
    $formErrors[] = ' يرجى تحديد النوع لا يمكن ان يكون <strong>فارغ </strong>';
  }
  if (empty($pass)) {
    $formErrors[] = 'كلمة المرور لايمكن ان تكون<strong>فارغ </strong>';
  }
  foreach($formErrors as $error) {
    echo "  <div class='container-fluid text-center'>";
    $theMsg= '<div class="alert alert-danger">' . $error . '</div>';
       redirecthome($theMsg, 'back');
      echo "</div>";
  }
  if (empty($formErrors)) {
     $check=checkitem("username","patient", $username);
     if($check == 1){

       echo "  <div class='container-fluid text-center'>";
        $theMsg= '<div class="alert  alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
          redirecthome($theMsg, 'back');
         echo "</div>";

     }

else {
  move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imagepatient\\" . $imagep);
  $stmt = $con->prepare("INSERT INTO
                                patient(userid, patientname, gender, address, phonepa, username, password, imagepatient, datepatient )
                                VALUES(:zuid, :zdoc, :zgen, :zadd, :zpho, :zuname, :zpass, :zim, now())  ");
  $stmt->execute(array(
    'zuid' =>$_SESSION['ID'],
    'zdoc'    =>$patientname,
    'zgen'    =>$patientgender,
    'zadd'    =>$patientaddress,
    'zpho'    =>$phonepa,
    'zuname' =>$username,
    'zpass' =>$hpass,
    'zim'    =>$imagep

  ));
  echo "  <div class='container-fluid text-center'>";
    $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
    redirecthome($theMsg, 'mmm');
    echo "</div>";
}}
}
else {
  echo "  <div class='container-fluid text-center'>";
    $theMsg ='<div class="alert alert-danger">لايمكنك الدخول </div>';
     redirecthome($theMsg, 'mmm');
    echo "</div>";
}


}
//************************************************************************
elseif ($do == 'editpatient') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM patient WHERE  patientid=? ");
    $stmt->execute(array($patientid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0) {?>
<div class="" style="">
    <header class="" style="margin-top:0;padding:5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> تعديل بيانات المرضى</p>
    </header>

    <div class="container-fluid">
        <div class="row">
            <form  class="text-center" style=" margin:0; padding:170px 0 0 0; width:100%;" action="?do=Updatapatient" method="POST" enctype="multipart/form-data">
                <?php
                echo  "<img src='..\imagepatient\\".$row['imagepatient']."' width='150px' height='150px' style='z-index:10;top:170px;right:30%;border-radius:100px;margin:-5px 0 0 -3px;position: absolute;'>" ;
                ?>
                <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                    <input type="hidden" name="patientid" value="<?php echo $patientid ?>"/>
                    <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                        <input autocomplete="off" class="form-control" type="text" value="<?php echo $row['patientname'] ?>" name="patientname" required style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                        <input class="form-control" type="text" value="<?php echo $row['phonepa'] ?>" name="phonepa" required style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                        <input class="form-control " type="text" value="<?php echo $row['username'] ?>" name="username" required style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                        <input class="form-control " type="password" autocomplete="new-password" name="newpassword" require style="">
                        <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                    </div>
                    <div class="form-group">
                        <select  class="form-control "  name="patientgender" required placeholder=" النوع" onChange="getdoctor(this.value);" style="color: #00669b; width:100%;">
                            <option value="<?php echo $row['gender'] ?>"><?php echo htmlentities($row['gender']);?> </option>
                            <option value="	<?php $x =' ذكر' ; echo htmlentities($x) ;?>"> ذكر</option>
                            <option value="	<?php $y =' انثى'; echo htmlentities($y);?>"> انثى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">العنوان</label>
                        <input class="form-control" type="text" value="<?php echo $row['address'] ?>" name="patientaddress" required style=""">
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="imagepatient">
                            <label class="custom-file-label" for="customFile">اختار الصورة</label>
                        </div>
                    </div>
                </div>
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
      redirecthome($theMsg, 'mmm');
      echo "</div>";
  }
  }
  //************************************************************************
  elseif ($do == 'Updatapatient') {
  echo "<h1 class='text-center'>تعديل البيانات الشخصية   </h1>";
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
      $patientid =$_POST['patientid'];
      $userid =$_POST['userid'];
      $patientname =$_POST['patientname'];
      $patientgender =$_POST['patientgender'];
      $patientaddress =$_POST['patientaddress'];
      $phonepa =$_POST['phonepa'];
      $username =$_POST['username'];
      $pass ='';
      if (empty($_POST['newpassword'])) {
        $pass =$_POST['oldpassword'];
      }
      else {
        $pass =sha1($_POST['newpassword']);
      }
      $imagename = $_FILES ['imagepatient']['name'];
      $imagesize = $_FILES ['imagepatient']['size'];
      $imagetmp = $_FILES ['imagepatient']['tmp_name'];
      $imagetype = $_FILES ['imagepatient']['type'];

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

      if (empty($patientname)) {
        $formErrors[] = 'الاسم الكامل لايمكن ان يكون <strong>فارغ</strong>';
      }

      if (empty($patientgender)) {
        $formErrors[] = ' يرجى تحديد النوع لا يمكن ان يكون <strong>فارغ </strong>';
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
                    patient
                    WHERE
                      username = ?
                    AND
                      patientid != ?");

        $stmt2->execute(array($username, $patientid));

        $count = $stmt2->rowCount();

        if ($count == 1) {
          echo "  <div class='container-fluid text-center'>";
          $theMsg = '<div class="alert alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
          redirecthome($theMsg, 'back');
        echo "</div>";

        } else {
          move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imagepatient\\" . $imagee);
      $stmt = $con->prepare("UPDATE patient SET username = ?, password = ?, address = ?, gender = ?, patientname = ?, phonepa = ?, imagepatient = ? WHERE patientid = ? ");
      $stmt->execute(array($username, $pass, $patientaddress, $patientgender, $patientname, $phonepa, $imagee, $patientid));
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

//************************************************************************
elseif ($do == 'Deletepatient') {
  echo "<h1 class='text-center'>حذف مريض </h1>";
  echo "<div class='container-fluid'>";

      $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

    $stmt = $con->prepare("SELECT * FROM patient WHERE  patientid=? ");
    $stmt->execute(array($patientid));
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0)
    {
      $stmt = $con->prepare("DELETE FROM patient WHERE patientid = :muser");
      $stmt->bindParam(":muser", $patientid);
      $stmt->execute();
      echo "  <div class='container-fluid text-center'>";
    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم الحذف </div>';
    redirecthome($theMsg, 'back');
    echo "</div>";
    }
    else {
      echo "  <div class='container-fluid text-center'>";
        $theMsg =  '<div class="alert alert-danger">هذا المستخدم غير موجود </div>';
          redirecthome($theMsg, 'back');
        echo "</div-fluid";
    }

}
//**************************************************************************
elseif ($do == 'searchpatient') { ?>
<div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">   بحث عن مريض    </p>
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
                    padding: 0;
                }
                .form-control:read-only {
                    background-image: linear-gradient(to top, #00669b 2px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
                }
            </style>
            <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="add_patient.php?do=searchpatient&id=<?php echo $_SESSION['ID'] ?>" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="">
                    <div class="form-group" style="">
                        <label for="exampleInput1" class="bmd-label-floating"><i class="glyphicon glyphicon-search" style="padding: 3px;"></i>ابحث بالاسم او رقم الهاتف</label>
                        <input class="form-control" type="search"  name="search" required style="">
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
                        box-shadow: 0 2px 2px 0 rgba(156, 39, 176, 0.14), 0 3px 1px -2px rgba(156, 39, 176, 0.2), 0 1px 5px 0 rgba(156, 39, 176, 0.12);
                    }
                    .ok:hover,.ok:focus {
                        opacity: 0.8;
                    }
                </style>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="margin-top: 30px;">
                        <input type="submit" value="بحث" class="ok"/>
                    </div>
                </div>
            </form>
        </div>
    <?php
  if ($_SERVER['REQUEST_METHOD'] =='POST')
  {
    $name = $_POST['search'];
  //$patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
 $stmt = $con->prepare("SELECT * FROM patient WHERE  patientname like '%$name%' OR  phonepa like '%$name%' ");
 $stmt->execute(array($name,$name));
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
 if ($stmt->rowCount() > 0)
  {
    ?>
                <div class="row">
                    <?php
                    $counter = 0;
                    foreach ($row as $row ) {
                        //  print($row['xrayimage']);
                        echo "<div class='col-sm-6 col-md-3' style='margin-top: 10px;'>";
                        echo "<div style='width:99%;padding: 5px;box-shadow: 0 2px 3px #00669b;border-radius: 10px;'>";
                        echo "<div class='' style='border-radius: 10px;padding: 10px;height: 200px;'>";
                        echo "<img src='..\imagepatient\\".$row['imagepatient']."' width='120' style='width:100%;border-radius: 10px;height: 100%;'>" ;
                        echo "</div>";
                        echo "<div class='text-right' style='color: #00669b;padding: 5px;'>";
                        echo "<p>اسم المريض:<span style='color: red;'>". $row['patientname'] . "</span></p>";
                        echo "<p>رقم الهاتف:<span style='color: red;'>". $row['phonepa'] ."</span></p>";
                        echo "<p> اسم المستخدم:<span style='color: red;'>". $row['username'] ."</span></p>";
                        echo "<p> التاريخ:<span style='color: red;'>". $row['datepatient'] ."</span></p>";
                        echo "<p> الجنس:<span style='color: red;'>". $row['gender'] ."</span></p>";
                        echo "<p> العنوان:<span style='color: red;'>". $row['address'] ."</span></p>";
                        echo "<p> المسؤل:<span style='color: red;'>". $row['userid'] ."</span></p>";
                        echo "
                        <div class='text-center'>
                        <a href='add_patient.php?do=editpatient&id=" .$row['patientid'] . "' class='btn btn-success' style='width:100%;'><i class='fa fa-edit'></i> تعديل </a>
                        <a href='add_patient.php?do=Deletepatient&id=" .$row['patientid'] . "' class='btn btn-danger confirm' style='width:100%;'><i class='fa fa-close'></i> حذف </a>
                        </div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
  }
  else {
      echo "  <div class='text-center' style='padding-top:30px;'>";
      $theMsg ='<div class="alert alert-danger">لا يوجد احد بالقيمة الذي ادخلتها...</div>';
      redirecthome($theMsg, 'back',1);
      echo "</div>";
  }}
      ?>
      <?php

  //  }
  //  else {
    //  echo "  <div class='container text-center'>";
      //  $theMsg =  '<div class="alert alert-danger">هذا المستخدم غير موجود </div>';
      //    redirecthome($theMsg, 'back');
      //  echo "</div";
  //  }

}
//***************************************************************************

include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
?>
