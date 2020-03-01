<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');exit();}
if(is_admin() ){ }else{header('Location: un.php');exit();}
if(is_super() ){ }else{header('Location: un.php');exit();}

//if form has been submitted process it
//include header template
require('layout/header.php');

$ord = $_GET['ord'] ;

if($ord=="editsender" and isset($_GET['senderid'])){

    $senderid=$_GET['senderid'];


        $sqlt = "SELECT * FROM `sender` WHERE `id`='$senderid' limit 1";
$resultt = $conn->query($sqlt);

if ($resultt->num_rows > 0) {


    $rowt = $resultt->fetch_assoc() ;

    $sendername = $rowt['sendername'] ;
    $senderuser = $rowt['usersender'] ;
    $senderpass = $rowt['userpass'] ;
    $sendergetway = $rowt['getway'] ;
    $sendernotes = $rowt['notes'] ;






}








}elseif($ord=="doedite" and isset($_POST['senderid'])){


    if (isset($_POST['sendername']))
     if (isset($_POST['getway']))
     if (isset($_POST['username']))
     if (isset($_POST['userpass']))

         $sentdid =$_POST['senderid'];
    $sendername=$_POST['sendername'];
    $getway=$_POST['getway'];
    $username=$_POST['username'];
    $userpass=$_POST['userpass'];
    $notes=$_POST['notes'];

         $sqlt = "UPDATE `sender` SET `getway`='$getway',`usersender`='$username',`userpass`='$userpass',`sendername`='$sendername',`notes`='$notes' where `id`='$sentdid' limit 1";
        if($resultt = $conn->query($sqlt)){

            $suc[] = "تم التعديل بنجاح";


        };


}

// 

?>



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">اضافة اسم مرسل جديد</h1>
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
                         اضافة سندر
                        </div>
						 <form role="form" action="editsender.php?ord=doedite" method="POST">
                                        <div class="form-group">
                                            <label>ادخل اسم المرسل من فضلك</label>
                                            <input class="form-control" name="sendername" value="<?php echo $sendername ; ?>" maxlength="14" required>
                                            <input type="hidden" name="senderid" value="<?php echo $senderid ; ?>">
                                        </div>     <div class="form-group">
                                            <label>اختر البوابة</label>
                                        <select name="getway">

                                            <option value="<?php echo $sendergetway ;?>" selected><?php echo $sendergetway ;?></option>
                                            <option value="alfacell">alfacell</option>
                                            <option value="yamamah" disabled> yamamah</option>


                                        </select>
                                        </div>
                             <div class="form-group">
                                            <label>اسم المستخدم فى البوابة</label>
                                            <input class="form-control" value="<?php echo $senderuser ;?>" name="username" required>
                                        </div>     <div class="form-group">
                                            <label>كلمة المرور للبوابة</label>
                                            <input class="form-control" value="<?php echo $senderpass ;?>" name="userpass" required>
                                        </div>
                                       <div class="form-group">
                                            <label>ملاحظات</label>
                                            <textarea class="form-control" name="notes"><?php echo $sendernotes ;?></textarea>
                                        </div>
                                   
                                      
                                        <button type="submit" class="btn btn-info">تعديل </button>
                                    </form>
                                </div>
                </div>
                </div>
                <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            استعراض اسماء المرسل                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>رقم</th>
                                        <th>اسم المرسل</th>
                                        <th>البوابة</th>
                                        <th>المستخدم فى البوابة</th>
                                        <th>كلمة المرور فى البوابة</th>
                                        <th>ملاحظات</th>
                                        <th>تحكم</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sqlt = "SELECT * FROM `sender`";
                                    $resultt = $conn->query($sqlt);

                                    if ($resultt->num_rows > 0) {
                                        // output data of each row
                                        while($rowt = $resultt->fetch_assoc()) {

                                            echo "    <tr>
                                            <td>". $rowt['id'] ."</td>
                                            <td>".$rowt['sendername']."</td>
                                            <td>".$rowt['getway']."</td>
                                            <td>".$rowt['usersender']."</td>
                                            <td>*******</td>
                                            <td>".$rowt['notes']."</td>
                                            <td><a href='editsender.php?ord=editsender&senderid=". $rowt['id'] ."' </td>
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