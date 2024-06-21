<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false">
        <span class="sr-only">toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Home</a>
    </div>

    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="nav navbar-nav">

		<li class="dropdown">
        <a href="view_patient.php?do=manage&id=<?php echo $_SESSION['ID'] ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ملفي الطبي <span class="caret">
        <ul class="dropdown-menu">
          <li><a href="#">الفحوصات</a></li>
          <li><a href="filemed.php?do=report&id=<?php echo $_SESSION['IDD'] ?>">التقارير</a></li>
          <li><a href="filemed.php?do=xray&id=<?php echo $_SESSION['IDD'] ?>">الاشعة</a></li>
		      <li><a href="filemed.php?do=med&id=<?php echo $_SESSION['IDD'] ?>">الادوية</a></li>
        </ul>
      </li>




		</li>
        <li><a href="appointment.php?do=showappointment&id=<?php echo $_SESSION['IDD'] ?>"> المواعيد </a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'];?> <span class="caret">
        <ul class="dropdown-menu">
          <li><a href="filemed.php?do=editpatient">تعديل الملف الشخصي</a></li>
          <li><a href="#">الاعدادات</a></li>
          <li><a href="logout.php">تسجيل الخروج</a></li>
        </ul>
      </li>
    </ul>
    </div>


  </div>
</nav>
