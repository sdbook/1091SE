<?php
require_once("dbconnect.php");

function checkUserIDPwd($userName, $passWord) {
	global $conn;
$userName = mysqli_real_escape_string($conn,$userName);
$isValid = false;

$sql = "SELECT password FROM user WHERE loginID='$userName'";
if ($result = mysqli_query($conn,$sql)) {
	if ($row=mysqli_fetch_assoc($result)) {
		if ($row['password'] == $passWord) {
			//keep the user ID in session as a mark of login
			//$_SESSION['uID'] = $row['id'];
			//provide a link to the message list UI
			$isValid = true;
		}
	}
}
return $isValid;
}


function getUserPwd($userName) {
	$password="You guess!!";
	return $password;
}

function setUserPassword($userName){
		return false;
}

?>










