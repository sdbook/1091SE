<?php
require_once("dbconnect.php");

function addJob($title,$msg, $urgent) {
	global $conn;
	$sql = "insert into todo (title, content,urgent, addTime) values ('$title','$msg', '$urgent', NOW());";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL	
}

function cancelJob($jobID) {
	global $conn;
	$sql = "update todo set status = 3 where id=$jobID and status <> 2;";
	mysqli_query($conn,$sql);
	//return T/F
}

function updateJob($id,$title,$msg, $urgent) {
	global $conn;
	$sql = "update todo set title='$title', content='$msg', urgent='$urgent' where id=$id;";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
}

function getJobList($bossMode) {
	global $conn;
	if ($bossMode) {
		$sql = "select *, TIME_TO_SEC(TIMEDIFF(NOW(), addTime)) diff from todo order by status, urgent desc;";
	} else {
		$sql = "select *, TIME_TO_SEC(TIMEDIFF(NOW(), addTime)) diff from todo where status = 0;";
	}
	$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
	return $result;
}

function setFinished($jobID) {
	global $conn;
	$sql = "update todo set status = 1, finishTime=NOW() where id=$jobID and status = 0;";
	mysqli_query($conn,$sql) or die("MySQL query error"); //執行SQL
	
}

function rejectJob($jobID){
	global $conn;
	$sql = "update todo set status = 0 where id=$jobID and status = 1;";
	mysqli_query($conn,$sql);
}

function setClosed($jobID) {
	global $conn;
	$sql = "update todo set status = 2 where id=$jobID and status = 1;";
	mysqli_query($conn,$sql);
}

function getJobDetail($id) {
	global $conn;
	$sql = "select id, title, content, urgent from todo where id=$id;";
	$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
	$rs=mysqli_fetch_assoc($result);
	return $rs;
}
?>