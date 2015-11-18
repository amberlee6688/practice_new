<?php
session_start();
/* -------------------------- */
/* Check username & password  */
/* -------------------------- */
include('db_conn.php');
$userid = isset($_POST["account"]) ? $_POST["account"] : ""; 
$password = isset($_POST["password"]) ? $_POST["password"] : ""; 
$sql = "SELECT * FROM member WHERE acc = '$userid' AND pasd = '$password'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$record_count = mysql_num_rows($result); 
if($record_count<1){
//無資料回傳no data
	echo 'no data';
}else{
//若有這筆資料則回傳success
	$_SESSION['user_name'] = $userid;
	echo 'success';
	//echo $row['first_name'].$row['last_name'];    for debug use
} 
?>