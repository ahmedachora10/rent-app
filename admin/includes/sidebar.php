<body dir='rtl'>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <?php
            $aid=$_SESSION['odmsaid'];
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
                    ?>
                <a href="#" class="nav-link">
                    <div class="nav-profile-image ml-3">
                        <img class="img-avatar" src="/admin/assets/img/avatars/avatar15.jpg" alt="">
                        <!-- <?php 
                            if($row->Photo=="avatar15.jpg")
                            { 
                                ?> -->
                        <!-- <?php 
                            } else { 
                                ?>
                        <img class="img-avatar" src="profileimages/<?php  echo $row->Photo;?>" alt="">
                        <?php 
                            } ?> -->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2"><?php  echo $row->FirstName;?>
                            <?php  echo $row->LastName;?></span>
                    </div>
                </a>
                <?php 
                }
            } ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="mdi mdi-home menu-icon ml-2"></i>
                    <span class="menu-title">لوحة التحكم</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-monitor menu-icon ml-2"></i>

                    <span class="menu-title">إدارة الاجهزة</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu mb-0 pr-4">
                        <li> <a class="nav-link py-0 my-2" href="manage_device.php">عرض الاجهزة</a></li>
                        <li> <a class="nav-link py-0 my-2" href="blocked_device.php"> الاجهزة المحظورة</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="booking.php">
                    <i class="mdi mdi-briefcase-check menu-icon ml-2"></i>
                    <span class="menu-title">الحجوزات</span>
                </a>

            </li>

            <!--  -->


            <?php
        $aid=$_SESSION['odmsaid'];
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
                <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
                    aria-controls="general-pages">
                    <i class="mdi mdi-account-multiple menu-icon ml-2"></i>
                    <span class="menu-title">إدارة المستخدمين</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="general-pages">

                    <ul class="nav flex-column sub-menu pr-4 mb-0" style="float: right;">
                        <li><a class="nav-link my-2 py-0" href="userregister.php">إضافة مستخدم </a></li>
                        <li> <a class="nav-link my-2 py-0" href="customers.php">إدارة المستخدمين</a></li>

                    </ul>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reviews.php">
                    <i class="mdi mdi-message menu-icon ml-2"></i>

                    <span class="menu-title">رسائل العملاء</span>

                </a>

            </li>
            <?php 
                } 
            }
        } ?>
        </ul>
    </nav>