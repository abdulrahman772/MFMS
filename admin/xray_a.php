<?php
session_start();
$status = $_SESSION['status'];
$n ='';
if ($status == 0) {
  $nonavsid ='';
  $nnonavsid ='';
}
if (isset($_SESSION['username'])) {
  $page_title ='ادارة المرضى';
include "init.php";
$do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
$userid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
?>
<body class="body_home" dir="rtl" style="font-family: myfont;background: white;">
    <?php
//**************************************************************************************************
if ($do == 'manage') {
  $stmt = $con->prepare("SELECT * FROM add_xray WHERE status = 1 ");
  $stmt->execute();
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
  if ($count > 0) {
  ?>
      <div class="" style="">
          <header class="" style="margin-top:0;padding: 5px;">
              <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">الاشعة الغير جاهزة </p>
          </header>
          <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-12 col-md-12">
                      <div class="table">
                          <br>
                          <table class="main-table text-center table table-bordered" dir="rtl">
                              <tr style="background-color:#00669b; color:#fff;">
                                  <td>#ID</td>
                                  <td>رقم المريض</td>
                                  <td> اسم الاشعة </td>
                                  <td>نوع الاشعة</td>
                                  <td> رقم الدكتور</td>
                                  <td> التاريخ   </td>
                                  <td> التحكم</td>
                              </tr>
                                  <?php
                                      $counter=0;
                                      foreach ($row as $row) {
                                          echo "<tr style='color: #00669b;'>";
                                          echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                                          echo "<td>" . $row['patientid'] . "</td>";
                                          echo "<td>" . $row['xrayname'] . "</td>";
                                          echo "<td>" . $row['xraytype'] . "</td>";
                                          echo "<td>" . $row['doctorid'] . "</td>";
                                          echo "<td>" . $row['datexray'] . "</td>";
                                          echo "<td>
                                          <a href='xray_a.php?do=addpatientxray&idd=" .$row['xrayid'] . "&id=" .$row['patientid'] . "' class='btn btn-success'><i class='fa fa-edit'></i> اضافة </a>
                                          <a href='#' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>
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
  echo "<div class='alert alert-success'>  لايوجد اشعة </div>";
  echo "</div>";
}
}
//*************************************************************************************************8
elseif ($do == 'addpatientxray') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $xrayid = isset($_GET['idd']) && is_numeric($_GET['idd']) ? intval($_GET['idd']) : 0;
?>
<div class="w3-card-8" style="border:5px solid #00699b; border-top-left-radius:5px;border-top-right-radius:5px; border-bottom-left-radius:10px;border-bottom-right-radius:10px;">
<header class="w3-card-8" style="background-color:#00699b; border-bottom-left-radius:30px;border-bottom-right-radius:30px; margin-top:0px;">
<p class="w3-center" style="padding-top:0px;color:#fff;font-weight:bold;font-size:25px;"> اضافة اشعة لمريض  </p>
</header>
<div class="container">
  <form  method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="xrayimage" >
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" value="save" class="btn btn-primary btn-lg"/>

        </div>
      </div>
  </form>
  </div>
  </div>
<?php
if ($_SERVER['REQUEST_METHOD'] =='POST'){
  $status = 2;
//$xrayimage = addslashes(file_get_contents($_FILES['xrayimage']['tmp_name']));



  $imagename = $_FILES ['xrayimage']['name'];
  $imagesize = $_FILES ['xrayimage']['size'];
  $imagetmp = $_FILES ['xrayimage']['tmp_name'];
  $imagetype = $_FILES ['xrayimage']['type'];

  //$imageallo = array("png","jpg","gif","jpeg");
  //$imageexeb =strtolower( end(explode('.',$imagename)));

$imagee = rand(0, 100000000) . '_' . $imagename ;
//move_uploaded_file($imagetmp, "uplode\\" . $imagee);
//move_uploaded_file($imagetmp, "C:\\xampp\htdocs\medsys\uplode\\" . $imagee);
move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\uplode\\" . $imagee);

$stmt = $con->prepare("UPDATE add_xray SET xrayimage = ?, status = ?  WHERE xrayid = ?");
$stmt->execute(array($imagee ,$status ,$xrayid ));
echo "  <div class='container-fluid text-center'>";
$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تمت الاضافة بنجاح </div>';
 redirecthome($theMsg, 'xxx');
echo "</div>";

}
?>



<?php
}
//*******************************************************************************************************
elseif ($do == 'insertxxx') {


    if ($_SERVER['REQUEST_METHOD'] =='POST'){



    $stmt = $con->prepare("INSERT INTO
                                  patient(userid, patientname, gender, address, phonepa, username, password )
                                  VALUES(:zuid, :zdoc, :zgen, :zadd, :zpho, :zuname, :zpass) ");
    $stmt->execute(array(
      'zuid' =>$_SESSION['ID'],
      'zdoc'    =>$patientname,
      'zgen'    =>$patientgender,
      'zadd'    =>$patientaddress,
      'zpho'    =>$phonepa,
      'zuname' =>$username,
      'zpass' =>$hpass
    )
    );
    echo "insert";
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
