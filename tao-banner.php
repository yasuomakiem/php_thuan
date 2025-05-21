<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);
if(isset($_GET['edit'])){
    $edit=intval($_GET['edit']);
    $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_banner where id=$edit"));
    if(isset($_POST['sua'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['ten'];
    $vitri=$_POST['vitri'];
    $target=$_POST['target'];
    $a=$_POST['a'];
    if($vitri!=''){
        if($_FILES['image']['name']){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        $linkcu="upload/banner/".$rsp['anh'];
        unlink($linkcu);
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
        }else{$tenanh=$rsp['anh'];}
        // xong ảnh
        $in="update dh_banner set ten=N'$ten',vitri='$vitri',anh='$tenanh',a='$a',target='$target' where id=$edit";
        $q2=mysqli_query($con,$in);
        if($q2){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-banner.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo Banner thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, sửa banner chưa thành công, vui lòng làm lại.</div>';}
        
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
}
    
}
if(isset($_POST['tao'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['ten'];
    $vitri=$_POST['vitri'];
    $target=$_POST['target'];
    $a=$_POST['a'];
    if($vitri!=''){
        if($_FILES['image']['name']){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
        // xong ảnh
        $in="insert into dh_banner (ten,vitri,anh,a,target,time)value
        (N'$ten','$vitri','$tenanh','$a','$target',$time)";
        $q=mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-banner.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo Banner thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, tạo banner chưa thành công, vui lòng làm lại.</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Bạn chưa chọn ảnh, hoặc ảnh không đúng định dạng .jpg .png .gif .jpeg</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
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
<style>
#right #form table th{width: 120px;}
#right #form table td textarea{width: 620px; height: 400px;}
</style>
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <?if(isset($_GET['edit'])){?>
    <div id="right">
        <div class="tit">Sửa các banner(logo) cho web</div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên banner:</th><td><input name="ten" value="<?php echo $rsp['ten']; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Vị trí đặt:</th><td>
                    <select name="vitri">
                        <option <?if($rsp['vitri']==1){echo 'selected="selected"';}?> value="1">Logo (Rộng: 155px - Cao: 30px)</option>
                        <option <?if($rsp['vitri']==2){echo 'selected="selected"';}?> value="2">Banner slide (Rộng nhất: 1350px - Cao: 300px)</option>
                        <option <?if($rsp['vitri']==3){echo 'selected="selected"';}?> value="3">Banner dưới giới thiệu trang chủ (kích thước đồng nhất)</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>Ảnh hiện tại:</th><td><img src="upload/banner/<?=$rsp['anh']?>" style="max-width: 100%; max-height: 100px;" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Thay banner:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Liên kết tới:</th><td><input name="a" value="<?php echo $rsp['a']; ?>" /></td>
                </tr>
                
                <tr>
                    <th><span>*</span>Cách mở liên kết:</th><td>
                    <select name="target">
                        <option <?if($rsp['target']==''){echo 'selected="selected"';}?> value="">Mở trong tab hiện tại</option>
                        <option <?if($rsp['target']=='_blank'){echo 'selected="selected"';}?> value="_blank">Mở trong tab mới</option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="sua" value="UPDATE BANNER" /></td>
                </tr>
            </table>
            <p><b style="color: red;">Lưu ý: </b>Banner ở vị trí dưới phần giới thiệu trang chủ bạn phải đặt tên theo cấu trúc:
            Tên 1 *** Tên 2 *** Tên 3. Trong đó, tên 1 và tên 2 được hiển thị ngay khi load web, tên 1 là chữ nhạt, tên 2 là chữ đậm. Tên 3 được hiển thị khi rê chuột qua hiệu ứng
            </p>
        </form>
    </div>
    <?}else{?>
    <div id="right">
        <div class="tit">Tạo các banner(logo) cho web</div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên banner:</th><td><input name="ten" value="<?php echo $ten; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Vị trí đặt:</th><td>
                    <select name="vitri">
                        <option value="1">Logo (Rộng: 155px - Cao: 30px)</option>
                        <option value="2">Banner slide (Rộng: 1350px - Cao: 300px)</option>
                        <option value="3">Banner dưới phần giới thiệu trang chủ (Kích thước đồng nhất)</option>
                    </select>
                    </td>
                </tr>
                
                <tr>
                    <th><span>*</span>Chọn banner:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>- Kích thước của ảnh nên gần với kích thước tiêu chuẩn, ảnh sẽ không bị méo.</td>
                </tr>
                <tr>
                    <th>Liên kết tới:</th><td><input name="a" value="<?php echo $a; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td>- Mở trang bạn muốn liên kết tới, Copy đường link rồi dán vào đây.</td>
                </tr>
                <tr>
                    <th><span>*</span>Cách mở liên kết:</th><td>
                    <select name="target">
                        <option value="">Mở trong tab hiện tại</option>
                        <option value="_blank">Mở trong tab mới</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="tao" value="UPLOAD BANNER" /></td>
                </tr>
            </table>
        </form>
        <p><b style="color: red;">Lưu ý: </b>Banner ở vị trí dưới phần giới thiệu trang chủ bạn phải đặt tên theo cấu trúc:
            Tên 1 *** Tên 2 *** Tên 3. Trong đó, tên 1 và tên 2 được hiển thị ngay khi load web, tên 1 là chữ nhạt, tên 2 là chữ đậm. Tên 3 được hiển thị khi rê chuột qua hiệu ứng
            </p>
    </div>
    <?}?>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>