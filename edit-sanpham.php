<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=$iduser";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
$edit=$_GET['edit'];
$tsp=@mysqli_query($con,"select * from dh_sanpham where id=$edit");
$rsp=@mysqli_fetch_assoc($tsp);
if(isset($_POST['tao'])){
    
    $ten=addslashes($_POST['ten']);
    //if($_POST['tit']==''){$tit=$ten;}else{$tit=addslashes($_POST['tit']);}
    
    //if($_POST['giacu']!=''){
    //$giacu=reset_gia($_POST['giacu']);
    //$giacu=intval($giacu);
    //}else{$gia=0;}
    if($_POST['gia']!=''){
    $gia=reset_gia($_POST['gia']);
    $gia=intval($gia);
    }else{$gia=0;}
    //if($_POST['chuhethong']!=''){
    //$chuhethong=reset_gia($_POST['chuhethong']);
    //$chuhethong=intval($chuhethong);
    //}else{$chuhethong=$rsp['chuhethong'];}
    //$pt_coban=intval($_POST['pt_coban']);
    //$pt_them=intval($_POST['pt_them']);
    //$pt_3don=intval($_POST['pt_3don']);
    //$pt_huongdan=intval($_POST['pt_huongdan']);
    //$pt_hethong=intval($_POST['pt_hethong']);
    $mota=strip_tags($_POST['mota']);
    $thongtin=addslashes($_POST['thongtin']);
    if($ten!='' and $gia>0){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $linkx='upload/sanpham/'.$rsp['anh'];unlink($linkx);
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/sanpham/".$tenanh);
        }else{$tenanh=$rsp['anh'];}
        /*/ xong ảnh 1
        if($_FILES['image2']['name'] and kiem_tra_anh($_FILES['image2']['name'])==1){
              $linkx='upload/sanpham/'.$rsp['anh2'];unlink($linkx);
        $tenanh2=$_FILES['image2']['name'];
        $tenanh2 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh2);
        $tenanh2=time().$tenanh2;
        move_uploaded_file($_FILES['image2']['tmp_name'],"upload/sanpham/".$tenanh2);
        }else{$tenanh2=$rsp['anh2'];}
        // xong ảnh 2
        if($_FILES['image3']['name'] and kiem_tra_anh($_FILES['image3']['name'])==1){
              $linkx='upload/sanpham/'.$rsp['anh3'];unlink($linkx);
        $tenanh3=$_FILES['image3']['name'];
        $tenanh3 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh3);
        $tenanh3=time().$tenanh3;
        move_uploaded_file($_FILES['image3']['tmp_name'],"upload/sanpham/".$tenanh3);
        }else{$tenanh3=$rsp['anh3'];}
        // xong ảnh 3
        if($_FILES['image4']['name'] and kiem_tra_anh($_FILES['image4']['name'])==1){
              $linkx='upload/sanpham/'.$rsp['anh4'];unlink($linkx);
        $tenanh4=$_FILES['image4']['name'];
        $tenanh4 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh4);
        $tenanh4=time().$tenanh4;
        move_uploaded_file($_FILES['image4']['tmp_name'],"upload/sanpham/".$tenanh4);
        }else{$tenanh4=$rsp['anh4'];}
        // xong ảnh 4
        if($_FILES['image5']['name'] and kiem_tra_anh($_FILES['image5']['name'])==1){
              $linkx='upload/sanpham/'.$rsp['anh5'];unlink($linkx);
        $tenanh5=$_FILES['image5']['name'];
        $tenanh5 = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh5);
        $tenanh5=time().$tenanh5;
        move_uploaded_file($_FILES['image5']['tmp_name'],"upload/sanpham/".$tenanh5);
        }else{$tenanh5=$rsp['anh5'];}
        
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
            $chonsanpham=$rsp['chonsanpham'];
        }
        
        $in="update dh_sanpham set ten=N'$ten',anh='$tenanh',anh2='$tenanh2',anh3='$tenanh3',anh4='$tenanh4',anh5='$tenanh5',chuhethong=$chuhethong,notegiacht=N'$notegiacht',
        gia=$gia,giacu=$giacu,pt_coban=$pt_coban,pt_them=$pt_them,pt_3don=$pt_3don,pt_huongdan=$pt_huongdan,pt_hethong=$pt_hethong,tit=N'$tit',mota=N'$mota',
        thongtin=N'$thongtin',link_content=N'$link_content',link_video=N'$link_video',link_amthanh=N'$link_amthanh',link_kichban=N'$link_kichban',
        link_media=N'$link_media',link_cachban=N'$link_cachban',uudai=N'$uudai',vanchuyen=N'$vanchuyen',camket=N'$camket',hoantra=N'$hoantra',congty=N'$congty',chonsanpham=$chonsanpham 
        where id=$edit";*/
        $in="update dh_sanpham set ten=N'$ten',anh='$tenanh',
        gia=$gia,tit=N'$ten',mota=N'$mota',
        thongtin=N'$thongtin'
        where id=$edit";
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
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, sửa sản phẩm chưa thành công, vui lòng làm lại.</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Tên và url sản phẩm không được để trống.</div>';}
    
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
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<script language="javascript" src="js/jquery.min.js"></script>
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
        <div class="tit">Sửa sản phẩm</div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php 
            echo $thongbao; 
            ?>
                <tr>
                    <th>Tên sản phẩm:</th><td><input name="ten" value="<?php echo str_replace("\\","",$rsp['ten']); ?>" /></td>
                </tr>
                
                
                <tr>
                    <th>Ảnh đại diện:</th><td><img src="upload/sanpham/<?php echo $rsp['anh']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                
                <!---tr>
                    <th>Ảnh 2:</th><td><img src="upload/sanpham/<?php echo $rsp['anh2']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image2" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Ảnh 3:</th><td><img src="upload/sanpham/<?php echo $rsp['anh3']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image3" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Ảnh 4:</th><td><img src="upload/sanpham/<?php echo $rsp['anh4']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image4" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Ảnh 5:</th><td><img src="upload/sanpham/<?php echo $rsp['anh5']?>" width="100" /></td>
                </tr>
                <tr>
                    <th>Sửa ảnh:</th><td><input style="padding: 0; width: 300px;" name="image5" type="file" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Giá CHT:</th><td><input required="" type="number" name="chuhethong" value="<?php echo $rsp['chuhethong']; ?>" /></td>
                </tr>
                <tr>
                    <th>Note Giá CHT:</th><td><input type="text" name="notegiacht" value="<?php echo $rsp['notegiacht']; ?>" /></td>
                </tr>
                <tr>
                    <th>Giá niêm yết:</th><td><input name="giacu" value="<?php echo $rsp['giacu']; ?>" /></td>
                </tr-->
                <tr>
                    <th>Giá bán:</th><td><input name="gia" value="<?php echo $rsp['gia']; ?>" /></td>
                </tr>
                <!--tr>
                    <th>% Cơ bản</th><td><input type="number" name="pt_coban" value="<?php echo $rsp['pt_coban']; ?>" /></td>
                </tr>
                <tr>
                    <th>% Thêm</th><td><input type="number" name="pt_them" value="<?php echo $rsp['pt_them']; ?>" /></td>
                </tr>
                <tr>
                    <th>% 3 Đơn</th><td><input type="number" name="pt_3don" value="<?php echo $rsp['pt_3don']; ?>" /></td>
                </tr>
                <tr>
                    <th>% Hướng dẫn</th><td><input type="number" name="pt_huongdan" value="<?php echo $rsp['pt_huongdan']; ?>" /></td>
                </tr>
                <tr>
                    <th>% Hệ thống</th><td><input type="number" name="pt_hethong" value="<?php echo $rsp['pt_hethong']; ?>" /></td>
                </tr>
                <tr>
                    <th>Title:</th><td><input name="tit" value="<?php echo  str_replace("\\","",$rsp['tit']); ?>" /></td>
                </tr-->
                
                <tr>
                    <th>Mô tả SP:</th><td><textarea style="height: 50px;" name="mota"><?php echo  str_replace("\\","",$rsp['mota']); ?></textarea></td>
                </tr>
                <tr>
                    <th>Chi tiết SP:</th><td><textarea id="thongtin" name="thongtin"><?php echo str_replace("\\","",$rsp['thongtin']); ?></textarea></td>
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
                    <th>Ưu đãi:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="uudai"><?php echo $rsp['uudai']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Vận chuyển:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="vanchuyen"><?php echo $rsp['vanchuyen']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Cam kết:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="camket"><?php echo $rsp['camket']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Hoàn trả:</th><td><textarea cols="3" style="height: 80px; width: 90%;" name="hoantra"><?php echo $rsp['hoantra']; ?></textarea></td>
                </tr>
                <tr>
                    <th>Công ty:</th><td><textarea id="congty" name="congty"><?php echo str_replace("\\","",$rsp['congty']); ?></textarea></td>
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
                    <th>Link Content:</th><td><input name="link_content" value="<?php echo  $rsp['link_content']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link Video:</th><td><input name="link_video" value="<?php echo  $rsp['link_video']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link Âm thanh:</th><td><input name="link_amthanh" value="<?php echo  $rsp['link_amthanh']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link Kịch bản:</th><td><input name="link_kichban" value="<?php echo  $rsp['link_kichban']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link Media:</th><td><input name="link_media" value="<?php echo  $rsp['link_media']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link Cách bán:</th><td><input name="link_cachban" value="<?php echo  $rsp['link_cachban']; ?>" /></td>
                </tr>
                <tr><th></th><td>---Chọn sản phẩm---------------------</td>
                <!--/tr>
                <tr>
                    <th>Show chọn sản phẩm:</th><td><input style="width: auto; height: auto;" name="chonsanpham" type="checkbox" value="1"  <?php if($rsp['chonsanpham']==1){ echo 'checked=""';} ?>/> Tích để chọn</td>
                </tr-->
                <tr>
                    <th></th><td><input type="submit" name="tao" value="SỬA SẢN PHẨM" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>