<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
if(isset($_POST['capnhat'])){
    $t2=addslashes($_POST['t2']);
    $t3=addslashes($_POST['t3']);
    $t4=addslashes($_POST['t4']);
    $t4e=addslashes($_POST['t4e']);
    $t5=addslashes($_POST['t5']);
    $t5e=addslashes($_POST['t5e']);
    /*if($_FILES['image6']['name']){
        $t6=$_FILES['image6']['name'];
        $t6 = preg_replace('/[^a-zA-Z0-9.]/','-',$t6);
        $t6=time().$t6;
        move_uploaded_file($_FILES['image6']['tmp_name'],"upload/favicon/".$t6);
        // xong ảnh
     }else{$t6=$r['t6'];}
    $t7=addslashes($_POST['t7']); 
    $t7e=addslashes($_POST['t7e']); 
    $t8=addslashes($_POST['t8']); 
    $t9=addslashes($_POST['t9']); 
    $t10=addslashes($_POST['t10']);
    $t11=intval($_POST['t11']);
    $t12=intval($_POST['t12']);
    $t13=intval($_POST['t13']);
    $t14=intval($_POST['t14']);
    $t15=intval($_POST['t15']);
    $t16=intval($_POST['t16']);
    $t17=intval($_POST['t17']);
    $up="update dh_user set t2=N'$t2',t3=N'$t3',t4=N'$t4',t4e=N'$t4e',t5=N'$t5',t5e=N'$t5e',t6=N'$t6',
    t7=N'$t7',t7e=N'$t7e',t8=N'$t8',t9=N'$t9',t10=N'$t10',t11='$t11',t12='$t12',t13='$t13',t14='$t14',t15='$t15',t16='$t16',t17='$t17' where id=1";*/
    $up="update dh_user set t2=N'$t2',t3=N'$t3',t4=N'$t4',t4e=N'$t4e',t5=N'$t5',t5e=N'$t5e' where id=1";
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
<link rel="stylesheet" type="text/css" href="sup-admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel='stylesheet' id='siteorigin-widgets-css'  href='css/style2.css?ver=1.8.1' type='text/css' media='all' />
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
        <div class="tit">Cài đặt sản phẩm</div>
        <div class="nhacnho">
       
        </div>
        <form id="form" action="" method="post" enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th></th><td style="color: #0080FF; font-weight: bold;">Khu vực trang chủ</td>
                </tr>
                <tr>
                    <th><span>*</span>Tiêu đề 1:</th><td><input name="t2" type="text" value="<?php echo $r['t2']; ?>" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Text 1:</th><td><textarea style="height: 50px;" id="kmai" name="t3"><?php echo str_replace("\\","",$r['t3']); ?> </textarea></td>
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
                    <th><span>*</span>Tiêu đề 2:</th><td><input name="t4" value="<?php echo $r['t4']; ?>" /> 
                    Hiển thị: 
                    <select style="width: 180px;" name="t4e">
                    <option value="2" <?if($r['t4e']=='2'){echo 'selected=""';}?>>Hiển thị bài viết</option>
                    <option value="3" <?if($r['t4e']=='3'){echo 'selected=""';}?>>Hiển thị ảnh</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th><span>*</span>Tiêu đề 3:</th><td><input name="t5" value="<?php echo $r['t5']; ?>" /> 
                    Hiển thị: 
                    <select style="width: 180px;" name="t5e">
                    <option value="2" <?if($r['t5e']=='2'){echo 'selected=""';}?>>Hiển thị bài viết</option>
                    <option value="3" <?if($r['t5e']=='3'){echo 'selected=""';}?>>Hiển thị ảnh</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="capnhat" value="CẬP NHẬT THÔNG TIN" /></td>
                </tr>
            </table>
        </form>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>