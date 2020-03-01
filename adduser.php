<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php'); exit();}
if(is_admin() ){ }else{header('Location: un.php'); exit();}
if(is_super() ){ }else{header('Location: un.php');}

//if form has been submitted process it
//include header template
require('layout/header.php');

$ord = $_GET['ord'] ;

if($ord=="adduser"){
    if(is_super() ){ }else{header('Location: un.php'); exit();}


    $nameara=filter_var($_POST['nameara'],FILTER_SANITIZE_STRING);
    $username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $nameteach=filter_var($_POST['nameteach'],FILTER_SANITIZE_STRING);
    $useremail=filter_var($_POST['useremail'],FILTER_SANITIZE_STRING);
    $userphone=filter_var($_POST['userphone'],FILTER_SANITIZE_STRING);
    $isusersuper=filter_var($_POST['issuper'],FILTER_SANITIZE_STRING);

    $userpass=md5($_POST['userpass']);

	$time = time() ;
	if (isset($_POST['username']))
	if (isset($_POST['userpass']))
	$sql = "INSERT INTO users (username, userpass, usertype, uname, useremail, userphone, super, datetime)
 VALUES ('$username', '$userpass' , 'admin' ,'$nameara','$useremail','$userphone','$isusersuper','$time')";

       if ($conn->query($sql) === TRUE) {


           // add to log table
           $loguser = $_SESSION['username'] ;
           $datalog = "add user $username - $nameara" ;

           $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$time')";
           $conn->query($sqllog) ;

           $suc[] = " تم اضافة العضو $nameara بنجاح ";
       } else {
         $error[] = " . $sql . حدث خطأ ";
}



}

// 

?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">اضافة مستخدم جديد</h1>
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
						 <form role="form" action="adduser.php?ord=adduser" method="POST">
                                        <div class="form-group">
                                            <label>اسم العضو</label>
                                            <input class="form-control" name="nameara" required>
                                            <p class="help-block">يرجى كتابة اسم العضو باللغه العربية</p>
                                        </div>
                                   <div class="form-group">
                                            <label>اسم الدخول</label>
                                            <input class="form-control" name="username" required>
                                            <p class="help-block">ادخل اسم مستخدم بالانجليزية او رقم هوية</p>
                                        </div>
                                          <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <input class="form-control" name="userpass" required>
                                            <p class="help-block">يرجى ادخال كلمة المرور التى سيدخل بها</p>
                                        </div>
                             <div class="form-group">
                                            <label>الايميل</label>
                                            <input class="form-control" name="useremail">
                                            <p class="help-block">يرجى ادخال البريد الالكترونى للعضو</p>
                                        </div>
                             <div class="form-group">
                                            <label>الجوال</label>
                                            <input class="form-control" name="userphone">
                                            <p class="help-block">يرجى ادخال الجوال للعضو يجب ان يبدا ب 966</p>
                                        </div>
                             <div class="form-group">
                                            <label>الصلاحيات ؟ </label>
                                 <select class="form-control" name="issuper">
                                     <option value="">عضو عادى</option>
                                     <option value="superadmin">مشرف عام</option>

                                 </select>
                             </div>
                                        <button type="submit" class="btn btn-info">اضافة </button>
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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-7778135355055222",
          enable_page_level_ads: true
     });
</script>