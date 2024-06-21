<?php
session_start();
$nonavsid ='';
$nnonavsid='';
$x2= 0;
$page_title ='Login';
$do = isset($_GET['do']) ? $_GET['do'] : 'mmm' ;
  $x3=0;
  $nn ='';
if (isset($_SESSION['username'])) {

 header('Location: dashboard.php'); // Redirect To Dashboard Page
}
?>
<style>
    @font-face {
        font-family: myfont;
        src: url("layout/fonts/fontmfms.ttf");
    }
    .container-fluid{
        font-family: myfont;
    }
    .form-control,
    .is-focused .form-control {
        background-image: linear-gradient(to top, #00669b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
        padding-right: 5px;
    }
  .form-control{
      color: #fff;
  }
 .rpr{
 color: #fff;
 font-size: 14px;
 text-align: right;
 padding-right: 40px;
 font-weight: bold;
 font-family: myfont;
}
 .ppr{
color: #fff;
font-size: 14px;
text-align: right;
padding-right: 30px;
}
.masg{
color: white;
 font-size: 10px;
 text-align: right;
}
</style>
<?php
include "init.php";
if ($do == 'psa') {

  ?>
  <div class="container-fluid">
      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
              <div class="bac_titel w3-animate-bottom">
                  <p><span>اعادة</span>تأكيد <span>كلمة</span>المرور</p>
                  <form class="body_log" dir="rtl" action="?do=psa" method="POST">
                      <input class="input_login" type="text" placeholder="البريد الالكتروني" name="emile" autocomplete="off" autofocus required>
                      <br>
                      <input class="input_login" type="password" placeholder=" رقم التلفون" name="pass" autocomplete="new-password" required>
                      <button type="submit" class="w3-animate-zoom"><img src="layout/image/37.ico">إرسال
                      </button>
                  </form>
              </div>
          </div>
      </div>
  </div>
<?php
}
elseif ($do == 'mmm') {
$userstatus = 1;
if ($_SERVER['REQUEST_METHOD'] =='POST')
{
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $haspass = sha1($password);

    $stmt = $con->prepare("SELECT
              userid ,username , password, userstatus, fullname, userimage
                   FROM
                  user
                   WHERE
                  username=?
                  AND
                  password =?
                  AND
                  userstatus = ?
                  LIMIT 1 ");
    $stmt->execute(array($username, $haspass, $userstatus));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0)
    {
       $_SESSION['username'] = $username;
        $_SESSION['ID'] = $row['userid'];
        $_SESSION['status'] = $row['userstatus'];
        $_SESSION['fullname'] = $row['fullname'];
          $_SESSION['userimage'] = $row['userimage'];
        header('Location: dashboard.php'); // Redirect To Dashboard Page
       exit();
     }
     else {
       $uuserstatus = 0;
       $stmtv = $con->prepare("SELECT
                 userid ,username , password, userstatus, fullname, userimage
                      FROM
                     user
                      WHERE
                     username=?
                     AND
                     password =?
                     AND
                     userstatus = ?
                     LIMIT 1 ");
       $stmtv->execute(array($username, $haspass, $uuserstatus));
       $row = $stmtv->fetch();
         $count = $stmtv->rowCount();
       if ($count > 0)
       {
          $_SESSION['username'] = $username;
           $_SESSION['ID'] = $row['userid'];
             $_SESSION['status'] = $row['userstatus'];
             $_SESSION['fullname'] = $row['fullname'];
               $_SESSION['userimage'] = $row['userimage'];
           header('Location: dashboard2.php'); // Redirect To Dashboard Page
          exit();
        }
        else {
          //$z += 1;
           $_SESSION['loginfild'] += 1;
           $nn="<h6 class='rpr'>اسم المستخدم او كلمة المرور خاطئة</h6>";
          //$_SESSION['error'] =" اسم المستخدم او كلمة المرور خاطئة";
          $x2=1;
        }

     }


}
else {
 //$_SESSION['error'] ="";
  $_SESSION['loginfild']=0;
  $_SESSION['loginfild'] =$_SESSION['loginfild'] +1;
  //$_SESSION['loginfild'] += 1;
  //$nn="<p class='pr'>اسم المستخدم او كلمة المرور خاطئة</p>";
//$_SESSION['error'] =" اسم المستخدم او كلمة المرور خاطئة";
  //$x2=1;
}

?>
<body dir="rtl">
<body class="container-fluid">
    <div class="row">
        <div style="width: 100%;padding: 30px 50px 0 50px;margin: 0;">
            <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;padding-left: 33%; padding-right: 40%;">
                <div class="top_img w3-animate-zoom">
                    <img src="layout/image/31.ico" alt="user img">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="" style="width: 100%;padding: 0 50px;margin: 0;"  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="col-sm-12 col-sm-offset-3 col-md-5 col-md-offset-4" style="text-align: center;">
                <div class="bac_titel w3-animate-zoom" style="padding-bottom: 20px;">
                    <p class="titel-log"><span>تس</span>جيل <span>الد</span>خول</p>
                    <div class="form-group" style="padding: 27px 20px 0 20px;">
                        <label for="exampleInput1" class="bmd-label-floating" style="color: white;">اسم المستخدم</label>
                        <input autocomplete="off" class="form-control" type="text" value="" required name="user" style="" autofocus>
                    </div>
                    <div class="form-group" style="padding: 27px 20px 0 20px;">
                        <label for="exampleInput1" class="bmd-label-floating" style="color: white;">كلمة المرور</label>
                        <input autocomplete="new-password" class="form-control" type="password" value="" required name="pass" style="">
                    </div>
                    <p class="ppr"><a href="login.php?do=psa" class="ppr">هل نسيت كلمة المرور؟ </a></p>

                        <?php
                        if ($x2 == 1); {
                      echo $nn;

                        }
                         ?>

                         <?php
                         //if ($z > 5) {
                      if ($_SESSION['loginfild'] > 5) {
                           //$_SESSION['looked'] = time();
                           //echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
                            //   $theMsg ='<div class="alert alert-danger">يرجى المحاولة لاحقا</div>';
                             //redirecthome($theMsg);
                             //echo "</div>";
                         }
                         else {
                             ?>
                       <button type="submit" class="w3-animate-zoom"><img src="layout/image/37.ico">دخول
                        </button>
  <?php }
  ?>
</div>

            </div>
        </form>
    </div>

    <script src="<?php echo $js ?>jquery-1.10.2.min.js"></script>
    <script src="<?php echo $js ?>bootstrap.min.js"></script>
    <script src="<?php echo $js ?>backand.js"></script>
    <script src="<?php echo $js ?>jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo $js ?>popper.min.js" type="text/javascript"></script>
    <script src="<?php echo $js ?>bootstrap-material-design.min.js" type="text/javascript"></script>


    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->

    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo $js ?>material-kit.js?v=2.0.7" type="text/javascript"></script>
<!--<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<h4  class="text-center" >  patient login </h4>
<input  class="form-control" type="text" name="user" placeholder="user name" autocomplete="off" />
<input class="form-control" type="password" name="pass"  placeholder="password" autocomplete="new-password"/>
<input class="btn btn-primary btn-block" type="submit" value="Login" />
</form>-->
</body>
<?php } ?>
