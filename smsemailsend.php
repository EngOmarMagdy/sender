<?php require('includes/config.php');
include("includes/OTSMS.php");

$sqltm = "SELECT * FROM `settings` limit 1";
$resultm = $conn->query($sqltm);

if ($resultm->num_rows > 0) {
    $rowm = $resultm->fetch_assoc();

    $smsuser =$rowm['smsuser'] ;
    $smspass =$rowm['smspass'] ;
    $smssender =$rowm['smssender'] ;
    $smsstatus =$rowm['smsstatus'] ;
    $siteemail =$rowm['emailsite'] ;

}

 if ($smsstatus!="no") {


     $sql = "SELECT `msgid`,`receverid`,`sendalert` FROM `msgs` where `sendalert`='2' limit 50";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();

         $receverid = $row['receverid'];
         $msgid = $row['msgid'];
         $receveremail = get_email_by_id($receverid);
         $receverphone = get_phone_by_id($receverid);
         $Message = "لديك رسالة جيده فى نظام المراسلات والارشفه";
         @mail("$receveremail", "رسالة جديده فى نظام الارشفة", "$siteemail  \n $msg");

         if ($receverid ="100100100") {


             $sqlr = "SELECT * FROM `users`";
             $resultr = $conn->query($sqlr);

             if ($resultr->num_rows > 0) {
                 $rowr = $resultr->fetch_assoc();

                 $receverid = $row['receverid'];
                 $receverema = $rowr['useremail'];
                 $receverpho = $rowr['userphone'];
                 $Message = "لديك رسالة جيده فى نظام المراسلات والارشفه";

                 $ss = SendSms($smsuser, $smspass, $receverpho, $smssender, $Message);
                   echo $ss ;
             }else{
                 $sqln = "update `msgs` set `sendalert`='3' where `receverid`='$receverid' and `msgid`='$msgid' limit 1";
                 $resultn = $conn->query($sqln);
                 echo "done $receverid <br>";
             }

         }else{
         SendSms($smsuser, $smspass, $receverphone, $smssender, $Message);

         $sqln = "update `msgs` set `sendalert`='3' where `receverid`='$receverid'";
         $resultn = $conn->query($sqln);
         echo "done $receverid <br>";
         }




     } else {

         exit("لاتوجد ارساليات فى الانتظار");
     }

 }else {

     exit("الرسائل معطلة من لوحة المشرف");
 }