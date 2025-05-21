<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$edit=$_GET['edit'];$sp=intval($_GET['sp']);$rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$sp"));
$tph=@mysqli_query($con,"select * from phanhoisanpham where id=$edit");
$rph=@mysqli_fetch_assoc($tph);
if(isset($_POST['tao'])){
    
    $ten=addslashes($_POST['ten']);
    $sao=intval($_POST['sao']);
    $noidung=addslashes($_POST['noidung']);
    if($ten!=''){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $linkx='upload/sanpham/'.$rph['anh'];unlink($linkx);
        $tenanh=$_FILES['image']['name'];
        $size = getimagesize($_FILES['image']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=100;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        $file='upload/phanhoi/'.$tenanh;
        resize_nhieu($width_resize,$height_resize,'image',$file);
        }else{$tenanh=$rph['avatar'];}
        // xong ảnh 1
        if($_FILES['image1']['name'] and kiem_tra_anh($_FILES['image1']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh1'];unlink($linkx);
        $tenanh1=$_FILES['image1']['name'];
        $size = getimagesize($_FILES['image1']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh1 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh1);
        $tenanh1=time().$tenanh1;
        $file1='upload/phanhoi/'.$tenanh1;
        resize_nhieu($width_resize,$height_resize,'image1',$file1);
        }else{$tenanh1=$rph['anh1'];}
        
        if($_FILES['image2']['name'] and kiem_tra_anh($_FILES['image2']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh2'];unlink($linkx);
        $tenanh2=$_FILES['image2']['name'];
        $size = getimagesize($_FILES['image2']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh2 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh2);
        $tenanh2=time().$tenanh2;
        $file2='upload/phanhoi/'.$tenanh2;
        resize_nhieu($width_resize,$height_resize,'image2',$file2);
        }else{$tenanh2=$rph['anh2'];}
        // xong ảnh 2
        if($_FILES['image3']['name'] and kiem_tra_anh($_FILES['image3']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh3'];unlink($linkx);
        $tenanh3=$_FILES['image3']['name'];
        $size = getimagesize($_FILES['image3']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh3 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh3);
        $tenanh3=time().$tenanh3;
        $file3='upload/phanhoi/'.$tenanh3;
        resize_nhieu($width_resize,$height_resize,'image3',$file3);
        }else{$tenanh3=$rph['anh3'];}
        // xong ảnh 3
        if($_FILES['image4']['name'] and kiem_tra_anh($_FILES['image4']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh4'];unlink($linkx);
        $tenanh4=$_FILES['image4']['name'];
        $size = getimagesize($_FILES['image4']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh4 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh4);
        $tenanh4=time().$tenanh4;
        $file4='upload/phanhoi/'.$tenanh4;
        resize_nhieu($width_resize,$height_resize,'image4',$file4);
        }else{$tenanh4=$rph['anh4'];}
        // xong ảnh 4
        
        $thoigian=addslashes($_POST['thoigian']);
        
        $in="update phanhoisanpham set ten=N'$ten',sao=$sao,avatar='$tenanh',anh1='$tenanh1',anh2='$tenanh2',anh3='$tenanh3',anh4='$tenanh4',
        noidung=N'$noidung',thoigian=N'$thoigian' where id=$edit";
        $q=@mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-phanhoi.php?sp='.$sp.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, sửa  chưa thành công, vui lòng làm lại.</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Tên  không được để trống.</div>';}
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="sup-admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<script language="javascript" src="js/jquery.min.js"></script>
<style>
#right #form table th{width: 130px;}
#right #form table td textarea{width: 620px; height: 400px;}
</style>
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
        <div class="tit">Sửa phản hồi <a class="phai" href="ds-phanhoi.php?sp=<?php echo $sp?>">Trở lại danh sách</a></div>
        <p style="padding: 25px 0 41px; margin-bottom: 20px; border-bottom: 1px dotted #009525;">
        Sản phẩm: <b><?php echo $rsp['ten']?></b>
        </p>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php 
            echo $thongbao; 
            ?>
                <tr>
                    <th>Tên khách hàng:</th><td><input name="ten" value="<?php echo str_replace("\\","",$rph['ten']); ?>" /></td>
                </tr>
                
                
                <tr>
                    <th>Ảnh đại diện:</th><td><img src="upload/phanhoi/<?php echo $rph['avatar']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th>Ảnh 1:</th><td><img src="upload/phanhoi/<?php echo $rph['anh1']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image1" type="file" /></td>
                </tr>
                <tr>
                    <th>Ảnh 2:</th><td><img src="upload/phanhoi/<?php echo $rph['anh2']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image2" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Ảnh 3:</th><td><img src="upload/phanhoi/<?php echo $rph['anh3']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image3" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Ảnh 4:</th><td><img src="upload/phanhoi/<?php echo $rph['anh4']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image4" type="file" /></td>
                </tr>
                
                
                <tr>
                    <th>Sao:</th><td><input name="sao" type="number" value="<?php echo $rph['sao']; ?>" /></td>
                </tr>
                
                <tr>
                    <th>Nội dung:</th><td><textarea style="height: 50px; width: 280px;" name="noidung"><?php echo  str_replace("\\","",$rph['noidung']); ?></textarea></td>
                </tr>
                
                <tr>
                    <th>Thời gian:</th><td><input name="thoigian" value="<?php echo  $rph['thoigian']; ?>" /></td>
                </tr>
                
                <tr>
                    <th></th><td><input type="submit" name="tao" value="SỬA" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>