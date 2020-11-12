<?php
require("todoModel.php");

$title=mysqli_real_escape_string($conn,$_POST['title']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$id=(int)$_POST['id'];
$urgent=mysqli_real_escape_string($conn,$_POST['urgent']);

if ($title) { //if title is not empty
	updateJob($id,$title,$msg, $urgent);
	$msg="Message updateded";
} else {
	$msg= "Message title cannot be empty";
}
header("Location: todoListView.php?m=$msg");
?>