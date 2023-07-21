<?php
include('includes/checklogin.php');
check_login();
if(isset($_REQUEST['del']))
  {
$delid=intval($_GET['del']);
$sql = "delete from tblusers  WHERE  id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
 echo "<script>alert('تم حذف المستخدم بنجاح.');</script>";
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
                <div class="modal-header" style="float: right;">
                  <h5 class="modal-title" style="float: right;">عرض المستخدمين</h5>
                </div>
                <center>
               <div class="card-body table-responsive p-3" style="float: right;">
                <table class="table align-items-center table-bordered  table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">نوع المستخدم</th>
                      <th class="text-center"> اسم المستخدم</th>
                      <th class="text-center">البريد الالكتروني </th>
                      <th class="text-center">رقم الهاتف</th>
                      <th class="text-center">العنوان</th>
                      <th class="text-center">المدينة</th>
                      <th class="text-center">البلد</th>
                      <th class="text-center">تاريخ التسجيل</th>
                      <th class="text-center">الحدث</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $sql = "SELECT * from  tblusers ";
                   $query = $dbh -> prepare($sql);
                   $query->execute();
                   $results=$query->fetchAll(PDO::FETCH_OBJ);
                   $cnt=1;
                   if($query->rowCount() > 0)
                   {
                    foreach($results as $result)
                    {  
                      ?>  
                      <tr>
                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                        <td class="text-center"><?php echo htmlentities($result->type);?></td>
                        <td class="text-center"><?php echo htmlentities($result->FullName);?></td>
                        <td class="text-center"><?php echo htmlentities($result->EmailId);?></td>
                        <td class="text-center"><?php echo htmlentities($result->ContactNo);?></td>
                        <td class="text-center"><?php echo htmlentities($result->Address);?></td>
                        <td class="text-center"><?php echo htmlentities($result->City);?></td>
                        <td class="text-center"><?php echo htmlentities($result->Country);?></td>
                        <td class="text-center"><?php echo htmlentities($result->RegDate);?></td>
                        <td class="text-center"><a href="customers.php?del=<?php echo $result->id;?>" onclick="return confirm('هل تريد الحذف');">
                        <i class="mdi mdi-delete"></i></i></a>
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
