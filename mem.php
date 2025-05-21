<?php
session_start();
if(!isset($_COOKIE['iduser'])){
   header("Location: /");
   exit;
}
require_once('include/connect.php');
require_once('include/function.php');
$sodu=$u['vimua'];$sodu_rut=$u['virut'];
?>
 <!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>

<meta charset="UTF-8" />
<base href="<?php echo $domain?>" />
<meta name="robots" content="all" />		
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
<meta name="description" content="<?php echo $ru['des']?>"/>		
<title><?php echo $ru['tit']?></title>
<meta property="description" content="<?php echo $ru['des']?>"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $ru['tit']?>"/>
<meta property="og:image" content=""/>
<meta property="og:description" content="<?php echo $ru['des']?>"/>
<meta property="og:url" content="<?php echo lay_url()?>"/>
<meta property="og:site_name" content="<?php echo $ru['tit']?>"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $ru['des']?>" />
<meta name="twitter:title" content="<?php echo $ru['tit']?>" />
<meta name="twitter:image" content="" />	
<link rel="icon" href="/i/house.png" type="image/x-icon" />		

<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&amp;display=swap&amp;subset=vietnamese" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/j/bootstrap.min.js"></script>	
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>
<style>
body{
    background-image: url(images/bgdoinhompc2.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;
    background-attachment: fixed;
}
</style>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<script src='j/land.js'></script>
</head>
<body>
<section class="main">	
    <div class="container" style="width: 100%;">
    <?php
    if(isset($_GET['type']) and $_GET['type']=='sanpham'){
        include_once('in/market.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='account'){
        include_once('in/account.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='hethong'){
        include_once('in/hethong.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='cpanel'){
        include_once('in/cpanels.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='danhsachuser'){
        include_once('in/danhsachuser.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='danhsachnguoiquen'){
        include_once('in/danhsachnguoiquen.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='chuyends'){
        include_once('in/chuyen.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='mycart'){
        include_once('in/mycart.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='ghinho'){
        include_once('in/ghichu.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='thongbao'){
        include_once('in/thongbao.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='taichinh'){
        include_once('in/taichinh.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='donhangcht'){
        include_once('in/donhangcht.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='huongdan'){
        include_once('in/huongdan.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='chinhsach'){
        include_once('in/chinhsach.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='mod'){
        include_once('in/showmod.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='kt-danhsachtaikhoan'){
        include_once('in/kt-danhsachtaikhoan.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='taichinhkhachhang'){
        include_once('in/taichinhkhachhang.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='thongtinkhachhang'){
        include_once('in/thongtinkhachhang.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='danhsachtaikhoan'){
        include_once('in/danhsachtaikhoan.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='taotin'){
        include_once('in/taotin.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='admin'){
        include_once('in/smin.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='finance'){
        include_once('in/finance.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='quyettoan'){
        include_once('in/quyettoan.php');
    }elseif(isset($_GET['type']) and $_GET['type']=='reg'){
    ?>
    <p>&nbsp;</p>
    <div class="box-log" style="margin-top: 6%;">
        <h3><i class="fas fa-futbol"></i> Đăng ký</h3>
        <form class="formlog">
            <input class="data" type="text" value="" placeholder="Tên đăng nhập (*)" />
            <input class="data" type="password" placeholder="Mật khẩu (*)" />
            <input class="data" type="password" placeholder="Nhập lại Mật khẩu (*)" />
            <input class="data" type="text" value="" placeholder="Mã giới thiệu (*)" />
            <input class="data" type="text" value="" placeholder="Email (*)" />
            <input class="data sm" type="button" value="Đăng ký" />
            <p class="forw"><a href="/?type=login"><i class="fas fa-user-edit"></i> Đăng nhập</a> &nbsp; <a href=""><i class="fas fa-lock"></i> Quên mật khẩu</a></p>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
    }else{
    ?>
    <div class="butlg">
        <a type="button" href="/?type=login"><i class="fas fa-futbol"></i> Đăng nhập</a> <a type="button" href="/?type=reg"><i class="fas fa-futbol"></i> Đăng ký</a>
    </div>
    <?php }?>
    <?php //require_once('in/cpanel.php');?>
    </div>
</section>
<?php require_once('in/footer.php');?>
</body>
</html>