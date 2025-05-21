<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
$tu="select * from dh_user where id=$iduser";$qu=@mysqli_query($con,$tu);$ru=@mysqli_fetch_assoc($qu);
$trang='item';
$m=addslashes($_GET['m']);
    if($m=='tim-kiem'){
        $s=addslashes($_GET['s']);
        $trang='baiviet';
        $tit='Kết quả tìm kiếm - '.$ru['tit'];
        $des=$ru['des'];
        $tukhoa=$ru['tukhoa'];
        $list=1;
        $tbv=@mysqli_query($con,"select * from dh_baiviet where ten like N'%$s%' order by time desc");$soluong=@mysqli_num_rows($tbv);
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">Tìm kiếm: '.$s.'</span>
        </div>
        ';
    }elseif($m=='cart'){
        $trang='sanpham';
        $tit='Giỏ hàng của bạn';
        $des=$ru['des'];
        $tukhoa=$ru['tukhoa'];
        $list=0;
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">Giỏ hàng</span>
        </div>
        ';
    }elseif($m=='thanh-toan'){
        $trang='sanpham';
        $tit='Thông tin thanh toán';
        $des=$ru['des'];
        $tukhoa=$ru['tukhoa'];
        $list=0;
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">Thông tin thanh toán</span>
        </div>
        ';
    }elseif($m=='da-thanh-toan'){
        $trang='sanpham';
        $tit='Thông tin thanh toán';
        $des=$ru['des'];
        $tukhoa=$ru['tukhoa'];
        $list=0;
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">Cập nhật hóa đơn</span>
        </div>
        ';
    }elseif($m=='xac-nhan-thanh-toan'){
        $trang='sanpham';
        $tit='Xác nhận thanh toán';
        $des=$ru['des'];
        $tukhoa=$ru['tukhoa'];
        $list=0;
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">Hoàn thành</span>
        </div>
        ';
    }else{
    $a1=@mysqli_query($con,"select * from dh_menu1 where khongdau='$m'");
    $a2=@mysqli_query($con,"select * from dh_menu2 where khongdau='$m'");
    $a3=@mysqli_query($con,"select * from dh_baiviet where khongdau='$m'");
    $a4=@mysqli_query($con,"select * from dh_sanpham where khongdau='$m'");
    if(@mysqli_num_rows($a1)>0){
        $ra=@mysqli_fetch_assoc($a1);
        $trang='baiviet';
        $tit=$ra['tit'];
        $des=$ra['des'];
        $list=1;
        if($ra['loai']==1){
                $loaitrang='sanpham';
                if(isset($_GET['an'])){
                    $tbv=@mysqli_query($con,"select * from dh_sanpham where menu1=$ra[id] order by time desc");
                    }else{
                    $tbv=@mysqli_query($con,"select * from dh_sanpham where menu1=$ra[id] and an=0 order by time desc");    
                    }
                
                $soluong=@mysqli_num_rows($tbv);
                $sp1=@mysqli_fetch_assoc(@mysqli_query($con,"select anh from dh_sanpham where menu1=$ra[id] limit 1"));
                $imgmxh=$domain.'upload/sanpham/'.str_replace(",","",$sp1['anh']);
            }else{
                $loaitrang='baiviet';
                $tbv=@mysqli_query($con,"select * from dh_baiviet where muc=$ra[id] order by time desc");$soluong=@mysqli_num_rows($tbv);
                $imgmxh=$domain.'upload/menu/'.$ra['anh'];
            }
        $tukhoa=$ra['tukhoa'];
        
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">'.$ra['ten'].'</span>
        </div>
        ';
        $linkchuan=$domain.$ra['khongdau'].'.html';
        if($ra['anh']!=''){
            $unmenu='
            <div class="page-banner posr" style="background-image: url(upload/menu/'.$ra['anh'].')">
                    <div class="over posa"></div>
                    <div class="news-banner-latter news-banner-latter-custome posa" >
                    <h1 class="title"><a style="" href="javascript:void(0)">'.$ra['slogan'].'</a></h1>
                    </div>
            </div>
            ';
            
        }else{$unmenu='';}
    }elseif(@mysqli_num_rows($a2)>0){
        $ra=@mysqli_fetch_assoc($a2);
        $trang='baiviet';
        $tit=$ra['tit'];
        $des=$ra['des'];
        $list=1;
        $tukhoa=$ra['tukhoa'];
        $tm1=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_menu1 where id=$ra[menu1]"));
        if($tm1['loai']==1){
            $loaitrang='sanpham';
            $tbv=@mysqli_query($con,"select * from dh_sanpham where menu2=$ra[id] order by time desc");$soluong=@mysqli_num_rows($tbv);
            $sp1=@mysqli_fetch_assoc(@mysqli_query($con,"select anh from dh_sanpham where menu2=$tm1[id] limit 1"));
            $imgmxh=$domain.'upload/sanpham/'.str_replace(",","",$sp1['anh']);
        }else{
            $loaitrang='baiviet';
            $tbv=@mysqli_query($con,"select * from dh_baiviet where muc2=$ra[id] order by time desc");$soluong=@mysqli_num_rows($tbv);
            $imgmxh=$domain.'upload/menu/'.$tm1['anh'];
        }
        
        $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <a class="bread-link bread-home" href="'.$tm1['khongdau'].'.html" title="'.$tm1['ten'].'">'.$tm1['ten'].'</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <span class="bread-page">'.$ra['ten'].'</span>
        </div>
        ';
        $linkchuan=$domain.$ra['khongdau'].'.html';
    }elseif(@mysqli_num_rows($a3)>0){
        $rb=@mysqli_fetch_assoc($a3);
        $trang='baiviet';
        $list=0;
        $loaitrang='baiviet';
        $tit=$rb['ten'];
        $des=cat_chu($rb['trichdan'],20);
        $m1=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau,ten,anh from dh_menu1 where id=$rb[muc]"));
        $imgmxh=$domain.'upload/'.$loaitrang.'/'.$rb['anh'];
        if($rb['muc2']==0){
            $title='
                <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
                    <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
                    <span class="separator"> <i class="fa fa-angle-right"></i> </span>
                    <a class="bread-link bread-home" href="'.$m1['khongdau'].'.html" title="'.$m1['ten'].'">'.$m1['ten'].'</a>
                </div>
                ';
        }else{
            $m2=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau,ten from dh_menu2 where id=$rb[muc2]"));
            $title='
                <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
                    <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
                    <span class="separator"> <i class="fa fa-angle-right"></i> </span>
                    <a class="bread-link bread-home" href="'.$m1['khongdau'].'.html" title="'.$m1['ten'].'">'.$m1['ten'].'</a>
                    <span class="separator"> <i class="fa fa-angle-right"></i> </span>
                    <a class="bread-link bread-home" href="'.$m2['khongdau'].'.html" title="'.$m2['ten'].'">'.$m2['ten'].'</a>
                </div>
                ';
        }
    }elseif(@mysqli_num_rows($a4)>0){
        $ra=@mysqli_fetch_assoc($a4);
        $trang='sanpham';
        $tit=$ra['tit'];
        $des=$ra['mota'];
        $list=0;
        $loaitrang='sanpham';
        $tukhoa=$ra['tukhoa'];
        $imgmxh=$domain.'upload/sanpham/'.str_replace(",","",$ra['anh']);
        $tm1=@mysqli_fetch_assoc(@mysqli_query($con,"select ten,khongdau from dh_menu1 where id=$ra[menu1]"));
        $title='
        <div id="breadcrumbs" style="padding-top: 20px;" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <a class="bread-link bread-home" href="'.$tm1['khongdau'].'.html" title="'.$tm1['ten'].'">'.$tm1['ten'].'</a>
        </div>
        ';
        if($ra['menu2']!=0){
            $tm2=@mysqli_fetch_assoc(@mysqli_query($con,"select ten,khongdau from dh_menu2 where id=$ra[menu2]"));
            $title='
            <div id="breadcrumbs" style="padding-top: 20px;" class="breadcrumb-trail breadcrumbs">
                <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
                <span class="separator"> <i class="fa fa-angle-right"></i> </span>
                <a class="bread-link bread-home" href="'.$tm1['khongdau'].'.html" title="'.$tm1['ten'].'">'.$tm1['ten'].'</a>
                <span class="separator"> <i class="fa fa-angle-right"></i> </span>
                <a class="bread-link bread-home" href="'.$tm2['khongdau'].'.html" title="'.$tm2['ten'].'">'.$tm2['ten'].'</a>
            </div>
            ';
        }
        
    }
    }

?>
<!DOCTYPE html>
<html >
<head>
<?require_once('include/header.php');?>
</head>
<body class="page-template page-template-page-templates page-template-news page-template-page-templatesnews-php page page-id-4 page-parent" >
<?
require_once('include/head.php');
if($list==0){
if($m=='cart'){
    ?>
    <section class="tabsanpham">
<div class="container">
    <div class="row">
    <p>&nbsp;</p>
        <?=$title?>  
        <hr />
        <div class="col-md-9 col-xs-12">
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;" class="hidden-xs">
                    <th style="padding-left: 0;">Sản phẩm</th>
                    <th style="padding-left: 0;" class="hidden-xs">Đơn giá</th>
                    <th style="padding-left: 0;" class="hidden-xs">Điểm</th>
                    <th style="padding-left: 0;" class="hidden-xs">Số lượng</th>
                    <th style="padding-left: 0;" class="hidden-xs">Thành tiền</th>
                    <th style="padding-left: 0;" class="hidden-xs">Tổng điểm</th>
                </tr>
                <?
                if(!isset($_COOKIE['cart'])){
                    ?>
                    <tr>
                        <td colspan="6" style="padding: 10px 0;text-align: center;">
                            Không có sản phẩm nào được chọn
                            <p style="padding: 10px 0 20px;"><a type="button" class="btn btn-primary btn-xs" href="/san-pham.html">Mua hàng ngay <i class="fas fa-long-arrow-alt-right"></i></a></p>
                        </td>
                    </tr>
                    <?
                }else{
                    
                    $cart=explode("*",$_COOKIE['cart']);
                    $tongtien=0;
                    $tongdiem=0;
                    for($i=0;$i<count($cart);$i++){
                        $idsoluong=explode("-",$cart[$i]);
                        $idsp=$idsoluong[0];
                        $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                            <img class="img-rounded" style="margin-right: 15px;width: 80px;float: left;" src="upload/sanpham/<?=str_replace(",","",$ttsp['anh'])?>" alt="<?=$ttsp['ten']?>" />
                            <p><?=$ttsp['ten']?></p>
                            <p><a type="button" style="padding: 0;color: red;" id="delcart<?=$ttsp['id']?>" class="btn btn-link"><i class="fas fa-trash-alt"></i> xóa</a></p>
                            <div class="clearfix"></div>
                            <p class="hidden-lg hidden-md hidden-sm">Đơn giá: <?=number_format($ttsp['gia'],0,',','.')?><sup>đ</sup> &nbsp;&nbsp;-&nbsp;&nbsp; Điểm: <b><?=$ttsp['diem']?></b> </p>
                            <p class="hidden-lg hidden-md hidden-sm"></p>
                            
                            <div class="soluong hidden-lg hidden-md hidden-sm" style="padding: 0;padding-bottom: 10px;">
                            Số lượng: 
                                  <span id="mb_giam<?=$i?>" style="padding: 6px; font-size: 0.8em;" class="congtru"><i class="fas fa-minus"></i></span>
                                  <input type="text" style="width: 35px;" readonly="" min="1" required="" id="mb_sl<?=$i?>" class="insoluong text-center" value="<?=$idsoluong[1]?>">
                                  <span id="mb_tang<?=$i?>" style="padding: 6px; font-size: 0.8em;" class="congtru disabled"><i class="fas fa-plus"></i></span>
                            </div>
                            <p class="hidden-lg hidden-md hidden-sm">Thành tiền: <span><?=number_format($ttsp['gia']*$idsoluong[1],0,',','.')?><sup>đ</sup></span>
                             &nbsp;&nbsp;-&nbsp;&nbsp; Tổng điểm: <b><?=number_format($ttsp['diem']*$idsoluong[1],0,',','.')?></b></p>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=number_format($ttsp['gia'],0,',','.')?><sup>đ</sup>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=$ttsp['diem']?>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <div class="soluong" style="padding: 0;">
                                  <span id="giam<?=$i?>" style="padding: 6px; font-size: 0.8em;" class="congtru"><i class="fas fa-minus"></i></span>
                                  <input type="text" style="width: 35px;" readonly="" min="1" required="" id="sl<?=$i?>" class="insoluong text-center" value="<?=$idsoluong[1]?>">
                                  <span id="tang<?=$i?>" style="padding: 6px; font-size: 0.8em;" class="congtru disabled"><i class="fas fa-plus"></i></span>
                              </div>
                        </td>
                        <script>
                        $('a#delcart<?=$ttsp['id']?>').click(function() { 
                            $.ajax({
                                        url : "ajax.php",
                                        type : "post",
                                        dateType:"text",
                                        data : {
                                            typeform : 'delcart',
                                            id : <?=$idsoluong[0]?>, 
                                            sl : <?=$idsoluong[1]?>
                                        },
                                        success : function (result){
                                            setTimeout(function(){
                                                window.location="<?=$domain?>cart.html";
                                            }, 0);
                                        }
                            });
                    	});
                        $('span#tang<?=$i?>').click(function() { 
                            btntang(<?=$i?>,<?=$ttsp['id']?>);
                    	});
                        $('span#giam<?=$i?>').click(function() { 
                            btngiam(<?=$i?>,<?=$ttsp['id']?>);
                    	});
                        $('span#mb_tang<?=$i?>').click(function() { 
                            mbbtntang(<?=$i?>,<?=$ttsp['id']?>);
                    	});
                        $('span#mb_giam<?=$i?>').click(function() { 
                            mbbtngiam(<?=$i?>,<?=$ttsp['id']?>);
                    	});
                        </script>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=number_format($ttsp['gia']*$idsoluong[1],0,',','.')?><sup>đ</sup>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=$ttsp['diem']*$idsoluong[1]?>
                        </td>
                     </tr>
                     <?  
                     $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
                     $tongdiem=$tongdiem+$ttsp['diem']*$idsoluong[1];
                    }
                }?>
            </table>
        </div>
            
        </div>
        <style>
        .formcart{
            
        }
        .formcart span.input-group-addon{
            background: none;
            border-right: 0;
            border-color: #ebebeb;
        }
        .formcart input.form-control{
            -webkit-box-shadow: inset 0 0px 0px rgb(0 0 0 / 8%);
            box-shadow: inset 0 0px 0px rgb(0 0 0 / 8%);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            border-left: 0;
            border-color: #ebebeb;
        }
        .minitit{
            color: #222;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            margin-top: 26px;
            text-transform: uppercase;
            margin-bottom: 15px;
            padding-bottom: 15px;
            font-family: "UT",Arial, Helvetica, sans-serif;
        }
        .minitit:after{display: block;
            display: block;
            content: "";
            background: #ff5722;
            width: 40px;
            height: 2px;
            margin-top: 13px;
            width: 80px;
            margin-left: 0px;
            margin-right: auto;
            margin-top: 6px;
            margin-bottom: 0px;}
        </style>
        <div class="col-md-3 col-xs-12">
        <h4 class="minitit">Tài khoản đại lý</h4>
        <p><i class="fas fa-user-check"></i> <span><?=$u['fullname']?></span></p>
        <p><i class="fas fa-phone-volume"></i> <span><?=$u['phone']?></span></p>
        <h4 class="minitit">Thông tin nhận hàng</h4>
        <form class="form formcart" action="javascript:void(0)" method="post" style="width: 100%;">
        <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" id="hoten" value="<?=$u['fullname']?>" placeholder="Họ tên"/>
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-phone"></i></span>
              <input type="number" class="form-control" value="<?=$u['phone']?>" id="sdt" placeholder="Số điện thoai">
          </div>
          </div>
          <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
              <input type="text" class="form-control" value="<?=$u['diachi']?>" id="diachi" placeholder="Địa chỉ nhận hàng">
          </div>
          </div>
          
          <div class="clearfix"></div>
          <div class="form-group">
          <p class="bg-info text-center" id="xongxong" style="padding: 10px;color: #4CAF50;background: #fafde2; display: none;"><i class="fas fa-check-circle"></i> Đơn hàng của bạn đã được gửi thành công!</p>
          </div>
          

        </form>
        <p>Phí vận chuyển: <?if($tongdiem<50){$pvc=30000;?>30.000<sup>đ</sup><?}else{$pvc=0;?>Miễn phí<?}?></p>
        <h4 class="gia">Tổng tiền: <b><?=number_format($tongtien+$pvc,0,',','.')?><sup>đ</sup></b> </h4>
        <p class="pds">Tổng điểm: <span class="ds"><?=number_format($tongdiem,0,',','.')?></span>
        </p>
          <a id="guidonhang" type="button" class="muangay" >Thanh toán</a>
          <a id="xemdanhgia" href="/san-pham.html" type="button" class="muangay xemdanhgia">Mua thêm</a>
        <script type="text/javascript">
            $(function() {
                $('#guidonhang').click(function( ){
                    var hoten=$('#hoten').val();
                    var sdt=$('#sdt').val();
                    var diachi=$('#diachi').val();
                    if(hoten===''){
                        alert('Hãy nhập họ tên');
                        $('#hoten').focus();
                        return false
                    }
                    if(sdt===''){
                        alert('Hãy nhập số điện thoại');
                        $('#sdt').focus();
                        return false
                    }
                    if(diachi===''){
                        alert('Hãy nhập đại chỉ nhận hàng');
                        $('#diachi').focus();
                        return false
                    }
                                    $.ajax({
                                        url : "ajax.php", 
                                        type : "post",
                                        dateType:"text",
                                        data : { 
                                             typeform : 'datdon',
                                             hoten : hoten,
                                             sdt : sdt,
                                             diachi : diachi
                                        },
                                        success : function (result){
                                            window.location="<?=$domain?>thanh-toan.html";
                                        }
                                    });
                    });
            });
            function btngiam(i,id){
                var sl=$('#sl'+i).val();
          		var slm=Number(sl)-1;
                if(slm===0){
                    $('span#giam'+i).addClass()
                    $('span#giam'+i).css({'cursor':'not-allowed', 'opacity':'0.8'});
                }else{
                    $('input#sl'+i).val(slm);
                    $('span#giam'+i).css({'cursor':'pointer', 'opacity':'1'});
                    $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'cart',
                            sl : slm,
                            idsanpham : id
                        },
                        success : function (result){
                            setTimeout(function(){
                                window.location="<?=$domain?>cart.html";
                            }, 0);
                        }
                    });
                }
                
            }
            function btntang(i,id){
                    var sl=$('#sl'+i).val();
              		var slm=Number(sl)+1;
                    $('input#sl'+i).val(slm);
                    $('span#giam'+i).css({'cursor':'pointer', 'opacity':'1'});
                    $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'cart',
                            sl : slm,
                            idsanpham : id
                        },
                        success : function (result){
                            setTimeout(function(){
                                window.location="<?=$domain?>cart.html";
                            }, 0);
                        }
                    });
                }
                function mbbtngiam(i,id){
                var sl=$('#mb_sl'+i).val();
          		var slm=Number(sl)-1;
                if(slm===0){
                    $('span#mb_giam'+i).addClass()
                    $('span#mb_giam'+i).css({'cursor':'not-allowed', 'opacity':'0.8'});
                }else{
                    $('input#mb_sl'+i).val(slm);
                    $('span#mb_giam'+i).css({'cursor':'pointer', 'opacity':'1'});
                    $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'cart',
                            sl : slm,
                            idsanpham : id
                        },
                        success : function (result){
                            setTimeout(function(){
                                window.location="<?=$domain?>cart.html";
                            }, 0);
                        }
                    });
                }
                
            }
            function mbbtntang(i,id){
                    var sl=$('#mb_sl'+i).val();
              		var slm=Number(sl)+1;
                    $('input#mb_sl'+i).val(slm);
                    $('span#mb_giam'+i).css({'cursor':'pointer', 'opacity':'1'});
                    $.ajax({
                        url : "ajax.php",
                        type : "post",
                        dateType:"text",
                        data : {
                            typeform : 'cart',
                            sl : slm,
                            idsanpham : id
                        },
                        success : function (result){
                            setTimeout(function(){
                                window.location="<?=$domain?>cart.html";
                            }, 0);
                        }
                    });
                }
            </script>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</section>
    <?
}elseif($m=='thanh-toan'){
    
    if(isset($_GET['id'])){
        $idd=intval($_GET['id']);
        $textdon="iduser=$u[id] and id=$idd";
    }else{
        $textdon="iduser=$u[id] and trangthai=0";
    }
    ?>
    <section class="tabsanpham">
<div class="container">
    <div class="row">
    <p>&nbsp;</p>
        <?=$title?>  
        <hr />
        <?
        $don=@mysqli_query($con,"select * from dh_donhang where $textdon order by time desc limit 1");
        $rd=@mysqli_fetch_assoc($don);
        ?>
        
        <div class="col-md-12 col-xs-12">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <h4 class="minitit">Thông tin thanh toán đơn hàng</h4>
                <p>Tài khoản kế toán BOC:</p>
                <p>Chủ tài khoản: <b>NGUYỄN THỊ LÊ</b></p>
                <p>Ngân hàng: Thương mại cổ phần Quân đội MB</p>
                <p>Số tài khoản: 0348111222</p>
                <p>Nội dung thanh toán: <b style="color: #0073E6; font-size: 1.2em;"><?=$u['phone']?> Boc<?=$rd['id']?></b> </p>
                <p>Phí vận chuyển: <b id="ship"><?if($rdon['diem']<50){echo 'Phí vận chuyển bạn trả khi nhận hàng. <i style="font-weight: normal;">(BOC chỉ miễn phí vận chuyển đối với những đơn hàng trên 50 điểm)</i>';}else{echo 'Miễn phí';}?></b></p>
                <p>Tổng tiền: <b id="tongtien"></b> </p>
            </div>
            <div class="col-md-6 col-xs-12">
                <h4 class="minitit">Thông tin đơn hàng</h4>
                <p>Người nhận hàng: <b><?=$rd['hoten']?></b></p>
                <p>Số điện thoại: <b><?=$rd['sdt']?></b></p>
                <p>Địa chỉ: <?=$rd['diachi']?></p>
                <p class="pds">Tổng điểm: <span class="ds" id="tongdiem"></span></p>
                <p><a type="button" class="btn btn-success" href="/da-thanh-toan.html">Đã thanh toán?</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
    
        <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;" class="hidden-xs">
                    <th style="padding-left: 0;">Sản phẩm</th>
                    <th style="padding-left: 0;" class="hidden-xs">Đơn giá</th>
                    <th style="padding-left: 0;" class="hidden-xs">Điểm</th>
                    <th style="padding-left: 0;" class="hidden-xs">Số lượng</th>
                    <th style="padding-left: 0;" class="hidden-xs">Thành tiền</th>
                    <th style="padding-left: 0;" class="hidden-xs">Tổng điểm</th>
                </tr>
                <?
                
                    $cart=explode("*",$rd['idsoluong']);
                    $tongtien=0;
                    $tongdiem=0;
                    for($i=0;$i<count($cart);$i++){
                        $idsoluong=explode("-",$cart[$i]);
                        $idsp=$idsoluong[0];
                        $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                            <img class="img-rounded" style="margin-right: 15px;width: 80px;float: left;" src="upload/sanpham/<?=str_replace(",","",$ttsp['anh'])?>" alt="<?=$ttsp['ten']?>" />
                            <p><?=$ttsp['ten']?></p>
                            <div class="clearfix"></div>
                            <p class="hidden-lg hidden-md hidden-sm">Đơn giá: <?=number_format($ttsp['gia'],0,',','.')?><sup>đ</sup> &nbsp;&nbsp;-&nbsp;&nbsp; Điểm: <b><?=$ttsp['diem']?></b> </p>
                            <p class="hidden-lg hidden-md hidden-sm"></p>
                            
                            <div class="soluong hidden-lg hidden-md hidden-sm" style="padding: 0;padding-bottom: 10px;">
                            Số lượng: <?=$idsoluong[1]?>
                            </div>
                            <p class="hidden-lg hidden-md hidden-sm">Thành tiền: <span><?=number_format($ttsp['gia']*$idsoluong[1],0,',','.')?><sup>đ</sup></span>
                             &nbsp;&nbsp;-&nbsp;&nbsp; Tổng điểm: <b><?=number_format($ttsp['diem']*$idsoluong[1],0,',','.')?></b></p>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=number_format($ttsp['gia'],0,',','.')?><sup>đ</sup>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=$ttsp['diem']?>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            Số lượng: <?=$idsoluong[1]?>
                        </td>
                        
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=number_format($ttsp['gia']*$idsoluong[1],0,',','.')?><sup>đ</sup>
                        </td>
                        <td style="padding: 15px 0;" class="hidden-xs">
                            <?=$ttsp['diem']*$idsoluong[1]?>
                        </td>
                     </tr>
                     <?  
                     $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
                     $tongdiem=$tongdiem+$ttsp['diem']*$idsoluong[1];
                    }
                    if($tongdiem>=0){
                        $phiship=0;$textship='Miễn phí';
                    }else{
                        $phiship=30000;$textship='30.000<sup>đ</sup>';
                    }
                ?>
            </table>
            <script type="text/javascript">
            $(function() {
                $('b#tongtien').html('<?=number_format($tongtien+$phiship,0,',','.')?><sup>đ</sup>');
                $('#tongdiem').html('<?=number_format($tongdiem,0,',','.')?>');
                $('#ship').html('<?=$textship?>');
            })
            </script>
        </div>
            
        </div>
        <style>
        .formcart{
            
        }
        .formcart span.input-group-addon{
            background: none;
            border-right: 0;
            border-color: #ebebeb;
        }
        .formcart input.form-control{
            -webkit-box-shadow: inset 0 0px 0px rgb(0 0 0 / 8%);
            box-shadow: inset 0 0px 0px rgb(0 0 0 / 8%);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            border-left: 0;
            border-color: #ebebeb;
        }
        .minitit{
            color: #222;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            margin-top: 26px;
            text-transform: uppercase;
            margin-bottom: 15px;
            padding-bottom: 15px;
            font-family: "UT",Arial, Helvetica, sans-serif;
        }
        .minitit:after{display: block;
            display: block;
            content: "";
            background: #ff5722;
            width: 40px;
            height: 2px;
            margin-top: 13px;
            width: 80px;
            margin-left: 0px;
            margin-right: auto;
            margin-top: 6px;
            margin-bottom: 0px;}
        </style>
        
        <div class="clearfix"></div>
    </div>
</div>
</section>
    <?
}elseif($m=='da-thanh-toan'){
    ?>
    <section class="tabsanpham">
<div class="container">
    <div class="row">
    <p>&nbsp;</p>
        <?=$title?>  
        <hr />
        <style>
.bankupload{
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    font-size: 1.25rem;
    background-color: #c8dadf;
    position: relative;
    padding: 150px 20px;
    cursor: pointer;
    margin-bottom: 40px;text-align: center;
    background-size: cover;
}
.box__icon {
    width: 100%;
    height: 80px;
    fill: #92b0b3;
    display: block;
    margin-bottom: 40px;
    
}

</style>
        <?
        $don=@mysqli_query($con,"select * from dh_donhang where iduser=$u[id] and trangthai=0 order by time desc limit 1");
        $rd=@mysqli_fetch_assoc($don);
        ?>
        <div class="col-md-7 col-xs-12 text-center">
            <p>&nbsp;</p>
            <p>Nếu bạn đã thanh toán </p>
            <p>Hãy cập nhật hóa đơn chuyển tiền để chúng tôi xác nhận 1 cách nhanh nhất.</p>
            <img style="width: 60%; display: block; margin: 30px auto 0;" src="images/blog_86.jpg" />
            <p class="text-center" id="dahoanthanh" style="display: none;"><a type="button" href="/xac-nhan-thanh-toan.html?iddon=<?=$rd['id']?>" class="btn btn-success">Hoàn thành</a></p>
        </div>
        <div class="col-md-5 col-xs-12">
        <div class="bankupload" id="bankupload" onclick="document.getElementById('main_picture1').click();" style="">
                <div class="box__input">
			<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
			<label for="file"><strong style="color: #39bfd3;">Click</strong> và lựa chọn file ảnh để gửi</label>
		</div>
                </div>
                <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            //$('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            $("#bankupload").css("background-image", "url("+e.target.result+")");
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadbankupload('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
                });
        function uploadbankupload(idfile) {
        //Lấy ra files
        var file_data = $('#'+idfile).prop('files')[0];
        //lấy ra kiểu file
        var type = file_data.type;
        //Xét kiểu file được upload
        var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];
        //kiểm tra kiểu file
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3]) {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            //sử dụng ajax post
            $.ajax({
                url: 'uploadbank.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    var inp = idfile.replace('main_','data_');
                    $('#'+inp).val(res);
                    $('.box__input').css('opacity','0.3');
                    $('#dahoanthanh').show();
                }
            });
        } else {
            $('.status').text('Chỉ được upload file ảnh');
        }
        return false;
    };
                </script>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>
</section>
    <?
}elseif($m=='xac-nhan-thanh-toan'){
    ?>
    <section class="tabsanpham">
<div class="container">
    <div class="row">
    <p>&nbsp;</p>
        <?=$title?>  
        <hr />
        <?
        $idon=intval($_GET['iddon']);
        $don=@mysqli_query($con,"update dh_donhang set trangthai=1,timebank=$time where iduser=$u[id] and id=$idon");
        ?>
        <div class="col-md-12 col-xs-12 text-center">
            <p>&nbsp;</p>
            <p><img src="images/hoanthanh.png" style="max-width: 120px; display: block; margin: 20px auto;" /></p>
            <p>Thông tin thanh toán của bạn đã được cập nhật, chúng tôi sẽ xác nhận và gửi hàng theo thông tin của bạn.</p>
            <p>Hãy theo dõi tình trạng đơn hàng trong mục <a href="/m/mycart/">Đơn hàng của tôi</a></p>
            <p class="text-center" style="padding-bottom: 60px; padding-top: 10px;"><a type="button" href="/m/cpanel/" class="btn btn-success">Trở về trang chủ</a></p>
        </div>
                <script>
           setTimeout(function(){
                                window.location="/m/cpanel/";
           }, 5000);
                </script>
        
        <div class="clearfix"></div>
    </div>
</div>
</section>
    <?
}else{
if($loaitrang=='sanpham'){?>
<style>
.pds{}
.ds{font-weight: 600;}
</style>
<section class="tabsanpham">
<div class="container">
    <div class="row">
        <?=$title?>  
        <hr />
        <div class="col-md-6 col-xs-12">
            <img class="img-rounded" style="margin-top: 15px;" src="upload/sanpham/<?=str_replace(",","",$ra['anh'])?>" alt="<?=$ra['ten']?>" />
        </div>
        <div class="col-md-6 col-xs-12">
        <h1 class="tittensp"><?=$ra['ten']?></h1>
        <p><i>Cập nhật: <?=tra_lai_time($ra['time'])?></i> &nbsp; <i>Lượt xem: <?echo $ra['xem'];$uup=@mysqli_query($con,"update dh_sanpham set xem=xem+1 where id=$ra[id]")?></i></p>
        <h4 class="gia">Giá bán: <b><?=number_format($ra['gia'],0,',','.')?><sup>đ</sup></b> </h4>
        <p class="pds">Doanh số: <span class="ds"><?=number_format($ra['doanhso'],0,',','.')?><sup>đ</sup></span>
        <span style="float: right;">Điểm: <b><?=$ra['diem']?></b></span>
        </p>
        
        <p class="mota"><?=$ra['mota']?></p>
          <div class="soluong">
            <label>Số lượng: </label>
              <span id="giam" class="congtru"><i class="fas fa-minus"></i></span>
              <input type="number" min="1" required="" id="sl" class="insoluong text-center" value="1">
              <span id="tang" class="congtru disabled"><i class="fas fa-plus"></i></span>
          </div>
          <button id="nutmuahang" type="button" class="muangay">Mua hàng ngay</button>
          <button id="xemdanhgia" type="button" class="muangay xemdanhgia">Xem đánh giá</button>
          <script type="text/javascript">
            $(function() {
            	$('button#nutmuahang').click(function() {
            		var sl=$('#sl').val();
                    if(Number(sl)<1){alert('Số lượng sản phẩm phải > 0');return false;}else{
                        $.ajax({
                                        url : "ajax.php",
                                        type : "post",
                                        dateType:"text",
                                        data : {
                                            typeform : 'cart',
                                            sl : sl,
                                            idsanpham : <?=$ra['id']?>
                                        },
                                        success : function (result){
                                            setTimeout(function(){
                                                window.location="<?=$domain?>cart.html";
                                            }, 1000);
                                        }
                                    });
                    }
            	});
                $('span#tang').click(function() { 
                    var sl=$('#sl').val();
            		var slm=Number(sl)+1;
                    $('input#sl').val(slm);
                    $('span#giam').css({'cursor':'pointer', 'opacity':'1'});
            	});
                $('span#giam').click(function() { 
                    var sl=$('#sl').val();
            		var slm=Number(sl)-1;
                    if(slm===0){
                         $('span#giam').addClass()
                         $('span#giam').css({'cursor':'not-allowed', 'opacity':'0.8'});
                    }else{
                         $('input#sl').val(slm);
                         $('span#giam').css({'cursor':'pointer', 'opacity':'1'});
                    }
            	});
                
            });
            </script>
        <div class="clearfix"></div>
        
        <!--p style="text-align: center;padding: 5px;background: #f0f8ffa6;"><i class="fas fa-phone"></i> Hotline hỗ trợ: <a style="font-weight: bold; color: red;" href="tel:<?=str_replace(".","",str_replace(" ","",$ru['phone']))?>"><?=$ru['phone']?></a></p-->
        <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
        <h3 class="tittensp">Thông tin chi tiết</h3>
        <div class="noidung"><?$noidungs=$ra['thongtin'];$noidungs=str_replace("<table","<table class='table'",$noidungs);echo $noidungs;?></div>
        <h3 class="tittensp" id="phanhoi">Phản hồi sản phẩm</h3>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-comments" data-href="<?=lay_url()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
        <br />
        </div>
        
        <script>
            $(document).ready(function (){
                $("#xemdanhgia").click(function (){
                    var cuon=$("#phanhoi").offset().top - 70;
                    $('html, body').animate({
                        scrollTop: cuon
                    }, 2000);
                });
            });
        </script>
        <?
        if(isset($_GET['an'])){
            $spk=@mysqli_query($con,"select id from dh_sanpham where menu2=$ra[menu2] and id!=$ra[id] limit 4");
        }else{
            $spk=@mysqli_query($con,"select id from dh_sanpham where menu2=$ra[menu2] and id!=$ra[id] and an=0 limit 4");
        }
        
        $sospp=@mysqli_num_rows($spk);
        $listsp='';
        if($sospp>0){
            while($rk=@mysqli_fetch_assoc($spk)){
                $listsp .= $rk['id'].',';
            }
        }
        if($sospp<4){
            if(isset($_GET['an'])){
            $spk1=@mysqli_query($con,"select id from dh_sanpham where menu1=$ra[menu1] and menu2!=$ra[menu2] limit 4");//bỏ thằng 2 ra vi đa lấy ở trên
            }else{
                $spk1=@mysqli_query($con,"select id from dh_sanpham where menu1=$ra[menu1] and menu2!=$ra[menu2] and an=0 limit 4");//bỏ thằng 2 ra vi đa lấy ở trên
                }
            $sospp1=@mysqli_num_rows($spk1);
            if($sospp2>0){
                while($rk2=@mysqli_fetch_assoc($spk2)){
                    $listsp .= $rk2['id'].',';
                }
            } 
        }
        $cuoi=str_replace(" ",",",trim(str_replace(","," ",$listsp)));
        ?>
    </div>
</div>
</section>
<?
if($cuoi!=''){
$sp=explode(',',$cuoi);
$sosp=count($sp);
?>
<style>
.pdoanhso{}
.doanhso{}
</style>
<section class="sanphamhome">
<section>
    <div class="container">
        <div class="row">
        <div class="col-md-12"><h3 class="tittensp">Sản phẩm tương tự</h3></div>
        <?
            if($sosp%4==0){$class='col-md-3';}elseif($sosp%3==0){$class='col-md-4';}else{$class='col-md-3';}
            for($i=0;$i<$sosp;$i++){
                $idsp=intval($sp[$i]);
                $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
        ?>
            <div class="sanpham <?=$class?> col-xs-12">
                <a href="/<?=$rsp['khongdau']?>.html"><img src="upload/sanpham/<?=str_replace(",","",$rsp['anh'])?>" /></a>
                <div class="titsp">
                    <h4><a href="/<?=$rsp['khongdau']?>.html"><?=$rsp['ten']?></a></h4>
                    <p>Giá: <b><?=number_format($rsp['gia'],0,',','.')?><sup>đ</sup></b></p>
                    <p class="pdoanhso">Doanh số: <span class="doanhso"><?=number_format($rsp['doanhso'],0,',','.')?><sup>đ</sup></span></p>
                </div>
            </div>
        <?}?>
        </div>
    </div>
</section>
</section>
<?}?>
<?}else{?>
<div class="page-banner posr" style="background-image: url(upload/menu/<?=$m1['anh']?>)"></div>
<div class="main page-news-details-main">
    <section style="background-color: #F2F2F2;">
        <div class="container">
        <div class="head-post tac">
        <div>
        <h1 style="text-transform: uppercase;"><?=$rb['ten']?></h1>
        <time><?=tra_lai_time($rb['time'])?></time>
        </div>
        </div>
        <?=$title?>                
                <div class="col-xs-12" style="background: white; margin-bottom: 30px; padding-top: 20px;">
                    <div class="the-content">
                        <?=str_replace("\\","",$rb['noidung'])?>
                    </div>
                    
                </div>
                <hr/>
            <div class="share-post tac">
                <p>Chia sẻ bài viết</p>
                <!-- add item socialnetwork --> 
                <div class="item"><a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?=lay_url()?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/facebook-icon.png" alt="Facebook"></a></div>
                <div class="item"><a rel="nofollow" href="https://www.linkedin.com/shareArticle?trk=Instagram&url=<?=lay_url()?>" title="Share to linkedin" onclick="window.open(this.href, 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/linked-icon.png" alt="linked"></a></div>
                <div class="item"><a rel="nofollow" href="https://twitter.com/home?status=<?=lay_url()?>" title="Share to Twitter" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/twitter-icon.png" alt="Twitter"></a></div>            </div>
        </div>
    </section>
    <?
    if($rb['muc2']!=0){
        $tt=@mysqli_query($con,"select * from dh_baiviet where muc2=$rb[muc2] and id!=$rb[id] order by rand() limit 4");
    }else{
        $tt=@mysqli_query($con,"select * from dh_baiviet where muc=$rb[muc] and id!=$rb[id] order by rand() limit 4");
    }
    if(@mysqli_num_rows($tt)>0){
    ?>
    <section style="background-color: #E6E6E6">
        <div class="container">
            <h3 style="margin-top: 40px;" class="page-title-section text-center">Các tin liên quan</h3> 
                    <div class="row">
                    <?
                    while($rtt=@mysqli_fetch_assoc($tt)){
                        $link=$rtt['khongdau'].'.html';
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="news-thumbnail">
                        <a class="img" href="<?=$link?>" style="background: url('upload/baiviet/<?=$rtt['anh']?>');background-size: 100% 100%;"></a>
                        <div class="text">
                            <h3><a href="<?=$link?>"><?=$rtt['ten']?></a></h3> 
                            <div class="excerpt"><p><?=cat_chu($rtt['trichdan'],26)?></p></div>
                        </div>
                    </div>
                    </div>
                    <?}?>
                    </div> 
                <hr>
                <!--div class="text-center ttu" style=" color: #008848" >Từ khoá được tìm kiếm nhiều nhất</div>
                <ul class="list-keyword">
                <?
                   $link=@mysqli_query($con,"select * from dh_link order by id desc");
                   while($rl=@mysqli_fetch_assoc($link)){
                   ?>
                   <li><a href='<?=$rl['link']?>' title='<?=$rl['ten']?>' class='apple'><?=$rl['ten']?></a></li>
                <?}?>
                </ul-->        
                </div>
    </section>
    <?}}?>
</div>
<?  
}}else{//list các loại
    if($loaitrang=='sanpham'){
?>
<div id="main">
    <div class="main main-page-news">
    <div class="container">
    <?=$title?>
    <div class="row list-news" id="post-wrapper">
        	<?
        //phan trang
            if($soluong==0){echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nội dung đang được cập nhật';}
            $page=isset($_GET["page"])?intval($_GET["page"]):1;
            $rows_per_page=20;//$ru['so2'];
            $page_start=($page-1)*$rows_per_page;
            $page_end=$page*$rows_per_page;
            $number_of_page=ceil($soluong/$rows_per_page);
            if ($number_of_page>1)
            {
            // Ti?n h�nh in t?ng trang //
            for ($i=1; $i<=$number_of_page; $i++)
            {	
            // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
            if ($i==$page)
            {			
            $list_page.="<li class=\"active\"><span>$i</span></li>";
            }
            // Ngu?c l?i... //
            else
            {
                            //trường hợp có từ 6 trang trở lên thì tạo ra ...
            if($number_of_page>8){
            if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
            if($i<7){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"".$linkchuan."?page=".$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"".$linkchuan."?page=1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"".$linkchuan."?page=".$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"".$linkchuan."?page=".($page+1)."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-right\"></i></span>
        		</a>
        	</li>
            ";
            }
            //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ <V
            if(1!=$page){
            $list_page="
            <li>
        		<a class=\"first \" aria-label=\"Previous\" href=\"".$linkchuan."?page=".($page-1)."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-left\"></i></span>
        		</a>
        	</li>
            ".$list_page;
            }
            	
            }
            //end phân trang
            $ii=1;
            while($rsp=@mysqli_fetch_assoc($tbv)){
                if ($ii>$page_start){
                    $link=$rsp['khongdau'].'.html';
        ?>	
        <div class="sanpham col-md-3 col-xs-12">
                <a href="/<?=$rsp['khongdau']?>.html"><img src="upload/sanpham/<?=str_replace(",","",$rsp['anh'])?>" alt="<?=$rsp['ten']?>" /></a>
                <div class="titsp">
                    <h4><a href="/<?=$rsp['khongdau']?>.html"><?=$rsp['ten']?></a></h4>
                    <p>Giá: <b><?=number_format($rsp['gia'],0,',','.')?><sup>đ</sup></b> <span class="giacu" style="text-decoration: auto;color: #2a2a2a;">Điểm: <?=number_format($rsp['diem'],0,',','.')?></span></p>
                </div>
        </div>
    <?php 
            if($ii%4==0){echo '<div class="clearfix"></div>';}
            }
            if ($ii>=$page_end)
            {
            break;	
            }
            $ii++;
            } 
            if(isset($list_page)){
                $listxxx=('
                <div class="filter-right" style="margin-bottom:50px">
                <div class="collection-pagination pull-right pagination-wrapper">       
                <span class="mr20">Trang:</span>
                <ul class="pagination">
                '.$list_page.'
                </ul>
                </div>
				</div><!-- End. Filter 2-->
                ');
                }else{$listxxx='';}
            ?>
            <?=$listxxx?>
        </div>
    </div>
    </div>
</div>
<?
    }else{//list bài viết
?>
<div id="main">
<?require_once('include/slide.php');?>
    <div class="main main-page-news" style="background-color: #F2F2F2">
    <div class="container">
    <?=$title?>
    <div class="row list-news" id="post-wrapper">
        	<?
        //phan trang
            if($soluong==0){echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nội dung đang được cập nhật';}
            $page=isset($_GET["page"])?intval($_GET["page"]):1;
            $rows_per_page=16;//$ru['so2'];
            $page_start=($page-1)*$rows_per_page;
            $page_end=$page*$rows_per_page;
            $number_of_page=ceil($soluong/$rows_per_page);
            if ($number_of_page>1)
            {
            // Ti?n h�nh in t?ng trang //
            for ($i=1; $i<=$number_of_page; $i++)
            {	
            // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
            if ($i==$page)
            {			
            $list_page.="<li class=\"active\"><span>$i</span></li>";
            }
            // Ngu?c l?i... //
            else
            {
                            //trường hợp có từ 6 trang trở lên thì tạo ra ...
            if($number_of_page>8){
            if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
            if($i<7){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"".$linkchuan."?page=".$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"".$linkchuan."?page=".$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"".$linkchuan."?page=1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"".$linkchuan."?page=".$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"".$linkchuan."?page=".($page+1)."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-right\"></i></span>
        		</a>
        	</li>
            ";
            }
            //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ <V
            if(1!=$page){
            $list_page="
            <li>
        		<a class=\"first \" aria-label=\"Previous\" href=\"".$linkchuan."?page=".($page-1)."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-left\"></i></span>
        		</a>
        	</li>
            ".$list_page;
            }
            	
            }
            //end phân trang
            $ii=1;
            while($rbv=@mysqli_fetch_assoc($tbv)){
                if ($ii>$page_start){
                    $link=$rbv['khongdau'].'.html';
        ?>	
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="news-thumbnail">
                <a class="img" href="<?=$link?>" style="background: url('upload/baiviet/<?=$rbv['anh']?>');background-size: 100% auto;"></a>
                <div class="text">
                    <div style="display: none;" class="category-tags">
                        <ul class="post-categories">
	                    <li><a href="<?=$link?>" rel="category tag">Tin Ngành</a></li></ul></div>
                    <h3><a href="<?=$link?>"><?=$rbv['ten']?></a></h3>
                    <div class="excerpt"><p><?=cat_chu($rbv['trichdan'],26)?></p></div>
                </div>
            </div>
        </div>
    <?php 
            if($ii%4==0){echo '<div class="clr"></div>';}
            }
            if ($ii>=$page_end)
            {
            break;	
            }
            $ii++;
            } 
            if(isset($list_page)){
                $listxxx=('
                <div class="filter-right" style="margin-bottom:50px">
                <div class="collection-pagination pull-right pagination-wrapper">       
                <span class="mr20">Trang:</span>
                <ul class="pagination">
                '.$list_page.'
                </ul>
                </div>
				</div><!-- End. Filter 2-->
                ');
                }else{$listxxx='';}
            ?>
            <?=$listxxx?>
        </div>
<hr>     
</div>    
</div>
</div>
<?}} ?>
<?require_once('include/footer.php');?>
</body>
</html>
