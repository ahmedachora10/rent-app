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
    if(isset($_REQUEST['stat']))
    {
  $statid=intval($_GET['stat']);
  $sql = "UPDATE tblbooking set status=1  WHERE  id=:statid and device_owner='$username'";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':statid',$statid, PDO::PARAM_STR);
  $query -> execute();
  $msg="تم تاكيد الحجز";
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
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: rigth;">إدارة الاجهزة</h5>
                </div>
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
              <center>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">اسم الجهاز</th>
                        <th class="text-center">تاريخ الحجز </th>
                        <th class="text-center">فترة الحجز</th>
                        <th class="text-center">عدد فترة الحجز</th>
                        <th class="text-center">السعر</th>
                        <th class="text-center">الحدث</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       
                      $sql="SELECT * from tblbooking where device_owner='$username'";
                        $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $row)
                        { 
                          $status=$row->status;
                          
                          ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td class="text-center">
                              <a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php echo htmlentities($row->device_name);?></a>
                            </td>
                            <td class="text-center"><?php echo htmlentities($row->booking_date);?></td>
                            <td class="text-center"><?php echo htmlentities($row->booking_type);?></td>
                            <td class="text-center"><?php echo htmlentities($row->booking_duration);?></td>
                            <td class="text-center"><?php echo htmlentities($row->total);?></td>
                            <td class="text-center">
                             
                              <?php
                              if($status==0){
                                ?>
                              <a href="booking.php?stat=<?php echo $row->id;?>" onclick="return confirm('هل انت موافق على تاكيد الحجز');" >
                              الموافقة على الحجز</a>
                              <?php 
                              }else{
                                ?>
                                <a href="#" >
                              تم تاكيد الحجز</a>
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