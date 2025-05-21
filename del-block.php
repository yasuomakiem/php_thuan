<?php
	session_start();
	ob_start();
    require_once('include/connect.php');
	if(!isset($_COOKIE['iduser'])){exit();}
    $url=$_SERVER['HTTP_REFERER'];
	$id = intval($_GET['id']);
    $tim="select * from block where id=$id";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
    if($r['idu']==$_COOKIE['iduser']){
    if($r['block']<=2){//là comment thi phai xoa coment
        $xoacomment=@mysqli_query($con,"delete from comment where idblock =$id");
    }
	$result = @mysqli_query($con,"delete from block where id =$id");
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chua thành công ';
  }else{
    exit();
  }
?>