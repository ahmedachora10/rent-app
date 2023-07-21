<?php
include('includes/checklogin.php');
check_login();
 $aid=$_SESSION['top_id'];
 $sql="SELECT * from  tblusers where id=:aid";
 $query = $dbh -> prepare($sql);
 $query->bindParam(':aid',$aid,PDO::PARAM_STR);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 $cnt=1;
 if($query->rowCount() > 0)
 { 
     foreach($results as $row)
     {
       $username=$row->FullName;
     }
    }
if(isset($_REQUEST['del']))
  {
$delid=intval($_GET['del']);
$sql = "delete from devices  WHERE  id=:delid and device_owner='$username'";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
 echo "<script>alert('تم حذف الجهاز.');</script>";
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
                  <h5 class="modal-title" style="float: left;">إدارة الاجهزة</h5>
                </div>
                <center>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">اسم الجهاز</th>
                        <th class="text-center">اسم الشركة </th>
                        <th class="text-center">نوع الجهاز</th>
                        <th class="text-center">سعر الساعة</th>
                        <th class="text-center">سعر اليوم</th>
                        <th class="text-center">الحدث</th>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                        <th class="text-center">حالة الجهاز</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * from devices where device_owner='$username'";
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
                            <td class="text-center">
                              <img src="img/<?php  echo $row->front_image;?>" class="mr-2" alt="image"><a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php echo htmlentities($row->device_name);?></a>
                            </td>
                            <td class="text-center"><?php echo htmlentities($row->device_company);?></td>
                            <td class="text-center"><?php echo htmlentities($row->device_type);?></td>
                            <td class="text-center"><?php echo htmlentities($row->PricePerHour);?></td>
                            <td class="text-center"><?php echo htmlentities($row->PricePerDay);?></td>
                            <td class="text-center">
                              
                              <a href="edit_device.php?id=<?php echo $row->id;?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                              <a href="manage_myDevices.php?del=<?php echo $row->id;?>" onclick="return confirm('هل تريد الحذف');"><i class="mdi mdi-delete"></i></i></a>
                            </td>
                            <td class="text-center">
                            <?php
                              if($status==0){
                                ?>
                                 <a href="#" onclick="return alert('تواص مع الادارة من اجل معرفة الاسباب');">
                              تم حظر هذا الجهاز</a>
                              <?php
                            }else{
                                ?>
                                <a href="#" >
                              نشط</a>
                              <?php
                              }
                              ?>
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