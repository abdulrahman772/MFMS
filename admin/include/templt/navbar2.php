<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false">
        <span class="sr-only">toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard2.php">Home</a>
    </div>

    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="nav navbar-nav">


        <li><a href="add_doctor.php?do=manage&id=<?php echo $_SESSION['ID'] ?>?status=<?php echo $_SESSION['status'] ?>">  الدكتور </a></li>
        <li><a href="add_patient.php?do=manage&id=<?php echo $_SESSION['ID'] ?>?status=<?php echo $_SESSION['status'] ?>"> المرضى </a></li>
        <li><a href="xray_a.php?do=manage&id=<?php echo $_SESSION['ID'] ?>?status=<?php echo $_SESSION['status'] ?>"> الاشعة </a></li>
      <!--  <li><a href="user.php?do=manage&id=<?php echo $_SESSION['ID'] ?>"> المستخدم </a></li>-->
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'];?> <span class="caret">
        <ul class="dropdown-menu">
          <li><a href="user.php?do=Edit&id=<?php echo $_SESSION['ID'] ?>">تعديل الملف الشخصي</a></li>
          <li><a href="#">الاعدادات</a></li>
          <li><a href="logout.php">تسجيل الخروج</a></li>
        </ul>
      </li>
    </ul>
    </div>


  </div>
</nav>
