<?php require('includes/config.php');

//if logged in redirect to members page

//if form has been submitted process it
//include header template
require('layout/header.php');
// نهاية دالة التاريخ الهجرب



echo exec('tar zcf backups/my-backup.tar.gz uploads/*');

echo '...Done...';

?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">النسخ الاحتياطى </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        تفاصيل الملف رقم
                    </div>
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
                                    <td><b>رقم الملف</td>
                                    <td><?php echo $fnumber ; ?></td>

                                </tr>
                                <tr class="success">
                                    <td><b>نوع الملف</td>
                                    <td><b><?php echo  $tyfile ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>العنوان</b></td>
                                    <td><b><?php echo $fname ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>الملاحظات</b></td>
                                    <td><b><?php echo $details ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>الجهه</td>
                                    <td><b><?php echo $ftofrom ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>تاريخ اضافة الملف</b></td>
                                    <td><b><?php echo $datetime ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>تاريخ الملف</b></td>
                                    <td><b><?php echo $datfile ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>التاريخ الهجري</b></td>
                                    <td><b><?php echo $hij ; ?></b></td>

                                </tr>
                                <tr class="success">
                                    <td><b>سري ؟</b></td>
                                    <td><b><?php echo $fsecret ; ?></b></td>

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
            </div><!-- /.row -->
            </div><!-- /.row -->




                <!-- /.col-lg-12 -->
	
		
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

//include header template
require('layout/footer.php');
?>
