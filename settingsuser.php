<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');}
if(is_admin() ){ }else{header('Location: un.php');}

//if form has been submitted process it
//include header template
require('layout/header.php');




$ord = $_GET['ord'] ;

if($ord=="update"){
    if(is_super() ){ }else{header('Location: un.php'); exite();}


    $sitename = $_POST['sitename'] ;
    $allowadd = $_POST['allowadd'];
    $allowdelete = $_POST['allowdelete'];
    $emailsite = $_POST['emailsite'];

    $smsuser = $_POST['smsuser'];
    $smspass = $_POST['smspass'];
    $smssender= $_POST['smssender'];
    $smsstatus= $_POST['smsstatus'];
	if (isset($_POST['sitename']))
	//if (isset($_POST['smsstatus']))





	$sqlt = "UPDATE `settings` SET `sitename`='$sitename' , `allowadd`='$allowadd' , `allowdelete`='$allowdelete', `emailsite`='$emailsite' , `smsuser`='$smsuser' , `smspass` ='$smspass' , `smssender`='$smssender' , `smsstatus`='$smsstatus' WHERE `id`=1";

  $conn->query($sqlt) ;

       if (@$conn->query($sql) === TRUE) {
        $suc[] = " تم تعديل البيانات بنجاح ";
       } else {
         $error[] = " . $sql . حدث خطأ ";
}



}else{

    if(is_super() ){ }else{header('Location: un.php'); exite();}
    $sql = "SELECT * FROM `SETTINGS` limit 1" ;
    $resultt = $conn->query($sql);
    $rowt = $resultt->fetch_assoc() ;
    $sitename = $rowt['sitename'] ;


    $allowadd =$rowt['allowadd'] ;
    $allowdelete = $rowt['allowdelete'] ;

    $emailsite = $rowt['emailsite'] ;

    $smsuser = $rowt['smsuser'] ;
    $smspass = $rowt['smspass'] ;
    $smssender = $rowt['smssender'] ;
    $smsstatus = $rowt['smsstatus'] ;



}

// 

?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">اعدادات الموقع</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			      <div class="row">
                <div class="col-lg-6">

				                    <div class="panel panel-default">
					 <div class="panel-heading">
                         اعدادا الموقع
                        </div>
						 <form role="form" action="settings.php?ord=update" method="POST">
                                        <div class="form-group">
                                            <label>اسم المؤسسة</label>
                                            <input class="form-control" name="sitename" value="<?php echo $sitename ; ?>" required>
                                        </div>
                             <div class="form-group">
                                 <label>تفعيل اضافة الملفات ؟ </label>
                                 <select class="form-control" name="allowadd">
                                     <option value="<?php echo $allowadd ; ?>"><?php echo $allowadd ; ?></option>
                                     <option value="لا">لا</option>
                                     <option value="نعم">نعم</option>

                                 </select>
                             </div>
                             <div class="form-group">
                                            <label>الايميل</label>
                                            <input class="form-control" name="emailsite" value="<?php echo $emailsite ; ?>">
                                            <p class="help-block">يرجى ادخال البريد الالكترونى للعضو</p>
                                        </div>

                             <div class="form-group">
                                            <label>تفعيل حذف الملفات ؟ </label>
                                 <select class="form-control" name="allowdelete">
                                     <option value="<?php echo $allowdelete ; ?>"><?php echo $allowdelete ; ?></option>
                                     <option value="لا">لا</option>
                                     <option value="نعم">نعم</option>

                                 </select>
                             </div>
                             <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ الاعدادات</button>

                                </div>
                
				       <!-- /.col-lg-12 -->
                </div>
                      <div class="col-lg-6">
                          <div class="panel panel-danger">
                              <div class="panel-heading">
                                  اعدادات sms</div>
                          </div>
                          <p class="help-block"><a href="http://www.mobile.net.sa" target="_blank"> mobile.net.sa </a> مزود الرسائل  هو المدار التقني </p>

                          <div class="form-group">
                              <label>ارسال الرسائل </label>
                              <select class="form-control" name="smsstatus">
                                  <option value='<?php echo $smsstatus ; ?>'><?php echo $smsstatus ; ?></option>
                                  <option value='نعم'>نعم</option>
                                  <option value='لا'>لا</option>

                              </select>
                          </div>
                          <div class="form-group">
                              <label>اسم المستخدم sms </label>
                              <input class="form-control" name="smsuser" value="<?php echo $smsuser ; ?>">
                          </div>
                          <div class="form-group">
                              <label>كلمة مرور sms </label>
                              <input class="form-control" name="smspass" value="">
                          </div>
                          <div class="form-group">
                              <label>اسم المرسل </label>
                              <input class="form-control" name="smssender" value="<?php echo $smssender ; ?>">
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ الاعدادات</button>
                          </form>

                </div>
                <!-- /.col-lg-12 -->

				       <!-- /.col-lg-12 -->
			
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
//include header template
@$conn->close();
require('layout/footer.php');
?>
