<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=mysql_query($tim);$r=mysql_fetch_assoc($q);
if(isset($_POST['tao'])){
    $ten=addslashes($_POST['ten']);
    $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr(md5($time),1,1);
    $muc=$_GET['id'];
    $muc2=$_POST['menu2'];
    $trichdan=strip_tags($_POST['trichdan'],'');
    $noidung=addslashes($_POST['noidung']);
    if($ten!='' and $noidung!=''){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/baiviet/".$tenanh);
        }else{$tenanh="";}
        // xong ảnh
        $in="insert into dh_baiviet (ten,khongdau,muc,muc2,anh,trichdan,noidung,loai,time)value
        (N'$ten','$khongdau',$muc,$muc2,'$tenanh',N'$trichdan',N'$noidung',3,$time)";
        $q=mysql_query($in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-album.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo baiviet thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, tạo album chưa thành công, vui lòng làm lại.</div>';}
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
<link rel="stylesheet" type="text/css" href="admin/main_admin.css" />
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
        <div class="tit">Đăng album ảnh</div>
        
        <? $tm="select * from dh_menu1 where loai=3";$qtm=mysql_query($tm); if(mysql_num_rows($qtm)>0){ ?>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Menu album:</th><td>
                    <select name="menu1"  onchange="window.open(this.options[this.selectedIndex].value,'_self'); this.options[0].selected=true">
                        <option value="0">Lựa chọn...</option>
                    <?php while($rmn=mysql_fetch_assoc($qtm)){ ?>
                        <option value="tao-album.php?top=<?php echo $rmn['khongdau']; ?>&id=<?=$rmn['id']?>" <?php if(isset($_GET['top']) and $_GET['top']==$rmn['khongdau']){echo 'selected="selected"';} ?> ><?php echo $rmn['ten']; ?></option>
                    <?php } ?>
                    </select>
                    </td>
                </tr>
                <?php if(isset($_GET['id']) and $_GET['id']!=0){ $mm1=$_GET['id'];$tm="select * from dh_menu2 where menu1=$mm1";$qtm=mysql_query($tm);?>
                <tr>
                    <th><span>*</span>Menu cấp 2:</th><td>
                    <select name="menu2">
                        <option value="0">Lựa chọn...</option>
                    <?php while($rmn=mysql_fetch_assoc($qtm)){ ?>
                        <option value="<?php echo $rmn['id']; ?>"><?php echo $rmn['ten']; ?></option>
                    <?php } ?>
                    </select>
                    </td>
                </tr>
                <?php }else{ ?>
                <input type="hidden" name="menu2" value="0" />
                <?}?>
                <tr>
                    <th><span>*</span>Tên album:</th><td><input name="ten" value="<?php echo $ten; ?>" /></td>
                </tr>
                <tr>
                    <th>Ảnh đại diện:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>- Kích thước tiêu chuẩn 250x150 hoặc cùng kích thước</td>
                </tr>
                <tr>
                    <th><span>*</span>Trích dẫn:</th><td><textarea style="height: 40px;" name="trichdan"><?php echo $trichdan; ?> </textarea> thẻ SEO</td>
                </tr>
                
                <tr>
                    <th><span>*</span>Giới thiệu album:</th><td><textarea id="thongtin" name="noidung"><?php echo tra_ma_doc($noidung); ?> </textarea></td>
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
                    <th></th><td><input type="submit" name="tao" value="ĐĂNG ALBUM" /></td>
                </tr>
            </table>
        </form>
        <?}else{?>
        <p style="color: red; text-align: center;">Bạn chưa tạo menu dạng album nào, nên không thể đăng.</p>
        <?}?>
        
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>