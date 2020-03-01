<?php require('includes/config.php');

//if logged in redirect to members page
//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');}
if(is_admin() ){ }else{header('Location: un.php');}
if(is_super() ){ }else{header('Location: un.php');}
//if form has been submitted process it
//include header template
require('layout/header.php');


$ord = $_GET['ord'] ;
$uid = $_GET['fid'] ;
$uid = intval($_GET['fid']) ;

if($ord=="userct"){

    $active = $_GET['activ'] ;

    if ($active=="1"){

        $actstatus = "0" ;

    }else{
        $actstatus = "1";

    }

    if(is_super() ){

    $sqlup = "UPDATE `users` SET `useractive`='$actstatus' where `id`='$uid' limit 1";
    $conn->query($sqlup);


        // add to log table
        $loguser = $_SESSION['username'] ;
        $timelog = time() ;
        $datalog = "change permession $uid  to $actstatus " ;

        $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$timelog')";
        $conn->query($sqllog) ;

     header('Location: listuser.php?msg=5');
                  }else{header('Location: listuser.php?msg=4'); exit();}

       }else{



}

?>



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">قائمة الاعضاء</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<?php if($_GET['msg']  == 1){ ?>
			<div class="alert alert-success">تم الحذف بنجاح</div>
			<?php } ?>
			<?php if($_GET['msg']  == 2){ ?>
			<div class="alert alert-danger">حدث خطا لم يتم الحذف</div>
			<?php } ?>
			<?php if($_GET['msg']  == 3){ ?>
			<div class="alert alert-danger">عفوا ليس لديك الصلاحية للحذف</div>
			<?php } ?>

            <?php if($_GET['msg']  == 4){ ?>
			<div class="alert alert-danger">عفوا ليس لديك الصلاحية لتعديل الصلاحيات</div>
			<?php } ?>

            <?php if($_GET['msg']  == 5){ ?>
			<div class="alert alert-success">تم تعديل الصلاحيات للعضو بنجاح</div>
			<?php } ?>
            <!-- /.row -->
			         <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
قائمة الاعضاء                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>م</th>
                                            <th>اسم العضو</th>
                                            <th>اسم المستخدم</th>
                                            <th>الجوال</th>
                                            <th>نوع العضوية</th>
                                            <th>البريد</th>
                                            <th>حذف الصلاحيات</th>
                                            <th>التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                      <?php
											  $sqlt = "SELECT * FROM `users`";
                                                    $resultt = $conn->query($sqlt);

                                                  if ($resultt->num_rows > 0) {
                                                    // output data of each row
                                                    while($rowt = $resultt->fetch_assoc()) {
														if($rowt['super'] == "superadmin"){
                                                           $usert = "مشرف عام" ;
														   $cls = "danger" ;
														}else{
                                                           $usert = "عضو" ;
														    $cls = "info" ;
														}	;

														if($rowt['useractive'] == "1"){
                                                           $userac = "نشط" ;
														   $clsac = "success btn-xs" ;
														}else{
                                                           $userac = "غير نشط" ;
														    $clsac = "danger btn-xs" ;
														}	;
														

                                     
									 echo "    <tr>
                                            <td>". $rowt['id'] ."</td>
                                            <td>".$rowt['uname']."</td>
                                            <td>".$rowt['username']."</td>
                                            <td>".$rowt['userphone']."</td>
                                            <td><button type='button' class='btn btn-".$cls."'>".$usert."</button></td>
                                            <td>".$rowt['useremail']."</td>
                                            <td><button onclick=\"var r = confirm('هل انت متأكد من تغيير الصلاحيات؟');if (r == true) {window.location = 'listuser.php?ord=userct&activ=". $rowt['useractive'] ."&fid=". $rowt['id'] ."';}\" type='button' class='btn btn-info'>تغيير الصلاحيات</button><button type='button' class='btn btn-".$clsac."'>".$userac."</button></td>
                                            <td><button onclick=\"var r = confirm('هل انت متأكد من الحذف؟');if (r == true) {window.location = 'del.php?ord=deluser&fid=". $rowt['id'] ."';}\" type='button' class='btn btn-danger'>حذف العضو</button><button onclick=\"var r = confirm('هل انت متأكد من التعديل؟');if (r == true) {window.location = 'edituser.php?uid=". $rowt['id'] ."';}\" type='button' class='btn btn-info'>تعديل</button></td>
                                        </tr>" ;
									
                                                        }
                                                  }
											  
											  ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
             
                <!-- /.col-lg-6 -->
            </div>
				       
				                  
							
                
                <!-- /.col-lg-12 -->
	
		
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
//include header template
mysqli_close($conn);

require('layout/footer.php');
?>
