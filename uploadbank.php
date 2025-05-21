<?php
require_once('include/connect.php');
require_once('include/function.php');
if (isset($_POST) && !empty($_FILES['file'])) {
    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    // Kiểm tra xem có phải file ảnh không
    if ($duoi === 'jpg' || $duoi === 'jpeg' || $duoi === 'png' || $duoi === 'gif') {
        // tiến hành upload
        $anhthem1=$_FILES['file']['name'];
                    $size = getimagesize($_FILES['file']['tmp_name']);
                    $rog=$size[0];$ca=$size[1];
                    $width_resize=300;
                    $height_resize=round($width_resize*$ca/$rog); 
                    $anhthem1 = preg_replace('/[^a-zA-Z0-9.]/','-',$anhthem1);
                    $file1='upload/uploadbank/'.$anhthem1;
                    resize_nhieu($width_resize,$height_resize,'file',$file1); 
        $don=@mysqli_query($con,"select * from dh_donhang where iduser=$u[id] and trangthai=0 order by time desc limit 1");
        $rd=@mysqli_fetch_assoc($don);
        $up=@mysqli_query($con,"update dh_donhang set bank=N'$anhthem1' where id=$rd[id]");
    
    } else { // nếu không phải file ảnh
        die('Chỉ được upload ảnh'); // in ra thông báo
    }
} else {
    die('Lock'); // nếu không phải post method
}
?>