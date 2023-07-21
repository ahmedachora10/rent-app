<?php
include('includes/checklogin.php');
check_login();
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
      $username=$row->UserName;
    }
   }
if(isset($_POST['save']))
{
    $name=$_POST['name'];
    $company=$_POST['company'];
    $details=$_POST['details'];
    $type=$_POST['type'];
    $hour=$_POST['hour'];
    $day=$_POST['day'];
  $id=intval($_GET['id']);

  $sql="update devices set device_name='$name',device_company='$company', device_desc='$details', device_type='$type',
  PricePerHour='$hour',PricePerDay='$day' where id=:id and device_owner='$username'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();
  
  $msg="تم تحديث البيانات بنجاح";
  

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
          <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class=" col -md-12 card">
              <div class="modal-header">
                <h5 class="modal-title" style="float: left;">تعديل الجهاز</h5>
              </div>
              <?php 
              if($msg){
                ?>
                <div class="succWrap">
                  <strong>تم</strong>:<?php echo htmlentities($msg); ?> 
                </div>
                <?php 
              } 
              ?>
              <?php 
              $id=intval($_GET['id']);
              $sql ="SELECT * from devices where id=:id";
              $query = $dbh -> prepare($sql);
              $query-> bindParam(':id', $id, PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=1;
              if($query->rowCount() > 0)
              {
                foreach($results as $result)
                { 
                  ?>
                  <div class="col-md-12 mt-4">
                    <div class="row ">
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">اسم الجهاز<span style="color:red">*</span></label>
                        <input type="text" name="name" class="form-control"  value="<?php echo htmlentities($result->device_name)?>"  id="product" required>
                      </div>
                    
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">اسم الشركة<span style="color:red">*</span></label>
                        <input type="text" name="company" class="form-control"  value="<?php echo htmlentities($result->device_company)?>"  id="product" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="exampleInputName1">وصف الجهاز<span style="color:red">*</label>
                         <textarea class="form-control" style=" font-family: fontawesome;
                         font-size: 17px; line-height: 25px;" name="details" rows="3" required><?php echo htmlentities($result->device_desc);?></textarea>
                       </div>
                     </div>
                     <div class="row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputName1">اختر نوع الجهاز<span style="color:red">*</label>
                          <select class="form-control" name="type" required>
                          <option value="<?php echo htmlentities($result->device_type);?>"> <?php echo htmlentities($result->device_type);?> </option>
                            <option value="games"> العاب </option>
                            <option value="electronics">الكترونيات</option>
                            <option value="computer">حاسوب او هاتف ذكي</option>
                            <option value="tools">ادوات</option>
                          </select>
                        </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputName1">سعر الجهاز بالساعة<span style="color:red">*</label>
                        <input type="text" name="hour" value="<?php echo htmlentities($result->PricePerHour);?>"  class="form-control" id="price"required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputName1">سعر الجهاز باليوم <span style="color:red">*</span></label>
                        <input type="text" name="day" value="<?php echo htmlentities($result->PricePerDay);?>" class="form-control" id="price"required>
                      </div>
                      
                      </div>
                          <div class="row ">
                            <div class="form-group col-md-4 pl-md-0">
                              <label class="col-sm-12 pl-0 pr-0 ">الصورة من الامام  </label>
                              <div class="col-sm-12 pl-0 pr-0">
                               <img src="img/<?php echo htmlentities($result->front_image);?>" width="300" height="200" style="border:solid 1px #000">
                               <a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">تغيير الصورة</a>
                             </div>
                           </div> 
                           <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">الصورة من الخلف</label>
                            <div class="col-sm-12 pl-0 pr-0">
                              <img src="img/<?php echo htmlentities($result->behind_image);?>" width="300" height="200" style="border:solid 1px #000">
                              <a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">تغيير الصورة</a>
                            </div>
                          </div> 
                          <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">الصورة من جهة اخرى </label>
                            <div class="col-sm-12 pl-0 pr-0">
                             <img src="img/<?php echo htmlentities($result->dimage);?>" width="300" height="200" style="border:solid 1px #000">
                             <a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">تغيير الصورة</a>
                           </div>
                         </div> 
                       </div>
                       
              <button type="submit" style="float: right;" name="save" class="btn btn-primary btn-sm  mr-2 mb-4">Save</button>
            </div>
          </div>
          <?php 
        }
      }?>
    </form>
  </div>
</div>
</div>
</div>
<?php @include("includes/foot.php");?>
</body>
</html>