<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='Admin | Doctor';
include "init.php";
$do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
$userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;?>
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
if ($do == 'manage') {
  $stmt = $con->prepare("SELECT * FROM doctor ");
  $stmt->execute();
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();

  ?>

  <h1 class="text-center">add new doctor </h1>
  <div class="container">
      <div class="table">
        <table class="main-table text-center table table-bordered" dir="rtl">
          <tr>
              <td>#ID</td>
              <td>رقم الموظف</td>
              <td>الاسم</td>
              <td>الهاتف</td>
              <td>الايميل</td>
              <td>اسم المستخدم</td>
              <td> تاريخ التسجيل</td>
              <td> التحكم</td>
          </tr>
          <?php
          foreach ($row as $row ) {
            echo "<tr>";
            echo "<td>" . $row['doctorid'] . "</td>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['doctorname'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td></td>";
            echo "<td>
            <a href='add_doctor.php?do=editdoctor&id=" .$row['doctorid'] . "' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
            <a href='add_doctor.php?do=Deletedoctor&id=" .$row['doctorid'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>
            </td>";
          echo "</tr>";
          }
           ?>


        </table>
      </div>
      <a href="add_doctor.php?do=adddoctor&id=<?php echo $_SESSION['ID'] ?>" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة دكتور جديد</a>
    </div

<?php
}
//*************************************************************************************************8
elseif ($do == 'adddoctor') {
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM user WHERE  userid=?  LIMIT 1 ");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
      if ($stmt->rowCount() > 0) {
?>
<h1 class="text-center">add new doctor </h1>
<div class="container">
  <form class="form-horizontal" action="?do=insertdoctor" method="POST">
<input type="hidden" name="userid" />
    <div class="form-group">
      <label class="col-sm-2 control-label">doctor name</label>
      <div class="col-sm-10 col-md-4">
        <input type="text" name="doctorname" class="form-control"  autocomplete="off"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">phone</label>
      <div class="col-sm-10 col-md-4">
        <input type="text" name="phone" class="form-control" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Email </label>
      <div class="col-sm-10 col-md-4">
        <input type="email" name="email" class="form-control" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Username </label>
      <div class="col-sm-10 col-md-4">
        <input type="text" name="username" class="form-control"  autocomplete="off"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">password </label>
      <div class="col-sm-10 col-md-4">
        <input type="password" name="password" class="form-control" autocomplete="new-password"/>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="save" class="btn btn-primary btn-lg"/>
      </div>
    </div>
  </form>
</div>
<?php
}}
//*******************************************************************************************************
elseif ($do == 'insertdoctor') {
  echo "sdcsd";
  if ($_SERVER['REQUEST_METHOD'] =='POST'){
  $doctorname=$_POST['doctorname'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $username=$_POST['username'];
  $pass =$_POST['password'];
  $hpass =sha1($pass);
  $stmt = $con->prepare("INSERT INTO
                                doctor(userid, doctorname, phone, email, username, password )
                                VALUES(:zuid, :zdoc, :zpho, :zem, :zuname, :zpass) ");
  $stmt->execute(array(
    'zuid' =>$_SESSION['ID'],
    'zdoc'    =>$doctorname,
    'zpho'    =>$phone,
    'zem'   =>$email,
    'zuname' =>$username,
    'zpass' =>$hpass
  )
);
  echo "insert";
}
}
//************************************************************************
elseif ($do == 'editdoctor') {
  $doctorid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM doctor WHERE  doctorid=? ");
    $stmt->execute(array($doctorid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0) {?>

    <h1 class="text-center"> تعديل بيانات دكتور  </h1>
    <div class="container">
      <form class="form-horizontal" action="?do=Updatadoctor" method="POST">
          <input type="hidden" name="doctorid" value="<?php echo $doctorid ?>"/>
        <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label" dir="rtl">الاسم </label>
          <div class="col-sm-10 col-md-4">
            <input type="text" name="doctorname" class="form-control" value="<?php echo $row['doctorname'] ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">الهاتف</label>
          <div class="col-sm-10 col-md-4">
            <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ?>"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"> الايميل </label>
          <div class="col-sm-10 col-md-4">
            <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"> اسم المستخدم</label>
          <div class="col-sm-10 col-md-4">
            <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"> كلمة المرور </label>
          <div class="col-sm-10 col-md-4">
            <input type="hidden" name="oldpassword" />
            <input type="password" name="newpassword" class="form-control" autocomplete="new-password"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="save" class="btn btn-primary btn-lg"/>
          </div>
        </div>
      </form>
    </div>

  <?php
  } else {
    echo "no";
  }
  }
  //************************************************************************
  elseif ($do == 'Updatadoctor') {

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

      $formErrors = array();

      if (strlen($username) < 4) {
        $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
      }

      if (strlen($username) > 20) {
        $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
      }

      if (empty($username)) {
        $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
      }

      if (empty($doctorname)) {
        $formErrors[] = 'Doctor Name Cant Be <strong>Empty</strong>';
      }

      if (empty($email)) {
        $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
      }

      // Loop Into Errors Array And Echo It

      foreach($formErrors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
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

          $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

          redirectHome($theMsg, 'back');

        } else {
      $stmt = $con->prepare("UPDATE doctor SET username = ?, password = ?,email = ?, doctorname = ?, phone = ? WHERE doctorid = ? ");
      $stmt->execute(array($username, $pass, $email, $doctorname, $phone, $doctorid));
    echo  $stmt->rowCount().'RECORD UPDATA' ;
  }}
  }
    else {
      echo "sory";
    }
  }

//************************************************************************
elseif ($do == 'Deletedoctor') {
  echo "<h1 class='text-center'>حذف دكتور</h1>";
  echo "<div class='container'>";

      $doctorid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

    $stmt = $con->prepare("SELECT * FROM doctor WHERE  doctorid=? ");
    $stmt->execute(array($doctorid));
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0)
    {
      $stmt = $con->prepare("DELETE FROM doctor WHERE doctorid = :muser");
      $stmt->bindParam(":muser", $doctorid);
      $stmt->execute();
echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';
    }
    else {
      echo "tihs id is not";
    }

}
//**************************************************************************

include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
?>
