<?
session_start();
require_once('include/connect.php');
require_once('include/function.php');
if(isset($_GET['trangthai'])){$trangthai=$_GET['trangthai'];}else{$trangthai=-1;}
if(isset($_GET['xacnhanthanhtoan'])){
    $iddon=intval($_GET['xacnhanthanhtoan']);
    $rdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from trahoahong where id=$iddon"));
    $idu=$rdon['idu'];
    $udon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));

    //1. update lại trang thái tt
    $updon=@mysqli_query($con,"update trahoahong set trangthai=1,timethanhtoan=$time where id=$iddon");
    //2. gửi thông báo
    $bank=@mysqli_fetch_assoc(@mysqli_query($con,"select ten from bankbase where id=$rdon[bank]"));
    $tieude='Hoàn thành thanh toán #'.$rdon['ma'];
    $noidung='<p>Lệnh rút tiền #'.$rdon['ma'].' đã được xử lý</p><p>Chúng tôi đã chuyển vào Tài khoản '.$bank['ten'].' - '.$rdon['banknumber'].' của bạn số tiền <b>'.number_format($rdon['sotientra'],0,',','.').'<sup>đ</sup></b></p><p>Chúng tôi mong muốn sẽ được chuyển khoản cho bạn nhiều hơn trong những lần tiếp theo.';
    $idnhan='*'.$idu.'*';
    $idgui=1;
    $guitt=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan',N'$tieude',N'$noidung',$time)");
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/taichinhcongty.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
    exit();
}
if(isset($_GET['khongxacnhanthanhtoan'])){
    $iddon=intval($_GET['khongxacnhanthanhtoan']);
    $rdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from trahoahong where id=$iddon"));
    $idu=$rdon['idu'];
    $udon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));
    //1. update lại trang thái đơn
    $updon=@mysqli_query($con,"update trahoahong set trangthai=2 where id=$iddon");
    //2. gửi thông báo
    $tieude='Từ chối yêu cầu thanh toán #'.$rdon['ma'];
    $noidung='Lệnh yêu cầu thanh toán #'.$rdon['ma'].' đã bị từ chối, do phát hiện những dấu hiệu bất thường về số dư yêu cầu, Nếu bạn có thắc mắc hãy liên hệ trực tiếp phía công ty để được giải quyết.';
    $idnhan='*'.$idu.'*';
    $idgui=1;
    $guitt=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan',N'$tieude',N'$noidung',$time)");
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/taichinhcongty.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
    exit();
}
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
	<title>Quản lý đơn hàng - Tài chính</title>
<!-- This site is optimized with the Yoast SEO plugin v4.5 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động"/>
<meta name="robots" content="noodp"/>
<link rel="canonical" href="https://boc.is/" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:locale:alternate" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Quản lý đơn hàng - Tài chính" />
<meta property="og:description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta property="og:url" content="https://boc.is/" />
<meta property="og:site_name" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta property="og:image" content="https://boc.is/images/taichinhdoanhnghiep.jpg" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="BOC - Business On Chain - Nền tảng kinh doanh trực tuyến thông minh tạo thu nhập thụ động" />
<meta name="twitter:title" content="Quản lý đơn hàng - Tài chính" />
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
                <div style="margin-bottom: 15px;border-bottom: 0px solid #c3c3c3;"><span class="baoi"><i class="far fa-calendar-alt"></i></span> Tháng tái chính: 
                <form class="ttc" action="<?=$linkgoc?>" method="get">
                <input type="hidden" name="type" value="<?=$_GET['type']?>" />
                <input type="hidden" name="trangthai" value="<?=$trangthai?>" />
                <select name="m">
                    <option <?if(isset($_GET['m']) and $_GET['m']=='01'){echo 'selected=""';}elseif(date('m')=='01'){echo 'selected=""';}?>>01</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='02'){echo 'selected=""';}elseif(date('m')=='02'){echo 'selected=""';}?>>02</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='03'){echo 'selected=""';}elseif(date('m')=='03'){echo 'selected=""';}?>>03</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='04'){echo 'selected=""';}elseif(date('m')=='04'){echo 'selected=""';}?>>04</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='05'){echo 'selected=""';}elseif(date('m')=='05'){echo 'selected=""';}?>>05</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='06'){echo 'selected=""';}elseif(date('m')=='06'){echo 'selected=""';}?>>06</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='07'){echo 'selected=""';}elseif(date('m')=='07'){echo 'selected=""';}?>>07</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='08'){echo 'selected=""';}elseif(date('m')=='08'){echo 'selected=""';}?>>08</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='09'){echo 'selected=""';}elseif(date('m')=='09'){echo 'selected=""';}?>>09</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='10'){echo 'selected=""';}elseif(date('m')=='10'){echo 'selected=""';}?>>10</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='11'){echo 'selected=""';}elseif(date('m')=='11'){echo 'selected=""';}?>>11</option>
                    <option <?if(isset($_GET['m']) and $_GET['m']=='12'){echo 'selected=""';}elseif(date('m')=='12'){echo 'selected=""';}?>>12</option>
                </select>
                Năm 
                <select name="y">
                    <option <?if(isset($_GET['y']) and $_GET['y']=='2023'){echo 'selected=""';}elseif(date('Y')=='2023'){echo 'selected=""';}?>>2023</option>
                    <option <?if(isset($_GET['y']) and $_GET['y']=='2024'){echo 'selected=""';}elseif(date('Y')=='2024'){echo 'selected=""';}?>>2024</option>
                </select>
                <input type="submit" value="GO" name="date" />
                </form>
                </div>
            </div>
                <?if($trangthai!=5){?><h4>Danh sách lệnh:</h4><?}?>
                <div class="row">
        <div class="col-md-12 col-xs-12 but">
        <a type="button" class="btn btn-<?if($trangthai==-1){echo 'primary';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=all">Tất cả <span>(<?=$soluong?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==0 and $_GET['type']=='user'){echo 'primary ';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=user&trangthai=0">User chờ thanh toán <span>(<?=$soluongu0?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==0 and $_GET['type']=='system'){echo 'primary';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=system&trangthai=0">Hệ thống chờ thanh toán <span>(<?=$soluongs0?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==1){echo 'primary';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=all&trangthai=1">Đã hoàn thành <span>(<?=$soluong1?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==2){echo 'primary';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=all&trangthai=2">Từ chối thanh toán <span>(<?=$soluong2?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==5){echo 'primary';}else{echo 'default';}?> btn-xs" href="taichinhcongty.php?type=all&trangthai=5">Tiền còn hệ thống</a>
        <p>&nbsp;</p>
        <?if($trangthai==5){?><h4>Danh sách thành viên:</h4>
        <p>Tổng số tiền còn trong hệ thống: <b id="tiencon"></b></p>
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">Thành viên</th>
                    <th style="padding-left: 0;">SĐT</th>
                    <th style="padding-left: 0;">Số tiền còn lại</th><th style="padding-left: 0;">Kiểm tra</th>
                </tr>
                <?
                $timtcu=@mysqli_query($con,"select * from taichinhuser where sodu>0");$tc=0;
                while($rd=@mysqli_fetch_assoc($timtcu)){
                    $idthanhvien=$rd['idu'];
                    $tc=$tc+$rd['sodu'];
                    $tv=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idthanhvien"));
                     ?>
                     <tr>
                        <td style="padding: 8px;">
                        
                            <p><i class="fas fa-user"></i> <?=$tv['fullname']?></p>
                            
                            
                            <div class="clearfix"></div>
                     
                        </td>
                        <td><p><i class="fas fa-phone-volume"></i> <?=$tv['phone']?></p></td>
                        <td style="padding: 10px 0;max-width: 350px;">
                            
                            <p>Tổng tiền: <b style="color: red;"><?=number_format($rd['sodu'],0,',','.')?><sup>đ</sup></b></p>
                            
                        </td>
                        <td><p><a type="button" target="_blank" class="btn btn-default btn-xs" href="checktien.php?idu=<?=$tv['id']?>">Kiểm tra tài chính</a></p></td>
                     </tr>
                     <?  
                    }
                ?>
            </table>
            <script type="text/javascript">
            $(function() {
                $('b#tiencon').html('<?=number_format($tc,0,',','.')?><sup>đ</sup>');
            });        
            </script>
        </div>
        <?}else{?>
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">Đối tượng</th>
                    <th style="padding-left: 0;">Yêu cầu thanh toán</th>
                    <th style="padding-left: 0;max-width: 350px;">Tài khoản nhận</th>
                    <th style="padding-left: 0;">Trạng thái</th>
                </tr>
                <?
                
                while($rd=@mysqli_fetch_assoc($don)){
                    $idthanhvien=$rd['idu'];
                    $tv=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idthanhvien"));
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                        
                            <p><i class="fas fa-user"></i> <?=$tv['fullname']?></p>
                            <p><i class="fas fa-phone-volume"></i> <?=$tv['phone']?></p>
                            <p><a type="button" target="_blank" class="btn btn-default btn-xs" href="checktien.php?idu=<?=$tv['id']?>">Kiểm tra tài chính</a></p>
                            <div class="clearfix"></div>
                     
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p>Mã lệnh: <b>#<?=$rd['ma']?></b></p>
                            <p>Tổng tiền: <b style="color: red;"><?=number_format($rd['sotientra'],0,',','.')?><sup>đ</sup></b></p>
                            <p>Time: <?=retimefull($rd['time'])?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <?$bank=@mysqli_fetch_assoc(@mysqli_query($con,"select ten from bankbase where id=$rd[bank]"));?>
                            <p>Ngân hàng: <?=$bank['ten']?></p>
                            <p>STK: <?=$rd['banknumber']?></p>
                            <p>CTK: <?=$rd['chutaikhoan']?></p>
                        </td>
                        <td style="padding: 15px 0;text-align: center;">
                            <?
                            if($rd['trangthai']==0){//đa thanh toán chờ xác nhận
                            ?>
                            <a type="button" class="btn btn-warning btn-xs" href="taichinhcongty.php?xacnhanthanhtoan=<?=$rd['id']?>" onclick="return confirm('Chỉ xác nhận sau khi chuyển thành công tiền vào tài khoản người nhận, xác nhận?')">Xác nhận thanh toán?</a>
                            <p style="font-size: 0.8em; font-style: italic;"></p>
                            <a type="button" class="btn btn-danger btn-xs" href="taichinhcongty.php?khongxacnhanthanhtoan=<?=$rd['id']?>" onclick="return confirm('Từ chối xác nhận khi có dấu hiệu bất thường, từ chối?')">Từ chối thanh toán?</a>
                            <?    
                            }elseif($rd['trangthai']==1){//đa gửi hàng
                            ?>
                            <button type="button" class="btn btn-success btn-xs">Đã thanh toán</button>
                            <?
                            }elseif($rd['trangthai']==2){//đa nhận hàng, hoàn thành
                            ?>
                            <button type="button" class="btn btn-danger btn-xs">Từ chối thanh toán</button>
                            <?    
                            }
                            ?>
                        </td>
                        <script>
                        
                        </script>
                     </tr>
                     <?  
                    }
                ?>
            </table>
            <script type="text/javascript">
            $(function() {
                $('b#tongtien').html('<?=number_format($tongtien,0,',','.')?><sup>đ</sup>');
                $('#tongdiem').html('<?=number_format($tongdiem,0,',','.')?>');
            });
            function updatedon(iddon){
                $('.drop').show();
                $('#upiddon').val(iddon);
                $('.formupdon').slideDown();
            }
            function closedrop(){
                $('.drop').hide();
                $('.formupdon').slideUp();
            }
            
            </script>
        </div>
        <?}?>
        </div>
        <div class="clearfix"></div>
        </div>
        </div>
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-offset-1 formupdon">
            <h4 class="titqt">Cập nhật đơn hàng</h4>
            <form role="form">
              <div class="form-group">
                <input type="hidden" id="upiddon" />
                <label for="exampleInputEmail1">Mã vận đơn</label>
                <input type="text" class="form-control" id="mavandon" placeholder="">
              </div>
          <button type="button" id="capnhatmavd" class="btn btn-primary">Cập nhật</button> <span id="mvd" style="font-size: 0.8em; color: #14B124;"></span>
        </form>
        <script>
        $('#capnhatmavd').click(function(){
                var upiddon=$('#upiddon').val();
                var mavandon=$('#mavandon').val();
                if(mavandon==''){
                    alert('Không được để trống');
                    $('#mavandon').focus();
                }else{
                    $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'mavandon',
                            upiddon : upiddon,
                            mavandon : mavandon
                        },
                        success : function (result){
                            $('#mvd').html('Đã cập nhật mã vận đơn');
                            setTimeout(function(){
                                window.location="taichinhcongty.php"; 
                            }, 1000);
                        }
                    });
                }
            })
        </script>
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
