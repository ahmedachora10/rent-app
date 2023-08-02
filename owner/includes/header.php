 <style>
.navbar .navbar-menu-wrapper .navbar-nav.navbar-nav-right {
    margin-left: 0 !important;
    margin-right: auto !important;
}

@media (min-width: 992px) {
    .navbar .navbar-menu-wrapper .navbar-nav.navbar-nav-right {
        margin-left: 0 !important;
        margin-right: auto !important;
    }
}
 </style>

 <body dir='rtl'>
     <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
         <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

         </div>
         <div class="navbar-menu-wrapper d-flex align-items-stretch">
             <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                 <span class="mdi mdi-menu"></span>
             </button>
             <div class="search-field d-none d-md-block">

             </div>
             <ul class="navbar-nav navbar-nav-right">
                 <li class="nav-item nav-profile dropdown">
                     <?php
        $aid=$_SESSION['top_id'];
        $sql="SELECT * from  tblusers where id=:aid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':aid',$aid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
          foreach($results as $row)
          { 
            $username=$row->FullName;
            ?>
                     <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                         aria-expanded="false">
                         <div class="nav-profile-img ml-3">
                             <?php 
                if($row->Photo=="avatar15.jpg")
                { 
                  ?>
                             <img class="img-avatar" src="assets/img/avatars/avatar15.jpg" alt="">
                             <?php 
                } else { 
                  ?>
                             <img class="img-avatar" src="assets/img/avatars/avatar15.jpg" alt="">
                             <?php 
                } ?>
                         </div>
                         <div class="nav-profile-text">
                             <p class="mb-1 text-black"><?php  echo $row->FullName;?></p>
                         </div>
                     </a>
                     <?php
          }
        } ?>

                     <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                         <a class="dropdown-item" href="profile.php">
                             <i class="mdi mdi-account mr-2 text-success"></i> الصفحة الشخصية </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="change_password.php"><i
                                 class="mdi mdi-settings mr-2 text-success"></i> الاعدادات </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="logout.php">
                             <i class="mdi mdi-logout mr-2 text-primary"></i> تسجيل الخروج </a>
                     </div>
                 </li>
                 <li class="nav-item d-none d-lg-block full-screen-link">
                     <a class="nav-link">
                         <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                     </a>
                 </li>
                 <li class="nav-item dropdown">
                     <?php 
            $sql ="SELECT * from tblbooking where Status='0' and device_owner='$username' ORDER BY id DESC ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $totalnewbooking=$query->rowCount();
            $cnt=1;
            ?>
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                         data-toggle="dropdown">
                         <i class="mdi mdi-bell-outline"></i>
                         <span class="count-symbol ">
                             <h5 class="badge2 blue"><?php echo htmlentities($totalnewbooking);?></h5>
                         </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                         <h6 class="p-3 mb-0">لديك <?php echo htmlentities($totalnewbooking);?> إشعارات جديدة</h6>
                         <div class="dropdown-divider"></div>
                         <?php
              

              ?>
                         <?php if($query->rowCount() > 0)
              {
                foreach($results as $row)
                {              
                  ?>
                         <a class="dropdown-item preview-item">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-success">
                                     <i class="mdi mdi-calendar"></i>
                                 </div>
                             </div>

                             <div
                                 class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                 <h6 class="preview-subject font-weight-normal mb-1">
                                     <?php  echo substr($row->VehiclesTitle,0,50);?></h6>
                                 <p class="text-gray ellipsis mb-0">حجز قيد الانتظار</p>
                             </div>
                         </a>
                         <?php 
                }
              } else {?>
                         <a class="dropdown-item" href="#">لم يتم استلام حجز جديد</a>
                         <?php } ?>
                         <div class="dropdown-divider"></div>
                         <h6 class="p-3 mb-0 text-center"> <a href="booking.php">عرض كل الحجوزات</a></h6>
                     </div>
                 </li>

                 <!-- blocked -->
                 <li class="nav-item dropdown">
                     <?php 
            $sql ="SELECT * from devices where block_status='0' and device_owner='$username' ORDER BY id DESC ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $totalnewbooking=$query->rowCount();
            $cnt=1;
            ?>
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                         data-toggle="dropdown">
                         <i class="mdi mdi-bell-outline"></i>
                         <span class="count-symbol ">
                             <h5 class="badge2 blue"><?php echo htmlentities($totalnewbooking);?></h5>
                         </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                         <h6 class="p-3 mb-0">لديك <?php echo htmlentities($totalnewbooking);?> إشعارات جديدة</h6>
                         <div class="dropdown-divider"></div>
                         <?php
              

              ?>
                         <?php if($query->rowCount() > 0)
              {
                foreach($results as $row)
                {              
                  ?>
                         <a class="dropdown-item preview-item">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-success">
                                     <i class="mdi mdi-calendar"></i>
                                 </div>
                             </div>

                             <div
                                 class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                 <h6 class="preview-subject font-weight-normal mb-1">
                                     <?php  echo substr($row->VehiclesTitle,0,50);?></h6>
                                 <p class="text-gray ellipsis mb-0">هناك جهاز تم حظره</p>
                             </div>
                         </a>
                         <?php 
                }
              } else {?>
                         <a class="dropdown-item" href="#">ليس هناك اجهزة تم حظرها</a>
                         <?php } ?>
                         <div class="dropdown-divider"></div>
                         <h6 class="p-3 mb-0 text-center"> <a href="manage_myDevices.php">عرض الاجهزة الخاصة بي</a></h6>
                     </div>
                 </li>


                 <li class="nav-item nav-logout d-none d-lg-block">
                     <a class="nav-link" href="logout.php">
                         <i class="mdi mdi-power"></i>
                     </a>
                 </li>
             </ul>
             <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                 data-toggle="offcanvas">
                 <span class="mdi mdi-menu"></span>
             </button>
         </div>
     </nav>