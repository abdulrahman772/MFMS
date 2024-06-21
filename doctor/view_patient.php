<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='doctor | Patient';
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
    .btn_ho_fu{
        color: white;
        background-color: #00669b;
    }
    .btn_ho_fu:hover,.btn_ho_fu:focus{
        opacity: 0.8;
        background-color: red;
    }
    .dropdown-menu li>a:hover,.dropdown-menu li>a:focus{
        background-color: #00669b;
        color: white;
    }
    .bmd-form-group:not(.has-success):not(.has-danger) [class^='bmd-label'].bmd-label-floating,
    .bmd-form-group:not(.has-success):not(.has-danger) [class*=' bmd-label'].bmd-label-floating {
        color: #aaa;
    }
</style>
<body class="body_home" dir="rtl" style="font-family: myfont;background: #fff;">
    <?php
//**************************************************************************************************
if ($do == 'manage') {
  $stmt = $con->prepare("SELECT * FROM patient ORDER BY patientid DESC ");
  $stmt->execute();
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();

  ?>
<div class="" style="">
  <header class="" style="margin-top:0;padding: 5px;">
  <p class="w3-center" style="padding-top:0;color:#00669b;font-weight:bold;font-size:25px;">المرضى </p>
  </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="table">
                    <br>
                    <table class="main-table text-center table table-bordered" dir="rtl">
                        <tr style="background-color:#00669b; color:#fff;">
                              <td>#ID</td>
                              <td> اسم المريض </td>
                              <td>النوع</td>
                              <td>العنوان</td>
                              <td>رقم الهاتف</td>
                              <td> التحكم</td>
                        </tr>
                          <?php
                          $counter=0;
                          foreach ($row as $row) {
                                  echo "<tr style='color: #00669b;'>";
                                  echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                                  echo "<td>" . $row['patientname'] . "</td>";
                                  echo "<td>" . $row['gender'] . "</td>";
                                  echo "<td>" . $row['address'] . "</td>";
                                  echo "<td>" . $row['phonepa'] . "</td>";
                                  echo "<td><div class='dropdown'>
                                        <a href='add_test.php?do=test&id=" . $row['patientid'] . "' class='btn btn-success'>فحص  </a>
                                        <a href='add_test.php?do=medpatient&id=" . $row['patientid'] . "' class='btn btn-success'>  علاج </a>
                                        <a href='add_test.php?do=addxray&id=" . $row['patientid'] . "' class='btn btn-success'>اشعة </a>
                                        <a href='add_test.php?do=addreport&id=" . $row['patientid'] . "' class='btn btn-success'> تقرير  </a>
                                          <button class='btn dropdown-toggle btn_ho_fu' type='button'  data-toggle='dropdown'>  عرض 
                                          </button>
                                          <ul class='dropdown-menu ' role='menu' aria-labelledby='menu1'>
                                            <li role='presentation'><a role='menuitem' href='view_patient.php?do=xray&id=" . $row['patientid'] . "'>الاشعة</a></li>
                                            <li role='presentation'><a role='menuitem' href='#'>الفحوصات</a></li>
                                            <li role='presentation'><a role='menuitem' href='view_patient.php?do=report&id=" . $row['patientid'] . "'>التقارير</a></li>
                                            <li role='presentation'><a role='menuitem' href='view_patient.php?do=med&id=" . $row['patientid'] . "'>الادوية</a></li>
                            
                                          </ul>
                                            </div>
                            
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
//**************************************************************************
elseif ($do == 'viewpatient') {
  ?>
  <button type="button" class="btn">Basic</button>
  <button type="button" class="btn btn-primary">Primary</button>
  <button type="button" class="btn btn-secondary">Secondary</button>
  <button type="button" class="btn btn-success">Success</button>
  <button type="button" class="btn btn-info">Info</button>
  <button type="button" class="btn btn-warning">Warning</button>
  <button type="button" class="btn btn-danger">Danger</button>
  <button type="button" class="btn btn-dark">Dark</button>
  <button type="button" class="btn btn-light">Light</button>
  <button type="button" class="btn btn-link">Link</button>

  <a href="#" class="btn btn-info" role="button">Link Button</a>
<?php
}
//**********************************************************************
elseif ($do == 'xray') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $status = 2;
  $stmt = $con->prepare("SELECT * FROM add_xray INNER JOIN doctor ON add_xray.doctorid=doctor.doctorid  WHERE status=? AND patientid=? ");
  $stmt->execute(array($status,$patientid));
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
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
                    echo "<div class='' style='border-radius: 10px;padding: 10px;'>";
                    echo "<a href='view_patient.php?do=zoom&id=" .$row['xrayid'] ."'><img src='..\uplode\\".$row['xrayimage']."' width='120' style='width:100%;border-radius: 10px;' ></a></td>" ;
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
         // $counter =0;
          //foreach ($row as $row ) {
            //echo "<tr>";
          //  echo "<td>" . ++$counter . "</td>";
           // echo "<td>" . $row['xrayname'] . "</td>";
            //echo "<td>" . $row['xraytype'] . "</td>";
           // echo "<td>" . $row['doctorname'] . "</td>";
           // echo "<td>" . $row['datexray'] . "</td>";
           // echo "<td> <img src='..\uplode\\".$row['xrayimage']."' width='120' ></td>" ;
            //  echo "<td> <img width=300 height=400 src='uplode/" .$row['xrayimage']."' alt='' /></td>" ;
              //  echo "<td>";
          //  echo '<img width=300 height=400 src="data:image/jpg;base64,'.base64_encode($row['xrayimage2']).'">';
            //echo  "</td>";
          //echo "</tr>";
         // }
           ?>


      </div>
    </div>
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
//*************************************************************************
elseif ($do == 'report') {
  $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  $stmt = $con->prepare("SELECT * FROM report INNER JOIN doctor ON report.doctorid=doctor.doctorid  WHERE  patientid=?  ");
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
                                $counter =0;
                              foreach ($row as $row ) {
                                echo "<tr style='color: #00669b;'>";
                                echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                                echo "<td>" . $row['reportname'] . "</td>";
                                echo "<td>" . $row['doctorname'] . "</td>";
                                echo "<td>" . $row['reportdate'] . "</td>";
                                echo "<td>
                                <a href='view_patient.php?do=print&id=" .$row['reportid'] . "' class='btn btn-success'><i class='fa fa-print'></i> طباعة  </a>
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
//**************************************************************************************
elseif ($do == 'med') {
$patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $con->prepare("SELECT * FROM medicine INNER JOIN doctor ON medicine.doctorid=doctor.doctorid  WHERE  patientid=?  ");
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
                            foreach ($row as $row ) {
                              echo "<tr>";
                              echo "<td>" . $row['medid'] . "</td>";
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
  echo "  <div class='container-fluid text-center'>";
$theMsg ='<div class="alert alert-danger">لايوجد ادوية </div>';
   redirecthome($theMsg, 'back',1);
  echo "</div>";
}



}
//********************************************************************************************
elseif ($do == 'searchpatient') {?>
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
                <form class="text-center" style=" margin:0; padding:50px 0 0 0; width:100%;" action="view_patient.php?do=searchpatient&id=<?php echo $_SESSION['ID'] ?>" method="POST" enctype="multipart/form-data">
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
 $stmt = $con->prepare("SELECT * FROM patient WHERE  patientname  like '%$name%' OR  phonepa like '%$name%'  ");
 $stmt->execute(array($name,$name));
  $row = $stmt->fetchAll();
  $count = $stmt->rowCount();
 if ($stmt->rowCount() > 0)
  {
    ?>
      <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="table">
                  <br>
                  <table class="main-table text-center table table-bordered" dir="rtl">
                      <tr style="background-color:#00669b; color:#fff;">
                                <td>#ID</td>
                                <td> اسم المريض </td>
                                <td>النوع</td>
                                <td>العنوان</td>
                                <td>رقم الهاتف</td>
                                <td> التحكم</td>
                            </tr>
                            <?php
                            $counter=0;
                            foreach ($row as $row ) {
                              echo "<tr style='color: #00669b;'>";
                              echo "<td style='color: red;font-weight: bold;'>" . ++$counter . "</td>";
                              echo "<td>" . $row['patientname'] . "</td>";
                              echo "<td>" . $row['gender'] . "</td>";
                              echo "<td>" . $row['address'] . "</td>";
                              echo "<td>" . $row['phonepa'] . "</td>";
                              echo "<td><div class='dropdown'>
                                            <a href='add_test.php?do=test&id=" . $row['patientid'] . "' class='btn btn-success'>فحص  </a>
                                            <a href='add_test.php?do=medpatient&id=" . $row['patientid'] . "' class='btn btn-success'>علاج </a>
                                            <a href='add_test.php?do=addxray&id=" . $row['patientid'] . "' class='btn btn-success'>اشعة </a>
                                            <a href='add_test.php?do=addreport&id=" . $row['patientid'] . "' class='btn btn-success'>تقرير </a> 
                                            <button class='btn dropdown-toggle btn_ho_fu' type='button'  data-toggle='dropdown'>  عرض 
                                              </button>
                                              <ul class='dropdown-menu ' role='menu' aria-labelledby='menu1'>
                                                <li role='presentation'><a role='menuitem' href='view_patient.php?do=xray&id=" . $row['patientid'] . "'>الاشعة</a></li>
                                                <li role='presentation'><a role='menuitem' href='#'>الفحوصات</a></li>
                                                <li role='presentation'><a role='menuitem' href='view_patient.php?do=report&id=" . $row['patientid'] . "'>التقارير</a></li>
                                                <li role='presentation'><a role='menuitem' href='view_patient.php?do=med&id=" . $row['patientid'] . "'>الادوية</a></li>
                                              </ul>
                                        </div>
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
//******************************************************************************************8


include $tpl . 'footer.php';
}
else {
  header('Location: login.php');
  exit();
}
?>
