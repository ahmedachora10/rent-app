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
                  <h5 class="modal-title" style="float: left;">إدارة الاجهزة</h5>
                </div>
                
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>اسم الجهاز</th>
                        <th>تاريخ الحجز </th>
                        <th>فترة الحجز</th>
                        <th>عدد فترة الحجز</th>
                        <th>السعر</th>
                        <th>الحدث</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT DISTINCT tblbooking.device_name as dname, tblbooking.booking_date as bdate,
                        tblbooking.booking_type as btype,tblbooking.booking_duration as duration,tblbooking.total as price
                         from tblbooking join devices on tblbooking.device_name=devices.device_name where devices.device_owner='$username'";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $row)
                        { 
                          ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td>
                              <a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php echo htmlentities($row->dname);?></a>
                            </td>
                            <td class="text-center"><?php echo htmlentities($row->bdate);?></td>
                            <td><?php echo htmlentities($row->btype);?></td>
                            <td><?php echo htmlentities($row->duration);?></td>
                            <td><?php echo htmlentities($row->price);?></td>
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