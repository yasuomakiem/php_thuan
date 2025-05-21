<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    $tim="select * from dh_user where id=$iduser";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$idsp = $_GET['del'];
    //tim ?nh d? xóa c? ?nh
    $t="select * from dh_banner where id =$idsp";$q=mysqli_query($con,$t);$r=mysqli_fetch_assoc($q);$link="upload/banner/".$r['anh'];
    if($r['iduser']!=$_COOKIE['iduser']){exit();}
    unlink($link);
	$sql = "delete from dh_banner where id =$idsp";
	$result = mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có l?i, Thao tác chua thành công ';
?>