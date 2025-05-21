<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
$edit=$_GET['edit'];
$timbv="select * from dh_baiviet where id=$edit";$qbv=@mysqli_query($con,$timbv);$rbv=@mysqli_fetch_assoc($qbv);
if(isset($_POST['edit'])){
    
    $ten=$_POST['ten'];
    $trichdan=strip_tags($_POST['trichdan'],'');
    $khongdau=chuyen_khong_dau_gach_ngang($_POST['khongdau']);
    $noidung=addslashes($_POST['noidung']);
    
    $muc2=$_POST['muc2'];
    if($ten!='' and $noidung!=''){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        $linkcu="upload/baiviet/".$rbv['anh'];
        unlink($linkcu);
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/baiviet/".$tenanh);
        }else{$tenanh=$rbv['anh'];}
        // xong ảnh
        
        $in="update dh_baiviet set ten=N'$ten',khongdau='$khongdau',anh='$tenanh',trichdan=N'$trichdan',noidung=N'$noidung',muc2=$muc2 where id=$edit";
        
        $q=@mysqli_query($con,$in);
        if($q){
            
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-baiviet.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Sửa baiviet thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, Sửa viết chưa thành công, vui lòng làm lại.</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<style>
#right #form table th{width: 120px;}
#right #form table td textarea{width: 620px; height: 400px;}
</style>
</head>
<body>
<?php require_once('admin/head.php'); ?> 
    <div id="main">
    <?php require_once('admin/left.php'); ?>
    <div id="right">
        <div class="tit">Sửa bài viết</div>
        <div class="nhacnho">
        </div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th>Tên bài viết:</th><td><input name="ten" value="<?php echo $rbv['ten']; ?>" /></td>
                </tr>
                <?if(!isset($_GET['kh'])){?>
                <tr>
                    <th>URL:</th><td><input name="khongdau" value="<?php echo $rbv['khongdau']; ?>" /></td>
                </tr>
                <tr>
                    <th>Mục đăng:</th><td>
                        <?php 
                        $m1=$rbv['muc'];
                        $tg1=mysqli_query($con,"select * from dh_menu1 where id=$m1");$tr1=mysqli_fetch_assoc($tg1);echo $tr1['ten'];
                    ?>
                    </td>
                </tr>
                <tr>
                    <th>Mục đăng:</th><td>
                    
                    <select name="muc2">
                    <option value="0">Chọn mục...</option>
                        <?php 
                        $m2=$rbv['muc2'];
                        $tg2=mysqli_query($con,"select * from dh_menu2 where menu1=$m1");while($tr2=mysqli_fetch_assoc($tg2)){
                    ?>
                        <option value="<?=$tr2['id']?>" <?if($tr2['id']==$rbv['muc2']){echo 'selected="selected"';}?>><?=$tr2['ten']?></option>
                    <?}?>
                    </select>
                    </td>
                </tr>
                <?}?>
                <tr>
                    <th>Ảnh đại diện:</th><td><img src="upload/baiviet/<?php echo $rbv['anh']; ?>" width="150px" /></td>
                </tr>
                <tr>
                    <th>Thay ảnh khác:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>- Ảnh phải có kích thước và dung lượng vừa phải. Nếu ảnh chụp từ máy ảnh, di động, thì phải xử lý trước khi đăng bằng các phẩn mền chỉnh sửa anh. Nếu không website của bạn sẽ rất nặng, chóng hết dung lượng, khi truy cập tải sẽ rất lâu.</td>
                </tr>
                <tr>
                    <th><?if(isset($_GET['kh'])){echo 'Địa chỉ:';}else{?>Trích dẫn:<?}?></th><td><textarea style="height: 60px;" name="trichdan"><?php echo $rbv['trichdan']; ?> </textarea></td>
                </tr>
                
                <tr>
                    <th>Nội dung:</th><td><textarea id="thongtin" name="noidung"><?php echo str_replace("\\","",$rbv['noidung']); ?> </textarea></td>
                </tr>
                <script type="text/javascript">
                    CKEDITOR.replace( 'thongtin',
                    {
                    //toolbar: 'Full',
                    filebrowserBrowseUrl : 'ckfinder/ckfinder.htm',
                    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.htm?Type=Images',
                    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.htm?Type=Flash',
                    filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                    });
                </script>
                
                <tr>
                    <th></th><td><input type="submit" name="edit" value="SỬA BÀI VIẾT" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>