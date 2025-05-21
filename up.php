<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    require_once('include/session.php');
    $url=$_SERVER['HTTP_REFERER'];
	$up = $_GET['up'];
    $id=$_GET['id'];
    $loai=$_GET['loai'];
    $table=$_GET['table'];
	$sql = "update $table set $loai=$up where id =$id";
	$result = @mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có l?i, Thao tác chua thành công ';
?>