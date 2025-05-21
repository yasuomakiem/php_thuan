<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    require_once('include/session.php');
    $tim="select * from dh_user where id=1";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);
	if($_COOKIE['email']!=$r['email']){exit();}
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$up = $_GET['up'];
    $id=$_GET['id'];
    $loai=$_GET['loai'];
	$sql = "update dh_baiviet set $loai=$up where id =$id";
	$result = mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có l?i, Thao tác chua thành công ';
?>