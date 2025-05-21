<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
//require_once('include/session.php');
if(!isset($_COOKIE['iduser']) or ($_COOKIE['iduser']!=1 and $_COOKIE['iduser']!=887)){exit();}
if(!isset($_GET['id'])){exit();}
$menu_mod=intval($_GET['id']);
if(isset($_POST['tao'])){
    $ten=addslashes($_POST['ten']);
    $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr(md5($time),1,1);
    $mota=strip_tags($_POST['mota'],'');
    $noidung=addslashes($_POST['noidung']);
    if($mota==''){
        $mota=substr(strip_tags($noidung,''),0,40);
    }
    if($ten!=''){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
            
        $tenanh=$_FILES['image']['name'];
        $size = getimagesize($_FILES['image']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=400;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=substr(md5($time),0,3).'-'.$tenanh;
        $file1='upload/mod/'.$tenanh;
        resize_nhieu($width_resize,$height_resize,'image',$file1); 
        
        // xong ảnh
        $in="insert into chuyende (ten,khongdau,menu_mod,anh,mota,noidung,time)value
        (N'$ten','$khongdau',$menu_mod,'$tenanh',N'$mota',N'$noidung',$time)";
        $q=mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds_mod.php?id='.$menu_mod.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Xuất bản thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>'.$in;}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Thiếu ảnh đại diện (*).</div>';}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
}
if(isset($_POST['suachuyende'])){
    $idedit=intval($_GET['edit']);
    $edit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$idedit"));
    $ten=addslashes($_POST['ten']);
    if($ten==$edit['ten']){
        $khongdau=$edit['khongdau'];
    }else{
        $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr(md5($time),1,1);
    }
    $mota=strip_tags($_POST['mota'],'');
    $noidung=addslashes($_POST['noidung']);
    if($mota==''){
        $mota=substr(strip_tags($noidung,''),0,40);
    }
    if($ten!=''){
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $size = getimagesize($_FILES['image']['tmp_name']);
        $rog=$size[0];$ca=$size[1];
        $width_resize=400;
        $height_resize=round($width_resize*$ca/$rog); 
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=substr(md5($time),0,3).'-'.$tenanh;
        $file1='upload/mod/'.$tenanh;
        resize_nhieu($width_resize,$height_resize,'image',$file1); 
        }else{$tenanh=$edit['anh'];}
        // xong ảnh
        $in="update chuyende set ten=N'$ten',khongdau='$khongdau',anh='$tenanh',mota=N'$mota',noidung=N'$noidung' where id=$idedit";
        $q=mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds_mod.php?id='.$menu_mod.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Sửa thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>'.$in;}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
}
if(isset($_POST['taovideo'])){
    $idchuyende=intval($_GET['cd']);
    $ten=addslashes($_POST['ten']);
    $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr(md5($time),1,1);
    $link=addslashes($_POST['link']);
    $noidung=addslashes($_POST['noidung']);
    $thutu=intval($_POST['thutu']);
    $author=addslashes($_POST['author']);
    if($ten!=''){
        
        $in="insert into video (menu_mod,chuyende,ten,khongdau,link,noidung,thutu,author,time)value
        ($menu_mod,$idchuyende,N'$ten','$khongdau','$link',N'$noidung',$thutu,N'$author',$time)";
        $q=mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds_mod.php?id='.$menu_mod.'&cd='.$idchuyende.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Khởi tạo thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>'.$in;}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
}
if(isset($_POST['suavideo'])){
    $idchuyende=intval($_GET['cd']);
    $idedit=intval($_GET['edit']);
    $ten=addslashes($_POST['ten']);
    $author=addslashes($_POST['author']);
    $edit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from video where id=$_GET[edit]"));
    if($edit['ten']==$ten){
        $khongdau=$edit['khongdau'];
    }else{
        $khongdau=chuyen_khong_dau_gach_ngang($ten)."-".substr(md5($time),1,1);
    }
    $link=addslashes($_POST['link']);
    $noidung=addslashes($_POST['noidung']);
    $thutu=intval($_POST['thutu']);
    if($ten!=''){
        
        $in="update video set ten=N'$ten',khongdau='$khongdau',link='$link',noidung=N'$noidung',author=N'$author',thutu=$thutu where id=$idedit";
        $q=mysqli_query($con,$in);
        if($q){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds_mod.php?id='.$menu_mod.'&cd='.$_GET['cd'].'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Thao tác thành công.</div>';
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>'.$in;}
        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
}
$tit='Tạo nội dung chức năng';
?>
<!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<meta name="robots" content="all" />	
<base href="<?php echo $domain?>" />	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>	
<meta name="description" content="<?php echo $des?>"/>		
<title><?php echo $tit?></title>
<meta property="description" content="<?php echo $des?>"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $tit?>"/>
<meta property="og:image" content="images/webinar.jpg"/>
<meta property="og:description" content="<?php echo $des?>"/>
<meta property="og:url" content="<?php echo lay_url()?>"/>
<meta property="og:site_name" content="<?php echo $tit?>"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $des?>" />
<meta name="twitter:title" content="<?php echo $tit?>" />
<meta name="twitter:image" content="images/webinar.jpg" />	
<link rel="icon" href="images/favi.png" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='js/bootstrap.min.js'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel="stylesheet"  href="css/admin.css"/>
</head>
<body>
<section class="titadmin">
    <div class="container">
        <div class="row">
            <?php 
                require_once('sup-admin/headadmin.php');
            ?>
        </div>
    </div>
</section>
<section class="contentmain">
<div class="container">
    <div class="row">
    <div  class="col-md-9 col-xs-12 conleft">
    <?php if(isset($_GET['cd'])){
        if(isset($_GET['edit'])){
            $tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm);
            $chuyende=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$_GET[cd]"));
            $edit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from video where id=$_GET[edit]"));
        ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Sửa video/Bài học <a type="button" class="dieuh btn btn-primary btn-xs" href="ds_mod.php?id=<?php echo $menu_mod?>&cd=<?php echo $_GET['cd']?>">Danh sách</a></div>
        <form id="form" class="form-horizontal" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
           
            <?php  echo $thongbao; ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #333;"><?php echo $tenmod['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Chuyên đề:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #333;"><?php echo $chuyende['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tên video/bài học:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="ten" value="<?php echo $edit['ten']?>" /></div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tác giả:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="author" value="<?php echo $edit['author']?>" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Link Youtube</label>
                    <div class="col-sm-10"><input name="link" class="form-control" value="<?php echo $edit['link']?>" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Thứ tự hiển thị</label>
                    <div class="col-sm-10"><input name="thutu" class="form-control" required="" value="<?php echo $edit['thutu']?>" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung:</label>
                    <div class="col-sm-10"><textarea id="thongtin" name="noidung"><?php echo $edit['noidung']?></textarea></div>
                </div>
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
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10"><input type="submit" class="btn btn-primary" name="suavideo" value="SỬA" /></div>
                </div>
            
        </form>
        <?php 
        }else{
    $tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm);
    $chuyende=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$_GET[cd]"));
    ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Tạo video/Bài học <a type="button" class="dieuh btn btn-primary btn-xs" href="ds_mod.php?id=<?php echo $menu_mod?>&cd=<?php echo $_GET['cd']?>">Danh sách</a></div>
        <form id="form"  class="form-horizontal" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
            <?php  echo $thongbao; ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #333;"><?php echo $tenmod['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Chuyên đề:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #333;"><?php echo $chuyende['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tên video/bài học:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="ten" value="" /></div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tác giả:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="author" value="" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Link Youtube</label>
                    <div class="col-sm-10"><input name="link" class="form-control" value="" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Thứ tự hiển thị</label>
                    <div class="col-sm-10"><input name="thutu" class="form-control" required="" value="" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung:</label>
                    <div class="col-sm-10"><textarea id="thongtin" name="noidung"></textarea></div>
                </div>
               <div class="form-group">
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
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10"><input type="submit" class="btn btn-primary" name="taovideo" value="KHỞI TẠO" /></div>
                </div>
        </form>
    <?php }}else{
        if(isset($_GET['edit'])){
            $idedit=intval($_GET['edit']);
            $edit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$idedit"));
            ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Sửa chuyên đề  <a type="button" class="dieuh btn btn-primary btn-xs" href="ds_mod.php?id=<?php echo $menu_mod?>">Danh sách</a></div>
        
        <?php  $tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm); ?>
        <form id="form" class="form-horizontal" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
            <?php  echo $thongbao; ?>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #333;"><?php echo $tenmod['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tên:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="ten" value="<?php echo $edit['ten']?>" /></div>
                </div>
               
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Ảnh đại diện:</label>
                    <div class="col-sm-10">
                    <p><img src="upload/mod/<?php echo $edit['anh']?>" width="100" /></p>
                    <input style="padding: 0; width: 300px;" name="image" type="file" />
                    <p>Kích thước tốt nhất 1:1</p>
                    </div>
                </div>
               <div class="form-group">
                <?php /*?>
                <tr>
                    <th>Mô tả:</th><td><textarea style="height: 40px;" name="mota"><?php echo $edit['mota']?></textarea></div>
                </tr>
                
                <tr>
                    <th><span>*</span>Nội dung:</th><td><textarea id="thongtin" required="" name="noidung"><?php echo $edit['noidung']?></textarea></div>
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
                <?php */?>
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10"><input type="submit" class="btn btn-primary" name="suachuyende" value="SỬA" /></div>
                </div>
        </form>  
        <?php }else{
        ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Tạo chuyên đề  <a type="button" class="dieuh btn btn-primary btn-xs" href="ds_mod.php?id=<?php echo $menu_mod?>">Danh sách</a></div>
        
        <?php  $tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm); ?>
        <form id="form" class="form-horizontal" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
            <?php  echo $thongbao; ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                    <div class="col-sm-10" style="padding-top: 7px;">
                    <b style="color: #E67300;"><?php echo $tenmod['ten']?></b>
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Tên:</label>
                    <div class="col-sm-10"><input required="" class="form-control" name="ten" value="" /></div>
                </div>
                
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><span>*</span>Ảnh đại diện:</label>
                    <div class="col-sm-10"><input required="" style="padding: 0; width: 300px;" name="image" type="file" /></div>
               </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">Kích thước tốt nhất 1:1</div>
                </div>
               <div class="form-group">
                <?php /*
                <tr>
                    <th>Mô tả:</th><td><textarea style="height: 40px;" name="mota"></textarea></div>
                </tr>
                
                <tr>
                    <th><span>*</span>Nội dung:</th><td><textarea id="thongtin" required="" name="noidung"></textarea></div>
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
                <?php */?>
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10"><input type="submit" class="btn btn-primary" style="cursor: pointer;" name="tao" value="XUẤT BẢN" /></div>
                </div>
        </form>
        
    <?php }}?>
    </div>
    <div class="col-md-3 col-xs-12 conright">
    <?php  require_once('sup-admin/left.php'); ?>
    </div>
    </div>
</div>
</section>
<section class="afooter">
    <?php  require_once('sup-admin/footer.php'); ?>
</section>
    
</body>
</html>