<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['signup']))
{
$fname=$_POST['fullname'];
$email=$_POST['email'];
$type=$_POST['type']; 
$mobile=$_POST['phone'];
$address=$_POST['address'];
$city=$_POST['city']; 
$country=$_POST['country'];
$password=md5($_POST['password']);
$date= date("y/m/d"); 
  $sql ="SELECT FullName,EmailId FROM tblusers WHERE FullName='$fname' or EmailId='$email'";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $query-> execute();
  $results = $query -> fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query -> rowCount() > 0)
  {
    echo "<script>alert('اسم المستخدم او البريد الالكتروني موجود مسبقا. الرجاء ادخال اسم آخر');</script>";
} else{

$sql="INSERT INTO  tblusers VALUES(NULL,'$type','$fname','$email','$password','$mobile','$address','$city','$country','$date')";
$query = $dbh->prepare($sql);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    $msg="تم تسجيل الجساب الجديد بنجاح";
}
else 
{
    $error="هناك خطأ يرجى ادخال البيانات بشكل صحيح";

}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    <?php @include("includes/header.php");?>
    <div class="container-fluid page-body-wrapper">
        <?php @include("includes/sidebar.php");?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">


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

<div class="card-body">
    <form  method="post" name="signup" onSubmit="return valid();">
        <div class="row ">
        <?php
              if($error){?>
                <div class="errorWrap">
                  <strong>خطأ</strong>:<?php echo htmlentities($error); ?> 
                </div>
                <?php
              } 
              else if($msg){?>
                <div class="succWrap">
                  <strong>تم</strong>:<?php echo htmlentities($msg); ?> 
                </div>
                <?php 
              }?>
        <div class="form-group col-md-6">
                <select class="form-control"   name="type"  id="dignity"  required>
                    <option value="">اختر نوع المستخدم</option>
                    <option value="top_user">مستخدم مالك ( مؤجر )</option>
                    <option value="User">مستخدم عادي</option>
                </select>
            </div>
            </div>
            <div class="row ">
            <div class="form-group col-md-6">
            <input type="text" class="form-control" name="fullname" id="fullname" min='2' placeholder="الاسم الكامل" onBlur="checkAvailability2()" required="required">
                <span id="user-availability-status2" style="font-size:12px;"></span>
            </div>
            <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني" required="required">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="password" class="form-control" name="password" id="password" min='4' max='30' placeholder="كلمة المرور" onBlur="checkAvailability2()" required="required">
                <span id="user-availability-status2" style="font-size:12px;"></span>
            </div>
            <div class="form-group col-md-6">
                <input type="password" class="form-control" name="confirmpassword" min='4' max='30' placeholder="تأكيد كلمة المرور" required="required">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="address" placeholder="العنوان" required="required">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="city" placeholder="المدينة"  required="required">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="country" id="" onBlur="checkAvailability()" placeholder="الدولة" required="required">
                <span id="user-availability-status" style="font-size:12px;"></span> 
            </div>
            <div class="form-group col-md-6">
                <input type="number"  class="form-control" name="phone" placeholder="رقم الهاتف" min='8'  required="required">
            </div>
        </div>
       
        <div class="form-group">
            <input type="submit" value="تسجيل" name="signup" id="submit" class="btn btn-info">
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
