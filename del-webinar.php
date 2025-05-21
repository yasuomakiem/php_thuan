<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    require_once('include/session.php');
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$idsp = $_GET['del'];
    $sql1 = "delete from block where idcamp =$idsp";$result1 = mysqli_query($con,$sql1);
	$sql = "delete from camplive where id =$idsp";
	$result = mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
?>