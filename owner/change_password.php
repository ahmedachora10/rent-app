<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['top_id']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$adminid=$_SESSION['top_id'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT id FROM tblusers WHERE id=:adminid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tblusers set Password=:newpassword where id=:adminid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("تم تغيير كلمة المرور بنجاح")</script>';
} else {
echo '<script>alert("كلمة المرور غير صحيحة")</script>';

}
}
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('كلمتا المرور غير متطابقتين');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
  <?php @include("includes/head.php");?>
  <body dir='rtl'>
    <div class="container-scroller">
     <?php @include("includes/header.php");?>
      <div class="container-fluid page-body-wrapper">
         <?php @include("includes/sidebar.php");?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12">
                <div class="card">
                   <div class="card-body">
                      <form method="post" onsubmit="return checkpass();" name="changepassword">
                          <div class="form-group row">
                              <label class="" for="register1-username">كلمة المرور الحالية: </label>
                              <div class="col-12">
                                  <input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="" for="register1-email">كلمة المرور الجديدة: </label>
                              <div class="col-12">
                                   <input type="password" class="form-control" name="newpassword"  class="form-control"  required="true">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="" for="register1-password">تأكيد كلمة المرور</label>
                              <div class="col-12">
                                  <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword"  required='true'>
                              </div>
                          </div>
                        
                          <div class="form-group row">
                              <div class="">
                                  <button type="submit" class="btn btn-primary" name="submit">
                                      <i class="fa fa-plus "></i> تغيير
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php @include("includes/footer.php");?>
        </div>
      </div>
    </div>
   <?php @include("includes/foot.php");?>
  </body>
</html>
<?php }  ?>