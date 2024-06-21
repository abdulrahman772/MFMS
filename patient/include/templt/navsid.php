<nav class="w3-sidenav w3-collapse w3-large w3-card-12 w3-animate-right text-right" style="display: none;z-index:200;width:230px;background: #00669b;">
   <header  class="w3-container w3-xlarge" style="background:#00669b; font-weight:bold;">
   <p class="w3-center" style="padding-top:10px; font-size:12px;color: #fff;background:transparent;opacity: .8;"><?php echo 'مرحبا بك ' . $_SESSION['patientname']; ?> <a href="javascript:void(0)" onClick="w3_close()" class="w3-hide-large w3-closen w3-left" style="padding-top:0;">x</a></p></header>

  <a class="w3-text-white w3-padding-right"  href="dashboard.php" style="background:transparent;border: none;outline: none;opacity: .8;">
 الرئيسي
  </a>
  <style>
  .back_text{
    color:#fff;
    opacity: .8;
      font-size: medium;
  }
  .back_text:hover,.back_text:focus{
      opacity: 1;
      background:white;
      border: none;
      outline: none;
      color: #00669b;
      padding: 20px;
  }
  </style>

    <a href="filemed.php?do=test&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right"> الفحوصات
    </a>
    <a href="filemed.php?do=report&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right"> التقارير
    </a>
    <a href="filemed.php?do=xray&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right"> الاشعة
    </a>
    <a href="filemed.php?do=med&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right"> الادوية
    </a>
  <a href="appointment.php?do=showappointment&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right">المواعيد
  </a>
  <a href="filemed.php?do=editpatient" class="back_text w3-padding-right"> بياناتي الشخصية
  </a>
  <a href="appointment.php?do=addappointment&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right">حجز موعد
  </a>
  <a href="filemed.php?do=doxray&id=<?php echo $_SESSION['IDD'] ?>" class="back_text w3-padding-right"> الاشعة الغير جاهزة
  </a>

</nav>
<div class="w3-overlay" onClick="w3_close()" style="cursor:pointer;z-index: 100;"></div>
<div class="w3-main" style="margin-right:230px;background: white;">
    <header class="w3-container" style="background-color:#00669b;padding-top: 5px; padding-right:10px;padding-bottom: 10px; border-bottom-right-radius: 500px 30%;border-bottom-left-radius: 500px 30%;height: 90px;">
        <i class="glyphicon glyphicon-menu-hamburger w3-opennav w3-hide-large w3-large w3-margin-top " onClick="w3_open()" style="float:right;color: white;"></i>
        <style>
            .center {
                margin: 0 auto;
                text-align: center;
            }

        </style>

        <div class="flagsys center">
            <img src="<?php echo $img ?>201.png" alt="شعار النظام" width="250px" height="80px">
        </div>

        <div class=" w3-dropdown-click w3-animate-left" style="float:left;margin:0 0 0 0;position: absolute;left: 15px;top: 15px;" >
  <button onClick="listdown()" class="w3-card-12 but_list" style="width:50px; height:50px;padding:0;border-radius:50px;background: transparent;outline:none; border-color:#FFF;">
<?php
echo  "<img src='..\imagepatient\\".$_SESSION['imagepatient']."'  width='55px' height='55px' style='border-radius:50px;margin:-5px -10px 0px -10px;'>" ;
?>
  </button>
	<div dir="ltr">
  <span id="Demo" class=" w3-dropdown-content w3-card-4 w3-animate-zoom" dir="rtl" style="background:#00669b;border-radius:10px; font-weight:bolder;z-index: 1;">
  	<style>
	.zead{
		color:#fff;
        text-align: right;
	}
    .zead:hover,zead:focus{
        color:#00669b;
        background: white;
    }
	</style>
    <a href="filemed.php?do=editpatient" class="zead" style="">تعديل البيانات</a>
    <a href="logout.php" class="zead" style="">تسجيل الخروج</a>
  </span>
  </div>
   </div>
</header>

<div id="main"> <!-- Start main -->
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
function myAccFunc() {
    document.getElementById("demoAcc").classList.toggle("w3-show");

}


</script>
</div>

  <div class=" w3-white w3-round-xlarge w3-card-12 w3-animate-zoom" style="width:98%;margin:10px 1% 20px 1%;padding:10px;">
