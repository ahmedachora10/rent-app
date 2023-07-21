<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(!empty($_POST["fullname"])) {
  $fullname= $_POST["fullname"];
  $email=$_POST['emailid'];
  $sql ="SELECT FullName,EmailId FROM tblusers WHERE FullName=:fullname or EmailId='$email'";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $query-> execute();
  $results = $query -> fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query -> rowCount() > 0)
  {
    echo "<script>alert('اسم المستخدم او البريد الالكتروني موجود مسبقا. الرجاء ادخال اسم آخر');</script>";
} else{
if(isset($_POST['signup']))
{
$fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$address=$_POST['address'];
$city=$_POST['city']; 
$country=$_POST['country'];
$password=md5($_POST['password']);
$date= date("y/m/d"); 
$sql="INSERT INTO  tblusers VALUES(NULL,'top_user','$fname','$email','$password','$mobile','$address','$city','$country','$date')";
$query = $dbh->prepare($sql);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('تم تسجيل الجساب الجديد بنجاح');</script>";
}
else 
{
echo "<script>alert('هناك خطأ يرجى ادخال البيانات بشكل صحيح');</script>";
}
}
}}
?>


<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("كلمتا المرور غير متطابفتين  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>

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
                <div class="brand-logo " align="center" >
                  <h4>تسجيل مستخدم جديد (مؤجر)</h4>
                </div>
                <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text"  class="form-control" name="fullname" placeholder="الاسم الكامل" required="required">
                </div>
                <br>
                      <div class="form-group">
                  <input type="number" class="form-control" name="mobileno" placeholder="رقم الهاتف" maxlength="10" required="required">
                </div><br>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid"  placeholder="البريد الالكتروني" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div><br>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required="required">
                </div><br>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="تأكيد كلمة المرور" required="required">
                </div><br>
                <div class="form-group">
                  <input type="text" class="form-control" name="address" placeholder="العنوان" maxlength="10" required="required">
                </div><br>
                <div class="form-group">
                  <input type="text" class="form-control" name="city" placeholder="المدينة" maxlength="10" required="required">
                </div><br>
                <div class="form-group">
                  <input type="text" class="form-control" name="country" placeholder="الدولة" maxlength="50" required="required">
                </div><br>
                <div class="form-group">
                  <input type="submit" value="حفظ" name="signup" id="submit" class="btn btn-block" style="background-color: #49a3ff;">
                </div>
              </form>
              <a href='index.php' style="float: right;">تسجيل الدخول</a>
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