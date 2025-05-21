<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
$sp=0; 
$des=$ru['des'];
$tukhoa=$ru['tukhoa'];
$imgmxh=$domain.'upload/favicon/'.$ru['imgmxh'];
if(!isset($_GET['m'])){$type='dangnhap';}else{$type=addslashes($_GET['m']);}
if(isset($_COOKIE['iduser']) and ($type=='dangnhap' or $type=='dangky')){
    if($_COOKIE['iduser']==1){
        header("Location: /m/cpanel/");
    }else{
        header("Location: /m/cpanel/");
    }
}
$des='Trang quản trị thành viên hệ thống '.$thuonghieu;
//$imgmxh='/images/imgmxh.jpg';
if($type=='dangky'){
    $tit_nho='<a href="">Tài khoản của tôi</a> &raquo; <span>Đăng ký thành viên</span>';
    $tit_do='Đăng ký thành viên';
    $tit='Đăng ký thành viên hệ thống '.$thuonghieu;
    $des=$ru['des'];
    
    if(isset($_POST['ok'])){
    $email=loc_ma_doc($_POST['email']);
    $pass=$_POST['pass'];
    $rpass=$_POST['repass'];
    $tinh=$_POST['tinh'];
    $congty=$_POST['congty'];
    $fullname=loc_ma_doc($_POST['fullname']);
    $address=loc_ma_doc($_POST['address']);
    $phone=loc_ma_doc($_POST['phone']);
    if($email!='' and $pass!='' and $rpass!='' and $fullname!='' and $address!='' and $phone!=''){
    //tim xem email này đăng ký chưa
    if($_POST['cc']==$_POST['c']){
    $tim="select * from dh_user where email='$email'";$qtim=@mysqli_query($con,$tim);$co=@mysqli_num_rows($qtim);
    if($co==0){
        if($pass==$rpass){
        $okpass=md5($pass);
        $in="insert into dh_user (email,pass,fullname,tendoanhnghiep,tinh,address,phone,quyen,time)value('$email','$okpass',N'$fullname',N'$congty',N'$tinh',N'$address','$phone',0,$time)";
        $qin=mysqli_query($con,$in);
        if($qin){
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="'.$domain.'cookie.php?email='.$email.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
            $thongbao='<tr><th></th><td style="color:blue">Đăng nhập tài khoản thành công!</td><tr>';
        }else{$thongbao='<tr><th></th><td style="color:red">Có lỗi, vui lòng làm lại.</td><tr>';}
        }else{$thongbao='<tr><th></th><td style="color:red">Mật khẩu nhập lại không đúng.</td><tr>';}
    }else{$thongbao='<tr><th></th><td style="color:red">Email đã được sử dụng.</td><tr>';}
    }else{$thongbao='<tr><th></th><td style="color:red">Trả lời bảo mật chưa đúng.</td><tr>';}
    }else{$thongbao='<tr><th></th><td style="color:red">Hãy nhập đầy đủ các trường bắt buộc (*).</td><tr>';}
}
}else{
    if(isset($_GET['m']) and $_GET['m']!='dangnhap' and $_GET['m']!='dangky' and $_GET['m']!='quenmatkhau' and $_GET['m']!='datmatkhau'){
        $sp=1; 
        $reff=addslashes($_GET['m']);
        $timreff=@mysqli_query($con,"select id,idsp,idu from reffsanpham where link='$reff'");
        if(@mysqli_num_rows($timreff)==0){
            echo '<script>window.location="/m/cpanel/";</script>';
        }else{
            $ureff=@mysqli_fetch_assoc($timreff);
            $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$ureff[idsp]"));
            $upxem=@mysqli_query($con,"update reffsanpham set xem=xem+1 where link='$reff'");
            $tit=$rsp['tit'];
            $des=$rsp['des'];
            $imgmxh='upload/sanpham/'.$rsp['anh'];
        }
        $tit='Đăng nhập hệ thống '.$thuonghieu;
    }else{
        $tit='Đăng nhập hệ thống '.$thuonghieu;
    }
}
?>

 <!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>

<meta charset="UTF-8" />
<base href="<?php echo $domain?>" />
<meta name="robots" content="all" />		
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
<meta name="description" content="<?php echo $des?>"/>		
<title><?php echo $tit?></title>
<meta property="description" content="<?php echo $des?>"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $tit?>"/>
<meta property="og:image" content="<?php echo $imgmxh?>"/>
<meta property="og:description" content="<?php echo $des?>"/>
<meta property="og:url" content="<?php echo lay_url()?>"/>
<meta property="og:site_name" content="<?php echo $tit?>"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $des?>" />
<meta name="twitter:title" content="<?php echo $tit?>" />
<meta name="twitter:image" content="<?php echo $imgmxh?>" />	
<link rel="icon" href="upload/favicon/<?php echo $ru['favicon']?>" type="image/x-icon" />		
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='j/bootstrap.min.js'></script>
<script src='j/jquery.min.js'></script>
<?php
if(isset($_COOKIE['iduser']) and ((isset($_GET['m']) and ($_GET['m']=='dangnhap' or $_GET['m']=='dangky')) or !isset($_GET['m']))){
    ?>
    <script>window.location="/m/cpanel/";</script>
    <?php
}
?>
<style>
h2,h3,h4{
    font-size: 20px;
    font-family: "Exo 2", sans-serif;
}
.title_module_main .h2 span, .title_module_main .h2 a, .title_module_main h2 span, .title_module_main h2 a {
    color: #3c4550;
    text-decoration: none;
    font-size: 20px;
    display: inline-block;
    padding: 0 0 40px;
    position: relative;
    z-index: 99;
    font-family: "Exo 2", sans-serif;
}
.section_blog {
    padding: 50px 0 0;
    margin-top: 60px;
    background: #f8fcff;
    padding-bottom: 60px;
}
.a_baoimg{
    width: 100%; padding-top: 110px; position: relative;
}
@media (max-width: 991px){
.a_baoimg{
    padding-top: 70px;
}
}
</style></head>
<body style="">
<style>
html{
    background-image: url(images/bgdoinhompc2.jpg);
        background-repeat: no-repeat;
        background-size: cover; 
        background-position:top center; 
}
body{background: none;}
    .baobao{
        width: 100%;
        position: relative;
        z-index: 5;
    }
    form.dnav{
        padding: 40px 30px;
        background: white;
        margin-bottom: 50px;
        border-radius: 7px;
        box-shadow: 0 0 7px #b7b7b7;
        position: relative;
        z-index: 5;
    }
    form.dnav input.khacsm,form.dnav select.khacsm{
        width: 100%;
        margin-bottom: 10px;
        padding: 8px 10px;
        border: 1px dotted #c1c1c1;
        border-radius: 6px;
        background: white;
    }
p.copy{
    text-align: center;
    width: 100%;
    color: #037f81;
   
    }
@media (max-width: 991px){
html{
    background-image: url(images/bgnb.png);
        background-repeat: no-repeat;
        background-size: cover; 
        background-position:top center; 
}
    .baobao{
        width: 100%;
        position: relative;
        z-index: 5;
    }
    form.dnav{
        padding: 40px 30px;
        background: white;
        margin-bottom: 50px;
        border-radius: 7px;
        box-shadow: 0 0 7px #b7b7b7;
        position: relative;
        z-index: 5;
    }
    form.dnav input.khacsm, form.dnav select.khacsm{
        width: 100%;
        margin-bottom: 10px;
        padding: 8px 10px;
        border: 1px dotted #c1c1c1;
        border-radius: 6px;
        background: white;
    }
    p.copy{
    text-align: center;
    width: 100%;
    color: #037f81;
    }
}
form.dnav .nutdn{
    width: 100%;
    padding: 10px 8px;
    border: 0;
    background: #03a9f4;
    color: white;
    border-radius: 4px;
}
form.dnav p.dieuhuong{
    padding-top: 20px;
    text-align: center;
    font-size: 1em;
}
form.dnav p.dieuhuong a{
    color: #666;
    padding: 8px;
}
form.dnav p.dieuhuong a.quen{
    
}
form.dnav p.dieuhuong a i{color: #888;}

</style>
<?php if($type=='dangnhap'){?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 20px;"><img src="upload/favicon/<?php echo $ru[logo]?>" style="display: block; margin: 30px auto; width: 300px; max-width: 80%;" /></div>
                <p class="text-center" style="font-size: 1.1em; font-weight: 500;"><i class="fas fa-key"></i> Đăng nhập</p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <input class="khacsm" type="text" value="" id="username" required="" value="username" placeholder="Số điện thoại" />
                    <input class="khacsm" type="password" id="password" name="pass" required="" placeholder="Mật khẩu" />
                    <input class="nutdn" type="button" id="dangnhap" name="dangnhap" value="Đăng nhập" />
                    <p class="dieuhuong"><a href="/dangky"><i class="fas fa-user-edit"></i> Đăng ký</a> <a class="quen" href="/quenmatkhau"><i class="fas fa-key"></i> Quên mật khẩu</a></p>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color: #232323;">Support 24/7: <a style="color: #232323;" href="tel:<?php echo $ru['phone']?>"><?php echo $ru['phone']?></a></p>
        <p class="copy">Copyright 2022-<?php echo date('Y')?> <br />© All rights reserved <b><?php echo $domains?></b></p>
    </div>
<script>
$('body').ready(function(){
    $('#dangnhap').click(function(){
    var username = $('#username').val();
    if(username==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại của bạn</p>');$('#username').focus();
    return false;
    }
    var vnf_regex = /((09|03|07|08|05|01)+([0-9]{8})\b)/g;
    if (vnf_regex.test(username) == false) 
    {
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');$('#username').focus();
    return false;
    }
    var password = $('#password').val();
    if(password==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu</p>');$('#password').focus();
    return false;
    }
    $.ajax({
        url : "./ajax.php", 
        type : "post",
        dateType:"text",
        data : { 
        typeform : 'login',
        username : username,
        password : password
    },
    success : function (data){
    var load=data.split("*");
    if(Number(load[0])==0){
        $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> SĐT hoặc mật khẩu không đúng</p>');
    }else{
        $('#thongbaott').html('<p style="color:#4caf50; font-size:0.9em;text-align:center"><i class="far fa-check-circle"></i> Đăng nhập thành công</p>');
        setTimeout(function(){
            <?php if(isset($_GET['url'])){?>
            window.location="<?php echo $_GET['url']?>";
            <?php }else{?>
            window.location.reload();
            <?php }?>
        },0)
    }
    }
    });
    })
    })
</script>
</section>
<?php }elseif($type=='quenmatkhau'){?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 20px;"><img src="upload/favicon/<?php echo $ru[logo]?>" style="display: block; margin: 30px auto; width: 300px; max-width: 80%;" /></div>
                <p class="text-center" style="font-size: 1.1em; font-weight: 500;"><i class="fas fa-key"></i> Quên mật khẩu</p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <!--input class="khacsm" type="phone" value="" id="phone" required="" value="phone" placeholder="Số điện thoại" /-->
                    <input class="khacsm" type="email" id="email" name="email" required="" placeholder="Email đã đăng ký" />
                    <input class="nutdn" type="button" id="quenmatkhau" name="quenmatkhau" value="Tiếp tục" />
                    <p id="dangload" style="text-align: center; font-style: italic; display: none;"><img style="margin: 15px auto;" src="images/loading.gif" width="30" /> &nbsp; Đang xử lý ... </p>
                    <p class="dieuhuong"><a href="/dangky"><i class="fas fa-user-edit"></i> Đăng ký</a> <a class="quen" href="/dangnhap"><i class="fas fa-key"></i> Đăng nhập</a></p>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color: #232323;">Support 24/7: <a style="color: #232323;" href="tel:<?php echo $ru['phone']?>"><?php echo $ru['phone']?></a></p>
        <p class="copy">Copyright 2022-<?php echo date('Y')?> <br />© All rights reserved <b><?php echo $domains?></b></p>
    </div>
<script>
$('body').ready(function(){
    $('#quenmatkhau').click(function(){
        
    /*var phone = $('#phone').val();
    if(phone==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại của bạn</p>');$('#phone').focus();
    return false;
    }
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    if (vnf_regex.test(phone) == false) 
    {
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');$('#phone').focus();
    return false;
    }*/
    var email = $('#email').val();
    if(email==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập email</p>');$('#email').focus();
    return false;
    }
    $('#quenmatkhau').hide();
    $('#dangload').show();
    $.ajax({
        url : "./ajax.php", 
        type : "post",
        dateType:"text",
        data : { 
        typeform : 'quenmatkhau',
        email : email
    },
    success : function (data){
    $('#quenmatkhau').show();
    $('#dangload').hide();
    var load=data.split("*");
    if(Number(load[0])==0){
        $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Email không tồn tại</p>');
    }else{
        setTimeout(function(){
            window.location="<?php echo $domain?>datmatkhau?email="+email;
        },0)
    }
    }
    });
    })
    })
</script>
</section>
<?php }elseif($type=='datmatkhau'){?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 20px;"><img src="upload/favicon/<?php echo $ru[logo]?>" style="display: block; margin: 30px auto; width: 300px; max-width: 80%;" /></div>
                <p class="text-center" style="font-size: 1.1em; font-weight: 500;"><i class="fas fa-key"></i> Đặt lại mật khẩu</p>
                <p style="background: #ddf0ff;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    color: #1d1c1e;
    font-size: 0.9em;">Một mã bảo mật đã được gửi tới địa chỉ <b><?php echo $_GET['email']?></b>. Hãy điền mã mà bạn nhận được và cập nhật lại mật khẩu của mình<br />
    Nếu không thấy email bạn hãy tìm trong mục <b>Spam</b>
    </p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <input class="khacsm" type="text" value="" id="mabaomat" required="" value="mabaomat" placeholder="Mã bảo mật" />
                    <input type="hidden" id="email" name="email" value="<?php echo $_GET['email']?>" />
                    <input class="khacsm" type="password" id="pass" name="pass" required="" placeholder="Mật khẩu mới" />
                    <input class="khacsm" type="password" id="repass" name="repass" required="" placeholder="Nhập lại mật khẩu mới" />
                    <input class="nutdn" type="button" id="datmatkhau" name="datmatkhau" value="Đặt lại mật khẩu" />
                    <p class="dieuhuong"><a href="/dangky"><i class="fas fa-user-edit"></i> Đăng ký</a> <a class="quen" href="/dangnhap"><i class="fas fa-key"></i> Đăng nhập</a></p>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color: #232323;">Support 24/7: <a style="color: #232323;" href="tel:<?php echo $ru['phone']?>"><?php echo $ru['phone']?></a></p>
        <p class="copy">Copyright 2022-<?php echo date('Y')?> <br />© All rights reserved <b><?php echo $domains?></b></p>
    </div>
<script>
$('body').ready(function(){
    $('#datmatkhau').click(function(){
    var email = $('#email').val();
    var mabaomat = $('#mabaomat').val();
    if(mabaomat==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mã bảo mật từ email của bạn</p>');$('#mabaomat').focus();
    return false;
    }
    var pass = $('#pass').val();
    if(pass==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu mới</p>');$('#pass').focus();
    return false;
    }
    var repass = $('#repass').val();
    if(repass==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu mới</p>');$('#repass').focus();
    return false;
    }
    if(pass!=repass){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không trùng khớp</p>');$('#repass').focus();
    return false;
    }
    $.ajax({
        url : "./ajax.php", 
        type : "post",
        dateType:"text",
        data : { 
        typeform : 'datmatkhau',
        mabaomat : mabaomat,
        email : email,
        pass : pass
    },
    success : function (data){
    var load=data.split("*");
    if(Number(load[0])==0){
        $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Mã bảo mật không đúng</p>');
    }else{
        $('#thongbaott').html('<p style="color:#4caf50; font-size:0.9em;text-align:center"><i class="far fa-check-circle"></i> Đặt lại mật khẩu thành công</p>');
        setTimeout(function(){
            window.location="<?php echo $domain?>logout.php";
        },1000)
    }
    }
    });
    })
    })
</script>
</section>
<?php }elseif($type!='dangnhap' and $type!='quenmatkhau' and $sp==0){?>
<?php if(isset($_GET['code'])){$thongtin=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where madon='$_GET[code]'"));}?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 20px;"><img src="upload/favicon/<?php echo $ru[logo]?>" style="display: block; margin: 30px auto; width: 300px; max-width: 80%;" /></div>
                <p class="text-center" style="font-size: 1.1em; font-weight: 600;"><i class="fas fa-user-edit"></i> Đăng ký tham gia</p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <input class="khacsm" type="text" value="<?php if(isset($_GET['code'])){echo addslashes($thongtin['hoten']); }?>" required="" id="hoten" placeholder="Họ tên *" />
                    <input class="khacsm" type="number" value="<?php if(isset($_GET['code'])){echo addslashes($thongtin['sdt']); }?>" id="username" required="" name="username" placeholder="Số điện thoại *" />
                    <input class="khacsm" type="email" value="" id="email" required="" name="email" placeholder="Email của bạn *" />
                    <input class="khacsm" type="text" value="<?php if(isset($_GET['code'])){echo addslashes($_GET['code']); }?>" id="code" required="" name="code" placeholder="SĐT người hướng dẫn trực tiếp* "  />
                    <div id="thongtinupline"></div><input type="hidden" value="0" id="checkcode" />
                    <input class="khacsm" type="text" value="" id="code2" required="" name="code2" placeholder="SĐT ghép cây* "  />
                    <div id="thongtinupline2"></div><input type="hidden" value="0" id="checkcode2" />
                    <select class="form-control khacsm" id="tinh">
                      <option value="0">-- Chọn tỉnh thành (*) --</option>
                      <?php $tinh=@mysqli_query($con,"select * from tinh order by id asc");while($rtinh=@mysqli_fetch_assoc($tinh)){?>
                      <option value="<?php echo $rtinh['id']?>"><?php echo $rtinh['ten']?></option>
                      <?php }?>
                    </select>
                    <div id="thongtintinh"></div>
                    <select class="form-control khacsm" id="huyen">
                      <option value="0">-- Chọn huyện (*) --</option>
                    </select>
                    <div id="thongtinhuyen"></div>
                    <input class="khacsm" type="password" id="password" name="pass" required="" placeholder="Mật khẩu *" />
                    <input class="khacsm" type="password" id="repassword" name="repass" required="" placeholder="Nhập lại mật khẩu *" />
                    <input class="nutdn" type="button" id="dangky" name="dangky" value="Đăng ký tài khoản" />
                    <span id="loadingchung" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                    <p class="dieuhuong"><a href="/dangnhap"><i class="fas fa-sign-in-alt"></i> Đăng nhập </a>  <a class="quen" href="/quenmatkhau"><i class="fas fa-key"></i> Quên mật khẩu</a></p>
                </form> 
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color: #232323;">Support 24/7: <a style="color: #232323;" href="tel:<?php echo $ru['phone']?>"><?php echo $ru['phone']?></a></p>
        <p class="copy">Copyright 2022-<?php echo date('Y')?> <br />© All rights reserved <b><?php echo $domains?></b></p>
    </div>
<script>
$('body').ready(function(){
    $('#tinh').change(function(){
        var tinh=$('#tinh').val();
        $.ajax({
            url : "./ajax.php", 
            type : "post",
            dateType:"text",
            data : { 
                typeform : 'loadhuyen',
                tinh : tinh
                },
            success : function (data5){
                $('#huyen').html(data5);
            }
        });
    });
    <?php 
    if(isset($_GET['code'])){
    ?>
    var code = $('#code').val();
    checkcode(code);
    <?php }?>
                $('#code').keyup(function(){
                    var code = $('#code').val();
                    checkcode(code);
                });
                $('#code2').keyup(function(){
                    var code2 = $('#code2').val();
                    checkcode2(code2);
                });
    $('#dangky').click(function(){
                    $('#thongbaott').html('');
                    var check1=0;var check2=0; var check3=0;
                    var hoten = $('#hoten').val();
                if(hoten==''){
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập họ tên của bạn</p>');
                    $('#hoten').focus();
                    setTimeout(function(){
                                        $('#thongbaott').html('');
                    },3000);
                    return false;
                }
                var username = $('#username').val();
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                if(username==''){
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại của bạn</p>');
                    $('#username').focus();
                    setTimeout(function(){
                                        $('#thongbaott').html('');
                    },3000);
                    return false;
                }else if (vnf_regex.test(username) == false) 
                {
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');
                    $('#username').focus();
                    setTimeout(function(){
                                        $('#thongbaott').html('');
                            },3000);
                    return false;
                }else{
                    $('#loadingchung').show();
                    $('#dangky').hide();
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'checkusernamedkchua',
                            username : username
                        },
                        success : function (data1){
                        if(Number(data1)==0){
                            $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> SĐT đã được đăng ký</p>');
                            $('#username').focus();
                            setTimeout(function(){
                                        $('#thongbaott').html('');
                            },3000);
                            return false;
                        }else{
                            var password = $('#password').val();
                            var repassword = $('#repassword').val();
                            var code=$('#code').val();
                            var code2=$('#code2').val();
                            var checkcode=$('#checkcode').val();
                            var email=$('#email').val();
                            var regExps = /^[A-Za-z][\w$.]+@[\w]+\.\w+$/;
                            var tinh = $('#tinh').val();
                            var huyen = $('#huyen').val();
                            if(email==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập email của bạn</p>');
                                $('#email').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            } 
                            if(regExps.test(email)==false){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Email không đúng định dạng</p>');
                                $('#email').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }
                            if(code==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập SĐT trục tiếp</p>');
                                $('#code').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }
                            if(code2==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập SĐT gián tiếp</p>');
                                $('#code2').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }
                            if(checkcode==0){
                                $('#thongtinupline').html('<p style="font-size: 0.8em;color:red"><i class="fas fa-exclamation-triangle"></i> SĐT không tồn tại</p>');
                                $('#code').focus();
                                setTimeout(function(){
                                        $('#thongtinupline').html('');
                                },3000);
                                return false;
                            }
                            if(tinh==0){
                                $('#thongtintinh').html('<p style="font-size: 0.8em;color:red"><i class="fas fa-exclamation-triangle"></i> Bạn đang ở Tỉnh/TP nào?</p>');
                                setTimeout(function(){
                                        $('#thongtintinh').html('');
                                },3000);
                                return false;
                            }
                            if(huyen==0){
                                $('#thongtinhuyen').html('<p style="font-size: 0.8em;color:red"><i class="fas fa-exclamation-triangle"></i> Bạn đang ở Quận/huyện nào?</p>');
                                setTimeout(function(){
                                        $('#thongtinhuyen').html('');
                                },3000);
                                return false;
                            }
                            if(password==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu</p>');
                                $('#password').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }
                            if(repassword==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu</p>');
                                $('#repassword').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }
                            if(password!=repassword){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>');
                                $('#repassword').focus();
                                setTimeout(function(){
                                        $('#thongbaott').html('');
                                },3000);
                                return false;
                            }else{check3=1;}
                            if(check3 ==1){
                                
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { 
                                    typeform : 'dangkytaikhoan',
                                    hoten : hoten,
                                    username : username,
                                    email : email,
                                    tinh:tinh,
                                    huyen:huyen,
                                    code : code,
                                    code2 : code2,
                                    password : password
                                },
                                success : function (data5){
                                    
                                if(Number(data5)==0){
                                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Có lỗi, vui lòng làm lại.</p>');
                                }else if(Number(data5)==2){
                                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Tài khoản ghép cây không thuộc hệ thống người giới thiệu trực tiếp.</p>');
                                }else{
                                    $('#thongbaott').html('<p style="color:#4caf50; font-size:0.9em;text-align:center"><i class="far fa-check-circle"></i> Đăng ký tài khoản thành công</p>');
                                    setTimeout(function(){
                                        window.location.reload();
                                    },0)
                                }
                                }
                                });
                            }
                            $('#loadingchung').hide();
                            $('#dangky').show();
                        }
                        }
                        });        
                }
                })
                function isEmail(email)
                {
                        var regExp = /^[A-Za-z][\w$.]+@[\w]+\.\w+$/;
                        return regExp.test(email);
                }
                function checkcode(code){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : {typeform : 'checkcode',code : code},
                        success : function (data5){
                                var load5=data5.split("*");
                                if(Number(load5[0])==0){
                                    $('#thongtinupline').html(load5[1]);
                                    $('#checkcode').val(0);
                                }else{
                                    $('#thongtinupline').html(load5[1]);
                                    $('#checkcode').val(1);
                                }
                                
                        }
                        });
                }
                function checkcode2(code){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : {typeform : 'checkcode2',code : code},
                        success : function (data5){
                                var load5=data5.split("*");
                                if(Number(load5[0])==0){
                                    $('#thongtinupline2').html(load5[1]);
                                    $('#checkcode2').val(0);
                                }else{
                                    $('#thongtinupline2').html(load5[1]);
                                    $('#checkcode2').val(1);
                                }
                                
                        }
                        });
                }
                })
                </script>   
</section>
<?php }else{}?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

	</body>
</html>