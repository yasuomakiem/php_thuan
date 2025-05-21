<?php
    require_once('include/connect.php');
    $url=$_SERVER['HTTP_REFERER'];
    //$new_url = str_replace("&popup=1", "", $url);
	$idsp = $_GET['del'];
    $table=$_GET['table'];
    $tim=@mysqli_query($con,"select id from $table where id=$idsp");
    if(@mysqli_num_rows($tim)>0){
    //tim ảnh để xóa cả ảnh
    if(isset($_GET['img'])){
        $link=str_replace("*","/",$_GET['img']);
        echo $link;
        unlink($domain.''.$link);
    }
    if(isset($_GET['img0'])){
        $link0=str_replace("*","/",$_GET['img0']);
        unlink($link0);
    }
    if(isset($_GET['img1'])){
        $link1=str_replace("*","/",$_GET['img1']);
        unlink($link1);
    }
    if(isset($_GET['img2'])){
        $link2=str_replace("*","/",$_GET['img2']);
        unlink($link2);
    }
    if(isset($_GET['img3'])){
        $link3=str_replace("*","/",$_GET['img3']);
        unlink($link3);
    }
    if(isset($_GET['img4'])){
        $link4=str_replace("*","/",$_GET['img4']);
        unlink($link4);
    }
    if(isset($_GET['img5'])){
        $link5=str_replace("*","/",$_GET['img5']);
        unlink($link5);
    }
    if(isset($_GET['img6'])){
        $link6=str_replace("*","/",$_GET['img6']);
        unlink($link6);
    }
    if(isset($_GET['img7'])){
        $link7=str_replace("*","/",$_GET['img7']);
        unlink($link7);
    }
    if(isset($_GET['img8'])){
        $link8=str_replace("*","/",$_GET['img8']);
        unlink($link8);
    }
    if(isset($_GET['img9'])){
        $link9=str_replace("*","/",$_GET['img9']);
        unlink($link9);
    }
	$sql = "delete from $table where id =$idsp";
	$result = @mysqli_query($con,$sql);
	if($result){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Co loi, thao tac chua thanh cong';
  }else{
    exit();
  }
?>