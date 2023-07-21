<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
  $adminid=$_SESSION['top_id'];
  $fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$address=$_POST['address'];
$city=$_POST['city']; 
$country=$_POST['country'];
  $sql="update tblusers set FullName=:fname,EmailId=:email,ContactNo=:mobile,Address=:address,City=:city,Country=:country where id=:aid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':fname',$fname,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
  $query->bindParam(':address',$address,PDO::PARAM_STR);
  $query->bindParam(':city',$city,PDO::PARAM_STR);
  $query->bindParam(':country',$country,PDO::PARAM_STR);
  $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
  $query->execute();
  echo '<script>alert("تم تعديل بيانات الملف الشخصي")</script>';
}
?>

<!DOCTYPE html>
<html lang="ar">
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
                                    <?php
                                    $adminid=$_SESSION['top_id'];
                                    $sql="SELECT * from  tblusers where id=:aid";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $row)
                                        {  
                                            ?>
                                            
                                                <form  method="post" name="signup" onSubmit="return valid();">
                                            <div class="form-group">
                                            <center>
                                            <label class="" for="register1-email" style="float: right;">اسم المستخدم: </label>
                                            <input type="text" class="form-control" name="fullname" placeholder="الاسم الكامل"  value="<?php  echo $row->FullName;?>"required="required">
                                            </div>
                                            <br>
                                                <div class="form-group"><center>
                                                <label class="" for="register1-email" style="float: right;"> رقم الهاتف: </label>
                                            <input type="number" class="form-control" name="mobileno" placeholder="رقم الهاتف" maxlength="10" value="<?php  echo $row->ContactNo;?>"required="required">
                                            </div><br>
                                            <div class="form-group"><center>
                                            <label class="" for="register1-email" style="float: right;">البريد الالكتروني: </label>
                                            <input type="email" class="form-control" name="emailid" id="emailid"  placeholder="البريد الالكتروني" value="<?php  echo $row->EmailId;?>" readonly>
                                            <span id="user-availability-status" style="font-size:12px;"></span> 
                                            </div><br>
                                            
                                            <div class="form-group"><center>
                                            <label class="" for="register1-email" style="float: right;">العنوان: </label>
                                            <input type="text" class="form-control" name="address" placeholder="العنوان" maxlength="10" value="<?php  echo $row->Address;?>" required="required">
                                            </div><br>
                                            <div class="form-group"><center>
                                            <label class="" for="register1-email" style="float: right;">المدينة: </label>
                                            <input type="text" class="form-control" name="city" placeholder="المدينة" maxlength="10" value="<?php  echo $row->City;?>" required="required">
                                            </div><br>
                                            <div class="form-group"><center>
                                            <label class="" for="register1-email" style="float: right;">الدولة: </label>
                                            <input type="text" class="form-control" name="country" placeholder="الدولة" maxlength="50" value="<?php  echo $row->Country;?>" required="required">
                                            </div><br>
                                            <div class="form-group">
                                            <?php 
                                        }
                                    } ?>
                                            <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2" style="float: right;">تعديل</button>                </div>
                                </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
<?php @include("includes/foot.php");?>
</body>
</html>