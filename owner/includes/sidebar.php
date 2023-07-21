<body dir='rtl'>
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <?php
            $aid=$_SESSION['top_id'];
            $sql="SELECT * from  tblusers where ID=:aid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':aid',$aid,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            { 
                foreach($results as $row)
                {
                    ?>
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
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
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2"><?php  echo $row->FullName;?></span>
                            
                        </div>
                    </a>
                    <?php 
                }
            } ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="mdi mdi-home menu-icon">
                <span class="menu-title">لوحة التحكم</span></i>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">إدارة الاجهزة</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-monitor menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li > <a class="nav-link" href="register_device.php">إضافة جهاز</a></li>
                    <li > <a class="nav-link" href="manage_myDevices.php">إدارة أجهزتي</a></li>
                                    </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="booking.php">
            <span class="menu-title">الحجوزات
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                
                <i class="mdi mdi-briefcase-check menu-icon"></i>
            </a>
           
        </li>

        
        <?php
        $aid=$_SESSION['top_id'];
        $sql="SELECT * from  tbladmin where ID=:aid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':aid',$aid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {  
            foreach($results as $row)
            { 
                if($row->AdminName=="Admin"  )
                { 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                            <span class="menu-title">إدارة المستخدمين</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                        </a>
                        <div class="collapse" id="general-pages">

                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">&nbsp;&nbsp; <a class="nav-link" href="userregister.php">إضافة مستخدم </a></li> 
                                 <li class="nav-item"> <a class="nav-link" href="customers.php">إدارة المستخدمين</a>&nbsp;&nbsp;</li> 
                                
                            </ul>

                        </div>
                    </li>
                    <?php 
                } 
            }
        } ?> 

<?php
        $aid=$_SESSION['top_id'];
        $sql="SELECT * from  tbladmin where ID=:aid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':aid',$aid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {  
            foreach($results as $row)
            { 
                if($row->AdminName=="Admin"  )
                { 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                            <span class="menu-title">إدارة المؤجرين</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                        </a>
                        <div class="collapse" id="general-pages">

                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">&nbsp;&nbsp; <a class="nav-link" href="#.php">إضافة مؤجر </a></li> 
                                 <li class="nav-item"> <a class="nav-link" href="#.php">إدارة المؤجرين</a>&nbsp;&nbsp;</li> 
                                
                            </ul>

                        </div>
                    </li>
                    <?php 
                } 
            }
        } ?> 

    </ul>
</nav>