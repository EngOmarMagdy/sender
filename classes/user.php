<?php
	 function isValidUsername($username){
		if (strlen($username) < 3) return false;
		if (strlen($username) > 12) return false;
		if (!ctype_alnum($username)) return false;
		return true;
	}


   function logout(){
		session_destroy();
	}

	 function is_logged_in(){
		if(isset($_SESSION['loggedint']) && $_SESSION['loggedint'] == true){
			return true;
		}
	}
	

	 function is_admin(){
		if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == "admin"){
			return true;
		}
	}
	
    function is_super(){
		if(isset($_SESSION['super']) && $_SESSION['super'] == "superadmin"){
			return true;
		}
	}
 function xss_clean($data)
{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
}


 function is_tr(){
	 /*
  $time = time() ;
  $extime = strtotime("14-01-2099") ;

if($extime <= $time){

	
	exit() ;

}  */
 }



 function get_username_by_id($userid) {
     global $conn ;

     $sqls1 = "SELECT `uname` FROM `users` where id='$userid'" ;
     $result = $conn->query($sqls1);
     $rowtt = $result->fetch_assoc() ;
     $rowname = $rowtt['uname'] ;

     return $rowname ;



 }

 function get_email_by_id($userid) {
     global $conn ;

     $sqls1 = "SELECT `useremail` FROM `users` where id='$userid'" ;
     $result = $conn->query($sqls1);
     $rowtt = $result->fetch_assoc() ;
     $rowname = $rowtt['useremail'] ;

     return $rowname ;



 }

 function get_phone_by_id($userid) {
     global $conn ;

     $sqls1 = "SELECT `userphone` FROM `users` where id='$userid'" ;
     $result = $conn->query($sqls1);
     $rowtt = $result->fetch_assoc() ;
     $rownamep = $rowtt['userphone'] ;

     return $rownamep ;



 }

function staticsf($t){
    global $conn ;
    $sqls1 = "SELECT `fileid` FROM `storefiles`" ;
    $result = $conn->query($sqls1);
    $num = $result->num_rows ;

    echo $num ;





}

function staticsfsader($t){
    global $conn ;
    $sqls1 = "SELECT `id` FROM `sender`" ;
    $result = $conn->query($sqls1);
    $num = $result->num_rows ;

    echo $num ;





}



?>
