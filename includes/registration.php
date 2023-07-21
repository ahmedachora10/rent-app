<?php
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
$sql2 ="SELECT FullName,EmailId FROM tblusers WHERE FullName='$fname' or EmailId='$email'";
$query2= $dbh -> prepare($sql2);
$query2-> execute();
$results2 = $query2 -> fetchAll(PDO::FETCH_OBJ);
$cnt2=1;
if($query2 -> rowCount() > 0)
{
  echo "<script>alert('اسم المستخدم او البريد الالكتروني موجود مسبقا. الرجاء ادخال اسم آخر');</script>";
} else{
$sql="INSERT INTO  tblusers VALUES(NULL,'user','$fname','$email','$password','$mobile','$address','$city','$country','$date')";
$query = $dbh->prepare($sql);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('تم تسجيل الحساب الجديد بنجاح');</script>";
}
else 
{
echo "<script>alert('هناك خطأ يرجى ادخال البيانات بشكل صحيح');</script>";
}
}
}

?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
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


<body dir='rtl'>


<div id="signupform" class="modal fade">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تسجيل حساب جديد</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
         <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="الاسم الكامل" min='2' required="required">
                </div>
                      <div class="form-group">
                  <input type="number" class="form-control" name="mobileno" placeholder="رقم الهاتف" min='8' required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="البريد الالكتروني" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="كلمة المرور" min='4' max='30' required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" min='4' max='30' placeholder="تأكيد كلمة المرور" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="address" placeholder="العنوان" maxlength="10" required="required">
                </div><div class="form-group">
                  <input type="text" class="form-control" name="city" placeholder="المدينة" maxlength="10" required="required">
                </div><div class="form-group">
                  <input type="text" class="form-control" name="country" placeholder="الدولة" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="submit" value="حفظ" name="signup" id="submit" class="btn btn-block" style="background-color: #49a3ff;" onclick="CheckPassword(document.signup.password)">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer ">
         <p>هل تملك حساب الان؟ <a href="#loginform" data-toggle="modal" data-dismiss="modal">تسجيل الدخول</a></p>
      </div>
    </div>
  </div>
</div>

