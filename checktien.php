<?
session_start();
require_once('include/connect.php');
require_once('include/function.php');
if(isset($_GET['idu'])){$idu=intval($_GET['idu']);}else{exit();}
$rkt=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));
?>
 <!DOCTYPE html>
<html >
<head>
    <base href="<?=$domain?>" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- ANTS Insight meta -->
	<meta name="adx:sections" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
		<!-- End of ANTS Insight meta -->
	<link rel="shortcut icon" href="upload/favicon/1670464903bbb.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="css/jquery-ui.css">
	<title>Kiểm tra Tài chính</title>
<!-- This site is optimized with the Yoast SEO plugin v4.5 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động"/>
<meta name="robots" content="noodp"/>
<link rel="canonical" href="https://boc.is/" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:locale:alternate" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Kiểm tra Tài chính" />
<meta property="og:description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta property="og:url" content="https://boc.is/" />
<meta property="og:site_name" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta property="og:image" content="https://boc.is/images/taichinhdoanhnghiep.jpg" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta name="twitter:title" content="Kiểm tra Tài chính" />
<meta name="twitter:image" content="https://boc.is/images/taichinhdoanhnghiep.jpg" />
<link rel='stylesheet' id='menu-image-css'  href='css/menu-image.css?ver=1.1' type='text/css' media='all' />
<link rel='stylesheet' id='popup-maker-site-css'  href='css/site.min.css?ver=1.5.7' type='text/css' media='all' />
<link rel='stylesheet' id='wpsl-styles-css'  href='css/styles.min.css?ver=2.2.7' type='text/css' media='all' />
<link rel='stylesheet' id='forms-for-campaign-monitor-custom_cm_monitor_css-css'  href='css/app.css?ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href='css/style.css?ver=4.7.3' type='text/css' media='all' />
<link rel='stylesheet' id='mCustomcss-css'  href='css/jquery.mCustomScrollbar.css?ver=4.7.3' type='text/css' media='all' />
<script type='text/javascript' src='js/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='js/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='js/addons.js?ver=0.1'></script>
<link rel='stylesheet' id='siteorigin-widgets-css'  href='css/style2.css?ver=1.8.1' type='text/css' media='all' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script type='text/javascript' src='js/main.js?ver=0.1'></script>
<script type='text/javascript' src='js/jquery.mCustomScrollbar.concat.min.js?ver=0.1'></script>
<script type='text/javascript' src='js/add.js?ver=0.1'></script>
<script type='text/javascript' src='js/z.min.js?ver=0.1'></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=vietnamese" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 </head>
<body style="padding-top: 0;">
<style>
.het{
    background: brown;
    color: white;
    margin-bottom: 15px;
    padding-bottom: 8px;
    padding-top: 8px;
}
.titqt{
    font-size: 14px;
    padding-bottom: 10px;
    position: relative;
}
.titqt:after{
    content: "";
    display: block;
    height: 2px;
    width: 60px;
    background: #2888da;
    position: absolute;
    left: 0;
    bottom: -1px;
}
@media (max-width: 768px){
.formupdon{
    top: 70px;
    width: 80%;
    margin-left: 10%;
}
}
</style>
<section class="het">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?$donthanhtoan=@mysqli_num_rows(@mysqli_query($con,"select id from trahoahong where trangthai=0"));?>
                <h4 style="color: yellow;"><i class="fas fa-hand-holding-usd"></i> Yêu cầu rút tiền <sup id="donchoduyet">(<?=$donthanhtoan?>)</sup> 
                <?
                $soluongdon=@mysqli_num_rows(@mysqli_query($con,"select id from dh_donhang where trangthai=1"));
                ?>
                <a href="congty.php"><span style="color: silver;font-weight: normal;font-size: 0.9em;padding-left: 30px;"><i class="fas fa-layer-group"></i> Tài chính đơn hàng <sup>(<?=$soluongdon?>)</sup></span></a></h4>
            </div>
        </div>
    </div>
</section>
<?if(!isset($_SESSION['boc'])){?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form" action="sscongty.php" method="post">
                  <div class="form-group">
                
                    <label for="exampleInputPassword1">Mật khẩu quản trị</label>
                
                    <input type="password" name="boc" class="form-control" id="exampleInputPassword1" placeholder="Password">
                
                  </div>
                  <button type="submit" name="ssboc" class="btn btn-default">Submit</button>
                
                </form>
            </div>
        </div>
    </div>
</section>
<?}else{
    if($trangthai==-1){$dieukien='where 1=1';$linkgoc='/taichinhcongty.php?type=all&trangthai=-1';}
    if($trangthai==0){
        if($_GET['type']=='user'){
            $dieukien='where trangthai=0 and loai=0';$linkgoc='/taichinhcongty.php?type=user&trangthai=0';
        }else{
            $dieukien='where trangthai=0 and loai=1';$linkgoc='/taichinhcongty.php?type=system&trangthai=0';
        }
    }
    if($trangthai==1){$dieukien='where trangthai=1';$linkgoc='/taichinhcongty.php?type=all&trangthai=1';}
    if($trangthai==2){$dieukien='where trangthai=2';$linkgoc='/taichinhcongty.php?type=all&trangthai=2';}
    if(isset($_GET['date'])){
        $dieukientime=" and thang = ".intval($_GET['m'])." and nam = ".intval($_GET['y']);
    }else{
        $dieukientime="";
    }
    $don=@mysqli_query($con,"select * from trahoahong $dieukien $dieukientime order by time desc");
    $soluong=@mysqli_num_rows(@mysqli_query($con,"select * from trahoahong where id>0 $dieukientime order by time desc"));
    $soluongu0=@mysqli_num_rows(@mysqli_query($con,"select * from trahoahong where trangthai=0 and loai=0 $dieukientime order by time desc"));
    $soluongs0=@mysqli_num_rows(@mysqli_query($con,"select * from trahoahong where trangthai=0 and loai=1 $dieukientime order by time desc"));
    $soluong1=@mysqli_num_rows(@mysqli_query($con,"select * from trahoahong where trangthai=1 $dieukientime order by time desc"));
    $soluong2=@mysqli_num_rows(@mysqli_query($con,"select * from trahoahong where trangthai=2 $dieukientime order by time desc"));
    ?>
<style>
.but .btn-primary span{color: yellow;}
.but .btn-default span{color: red;}
.taichinh{
    padding: 15px 15px 10px 15px;
    background: aliceblue;
    border-radius: 10px;
    margin-bottom: 25px;
}
span.baoi{
    width: 20px;
    text-align: center;
    display: inline-block;
}
form.ttc{float: right;}
form.ttc input[type="submit"]{
    font-size: 0.7em;
    margin: 0;
    border: 0;
    background: #2196f3;
    color: white;
    height: 21px;
    margin-top: -1px;
    display: block;
    float: right;
    margin-left: 6px;
}
</style>
<section class="listdong">
    <div class="container" style="position: relative;">
        <div class="row">
            <div class="col-md-12">
            <div class="taichinh" style="padding-bottom: 1px;">
                <div style="margin-bottom: 15px;border-bottom: 0px solid #c3c3c3;"><span class="baoi"><i class="fas fa-user-check"></i></span> Thu nhập thành viên: <b><?=$rkt['fullname']?></b> 
                <a style="float: right;" href="/taichinhcongty.php"><i class="fas fa-reply"></i> Trở lại</a>
                </div>
            </div>

                <div class="row">
        <div class="col-md-12 col-xs-12 but">
        <p>&nbsp;</p>
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">Thời gian</th>
                    <th style="padding-left: 0;">Khoản mục</th>
                    <th style="padding-left: 0; text-align: right;">Số tiền</th>
                    
                </tr>
                <?
                for($m=1;$m<=$thang;$m++){
                    $tcu=@mysqli_fetch_assoc(@mysqli_query($con,"select * from taichinhuser where idu=$idu and thang=$m and nam=$nam"));
                    $diemthang=$tcu['diemthang'];
                    $f1=@mysqli_query($con,"select id from dh_user where idgioithieu=$idu");
                    $dsf1=0;$dsf2=0;
                    if($m<10){$textthang='0'.$m;}else{$textthang=$m;}
                        $dau=$nam.$textthang.'00000000';$dau=intval($dau);
                    if($m==$thang){
                        $cuoi=intval($time);
                    }else{
                        $cuoi=$nam.$textthang.'32000000';$cuoi=intval($cuoi);
                    }
                    while($rf1=@mysqli_fetch_assoc($f1)){
                        $idf1=$rf1['id'];
                        $tongdonf1=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(diem) AS tongdiemf1 from dh_donhang where iduser=$idf1 and trangthai>1 and (timexacnhan>=$dau and timexacnhan<=$cuoi)"));
                        $dsf1=$dsf1+$tongdonf1['tongdiemf1'];
                        $f2=@mysqli_query($con,"select id from dh_user where idgioithieu=$idf1");
                        while($rf2=@mysqli_fetch_assoc($f2)){
                            $idf2=$rf2['id'];
                            $tongdonf2=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(diem) AS tongdiemf2 from dh_donhang where iduser=$idf2 and trangthai>1 and (timexacnhan>=$dau and timexacnhan<=$cuoi)"));
                            $dsf2=$dsf2+$tongdonf2['tongdiemf2'];
                        }
                    }
                    $be=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(doanhso) AS tongdoanhso from dh_donhang where trangthai>1 and (timexacnhan>=$dau and timexacnhan<=$cuoi)"));
                    $tongdoanhso=$be['tongdoanhso'];
                    if($u['id']==2 or $u['id']==3){
                        $sodu=number_format(($dsf1*0.5+$dsf2*0.1)*10000,0,',','.');
                        $sodutaikhoan=intval($dsf1*0.5+$dsf2*0.1)*10000;
                        $hhf1=$dsf1*0.5*10000;
                    }else{
                        $sodu=number_format(($dsf1*0.4+$dsf2*0.1)*10000,0,',','.');
                        $sodutaikhoan=intval($dsf1*0.4+$dsf2*0.1)*10000;
                        $hhf1=$dsf1*0.4*10000;
                    }
                    $hhf2=$dsf2*0.1*10000;
                    $taichinhuser=@mysqli_fetch_assoc(@mysqli_query($con,"select * from taichinhuser where idu=$idu and thang=$thang and nam=$nam"));
                    //$sodutaikhoan=$taichinhuser['sodu'];
                    //$sodu=number_format($sodutaikhoan,0,',','.');
                    //$hhf1=$taichinhuser['f1thang'];
                    //$hhf2=$taichinhuser['f2thang'];
                    //tim doitien chuyen sang
                    $bdoi=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(f1) AS doitienf1 from doitien where idtoi=$idu and thang=$m and nam=$nam"));
                    $brut=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotienrut) AS rut from trahoahong where idu=$idu and thang=$m and nam=$nam"));
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                            <p><i class="far fa-clock"></i> Tháng <?=$m?> năm <?=$nam?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                        <?if($idu>3){?><p>Doanh số cá nhân: <?=$diemthang?> điểm</p><?}?>
                            <p>Hoa hồng F1 <a type="button" class="btn btn-default btn-xs" onclick="hhf1(<?=$idu?>,<?=$m?>)">Xem chi tiết</a></p>
                            <p>Hoa hồng F2 <a type="button" class="btn btn-default btn-xs" onclick="hhf2(<?=$idu?>,<?=$m?>)">Xem chi tiết</a></p>
                            <p>Hoa hồng F2* (Khi f1 không đủ ĐK) <a type="button" class="btn btn-default btn-xs" onclick="doitien(<?=$idu?>,<?=$m?>)">Xem chi tiết</a></p></p>
                            <p>Lệnh rút tiền (Tiền nhận/tiền bị trừ)</p>
                            
                        </td>
                        <td style="padding: 15px 0; text-align: right;">
                        <?if($idu>3){?><p>&nbsp;</p><?}?>
                            <p><?=number_format($hhf1,0,',','.')?></p>
                            <p><?=number_format($hhf2,0,',','.')?></p>
                            <p><?=number_format($bdoi['doitienf1'],0,',','.')?></p>
                            <p><?echo '<b>'.number_format(-$brut['rut']*0.97,0,',','.').'</b> / '.number_format($brut['rut'],0,',','.');?></p>
                            
                        </td>
                        
                        
                     </tr>
                     <?  
                   
                    }
                ?>
                <tr>
                        <th style="padding: 15px 10px; text-align: right;" colspan="2">
                            <p>Số dư cuối</p>
                        </th>
                        <td style="padding: 15px 0; text-align: right; color: red;">
                            <b><?=number_format($taichinhuser['sodu'],0,',','.')?></b>
                        </td>
                </tr>
            </table>
            <script type="text/javascript">
            function updatedon(iddon){
                $('.drop').show();
                $('#upiddon').val(iddon);
                $('.formupdon').slideDown();
            }
            function closedrop(){
                $('.drop').hide();
                $('.formupdon').slideUp();
                $('.formupdon').html('');
            }
            function hhf1(idu,thang){
                $('.drop').show();
                $('.formupdon').slideDown();
                $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'kiemtrahhf1',
                            idu : idu,
                            thang : thang
                        },
                        success : function (result){
                            $('.formupdon').html(result);
                        }
                    });
            }
            function hhf2(idu,thang){
                $('.drop').show();
                $('.formupdon').slideDown();
                $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'kiemtrahhf2',
                            idu : idu,
                            thang : thang
                        },
                        success : function (result){
                            $('.formupdon').html(result);
                        }
                    });
            }
            function doitien(idu,thang){
                $('.drop').show();
                $('.formupdon').slideDown();
                $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'kiemtradoitien',
                            idu : idu,
                            thang : thang
                        },
                        success : function (result){
                            $('.formupdon').html(result);
                        }
                    });
            }
            </script>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>
        </div>
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-offset-1 formupdon">
        </div>
        </div>
    </div>
<style>
.drop{
    background: #2423239e;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0 ;
    left: 0;
    z-index: 100;
    display: none;
}
.formupdon{
    background: white;
    z-index: 101;
    border-radius: 10px;
    margin-top: 40px;
    padding: 10px 15px 20px 15px;
    display: none;
    position: absolute;
}
</style>
<div class="drop" onclick="closedrop()">
</div>
</section>
<?}?>
</body>
</html>
