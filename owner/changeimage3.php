<?php
include('includes/checklogin.php');
check_login();
include('includes/config.php');
if(isset($_POST['update']))
{
  $vimage1=$_FILES["img1"]["name"];
  $id=intval($_GET['imgid']);
  move_uploaded_file($_FILES["img1"]["tmp_name"],"img/".$_FILES["img1"]["name"]);
  $sql="update devices set dimage=:vimage1 where id=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();

  $msg="تم تعديل الصورة بنجاح";
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
            <div class="col-md-10">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">


                    <?php if($error){?><div class="errorWrap"><strong>فشل</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                    else if($msg){?><div class="succWrap"><strong>تم</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



                    <div class="form-group">
                    <center>
                      <label class="col-sm-4 control-label">الصورة الحالية</label>
                      <?php 
                      $id=intval($_GET['imgid']);
                      $sql ="SELECT dimage from devices where id=:id";
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
                          <div class="col-sm-8">
                            <img src="img/<?php echo htmlentities($result->dimage);?>" width="300" height="200" style="border:solid 1px #000">
                          </div>
                          <?php
                        }
                      }?>
                    </div>

                    <div class="form-group">
                    <center>
                      <label class="col-sm-4 control-label">رفع صورة جديدة<span style="color:red">*</span></label>
                      <div class="col-sm-8">
                        <input type="file" name="img1" required>
                      </div>
                    </div>
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-8 col-sm-offset-4">
                      <center>
                        <button class="btn btn-primary" name="update" type="submit">تعديل</button>
                      </div>
                    </div>

                  </form>

                </div>
              </div>
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