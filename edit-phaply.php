<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$sp=intval($_GET['sp']);$rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$sp"));
if(!isset($_GET['edit'])){
    $in="insert into phaplysanpham (idsp)value($sp)";
        $q=@mysqli_query($con,$in);
        $timlaii=@mysqli_fetch_assoc(@mysqli_query($con,"select id from phaplysanpham where idsp=$sp"));
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="edit-phaply.php?edit='.$timlaii['id'].'&sp='.$sp.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
}
$edit=$_GET['edit'];
$tph=@mysqli_query($con,"select * from phaplysanpham where id=$edit");
$rph=@mysqli_fetch_assoc($tph);
if(isset($_POST['tao'])){
    
    $ten=addslashes($_POST['ten']);
    $noidung=addslashes($_POST['noidung']);
    if($ten!=''){
        
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
        if($_FILES['image5']['name'] and kiem_tra_anh($_FILES['image5']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh5'];unlink($linkx);
        $tenanh5=$_FILES['image5']['name'];
        $size = getimagesize($_FILES['image5']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh5 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh5);
        $tenanh5=time().$tenanh5;
        $file5='upload/phanhoi/'.$tenanh5;
        resize_nhieu($width_resize,$height_resize,'image5',$file5);
        }else{$tenanh5=$rph['anh5'];}
        // xong ảnh 5
        if($_FILES['image6']['name'] and kiem_tra_anh($_FILES['image6']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh6'];unlink($linkx);
        $tenanh6=$_FILES['image6']['name'];
        $size = getimagesize($_FILES['image6']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh6 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh6);
        $tenanh6=time().$tenanh6;
        $file6='upload/phanhoi/'.$tenanh6;
        resize_nhieu($width_resize,$height_resize,'image6',$file6);
        }else{$tenanh6=$rph['anh6'];}
        // xong ảnh 6
        if($_FILES['image7']['name'] and kiem_tra_anh($_FILES['image7']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh7'];unlink($linkx);
        $tenanh7=$_FILES['image7']['name'];
        $size = getimagesize($_FILES['image7']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh7 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh7);
        $tenanh7=time().$tenanh7;
        $file7='upload/phanhoi/'.$tenanh7;
        resize_nhieu($width_resize,$height_resize,'image7',$file7);
        }else{$tenanh7=$rph['anh7'];}
        // xong ảnh 7
        if($_FILES['image8']['name'] and kiem_tra_anh($_FILES['image8']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh8'];unlink($linkx);
        $tenanh8=$_FILES['image8']['name'];
        $size = getimagesize($_FILES['image8']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh8 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh8);
        $tenanh8=time().$tenanh8;
        $file8='upload/phanhoi/'.$tenanh8;
        resize_nhieu($width_resize,$height_resize,'image8',$file8);
        }else{$tenanh8=$rph['anh8'];}
        // xong ảnh 8
        if($_FILES['image9']['name'] and kiem_tra_anh($_FILES['image9']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh9'];unlink($linkx);
        $tenanh9=$_FILES['image9']['name'];
        $size = getimagesize($_FILES['image9']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh9 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh9);
        $tenanh9=time().$tenanh9;
        $file9='upload/phanhoi/'.$tenanh9;
        resize_nhieu($width_resize,$height_resize,'image9',$file9);
        }else{$tenanh9=$rph['anh9'];}
        // xong ảnh 9
        if($_FILES['image10']['name'] and kiem_tra_anh($_FILES['image10']['name'])==1){
              $linkx='upload/phanhoi/'.$rph['anh10'];unlink($linkx);
        $tenanh10=$_FILES['image10']['name'];
        $size = getimagesize($_FILES['image10']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=500;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh10 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh10);
        $tenanh10=time().$tenanh10;
        $file10='upload/phanhoi/'.$tenanh10;
        resize_nhieu($width_resize,$height_resize,'image10',$file10);
        }else{$tenanh10=$rph['anh10'];}
        // xong ảnh 10
        
        $in="update phaplysanpham set ten=N'$ten',noidung=N'$noidung',anh1='$tenanh1',anh2='$tenanh2',anh3='$tenanh3',
        anh4='$tenanh4',anh5='$tenanh5',anh6='$tenanh6',anh7='$tenanh7',anh8='$tenanh8',anh9='$tenanh9',anh10='$tenanh10'
         where id=$edit";
        $q=@mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-sanpham.php";
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
        <div class="tit">Cập nhật pháp lý sản phẩm <a class="phai" href="ds-sanpham.php">Danh sách sản phẩm</a></div>
        <p style="padding: 25px 0 41px; margin-bottom: 20px; border-bottom: 1px dotted #009525;">
        Sản phẩm: <b><?php echo $rsp['ten']?></b>
        </p>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php 
            echo $thongbao; 
            ?>
                <tr>
                    <th>Tên pháp lý:</th><td><input name="ten" value="<?php echo str_replace("\\","",$rph['ten']); ?>" /></td>
                </tr>
                <tr>
                    <th></th><td>Nếu "Tên pháp lý" để trống nó sẽ không hiển thị phần pháp lý ra ngoài</td>
                </tr>
                <tr>
                    <th>Nội dung:</th><td><textarea style="height: 40px; width: 280px;" name="noidung"><?php echo  str_replace("\\","",$rph['noidung']); ?></textarea></td>
                </tr>
                <?php if($rph['anh1']!=''){?>
                <tr>
                    <th>Ảnh 1:</th><td><img src="upload/phanhoi/<?php echo $rph['anh1']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 1:</th><td><input style="padding: 0; width: 300px;" name="image1" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 1:</th><td><input style="padding: 0; width: 300px;" name="image1" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh2']!=''){?>
                <tr>
                    <th>Ảnh 2:</th><td><img src="upload/phanhoi/<?php echo $rph['anh2']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 2:</th><td><input style="padding: 0; width: 300px;" name="image2" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 2:</th><td><input style="padding: 0; width: 300px;" name="image2" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh3']!=''){?>
                <tr>
                    <th>Ảnh 3:</th><td><img src="upload/phanhoi/<?php echo $rph['anh3']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 3:</th><td><input style="padding: 0; width: 300px;" name="image3" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 3:</th><td><input style="padding: 0; width: 300px;" name="image3" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh4']!=''){?>
                <tr>
                    <th>Ảnh 4:</th><td><img src="upload/phanhoi/<?php echo $rph['anh4']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 4:</th><td><input style="padding: 0; width: 300px;" name="image4" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 4:</th><td><input style="padding: 0; width: 300px;" name="image4" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh5']!=''){?>
                <tr>
                    <th>Ảnh 5:</th><td><img src="upload/phanhoi/<?php echo $rph['anh5']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 5:</th><td><input style="padding: 0; width: 300px;" name="image5" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 5:</th><td><input style="padding: 0; width: 300px;" name="image5" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh6']!=''){?>
                <tr>
                    <th>Ảnh 6:</th><td><img src="upload/phanhoi/<?php echo $rph['anh6']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 6:</th><td><input style="padding: 0; width: 300px;" name="image6" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 6:</th><td><input style="padding: 0; width: 300px;" name="image6" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh7']!=''){?>
                <tr>
                    <th>Ảnh 7:</th><td><img src="upload/phanhoi/<?php echo $rph['anh7']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 7:</th><td><input style="padding: 0; width: 300px;" name="image7" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 7:</th><td><input style="padding: 0; width: 300px;" name="image7" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh8']!=''){?>
                <tr>
                    <th>Ảnh 8:</th><td><img src="upload/phanhoi/<?php echo $rph['anh8']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 8:</th><td><input style="padding: 0; width: 300px;" name="image8" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 8:</th><td><input style="padding: 0; width: 300px;" name="image8" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh9']!=''){?>
                <tr>
                    <th>Ảnh 9:</th><td><img src="upload/phanhoi/<?php echo $rph['anh9']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 9:</th><td><input style="padding: 0; width: 300px;" name="image9" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 9:</th><td><input style="padding: 0; width: 300px;" name="image9" type="file" /></td>
                </tr>    
                <?php }?>
                <?php if($rph['anh10']!=''){?>
                <tr>
                    <th>Ảnh 10:</th><td><img src="upload/phanhoi/<?php echo $rph['anh10']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh 10:</th><td><input style="padding: 0; width: 300px;" name="image10" type="file" /></td>
                </tr>
                <?php }else{?>
                <tr>
                    <th>Ảnh 10:</th><td><input style="padding: 0; width: 300px;" name="image10" type="file" /></td>
                </tr>    
                <?php }?>
                <tr>
                    <th></th><td><input type="submit" name="tao" value="CẬP NHẬT" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>