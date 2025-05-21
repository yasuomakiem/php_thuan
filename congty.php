<?
session_start();
require_once('include/connect.php');
require_once('include/function.php');
if(isset($_GET['trangthai'])){$trangthai=$_GET['trangthai'];}else{$trangthai=-1;}
if(isset($_GET['xacnhanthanhtoan'])){
    $iddon=intval($_GET['xacnhanthanhtoan']);
    $rdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_donhang where id=$iddon"));
    $idu=$rdon['iduser'];
    $udon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));
    $cart=explode("*",$rdon['idsoluong']);
    $tongdiem=0;
    $tongtien=0;
    $tongdoanhso=0;
    for($i=0;$i<count($cart);$i++){
            $idsoluong=explode("-",$cart[$i]);
            $idsp=$idsoluong[0];
            $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
            $tongdiem=$tongdiem+ $ttsp['diem']*$idsoluong[1];
            $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
            $tongdoanhso=$tongdoanhso+ $ttsp['doanhso']*$idsoluong[1];
    }
    $congty=$tongdoanhso*0.15;
    $be2=$tongdoanhso*0.02;
    $be3=$tongdoanhso*0.03;
    $be4=$tongdoanhso*0.04;
    $intcct=@mysqli_query($con,"insert into taichinh (iddon,idu,doanhso,congty,marketing,be1,be2,be3,be4,be5,be6,be7,thang,nam,time,times)value($iddon,$idu,$tongdoanhso,$congty,$congty,$be2,$be2,$be2,$be3,$be3,$be4,$be4,$thang,$nam,$time,$times)");//tai chính công ty
    $ttaichinh=@mysqli_query($con,"select * from taichinhuser where idu=$idu");
    if(@mysqli_num_rows($ttaichinh)==0){
        $intc=@mysqli_query($con,"insert into taichinhuser (idu,thang,nam,diemthang)value($idu,$thang,$nam,$tongdiem)");
        if($tongdiem>=50){
            $uptt=@mysqli_query($con,"update dh_user set vip=1 where id=$idu");
        }
    }else{
        $intc=@mysqli_query($con,"update taichinhuser set diemthang=diemthang+$tongdiem where idu=$idu and thang=$thang and nam=$nam");
        $ttaichinhnew=@mysqli_fetch_assoc(@mysqli_query($con,"select diemthang from taichinhuser where idu=$idu and thang=$thang and nam=$nam"));
        if($ttaichinhnew['diemthang']>=50 and $udon['vip']<1){
            $uptt=@mysqli_query($con,"update dh_user set vip=1 where id=$idu");
        }
    }
    //1. update lại trang thái đơn
    $updon=@mysqli_query($con,"update dh_donhang set trangthai=2,timexacnhan=$time where id=$iddon");
    //2. gửi thông báo
    $tieude='Xác nhận đơn hàng #BOC'.$iddon;
    $noidung='Đơn hàng #BOC'.$iddon.' đã được xác nhận thanh toán, chúng tôi đang tiến hành đóng gói hàng hóa. Bạn hãy kiểm tra trạng thái đơn hàng trong mục "Đơn hàng của bạn" trên menu quản trị trong tài khoản thành viên trên hệ thống ';
    $idnhan='*'.$udon['id'].'*';
    $idgui=1;
    $guitt=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan',N'$tieude',N'$noidung',$time)");
    //2. gửi thông báo Upline 1
    $idup1=$udon['idgioithieu'];
    $udon1=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup1"));
    $tieude1='Đơn hàng #BOC'.$iddon.' của '.$udon['fullname'].'(F1)';
    $noidung1='Đơn hàng #BOC'.$iddon.' của '.$udon['fullname'].'(F1) đã được xác nhận thanh toán với Doanh số '.number_format($rdon['doanhso'],0,',','.').'<sup>đ</sup>, Điểm là '.number_format($rdon['diem'],0,',','.').'. Hoa hồng đã được cộng vào tài khoản của bạn';
    $idnhan1='*'.$idup1.'*';
    $idgui=1;
    $guitt1=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan1',N'$tieude1',N'$noidung1',$time)");
    $tdieukien=@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup1 and thang=$thang and nam=$nam");
    $dkdiem1=@mysqli_fetch_assoc($tdieukien);
    if(@mysqli_num_rows($tdieukien)==0){
        $intc1=@mysqli_query($con,"insert into taichinhuser (idu,thang,nam)value($idup1,$thang,$nam)");
        $tdieukien=@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup1 and thang=$thang and nam=$nam");
        $dkdiem1=@mysqli_fetch_assoc($tdieukien);
    }
    if($idup1<=3){ 
        $tienf1=$tongdoanhso*0.5;
        $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf1,f1=f1+$tienf1,tongthu=tongthu+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
    }else{
        $tienf1=$tongdoanhso*0.4;
        if($dkdiem1['diemthang']>=50){
            $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf1,f1=f1+$tienf1,tongthu=tongthu+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
        }else{
            $intc=@mysqli_query($con,"update taichinhuser set f1tam=f1tam+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
            //nếu chưa đủ điểm kiện điểm thì tiền cộng tạm vào sodu_tam , tiền f1 tháng vẫn cộng, điểm 5 tầng, Nhưng khi đủ điều kiện thì cộng số dư và tổng thu, f1
        }
    }
    //2. gửi thông báo
    $idup2=$udon1['idgioithieu'];
    if($idup2!=1){
    $udon2=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup2"));
    $tieude2='Đơn hàng #BOC'.$iddon.' của '.$udon['fullname'].'(F2)';
    $noidung2='Đơn hàng #BOC'.$iddon.' của '.$udon['fullname'].'(F2) đã được xác nhận thanh toán với Doanh số '.number_format($rdon['doanhso'],0,',','.').'<sup>đ</sup>, Điểm là '.number_format($rdon['diem'],0,',','.').'. Hoa hồng đã được cộng vào tài khoản của bạn';
    $idnhan2='*'.$idup2.'*';
    $idgui=1;
    $guitt2=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan2',N'$tieude2',N'$noidung2',$time)");
    $dkdiem2=@mysqli_fetch_assoc(@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup2 and thang=$thang and nam=$nam"));
    if($idup2<=3){
        $tienf2=$tongdoanhso*0.1;
        $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf2,f2=f2+$tienf2,tongthu=tongthu+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
    }else{
        $tienf2=$tongdoanhso*0.1;
        if($dkdiem2['diemthang']>=100){
            $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf2,f2=f2+$tienf2,tongthu=tongthu+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
        }else{
            $intc=@mysqli_query($con,"update taichinhuser set f2tam=f2tam+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
            //nếu chưa đủ điểm kiện điểm thì tiền cộng tạm vào sodu_tam , tiền f2 tháng vẫn cộng, điểm 5 tầng, Nhưng khi đủ điều kiện thì cộng số dư và tổng thu, f2
        }
    }
    //tim f3 de cong 5 tang
    $idup3=$udon2['idgioithieu'];
    if($idup3!=1){
    $udon3=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup3"));
    $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup3 and thang=$thang and nam=$nam");
    //tim f4 de cong 5 tang
        $idup4=$udon3['idgioithieu'];
        if($idup4!=1){
        $udon4=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup4"));
        $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup4 and thang=$thang and nam=$nam");
        //tim f5 de cong 5 tang
            $idup5=$udon4['idgioithieu'];
            if($idup5!=1){
            $udon5=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup5"));
            $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup5 and thang=$thang and nam=$nam");
            //tim f5 de cong 5 tang
            }
        }
    }
    }
    //doan nay cap nhat lai trang thai xem tai khaon du yeu cau dieu kien thi cho no huong sodu
    $loadtaichinhf1=@mysqli_query($con,"select * from taichinhuser where f1tam>0 and diemthang>=50");
    if(@mysqli_num_rows($loadtaichinhf1)>0){
        while($rtcus=@mysqli_fetch_assoc($loadtaichinhf1)){
            $capnhatf1=@mysqli_query($con,"update taichinhuser set sodu=sodu+f1tam, tongthu=tongthu+f1tam, f1tam=0 where id=$rtcus[id]");
        }
    }
    //doan nay cap nhat lai trang thai xem tai khaon du yeu cau dieu kien thi cho no huong sodu
    $loadtaichinhf2=@mysqli_query($con,"select * from taichinhuser where f2tam>0 and diemthang>=100");
    if(@mysqli_num_rows($loadtaichinhf2)>0){
        while($rtcus2=@mysqli_fetch_assoc($loadtaichinhf2)){
            $capnhatf2=@mysqli_query($con,"update taichinhuser set sodu=sodu+f2tam, tongthu=tongthu+f2tam, f2tam=0 where id=$rtcus2[id]");
        }
    }
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/congty.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
    exit();
}
if(isset($_GET['xacnhanthanhtoanlai'])){
    $iddon=intval($_GET['xacnhanthanhtoanlai']);
    $rdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_donhang where id=$iddon"));
    $idu=$rdon['iduser'];
    $updon=@mysqli_query($con,"update dh_donhang set trangthaitam=1 where id=$iddon");
    //bỏ sung thêm tinh doán đơn hàng
    $cart=explode("*",$rdon['idsoluong']);
    $tongdiem=0;
    $tongtien=0;
    $tongdoanhso=0;
    for($i=0;$i<count($cart);$i++){
            $idsoluong=explode("-",$cart[$i]);
            $idsp=$idsoluong[0];
            $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
            $tongdiem=$tongdiem+ $ttsp['diem']*$idsoluong[1];
            $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
            $tongdoanhso=$tongdoanhso+ $ttsp['doanhso']*$idsoluong[1];
    }
    $congty=$tongdoanhso*0.15;
    $be2=$tongdoanhso*0.02;
    $be3=$tongdoanhso*0.03;
    $be4=$tongdoanhso*0.04;
    $intcct=@mysqli_query($con,"insert into taichinh (iddon,idu,doanhso,congty,marketing,be1,be2,be3,be4,be5,be6,be7,thang,nam,time,times)value($iddon,$idu,$tongdoanhso,$congty,$congty,$be2,$be2,$be2,$be3,$be3,$be4,$be4,$thang,$nam,$time,$times)");//tai chính công ty
    $udon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));
    //them cong doanh so, diem vao tai khaon cho thanh vien dat hang 
    $ttaichinh=@mysqli_query($con,"select * from taichinhuser where id=$idu");
    if(@mysqli_num_rows($ttaichinh)==0){
        $intc=@mysqli_query($con,"insert into taichinhuser (idu,thang,nam,diemthang)value($idu,$thang,$nam,$tongdiem)");
    }else{
        $intc=@mysqli_query($con,"update taichinhuser set diemthang=diemthang+$tongdiem where idu=$idu and thang=$thang and nam=$nam");
    }
    //bổ xung update vào tài khoản daonh số tháng 
    //2. gửi thông báo Upline 1
    $idup1=$udon['idgioithieu'];
    $udon1=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup1"));
    $tdieukien=@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup1 and thang=$thang and nam=$nam");
    $dkdiem1=@mysqli_fetch_assoc($tdieukien);
    if(@mysqli_num_rows($tdieukien)==0){
        $intc1=@mysqli_query($con,"insert into taichinhuser (idu,thang,nam)value($idup1,$thang,$nam)");
        $tdieukien=@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup1 and thang=$thang and nam=$nam");
        $dkdiem1=@mysqli_fetch_assoc($tdieukien);
    }
    if($idup1<=3){ 
        $tienf1=$tongdoanhso*0.5;
        $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf1,f1=f1+$tienf1,tongthu=tongthu+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
    }else{
        $tienf1=$tongdoanhso*0.4;
        if($dkdiem1['diemthang']>=50){
            $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf1,f1=f1+$tienf1,tongthu=tongthu+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
        }else{
            $intc=@mysqli_query($con,"update taichinhuser set f1tam=f1tam+$tienf1,f1thang=f1thang+$tienf1,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup1 and thang=$thang and nam=$nam");
            //nếu chưa đủ điểm kiện điểm thì tiền cộng tạm vào sodu_tam , tiền f1 tháng vẫn cộng, điểm 5 tầng, Nhưng khi đủ điều kiện thì cộng số dư và tổng thu, f1
        }
    }
    //2. gửi thông báo
    $idup2=$udon1['idgioithieu'];
    if($idup2!=1){
    $udon2=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup2"));
    $dkdiem2=@mysqli_fetch_assoc(@mysqli_query($con,"select diemthang from taichinhuser where idu=$idup2 and thang=$thang and nam=$nam"));
    if($idup2<=3){
        $tienf2=$tongdoanhso*0.1;
        $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf2,f2=f2+$tienf2,tongthu=tongthu+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
    }else{
        $tienf2=$tongdoanhso*0.1;
        if($dkdiem2['diemthang']>=100){
            $intc=@mysqli_query($con,"update taichinhuser set sodu=sodu+$tienf2,f2=f2+$tienf2,tongthu=tongthu+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
        }else{
            $intc=@mysqli_query($con,"update taichinhuser set f2tam=f2tam+$tienf2,f2thang=f2thang+$tienf2,diem5tangthang=diem5tangthang+$tongdiem where idu=$idup2 and thang=$thang and nam=$nam");
            //nếu chưa đủ điểm kiện điểm thì tiền cộng tạm vào sodu_tam , tiền f2 tháng vẫn cộng, điểm 5 tầng, Nhưng khi đủ điều kiện thì cộng số dư và tổng thu, f2
        }
    }
    //tim f3 de cong 5 tang
    $idup3=$udon2['idgioithieu'];
    if($idup3!=1){
    $udon3=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup3"));
    $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup3 and thang=$thang and nam=$nam");
    //tim f4 de cong 5 tang
        $idup4=$udon3['idgioithieu'];
        if($idup4!=1){
        $udon4=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup4"));
        $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup4 and thang=$thang and nam=$nam");
        //tim f5 de cong 5 tang
            $idup5=$udon4['idgioithieu'];
            if($idup5!=1){
            $udon5=@mysqli_fetch_assoc(@mysqli_query($con,"select id,fullname,idgioithieu from dh_user where id=$idup5"));
            $intc=@mysqli_query($con,"update taichinhuser set diem5tangthang=diem5tangthang+$tongdiem where idu=$idup5 and thang=$thang and nam=$nam");
            //tim f5 de cong 5 tang
            }
        }
    }
    }
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/congty.php?type=don&trangthai=2";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
    exit();
}
if(isset($_GET['khongxacnhanthanhtoan'])){
    $iddon=intval($_GET['khongxacnhanthanhtoan']);
    $rdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_donhang where id=$iddon"));
    $idu=$rdon['iduser'];
    $udon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idu"));
    //1. update lại trang thái đơn
    $updon=@mysqli_query($con,"update dh_donhang set trangthai=0 where id=$iddon");
    //2. gửi thông báo
    $tieude='Từ chối xác nhận đơn hàng #BOC'.$iddon;
    $noidung='Đơn hàng #BOC'.$iddon.' đã bị từ chối xác nhận thanh toán, chúng tôi đã cập nhật lại đơn hàng của bạn về trạng thái "Chờ thanh toán". Bạn hãy kiểm tra trạng thái đơn hàng trong mục "Đơn hàng của bạn" trên menu quản trị trong tài khoản thành viên trên hệ thống ';
    $idnhan='*'.$udon['id'].'*';
    $idgui=1;
    $guitt=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('cart',$idgui,'$idnhan',N'$tieude',N'$noidung',$time)");
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/congty.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
    exit();
}
?>
 <!DOCTYPE html>
<html >
<head>
    <base href="https://boc.is/" />
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
            <?
                $soluongdon=@mysqli_num_rows(@mysqli_query($con,"select id from dh_donhang where trangthai=1"));
                ?>
                <h4 style="color: yellow;"><i class="fas fa-layer-group"></i> Tài chính đơn hàng <sup id="donchoduyet">(<?=$soluongdon?>)</sup> 
                <?
                $donthanhtoan=@mysqli_num_rows(@mysqli_query($con,"select id from trahoahong where trangthai=0"));
                
                ?>
                <a href="taichinhcongty.php"><span style="color: silver;font-weight: normal;font-size: 0.9em;padding-left: 30px;"><i class="fas fa-hand-holding-usd"></i> Yêu cầu rút tiền <sup>(<?=$donthanhtoan?>)</sup></span></a></h4>
            </div>
        </div>
    </div>
</section>
<?
if(!isset($_SESSION['boc'])){?>
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
    if($trangthai==-1){$dieukien='where 1=1';$linkgoc='/congty.php?type=don&trangthai=-1';}
    if($trangthai==2){$dieukien='where trangthai=2';$linkgoc='/congty.php?type=don&trangthai=2';}
    if($trangthai==3){$dieukien='where trangthai=3';$linkgoc='/congty.php?type=don&trangthai=3';}
    if($trangthai==4){$dieukien='where trangthai=4';$linkgoc='/congty.php?type=don&trangthai=4';}
    if($trangthai==1){$dieukien='where trangthai=1';$linkgoc='/congty.php?type=don&trangthai=1';}
    if($trangthai==0){$dieukien='where trangthai=0';$linkgoc='/congty.php?type=don&trangthai=0';}
    if(isset($_GET['date'])){
        $batdau=$_GET['y'].$_GET['m'].'01000000';
            if(intval($_GET['m'])==1 or intval($_GET['m'])==3 or intval($_GET['m'])==5 or intval($_GET['m'])==7 or intval($_GET['m'])==9 or intval($_GET['m'])==10 or intval($_GET['m'])==12){
                $ketthuc=$_GET['y'].$_GET['m'].'31235959';
            }else{
                if(intval($_GET['m'])==2){
                    if($_GET['y']=='2024' or $_GET['y']=='2028'){
                        $ketthuc=$_GET['y'].$_GET['m'].'29235959';
                    }else{
                        $ketthuc=$_GET['y'].$_GET['m'].'28235959';
                    }
                }else{
                    $ketthuc=$_GET['y'].$_GET['m'].'30235959';
                }
            }
        $dieukientime=" and timexacnhan >= $batdau and timexacnhan <$ketthuc";
    }else{
        $batdau=date('Y').date('m').'01000000';
            if(intval(date('m'))==1 or intval(date('m'))==3 or intval(date('m'))==5 or intval(date('m'))==7 or intval(date('m'))==9 or intval(date('m'))==10 or intval(date('m'))==12){
                $ketthuc=date('Y').date('m').'31235959';
            }else{
                if(intval(date('m'))==2){
                    if(date('Y')=='2024' or date('Y')=='2028'){
                        $ketthuc=date('Y').date('m').'29235959';
                    }else{
                        $ketthuc=date('Y').date('m').'28235959';
                    }
                }else{
                    $ketthuc=date('Y').date('m').'30235959';
                }
            }
        $dieukientime=" and timexacnhan >= $batdau and timexacnhan <$ketthuc";
    }
    $don=@mysqli_query($con,"select * from dh_donhang $dieukien and time >= $batdau and time <$ketthuc order by time desc");
    $soluong=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where  time >= $batdau and time <$ketthuc order by time desc"));
    $soluong1=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where trangthai=1 and time >= $batdau and time <$ketthuc order by time desc"));
    $soluong2=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where trangthai=2 $dieukientime order by time desc"));
    $soluong3=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where trangthai=3 $dieukientime order by time desc"));
    $soluong4=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where trangthai=4 $dieukientime order by time desc"));
    $soluong0=@mysqli_num_rows(@mysqli_query($con,"select * from dh_donhang where trangthai=0 and time >= $batdau and time <$ketthuc order by time desc"));
    $donok=@mysqli_query($con,"select idsoluong,id from dh_donhang where trangthai>1 $dieukientime order by time desc");
    $soluong5=@mysqli_num_rows($donok);//tổng đơn đa hoàn thành
    $tongtiendon=0;
    $tongtienship=0;
    $tongship=0;
    while($rdok=@mysqli_fetch_assoc($donok)){
        $cart=explode("*",$rdok['idsoluong']);
        for($i=0;$i<count($cart);$i++){
            $idsoluong=explode("-",$cart[$i]);
            $idsp=$idsoluong[0];
            $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
            $tongtiendon=$tongtiendon+ $ttsp['gia']*$idsoluong[1];
            $tongtienship=$tongtienship+ $ttsp['gia']*$idsoluong[1] + $ttsp['ship'];
            $tongship=$tongship+$ttsp['ship'];
        }
    }
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
            <div class="taichinh">
                <div style="margin-bottom: 15px;border-bottom: 1px solid #c3c3c3;padding-bottom: 15px;"><span class="baoi"><i class="far fa-calendar-alt"></i></span> Tháng tái chính: 
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
                <div class="row">
                <div class="col-md-6 col-xs-12">
                <p><span class="baoi"><i class="fas fa-shopping-cart"></i></span> Tổng số đơn thanh toán/Tổng đơn: <b><?=$soluong5?>/<?=$soluong?></b></p>
                <p><span class="baoi"><i class="fas fa-dollar-sign"></i></span> Tổng số tiền thực thu: <b style="color: #0080FF;"><?=number_format($tongtienship,0,',','.')?>đ</b> <br/></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>(Trong đó tiền hàng: <b style="color: red;"><?=number_format($tongtiendon,0,',','.')?>đ</b> - Tiền ship: <b><?=number_format($tongship,0,',','.')?>đ</b></i></p>
                <p><span class="baoi"><i class="fab fa-digital-ocean"></i></span> Chi phí sản phẩm (20%): <b><?=number_format($tongtiendon*0.2,0,',','.')?>đ</b></p>
                </div>
                <div class="col-md-6 col-xs-12">
                <p><i class="far fa-arrow-alt-circle-right"></i> Vận hành C.ty (15%): <b><?=number_format($tongtiendon*0.8*0.15,0,',','.')?>đ</b></p>
                <p><i class="far fa-arrow-alt-circle-right"></i> Marketing (15%): <b><?=number_format($tongtiendon*0.8*0.15,0,',','.')?>đ</b></p>
                <p><i class="far fa-arrow-alt-circle-right"></i> Bể động chia (20%): <b><?=number_format($tongtiendon*0.8*0.2,0,',','.')?>đ</b></p>
                <p><i class="far fa-arrow-alt-circle-right"></i> Chi hệ thống (50%): <b><?=number_format($tongtiendon*0.8*0.5,0,',','.')?>đ</b></p>
                </div>
                </div>
            </div>
                <h4>Danh sách đơn:</h4>
                <div class="row">
        <div class="col-md-12 col-xs-12 but">
        <a type="button" class="btn btn-<?if($trangthai==-1){echo 'primary';}else{echo 'default';}?> btn-xs" href="congty.php?type=don">Tất cả <span>(<?=$soluong?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==1){echo 'primary ';}else{echo 'default';}?> btn-xs" href="congty.php?type=don&trangthai=1">Chờ xác nhận <span>(<?=$soluong1?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==2){echo 'primary';}else{echo 'default';}?> btn-xs" href="congty.php?type=don&trangthai=2">Chờ gửi hàng <span>(<?=$soluong2?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==3){echo 'primary';}else{echo 'default';}?> btn-xs" href="congty.php?type=don&trangthai=3">Đã gửi hàng, chờ nhận <span>(<?=$soluong3?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==4){echo 'primary';}else{echo 'default';}?> btn-xs" href="congty.php?type=don&trangthai=4">Đã hoàn thành <span>(<?=$soluong4?>)</span></a>
        <a type="button" class="btn btn-<?if($trangthai==0){echo 'primary';}else{echo 'default';}?> btn-xs" href="congty.php?type=don&trangthai=0">Chưa thanh toán <span>(<?=$soluong0?>)</span></a>
        <p>&nbsp;</p>
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">Thành viên</th>
                    <th style="padding-left: 0;">Đơn hàng</th>
                    <th style="padding-left: 0;max-width: 350px;">Người nhận</th>
                    <th style="padding-left: 0;">Trạng thái</th>
                </tr>
                <?
                
                while($rd=@mysqli_fetch_assoc($don)){
                    $idthanhvien=$rd['iduser'];
                    $tv=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idthanhvien"));
                    $cart=explode("*",$rd['idsoluong']);
                    $tongtien=0;
                    $tongdiem=0;
                    $tensp='';
                    for($i=0;$i<count($cart);$i++){
                        $idsoluong=explode("-",$cart[$i]);
                        $idsp=$idsoluong[0];
                        $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                        $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
                        $tongdiem=$tongdiem+$ttsp['diem']*$idsoluong[1];
                            if($tensp==''){
                                $tensp=$ttsp['ten'].' ('.$idsoluong[1].')';
                            }else{
                                $tensp=$tensp.', '.$ttsp['ten'].' ('.$idsoluong[1].')';
                            }
                        }
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                        <p>Mã đơn: <b>#BOC<?=$rd['id']?></b></p>
                            <p><i class="fas fa-user"></i> <?=$tv['fullname']?></p>
                            <p><i class="fas fa-phone-volume"></i> <?=$tv['phone']?></p>
                            <p><i class="far fa-clock"></i> <?=tra_lai_time($tv['time'])?></p>
                            <div class="clearfix"></div>
                     
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p><?=$tensp?></p>
                            <p>Tổng tiền: <b style="color: red;"><?=number_format($tongtien,0,',','.')?><sup>đ</sup></b></p>
                            <p>Điểm: <?=$tongdiem?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p>Họ tên: <?=$rd['hoten']?></p>
                            <p>SĐT: <?=$rd['sdt']?></p>
                            <p>Địa chỉ: <?=$rd['diachi']?></p>
                        </td>
                        <td style="padding: 15px 0;text-align: center;">
                            <?
                            if($rd['trangthai']==0){//chưa thanh toán
                            ?>
                            <button type="button" class="btn btn-default btn-xs">Chưa thanh toán</button>
                            <?
                            }elseif($rd['trangthai']==1){//đa thanh toán chờ xác nhận
                            ?>
                            <p class=""><a href="/upload/uploadbank/<?=$rd['bank']?>" target="_blank"><img style="width: 30px;" src="/upload/uploadbank/<?=$rd['bank']?>" /></a></p>
                            <a type="button" class="btn btn-warning btn-xs" href="congty.php?xacnhanthanhtoan=<?=$rd['id']?>" onclick="return confirm('Chỉ xác nhận sau khi nhận được tiền vào tài khoản, xác nhận?')">Xác nhận thanh toán?</a>
                            <p style="font-size: 0.8em; font-style: italic;"><i class="far fa-clock"></i> <?=retimefull($rd['timebank'])?></p>
                            <a type="button" class="btn btn-danger btn-xs" href="congty.php?khongxacnhanthanhtoan=<?=$rd['id']?>" onclick="return confirm('Từ chối xác nhận khi không nhận được thanh toán, từ chối?')">Từ chối xác nhận?</a>
                            <?    
                            }elseif($rd['trangthai']==2){//đa xác nhận chờ gửi hàng
                            ?>
                            <p class=""><a href="/upload/uploadbank/<?=$rd['bank']?>" target="_blank"><img style="width: 30px;" src="/upload/uploadbank/<?=$rd['bank']?>" /></a></p>
                            <button type="button" onclick="updatedon(<?=$rd['id']?>)" class="btn btn-primary btn-xs">Gửi hàng?</button>
                            <?
                            /*if($rd['trangthaitam']==0){?>
                            <br />
                            <a type="button" class="btn btn-warning btn-xs" href="congty.php?xacnhanthanhtoanlai=<?=$rd['id']?>" onclick="return confirm('Chỉ xác nhận sau khi nhận được tiền vào tài khoản, xác nhận?')">Xác nhận thanh toán?</a>
                            <?  
                            } */   
                            }elseif($rd['trangthai']==3){//đa gửi hàng
                            ?>
                            <button type="button" class="btn btn-info btn-xs">Đã gửi hàng, chờ nhận</button>
                            <?/*if($rd['trangthaitam']==0){?>
                            <br />
                            <a type="button" class="btn btn-warning btn-xs" href="congty.php?xacnhanthanhtoanlai=<?=$rd['id']?>" onclick="return confirm('Chỉ xác nhận sau khi nhận được tiền vào tài khoản, xác nhận?')">Xác nhận thanh toán?</a>
                            <?  
                            }*/  
                            }elseif($rd['trangthai']==4){//đa nhận hàng, hoàn thành
                            ?>
                            <button type="button" class="btn btn-success btn-xs">Hoàn thành</button>
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
                                window.location="congty.php"; 
                            }, 1000);
                        }
                    });
                }
            })
            $('body').ready(function(){
               $('#donchoduyet').html('(<?=$soluong1?>)') 
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
