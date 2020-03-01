<?php
require('includes/config.php');


// if sender isset 

// select from senders where sender = tttt

// user = tttt and pass = tttt
function printStringResult($apiResult, $arrayMsgs, $printType = 'Alpha')
{
	global $undefinedResult;
	switch ($printType)
	{
		case 'Alpha':
		{
			if(array_key_exists($apiResult, $arrayMsgs))
				return $arrayMsgs[$apiResult];
			else
				return $arrayMsgs[0];
		}
		break;

		case 'Balance':
		{
			if(array_key_exists($apiResult, $arrayMsgs))
				return $arrayMsgs[$apiResult];
			else
			{
				list($originalAccount, $currentAccount) = explode("/", $apiResult);
				if(!empty($originalAccount) && !empty($currentAccount))
				{
					return sprintf($arrayMsgs[3], $currentAccount, $originalAccount);
				}
				else
					return $arrayMsgs[0];
			}
		}
		break;
			
		case 'Senders':
		{
			$apiResult = str_replace('[pending]', '[pending]<br>', $apiResult);
			$apiResult = str_replace('[active]', '<br>[active]<br>', $apiResult);
			$apiResult = str_replace('[notActive]', '<br>[notActive]<br>', $apiResult);
			return $apiResult;
		}
		break;
		
		case 'Normal':
			if($apiResult{0} != '#')
				return $arrayMsgs[$apiResult];
			else
				return $apiResult;
		break;
	}		
}
//دالة الإرسال بإستخدام alfacell
function sendSMSalfacell($userAccount, $passAccount, $numbers, $sender, $msg, $MsgID, $timeSend=0, $dateSend=0, $deleteKey=0, $viewResult=1)
{
	global $arraySendMsg;
	$applicationType = "68";
	$sender = urlencode($sender);
	$domainName = $_SERVER['SERVER_NAME'];
    if(!empty($userAccount) && empty($passAccount)) {
        $contextPostValues = http_build_query(array('apiKey'=>$userAccount, 'numbers'=>$numbers, 'sender'=>$sender, 'msg'=>$msg, 'timeSend'=>$timeSend, 'dateSend'=>$dateSend, 'applicationType'=>$applicationType, 'domainName'=>$domainName, 'msgId'=>$MsgID, 'deleteKey'=>$deleteKey,'lang'=>'3'));
    } else {
        $contextPostValues = http_build_query(array('mobile'=>$userAccount, 'password'=>$passAccount, 'numbers'=>$numbers, 'sender'=>$sender, 'msg'=>$msg, 'timeSend'=>$timeSend, 'dateSend'=>$dateSend, 'applicationType'=>$applicationType, 'domainName'=>$domainName, 'msgId'=>$MsgID, 'deleteKey'=>$deleteKey,'lang'=>'3'));
    }
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/x-www-form-urlencoded', 'content'=> $contextPostValues, 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE );
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSend.php";
	$result = @file_get_contents($url, true, $contextResouce);
echo $result ;
	if($viewResult)
		$result = printStringResult(trim($result), $arraySendMsg);
	return $result;
}






$tok = $_GET['token'] ; 


$mobile = filter_var($_GET['mobile'],FILTER_SANITIZE_STRING);
$numbers = filter_var($_GET['numbers'],FILTER_SANITIZE_STRING);
$sender = filter_var($_GET['sender'] ,FILTER_SANITIZE_STRING);
$msg = filter_var($_GET['msg'] ,FILTER_SANITIZE_STRING);
if($tok!=$tokeng){echo "error invalid token"; die();}

    $sqlt = "SELECT * FROM `sender` WHERE `sendername`='$sender' limit 1";
    $resultt = $conn->query($sqlt);

	    if ($resultt->num_rows > 0) {

		   $rowt = $resultt->fetch_assoc() ;
		   
		   
			$UserName = $rowt['usersender'] ;
			$UserPassword = $rowt['userpass'] ;
			$getway = $rowt['getway'] ;
			$Originator = $rowt['sendername'] ;
			$Numbers = $numbers ;
			$Message = $msg ;

		   $MsgID = rand(1,99999);
		   
		            if($getway == "alfacell"){
		             echo sendSMSalfacell($UserName, $UserPassword, $Numbers, $Originator, $Message, $MsgID);
				   
			           }elseif($getway == "alfacell"){
						 
					   }else{
						     echo "Error getway 0";
						   echo $getway ;
					        }
			   
			}else{
				
				echo "error sender not found" ;
			}



								



//echo sendSMSyamamah($UserName, $UserPassword, $Numbers, $Originator, $Message, $MsgID);

//echo sendSMS($mobile, $password, $numbers, $sender, $msg, $MsgID, $timeSend, $dateSend, $deleteKey, $resultType);






?>