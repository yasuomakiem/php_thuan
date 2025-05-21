<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);$quyen=$r['quyen'];
if(isset($_POST['tao'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['ten'];
    $link=$_POST['link'];
    $in2="insert into dh_link (ten,link,time)value(N'$ten',N'$link',$time)";
    $qup=mysqli_query($con,$in2);
    if($qup){
        $ten='';$link='';
        $thongbao="<tr><th></th><td style='color:blue'>Tạo liên kết thành công!</td></tr>";
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
<title>Tạo liên kết - Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>admin/main_admin.css" />
</head>
<body>
<?php require_once('admin/head.php'); ?>
    <div id="main">
    <?php require_once('admin/left.php'); ?>
    <div id="right">
        <div class="tit">Tạo liên kết ở vị trí "<?=$r['t15']?>"</div>
        <div class="nhacnho">
        </div>
        <form id="form" action="" method="post">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên liên kết:</th><td><input name="ten" type="text" value="<?php echo $ten; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Trang đích:</th><td><input name="link" type="text" value="<?php echo $link; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="tao" value="TẠO LIÊN KẾT" /></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="right">
        <div class="tit">Danh sách liên kết đã tạo</div>
        <div class="danhsach">
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th>Tên liên kết</th><th>Link tới</th><th>Quyền hạn</th>
                </tr>
                <?php 
                $timmn1="select * from dh_link order by time asc";$qmenu1=mysqli_query($con,$timmn1);
                while($rmns=mysqli_fetch_assoc($qmenu1)){ 
                if($_COOKIE['quyen']==1){$xoa="del-link.php?del=$rmns[id]";}else{$xoa="#";}
                    ?>
                <tr>
                    <td><?php echo $rmns['ten']; ?></td>
                    <td style="background: #F3F3F3;"><?php echo $rmns['link']; ?></td>
                    <td style="background: #F3F3F3;"><a class="xoa" href="<?php echo $xoa; ?>">Xóa</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>