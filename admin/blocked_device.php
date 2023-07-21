<?php
include('includes/checklogin.php');
check_login();
if(isset($_REQUEST['stat']))
{
$statid=intval($_GET['stat']);
$sql = "UPDATE devices set block_status=1  WHERE  id=:statid ";
$query = $dbh->prepare($sql);
$query -> bindParam(':statid',$statid, PDO::PARAM_STR);
$query -> execute();
$msg="تم فك حظر الجهاز";
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">الاجهزة المحظورة</h5>
                </div>
                <center>
                <div class="table-responsive p-3" style="float: right;">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover" style="float: right;">
                    <thead >
                      <tr >
                        <th>#</th>
                        <th style="float: right;">اسم الجهاز</th>
                        <th class="text-center">اسم الشركة </th>
                        <th class="text-center">نوع الجهاز</th>
                        <th class="text-center">سعر الساعة</th>
                        <th class="text-center">سعر اليوم</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">الحدث</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * from devices where block_status='0'";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $row)
                        { 
                          $status=$row->block_status;
                          ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td style="float: right;">
                              <img src="img/<?php  echo $row->front_image;?>" class="mr-2" alt="image"><a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php echo htmlentities($row->device_name);?></a>
                            </td>
                            <?php
                            ?>
                            <td class="text-center"><?php echo htmlentities($row->device_company);?></td>
                            <td class="text-center"><?php echo htmlentities($row->device_type);?></td>
                            <td class="text-center"><?php echo htmlentities($row->PricePerHour);?></td>
                            <td class="text-center"><?php echo htmlentities($row->PricePerDay);?></td>
                            <td class="text-center">
                            <?php
                              if($status==1){
                                ?>
                              <a href="manage_device.php?stat=<?php echo $row->id;?>" onclick="return confirm('هل انت موافق على حظر هذا الجهاز');" >
                              حظر</a>
                              <?php 
                              }else{
                                ?>
                                <a href="#" >
                              تم الحظر</a>
                              <?php
                              }
                              ?>
                             </td>
                             <td class="text-center">
                            <?php
                                ?>
                              <a href="blocked_device.php?stat=<?php echo $row->id;?>" onclick="return confirm('هل انت موافق على رفع الحظر عن هذا الجهاز');" >
                              رفع الحظر</a>
                              </td>
                          </tr>
                          <?php 
                          $cnt=$cnt+1;
                        }
                      } ?>
                    </tbody>
                  </table>
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