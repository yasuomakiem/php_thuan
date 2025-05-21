<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);$quyen=$r['quyen'];
$id=intval($_GET['id']);
$nd10=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_baiviet where id=$id"));

if(isset($_GET['del'])){
    $del=$_GET['del'];
    $khoi=str_replace("$del","",$nd10['album']);
    $linh=$domain.'upload/album/'.$del;unlink($linh);
    $in1="update dh_baiviet set album=N'$khoi' where id=$id";
    $qup=@mysqli_query($con,$in1);
    if($qup){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="add-img.php?id='.$id.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    
}
if(isset($_POST['add'])){
    if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        //$file='upload/noidung/'.$tenanh;
        //resize($width_resize,$height_resize,$file);
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/album/".$tenanh);
    if(trim($nd10['album'])==''){
    $khoi=$tenanh;
    }else{
    $khoi=$nd10['album'].'***'.$tenanh;
    }
    $in1="update dh_baiviet set album=N'$khoi' where id=$id";
    $qup=@mysqli_query($con,$in1);
    if($qup){
        $nd10=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_baiviet where id=$id"));
        $thongbao="<tr><th></th><td style='color:blue'>Thêm ảnh thành công!</td></tr>";
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao="<tr><th></th><td style='color:red'>Bạn chưa chọn ảnh!</td></tr>";}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content=" thế giới web giá rẻ và không thể rẻ hơn" />
<title>Tạo nội dung - Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<style>
#right #form table th {
    text-align: right;
    width: 160px;
    padding-right: 10px;
}
#right #form table td {
    text-align: left;
    padding: 5px;
    width: 760px;
}
</style>
</head>
<body>
<?php require_once('admin/head.php'); ?>
    <div id="main">
    <?php require_once('admin/left.php'); ?>
   
    <div id="right">
        <div class="tit">Thêm các ảnh cho bộ sưu tập <span style="float: right;"><a style="color: #0080FF;" href="ds-album.php?edit=10">Danh sách album</a></span></div>
        <form  id="form" action="" method="post"  enctype="multipart/form-data">
        
            <table>
            <?php echo $thongbao; ?>
                <tr>
                <th></th><th style="text-align: left;line-height: 30px;padding-top: 35px;"><?=$nd10['ten']?></th>
                </tr>
                <tr>
                    <th><span>*</span>Thêm Ảnh:</th><td><input required="" style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>Các ảnh đăng lên phải có cùng 1 kích thước</td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="add" value="THÊM ẢNH" /></td>
                </tr>
            </table>
        </form>
          
    </div>
    
    <div id="right">
        <div class="tit">Danh sách ảnh đã tạo</div>
        <div class="danhsach">
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th style="">Ảnh</th><th style="">Quyền hạn</th>
                </tr>
                <?php 
                $k10=explode("***",$nd10['album']);
                for($j=0;$j<count($k10);$j++){
                    if(trim($k10[$j])!=''){
                    if($j==0){$chuoixoa=$k10[$j]."***";}else{$chuoixoa="***".$k10[$j];}
                    ?>
                <tr>
                    <td><img src="upload/album/<?=$k10[$j]?>" width="300" /></td>
                    <td style="">
                     <a onclick="return confirm('Bạn có chắc chắn muốn xóa nội dung này')" class="xoa" href="add-img.php?id=<?=$id?>&del=<?=$chuoixoa?>">Xóa</a>
                     </td>
                </tr>
                <?php }} ?>
            </table>
        </div>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('admin/footer.php'); ?>
    </div>
</body>
</html>