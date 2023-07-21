
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT * FROM tblusers WHERE FullName=:username and Password=:password and type='top_user'";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach ($results as $result) 
        {
            $_SESSION['top_id']=$result->id;
            $_SESSION['login']=$result->FullName;
        }
        
                    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";              
                } else
                { 
                  
        echo "<script>alert('بيانات خاطئة');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<?php @include("includes/head.php");?>
<body dir='rtl'>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" align="center">
                            </div>
                            <center><h3>تسجيل دخول مستخدم مالك (مؤجر) </h3></center>
                            <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal">  
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="اسم المستخدم" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="كلمة المرور" required>
                                </div>
                                <div class="mt-3">
                                    <button name="login" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">تسجيل الدخول</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> 
                                    <a href="forgot_password.php" class="text-primary"> 
                                        نسيت كلمة المرور
                                    </a>
                                    <br><br>
                                    <a href="new_user.php" class="text-primary"> 
                                        تسجيل حساب جديد
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php @include("includes/foot.php");?>
   
</body>
</html>