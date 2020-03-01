<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php'); exit();}
if(is_admin() ){ }else{header('Location: un.php'); exit();}
if(is_super() ){ }else{header('Location: un.php'); exit();}

//if form has been submitted process it
//include header template
require('layout/header.php');

$ord = $_GET['ord'] ;

if($ord=="adduser"){
    if(is_super() ){ }else{header('Location: un.php'); exit();}


    $nameara=filter_var($_POST['nameara'],FILTER_SANITIZE_STRING);
    $userid=filter_var($_POST['userid'],FILTER_SANITIZE_STRING);
    $username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $nameteach=filter_var($_POST['nameteach'],FILTER_SANITIZE_STRING);
    $useremail=filter_var($_POST['useremail'],FILTER_SANITIZE_STRING);
    $userphone=filter_var($_POST['userphone'],FILTER_SANITIZE_STRING);
    $pass = $_POST['userpass'] ;

if ($pass !='0') {
    $userpass=md5($_POST['userpass']);

   $sqlp = " UPDATE `users` set `userpass`='$userpass' where `id`='$userid'";

    $conn->query($sqlp) ;
}
	$time = time() ;
	if (isset($_POST['username']))

        $sql = "UPDATE `users` set `username`='$username',`uname`='$nameara',`useremail`='$useremail',`userphone`='$userphone' WHERE `id`='$userid'" ;

       if ($conn->query($sql) === TRUE) {


           // add to log table
           $loguser = $_SESSION['username'] ;
           $datalog = "add user $username - $nameara" ;

           $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$time')";
           $conn->query($sqllog) ;

           header('Location: edituser.php?s=ss&uid='.$userid.'');
           $suc[] = " تم تعديل العضو $nameara بنجاح ";
       } else {
         $error[] = " . $sql . حدث خطأ ";
}



}
$gid = $_GET['uid'] ;


$sqlt = "SELECT * FROM `users` WHERE `id`=$gid limit 1";
$resultt = $conn->query($sqlt) or die(mysql_error());

if ($resultt->num_rows > 0) {

    $rowt = $resultt->fetch_assoc();

    $uid = $rowt['id'];
    $username = $rowt['username'];
    $uname = $rowt['uname'];
    $useremail = $rowt['useremail'];
    $userphone = $rowt['userphone'];


} else{header('Location: listuser.php');
}
// 
if ($_GET['s']=="ss"){
    $suc[] = " تم تعديل المستخدم $nameara بنجاح ";

}
?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تعديل مستخدم</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			      <div class="row">
                <div class="col-lg-6">
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
	if(isset($suc)){
					foreach($suc as $suc){
						echo '<p class="bg-success">'.$suc.'</p>';
					}
				}

			
				?>
			      
				                    <div class="panel panel-default">
					 <div class="panel-heading">
                           اضافة عضو
                        </div>
						 <form role="form" action="edituser.php?ord=adduser" method="POST">
                                        <div class="form-group">
                                            <label>اسم العضو</label>
                                            <input class="form-control" name="nameara" value="<?=$uname ; ?>" required>
                                            <input type="hidden" name="userid" value="<?=$uid ; ?>">
                                            <p class="help-block">يرجى كتابة اسم العضو باللغه العربية</p>
                                        </div>
                                   <div class="form-group">
                                            <label>اسم الدخول</label>
                                            <input class="form-control" name="username" value="<?=$username ; ?>" required>
                                            <p class="help-block">ادخل اسم مستخدم بالانجليزية او رقم هوية</p>
                                        </div>
                                          <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <input class="form-control" type="password" name="userpass" value="0" required>
                                            <p class="help-block">اتركها كماهى فى حالة عدم الرغبة بالتغيير</p>
                                        </div>
                             <div class="form-group">
                                            <label>الايميل</label>
                                            <input class="form-control" name="useremail" value="<?=$useremail ; ?>">
                                            <p class="help-block">يرجى ادخال البريد الالكترونى للعضو</p>
                                        </div>
                             <div class="form-group">
                                            <label>الجوال</label>
                                            <input class="form-control" name="userphone" value="<?=$userphone ; ?>">
                                            <p class="help-block">يرجى ادخال الجوال للعضو يجب ان يبدا ب 966</p>
                                        </div>

                                        <button type="submit" class="btn btn-info">تعديل </button>
                                    </form>
                                </div>
                
				       <!-- /.col-lg-12 -->
                </div>
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
