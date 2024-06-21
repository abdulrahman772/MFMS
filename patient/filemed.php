<?php
session_start();
$nonavbar ='';
if (isset($_SESSION['username'])) {
  $page_title ='المرضى';
include "init.php";
$do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
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
if ($do == 'med') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM medicine INNER JOIN doctor ON medicine.doctorid=doctor.doctorid  WHERE  patientid=?  ORDER BY medid DESC");
  $stmt->execute(array($patientid));
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
  if ($stmt->rowCount() > 0) {
  ?>
<div class="">
  <header class="" style="margin-top:0;padding:5px;">
    <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> الادوية </p>
</header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-md-12">
      <div class="table">
        <br>
        <table class="main-table text-center table table-bordered" dir="rtl">
          <tr style="background-color:#00669b; color:#fff;">
              <td>#ID</td>
              <td> اسم العلاج  </td>
              <td> الوصف</td>
              <td>اسم الدكتور </td>
              <td> التاريخ</td>
          </tr>
          <?php
          $counter = 0;
          foreach ($row as $row ) {
            echo "<tr style='color: #00669b;'>";
            echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
            echo "<td>" . $row['medname'] . "</td>";
            echo "<td>" . $row['meddis'] . "</td>";
            echo "<td>" . $row['doctorname'] . "</td>";
            echo "<td>" . $row['meddate'] . "</td>";
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
  echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
$theMsg ='<div class="alert alert-danger">لايوجد ادوية </div>';
   redirecthome($theMsg, 'back',1);
  echo "</div>";
}
}
//**************************************************************************
elseif ($do == 'xray') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $status = 2;
  $stmt = $con->prepare("SELECT * FROM add_xray INNER JOIN doctor ON add_xray.doctorid=doctor.doctorid  WHERE status=? AND patientid=?  ORDER BY xrayid DESC");
  $stmt->execute(array($status,$patientid));
  $row = $stmt->fetchAll();
  if ($stmt->rowCount() > 0) {
    ?>
    <div class="">
      <header class="" style="margin-top:0;padding:5px;">
  <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> الاشعة </p>
    </header>
  <div class="container-fluid">
    <div class="row">
        <style>
            .big_img:hover{
                transition: .5s;
                opacity: .8;
            }
        </style>
             <?php
          $counter = 0;

          foreach ($row as $row ) {
          //  print($row['xrayimage']);
                echo "<div class='col-sm-4 col-md-3' style='margin-top: 10px;'>";
                echo "<div style='width:99%;padding: 5px;box-shadow: 0 2px 3px #00669b;border-radius: 10px;'>";
                    echo "<div class='' style='border-radius: 10px;padding: 10px;height: 200px;'>";
                        echo "<a href='filemed.php?do=zoom&id=" .$row['xrayid'] ."'><img src='..\uplode\\".$row['xrayimage']."' width='120' style='width:100%;border-radius: 10px;height: 100%;' ></a>" ;
                    echo "</div>";
                        echo "<div class='text-right' style='color: #00669b;padding: 5px;'>";
                            echo "<p>اسم الاشعة:<span style='color: red;'>". $row['xrayname'] . "</span></p>";
                            echo "<p>نوع الاشعة:<span style='color: red;'>". $row['xraytype'] ."</span></p>";
                            echo "<p> اسم الدكتور:<span style='color: red;'>". $row['doctorname'] ."</span></p>";
                            echo "<p> التاريخ:<span style='color: red;'>". $row['datexray'] ."</span></p>";
                        echo "</div>";
                echo "</div>";
                echo "</div>";
            }
          ?>
             <?php
             //$counter = 0;

             //foreach ($row as $row ) {
                 //  print($row['xrayimage']);
                 //echo "<tr>";
                 //echo "<td>" . ++$counter . "</td>";
                 //echo "<td>" . $row['xrayname'] . "</td>";
                 //echo "<td>" . $row['xraytype'] . "</td>";
                 //echo "<td>" . $row['doctorname'] . "</td>";
                 //echo "<td>" . $row['datexray'] . "</td>";
                 //echo "<td> <img src='..\uplode\\".$row['xrayimage']."' width='90' ></td>" ;

                 //  echo '<img width=300 height=400 src="data:image/jpg;base64,'.base64_encode($row['xrayimage']).'">';
                 //  echo  "</td>";
               //  echo "</tr>";
             //}
             ?>
      </div>
  </div>
</div>
<?php
}
else {
  echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
$theMsg ='<div class="alert alert-danger">لايوجد اشعة</div>';
   redirecthome($theMsg, 'back',1);
  echo "</div>";
}
}
//**********************************************************************************
elseif ($do == 'zoom') {
    $xrayid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM add_xray WHERE xrayid=?");
    $stmt->execute(array($xrayid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0) {
        ?>
        <div class="" style="">
            <header class="" style="margin-top:0;padding: 5px;">
                <link rel="stylesheet" href="layout/css/bootstrap.css">
                <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> عرض الاشعة  </p>
                <style>
                    * {box-sizing: border-box;}

                    .img-zoom-container {
                        position: relative;
                        padding: 0;
                    }

                    .img-zoom-lens {
                        position: absolute;
                        border: 1px solid #d4d4d4;
                        /*set the size of the lens:*/
                        width: 40%;
                        height: 40%;
                    }
                    img{
                        border-radius: 10px;
                    }
                    .img-zoom-result {
                        border: 1px solid #d4d4d4;
                        /*set the size of the result div:*/
                        width: 100%;
                        height: 100%;
                        border-radius: 10px;
                    }

                </style>
                <script>
                    function imageZoom(imgID, resultID) {
                        var img, lens, result, cx, cy;
                        img = document.getElementById(imgID);
                        result = document.getElementById(resultID);
                        /*create lens:*/
                        lens = document.createElement("DIV");
                        lens.setAttribute("class", "img-zoom-lens");
                        /*insert lens:*/
                        img.parentElement.insertBefore(lens, img);
                        /*calculate the ratio between result DIV and lens:*/
                        cx = result.offsetWidth / lens.offsetWidth;
                        cy = result.offsetHeight / lens.offsetHeight;
                        /*set background properties for the result DIV:*/
                        result.style.backgroundImage = "url('" + img.src + "')";
                        result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
                        /*execute a function when someone moves the cursor over the image, or the lens:*/
                        lens.addEventListener("mousemove", moveLens);
                        img.addEventListener("mousemove", moveLens);
                        /*and also for touch screens:*/
                        lens.addEventListener("touchmove", moveLens);
                        img.addEventListener("touchmove", moveLens);
                        function moveLens(e) {
                            var pos, x, y;
                            /*prevent any other actions that may occur when moving over the image:*/
                            e.preventDefault();
                            /*get the cursor's x and y positions:*/
                            pos = getCursorPos(e);
                            /*calculate the position of the lens:*/
                            x = pos.x - (lens.offsetWidth / 2);
                            y = pos.y - (lens.offsetHeight / 2);
                            /*prevent the lens from being positioned outside the image:*/
                            if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
                            if (x < 0) {x = 0;}
                            if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
                            if (y < 0) {y = 0;}
                            /*set the position of the lens:*/
                            lens.style.left = x + "px";
                            lens.style.top = y + "px";
                            /*display what the lens "sees":*/
                            result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
                        }
                        function getCursorPos(e) {
                            var a, x = 0, y = 0;
                            e = e || window.event;
                            /*get the x and y positions of the image:*/
                            a = img.getBoundingClientRect();
                            /*calculate the cursor's x and y coordinates, relative to the image:*/
                            x = e.pageX - a.left;
                            y = e.pageY - a.top;
                            /*consider any page scrolling:*/
                            x = x - window.pageXOffset;
                            y = y - window.pageYOffset;
                            return {x : x, y : y};
                        }
                    }
                </script>
            </header>

                <div class="img-zoom-container">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3 col-md-6">
                            <?php
                            echo  "<img id='myimage' src='..\uplode\\".$row['xrayimage']."' style='width: 100%;height: 100%;'>"
                            ?>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div id="myresult" class="img-zoom-result"></div>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                // Initiate zoom effect:
                imageZoom("myimage", "myresult");
            </script>

        </div>
        <?php
    }
    else {
        echo "  <div class='container-fluid text-center'>";
        $theMsg ='<div class="alert alert-danger">لايوجد اشعة</div>';
        redirecthome($theMsg, 'back',1);
        echo "</div>";
    }
}
//***********************************************************************
elseif ($do == 'test') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $status = 2;
  $stmt = $con->prepare("SELECT * FROM add_test INNER JOIN doctor ON add_test.doctorid=doctor.doctorid  WHERE patientid=? ORDER BY testid DESC ");
  $stmt->execute(array($patientid));
  $row = $stmt->fetchAll();
  if ($stmt->rowCount() > 0) {
    ?>
    <div class="">
<header class="" style="margin-top:0;padding: 5px;">
  <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> الفحوصات </p>
    </header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
      <div class="table">
        <br>
        <table class="main-table text-center table table-bordered" dir="rtl">
        <tr style="background-color:#00669b; color:#fff";>
              <td>#ID</td>
              <td>اسم الفحص   </td>
              <td>اسم الدكتور </td>
              <td> التاريخ</td>
              <td> النتيجة</td>
          </tr>
          <?php
          $counter = 0;

          foreach ($row as $row ) {
          //  print($row['xrayimage']);
            echo "<tr style='color: #00669b;'>";
            echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
            echo "<td>" . $row['testname'] . "</td>";
            echo "<td>" . $row['doctorname'] . "</td>";
          //  echo "<td>" . $row['datexray'] . "</td>";
          //  echo "<td> <img src='..\uplode\\".$row['xrayimage']."' width='90' ></td>" ;

          //  echo '<img width=300 height=400 src="data:image/jpg;base64,'.base64_encode($row['xrayimage']).'">';
          //  echo  "</td>";
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
  echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
$theMsg ='<div class="alert alert-danger">لايوجد فحوصات</div>';
   redirecthome($theMsg);
  echo "</div>";
}
}
//*******************************************************************************
elseif ($do == 'doxray') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $status = 1;
  $stmt = $con->prepare("SELECT * FROM add_xray INNER JOIN doctor ON add_xray.doctorid=doctor.doctorid  WHERE status=? AND patientid=?  ");
  $stmt->execute(array($status,$patientid));
  $row = $stmt->fetchAll();
  if ($stmt->rowCount() > 0) {
    ?>
    <div class="">
<header class="" style="margin-top:0;padding: 5px;">
  <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> الاشعة الغير جاهزة </p>
    </header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-10 col-md-12">
      <div class="table">
        <br>
        <table class="main-table text-center table table-bordered" dir="rtl">
        <tr style="background-color:#00669b; color:#fff";>
            <td>#ID</td>
            <td> اسم الاشعة   </td>
            <td> نوع الاشعة</td>
            <td>اسم الدكتور </td>
            <td> التاريخ</td>
          </tr>
          <?php
          $counter = 0;

          foreach ($row as $row ) {
          //  print($row['xrayimage']);
            echo "<tr style='color: #00669b;'>";
            echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
            echo "<td>" . $row['xrayname'] . "</td>";
            echo "<td>" . $row['xraytype'] . "</td>";
            echo "<td>" . $row['doctorname'] . "</td>";
            echo "<td>" . $row['datexray'] . "</td>";
          //  echo "<td>" . $row['datexray'] . "</td>";
          //  echo "<td> <img src='..\uplode\\".$row['xrayimage']."' width='90' ></td>" ;

          //  echo '<img width=300 height=400 src="data:image/jpg;base64,'.base64_encode($row['xrayimage']).'">';
          //  echo  "</td>";
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
  echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
$theMsg ='<div class="alert alert-danger">لا يوجد اشعة </div>';
   redirecthome($theMsg, 'back',1);
  echo "</div>";
}
}



//********************************************************************************
elseif ($do == 'report') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM report INNER JOIN doctor ON report.doctorid=doctor.doctorid  WHERE  patientid=? ORDER BY reportid DESC ");
  $stmt->execute(array($patientid));
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
  if ($stmt->rowCount() > 0) {
    ?>
    <div class="">
    <header class="" style="margin-top:0; padding: 5px;">
      <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> التقارير </p>
    </header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
      <div class="table">
        <br>
        <table class="main-table text-center table table-bordered" dir="rtl">
          <tr style="background-color:#00669b; color:#fff;">
              <td>#ID</td>
              <td> التقرير </td>
              <td>اسم الدكتور </td>
              <td> التاريخ</td>
              <td> التحكم</td>
          </tr>
          <?php
          $counter = 0;
          foreach ($row as $row ) {
            echo "<tr style='color: #00669b;'>";
            echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
            echo "<td>" . $row['reportname'] . "</td>";
            echo "<td>" . $row['doctorname'] . "</td>";
            echo "<td>" . $row['reportdate'] . "</td>";
            echo "<td>
            <a href='filemed.php?do=print&id=" .$row['reportid'] . "' class='btn btn-success'><i class='fa fa-print'></i> طباعة  </a>
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
  echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
$theMsg ='<div class="alert alert-danger">لايوجد تقارير</div>';
   redirecthome($theMsg, 'back',1);
  echo "</div>";
}
}
//*******************************************************************************
elseif ($do == 'print') {
  $reportid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM report
    INNER JOIN doctor ON report.doctorid=doctor.doctorid
    INNER JOIN patient ON report.patientid = patient.patientid
    WHERE  reportid=?  ");
  $stmt->execute(array($reportid));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  if ($stmt->rowCount() > 0) {
  ?>


    <div class='print-data' style="border-right: 5px solid #00669b;padding: 20px;">
      <div class='form-holder' style='background:#fff;'>

        <div class='row'>
            <div class='col-md-12 p-data'>
                <div class="text-right"><strong style="color: #00669b;">رقم المريض:</strong> <span style="color: red;"><?php echo  $row['patientid'];?></span></div>
                <div class="text-right"><strong style="color: #00669b;">اسم المريض :</strong> <span style="color: red;"><?php echo  $row['patientname'];?></span></div>
                <div class="text-right"><strong style="color: #00669b;">التاريخ :</strong><span style="color: red;"><?php echo $row['reportdate'];?></span> </div>
          </div>
        </div><br />

        <div class='row'>
          <div class='col-md-12 p-ref text-right' style="padding-bottom: 20px;">
            <div class="text-center" style="color: #00669b;font-size: large;" >تقرير طبي </div><br>
          <?php echo $row['reportname'];?>
          </div>

          <div class='col-md-12 p-ref'>
            <div class="text-center" > وقد تم اعطاءة هذا التقرير بحسب طلبة </div><br>
          </div>

          <div class='col-md-12 p-ref'>
            <div class="text-right"><strong style="color: #00669b;">الدكتور :</strong> <span style="color: red;"><?php echo  $row['doctorname'];?></span> </div><br>
          </div>


        </div>


      </div>

    </div>
        <div style="padding-right: 150px;">
            <div dir="ltr" style="border-top: 2px solid #00669b;padding: 15px 0 10px 50px;">
                <div class='' style=''><button class="btn print-p-data" style="background: red;color: white;">   طباعة  <i class='fa fa-print'></i></button></div>
            </div>
        </div>
<?php
}}
//*******************************************************************************
elseif ($do == 'editpatient') {
  $patientid = $_SESSION['IDD'];
    $stmt = $con->prepare("SELECT * FROM patient WHERE  patientid=? ");
    $stmt->execute(array($patientid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($stmt->rowCount() > 0) {?>
      <div class="" style="">
          <header class="" style="margin-top:0;padding:5px;">
            <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;"> البيانات الشخصية</p>
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
                    }
                </style>
                <form  class="text-center" style=" margin:0; padding:170px 0 0 0; width:100%;" action="?do=Updatapatient" method="POST" enctype="multipart/form-data">
                    <?php
                    echo  "<img src='..\imagepatient\\".$_SESSION['imagepatient']."' width='150px' height='150px' style='z-index:10;top:170px;right:30%;border-radius:100px;margin:-5px 0 0 -3px;position: absolute;'>" ;
                    ?>
                    <div class="col-sm-12 col-sm-offset-3 col-md-6 col-md-offset-3" style="text-align: center;">
                        <input type="hidden" name="patientid" value="<?php echo $patientid ?>"/>
                        <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">الاسم الكامل</label>
                            <input autocomplete="off" class="form-control" type="text" value="<?php echo $row['patientname'] ?>" name="patientname" style="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">رقم الهاتف</label>
                            <input class="form-control" type="text" value="<?php echo $row['phonepa'] ?>" name="phonepa" style="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">اسم المستخدم</label>
                            <input class="form-control" type="text" value="<?php echo $row['username'] ?>" name="username"  style="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">كلمة السر</label>
                            <input class="form-control"  type="password" autocomplete="new-password" name="newpassword" style="">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">الجنس</label>
                            <input class="form-control" type="text"  value="<?php echo $row['gender'] ?>" name="patientgender" style="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1" class="bmd-label-floating">العنوان</label>
                            <input class="form-control" type="text"  value="<?php echo $row['address'] ?>" name="patientaddress" style="">
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
                            <input type="file" class="custom-file-input" id="customFile" name="imagepatient">
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
    echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
        $theMsg ='<div class="alert alert-danger">هذا الرقم غير صحيح</div>';
      redirecthome($theMsg);
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

      $imageq = rand(0, 100000000) . '_' . $imagename ;

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

      if (empty($phonepa)) {
        $formErrors[] = ' رقم الهاتف لايمكن ان يكون <strong>فارغ </strong>';
      }

      foreach($formErrors as $error) {
        echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
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
          echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
          $theMsg = '<div class="alert alert-danger">اسم المستخدم غير متوفر يرجى تغييرة</div>';
          redirecthome($theMsg, 'back');
        echo "</div>";

        } else {
      move_uploaded_file($imagetmp, "C:\\xampp\htdocs\MFMS\imagepatient\\" . $imageq);
      $stmt = $con->prepare("UPDATE patient SET username = ?, password = ?, address = ?, gender = ?, patientname = ?, phonepa = ?, imagepatient = ? WHERE patientid = ? ");
      $stmt->execute(array($username, $pass, $patientaddress, $patientgender, $patientname, $phonepa, $imageq, $patientid));
      echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التعديل </div>';
       redirecthome($theMsg, 'back');
       echo "</div>";
  }}
  }
    else {
      echo "  <div class='container-fluid text-center' style='padding-top: 10px;'>";
        $theMsg = '<div class="alert alert-danger">لايمكنك الدخول </div>';
        redirecthome($theMsg, 'back');
        echo "</div>";
    }
  }
//*********************************************************************************8

include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
?>
