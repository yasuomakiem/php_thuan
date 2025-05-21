<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=$iduser";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
$menu1=$_GET['menu1'];
$gia=0;$giacu=0;$motas='';
if(isset($_POST['tao'])){
    $ten=addslashes($_POST['ten']);
    if($_POST['tit']==''){$tit=$ten;}else{$tit=addslashes($_POST['tit']);}
    $khongdau=chuyen_khong_dau_gach_ngang($_POST['khongdau']);
    $gia=reset_gia($_POST['gia']);
    $gia=intval($gia);
    //if($_POST['giacu']!=''){
    //$giacu=reset_gia($_POST['giacu']);
    //$giacu=intval($giacu);
    //}else{$gia=0;}
    //if($_POST['gia']!=''){
    //$gia=reset_gia($_POST['gia']);
    //$gia=intval($gia);
    //}else{$gia=0;}
    //if($_POST['chuhethong']!=''){
    //$chuhethong=reset_gia($_POST['chuhethong']);
    //$chuhethong=intval($chuhethong);
    //}else{$chuhethong=0;}
    //$pt_coban=intval($_POST['pt_coban']);
    //$pt_them=intval($_POST['pt_them']);
    //$pt_3don=intval($_POST['pt_3don']);
    //$pt_huongdan=intval($_POST['pt_huongdan']);
    //$pt_hethong=intval($_POST['pt_hethong']);
    $mota=strip_tags($_POST['des']);
    $thongtin=addslashes($_POST['thongtin']);
    if($ten!='' and $thongtin!='' and $gia>0){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/sanpham/".$tenanh);
        /*
        if($_FILES['image2']['name'] and kiem_tra_anh($_FILES['image2']['name'])==1){
        $tenanh2=$_FILES['image2']['name'];
        $tenanh2 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh2);
        $tenanh2=time().$tenanh2;
        move_uploaded_file($_FILES['image2']['tmp_name'],"upload/sanpham/".$tenanh2);
        
        if($_FILES['image3']['name'] and kiem_tra_anh($_FILES['image3']['name'])==1){
        $tenanh3=$_FILES['image3']['name'];
        $tenanh3 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh3);
        $tenanh3=time().$tenanh3;
        move_uploaded_file($_FILES['image3']['tmp_name'],"upload/sanpham/".$tenanh3);
        
        if($_FILES['image4']['name'] and kiem_tra_anh($_FILES['image4']['name'])==1){
        $tenanh4=$_FILES['image4']['name'];
        $tenanh4 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh4);
        $tenanh4=time().$tenanh4;
        move_uploaded_file($_FILES['image4']['tmp_name'],"upload/sanpham/".$tenanh4);
        
        if($_FILES['image5']['name'] and kiem_tra_anh($_FILES['image5']['name'])==1){
        $tenanh5=$_FILES['image5']['name'];
        $tenanh5 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh5);
        $tenanh5=time().$tenanh5;
        move_uploaded_file($_FILES['image5']['tmp_name'],"upload/sanpham/".$tenanh5);
        
        $uudai=addslashes($_POST['uudai']);
        $vanchuyen=addslashes($_POST['vanchuyen']);
        $camket=addslashes($_POST['camket']);
        $hoantra=addslashes($_POST['hoantra']);
        
        $link_content=addslashes($_POST['link_content']);
        $link_video=addslashes($_POST['link_video']);
        $link_amthanh=addslashes($_POST['link_amthanh']);
        $link_kichban=addslashes($_POST['link_kichban']);
        $link_media=addslashes($_POST['link_media']);
        $link_cachban=addslashes($_POST['link_cachban']);
        $notegiacht=addslashes($_POST['notegiacht']);
        $congty=addslashes($_POST['congty']);
        if($_POST['chonsanpham']){
            $chonsanpham=intval($_POST['chonsanpham']);
        }else{
            $chonsanpham=0;
        }
        $in="insert into dh_sanpham (
        ten,khongdau,anh,anh2,anh3,anh4,anh5,chuhethong,notegiacht,gia,giacu,pt_coban,pt_them,pt_3don,pt_huongdan,
        pt_hethong,tit,mota,thongtin,time,link_content,link_video,link_amthanh,link_kichban,link_media,link_cachban,
        uudai,vanchuyen,camket,hoantra,congty,chonsanpham
        )value(
        N'$ten','$khongdau','$tenanh','$tenanh2','$tenanh3','$tenanh4','$tenanh5',$chuhethong,N'$notegiacht',$gia,$giacu,$pt_coban,$pt_them,$pt_3don,
        $pt_huongdan,$pt_hethong,N'$tit',N'$mota',N'$thongtin',$time,N'$link_content',N'$link_video',N'$link_amthanh',
        N'$link_kichban',N'$link_media',N'$link_cachban',
        N'$uudai',N'$vanchuyen',N'$camket',N'$hoantra',N'$congty',$chonsanpham
        )";
        */
        $in="insert into dh_sanpham (ten,khongdau,anh,gia,tit,mota,thongtin,time
        )value(
        N'$ten','$khongdau','$tenanh',$gia,N'$tit',N'$mota',N'$thongtin',$time
        )";
        $q=@mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-sanpham.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo sản phẩm thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, tạo sản phẩm chưa thành công, vui lòng làm lại.</div>';}
        //}else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh 5, hoặc ảnh không đúng định dạng (.gif .jpg .jpeg .png).</div>';}
        //}else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh 4, hoặc ảnh không đúng định dạng (.gif .jpg .jpeg .png).</div>';}
        //}else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh 3, hoặc ảnh không đúng định dạng (.gif .jpg .jpeg .png).</div>';}
        //}else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh 2, hoặc ảnh không đúng định dạng (.gif .jpg .jpeg .png).</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh đại diện, hoặc ảnh không đúng định dạng (.gif .jpg .jpeg .png).</div>';}
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
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>sup-admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<script language="javascript" src="https://code.jquery.com/jquery-1.5.1.js"></script>
<script language="javascript">
 $(document).ready(function() {
  $('#menu1').change(function() {
   giatri = this.value;
   $('#m2').load('ajax.php?id1=' + giatri);
  });
 });
 $(document).ready(function() {
  $('#menu2').change(function() {
   giatri2 = this.value;
   $('#m3').load('ajax.php?id2=' + giatri2);
  });
 });
</script>
<style>

#right #form table th{width: 130px;}
#right #form table td textarea{width: 620px; height: 400px;}
</style>
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
    
        <div class="tit">Đăng sản phẩm</div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên sản phẩm:</th><td><input required="" name="ten" value="<?php echo $ten; ?>" /></td>
                </tr>
                <!--tr>
                    <th><span>*</span>Link:</th><td><input required="" name="khongdau" value="<?php echo $khongdau; ?>" /></td>
                </tr-->
                <tr>
                    <th><span>*</span>Ảnh đại diện:</th><td><input required="" style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <!--tr>
                    <th><span>*</span>Ảnh 2:</th><td><input required="" style="padding: 0; width: 300px;" name="image2" type="file" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Ảnh 3:</th><td><input required="" style="padding: 0; width: 300px;" name="image3" type="file" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Ảnh 4:</th><td><input required="" style="padding: 0; width: 300px;" name="image4" type="file" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Ảnh 5:</th><td><input required="" style="padding: 0; width: 300px;" name="image5" type="file" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Giá CHT:</th><td><input required="" type="number" name="chuhethong" value="<?php echo $chuhethong; ?>" /></td>
                </tr>
                <tr>
                    <th>Note Giá CHT:</th><td><input type="text" name="notegiacht" value="<?php echo $notegiacht; ?>" /></td>
                </tr-->
                <tr>
                    <th><span>*</span>Giá bán:</th><td><input required="" type="number" name="gia" value="<?php echo $gia; ?>" /></td>
                </tr>
                <!--tr>
                    <th><span>*</span>Giá bán:</th><td><input required="" type="number" name="gia" value="<?php echo $gia; ?>" /></td>
                </tr>
                <tr style="">
                    <th><span>*</span>% Cơ bản:</th><td><input type="number" required="" name="pt_coban" value="<?php echo $pt_coban; ?>" /></td>
                </tr>
                <tr style="">
                    <th><span>*</span>% Trả thêm:</th><td><input type="number" required="" name="pt_them" value="<?php echo $pt_them; ?>" /></td>
                </tr>
                <tr style="">
                    <th><span>*</span>% 3 đơn:</th><td><input type="number" required="" name="pt_3don" value="<?php echo $pt_3don; ?>" /></td>
                </tr>
                <tr style="">
                    <th><span>*</span>% Hướng dẫn:</th><td><input type="number" required="" name="pt_huongdan" value="<?php echo $pt_huongdan; ?>" /></td>
                </tr>
                <tr style="">
                    <th><span>*</span>% Hệ thống:</th><td><input type="number" required="" name="pt_hethong" value="<?php echo $pt_hethong; ?>" /></td>
                </tr>
                <tr>
                    <th>Title:</th><td><input name="tit" value="<?php echo str_replace("\\","",$tit); ?>" /></td>
                </tr-->
                <tr>
                    <th>Mô tả:</th><td><textarea style="height: 50px;" name="des"><?php echo strip_tags($mota); ?></textarea></td>
                </tr>
                <tr>
                    <th><span>*</span>Chi tiết SP:</th><td><textarea required="" id="thongtin" name="thongtin"><?php echo str_replace("\\","",$thongtin); ?></textarea></td>
                </tr>
                <script type="text/javascript">
                    CKEDITOR.replace( 'thongtin',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
                <!--tr>
                    <th>Ưu đãi:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="uudai"><?php echo str_replace("\\","",$uudai); ?></textarea></td>
                </tr>
                <tr>
                    <th>Vận chuyển:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="vanchuyen"><?php echo str_replace("\\","",$vanchuyen); ?></textarea></td>
                </tr>
                <tr>
                    <th>Cam kết:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="camket"><?php echo str_replace("\\","",$camket); ?></textarea></td>
                </tr>
                <tr>
                    <th>Hoàn trả:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="hoantra"><?php echo str_replace("\\","",$hoantra); ?></textarea></td>
                </tr>
                <tr>
                    <th>Công ty:</th><td><textarea id="congty" name="congty"><?php echo str_replace("\\","",$congty); ?></textarea></td>
                </tr>
                <script type="text/javascript">
                    CKEDITOR.replace( 'congty',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
                <tr><th></th><td>---Cho thành viên---------------------</td>
                <!--/tr>
                <tr>
                    <th>Link Content:</th><td><input name="link_content" value="<?php echo str_replace("\\","",$link_content); ?>" /></td>
                </tr>
                <tr>
                    <th>Link Video:</th><td><input name="link_video" value="<?php echo str_replace("\\","",$link_video); ?>" /></td>
                </tr>
                <tr>
                    <th>Link Âm thanh:</th><td><input name="link_amthanh" value="<?php echo str_replace("\\","",$link_amthanh); ?>" /></td>
                </tr>
                <tr>
                    <th>Link Kịch bản:</th><td><input name="link_kichban" value="<?php echo str_replace("\\","",$link_kichban); ?>" /></td>
                </tr>
                <tr>
                    <th>Link Media:</th><td><input name="link_media" value="<?php echo str_replace("\\","",$link_media); ?>" /></td>
                </tr>
                <tr>
                    <th>Link Cách bán:</th><td><input name="link_cachban" value="<?php echo str_replace("\\","",$link_cachban); ?>" /></td>
                </tr>
                <tr><th></th><td>---Chọn sản phẩm---------------------</td>
                <!--/tr>
                <tr>
                    <th>Show chọn sản phẩm:</th><td><input style="width: auto; height: auto;" name="chonsanpham" type="checkbox" value="1" /> Tích để chọn</td>
                </tr-->
                <tr>
                    <th></th><td><input type="submit" name="tao" value="ĐĂNG SẢN PHẨM" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>