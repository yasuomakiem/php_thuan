<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');

$des=$ru['des'];
$tukhoa=$ru['tukhoa'];
$imgmxh=$domain.'upload/favicon/'.$ru['imgmxh'];
if($_GET['m']!='dangnhap' and $_GET['m']!='dangky'){exit();}
$type=addslashes($_GET['m']);
if(isset($_COOKIE['iduser'])){
    if($_COOKIE['iduser']==1){
        header("Location: /m/cpanel/");
    }else{
        //header("Location: /admin.php");
        header("Location: /m/cpanel/");
    }
}
if($type=='dangky'){
    $tit_nho='<a href="">Tài khoản của tôi</a> &raquo; <span>Đăng ký thành viên</span>';
    $tit_do='Đăng ký thành viên';
    $tit='Đăng ký thành viên'.$ru['tit'];
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
    $tit='Đăng nhập hệ thống - '.$ru['tit'];
}
?>

 <!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>

<meta charset="UTF-8" />
<base href="<?=$domain?>" />
<meta name="robots" content="all" />		
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
<meta name="description" content="Là hệ thống kinh doanh tối ưu nhất hiện nay với nhiều giải pháp hiệu quả và chuyên nghiệp, thúc đẩy mạnh mẽ quá trình bán hàng"/>		
<title><?=$tit?></title>
<meta property="description" content="Là hệ thống kinh doanh tối ưu nhất hiện nay với nhiều giải pháp hiệu quả và chuyên nghiệp, thúc đẩy mạnh mẽ quá trình bán hàng"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="Đăng nhập hệ thống"/>
<meta property="og:image" content="https://doinhom.com/upload/team/"/>
<meta property="og:description" content="Là hệ thống kinh doanh tối ưu nhất hiện nay với nhiều giải pháp hiệu quả và chuyên nghiệp, thúc đẩy mạnh mẽ quá trình bán hàng"/>
<meta property="og:url" content="https://doinhom.com/happyteam"/>
<meta property="og:site_name" content="HĐăng nhập hệ thống"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Là hệ thống kinh doanh tối ưu nhất hiện nay với nhiều giải pháp hiệu quả và chuyên nghiệp, thúc đẩy mạnh mẽ quá trình bán hàng" />
<meta name="twitter:title" content="Đăng nhập hệ thống" />
<meta name="twitter:image" content="https://doinhom.com/upload/team/" />	
<link rel="icon" href="upload/favicon/<?=$ru['favicon']?>" type="image/x-icon" />		
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='j/bootstrap.min.js'></script>
<script src='j/jquery.min.js'></script>
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
    form.dnav input.khacsm{
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
    color: silver;
   
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
    form.dnav input.khacsm{
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
    color: #285c75;
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
<?if(isset($_GET['m']) and $_GET['m']=='dangnhap'){?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 80px;"><img src="upload/banner/<?=$ru['logo']?>" style="display: block; margin: 30px auto; width: 200px;" /></div>
                <p class="text-center" style="color: white;font-size: 1.1em; font-weight: 500;"><i class="fas fa-key"></i> Đăng nhập</p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <input class="khacsm" type="text" value="" id="username" required="" value="username" placeholder="Số điện thoại" />
                    <input class="khacsm" type="password" id="password" name="pass" required="" placeholder="Mật khẩu" />
                    <input class="nutdn" type="button" id="dangnhap" name="dangnhap" value="Đăng nhập" />
                    <p class="dieuhuong"><a href="/dangky"><i class="fas fa-user-edit"></i> Đăng ký</a> <a class="quen" href="/fogetpass"><i class="fas fa-key"></i> Quên mật khẩu</a></p>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color:#767474;">Mọi khó khăn vui lòng liên hệ Admin <a href="tel:<?=$ru['phone']?>"><?=$ru['phone']?></a> để được hỗ trợ</p>
        <p class="copy">Copyright 2018-<?=date('Y')?> <br />© All rights reserved <b><?=$domains?></b></p>
    </div>
    
</section>
<?}elseif(isset($_GET['m']) and $_GET['m']=='dangky'){?>
<section class="baobao" id="baobao">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="logo" style="display: block; margin-top: 80px;"><img src="upload/banner/<?=$ru['logo']?>" style="display: block; margin: 30px auto; width: 200px;" /></div>
                <p class="text-center" style="color: white;font-size: 1.1em; font-weight: 500;"><i class="fas fa-user-edit"></i> Đăng ký</p>
                <form class="dnav" action="" method="post">
                <span id="thongbaott"></span>
                    <input class="khacsm" type="text" value="" required="" id="hoten" placeholder="Họ tên *" />
                    <input class="khacsm" type="number" value="" id="username" required="" name="username" placeholder="Số điện thoại *" />
                    <input class="khacsm" type="email" value="" id="email" required="" name="email" placeholder="Email của bạn *" />
                    <?if(isset($_COOKIE['reff'])){?>
                    <input type="hidden" value="<?=$_COOKIE['reff']?>" id="reff" name="reff" />
                    <?}else{?>
                    <input class="khacsm" type="number" value="" id="upline" required="" name="upline" placeholder="Số điện thoại người giới thiệu *" />
                    <input type="hidden" value="" id="reff" name="reff" />
                    <div id="thongtinupline"></div>
                    <?}?>
                    <input class="khacsm" type="password" id="password" name="pass" required="" placeholder="Mật khẩu *" />
                    <input class="khacsm" type="password" id="repassword" name="repass" required="" placeholder="Nhập lại mật khẩu *" />
                    <input class="nutdn" type="button" id="dangky" name="dangky" value="Đăng ký tài khoản" />
                    
                    <p class="dieuhuong"><a href="/dangnhap"><i class="fas fa-sign-in-alt"></i> Đăng nhập </a>  <a class="quen" href="/fogetpass"><i class="fas fa-key"></i> Quên mật khẩu</a></p>
                </form> 
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center" style="color:#767474;">Mọi khó khăn vui lòng liên hệ Admin <a href="tel:<?=$ru['phone']?>"><?=$ru['phone']?></a> để được hỗ trợ</p>
        <p class="copy">Copyright 2018-<?=date('Y')?> <br />© All rights reserved <b><?=$domains?></b></p>
    </div>
    
</section>
<?}else{exit();}?>
<script>
$('body').ready(function(){
    $('#dangnhap').click(function(){
    var username = $('#username').val();
    if(username==''){
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại của bạn</p>');$('#username').focus();
    return false;
    }
    /*var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    if (vnf_regex.test(username) == false) 
    {
    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');$('#username').focus();
    return false;
    }*/
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
            <?if(isset($_GET['url'])){?>
            window.location="<?=$_GET['url']?>";
            <?}else{?>
            window.location.reload();
            <?}?>
        },1000)
    }
    }
    });
    })
    })
</script>
<script>
                $('body').ready(function(){
                $('#upline').keyup(function(){
                    var phoneup = $('#upline').val();
                    checkupline(phoneup);
                });
                $('#dangky').click(function(){
                    $('#thongbaott').html('');
                    var check1=0;var check2=0; var check3=0;
                    var hoten = $('#hoten').val();
                    if(hoten==''){
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập họ tên của bạn</p>');
                    $('#hoten').focus();
                    return false;
                    }
                    var username = $('#username').val();
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                if(username==''){
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại của bạn</p>');
                    $('#username').focus();
                    return false;
                }else if (vnf_regex.test(username) == false) 
                {
                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');
                    $('#username').focus();
                    return false;
                }else{
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
                            return false;
                        }else{
                            var password = $('#password').val();
                            var repassword = $('#repassword').val();
                            var reff=$('#reff').val();
                            var email=$('#email').val();
                            var regExp = /^[A-Za-z][\w$.]+@[\w]+\.\w+$/;
                            if(email==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập email của bạn</p>');
                                $('#email').focus();
                                return false;
                            } 
                            if(regExp.test(email)==false){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Email không đúng định dạng</p>');
                                $('#email').focus();
                            }
                            if(reff==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Bạn phải có người giới thiệu</p>');
                                $('#upline').focus();
                                return false;
                            }
                            if(password==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu</p>');
                                $('#password').focus();
                                return false;
                            }
                            if(repassword==''){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu</p>');
                                $('#repassword').focus();
                                return false;
                            }
                            if(password!=repassword){
                                $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>');
                                $('#repassword').focus();
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
                                    reff : reff,
                                    password : password
                                },
                                success : function (data5){
                                var load5=data5.split("*");
                                if(Number(load5[0])==0){
                                    $('#thongbaott').html('<p style="color:red; font-size:0.9em"><i class="fas fa-exclamation-triangle"></i> Có lỗi, vui lòng làm lại.</p>'+load5[1]);
                                }else{
                                    $('#thongbaott').html('<p style="color:#4caf50; font-size:0.9em;text-align:center"><i class="far fa-check-circle"></i> Đăng ký tài khoản thành công</p>');
                                    setTimeout(function(){
                                        window.location.reload();
                                    },1000)
                                }
                                }
                                });
                            }
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
                function checkupline(phoneupline){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : {typeform : 'checkupline',phoneupline : phoneupline},
                        success : function (data5){
                                var load5=data5.split("*");
                                if(Number(load5[0])==0){
                                    $('#thongtinupline').html(load5[1]);
                                }else{
                                    $('#thongtinupline').html(load5[1]);
                                    $('#reff').val(load5[0]);
                                    //setTimeout(function(){
                                    //    window.location.reload();
                                    //},1000)
                                }
                        }
                        });
                }
                })
                </script>   
                
                <!--script language="JavaScript">
                var my_timeout=setTimeout("gotosite();",0);
                function gotosite()
                {
                window.location="/";
                }
                </script-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

	</body>
</html>