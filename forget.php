<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
//if(is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
if(isset($_POST['usermail'])){

	if (!isset($_POST['usermail'])) $error[] = "Please fill out all fields";
       $usermail = $_POST['usermail'];
       $usermail = xss_clean($usermail) ;
       $usermail = filter_var($usermail,FILTER_SANITIZE_EMAIL) ;


    $sql = "SELECT * FROM `users` WHERE `useremail`='$usermail' and `useractive`='1' limit 1";
                 $result = $conn->query($sql);

            if ($result->num_rows > 0) {
			$row = $result->fetch_assoc() ;

			$pass = rand(1111,9999999) ;

		    $uname =  $row['username']  ;
		    $umail = $row['useremail'] ;
		    $passencrypt  = md5($pass) ;
                $sqld = "UPDATE `users` SET `userpass`='$passencrypt' where `useremail`='$umail'";
                $resultd = $conn->query($sqld);
                 @mail("$umail","كلمة المرور الجديده - تراحم جازان"," كلمة المرور الجديده لحسابك هى  $pass ","from trahom jazan");
                $loguser = $_SESSION['username'] ;
                $datalog = "newpassword for $umail - $pass" ;

                $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$time')";
                $conn->query($sqllog) ;
                $error[] = "تم ارسال كلمة المرور الجديدة على الايميل" ;
                 header('Location: login.php'); exit();
                }else{
                $error[] = " عفوا البيانات خطأ" ;
            }
             // sleep("5") ;
                  //  header('Location: index.php'); exit();

}//end if submit

//include header template
require('layout/headerlogin.php'); 
?>

	
<div class="container">

<div class="row">
            <div class="col-md-4 col-md-offset-4">

<img src="images/logo.png"  width="350px" height="200px" alt="لوحة التحكم">
</div>
</div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
			

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
		
                        <h2 class="panel-title"><b>يرجى ادخال الايميل او اسم المستخدم الخاص بكم</b></h2>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="forget.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ادخل الايميل الخاص بك" name="usermail" type="email" required>
                                </div>


                                <div class="form-group">
                                   					<?php
				//check for any errors
				if(isset($error)){
                    /** @var TYPE_NAME $error */
                    foreach($error as $error){
						echo '<div class="bg-danger">'.$error.'</div>';
					}
				}


				?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="ارسال البيانات">
                            </fieldset>
                        </form>
                    </div>
                </div>
               <a href="index.php"><p>عودة </p></a>
            </div>
        </div>
    </div>
		
				


<?php 
//include header template
require('layout/footer.php'); 
?>
