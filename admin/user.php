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
$page_title ='ادارة المستخدمين';
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
//*************************************************************************
if ($do == 'manage') {
  $stmt = $con->prepare("SELECT * FROM user ");
  $stmt->execute();
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
  ?>
    <div class="" style="">
        <header class="" style="margin-top:0;padding: 5px;">
            <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">المستخدمين </p>
        </header>
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-sm-5 col-md-4" style="text-align: right;">
                    <a href="user.php?do=add&id=<?php echo $_SESSION['ID'] ?>" class="" style="color: #00669b;"><i class="fa fa-plus"></i> اضافة مستخدم جديد  </a>
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
                echo "<img src='..\imageuser\\".$row['userimage']."' width='120' style='width:100%;border-radius: 10px;height: 100%;'>" ;
                echo "</div>";
                echo "<div class='text-right' style='color: #00669b;padding: 5px;'>";
                echo "<p>الاسم الكامل:<span style='color: red;'>". $row['fullname'] . "</span></p>";
                echo "<p>رقم الهاتف:<span style='color: red;'>". $row['phone'] ."</span></p>";
                echo "<p>البريد الالكتروني :<span style='color: red;'>". $row['email'] ."</span></p>";
                echo "<p> اسم المستخدم:<span style='color: red;'>". $row['username'] ."</span></p>";
                echo "<p> التاريخ:<span style='color: red;'>". $row['dateuser'] ."</span></p>";
                echo "<p> الجنس:<span style='color: red;'>". $row['gender'] ."</span></p>";
                echo "<p> العنوان:<span style='color: red;'>". $row['address'] ."</span></p>";
                echo "<p> العنوان:<span style='color: red;'>". $row['userid'] ."</span></p>";
                 echo "
                        <a href='user.php?do=Edit&id=" .$row['userid'] . "' class='btn btn-success' style='width:100%;'><i class='fa fa-edit'></i> تعديل </a>
                        <a href='user.php?do=Delete&id=" .$row['userid'] . "' class='btn btn-danger confirm' style='width:100%;'><i class='fa fa-close'></i> حذف </a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
       <!-- <div class="row">
            <div class="col-sm-5 col-md-4" style="">
                <div>
                    <a href="user.php?do=add" class=""><i class="fa fa-plus"></i> اضافة مستخدم جديد  </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="table">
                    <br>
                    <table class="main-table text-center table table-bordered" dir="rtl">
                        <tr style="background-color:#00669b; color:#fff;">
                          <td>#ID</td>
                          <td>الاسم</td>
                          <td>الهاتف</td>
                          <td>الايميل</td>
                          <td>اسم المستخدم</td>
                          <td> تاريخ التسجيل</td>
                          <td> التحكم</td>
                      </tr>
                     <?php
                      //$counter = 0;
                      //foreach ($row as $row ) {
                        //echo "<tr style='color: #00669b;'>";
                        //echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                        //echo "<td>" . $row['fullname'] . "</td>";
                        //echo "<td>" . $row['phone'] . "</td>";
                        //echo "<td>" . $row['email'] . "</td>";
                        //echo "<td>" . $row['username'] . "</td>";
                       // echo "<td>" . $row['dateuser'] . "</td>";
                        //echo "<td>
                       //<a href='user.php?do=Edit&id=" .$row['userid'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                        //<a href='user.php?do=Delete&id=" .$row['userid'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>
                        //</td>";
                      //echo "</tr>";
                     // }
                       ?>
                    </table>
                </div>
            </div>
        </div>-->
    </div>
    </div>
<?php
}
//********************************************************************************************************
elseif ($do == 'add') {?>
    <div class="" style="">
        <header class="" style="margin-top:0;padding: 5px;">
            <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">اضافة مستخدم جديد </p>
        </header>
    <div class="container-fluid">
        <div class="row">
            <form  class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="?do=insert" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                        <input autocomplete="off" class="form-control" type="text" value="" required name="fullname" style="" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                        <input autocomplete="off" class="form-control" type="text" value="" required name="phone" style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">البريد الالكتروني</label>
                        <input autocomplete="off" class="form-control" type="email" value="" required name="email" style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                        <input autocomplete="off" class="form-control" type="text" value="" required name="username" style="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                        <input autocomplete="new-password" class="form-control" type="password" value="" required name="password" style="">
                    </div>
                    <div class="form-group">
                        <select name="userstatus" class="form-control" onChange="getdoctor(this.value);" required="required" style="color: #00669b; width:100%;">
                            <option value="	<?php $x =0;echo htmlentities($x) ;?>">0</option>
                            <option value="	<?php $y =1;echo htmlentities($y) ;?>">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select  class="form-control " name="gender" required placeholder=" النوع" onChange="getdoctor(this.value);" style="color: #00669b; width:100%;">
                            <option value="	<?php $x =' ذكر' ; echo htmlentities($x) ;?>"> ذكر</option>
                            <option value="	<?php $y =' انثى'; echo htmlentities($y);?>"> انثى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput1" class="bmd-label-floating">العنوان</label>
                        <input class="form-control" type="text"  value="" name="address" style="">
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="imageuser">
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
}
//*******************************************************************************************************
elseif ($do == 'insert') {
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
      $user =$_POST['username'];
      $email =$_POST['email'];
      $full =$_POST['fullname'];
      $phone =$_POST['phone'];
      $pass =$_POST['password'];
      $userstatus =$_POST['userstatus'];
      $hpass =sha1($_POST['password']);
      $usergender =$_POST['gender'];
      $useraddress =$_POST['address'];
      $imagename = $_FILES ['imageuser']['name'];
      $imagesize = $_FILES ['imageuser']['size'];
      $imagetmp = $_FILES ['imageuser']['tmp_name'];
      $imagetype = $_FILES ['imageuser']['type'];

      $imagee = rand(0, 100000000) . '_' . $imagename ;

      $formErrors = array();

      if (strlen($user) < 4) {
        $formErrors[] =  'اسم المستخدم لايمكن ان يكون اقل من   <strong>4 حروف</strong>';
      }

      if (strlen($user) > 20) {
        $formErrors[] = 'اسم المستخدم لايمكن ان يكون اكبر من <strong>20 حرف</strong>';
      }

      if (empty($user)) {
        $formErrors[] = 'اسم المستخدم لايمكن ان يكون  <strong>فارغ</strong>';
      }

      if (empty($full)) {
        $formErrors[] = 'الاسم الكامل لايمكن ان يكون <strong>فارغ</strong>';
      }

      if (empty($email)) {
        $formErrors[] = 'الايميل لا يمكن ان يكون <strong>فارغ </strong>';
      }
      foreach($formErrors as $error) {
        echo "  <div class='container-fluid text-center'>";
        $theMsg= '<div class="alert alert-danger">' . $error . '</div>';
           redirecthome($theMsg, 'user');
          echo "</div>";
      }

  if (empty($formErrors)) {
     $check=checkitem("username","user", $user);
     if($check == 1){

       echo "  <div class='container-fluid text-center'>";
        $theMsg= '<div class="alert  alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
          redirecthome($theMsg, 'user');
         echo "</div>";

     }
     else {
       move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imageuser\\" . $imagee);
       $stmt = $con->prepare("INSERT INTO
                                     user(username, phone, email, fullname, password, userstatus, userimage, dateuser, gender, address)
                                     VALUES(:zusername, :zpho, :zemai, :zfull, :zpassword, :zim, :zst, now(), :zgender, :zaddress)  ");
       $stmt->execute(array(
         'zusername' =>$user,
         'zpho'    =>$phone,
         'zemai'   =>$email,
         'zfull' =>$full,
         'zpassword' =>$hpass,
         'zim' =>$imagee,
         'zst' =>$userstatus,
         ':zgender' =>$usergender,
           'zaddress' =>$useraddress
       ));

       echo "  <div class='container-fluid text-center'>";
         $theMsg = '<div class="alert  alert-success">تمت الاضافة بنجاح </div>';
         redirecthome($theMsg,'user');
         echo "</div>";
     }

}}
else {
  echo "  <div class='container-fluid text-center'>";
    $theMsg ='<div class="alert alert-danger">لايمكنك الدخول </div>';
     redirecthome($theMsg, 'user');
    echo "</div>";
}
}
//*****************************************************************************************************
elseif ($do == 'Edit') {
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM user WHERE  userid=? ");
  $stmt->execute(array($userid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  if ($stmt->rowCount() > 0) {?>
      <div class="" style="">
      <header class="" style="margin-top:0;padding:5px;">
          <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> تعديل البيانات  </p>
      </header>

      <div class="container-fluid">
          <div class="row">
              <form  class="text-center" style=" margin:0; padding:170px 0 0 0; width:100%;" action="?do=Updata" method="POST" enctype="multipart/form-data">
                  <?php
                  echo  "<img src='..\imageuser\\".$row['userimage']."' width='150px' height='150px' style='z-index:10;top:170px;right:30%;border-radius:100px;margin:-5px 0 0 -3px;position: absolute;'>" ;
                  ?>
                  <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                     <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                          <input autocomplete="off" class="form-control" type="text" value="<?php echo $row['fullname'] ?>" name="fullname" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                          <input class="form-control" type="text" value="<?php echo $row['phone'] ?>" name="phone" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                          <input class="form-control " type="text" value="<?php echo $row['username'] ?>" name="username" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">البريد الالكتروني</label>
                          <input class="form-control" type="email" value="<?php echo $row['email'] ?>" name="email" required style="">
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                          <input class="form-control " type="password" autocomplete="new-password" name="newpassword" require style="">
                          <input class="form-control " type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                      </div>
                      <div class="form-group">
                          <select  class="form-control "  name="gender" required onChange="getdoctor(this.value);" style="color: #00669b; width:100%;">
                              <option value="<?php echo $row['gender'] ?>"><?php echo htmlentities($row['gender']);?> </option>
                              <option value="	<?php $x = 'ذكر' ; echo htmlentities($x) ;?>">ذكر</option>
                              <option value="	<?php $y = 'انثى'; echo htmlentities($y);?>">انثى</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInput1" class="bmd-label-floating">العنوان</label>
                          <input class="form-control" type="text" value="<?php echo $row['address'] ?>" name="address" required style="">
                      </div>
                      <div class="form-group">
                          <select  class="form-control "  name="userstatus" required onChange="getdoctor(this.value);" style="color: #00669b; width:100%;">
                              <option value="<?php echo $row['userstatus'] ?>"><?php echo htmlentities($row['userstatus']);?> </option>
                              <option value="	<?php $x = 0 ; echo htmlentities($x) ;?>">0</option>
                              <option value="	<?php $y = 1; echo htmlentities($y);?>">1</option>
                          </select>
                      </div>
                      <div class="form-group" style="margin-top: 40px;">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile" name="imageuser">
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
    redirecthome($theMsg, 'user');
    echo "</div>";
}
}
//********************************************************************************************************
elseif ($do == 'Updata') {
  if ($_SERVER['REQUEST_METHOD'] =='POST'){
    $id =$_POST['userid'];
    $user =$_POST['username'];
    $email =$_POST['email'];
    $full =$_POST['fullname'];
    $phone =$_POST['phone'];
    $pass ='';
    if (empty($_POST['newpassword'])) {
      $pass =$_POST['oldpassword'];
    }
    else {
      $pass =sha1($_POST['newpassword']);
    }
    $usergender =$_POST['gender'];
    $useraddress =$_POST['address'];
    $userstatus =$_POST['userstatus'];
    $imagename = $_FILES ['imageuser']['name'];
    $imagesize = $_FILES ['imageuser']['size'];
    $imagetmp = $_FILES ['imageuser']['tmp_name'];
    $imagetype = $_FILES ['imageuser']['type'];

    $imagee = rand(0, 100000000) . '_' . $imagename ;
    $formErrors = array();

    if (strlen($user) < 4) {
      $formErrors[] =  'اسم المستخدم لايمكن ان يكون اقل من   <strong>4 حروف</strong>';
    }

    if (strlen($user) > 20) {
      $formErrors[] = 'اسم المستخدم لايمكن ان يكون اكبر من <strong>20 حرف</strong>';
    }

    if (empty($user)) {
      $formErrors[] = 'اسم المستخدم لايمكن ان يكون  <strong>فارغ</strong>';
    }

    if (empty($full)) {
      $formErrors[] = 'الاسم الكامل لايمكن ان يكون <strong>فارغ</strong>';
    }

    if (empty($email)) {
      $formErrors[] = 'الايميل لا يمكن ان يكون <strong>فارغ </strong>';
    }

    // Loop Into Errors Array And Echo It

    foreach($formErrors as $error) {
      echo "  <div class='container-fluid text-center'>";
        $theMsg = '<div class="alert alert-danger">' . $error . '</div>';
        redirecthome($theMsg, 'user');
        echo "</div>";
    }

    if (empty($formErrors)) {

      $stmt2 = $con->prepare("SELECT
                    *
                  FROM
                    user
                  WHERE
                    username = ?
                  AND
                    userid != ?");

      $stmt2->execute(array($user, $id));

      $count = $stmt2->rowCount();

      if ($count == 1) {
        echo "  <div class='container-fluid text-center'>";
        $theMsg = '<div class="alert alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
        redirecthome($theMsg, 'user');
        echo "</div>";
      } else {
        move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imageuser\\" . $imagee);
    $stmt = $con->prepare("UPDATE user SET username = ?, password = ?,email = ?, fullname = ?, phone = ?, userimage = ?, gender = ?, address = ?, userstatus = ? WHERE userid = ? ");
    $stmt->execute(array($user, $pass, $email, $full, $phone, $imagee, $usergender,$useraddress,$userstatus, $id));
    echo "  <div class='container-fluid text-center'>";
    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التعديل </div>';
     redirecthome($theMsg, 'user');
  echo "</div>";
}}
}
  else {
    echo "  <div class='container-fluid text-center'>";
      $theMsg = '<div class="alert alert-danger">لايمكنك الدخول </div>';
      redirecthome($theMsg, 'user');
      echo "</div>";
  }
}
//*********************************************************************************************************
elseif ($do == 'Delete') {
  
  echo "<div class='container-fluid'>";

    $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM user WHERE  userid=? ");
    $stmt->execute(array($userid));
    $count = $stmt->rowCount();

    if ($stmt->rowCount() > 0)
    {

      $stmt = $con->prepare("DELETE FROM user WHERE userid = :muser");
      $stmt->bindParam(":muser", $userid);
      $stmt->execute();
      echo "  <div class='container-fluid text-center'>";
  $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم الحذف </div>';
  redirecthome($theMsg, 'user');
  echo "</div>";
    }
    else {
      echo "  <div class='container-fluid text-center'>";
        $theMsg =  '<div class="alert alert-danger">هذا المستخدم غير موجود </div>';
          redirecthome($theMsg, 'user');
        echo "</div>";
    }
}
//**************************************************************************
elseif ($do == 'searchuser') {
    ?>
    <div class="" style="">
    <header class="" style="margin-top:0;padding: 5px;">
        <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">   بحث عن مستخدم    </p>
    </header>
    <div class="container-fluid">
    <div class="row">
        <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="user.php?do=searchuser&id=<?php echo $_SESSION['ID'] ?>" method="POST" enctype="multipart/form-data">
            <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="">
                <div class="form-group" style="">
                    <label for="exampleInput1" class="bmd-label-floating"><i class="glyphicon glyphicon-search" style=""></i>ابحث بالاسم او رقم الهاتف</label>
                    <input class="form-control" type="search"  name="search" required style="">
                </div>
            </div>
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
        //$userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $name = $_POST['search'];
        $stmt = $con->prepare("SELECT * FROM user WHERE  fullname like '%$name%' OR  phone like '%$name%' ");
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
                    echo "<img src='..\imageuser\\".$row['userimage']."' width='120' style='width:100%;border-radius: 10px;height: 100%;'>" ;
                    echo "</div>";
                    echo "<div class='text-right' style='color: #00669b;padding: 5px;'>";
                    echo "<p>اسم كامل:<span style='color: red;'>". $row['fullname'] . "</span></p>";
                    echo "<p>رقم الهاتف:<span style='color: red;'>". $row['phone'] ."</span></p>";
                    echo "<p>البريد الالكتروني:<span style='color: red;'>". $row['email'] ."</span></p>";
                    echo "<p> اسم المستخدم:<span style='color: red;'>". $row['username'] ."</span></p>";
                    echo "<p> التاريخ:<span style='color: red;'>". $row['dateuser'] ."</span></p>";
                    echo "<p> الجنس:<span style='color: red;'>". $row['gender'] ."</span></p>";
                    echo "<p> العنوان:<span style='color: red;'>". $row['address'] ."</span></p>";
                    echo "<p> المسؤل:<span style='color: red;'>". $row['userid'] ."</span></p>";
                    echo "
                        <div class='text-center'>
                        <a href='user.php?do=Edit&id=" .$row['userid'] . "' class='btn btn-success' style='width:100%;'><i class='fa fa-edit'></i> تعديل </a>
                        <a href='user.php?do=Delete&id=" .$row['userid'] . "' class='btn btn-danger confirm' style='width:100%;'><i class='fa fa-close'></i> حذف </a>
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
            redirecthome($theMsg, 'user');
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
//**************************************************************************

//**************************************************************
  include $tpl . 'footer.php';
}
else {
  header('Location: index.php');
  exit();
}
