<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
if(isset($_POST['capnhat'])){
    $t18=addslashes($_POST['t18']);
    $t19=addslashes($_POST['t19']);
    $t20=addslashes($_POST['t20']);
    
    $up="update dh_user set t18=N'$t18',t19=N'$t19',t20=N'$t20' where id=1";
    $qup=@mysqli_query($con,$up);
    if($qup){
        $tim2="select * from dh_user where id=1";$q=@mysqli_query($con,$tim2);$r=@mysqli_fetch_assoc($q);
        $thongbao="<tr><th></th><td style='color:blue'>Cập nhật thông tin thành công!</td></tr>";
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    
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
<link rel='stylesheet' id='siteorigin-widgets-css'  href='css/style2.css?ver=1.8.1' type='text/css' media='all' />
</head>
<body>
<?php require_once('admin/head.php'); ?>
    <div id="main">
    <?php require_once('admin/left.php'); ?>
    <div id="right">
        <div class="tit">Cài đặt chân trang</div>
        <div class="nhacnho">
       
        </div>
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Text 1:</th><td><input name="t18" value="<?php echo $r['t18']; ?>" /> </td>
                </tr>
                <tr>
                    <th><span>*</span>Text 2:</th><td><input name="t19" value="<?php echo $r['t19']; ?>" />  </td>
                </tr>
                <tr>
                    <th><span>*</span>Area 1:</th><td><textarea style="height: 50px;" id="kmai" name="t20"><?php echo str_replace("\\","",$r['t20']); ?> </textarea></td>
                </tr>
                <script type="text/javascript">
                    CKEDITOR.replace( 'kmai',
                    {
                    //toolbar: 'toolbar',
                    filebrowserBrowseUrl : 'ckfinder/ckfinder.htm',
                    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.htm?Type=Images',
                    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.htm?Type=Flash',
                    filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                    });
                    </script>
                
                
                <tr>
                    <th></th><td><input type="submit" name="capnhat" value="CẬP NHẬT THÔNG TIN" /></td>
                </tr>
            </table>
        </form>
        <p style="padding: 15px 0;">Xem chi tiết vị trí:</p>
        <img src="images/chantrang.png" width="100%" />
    </div>
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>