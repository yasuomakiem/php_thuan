<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    require_once('include/session.php');
    $tim="select * from dh_user where id=1";$q=mysql_query($tim);$r=mysql_fetch_assoc($q);
	if($_COOKIE['email']!=$r['email']){exit();}
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$idsp = $_GET['del'];
	$sql = "delete from dh_hotro where id =$idsp";
	$result = mysql_query($sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chua thành công ';
?>