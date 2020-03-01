<?php require('includes/config.php');

//if logged in redirect to members page
if(is_logged_in() ){ }else{header('Location: login.php');exit();}

//if form has been submitted process it
//include header template
require('layout/header.php');



$ty = $_SESSION['usertype'] ;
$ttt = $_SESSION['datetime'] ;
$ttt = @date('Y-m-d',$tt) ;

?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">رئيسية لوحة التحكم</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <div class="huge"><?php staticsfsader("1") ; ?></div>
                                    <div>عدد السندرات</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>



			<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            اخر السندرات المضافة
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>رقم</th>
                                        <th>السندر</th>
                                        <th>البوابة</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sqlt = "SELECT * FROM `sender` order by id desc limit 5";
                                    $resultt = $conn->query($sqlt);

                                    if ($resultt->num_rows > 0) {
                                    // output data of each row
                                    while($rowt = $resultt->fetch_assoc()) {
                                        // التحقق  من نوع الملف
                                        $fileid = $rowt['fileid'];



                                        echo "<tr class=\"" . $tyfilecolor . "\">
                                        <td>".$rowt['id']."</td>
                                        <td>".$rowt['sendername']."</td>
                                        <td>".$rowt['getway']."</td>
                                        
                          </td>
                                    </tr>";
                                    }} ;
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
                <div class="col-lg-6">
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

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
//include header template
require('layout/footer.php');
?>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-7778135355055222",
          enable_page_level_ads: true
     });
</script>

