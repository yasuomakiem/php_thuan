<?
require_once('include/connect.php');
require_once('include/function.php');
if(isset($_GET['type']) and $_GET['type']=='register'){
$title='Tạo tài khoản';
}else{
    $title='Đăng nhập hệ thống';
}
$des='Tạo tài khoản hoặc đăng nhập.';
$imgmxh='';
?>
<!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>
<?require_once('include/header.php');?>
</head>
<body>
<?require_once('include/head.php');?>
<section class="danhmuc">
    <div class="container">
        <div class="row">
            <div class="boxl" style="padding-top: 0; padding-bottom: 0;">
            <div class="col-md-4 hidden-xs" style="background: #dc2626;border-radius: 10px 0 0 10px;">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
               <img class="img-responsive" src="/images/anhdangkydangnhap.png" alt="anh dang ky dang nhap" />
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p><p>&nbsp;</p>
            </div>
            <div class="col-md-8 col-xs-12">
            <?if(isset($_GET['type']) and $_GET['type']=='register'){
            $fullname='';
            $email='';
            $phone='';
            $pass='';
            $repass='';
            if(isset($_POST['dangky'])){
                $fullname=addslashes($_POST['fullname']);
                $email=addslashes($_POST['email']);
                $phone=addslashes($_POST['phone']);
                $tinh=addslashes($_POST['tinh']);
                $huyen=addslashes($_POST['huyen']);
                $pass=addslashes($_POST['pass']);
                $repass=addslashes($_POST['repass']);
                if($tinh!=''){
                if($_POST['dongy']==1){
                    if($pass==$repass){
                        $tim=@mysqli_query($con,"select * from user where phone='$phone'");
                        if(@mysqli_num_rows($tim)==0){
                            $tim2=@mysqli_query($con,"select * from user where email='$email'");
                            if(@mysqli_num_rows($tim2)==0){
                                $matkhau=md5($pass);
                                if(isset($_GET['ref'])){
                                        $ref=intval($_GET['ref']);
                                }else{
                                    if(isset($_COOKIE['ref'])){
                                        $ref=intval($_COOKIE['ref']);
                                    }else{
                                        $ref=1;
                                    }
                                }
                                //tim he thong
                                $gt=@mysqli_fetch_assoc(@mysqli_query($con,"select hethong from user where id=$ref"));
                                $hethong=$gt['hethong'].'-'.$ref.'-';
                                $in=@mysqli_query($con,"insert into user (idgioithieu,hethong,fullname,email,phone,tinh,huyen,pass,time)value($ref,'$hethong',N'$fullname','$email','$phone','$tinh','$huyen','$matkhau',$time)");
                                if($in){
                                    echo '
                                        <script language="JavaScript">
                                        var my_timeout=setTimeout("gotosite();",0);
                                        function gotosite()
                                        {
                                        window.location="/cookie.php?ref='.$ref.'&phone='.$phone.'&pass='.$matkhau.'";
                                        }
                                        </script>
                                        ';// cái này là chuyển trang bằng javascript
                                    exit();
                                }
                            }else{
                                $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Email này đã được đăng ký</p>';
                            }
                        }else{
                            $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Số điện thoại này đã được đăng ký</p>';
                        }
                    }else{
                        $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>';
                    }
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Bạn phải đồng ý với chính sách của chúng tôi</p>';
                }
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Bạn chưa chọn khu vực sinh sống của bạn</p>';
                }
            }    
            ?>
            <h4 class="title titdangnhap"><span>Đăng ký</span> <a href="account/login">Đăng nhập</a></h4>
                <form class="form-horizontal" role="form" method="post" action="">
                <?=$thongbao?>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Họ tên</label>               
                    <div class="col-sm-10">                
                      <input type="text" class="form-control" name="fullname" id="inputname" value="<?=$fullname?>" required="" placeholder="Nhập tên thật của bạn"/>                
                    </div>              
                  </div>
                  <div class="form-group">                
                    <label class="col-sm-2 control-label">Email</label>                
                    <div class="col-sm-10">               
                      <input type="email" class="form-control" name="email" value="<?=$email?>" id="inputEmai" required="" placeholder="Nhập email của bạn"/>                
                    </div>                
                  </div>
                  <div class="form-group">                
                    <label class="col-sm-2 control-label">Số điện thoại</label>               
                    <div class="col-sm-10">               
                      <input type="number" class="form-control" name="phone" value="<?=$phone?>" id="inputsdt" required="" placeholder="Nhập số điện thoại của bạn"/>                
                    </div>                
                  </div>
                <div class="form-group">                
                    <label class="col-sm-2 control-label">Khu vực</label>                
                    <div class="col-sm-10">
                        <select class="form-control" id="tinh" name="tinh" style="width: 49%; float: left;">
                            <option value="">Chọn Tỉnh/TP...</option>
                            <?
                            $tinhthanhpho=@mysqli_query($con,"select * from tinhthanhpho order by name asc");
                            while($rttp=@mysqli_fetch_assoc($tinhthanhpho)){
                            ?>
                                <option value="<?=$rttp['matp']?>"><?=str_replace("Tỉnh ","",str_replace("Thành phố ","",$rttp['name']))?></option>
                            <?}?>
                        </select>
                        <select class="form-control" id="huyen" name="huyen" style="width: 50%; float: right;">
                            <option value="">...</option>
                        </select>                        
                    </div>
                <script>
                $(function() {  
                    $('#tinh').change(function(){
                        var tinh = $('#tinh').val();
                        $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            tinh : tinh,
                            typeform : "loadhuyen"
                        },
                        success : function (result){
                            $('#huyen').html(result);
                        }
                        });
                    });
                });
                </script>
                  </div>
                  <div class="form-group">                
                    <label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu</label>                
                    <div class="col-sm-10">                
                      <input type="password" required="" name="pass" value="<?=$pass?>" class="form-control" id="inputPassword3" placeholder="Nhập mật khẩu"/>                
                    </div>                
                  </div>
                <div class="form-group">               
                    <label for="inputPassword3" class="col-sm-2 control-label">Nhập lại mật khẩu</label>                
                    <div class="col-sm-10">                
                      <input type="password" required="" name="repass" value="<?=$repass?>" class="form-control" id="inputPassword3" placeholder="Nhập lại mật khẩu lần nữa"/>               
                    </div>               
                  </div>
                  <div class="form-group">               
                    <div class="col-sm-offset-2 col-sm-10">                
                      <div class="checkbox">                
                        <label>                
                          <input type="checkbox" required="" name="dongy" value="1" style="top: 4px;" checked=""/> Đồng ý với <a href="">chính sách</a> của <b>Mumi</b>                
                        </label>               
                      </div>                
                    </div>                
                  </div>                
                  <div class="form-group">                
                    <div class="col-sm-offset-2 col-sm-10">                
                      <button type="submit" class="btn btn-primary" name="dangky">Tạo tài khoản</button>                                     
                    </div>                
                  </div>                
                </form>                
            <p>&nbsp;</p>  
            <?}else{
                if(isset($_GET['url'])){$urlfrom=addslashes($_GET['url']);}else{$urlfrom='';}
                $phone='';
                $pass='';
                if(isset($_POST['dangnhap'])){
                    $phone=addslashes($_POST['phone']);
                    $pass=addslashes($_POST['pass']);
                    $mk=md5($pass);
                    $tim=@mysqli_query($con,"select * from user where phone='$phone' and pass='$mk'");
                    if(@mysqli_num_rows($tim)==1){
                        $rtim=@mysqli_fetch_assoc($tim);
                        if($urlfrom==''){
                            echo '
                            <script language="JavaScript">
                            var my_timeout=setTimeout("gotosite();",0);
                            function gotosite()
                            {
                            window.location="/cookie.php?phone='.$rtim['phone'].'&pass='.$mk.'";
                            }
                            </script>
                            ';
                            exit();
                        }else{
                            echo '
                            <script language="JavaScript">
                            var my_timeout=setTimeout("gotosite();",0);
                            function gotosite()
                            {
                            window.location="/cookie.php?url='.$urlfrom.'&phone='.$rtim['phone'].'&pass='.$mk.'";
                            }
                            </script>
                            ';
                            exit();
                        }
                    }else{
                        $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Số điện thoại hoặc mật khẩu không đúng</p>';
                    }
                }
                ?>
            <h4 class="title titdangnhap"><span>Đăng nhập</span> <a href="account/register">Đăng ký</a></h4>
                <form class="form-horizontal" role="form" action="" method="post">
                <?=$thongbao?>
                  <div class="form-group">              
                    <label class="col-sm-2 control-label">Số điện thoại</label>                
                    <div class="col-sm-10">                
                      <input type="number" class="form-control" name="phone" id="phone" required="" value="<?=$phone?>" placeholder="Nhập số điện thoại của bạn"/>                
                    </div>            
                  </div>               
                  <div class="form-group">               
                    <label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu</label>                
                    <div class="col-sm-10">              
                      <input type="password" class="form-control" name="pass" id="inputPassword3" value="<?=$pass?>" required="" placeholder="Password">                
                    </div>                
                  </div>                
                  <div class="form-group">                
                    <div class="col-sm-offset-2 col-sm-10">                
                      <div class="checkbox">               
                        <label>               
                          <input type="checkbox" style="top: 4px;" checked=""/> Ghi nhớ mật khẩu              
                        </label>                
                      </div>               
                    </div>               
                  </div>                
                  <div class="form-group">                
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="dangnhap" class="btn btn-primary">Đăng nhập</button>
                      <a style="float: right;display: block;margin-top: 10px;" href="">Quên mật khẩu</a>
                    </div>                
                  </div>                
                </form>
                <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?}?>
            </div>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
<?require_once('include/footer.php');?>
</body>
</html>