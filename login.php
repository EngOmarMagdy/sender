<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if(is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
if(isset($_POST['username'])){

	if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
	if (!isset($_POST['password'])) $error[] = "Please fill out all fields";
       $username = $_POST['username'];
       $username = xss_clean($username) ;
       $username = filter_var($username,FILTER_SANITIZE_STRING) ;
	if (isValidUsername($username)){
		if (!isset($_POST['password'])){
			$error[] = 'A password must be entered';
		}
		$password = $_POST['password'];
		$password = xss_clean($password) ;
		$password = filter_var($password, FILTER_SANITIZE_STRING) ;
		$password = md5($password) ;
	}

    $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `userpass`='$password' and `useractive`='1' limit 1";
                 $result = $conn->query($sql);

            if ($result->num_rows > 0) {
			$row = $result->fetch_assoc() ;
            $_SESSION['loggedint'] = true;
		    $_SESSION['userid'] = $row['id'];
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['name'] = $row['uname'];
		    $_SESSION['usertype'] = $row['usertype'];
		    $_SESSION['super'] = $row['super'];
		    $_SESSION['datetime'] = $row['datetime'];
                // add to log table
                $loguser = $_SESSION['username'] ;
                $timelog = time() ;
                $datalog = " login $loguser " ;

                $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$timelog')";
                $conn->query($sqllog) ;
		   header('Location: index.php'); exit();
				 }else{
					 
					$error[] = "البيانات خطأ او العضوية غير مفعله" ;
					 
				 }
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
		
                        <h2 class="panel-title">يرجى ادخل البيانات</h2>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ادخل اسم المستخدم" name="username" type="text" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ادخل كلمة المرور" name="password" type="password" value="" required>
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
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="تسجيل الدخول">
                            </fieldset>
                        </form>
                    </div>
                </div>
               <a href="forget.php"><p>هل نسيت كلمة السر ؟ </p></a>
            </div>
        </div>
    </div>
		
				


<?php 
//include header template
require('layout/footer.php'); 
?>
