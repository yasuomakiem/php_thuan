<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);$quyen=$r['quyen'];
if(isset($_POST['edit'])){
    if($_COOKIE['quyen']==1){
    $passcu=$_POST['passcu'];
    $passmoi=$_POST['passmoi'];
    $repassmoi=$_POST['repassmoi'];
    if($passcu!='' and $passmoi!='' and $repassmoi!=''){
    if(md5($passcu)==$r['pass']){
    if($passmoi==$repassmoi){
    $passmoi=md5($passmoi);
    $in1="update dh_user set pass='$passmoi' where id=1";
    $qup=mysqli_query($con,$in1);
    if($qup){
        $thongbao='<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>Đổi mật khẩu thành công.</div>';
    }else{$thongbao='<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cảnh báo!</strong> Có lỗi, Cập nhật mật khẩu chưa thành công, vui lòng làm lại!</div>';}
    }else{$thongbao='<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cảnh báo!</strong> Mật khẩu nhập lại không khớp.</div>';}
    }else{$thongbao='<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cảnh báo!</strong> Mật khẩu cũ không đúng.</div>';}
    }else{$thongbao='<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cảnh báo!</strong> Hãy nhập đầy đủ các trường bắt buộc.</div>';}
    }else{$thongbao='<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cảnh báo!</strong> Bạn chưa phải là chủ sở hữu website. Thao tác này không được chấp nhận!</div>';}
}
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
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel="stylesheet" href="css/admin.css"/>
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
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Đổi mật khẩu truy cập trang quảng trị</div>
        <form id="form" class="form-horizontal"  action="" method="post">
            <?php echo $thongbao; ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label"><span>*</span>Mật khẩu hiện tại:</label>
                    <div class="col-sm-8"><input class="form-control" type="password" name="passcu" /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label"><span>*</span>Mật khẩu mới:</label>
                    <div class="col-sm-8"><input class="form-control" type="password" name="passmoi"  /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nhập lại mật khẩu mới:</label>
                    <div class="col-sm-8"><input class="form-control" type="password" name="repassmoi"  /></div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><input type="submit" class="btn btn-primary" name="edit" value="ĐỔI MẬT KHẨU" /></div>
                </div>
           
        </form>
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