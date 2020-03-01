    <?php require('includes/config.php');

    //if logged in redirect to members page
    //if logged in redirect to members page
    if(is_logged_in() ){ }else{header('Location: login.php');exit();}
    if(is_admin() ){ }else{header('Location: un.php');exit();}
    //if form has been submitted process it
    //include header template
    require('layout/header.php');
     $gid = filter_var($_GET['ord'],FILTER_SANITIZE_STRING);
    $msgidd = intval($_GET['msgid']) ;
    $msguserid = $_SESSION['userid'];

    if ($gid=="viewmsg" and isset($msgidd)){
    $sqltm = "SELECT * FROM `msgs` where msgid='$msgidd' and (`senderid`='$msguserid' or `receverid`='$msguserid' or `receverid`='100100100') limit 1";
    $resultm = $conn->query($sqltm);

    if ($resultm->num_rows > 0) {
        $rowm = $resultm->fetch_assoc() ;
        // output data of each row
        $msgsender = get_username_by_id($rowm['senderid']) ;
        $msgrecever = get_username_by_id($rowm['receverid']) ;
        $msgreceverid = $rowm['receverid'] ;
        $msgtype = $rowm['msgtype'] ;
        $msgtit = $rowm['msgtitle'] ;
        $fpath = $rowm['msgpass'] ;
        $msgcontent = $rowm['msgcontent'] ;
        $datetime = $rowm['datetime'] ;
        $datesend = date("d-m-Y j:s A",$datetime) ;




        //التاريخ الهجرى
        date_default_timezone_set('GMT');
//
        require 'I18N/arabic.php' ;
        $Arabic = new I18N_Arabic('Date');

        $correction = $Arabic->dateCorrection ($datetime);
        $hij =  $Arabic->date('l dS F Y h:i:s A', $datetime, $correction);

// نهاية دالة التاريخ الهجرب

    } else {
        header('Location: un.php');exit();
    }
?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تفاصيل الرساله </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
تفاصيل الرساله المرسلة من <?php echo  $msgrecever ; ?>                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="success">
                                    <td><b>المرسل </td>
                                    <td><?php echo $msgsender ; ?></td>

    </tr>
    <tr class="success">
        <td><b>اهمية الرساله</td>
        <td><b><?php echo  $msgtype ; ?></b></td>

    </tr>
    <tr class="success">
        <td><b>العنوان</b></td>
        <td><b><?php echo $msgtit ; ?></b></td>

    </tr>
    <tr class="success">
        <td><b>محتوى الرساله</b></td>
        <td><b><?php echo $msgcontent ; ?></b></td>

    </tr>

    <tr class="success">
        <td><b>تاريخ الارسال</b></td>
        <td><b><?php echo  $datesend ; ?></b></td>

    </tr>

    <tr class="success">
        <td><b>التاريخ الهجري</b></td>
        <td><b><?php echo $hij ; ?></b></td>

    </tr>


    <tr class="danger">
        <td><b>المرفقات</b></td>
        <?php
        if ($fpath!="") {
            $path = $fpath ;
            echo " <td><a download href=" . $fpath . "><button type='button' class='btn btn-info'>تحميل الملف</button></a></td>";
        }else{

            echo "<td>لايوجد مرفقات</b></td>"  ;

        }
     if ($msguserid==$msgreceverid){

        $sqltu = "update `msgs` set msgread='1' WHERE `msgid`='$msgidd' limit 1";
        $resultu = $conn->query($sqltu);
     }
        ?>

    </tr>
    </tbody>
    </table>
    </div>
    <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
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



                                        echo "    <a href=\"viewmsg.php?msgid=$msgidd\" class=\"list-group-item\">
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
    </div><!-- /.row -->




    <!-- /.col-lg-12 -->


    </div>
    </div>
    <!-- /#page-wrapper -->

    </div>

<?php
}else {
    $cond = "`receverid`='$msguserid' or `senderid`='$msguserid' or `receverid`='100100100' order by msgid desc";
    if ($gid == "viewall") {
        $cond = "`receverid`='$msguserid' or `senderid`='$msguserid' or `receverid`='100100100' order by msgid desc";
    }
    if ($gid == "viewwared") {
        $cond = "`receverid`='$msguserid' or `receverid`='100100100' order by msgid desc";
    }
    if ($gid == "viewsader") {
        $cond = "`senderid`='$msguserid'";
    }


    ?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> قائمة الرسائل</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php if ($_GET['msg'] == 1) { ?>
            <div class="alert alert-success">تم الحذف بنجاح</div>
        <?php } ?>
        <?php if ($_GET['msg'] == 2) { ?>
            <div class="alert alert-danger">حدث خطا لم يتم الحذف</div>
        <?php } ?>
        <?php if ($_GET['msg'] == 3) { ?>
            <div class="alert alert-danger">عفوا ليس لديك الصلاحية للحذف</div>
        <?php } ?>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        جميع الرسائل الصادره والوارده
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>الاهمية</th>
                                    <th>مرسلة من</th>
                                    <th>عنوان الرساله</th>
                                    <th>مرسلة الى</th>
                                    <th>تاريخ الاضافه</th>
                                    <th>التحكم</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $sqlt = "SELECT * FROM `msgs` where $cond";
                                $resultt = $conn->query($sqlt);

                                if ($resultt->num_rows > 0) {
                                    // output data of each row
                                    while ($rowt = $resultt->fetch_assoc()) {
// التحقق  من نوع الملف
                                        $senderid = $rowt['senderid'];
                                        $msgid = $rowt['msgid'];
                                        $receverid = $rowt['receverid'];
                                        $msgtitle = $rowt['msgtitle'];
                                        $msgtype = $rowt['msgtype'];
                                        $receverid = $rowt['receverid'];
                                        $fpath = $rowt['msgpass'];

                                        $unamesender = get_username_by_id($senderid);
                                        $unamerecever = get_username_by_id($receverid);
                                        $tt = $rowt['datetime'];

                                        //التاريخ الهجرى
//
                                        include_once('includes/hejridate.php') ;

                                        $hijr =  edate("_j - _m - _Y هجري",$tt);


                                        if ($fpath != "") {
                                            $path = $fpath;
                                            $morfakat = "<a download href=" . $path . "><button type='button' class='btn btn-primary btn-xs'> مرفقات</button></a>";
                                        } else {
                                            $morfakat = "بدون ";
                                        };
                                        echo "    <tr>
                                                <td><button type=\"button\" class=\"btn btn-" . $tyfilecolor . " btn-xs\">" . $rowt['msgid'] . "</button></td>
                                                <td><button type=\"button\" class=\"btn btn-outline btn-primary btn-xs\">$msgtype</button></td>
                                                <td>$unamesender</td>
                                                <td>$msgtitle</td>
                                                <td>$unamerecever</td>
                                               
                                                <td>" . $hijr. "</td>
                               <td>
                               ";


                                        echo "      
                               $morfakat

                               <a href='viewmsg.php?ord=viewmsg&msgid=$msgid'><button type=\"button\" class=\"btn btn-success btn-circle\"><i class=\"fa fa-link\"></i>
                             
                                </button></a>
                                            </tr>";
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
}
    //include header template
     mysqli_close($conn);

    require('layout/footer.php');

    ?>
