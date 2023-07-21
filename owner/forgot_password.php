
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  { 
    $password1=($_POST['newpassword']); 
    $password2=($_POST['confirmpassword']); 
   if($password1 != $password2)
    {
      echo "<script>alert('كلمتا المرور غير متطابقتين  !!');</script>";
    }else
    {
      $email=$_POST['email'];
      $mobile=$_POST['mobile'];
      $newpassword=md5($_POST['newpassword']);
      $sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email and ContactNo=:mobile";
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
      if($query -> rowCount() > 0)
      {
      $con="update tblusers set Password=:newpassword where EmailId=:email and ContactNo=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('تم تغيير كلمة المرور بنجاح');</script>";
      }
      else {
      echo "<script>alert('كلمة المرور او رقم الهاتف غير صحيحين');</script>"; 
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <?php @include("includes/head.php");?>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo " align="center" >
                  <h4>تغيير كلمة المرور</h4>
                </div>
                <center>
                <h6 class="font-weight-light" >الرجاء ادخال المعلومات المطلوبة في الاسفل</h6>
                <form class="js-validation-signin px-30" method="post" name="chngpwd" onSubmit="return valid();">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="email" class="form-control" required="true" name="email">
                                <label for="login-username" style="float: right;">البريد الالكتروني</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control"  name="mobile" required="true" maxlength="10" pattern="[0-9]+">
                                <label for="login-password" style="float: right;">رقم الهاتف</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input class="form-control" type="password"  name="newpassword" required="true"/>
                                <label for="login-password" style="float: right;">كلمة المرور الجديدة</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input class="form-control" type="password"  name="confirmpassword" required="true"/>
                                <label for="login-password" style="float: right;">تأكيد كلمة المرور</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                    <button name="submit" type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">تعديل</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> لديك حساب <a href="index.php" class="text-primary">اضغط هنا</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
   
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
  </body>
</html>