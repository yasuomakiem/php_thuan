<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
    require_once('include/session.php');
    
	if($_COOKIE['email']!=$r['email']){exit();}
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$idsp = $_GET['del'];
    //tim ảnh để xóa cả ảnh
    $t="select * from e23_sanpham where id =$idsp";$q=mysqli_query($con,$t);$r=mysqli_fetch_assoc($q);$link="upload/sanpham/".$r['anh'];
    unlink($link);
	$sql = "delete from e23_sanpham where id =$idsp";
	$result = mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
?>