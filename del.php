<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');}
if(is_admin() ){ }else{header('Location: un.php');}

//if form has been submitted process it
//include header template
require('layout/header.php');
$ord = $_GET['ord'] ;
if($ord=="delfile"){

    $fid=$_GET['fid'];
    $fid=xss_clean($_GET['fid']);
	if(is_super()){
 $sqld = "DELETE FROM `storefiles` WHERE `fileid`=$fid limit 1";
 
    
   if ($resultd = $conn->query($sqld)) {
	   header('Location: listfile.php?msg=1'); exit();
      }else{
	   header('Location: listfile.php?msg=2'); exit();
	} }else{
         header('Location: listfile.php?msg=3') ; exit();
	}
}elseif($ord=="deluser"){
	
	 $fid=$_GET['fid'];
	    $fid=xss_clean($_GET['fid']);
	    if(is_super()){

   $sql = "DELETE FROM `users` WHERE id=$fid limit 1";
   if ($result = $conn->query($sql)) {
       // add to log table
       $loguser = $_SESSION['username'] ;
       $timelog = time() ;
       $datalog = "delete user $fid " ;

       $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$timelog')";
       $conn->query($sqllog) ;
	   header('Location: listuser.php?msg=1'); exit();
      }else{
	   header('Location: listuser.php?msg=2'); exit();

      }
	}else{
         header('Location: listuser.php?msg=3'); exit();
	}
	
	
}elseif ($ord=="delfilesader"){
    $fid=$_GET['fid'];
    $fid=xss_clean($_GET['fid']);
        if(is_super()){

            $sql = "DELETE FROM `storefilessader` WHERE `fileid`='$fid' limit 1";
            if ($result = $conn->query($sql)) {
                // add to log table
                $loguser = $_SESSION['username'] ;
                $timelog = time() ;
                $datalog = "delete file $fid " ;

                $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$timelog')";
                $conn->query($sqllog) ;
                header('Location: listfile.php?msg=1'); exit();
            }else{
                header('Location: listfile.php?msg=2'); exit();

            }




                }else{
            header('Location: listfile.php?msg=3'); exit();
        }


}elseif ($ord=="delfilewared"){
    $fid=$_GET['fid'];
    $fid=xss_clean($_GET['fid']);
    if(is_super()){

        $sql = "DELETE FROM `storefiles` WHERE `fileid`='$fid' limit 1";
        if ($result = $conn->query($sql)) {
            // add to log table
            $loguser = $_SESSION['username'] ;
            $timelog = time() ;
            $datalog = "delete file $fid " ;

            $sqllog = "INSERT INTO syslog (userid, details, datetime)
 VALUES ('$loguser', '$datalog' ,'$timelog')";
            $conn->query($sqllog) ;
            header('Location: listfilewared.php?msg=1'); exit();
        }else{
            header('Location: listfilewared.php?msg=2'); exit();

        }




    }else{
        header('Location: listfilewared.php?msg=3'); exit();
    }


}else{

    header('Location: index.php');


}
$suc[] = '';
$error[] = '';
?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">حذف الملفات</h1>
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
				

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
	
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
//include header template
require('layout/footer.php');
?>
