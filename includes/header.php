<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>
<head>
<meta charset="utf-8">
    <title>رنت بلس</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>
<body >
<div class="col-lg-12 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                    
                    <?php   if(strlen($_SESSION['login'])!=0)
                        { 
                            ?>
                            <?php 
                            $email=$_SESSION['login'];
                            $sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
                            $query= $dbh -> prepare($sql);
                            $query-> bindParam(':email', $email, PDO::PARAM_STR);
                            $query-> execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {
                                ?>
                            
                                    <a href=""></a>
                                <a href="#" class="nav-item nav-link active">مرحبا: <?php echo htmlentities($result->FullName);?></a>
                                <a href="profile.php" class="nav-item nav-link">اعدادات الملف الشخصي</a>
                                <a href="update_password.php" class="nav-item nav-link">تحديث كلمة المرور</a>                                
                                <a href="my_booking.php" class="nav-item nav-link">حجوزاتي</a>
                                <a href="logout.php" class="nav-item nav-link">تسجيل الخروج</a>

                                </ul>
                                </li>
                                <?php 
                            }
                            }
                        } else{ ?>
               
                    <a href="login.php"><button class="dropdown-item" data-toggle="modal" data-dismiss="modal" type="button">تسجيل الدخول</button></a>

                    <a href="signup.php"><button class="dropdown-item" data-toggle="modal" data-dismiss="modal" type="button">حساب جديد</button></a>

                    </div>
                        <?php } ?>
                </div>
             
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4 col-6 text-right">
            <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">رنت</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">بلس</span>
                </a>
            </div>
            
            <div class="col-lg-4 col-6 text-left">
               
            </div>
            <div class="col-lg-4">
            <form class="form-inline "  action="search.php" method="post">
                    <div class="input-group">
                    <input class="form-control form-control-navbar" type="text"  name="searchdata" placeholder="بحث عن جهاز" aria-label="Search" required="true">
        <div class="input-group-append">
          <button class="btn bg-primary" style="background-color: #49a3ff;" type="submit">
            <i class="fa fa-search"></i>
          </button>
                    </div>
                </form>
               
            </div>
           
        </div>
    </div>
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
        <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                  
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">الرئيسية</a>
                            <a href="tools.php" class="nav-item nav-link">الادوات المنزلية</a>
                            <a href="electronic.php" class="nav-item nav-link">الاجهزة الكهربائية</a>
                            <a href="games.php" class="nav-item nav-link">الالعاب</a>
                            <a href="laptop.php" class="nav-item nav-link">الهواتف واجهزة الحاسوب</a>
                            <a href="contact.php" class="nav-item nav-link">اتصل بنا</a>

                          
                        </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100"  href="owner/index.php" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    تسجيل كمؤجر</h6>
                    <!-- <i class="fa fa-angle-down text-dark"></i> -->
                </a>
               </div>
          
        </div>
    </div>
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                   
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 530px;">
                            <img width='90%' src="img/rent1.jpg" style="object-fit: cover;">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
           
        </div>
    </div>
     </body>
                        

