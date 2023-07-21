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
?>
<!DOCTYPE html>
<html lang="ar">
<?php @include("includes/head.php");?>
<body dir='rtl'>
  <div class="container-scroller">
    <?php @include("includes/header.php");?>
    <div class="container-fluid page-body-wrapper">
      <?php @include("includes/sidebar.php");?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
           
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white"style="height: 140px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3" style="float: right;">عدد الاجهزة 
                  </h4>
                  <?php 
                  $sql1 ="SELECT id from devices where device_owner='$username'";
                  $query1 = $dbh -> prepare($sql1);;
                  $query1->execute();
                  $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                  $totalvehicle=$query1->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($totalvehicle);?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white"style="height: 140px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3" style="float: right;">الحجوزات
                  </h4>
                  <?php 
                  $sql2 ="SELECT id from tblbooking  where device_owner='$username'";
                  $query2= $dbh -> prepare($sql2);
                  $query2->execute();
                  $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                  $bookings=$query2->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($bookings);?></h2>
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


