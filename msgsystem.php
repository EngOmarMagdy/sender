<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');}
if(is_admin() ){ }else{header('Location: un.php');}

//if form has been submitted process it
//include header template
require('layout/header.php');

$ord = $_GET['ord'] ;

if($ord=="addmsg") {
    if (is_super()) {
    } else {
        header('Location: un.php');
        exit();
    }
    $senderid = $_SESSION['userid'];
    $receverid = $_POST['receverid'];
    $msgtitle = filter_var($_POST['msgtitle'], FILTER_SANITIZE_STRING);
    $msgcontent = filter_var($_POST['msgcontent'], FILTER_SANITIZE_STRING);
    $msgtype = filter_var($_POST['msgtype'], FILTER_SANITIZE_STRING);
    $sendalert = filter_var($_POST['sendalert'], FILTER_SANITIZE_STRING);
    $datetime = time();
    $target_dir = "uploads/";
    $f_name = $_FILES["fileToUpload"]["name"];
    if (isset($_POST['receverid']))
        if (isset($_POST['msgtitle']))

    if (isset($f_name) and $f_name != "") {
        $f_name =  $datetime . basename($_FILES["fileToUpload"]["name"]);
        $ext = pathinfo($f_name, PATHINFO_EXTENSION);
        $f_name = $senderid ."-" .$datetime . "orbit." . $ext;
        $target_file = $target_dir . $f_name;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            foreach ($receverid as $receverid) {

                $sql = "INSERT INTO msgs (senderid, receverid, msgtitle, msgcontent, msgread, msgtype, msgpass, sendalert, datetime)
 VALUES ('$senderid', '$receverid' , '$msgtitle' ,'$msgcontent','0','$msgtype','$target_file', '$sendalert', '$datetime')";

                if ($conn->query($sql) === TRUE) {
                    $suc = " تم اضافة الرساله  بنجاح وتم رفع الملف";
                    //sendalert to users


                } else {
                    $error = " . $sql . حدث خطأ ";
                }
            }

        } else {

            $error = 'لم يتم رفع اى مرفقات';


        }

    }else {
        foreach ($receverid as $receverid) {

            $sql = "INSERT INTO msgs (senderid, receverid, msgtitle, msgcontent, msgread, msgtype, sendalert, datetime)
 VALUES ('$senderid', '$receverid' , '$msgtitle' ,'$msgcontent','0','$msgtype', '$sendalert', '$datetime')";

            if ($conn->query($sql) === TRUE) {
                $suc = " تم اضافة الرساله  بنجاح ولم يتم رفع اى ملف";
                //sendalert to users


            } else {
                $error = " . $sql . حدث خطأ ";
            }
        }
    }
}
// 

?>


        <!-- Page Content -->
<div id="page-wrapper" xmlns="http://www.w3.org/1999/html">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">رسالة جديده</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			      <div class="row">
                <div class="col-lg-6">
				<?php
				//check for any errors
				if(isset($error)){

						echo '<p class="bg-danger">'.$error.'</p>';

				}
	if(isset($suc)){

						echo '<p class="bg-success">'.$suc.'</p>';

				}

			
				?>
			      
				                    <div class="panel panel-default">
					 <div class="panel-heading">
                           اضافة رسالة جديده
                        </div>
						 <form role="form" action="msgsystem.php?ord=addmsg" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>اسم العضو</label>
                                            <select multiple class="form-control" name="receverid[]" required>
                                                 <option value='100100100'>الجميع - رساله عامة </option>

                                                <?php
                                                $sqlt = "SELECT * FROM `users` order by uname ASC";
                                                $resultt = $conn->query($sqlt);

                                                if ($resultt->num_rows > 0) {
                                                    // output data of each row
                                                    while($rowt = $resultt->fetch_assoc()) {
                                                        echo " <option value='" . $rowt['id'] . "'> ".$rowt['uname']."</option>" ;
                                                    }
                                                } else {
                                                    echo " <option value=''>لايوجد</option>" ;
                                                }


                                                ?>
                                            </select>
                                            <p class="help-block">اختر العضو المراد ارسال الرساله له</p>
                                        </div>
                                   <div class="form-group">
                                            <label>عنوان الرساله</label>
                                            <input class="form-control" name="msgtitle" required>
                                        </div>
                                          <div class="form-group">
                                            <label>محتوى الرساله</label>
                                            <textarea class="form-control" name="msgcontent"></textarea>
                                        </div>
                             <div class="form-group">
                                 <label>اهمية الرساله</label>

                                 <select class="form-control" name="msgtype" required>
                                     <option value='عادى'>عادى</option>
                                     <option value='هام'>هام </option>
                                     <option value='هام جدا'>هام جدا </option>
                                     <option value='سري'>سري  </option>
                                     <option value='سري للغايه'>سري للغايه </option>
                                 </select>
                                        </div>
                             <div class="form-group">
                                 <label>المرفقات</label>
                                 <input type="file" name="fileToUpload">

                                 <p class="help-block">يمكنك اختيار اى ملف  من الجهاز</p>
                             </div>
                             <div class="form-group">
                                            <label>تنبيه العضو بالايميل او الجوال ؟ </label>
                                 <select class="form-control" name="sendalert">
                                     <option value="1">لا</option>
                                     <option value="2">نعم</option>

                                 </select>
                             </div>
                                        <button type="submit" class="btn btn-info">اضافة </button>
                                    </form>


                                </div>
                                </div>
                      <div class="col-lg-4">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <i class="fa fa-bell fa-fw"></i> أحدث الرسائل
                              </div>
                              <!-- /.panel-heading -->
                              <div class="panel-body">
                                  <div class="list-group">
                                      <?php
                                      $msguserid = $_SESSION['userid'] ;
                                      $sqlm = "SELECT `msgid`,`msgtitle`,`datetime` FROM `msgs` where `receverid`='$msguserid' or `receverid`='100100100' order by msgid desc limit 8";
                                      $resultm = $conn->query($sqlm);

                                      if ($resultm->num_rows > 0) {
                                          // output data of each row
                                          while($rowm = $resultm->fetch_assoc()) {
                                             $msgidd =   $rowm['msgid']  ;
                                             $msgtit =   $rowm['msgtitle']  ;
                                             $msgdatetime =   date("d-m-Y j:s",$rowm['datetime'])  ;



                                      echo "    <a href=\"viewmsg.php?ord=viewmsg&msgid=$msgidd\" class=\"list-group-item\">
                                          <i class=\"fa fa-comment fa-fw\">  </i>$msgtit
                                          <span class=\"pull-left text-muted small\"><em>$msgdatetime</em>
                                    </span>
                                      </a>" ;


                                      }
                                      } else {
                                      echo "<option value=''>لايوجد </option>" ;
                                      } ?>

                                  </div>
                                  <!-- /.list-group -->
                                  <a href="viewmsg.php?ord=viewall" class="btn btn-default btn-block">جميع الرسائل</a>
                              </div>
                              <!-- /.panel-body -->
                          </div>
                          <!-- /.col-lg-12 -->

                      </div>
                                </div>

				       <!-- /.col-lg-12 -->

                <!-- /.col-lg-12 -->



        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
//include header template
@$conn->close();
require('layout/footer.php');
?>
