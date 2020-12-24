<?php
require("dbconnect.php");

$msgID=(int)$_POST['id'];
$act =$_POST['act'];

$msg = "Message:$msgID, Action: $act completed.";
if ($msgID>0) {
	switch($act) {
		case 'finish':
			$sql = "update todo set status = 1, finishTime=NOW() where id=$msgID and status = 0;";
			break;
		case 'reject':
			$sql = "update todo set status = 0 where id=$msgID and status = 1;";
			break;
		case 'close':
			$sql = "update todo set status = 2 where id=$msgID and status = 1;";
			break;
		case 'cancel':
			$sql = "update todo set status = 3 where id=$msgID and status <> 2;";
			break;
		default:
			$msg="Invalid action. Ignored.";
			break;
	}
	if ($sql > ''){
		mysqli_query($conn,$sql) or die("MySQL query error"); //執行SQL
	}
}
//header("Location: todoList.php?m=$msg");
?>

