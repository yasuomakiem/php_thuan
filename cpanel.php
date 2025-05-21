<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
//require_once('include/session.php');
if(!isset($_COOKIE['iduser']) or ($_COOKIE['iduser']!=1 and $_COOKIE['iduser']!=887)){exit();}
$tim="select * from dh_user where id=$iduser";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
if(isset($_POST['capnhat'])){

    $tendoanhnghiep=addslashes($_POST['tendoanhnghiep']);
    $address=addslashes($_POST['address']);
    $updomain=addslashes($_POST['domain']);
    $codinh=addslashes($_POST['codinh']);
    $phone=addslashes($_POST['phone']);
    $email=addslashes($_POST['email']);
    $facecn=addslashes($_POST['facecn']);
    $facebook=addslashes($_POST['facebook']);
    $viettatteam=addslashes($_POST['viettatteam']);
    $youtube=addslashes($_POST['youtube']);
    $t1=addslashes($_POST['t1']);
    $t8=addslashes($_POST['t8']);
    
    $tiente=$_POST['tiente'];
    if($_FILES['image']['name']){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/favicon/".$tenanh);
     }else{$tenanh=$r['favicon'];}
     if($_FILES['imgmxh']['name']){
        $imgmxh=$_FILES['imgmxh']['name'];
        $imgmxh = preg_replace('/[^a-zA-Z0-9.]/','-',$imgmxh);
        $imgmxh=time().$imgmxh;
        move_uploaded_file($_FILES['imgmxh']['tmp_name'],"upload/favicon/".$imgmxh);
     }else{$imgmxh=$r['imgmxh'];}
    $tit=addslashes($_POST['tit']);
    $tukhoa=addslashes($_POST['tukhoa']);
    $spitem=intval($_POST['spitem']);
    $des=strip_tags($_POST['des'],'');
    
    $up="update dh_user set tendoanhnghiep=N'$tendoanhnghiep' where id=$_COOKIE[iduser]";
    $qup=@mysqli_query($con,$up);
    if($qup){
        $tim2="select * from dh_user where id=1";$q=@mysqli_query($con,$tim2);$r=@mysqli_fetch_assoc($q);
        $thongbao="<tr><th></th><td style='color:blue'>Cập nhật thông tin thành công!</td></tr>";
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>".$up;}
    
}
$tit='Hệ thống quản trị Admin';
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
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='js/bootstrap.min.js'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
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
    <div  class="col-md-12 col-xs-12 conleft">
    <style>
    .listitem{text-align: center;margin-bottom: 40px;}
    .listitem img{width: 35%; margin: 10px auto 15px;}
    .listitem p{font-weight: bold;}
    .listitem a{font-size: 13px; color: #333;}
    .listitem a:hover{color: #FF8000; text-decoration: none;}
    </style>
        <div class="tit">Cpanel Main</div>
        <div class="row">
            <!--div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="webinar.php"><img src="images/youtube.png" /><p>Cài đặt Webinar</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="landing.php"><img src="images/landing.png" /><p>Cài đặt Landing Page</p></a></div-->
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="admin.php"><img src="images/settings.png" /><p>Cài đặt hệ thống</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="naptien.php"><img src="images/recharge.png" /><p>Nạp tiền hệ thống</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="taouser.php"><img src="images/focus-group.png" /><p>Quản lý Thành viên</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds-sanpham.php"><img src="images/product-chain.png" /><p>Danh sách sản phẩm</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="thongbao.php"><img src="images/loa.png" /><p>Thông báo hệ thống</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a target="_blank" href="/m/quyettoan/"><img src="images/ruttien.png" /><p>Yêu cầu rút tiền</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="docquyen.php"><img src="images/docquyen.png" /><p>Độc quyền khu vực</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=1"><img src="images/vlogging.png" /><p>Đào tạo sản phẩm</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=2"><img src="images/click-bait.png" /><p>Đào tạo kỹ năng</p></a></div>
            <!--div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=3"><img src="images/instagram.png" /><p>Thư viện media</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=4"><img src="images/gavel.png" /><p>Thư viện pháp lý</p></a></div-->
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=8"><img src="images/notes.png" /><p>Hỏi đáp hệ thống</p></a></div>
            
            <!--div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=7"><img src="images/viral-marketing.png" /><p>Marketing online</p></a></div-->
            
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=9"><img src="images/huongdan.png" /><p>Hướng dẫn kỹ thuật</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=6"><img src="images/feedback.png" /><p>Feedback Media</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem"><a href="ds_mod.php?id=5"><img src="images/quytrinh.png" /><p>Thư viện quy trình</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem" <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="ds-donhang.php"><img src="images/donhang.png" /><p>Quản lý đơn hàng</p></a></div>
            <div class="col-md-2 col-sm-4 col-xs-6 listitem" <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="doi-mat-khau.php"><img src="images/matkhau.png" /><p>Đổi mật khẩu</p></a></div>
        </div>
    </div>
    
    </div>
</div>
</section>
<section class="afooter">
    <?php  require_once('sup-admin/footer.php'); ?>
</section>
</body>
</html>