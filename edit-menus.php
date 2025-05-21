<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from e23_user where id=1";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);$quyen=$r['quyen'];
$cap=$_GET['cap'];
$id=$_GET['edit'];
$tmn="select * from e23_menus$cap where id=$id";$qmn=mysqli_query($con,$tmn);$rmn=mysqli_fetch_assoc($qmn);
if(isset($_POST['edit1'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['menu'];
    $thutu=$_POST['thutu'];
    $tukhoa=$_POST['tukhoa'];
    $des=$_POST['des'];
    $trangchu=$_POST['trangchu'];
    $sohang=$_POST['sohang'];
    $in1="update e23_menus1 set ten=N'$ten',thutu='$thutu',tukhoa=N'$tukhoa',des=N'$des',trangchu='$trangchu',sohang='$sohang' where id=$id";
    $qup=mysqli_query($con,$in1);
    if($qup){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="tao-menus.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
}
if(isset($_POST['edit2'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['menu'];
    $thutu=$_POST['thutu'];
    $tukhoa=$_POST['tukhoa'];
    $des=$_POST['des'];
    $in1="update e23_menus2 set ten=N'$ten',thutu='$thutu',tukhoa=N'$tukhoa',des=N'$des' where id=$id";
    $qup=mysqli_query($con,$in1);
    if($qup){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="tao-menus.php";
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
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>admin/main_admin.css" />
</head>
<body>
<?php require_once('admin/head.php'); ?>
    <div id="main">
    <?php require_once('admin/left.php'); ?>
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
                    <th>Thứ tự hiển thị:</th><td><input name="thutu" value="<?php echo $rmn['thutu']; ?>" /></td>
                </tr>
                <tr>
                    <th>Từ khóa:</th><td><input name="tukhoa" value="<?php echo $rmn['tukhoa']; ?>" /> <i>Meta Keywords - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th>Mô tả:</th><td><input name="des" value="<?php echo $rmn['des']; ?>" /> <i>Meta Description - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th></th><td><input name="trangchu" type="checkbox" value="1" <?php if($rmn['trangchu']==1){echo 'checked="checked"';} ?> style="width: auto; height: auto; padding: 0;" /> Hiển thị menu này ra trang chủ</td>
                </tr>
                <tr>
                    <th>Số hàng:</th><td>
                    <select name="sohang">
                        <option value="1" <?php if($rmn['sohang']==1){echo 'selected="selected"';} ?> >1 hàng (=2 sản phẩm)</option>
                        <option value="2" <?php if($rmn['sohang']==2){echo 'selected="selected"';} ?> >2 hàng (=4 sản phẩm)</option>
                        <option value="3" <?php if($rmn['sohang']==3){echo 'selected="selected"';} ?> >3 hàng (=6 sản phẩm)</option>
                        <option value="4" <?php if($rmn['sohang']==4){echo 'selected="selected"';} ?> >4 hàng (=8 sản phẩm)</option>
                        <option value="5" <?php if($rmn['sohang']==5){echo 'selected="selected"';} ?> >5 hàng (=10 sản phẩm)</option>
                        <option value="6" <?php if($rmn['sohang']==6){echo 'selected="selected"';} ?> >6 hàng (=12 sản phẩm)</option>
                        <option value="7" <?php if($rmn['sohang']==7){echo 'selected="selected"';} ?> >7 hàng (=14 sản phẩm)</option>
                        <option value="8" <?php if($rmn['sohang']==8){echo 'selected="selected"';} ?> >8 hàng (=16 sản phẩm)</option>
                        <option value="9" <?php if($rmn['sohang']==9){echo 'selected="selected"';} ?> >9 hàng (=18 sản phẩm)</option>
                        <option value="10" <?php if($rmn['sohang']==10){echo 'selected="selected"';} ?> >10 hàng (=20 sản phẩm)</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td>Số hàng áp dụng khi menu được hiển thị ra trang chủ</td>
                </tr>
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
                    <th>Thứ tự hiển thị:</th><td><input name="thutu" value="<?php echo $rmn['thutu']; ?>" /></td>
                </tr>
                <tr>
                    <th>Từ khóa:</th><td><input name="tukhoa" value="<?php echo $rmn['tukhoa']; ?>" /> <i>Meta Keywords - Thẻ seo</i></td>
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
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>