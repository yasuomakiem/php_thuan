<?
session_start();
require_once('include/connect.php');
require_once('include/function.php');
?>
  <!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>

<meta charset="UTF-8" />
<base href="https://boc.is/" />
<meta name="robots" content="all" />		
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
<meta name="description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng"/>		
<title>Trang quản trị - BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động</title>
<meta property="description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="Trang quản trị - BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động"/>
<meta property="og:image" content=""/>
<meta property="og:description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng"/>
<meta property="og:url" content="https://boc.is:443/m/taichinh/d3d9446802a44259755d38e6d163e820"/>
<meta property="og:site_name" content="Trang quản trị - BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng" />
<meta name="twitter:title" content="Trang quản trị - BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta name="twitter:image" content="" />	
<link rel="icon" href="/i/house.png" type="image/x-icon" />		

<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&amp;display=swap&amp;subset=vietnamese" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/j/bootstrap.min.js"></script>	
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>

<link href="css/css.css" rel="stylesheet" type="text/css" />
<script src='j/land.js'></script>
</head>
<body>
<section class="main">	
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left">
                <?
                $sodu=@mysqli_query($con,"select * from taichinhuser where sodu>0");$tien=0;$i=1;
                while($rsd=@mysqli_fetch_assoc($sodu)){
                    $uu=$rsd['idu'];
                    $us=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$uu"));
                    $tien=$tien+$rsd['sodu'];
                    ?>
                    <p><?=$i?>. <?=$us['fullname']?> - Số dư: <b><?=number_format($rsd['sodu'],0,',','.')?>đ</b></p>
                    
                    <?
                    $i++;
                }
                ?>
            </div>
            <h3>Tổng: <?=number_format($tien,0,',','.')?>đ</h3>
            <h3>Thành toán: <?=number_format($tien*0.98,0,',','.')?>đ <span style="font-weight: normal; font-size: 0.9em;">(Sau trừ 2% phí dịch vụ)</span></h3>
        </div>
    </div>
</section>




</body>
</html>