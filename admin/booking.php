<?php
include('includes/checklogin.php');
check_login();
 $aid=$_SESSION['odmsaid'];
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
                  <h5 class="modal-title" style="float: right;">إدارة الاجهزة</h5>
                </div>
                <center>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">اسم الجهاز</th>
                        <th class="text-center">تاريخ الحجز </th>
                        <th class="text-center">فترة الحجز</th>
                        <th class="text-center">عدد فترة الحجز</th>
                        <th class="text-center">السعر</th>
                        <th class="text-center">صاحب الحجز</th>
                        <th class="text-center">حالة الحجز</th>
                        <th class="text-center">الحدث</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql='SELECT * from tblbooking';
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $row)
                        { 
                          $status=$row->status;
                          if($status==0){
                            $status='الحجز قيد الانتظار';
                          }else{
                            $status='تمت الموافقة على حجز هذا المنتج';
                          }
                          ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td class="text-center">
                              <a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php echo htmlentities($row->device_name);?></a>
                            </td >
                            <td class="text-center"><?php echo htmlentities($row->booking_date);?></td>
                            <td class="text-center"><?php echo htmlentities($row->booking_type);?></td>
                            <td class="text-center"><?php echo htmlentities($row->booking_duration);?></td>
                            <td class="text-center"><?php echo htmlentities($row->total);?></td>
                            <td class="text-center"><?php echo htmlentities($row->username);?></td>
                            <td class="text-center"><?php echo $status;?></td>
                            <td>
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