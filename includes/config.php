<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');


$servername = "localhost";
$username = "kingsms_sender";
$password = " ";
$dbname = "kingsms_sender";

// Create connection
$conn =  connection_mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//application address
define('DIR','http://localhost/');
define('SITEEMAIL','noreply@domain.com');


//include the user class, pass in the database connection
include('classes/user.php');

$tokeng = md5($dbname) ;

?>
