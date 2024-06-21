<?php
session_start();
if (isset($_SESSION['username'])) {
  $page_title ='test | Patient';
//$nonavbar ='';
include "init.php";
  //echo "welcom test page";
  $do = isset($_GET['do']) ? $_GET['do'] : 'manage' ;
  $doctorid = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;
  ?>
  <!DOCTYPE html>
  <html lang="ar">
  <head>
  <title>W3.CSS</title>

  <!-- Mirrored from www.w3schools.com/w3css/demo_template_blog.htm by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:04:53 GMT -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="w3.css">
  <link rel="stylesheet" href="font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  <style>
  .w3-closenav {position:absolute !important;left:20px!important;top:10px!important;padding:5px !important;}
  .w3-closenav:hover {background-color:transparent !important;color:#ff0;}
  body{background:linear-gradient(250deg,#00699B 30%,#04ADFF 40%,#00699B 30% ,#04ADFF 200%);}
  input{padding:5px;
  	font-size:16px;
  	color:#000;
  	border:1px solid #004F75;
      border-radius: 10px;
  	background: transparent;
  	font-weight:bolder;
  	}
  	::placeholder{
  	font-size: 16px;
  	color:#00699b;
  	padding:5px;
  	font-family:Arabic Typesetting;
  	font-weight:bolder;
  }
  </style>
  </head>
  <body dir="rtl">
  <nav class="w3-sidenav w3-collapse w3-white w3-large w3-card-12 w3-animate-right" style=" display: none;width:250px;z-index:4;">

     <header  class="w3-container w3-padding w3-xlarge" style="background-color:#00699b;background:linear-gradient(250deg,#00699B 30%,#04ADFF 40%,#00699B 30% ,#04ADFF 200%); font-weight:bold;">
     <p class="w3-text-white" style="padding-top:10px;">القائمه الرئيسيه <a href="javascript:void(0)" onClick="w3_close()" class="w3-hide-large w3-closenav  w3-left" style="padding-top:0%;">x</a></p></header>

    <a class=" w3-text-white w3-padding-right"  href="#" style="background:linear-gradient(250deg,#04ADFF 15%,#00699b 31.3%,#04ADFF 20% ,#00699b 200%);">
   الرئيسي
   <i class=" w3-padding glyphicon glyphicon-home"></i>
    </a>
    <style>
    .back_text{
  	  color:#00699b;
    }
    .color_minue:hover{
  	 background: linear-gradient(#FFF, #82D5DB);
    }
    </style>
    <a href="#" class="back_text color_minue w3-padding-right">اضافة مستخدم
    <i class=" w3-padding glyphicon glyphicon-user"></i>
    </a>
    <a href="#" class="back_text color_minue w3-padding-right">اضافة دكتور
    <i class=" w3-padding">
    <img src="8p.png" width="23px">
    </i>
    </a>
    <a href="#" class="back_text color_minue w3-padding-right">اضافة مريض
    <i class=" w3-padding">
    <img src="10.ico" width="25px">
    </i>
    </a>
  </nav>


  <div class="w3-overlay" onClick="w3_close()" style="cursor:pointer;"></div>
  <div class="w3-main" style="margin-right:250px;">

  <div id="main"> <!-- Start main -->
  <header class="w3-container" style="background-color:#fff; padding:10px;">
    <i class="glyphicon glyphicon-menu-hamburger w3-opennav w3-hide-large w3-large w3-margin-top " onClick="w3_open()" style="float:right;"></i>
   <!-- <style>
  .but_list:hover{
  	box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  }
  .but_list:focus{
  transition: .3s;
  border: 1.3px solid #003651;

  }
  </style>-->
    <div class=" w3-dropdown-click w3-animate-left w3-quarter" style="float:left;margin:0% 0% 0% 0%;" dir="ltr">

    <button onClick="listdown()" class="w3-card-12 but_list" style="width:50px; height:50px;padding:0px;border-radius:50px;background: transparent;outline:none; border-color:#FFF;">

    <img src="11.png" class="" width="55px" height="55px" style="border-radius:50px;margin:-5px 0px 0px -3px;">
    </button>
  	<div dir="ltr">
    <span id="Demo" class=" w3-dropdown-content w3-card-4 w3-animate-zoom" dir="rtl" style="background:linear-gradient(250deg,#00699B 30%,#04ADFF 40%,#00699B 30% ,#04ADFF 200%);border-radius:0px; font-weight:bolder;">
    	<style>
  	.zead{
  		border-radius:10px;
  		border:1px solid #00669b;
  		color:#fff;

  	}
  	</style>
      <a href="#" class="zead" style="">الاعدادات</a>
      <a href="#" class="zead" style="">تعديل البيانات</a>
      <a href="#" class="zead" style="">تسجيل الخروج</a>
    </span>
    </div>
     </div>
  </header>
  <svg height="10%" width="100%">
    <defs>
      <linearGradient id="grad1" x1="0%" y1="0%" x2="50%" y2="0%">
        <stop offset="0%"
        style="stop-color:#FFF;stop-opacity:1" />
      </linearGradient>
    </defs>
    <ellipse cx="50%" cy="0%" rx="55%" ry="20%" fill="url(#grad1)" />
  </svg>

  <div class="w3-container w3-white w3-round-xlarge w3-card-12 w3-animate-zoom" style="width:96%;margin:-70px 2% 0% 2%;padding:7px;">

  <div class="w3-card-8" style="border:5px solid #00699b; border-top-left-radius:5px;border-top-right-radius:5px; border-bottom-left-radius:10px;border-bottom-right-radius:10px;">

  <header class="w3-card-8" style="background-color:#00699b; border-bottom-left-radius:30px;border-bottom-right-radius:30px; margin-top:0px;">

  <p class="w3-center" style="padding-top:0px;color:#fff;font-weight:bold;font-size:25px;">بيانات الموظف</p>



  </header>
  <form  class="w3-container" style=" margin:3% 4% 2% 0%; padding:2% 2% 0% 0%; width:50%;">
  <img src="4.png" class="w3-right" id="demo2" width="40px" height="40px" style="margin:-3px 0% 0% .5%;">
  <p style="margin-top:0%;">
  <input autocomplete="off" class="hover_input" type="text" name="follname" required placeholder="الاسم الكامل" style="width:91%; margin-top:0%;outline:none;">
  </p>
  <img src="7.png" class="w3-circle w3-right" width="35px" height="35px" style="margin:1% 0% 0% 1%;">

  <p>
  <input class="hover_input " type="text" name="user" required placeholder="اسم المستخدم" style="width:91%; margin-top:1%;outline:none;">
  </p>
  <img src="2.png" class="w3-circle w3-right" width="35px" height="35px" style="margin:1% 0% 0% 1%;">
  <p>
  <input class="hover_input " type="text" name="password" required placeholder="كلمة السر" style="width:91%; margin-top:1%; outline:none;">
  </p>
  <img src="6.png" class="w3-circle w3-right" width="35px" height="35px" style="margin:1% 0% 0% 1%;">
  <p>
  <input class="hover_input" type="email" name="email" required placeholder=" البريد الالكتروني" style="width:91%; margin-top:1%;outline:none;">
  </p>
  <img src="3.png" class="w3-circle w3-right" width="35px" height="35px" style="margin:1% 0% 0% 1%;">
  <p>
  <input class="hover_input" type="text" name="mobile" required placeholder="رقم الهاتف" style="width:91%; margin-top:1%;outline:none;">
  </p>
  <input type="submit" class="w3-btn w3-left" style="border-radius:10px; background-color:#00699b;" onclick="document.getElementById('modal01').style.display='block'" formenctype="text/plain" value="اضافه">

  <div id="modal01" class="w3-modal" onclick="this.style.display='none'" style="margin-right:250px;">
    <div class="w3-modal-content w3-animate-top " style="width:30%;height:120px;margin-top:-9%; box-shadow:0px 8px 18px 0px rgba(0,150,0,0.5),0px 6px 20px 0px rgba(0,0,0,0.19); padding-right:1%; border-bottom-left-radius:300px;border-bottom-right-radius:100px; border-left:15px solid #004000;">
   		<span class="w3-closebtn w3-hover-red w3-container w3-padding-2 w3-display-topleft" style="border-bottom-left-radius:120px;border-bottom-right-radius:70px;border-top-right-radius:100px;">×</span>
          <div class="w3-right w3-card-8" style="width:40px; height:100px; background: linear-gradient(250deg,#004000 30%,#00F000 40%,#004000 30% ,#00F000 200%); padding-top:60px;border-bottom-left-radius:50px;border-bottom-right-radius:50px; padding-right:10px;">
          <i class="glyphicon glyphicon-saved w3-text-white" style="font-size:18px;"></i>
          </div>
          <h3 class="" style="color:#006900;padding:62px 50px 0px 0px; font-weight:bold;">تم الحفظ </h3>
  </div>
  </div>
  </form>
  </div>
  </div>
  <!--<div class="w3-container">
    <h6 class="w3-opacity">RECENT POSTS</h6>
    <hr>
    <h2>I Love Food</h2>
    <h5><i class="fa fa-clock-o"></i> Post by Jane Dane, Sep 27, 2015.</h5>
    <p class="w3-small">Tags: <span class="w3-tag w3-small w3-red">Food</span> <span class="w3-tag w3-small w3-blue">Passion</span></p>
    <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <br><br>

    <h6 class="w3-opacity">RECENT POSTS</h6>
    <hr>
    <h2>Officially Blogging</h2>
    <h5><i class="fa fa-clock-o"></i> Post by John Doe, Sep 24, 2015.</h5>
    <p class="w3-small">Tags: <span class="w3-tag w3-small w3-green">Lorem</span></p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <hr>

    <div class="w3-card-2 w3-container">
      <h4>Leave a Comment:</h4>
      <form>
        <textarea class="w3-input" placeholder="Say something nice.." required></textarea>
        <br>
        <button type="submit" class="w3-section w3-btn w3-green">Submit</button>
        <br>
      </form>
    </div>
    <br>

    <p><span class="w3-badge w3-black">1</span> Comment:</p><br>

    <div class="w3-row">
      <div class="w3-col s2 text-center">
        <img class="w3-circle w3-image" src="1.png" width="96" height="96">
      </div>
      <div class="w3-col s10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2015, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>-->

  <svg height="10%" width="100%" style="margin-bottom:-15px;">
    <defs>
      <linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%"
        style="stop-color:#fff;stop-opacity:5" />
      </linearGradient>
    </defs>
    <ellipse cx="50%" cy="100%" rx="55%" ry="20%" fill="url(#grad2)" />
  </svg>
  <footer class="w3-container w3-animate-zoom" style="background-color:#fff;">
  <h5 style="color:#00699b;">Footer</h5>
    <p style="color:#00699b;">Footer information goes here</p>
  </footer>
  </div> <!-- End main -->

  <script>
  function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
    document.getElementsByClassName("w3-overlay")[0].style.display = 'block';
  }
  function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    document.getElementsByClassName("w3-overlay")[0].style.display = 'none';
  }


  function listdown() {
      document.getElementById("Demo").classList.toggle("w3-show");
  }


  </script>
  <!--<path d="M 100 350 q 150 600 300 0" stroke="blue" stroke-width="5" fill="none" />-->
  <!-- Mirrored from www.w3schools.com/w3css/demo_template_blog.htm by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:04:53 GMT -->

  </body>
  </html>


  <?php
  //**************************************************************************************************
  if ($do == 'addpatient') {
    $patientid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $stmt = $con->prepare("SELECT * FROM patient WHERE  patientid=?  LIMIT 1 ");
      $stmt->execute(array($patientid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
  ?>
  <h1 class="text-center">add new test </h1>
  <div class="container">
    <form class="form-horizontal" action="?do=inserttest" method="POST">
  <input type="hidden" name="patientid" />
      <div class="form-group">
        <label class="col-sm-2 control-label">اسم الفحص</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="testname" class="form-control"  autocomplete="off"/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">تاريخ التسجيل</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="phone" class="form-control" />
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
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
    $testname=$_POST['testname'];
    $stmt = $con->prepare("INSERT INTO
                                  add_test(patientid, doctorid, testname )
                                  VALUES(:zuid, :zdoc, :zuname) ");
    $stmt->execute(array(
      'zuid'    =>$doctorname,
      'zdoc' =>$_SESSION['ID'],
      'zuname' =>$testname
    )
  );
    echo "insert";
  }
  }
  //************************************************************************
  //include $tpl . 'footer.php';
  }
  else {
    header('Location: login.php');
    exit();
  }
  ?>
