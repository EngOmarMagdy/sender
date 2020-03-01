<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');}
if(is_admin() ){ }else{header('Location: un.php');}

//if form has been submitted process it
//include header template
require('layout/header.php');


$uid =    $_SESSION['userid']  ;

$ord = $_GET['ord'] ;

if($ord=="update"){
    if(is_super() ){ }else{header('Location: un.php'); exite();}


    $sitename = filter_var($_POST['sitename'],FILTER_SANITIZE_STRING) ;


    $allowadd = filter_var($_POST['allowadd'],FILTER_SANITIZE_STRING) ;
    $allowdelete = filter_var($_POST['allowdelete'],FILTER_SANITIZE_STRING) ;

    $emailsite = filter_var($_POST['emailsite'] ,FILTER_SANITIZE_STRING) ;

    $smsuser = filter_var($_POST['smsuser'] ,FILTER_SANITIZE_STRING) ;
    $smspass = filter_var($_POST['smspass'] ,FILTER_SANITIZE_STRING) ;
    $smssender = filter_var( $_POST['smssender'] ,FILTER_SANITIZE_STRING) ;
    $smsstatus = filter_var( $_POST['smsstatus'] ,FILTER_SANITIZE_STRING) ;

	if (isset($_POST['sitename']))
	//if (isset($_POST['smsstatus']))

	$sqlt = "UPDATE `settings` SET `sitename`='$sitename' , `allowadd`='$allowadd' , `allowdelete`='$allowdelete', `emailsite`='$emailsite' , `smsuser`='$smsuser', `smspass`='$smspass', `smssender`='$smssender' ,`smsstatus`='$smsstatus' ";

  $conn->query($sqlt) or die(mysql_error()) ;

       if (@$conn->query($sql) === TRUE) {
        $suc[] = " تم تعديل البيانات بنجاح ";
       } else {
         $error[] = " . $sql . حدث خطأ ";
}



}else{

    if(is_super() ){ }else{header('Location: un.php'); exite();}
    $sql = "SELECT * FROM settings where id='$uid' limit 1" ;
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
                                 <label>تفعيل الارسال </label>
                                 <select class="form-control" name="allowadd">
                                     <option value="<?php echo $allowadd ; ?>"><?php echo $allowadd ; ?></option>
                                     <option value="لا">لا</option>
                                     <option value="نعم">نعم</option>

                                 </select>
                             </div>
                             <div class="form-group">
                                            <label>الايميل</label>
                                            <input class="form-control" name="emailsite" value="<?php echo $emailsite ; ?>">
                                        </div>

                             <div class="form-group">
                                            <label>التوكن Token -يستخدم للربط مع البوابة الاساسية </label>
                                            <input class="form-control" name="ttkk" value="<?php echo $tokeng ; ?>">
                                        </div>



                             <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ الاعدادات</button>

                                </div>
                
				       <!-- /.col-lg-12 -->
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
