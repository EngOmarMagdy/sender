<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');exit();}
if(is_admin() ){ }else{header('Location: un.php');exit();}
if(is_super() ){ }else{header('Location: un.php');exit();}

//if form has been submitted process it
//include header template
require('layout/header.php');
is_tr() ;
$ord = $_GET['ord'] ;


// 

?>



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">السندرات</h1>
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
                                            <td><a href='editsender.php?ord=editsender&senderid=". $rowt['id'] ."'>edit</a></td>
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
