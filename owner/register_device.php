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
       $id=$row->id;
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
  $vimage1=$_FILES["img1"]["name"];
  $vimage2=$_FILES["img2"]["name"];
  $vimage3=$_FILES["img3"]["name"];
  move_uploaded_file($_FILES["img1"]["tmp_name"],"../admin/img/".$_FILES["img1"]["name"]);
  move_uploaded_file($_FILES["img2"]["tmp_name"],"../admin/img/".$_FILES["img2"]["name"]);
  move_uploaded_file($_FILES["img3"]["tmp_name"],"../admin/img/".$_FILES["img3"]["name"]);

  $sql="INSERT INTO devices VALUES(NULL,'$name','$company','$details','$type','$hour','$day','$hour','$day','$vimage2','$vimage3','$vimage1','$username','$id','1')";
  $query = $dbh->prepare($sql);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    $msg="تم تسجيل الجهاز بنجاح";
  }
  else 
  {
    $error="هناك مشكلة";
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
          <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class=" col -md-12 card">
              <div class="modal-header">
                <h5 class="modal-title" style="float: right;">إضافة جهاز جديد</h5>
              </div>
              <?php
              if($error){?>
                <div class="errorWrap">
                  <strong>خطأ</strong>:<?php echo htmlentities($error); ?> 
                </div>
                <?php
              } 
              else if($msg){?>
                <div class="succWrap" style="float: right;">
                  <strong>تم</strong>:<?php echo htmlentities($msg); ?> 
                </div>
                <?php 
              }?>
              
              <div class="col-md-12 mt-4">
                <div class="row ">
                  <div class="form-group col-md-6 ">
                    <label for="exampleInputPassword1" style="float: right;">اسم الجهاز<span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" value="" id="product" placeholder="ادخل اسم الجهاز" required>
                     
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1" style="float: right;">اسم الشركة<span style="color:red">*</span></label>
                    <input type="text" name="company" class="form-control" value="" id="product" placeholder="ادخل اسم الشركة" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputName1" style="float: right;">وصف الجهاز<span style="color:red">*</label>
                     <textarea class="form-control" name="details" rows="3" required></textarea>
                   </div>
                 </div>
                 <div class="row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputName1" style="float: right;">اختر نوع الجهاز<span style="color:red">*</label>
                          <select class="form-control" name="type" required>
                            <option value="games"> العاب </option>
                            <option value="electronics">الكترونيات</option>
                            <option value="computer">حاسوب او هاتف ذكي</option>
                            <option value="tools">ادوات</option>
                          </select>
                        </div>
                    <div class="form-group col-md-3" >
                      <label for="exampleInputName1"style="float: right;">سعر الجهاز بالساعة<span style="color:red">*</label>
                        <input type="text" name="hour" value=""  class="form-control" id="price"required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputName1">سعر الجهاز باليوم <span style="color:red">*</span></label>
                        <input type="text" name="day" value="" class="form-control" id="price"required>
                      </div>
                      
                      </div>
                      <div class="row ">
                       <div class="form-group col-md-4 pl-md-0">
                        <label class="col-sm-12 pl-0 pr-0 " style="float: right;">الصورة من الامام <span style="color:red">*</label>
                          <div class="col-sm-12 pl-0 pr-0">
                            <input type="file" name="img1" class="file-upload-default">
                            <div class="input-group ">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="رفع الصورة">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">رفع</button>
                              </span>
                            </div>
                          </div>
                        </div> 
                        <div class="form-group col-md-4 pl-md-0">
                          <label class="col-sm-12 pl-0 pr-0 " style="float: right;">الصورة من الخلف <span style="color:red">*</label>
                            <div class="col-sm-12 pl-0 pr-0">
                              <input type="file" name="img2" class="file-upload-default">
                              <div class="input-group ">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="رفع الصورة">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">رفع</button>
                                </span>
                              </div>
                            </div>
                          </div> 
                          <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 " style="float: right;">الصورة من جهة اخرى <span style="color:red">*</label>
                              <div class="col-sm-12 pl-0 pr-0">
                                <input type="file" name="img3" class="file-upload-default">
                                <div class="input-group ">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="رفع الصورة">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">رفع</button>
                                  </span>
                                </div>
                              </div>
                            </div> 
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="">&nbsp;</div>
                      <div class=" col -md-12 card">
                        <div class="modal-header">
                          
                 <button type="submit" style="float: right;" name="save" class="btn btn-primary  mr-2 mb-4">حفظ</button>
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
   <?php @include("includes/foot.php");?>
 </body>
 </html>