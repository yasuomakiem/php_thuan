<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from e23_user where id=1";$q=mysqli_query($con,$tim);$r=mysqli_fetch_assoc($q);$quyen=$r['quyen'];
if(isset($_POST['cap1'])){
    if($_COOKIE['quyen']==1){
        $tsl="select id from e23_menus1";$qtjt=mysqli_query($con,$tsl);
    $ten=$_POST['menu1'];
    $thutu=$_POST['thutu'];
    $tukhoa=$_POST['tukhoa'];
    $des=$_POST['des'];
    $trangchu=$_POST['trangchu'];
    $sohang=$_POST['sohang'];
    $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr($time,1,2);
    $in1="insert into e23_menus1 (ten,khongdau,thutu,tukhoa,des,trangchu,sohang)value(N'$ten','$khongdau',$thutu,N'$tukhoa',N'$des','$trangchu','$sohang')";
    $qup=mysqli_query($con,$in1);
    if($qup){
        $thongbao="<tr><th></th><td style='color:blue'>Tạo menu cấp 1 thành công!</td></tr>";
        $ten='';$tukhoa='';$thutu='';$des='';
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
}
if(isset($_POST['cap2'])){
    if($_COOKIE['quyen']==1){
    $ten=$_POST['menu2'];
    $menu1=$_POST['menu1'];
    $thutu2=$_POST['thutu2'];
    $tukhoa2=$_POST['tukhoa2'];
    $des2=$_POST['des2'];
    $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr($time,1,2);
    $in2="insert into e23_menus2 (ten,khongdau,menu1,thutu,tukhoa,des)value(N'$ten','$khongdau','$menu1',$thutu2,N'$tukhoa2',N'$des2')";
    $qup=mysqli_query($con,$in2);
    if($qup){
        $ten='';$thutu2='';$tukhoa2='';$des2='';
        $thongbao2="<tr><th></th><td style='color:blue'>Tạo menu cấp 2 thành công!</td></tr>";
    }else{$thongbao2="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao2="<tr><th></th><td style='color:red'>Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</td></tr>";}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Tạo menu sản phẩm - Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>admin/main_admin.css" />
</head>
<body>
<?php require_once('admin/head.php'); ?>
    <div id="main">
    <?php require_once('admin/left.php'); ?>
    <div id="right">
        <div class="tit">Khởi tạo menu dọc</div>
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên cấp 1:</th><td><input name="menu1" value="<?php echo $ten; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Thứ tự hiển thị:</th><td><input name="thutu" value="<?php echo $thutu; ?>" /></td>
                </tr>
                <tr>
                    <th>Từ khóa:</th><td><input name="tukhoa" value="<?php echo $tukhoa; ?>" /> <i>Meta Keywords - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th>Mô tả:</th><td><input name="des" value="<?php echo $des; ?>" /> <i>Meta Description - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th></th><td><input name="trangchu" type="checkbox" value="1" style="width: auto; height: auto; padding: 0;" /> Hiển thị menu này ra trang chủ</td>
                </tr>
                <tr>
                    <th>Số hàng:</th><td>
                    <select name="sohang">
                        <option value="1">1 hàng (=5 sản phẩm)</option>
                        <option value="2">2 hàng (=10 sản phẩm)</option>
                        <option value="3">3 hàng (=15 sản phẩm)</option>
                        <option value="4">4 hàng (=20 sản phẩm)</option>
                        <option value="5">5 hàng (=25 sản phẩm)</option>
                        <option value="6">6 hàng (=30 sản phẩm)</option>
                        <option value="7">7 hàng (=35 sản phẩm)</option>
                        <option value="8">8 hàng (=40 sản phẩm)</option>
                        <option value="9">9 hàng (=45 sản phẩm)</option>
                        <option value="10">10 hàng (=50 sản phẩm)</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td>Số hàng áp dụng khi menu sản phẩm được hiển thị ra trang chủ</td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="cap1" value="TẠO MENU CẤP 1" /></td>
                </tr>
            </table>
        </form>
            <?php 
                $tmn1="select * from e23_menus1";$qmn1=mysqli_query($con,$tmn1);$comn1=mysqli_num_rows($qmn1);
                if($comn1>0){
            ?>
            <div style="width: 80%; height: 1px; margin: 25px auto; background: #006F6F;"></div>
            <form id="form" action="" method="post">
            <table>
            <?php echo $thongbao2; ?>
                <tr>
                    <th><span>*</span>Chọn menu cấp 1:</th>
                    <td>
                        <select name="menu1">
                            <?php while($rmn1=mysqli_fetch_assoc($qmn1)){echo'<option value="'.$rmn1['id'].'">'.$rmn1['ten'].'</option>';} ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><span>*</span>Tên menu cấp 2:</th><td><input name="menu2" value="<?php echo $menu2; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Thứ tự hiển thị:</th><td><input name="thutu2" value="<?php echo $thutu2; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Từ khóa:</th><td><input name="tukhoa2" value="<?php echo $tukhoa2; ?>" /> <i>Meta Keywords - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th><span>*</span>Mô tả:</th><td><input name="des2" value="<?php echo $des2; ?>" /> <i>Meta Description - Thẻ seo</i></td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="cap2" value="TẠO MENU CẤP 2" /></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    <div id="right">
        <div class="tit">Danh sách menu đã tạo</div>
        <div class="danhsach">
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th>Menu cấp 1</th><th>Quyền hạn</th><th>Menu cấp 2</th><th>Quyền hạn</th>
                </tr>
                <?php 
                $timmn1="select * from e23_menus1";$qmenu1=mysqli_query($con,$timmn1);
                while($rmns=mysqli_fetch_assoc($qmenu1)){ 
                    if($_COOKIE['quyen']==1){$xoa1="del-menus.php?menu=1&del=$rmns[id]";}else{$xoa1="#";}
                    $idmn1=$rmns['id'];
                    $tmn2="select * from e23_menus2 where menu1=$idmn1";$qmn2=mysqli_query($con,$tmn2);$comn2=mysqli_num_rows($qmn2);$rmn2=mysqli_fetch_assoc($qmn2);$dem=1;
                    if($_COOKIE['quyen']==1){$xoa2="del-menus.php?menu=2&del=$rmn2[id]";}else{$xoa2="#";}
                    ?>
                <tr>
                    <td <?php if($comn2>1){ echo "rowspan=\"".$comn2."\"";} ?>><?php echo $rmns['ten']; ?><br /></td>
                    <td <?php if($comn2>1){ echo "rowspan=\"".$comn2."\"";} ?> style="background: #F3F3F3;"><a class="sua" href="edit-menus.php?cap=1&edit=<?php echo $rmns['id']; ?>">Sửa</a> - <a class="xoa" href="<?php echo $xoa1; ?>">Xóa</a></td>
                    <td style="text-align: left;"><?php echo $rmn2['ten']; ?></td>
                    <td style="background: #F3F3F3;"><?php if($comn2>0){ ?><a class="sua" href="edit-menus.php?cap=2&edit=<?php echo $rmn2['id']; ?>">Sửa</a> - <a class="xoa" href="<?php echo $xoa2; ?>">Xóa</a><?php } ?></td>
                </tr>
                <?php 
                if($comn2>1){
                    //$tmenu2="select * from e23_menus2 where menu1=$idmn1";$qtmenu2=mysqli_query($con,$tmenu2);
                    while($menu2=mysqli_fetch_assoc($qmn2)){
                        if($dem>=1){
                        if($_COOKIE['quyen']==1){$xoa="del-menus.php?menu=2&del=$menu2[id]";}else{$xoa="#";}
                           echo"
                           <tr>
                                <td style=\"text-align: left;\">$menu2[ten]</td><td style=\"background: #F3F3F3;\"><a class=\"sua\" href=\"edit-menus.php?cap=2&edit=$menu2[id]\">Sửa</a> - <a class=\"xoa\" href=\"$xoa\">Xóa</a></td>
                            </tr>
                           "; 
                        }
                    $dem++;}
                }
                } ?>
            </table>
        </div>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>