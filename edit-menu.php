<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=$iduser";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);$quyen=$r['quyen'];
$cap=$_GET['cap'];
$id=$_GET['edit'];
$tmn="select * from dh_menu$cap where id=$id";$qmn=mysqli_query($con,$tmn);$rmn=mysqli_fetch_assoc($qmn);
if(isset($_POST['edit1'])){
    if($_COOKIE['iduser']==$rmn['iduser']){
    $ten=$_POST['menu'];$tene='';//$_POST['menue'];
    $thutu=$_POST['thutu'];
    $tukhoa=$_POST['tukhoa'];
    $tit=$_POST['tit'];$tite='';//$_POST['tite'];
    $des=$_POST['des'];
    $loai=$_POST['loai'];
    $trangchu=$_POST['trangchu'];
    $khongdau=chuyen_khong_dau_gach_ngang($_POST['khongdau']);
    if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/menu/".$tenanh);
    }else{$tenanh=$rmn['anh'];}
    $slogan=addslashes($_POST['slogan']);$slogane=addslashes($_POST['slogane']);
    $in1="update dh_menu1 set ten=N'$ten',khongdau='$khongdau',thutu='$thutu',tit=N'$tit',des=N'$des',anh='$tenanh',slogan=N'$slogan' where id=$id";
    $qup=mysqli_query($con,$in1);
    if($qup){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="tao-menu.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>".$in1;}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu nội dung này. Thao tác này không được chấp nhận!</td></tr>";}
}
if(isset($_POST['edit2'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['menu'];$tene='';//$_POST['menue'];
    $thutu=$_POST['thutu'];
    $slogan=addslashes($_POST['slogan']);$slogane='';//addslashes($_POST['slogane']);
    $khongdau=chuyen_khong_dau_gach_ngang($_POST['khongdau']);
    $tukhoa=$_POST['tukhoa'];
    $des=$_POST['des'];
    $tit=$_POST['tit'];$tite='';//$_POST['tite'];
    $loai=$_POST['loai'];
    if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/menu/".$tenanh);
    }else{$tenanh=$rmn['anh'];}
    $trangchu=$_POST['trangchu'];
    $in1="update dh_menu2 set ten=N'$ten',khongdau='$khongdau',thutu='$thutu',tit=N'$tit',anh='$tenanh',des=N'$des',slogan=N'$slogan' where id=$id";
    $qup=mysqli_query($con,$in1);
    if($qup){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="tao-menu.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content=" thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>sup-admin/main_admin.css" />
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
        <div class="tit">Sửa menu website</div>
        <div class="nhacnho">
        <p>        </p>
        </div>
        <?php if($cap==1){ ?>
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th>Sửa tên:</th><td><input name="menu" value="<?php echo $rmn['ten']; ?>"  /></td>
                </tr>
                <tr>
                    <th>Sửa URL:</th><td><input name="khongdau" value="<?php echo $rmn['khongdau']; ?>"  /></td>
                </tr>
                <tr>
                    <th></th><td>URL không được bỏ trống, viết kiểu khong-dau-gach-ngang</td>
                </tr>
                <tr>
                    <th>Thứ tự hiển thị:</th><td><input name="thutu" value="<?php echo $rmn['thutu']; ?>" /></td>
                </tr>
                <?if($rmn['loai']!=1){?>
                <tr>
                    <th>Ảnh hiện tại:</th><td><?if($rmn['anh']==''){echo 'Chưa có ảnh';}else{?><img src="upload/menu/<?=$rmn['anh']?>" height="80" /><?}?></td>
                </tr>
                <tr>
                    <th>Thay ảnh khác:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th>Slogan:</th><td><input name="slogan" value="<?php echo $rmn['slogan']; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td>Có thể tạo điểm nhấn cho slogan bằng cách thêm dấu * ở chữ bắt đầu và ** ở chữ kết thúc:<br />
                    VD: Chúng tôi nâng tầm *thương hiệu** cho bạn<br />
                    Kết quả hiển thị: Chúng tôi nâng tầm <b style="color: #D6A603;">thương hiệu</b> cho bạn
                    </td>
                </tr>
                <?}?>
                <tr>
                    <th>Tiêu đề:</th><td><input name="tit" value="<?php echo $rmn['tit']; ?>" /></td>
                </tr>
                <tr>
                    <th>Mô tả:</th><td><input name="des" value="<?php echo $rmn['des']; ?>" /> <i>Meta Description - Thẻ seo</i></td>
                </tr>
                
                <tr>
                    <th><span>*</span>Loại menu:</th><td>
                    <select name="loai">
                        <option <?if($rmn['loai']==2){echo 'selected="selected"';}?> value="2">Menu bài viết</option>
                        <option <?if($rmn['loai']==1){echo 'selected="selected"';}?> value="3">Menu sản phẩm</option>
                    </select>
                    </td>
                </tr>
                <!--tr>
                    <th></th><td><input type="hidden" value="0" name="trangchu" />
                    <input style="height: auto; width: auto; float: left; margin-right: 10px;" <?if($rmn['trangchu']==1){echo 'checked="checked"';}?> type="checkbox" value="1" name="trangchu" />
                    Hiển thị các menu thành các tab nội dung ở trang chủ (Theo menu cấp 1)
                    </td>
                </tr-->
                <tr>
                    <th></th><td><input type="submit" name="edit1" value="SỬA MENU" /></td>
                </tr>
            </table>
        </form>
        <?php }else{ ?>
        <form id="form" action="" method="post">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th>Sửa tên:</th><td><input name="menu" value="<?php echo $rmn['ten']; ?>"  /></td>
                </tr>
                <tr>
                    <th>Sửa URL:</th><td><input name="khongdau" value="<?php echo $rmn['khongdau']; ?>"  /></td>
                </tr>
                <tr>
                    <th></th><td>URL không được bỏ trống, viết kiểu khong-dau-gach-ngang</td>
                </tr>
                <tr>
                    <th>Ảnh hiện tại:</th><td><?if($rmn['anh']==''){echo 'Chưa có ảnh';}else{?><img src="upload/menu/<?=$rmn['anh']?>" height="80" /><?}?></td>
                </tr>
                <tr>
                    <th>Thay ảnh khác:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th>Thứ tự hiển thị:</th><td><input type="number" name="thutu" value="<?php echo $rmn['thutu']; ?>" /></td>
                </tr>
                <tr>
                    <th>Slogan:</th><td><input name="slogan" value="<?php echo $rmn['slogan']; ?>" /></td>
                </tr>
                <tr>
                    <th>Tiêu đề:</th><td><input name="tit" value="<?php echo $rmn['tit']; ?>" /></td>
                </tr>
                <tr>
                    <th>Mô tả:</th><td><input name="des" value="<?php echo $rmn['des']; ?>" /> <i>Meta Description - Thẻ seo</i></td>
                </tr>
                
                <tr>
                    <th></th><td><input type="submit" name="edit2" value="SỬA MENU" /></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>