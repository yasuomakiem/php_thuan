<?php
header("Access-Control-Allow-Origin: *");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('include/connect.php');
require_once('include/function.php');
$tim="select * from dh_user where id=$iduser";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);$emailform='web300k.com@gmail.com';
if(isset($_POST['typeform']) and $_POST['typeform']=='datdon'){
    $hoten=addslashes($_POST['hoten']);
    $sdt=addslashes($_POST['sdt']);
    $diachi=addslashes($_POST['diachi']);
    $idsoluongs=addslashes($_COOKIE['cart']); 
    $cart=explode("*",$idsoluongs);
                    $tongtien=0;
                    $tongds=0;
                    $tongdiem=0;
                    for($i=0;$i<count($cart);$i++){
                        $idsoluong=explode("-",$cart[$i]);
                        $idsp=$idsoluong[0];
                        $ttsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                        $tongtien=$tongtien+ $ttsp['gia']*$idsoluong[1];
                        $tongds=$tongds+ $ttsp['doanhso']*$idsoluong[1];
                        $tongdiem=$tongdiem+$ttsp['diem']*$idsoluong[1];
                        }
    $inn=@mysqli_query($con,"insert into dh_donhang (iduser,idsoluong,hoten,sdt,diachi,tien,doanhso,diem,time)value($u[id],'$idsoluongs',N'$hoten',N'$sdt',N'$diachi',$tongtien,$tongds,$tongdiem,$time)");
    setcookie("cart",'',time() -  60*60*24*3);
}

 if(isset($_POST['typeform']) and $_POST['typeform']=='capnhataccountchung'){
    $fullname=addslashes($_POST['fullname']);
    $ngaysinh=addslashes($_POST['ngaysinh']);
    $gioitinh=addslashes($_POST['gioitinh']);
    $tinh=intval($_POST['tinh']);
    $huyen=intval($_POST['huyen']); 
    $email=addslashes($_POST['email']);
    $facebook=addslashes($_POST['facebook']); 
    if($facebook!=''){
    $facebook=layuid($facebook);
    }
        //if(@mysql_num_rows(@mysql_query("select id from user where phone = '$phone'"))==0){
                if(@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where email = '$email'"))==0 or $email==$u['email']){
                    $in=@mysqli_query($con,"update dh_user set fullname=N'$fullname',facebook='$facebook',gioitinh=N'$gioitinh',ngaysinh='$ngaysinh',tinh=$tinh,huyen=$huyen,email='$email' where id=$u[id]");
                    if($in){
                        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Cập nhật thành công<p>';
                    }else{
                        echo '1***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Cập nhật không thành công<p>';//co loi
                    }
                }else{
                    echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Email đã tồn tại<p>';//co loi
                }
        //}else{
        //    echo 1;//ten dang nhap da co
        //}
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtrauser'){
    $phoneuser=addslashes($_POST['phoneuser']);
    $in=@mysqli_query($con,"select * from dh_user where phone='$phoneuser'");
    if(@mysqli_num_rows($in)==1){
        $uus=@mysqli_fetch_assoc($in);
        echo '1*<p style="color:#4caf50"><i class="fas fa-check"></i> <b>'.$uus['fullname'].'</b></p>';
    }else{
        echo '0*<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Tài khoản không tồn tại, hãy kiểm tra lại</p>';;
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtrauser_docquyen'){
    $phoneuser=addslashes($_POST['phoneuser']);
    $in=@mysqli_query($con,"select * from dh_user where phone='$phoneuser'");
    if(@mysqli_num_rows($in)==1){
        $uus=@mysqli_fetch_assoc($in);
        $dqtinh=@mysqli_query($con,"select fullname from dh_user where docquyentinh=$uus[tinh]");
        $tentinh=@mysqli_fetch_assoc(@mysqli_query($con,"select * from tinh where id=$uus[tinh]"));
        if(@mysqli_num_rows($dqtinh)>0){
            $rdqtinh=@mysqli_fetch_assoc($dqtinh);
            echo '<p style="color:#333"><i class="fas fa-check"></i> <b>'.$tentinh['ten'].'</b> đã có độc quyền là <b>'.$rdqtinh['fullname'].'</b></p>';
        }else{
            echo '<p style="color:#4caf50"><a href="up.php?table=dh_user&loai=docquyentinh&up='.$uus['tinh'].'&id='.$uus['id'].'"><i class="fab fa-ups"></i> Kích hoạt <b>'.$uus['fullname'].'</b> độc quyền tỉnh/TP tại <b>'.$tentinh['ten'].'</b></a></p>';
        }
        $dqhuyen=@mysqli_query($con,"select fullname from dh_user where docquyenhuyen=$uus[huyen]");
        $tenhuyen=@mysqli_fetch_assoc(@mysqli_query($con,"select * from huyen where id=$uus[huyen]"));
        if(@mysqli_num_rows($dqhuyen)>0){
            $rdqhuyen=@mysqli_fetch_assoc($dqhuyen);
            echo '<p style="color:#333"><i class="fas fa-check"></i> <b>'.$tenhuyen['ten'].'</b> đã có độc quyền là <b>'.$rdqhuyen['fullname'].'</b></p>';
        }else{
            echo '<p style="color:#4caf50"><a href="up.php?table=dh_user&loai=docquyenhuyen&up='.$uus['huyen'].'&id='.$uus['id'].'"><i class="fab fa-ups"></i> Kích hoạt <b>'.$uus['fullname'].'</b> độc quyền Quận/huyện tại <b>'.$tenhuyen['ten'].'</b></a></p>';
        }
    }else{
        echo '<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Tài khoản không tồn tại, hãy kiểm tra lại</p>';;
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='loadhuyen'){
    $tinh=intval($_POST['tinh']);
    if($tinh==0){
        echo '<option value="0">-- Chọn huyện (*) --</option>';
    }else{
    $in=@mysqli_query($con,"select * from huyen where tinh_id=$tinh");
    echo '<option value="0">--Chọn huyện (*)--</option>';
    while($rh=@mysqli_fetch_assoc($in)){
        echo '<option value="'.$rh['id'].'">'.$rh['loai'].' '.$rh['ten'].'</option>';
    }
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='themlinkout'){
    $linkout=addslashes($_POST['linkout']);
    $idcamp=intval($_POST['idcamp']);
    $in=@mysqli_query($con,"insert into setupcamp_user (idu,idcamp,linkout)value($_COOKIE[iduser],$idcamp,'$linkout')");
}
if(isset($_POST['typeform']) and $_POST['typeform']=='luutenlinkcamp'){
    $urlcamp=addslashes($_POST['urlcamp']);
    $tenlink=addslashes($_POST['tenlink']);
    $idcamp=intval($_POST['idcamp']);
    $in=@mysqli_query($con,"insert into reffland (ten,idu,reff,idcamp)value(N'$tenlink',$_COOKIE[iduser],N'$urlcamp',$idcamp)");
}
if(isset($_POST['typeform']) and $_POST['typeform']=='thaydoilinkout'){
    $idset=intval($_POST['selectedValue']);
    $idcamp=intval($_POST['idcamp']);
    if($idset==0){//update toàn bộ setcamp_user thành 0 với idcamp
        $in=@mysqli_query($con,"update setupcamp_user set sudung=0 where idu=$_COOKIE[iduser] and idcamp=$idcamp");
    }else{
        $in=@mysqli_query($con,"update setupcamp_user set sudung=1 where id=$idset");
        $in=@mysqli_query($con,"update setupcamp_user set sudung=0 where idu=$_COOKIE[iduser] and idcamp=$idcamp and id!=$idset");
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='checkurlcamp'){
    $urlcamp=addslashes($_POST['urlcamp']);
    $url=chuyen_khong_dau_gach_ngang($urlcamp);
    $idcamp=intval($_POST['idcamp']);
    $timurl= @mysqli_query($con,"select id from reffland where idcamp=$idcamp and reff='$url'");
    $idset=@mysqli_num_rows($timurl);
    if($idset==0){//ok chưa có
        echo $url;
    }else{
        echo 'linkkhongok';
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='capnhatmatkhau'){
    $pass=addslashes($_POST['pass']);
    $newpass=addslashes($_POST['newpass']);
        if(md5($pass)==$u['pass']){
            $passupdate=md5($newpass);
                    $in=@mysqli_query($con,"update dh_user set pass='$passupdate' where id=$u[id]");
                    if($in){
                        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Cập nhật thành công<p>';
                    }else{
                        echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Cập nhật không thành công<p>';//co loi
                    }
        }else{
           echo '1***i';//mật khẩu cũ không đúng
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='capnhatmatkhauruttien'){
    $pass=addslashes($_POST['pass']);
    $newpass=addslashes($_POST['newpass']);
        if(md5($pass)==$u['pass']){
            $passupdate=md5($newpass);
                    $in=@mysqli_query($con,"update dh_user set passtien='$passupdate' where id=$u[id]");
                    if($in){
                        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Cập nhật thành công<p>';
                    }else{
                        echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Cập nhật không thành công<p>';//co loi
                    }
        }else{
           echo '1***i';//mật khẩu cũ không đúng
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='dathangweb'){
    $ten=addslashes($_POST['ten']);
    $sdt=addslashes($_POST['sdt']);
    $diachi=addslashes($_POST['diachi']);
    $ghichu=addslashes($_POST['ghichu']);
    $reff=addslashes($_POST['reff']);
    $nguon=addslashes($_POST['nguon']);
        //tim reff
        $timr=@mysqli_query($con,"select * from reffsanpham where link='$reff'");
        
            $ban=@mysqli_fetch_assoc($timr);
            $idban=$ban['idu'];
        $uptimr=@mysqli_query($con,"update reffsanpham set mua=mua+1 where link='$reff'");
        //tạo mã đơn
        $madon=ucwords(strtolower(str_replace(" ","",$ru['viettatteam']))).$time.$idban;
        //tim gia san pham
        $tunsp=@mysqli_fetch_assoc(@mysqli_query($con,"select gia from dh_sanpham where id=$ban[idsp]"));
        $ins=@mysqli_query($con,"insert into donhang (madon,gia,idu,idsanpham,nentang,nguon,hoten,sdt,diachi,ghichu,time)value('$madon',$tunsp[gia],$idban,$ban[idsp],1,N'$nguon',N'$ten','$sdt',N'$diachi',N'$ghichu',$time)");
        if($ins){
            $noidung ="
                <p style='background: #000;padding: 15px;margin-bottom:0'><img style='width: 80px;display: block;margin: 0 auto;' src='$domain"."images/kiem300k.png' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Đơn hàng mới!</p>
                <p>Mã đơn hàng: #$madon<br/>Người nhận: <b>$ten</b> <br />SĐT: $sdt <br />Địa chỉ nhận hàng: $diachi</p>
                <p>Ghi chú: $ghichu</p>
                <p>Thời gian: ".retimefull($time)."</p>
                ";
                //$emailform=$u['email'];
                $emailform='buimanhdigital@gmail.com';
                $tieude='Đơn hàng ['.retimefull($time).']';
                $tenmail='Đơn hàng Affiliate';
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            echo '
            <p class="text-center" style="text-align: center;color: #36ad3b;padding: 30px 0;"><i class="fas fa-check"></i> Đơn hàng đã được gửi thành công</p>
                <p>Mã đơn hàng: #'.$madon.'<br/>Người nhận: <b>'.$ten.'</b> <br />SĐT: '.$sdt.' <br />Địa chỉ nhận hàng: '.$diachi.'</p>
                <p class="text-center">-----------</p>
                <p class="text-center">Chúng tôi sẽ gửi hàng cho tới bạn trong thời gian 2-3 ngày</p>
                <img src="images/thankyou.png" style="width: 140px; display: block; margin: 25px auto;" />
            ';
        }else{
            echo '
                <p class="text-center">Có lỗi, bạn hãy load lại trang hoặc liên hệ Hotline để được hỗ trợ</p>
                <p class="text-center">Hotline/Zalo: <a href="https://zalo.me/0977069099">0977.069.099</a></p>
                <img src="images/thankyou.png" style="width: 140px; display: block; margin: 25px auto;" />
            ';
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='guidonhang'){
    $tien=intval($_POST['tien']);
    $chuoi=addslashes($_POST['chuoi']);
    $chietkhau=intval($_POST['chietkhau']);
    $ten=addslashes($_POST['ten']);
    $sdt=addslashes($_POST['sdt']);
    $diachi=addslashes($_POST['diachi']);
    $note=addslashes($_POST['note']);
        //kiem tra lại tiền
        $timlaitien=@mysqli_fetch_assoc(@mysqli_query($con,"select vimua from dh_user where id=$u[id]"));
        if($tien<=$timlaitien['vimua']){
        $ins=@mysqli_query($con,"insert into donhang (chietkhau,tien,chuoi,idu,hoten,sdt,diachi,ghichu,time)value($chietkhau,$tien,'$chuoi',$u[id],N'$ten','$sdt',N'$diachi',N'$note',$time)");
        if($ins){
            //trừ tiền của chủ sở hữu lưu vào lích sử
            $uplai=@mysqli_query($con,"update dh_user set vimua=vimua-$tien where id=$u[id]");
            
            /*$noidung ="
                <p style='background: #000;padding: 15px;margin-bottom:0'><img style='width: 80px;display: block;margin: 0 auto;' src='$domain"."images/kiem300k.png' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Đơn hàng mới!</p>
                <p>Mã đơn hàng: #$madon<br/>Người nhận: <b>$ten</b> <br />SĐT: $sdt <br />Địa chỉ nhận hàng: $diachi</p>
                <p>Ghi chú: $ghichu</p>
                <p>Thời gian: ".retimefull($time)."</p>
                ";
                //$emailform=$u['email'];
                $emailform='buimanhdigital@gmail.com';
                $tieude='Đơn hàng ['.retimefull($time).']';
                $tenmail='Đơn hàng Affiliate';
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }*/
            echo 1;
        }else{
            echo 0;
        }
        }else{
            echo 0;
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='dathangchonsanpham'){
    $ten=addslashes($_POST['ten']);
    $sdt=addslashes($_POST['sdt']);
    $diachi=addslashes($_POST['diachi']);
    $ghichu=addslashes($_POST['ghichu']);
    $reff=intval($_POST['reff']);
    $nguon=addslashes($_POST['nguon']);
    $chanquay=addslashes($_POST['chanquay']);
    $banxoay=addslashes($_POST['banxoay']);
    $idsanpham=addslashes($_POST['idsanpham']);
    $idban=$reff;
        //tạo mã đơn
        $madon=ucwords(strtolower(str_replace(" ","",$ru['viettatteam']))).$time.$idban;
        //tim gia san pham
        $tunsp=@mysqli_fetch_assoc(@mysqli_query($con,"select gia from dh_sanpham where id=$idsanpham"));
        $ins=@mysqli_query($con,"insert into donhang (madon,gia,idu,idsanpham,nentang,nguon,hoten,sdt,diachi,ghichu,time,banxoay,chanquay)value('$madon',$tunsp[gia],$idban,$idsanpham,1,N'$nguon',N'$ten','$sdt',N'$diachi',N'$ghichu',$time,$banxoay,$chanquay)");
        if($ins){
            $noidung ="
                <p style='background: #000;padding: 15px;margin-bottom:0'><img style='width: 80px;display: block;margin: 0 auto;' src='$domain"."images/kiem300k.png' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Đơn hàng kinh doanh!</p>
                <p>Mã đơn hàng: #$madon<br/>Người nhận: <b>$ten</b> <br />SĐT: $sdt <br />Địa chỉ nhận hàng: $diachi</p>
                <p>Ghi chú: $ghichu</p>
                <p>Bàn xoay: $banxoay</p>
                <p>Chân quay: $chanquay</p>
                <p>Thời gian: ".retimefull($time)."</p>
                ";
                //$emailform=$u['email'];
                $emailform='buimanhdigital@gmail.com';
                $tieude='Đơn hàng KD ['.retimefull($time).']';
                $tenmail='Đơn hàng KD';
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            echo '
            <p class="text-center" style="text-align: center;color: #36ad3b;padding: 30px 0;"><i class="fas fa-check"></i> Đơn hàng đã được gửi thành công</p>
                <p>Mã đơn hàng: #'.$madon.'<br/>Người nhận: <b>'.$ten.'</b> <br />SĐT: '.$sdt.' <br />Địa chỉ nhận hàng: '.$diachi.'</p>
                <p class="text-center">-----------</p>
                <p class="text-center">Bây giờ hãy bấm vào nút dưới đây để đăng ký tài khoản bắt đầu học và kiếm tiền</p>
                <p class="text-center"><a type="button" class="btn btn-success" href="dangky?code='.$madon.'"><i class="fas fa-paper-plane"></i> Đăng ký tài khoản Bignet</a></p>
                <p class="text-center">-----------</p>
                <p class="text-center">Hotline/Zalo hỗ trợ: <a href="https://zalo.me/0977069099">0977.069.099</a></p>
                <img src="images/thankyou.png" style="width: 140px; display: block; margin: 25px auto;" />
            ';
        }else{
            echo '
                <p class="text-center">Có lỗi, bạn hãy load lại trang hoặc liên hệ Hotline để được hỗ trợ</p>
                <p class="text-center">Hotline/Zalo: <a href="https://zalo.me/0977069099">0977.069.099</a></p>
                <img src="images/thankyou.png" style="width: 140px; display: block; margin: 25px auto;" />
            ';
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtramatkhauruttien'){
    $passruttien=addslashes($_POST['passruttien']);
        if(md5($passruttien)==$u['passtien']){
            echo 1;
            /*$rand=substr(md5($time),0,6);
            setcookie("coderuttien",$rand,time() +  60*15);
            $noidung ="
                <p style='background: #ffeb3b;padding: 15px;margin-bottom:0'><img style='width: 80px;display: block;margin: 0 auto;' src='/images/logoboc.png' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Kính gửi: <b>$u[fullname]</b>!</p>
                <p>Chúng tôi xin chân thành cảm ơn sự tin tưởng của quý đại lý</p>
                <p>Hệ thống đã tiếp nhận yêu cầu rút tiền từ tài khoản quản lý dịch vụ từ quý đại lý.</p>
                <p style=\"color: #025879;font-size: 15px;\"><b>Mã bảo mật của bạn là:</b></p>
                <div style='padding: 15px;background: #607d8b;display: block;width: 150px;text-align: center;font-size: 2em;font-weight: bold;color: white;border-radius: 10px;'>$rand</div>
                <p>Mã có giá trị trong 15 phút</p>
                <p>Nếu bạn không yêu cầu rút tiền, hãy bỏ qua email này</p>
                </div>
                ";
                $emailform=$u['email'];
                $tieude='Mã bảo mật rút tiền từ tài khoản BOC của bạn';
                $tenmail='Mã rút tiền - BOC';
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }*/
        }else{
           echo 1;//không kiểm tra mk rút tiền. nêu skiểm tra thì chỗ này =0
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtramaruttien'){
    $maruttien=addslashes($_POST['maruttien']);
    $sotienrut=intval($_POST['sotienrut']);
    $phi=$sotienrut*$ru['pt_ruttien'];
    $sotientra=$sotienrut-$phi;
        //if($maruttien==$_COOKIE['coderuttien']){
        if($maruttien=='123456'){
            if($sotienrut>$u['virut']){
                echo -1;
            }else{  
                //dau tien, chuyen tien tu virut sang dongbang
                $upsd=@mysqli_query($con,"update dh_user set virut=virut-$sotienrut,dongbang=dongbang+$sotienrut where id=$u[id]");
                //luu vao co so du lieu ma lenh thanh toan
                $madon='HH'.date('dhi').strtoupper(substr(md5($time),0,2));
                $tieudetb='Lệnh rút tiền '.$madon.' Đã được tiếp nhận';
                $noidungtb='Bạn đã đặt lệnh rút số tiền <b style="color:red">'.number_format($sotientra,0,'.',',').'<sup>đ</sup></b> (Mã lệnh: '.$madon.') lúc '.retimefull($time).'. Yêu cầu của bạn đã được chúng tôi tiếp nhận. Nền tảng sẽ kiểm tra và thanh toán trong 24-48 giờ.';
                $upsd=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('trahoahong',1,'*$u[id]*',N'$tieudetb',N'$noidungtb',$time)");
                //giờ insert vào bảng rút tiền
                $upsd2=@mysqli_query($con,"insert into yeucauruttien (idu,sotien,ma,time)value($u[id],$sotientra,'$madon',$time)");
                echo 1; 
                $nhnt= @mysqli_fetch_assoc(@mysqli_query($con,"select ten from bankbase where id=$u[bank]"));
                $noidung ="
                <p style='background: #04a0a3;padding: 15px 30px;width: 80%;display: block;margin: 0 auto;border-radius: 10px 10px 0 0;'><img style='width: 200px;display: block;margin: 0 auto;' src='$domain"."upload/favicon/$ru[logo]' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Thân gửi: <b>$u[fullname]</b>!</p>
                <p>Chúng tôi xin chân thành cảm ơn sự tin tưởng và đồng hành của bạn trong thời gian qua.</p>
                <p>Hệ thống đã tiếp nhận yêu cầu rút tiền từ tài khoản quản lý của bạn.</p>
                <p style=\"color: #025879;font-size: 15px;\"><b>Thông tin tài chính:</b></p>
                <p>Mã giao dịch: <b>#$madon</b></p>
                <table style='width: 100%;font-size: 1.2em;line-height: 39px;border: 1px solid #b3b3b3;'>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Ngân hàng nhận tiền</td><td>".$nhnt['ten']."</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Chủ tài khoản</td><td>".$u['fullname']."</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Số tài khoản</td><td>".$u['banknumber']."</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Số tiền rút</td><td><b style='color:red'>".number_format($sotienrut,0,',','.')."<sup>đ</sup></b></td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Phí dịch vụ ($ru[pt_ruttien]%)</td><td><b style='color:red'>".number_format($phi,0,',','.')."<sup>đ</sup></b></td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Số tiền thực nhận</td><td><b style='color:red'>".number_format($sotientra,0,',','.')."<sup>đ</sup></b></td>
                    </tr>
                    <tr>
                        <td style='text-align: right;padding-right: 20px;'>Trạng thái</td><td><i>Chờ thanh toán</i></td>
                    </tr>
                </table>
                <p>Thời gian thanh toán trong khoảng 24 - 48 giờ</p>
                <p><b>-- Admin $ru[viettatteam] Team --</b></p>
                </div>
                ";
                $emailform=$u['email'];
                $tieude='[#'.$madon.'] Giao dịch rút tiền mặt từ tài khoản '.$ru['viettatteam'].' của bạn';
                $tenmail='Giao dịch rút tiền - '.$ru['viettatteam'];
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }else{
            echo 0;
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='taomatkhauruttien'){
    $passtien=addslashes($_POST['passtien']);
    $passupdate=md5($passtien);
    $in=@mysqli_query($con,"update dh_user set passtien='$passupdate' where id=$u[id]");
    if($in){
        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Tạo mật khẩu thành công</p>';
    }else{
        echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Tạo mật khẩu không thành công</p>';//co loi
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='capnhatbank'){
    $bank=intval($_POST['bank']);
    $banknumber=intval($_POST['banknumber']);
    $in=@mysqli_query($con,"update dh_user set bank=$bank, banknumber='$banknumber' where id=$u[id]");
    if($in){
        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Cập nhật ngân hàng thành công</p>';
    }else{
        echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Cập nhật ngân hàng không thành công</p>';//co loi
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='chuyentien'){
    $sotien=intval($_POST['sotienrut']);
    if($sotien>$u['virut']){
        echo 0;
    }else{
    $in=@mysqli_query($con,"update dh_user set virut=virut-$sotien, vimua=vimua+$sotien where id=$u[id]");
    
    if($in){
        $level=1;
                
                if($sotien>=$ru['kichhoatnpp']){$level=2;}
                //cập nhật lelve cho thành viên
                if($u['level']<2){
                $upu=@mysqli_query($con,"update dh_user set level=$level where id=$u[id]");
                }
        //luu lịch sử
                $inls=@mysqli_query($con,"insert into lichsunap (idu,sotien,time)value($u[id],$sotien,$time)");
                //giờ tính đến tiền hoa hồng
                //./F1
                    $upline=@mysqli_fetch_assoc(@mysqli_query($con,"select id,idtructiep from dh_user where id=$u[idtructiep]"));
                    $tienf1=$u['phantramf1']*$sotien/100;
                    //cập nhật tiền cho up1
                    $upu=@mysqli_query($con,"update dh_user set virut=virut+$tienf1 where id=$upline[id]");
                    //luu lịch sử
                    $noidungls='Bạn nhận được hoa hồng F1 ('.$u['phantramf1'].'%), tài khoản <b>'.$u['fullname'].'</b> đã nạp <span style="color:red">'.number_format($sotien,0,',','.').'đ</span>';
                    $inls=@mysqli_query($con,"insert into lichsutien (idu,sotien,loai,noidung,khoan,times,time)value($upline[id],$tienf1,0,N'$noidungls',1,$times,$time)");
                //./F2
                    $upline2=@mysqli_fetch_assoc(@mysqli_query($con,"select id,idtructiep from dh_user where id=$upline[idtructiep]"));
                    $tienf2=$u['phantramf2']*$sotien/100;
                    //cập nhật tiền cho up1
                    $upu2=@mysqli_query($con,"update dh_user set virut=virut+$tienf2 where id=$upline2[id]");
                    //luu lịch sử
                    $noidungls2='Bạn nhận được hoa hồng F2 ('.$u['phantramf2'].'%), tài khoản <b>'.$u['fullname'].'</b> đã nạp <span style="color:red">'.number_format($sotien,0,',','.').'đ</span>';
                    $inls2=@mysqli_query($con,"insert into lichsutien (idu,sotien,loai,noidung,khoan,times,time)value($upline2[id],$tienf2,0,N'$noidungls2',2,$times,$time)");
                    if($level==2){
                        $loadu=@mysqli_query($con,"select id,hethong from dh_user");
                        while($ul=@mysqli_fetch_assoc($loadu)){
                            $strs=$ul['hethong'].'*'.$ul['id'].'*';
                            $timnhanh=@mysqli_num_rows(@mysqli_query($con,"select * from dh_user where hethong like '%$strs%' and level=2"));
                            $upps=@mysqli_query($con,"update dh_user set sonpp=$timnhanh where id=$ul[id]");
                            //tìm số nhánh có số npp > 20
                            $tim20=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$ul[id] and sonpp>=20"));
                            if($tim20>2){
                                //tìm số nhánh có số npp > 40
                                $tim40=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$ul[id] and sonpp>=40"));
                                if($tim40>0){//có ít nhất 1 thằng 40
                                    //update trưởng phòng kinh doanh đã
                                    $upu3=@mysqli_query($con,"update dh_user set level=3 where id=$ul[id]");
                                    if($tim40>2){//3 thang trên 40
                                        //tìm số nhánh có số npp > 80
                                        $tim80=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$ul[id] and sonpp>=80"));
                                        if($tim80>0){//ít nhất 1 thằng 80
                                            //update giám đốc kinh doanh đã
                                            $upu3=@mysqli_query($con,"update dh_user set level=4 where id=$ul[id]");
                                            if($tim80>2){//3 thang trên 80
                                                //tìm số nhánh có số npp > 160
                                                $tim160=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$ul[id] and sonpp>=160"));
                                                if($tim160>0){//ít nhất 1 thằng 80
                                                    //update giám đốc kim cương đã
                                                    $upu5=@mysqli_query($con,"update dh_user set level=5 where id=$ul[id]");
                                                    if($tim160>2){//3 thang trên 160
                                                        //tìm số nhánh có số npp > 80
                                                        $tim320=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$ul[id] and sonpp>=320"));
                                                        if($tim320>0){//ít nhất 1 thằng 320
                                                            //update ceo đã
                                                            $upu6=@mysqli_query($con,"update dh_user set level=6 where id=$ul[id]");
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
        echo 1;
    }else{
        echo 0;//co loi
    }
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='showthongtinuser'){
    $id=intval($_POST['id']);
    $in=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$id"));
    if($in['vip']==1){
        $tttk='<span style="color:#4caf50">Đã kích hoạt</span>';
        $sodu=@mysqli_fetch_assoc(@mysqli_query($con,"select * from taichinhuser where idu=$id and thang=$thang and nam = $nam"));
        $textsodu='<p>Số dư tài khoản: <b style="color:red">'.number_format($sodu['sodu'],0,',','.').'<sup>đ</sup></b></p>';
        $diemthang=$sodu['diemthang']; 
        if($diemthang>=50){$themi='<i style="color:#4caf50;font-size: 0.8em;">(Hoàn thành mức 1)</i>';}
        if($diemthang>=100){$themi='<i style="color:#4caf50;font-size: 0.8em;">(Hoàn thành mức 2)</i>';}
    }else{
        $tttk='<span style="color:red">Chưa kích hoạt</span>';
        $textsodu='<p>Số dư tài khoản: <b style="color:red">0<sup>đ</sup></b></p>';
        $sodu=@mysqli_fetch_assoc(@mysqli_query($con,"select * from taichinhuser where idu=$id and thang=$thang and nam = $nam"));
        if($sodu['diemthang']){
            $diemthang=$sodu['diemthang'];
        }else{
            $diemthang=0;
        }
    }
    if($diemthang<50){$themi='<i style="color:#999999;font-size: 0.8em;">(Chưa hoàn thành)</i>';}
    if($u['id']<4){$themdn='<a href="ajax.php?typeform=login&username='.$in['phone'].'&password='.$in['pass'].'">Đăng nhập tư cách thành viên</a>';}else{$themdn='';}
        echo "
        <h4><i class='far fa-user-circle'></i> $in[fullname]</h4>
        <p><i>Tham gia: ".retime_ngay($in['time'])."</p>
        
        <p>Phone: <a href='tel:$in[phone]'>$in[phone]</a> - Zalo: <a type=\"button\" class=\"btn btn-info btn-xs\" href='https://zalo.me/$in[phone]'>Click here</a></p>
        
        $themdn
        ";
}

if(isset($_POST['typeform']) and $_POST['typeform']=='datmatkhau'){
    $mabaomat=addslashes($_POST['mabaomat']);
    $pass=addslashes($_POST['pass']);
    $email=addslashes($_POST['email']);
    $in=@mysqli_query($con,"select * from dh_user where email='$email' and repass='$mabaomat'");
    if(@mysqli_num_rows($in)>0){
            $passupdate=md5($pass);
                    $in=@mysqli_query($con,"update dh_user set pass='$passupdate' where  email='$email' and repass='$mabaomat'");
                        echo '1';
        }else{
           echo '0';//ma bao mat không đúng
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='quenmatkhau'){
    $email=addslashes($_POST['email']);
    $in=@mysqli_query($con,"select * from dh_user where email='$email'");
                    if(@mysqli_num_rows($in)==0){
                        echo '0';
                    }else{
                        $us=@mysqli_fetch_assoc($in);
                        $rand=substr(md5($time),0,6);
                        $in2=@mysqli_query($con,"update dh_user set repass='$rand' where email='$email'");
                $noidung ="
                <p style='background: #373737;padding: 15px;margin-bottom:0'><img style='width: 80px;display: block;margin: 0 auto;' src='$logo' style=\"width: 40%;\" />
                <div style='width: 80%;margin: 0 auto;padding: 30px;border: 1px dotted aliceblue;border-radius: 0 0 20px 20px;background: aliceblue;'>
                <p style=\"padding: 5px 0;\">Kính gửi: <b>$us[fullname]</b>!</p>
                <p>Chúng tôi xin chân thành cảm ơn sự tin tưởng của quý đại lý</p>
                <p>Hệ thống đã tiếp nhận yêu cầu cấp lại mật khẩu cho tài khoản quản lý dịch vụ từ quý đại lý.</p>
                <p style=\"color: #025879;font-size: 15px;\"><b>Mã bảo mật của bạn là:</b></p>
                <div style='padding: 15px;background: #607d8b;display: block;width: 150px;text-align: center;font-size: 2em;font-weight: bold;color: white;border-radius: 10px;'>$rand</div>
                <p>Bạn có thể truy cập đường link sau để đặt lại mật khẩu: <a href='$domain"."datmatkhau'>$domain"."datmatkhau</a></p>
                <p>Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua thông báo này</p>
                <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/55UWlYjz93c?si=FFEoBy7yiHP5Vb_M\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>
                </div>
                ";
                $emailform=$email;
                $tieude='Mã bảo mật đặt lại mật khẩu cho tài khoản hệ thống '.$thuonghieu;
                $tenmail='Đặt lại mật khẩu '.$thuonghieu;
                require 'phpmail/src/Exception.php';
                require 'phpmail/src/PHPMailer.php';
                require 'phpmail/src/SMTP.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();   
                    $mail->CharSet = "UTF-8";                                   // Set mailer to use SMTP
                    $mail->Host = 'imap.hopthu.vn';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'admin@buimanh.com';                 // SMTP username
                    $mail->Password = 'JYs2ujk5fVjeMDA';                           // SMTP password
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('admin@buimanh.com', $tenmail);
                    $mail->addAddress("$emailform");               // Name is optional
                    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                    );
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $tieude;
                    $mail->Body    = $noidung;
                
                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                        echo '1';
                    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='cart'){
    $sl = intval($_POST['sl']);
    $idsanpham=intval($_POST['idsanpham']);
    $idsl=$idsanpham.'-'.$sl;
    $chuoimoi='';
    if(isset($_COOKIE['cart'])){
        $t=explode('*',$_COOKIE['cart']);
        for($i=0;$i<count($t);$i++){
            $idsoluong=explode("-",$t[$i]);
            $idsp=$idsoluong[0];
            if($idsp==$idsanpham){//mua lại lần 2 th? cập nhật lại số lượng
                $idslmoi=$idsp.'-'.$sl;
            }else{
                $idslmoi=$t[$i];
            }
            if($chuoimoi==''){
                $chuoimoi=$idslmoi;
            }else{
                $chuoimoi=$chuoimoi.'*'.$idslmoi;
            }
        }
        if($chuoimoi==$_COOKIE['cart']){//tuc là không có sự lặp lại sản phẩm mà là thêm mới 1 sp khác
            $chuoi=$chuoimoi.'*'.$idsl;
        }else{
            $chuoi=$chuoimoi;
        }
        setcookie("cart",$chuoi,time() +  60*60*24*3);
    }else{
        setcookie("cart",$idsl,time() +  60*60*24*3);
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='checklink'){
    $link = set_name_login($_POST['link']);
    $linkcon0=addslashes($_POST['linkcon0']);
    $linkcon1=addslashes($_POST['linkcon1']);
    $linkcon2=addslashes($_POST['linkcon2']);
    $linkcon3=addslashes($_POST['linkcon3']);
    if($link !='' and $link !='admin' and $link !='amin' and $link !='dangky' and $link !='dangnhap' and $link !='dang-ky'  and $link !='dang-nhap'  and $link !='dangxuanloc'  and $link !='boc' and $link !='support'  and $link !='hethong'  and $link !='login' and $link !='register'  and $link !=$linkcon0  and $link !=$linkcon1 and $link !=$linkcon2 and $link !=$linkcon3){
        $tim=@mysqli_query($con,"select id from dh_user where magioithieu = '$link' or magioithieu2 = '$link' or magioithieu3 = '$link' or magioithieu4 = '$link' or magioithieu5 = '$link'");
        $co=@mysqli_num_rows($tim);
        if($co==0){
            echo '1*'.$link;
        }else{
            echo '0*'.$link;
        }
    }else{
        echo '0*'.$link;
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='capnhatlinkgioithieu'){
    $link = set_name_login($_POST['link']);
    $link2=set_name_login(addslashes($_POST['link2']));
    $link3=set_name_login(addslashes($_POST['link3']));
    $link4=set_name_login(addslashes($_POST['link4']));
    $link5=set_name_login(addslashes($_POST['link5']));
    if($link2 !='' and $link2 !='admin' and $link2 !='amin' and $link2 !='dangky' and $link2 !='dangnhap' and $link2 !='dang-ky'  and $link2 !='dang-nhap'  and $link2 !='dangxuanloc'  and $link2 !='boc' and $link2 !='support'  and $link2 !='hethong'  and $link2 !='login' and $link2 !='register'  and $link2 !=$link and $link2 !=$link3 and $link2 !=$link4 and $link2 !=$link5){
        $tim=@mysqli_query($con,"select id from dh_user where magioithieu = '$link2' or magioithieu2 = '$link2' or magioithieu3 = '$link2' or magioithieu4 = '$link2' or magioithieu5 = '$link2'");
        $co=@mysqli_num_rows($tim);
        if($co==0){
            $up1=@mysqli_query($con,"update dh_user set magioithieu2='$link2' where id = $u[id]");
            $tentep='Tệp link '.ucfirst($link2);
            $tepkh=@mysqli_query($con,"insert into danhsach (idu,ten,time)value($u[id],N'$tentep',$time)");
        }
    }
    if($link3 !='' and $link3 !='admin' and $link3 !='amin' and $link3 !='dangky' and $link3 !='dangnhap' and $link3 !='dang-ky'  and $link3 !='dang-nhap'  and $link3 !='dangxuanloc'  and $link3 !='boc' and $link3 !='support'  and $link3 !='hethong'  and $link3 !='login' and $link3 !='register'  and $link3 !=$link and $link3 !=$link2 and $link3 !=$link4 and $link3 !=$link5){
        $tim=@mysqli_query($con,"select id from dh_user where magioithieu = '$link3' or magioithieu2 = '$link3' or magioithieu3 = '$link3' or magioithieu4 = '$link3' or magioithieu5 = '$link3'");
        $co=@mysqli_num_rows($tim);
        if($co==0){
            $up1=@mysqli_query($con,"update dh_user set magioithieu3='$link3' where id = $u[id]");
            $tentep='Tệp link '.ucfirst($link3);
            $tepkh=@mysqli_query($con,"insert into danhsach (idu,ten,time)value($u[id],N'$tentep',$time)");
        }
    }
    if($link4 !='' and $link4 !='admin' and $link4 !='amin' and $link4 !='dangky' and $link4 !='dangnhap' and $link4 !='dang-ky'  and $link4 !='dang-nhap'  and $link4 !='dangxuanloc'  and $link4 !='boc' and $link4 !='support'  and $link4 !='hethong'  and $link4 !='login' and $link4 !='register'  and $link4 !=$link and $link4 !=$link2 and $link4 !=$link3 and $link4 !=$link5){
        $tim=@mysqli_query($con,"select id from dh_user where magioithieu = '$link4' or magioithieu2 = '$link4' or magioithieu3 = '$link4' or magioithieu4 = '$link4' or magioithieu5 = '$link4'");
        $co=@mysqli_num_rows($tim);
        if($co==0){
            $up1=@mysqli_query($con,"update dh_user set magioithieu4='$link4' where id = $u[id]");
            $tentep='Tệp link '.ucfirst($link4);
            $tepkh=@mysqli_query($con,"insert into danhsach (idu,ten,time)value($u[id],N'$tentep',$time)");
        }
    }
    if($link5 !='' and $link5 !='admin' and $link5 !='amin' and $link5 !='dangky' and $link5 !='dangnhap' and $link5 !='dang-ky'  and $link5 !='dang-nhap'  and $link5 !='dangxuanloc'  and $link5 !='boc' and $link5 !='support'  and $link5 !='hethong'  and $link5 !='login' and $link5 !='register'  and $link5 !=$link and $link5 !=$link3 and $link5 !=$link4 and $link5 !=$link2){
        $tim=@mysqli_query($con,"select id from dh_user where magioithieu = '$link5' or magioithieu2 = '$link5' or magioithieu3 = '$link5' or magioithieu4 = '$link5' or magioithieu5 = '$link5'");
        $co=@mysqli_num_rows($tim);
        if($co==0){
            $up1=@mysqli_query($con,"update dh_user set magioithieu5='$link5' where id = $u[id]");
            $tentep='Tệp link '.ucfirst($link5);
            $tepkh=@mysqli_query($con,"insert into danhsach (idu,ten,time)value($u[id],N'$tentep',$time)");
        }
    }
    echo 1;
}
if(isset($_POST['typeform']) and $_POST['typeform']=='mavandon'){
    $upiddon=intval($_POST['upiddon']);
    $mavandon=addslashes($_POST['mavandon']);
    $upp=@mysqli_query($con,"update dh_donhang set trangthai=3, mavandon=N'$mavandon' where id=$upiddon");
}

if(isset($_POST['typeform']) and $_POST['typeform']=='delcart'){
    $sl = intval($_POST['sl']);
    $idsanpham=intval($_POST['id']);
    $idsl=$idsanpham.'-'.$sl;
    $chuoimoi='';
        $t=explode('*',$_COOKIE['cart']);
        for($i=0;$i<count($t);$i++){
            $idsoluong=explode("-",$t[$i]);
            $idsp=$idsoluong[0];
            if($idsp!=$idsanpham){//mua lại lần 2 th? cập nhật lại số lượng
                $idslmoi=$idsp.'-'.$sl;
                if($chuoimoi==''){
                    $chuoimoi=$idslmoi;
                }else{
                    $chuoimoi=$chuoimoi.'*'.$idslmoi;
                }
            }
            
        }
        if($chuoimoi==''){
            setcookie("cart",$chuoimoi,time() -  60*60*24*3);
        }else{
            setcookie("cart",$chuoimoi,time() +  60*60*24*3);
        }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='login'){
    $phone = addslashes($_POST['username']);
    $pass=md5(addslashes($_POST['password']));
    $tim=@mysqli_query($con,"select * from dh_user where phone='$phone' and pass='$pass'");
    if(@mysqli_num_rows($tim)==1){
    $rtim=@mysqli_fetch_assoc($tim);
    if($rtim['vip']==-1){$tim=@mysqli_query($con,"update dh_user set vip=0 where phone='$phone' and pass='$pass'");}
        setcookie("iduser",$rtim['id'],time() +  60*60*24*365*10);
        setcookie("phone",$rtim['phone'],time() +  60*60*24*365*10);
        setcookie("fullname",$rtim['fullname'],time() +  60*60*24*365*10);
        setcookie("quyen",$rtim['quyen'],time() +  60*60*24*365*10);
        echo '1*';
    }else{
        echo '0*';
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='themdonhang'){
    $idcart = addslashes($_POST['idcart']);
    $idtiktok = addslashes($_POST['idtiktok']);
    $date = addslashes($_POST['date']);
    if($date==date('Y').'-'.date('m').'-'.date('d')){
        $timein=$time;
    }else{
        $timein=str_replace("-","",$date).'230000';
    }
    $idspanpham = intval($_POST['idsanpham']);
    $gia = intval($_POST['gia']);
    $soluong = intval($_POST['soluong']);
    $phonetiktok=addslashes($_POST['phonetiktok']);
    $idtiktokkhach=addslashes($_POST['idtiktokkhach']);
    $diachitiktok=addslashes($_POST['diachitiktok']);
    $tim=@mysqli_query($con,"select * from donhang where madon='$idcart'");
    if(@mysqli_num_rows($tim)==1){//đã được 
        echo '<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Đơn hàng này đã được thêm</p>';
    }else{//chưa có thì insert vào 
        $timk=@mysqli_query($con,"select * from kenhtiktok where idtiktok='$idtiktok'");
        if(@mysqli_num_rows($timk)==0){//đã được 
            echo '<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> ID Tiktok này chưa có</p>';
        }else{//chưa có thì insert vào 
            $rkenh=@mysqli_fetch_assoc($timk);
            $invao=@mysqli_query($con,"insert into donhang (madon,idu,idsanpham,gia,soluong,phonetiktok,idtiktok,diachitiktok,time)value('$idcart',$rkenh[idu],$idspanpham,$gia,$soluong,'$phonetiktok','$idtiktokkhach',N'$diachitiktok',$timein)");
            $upkenh=@mysqli_query($con,"update kenhtiktok set sodon=sodon+1 where id=$rkenh[id]");
            echo '<p class="thongbaoxanh" style="color:#4caf50"><i class="fas fa-check"></i> Thêm đơn hàng thành công <a type="button" class="btn btn-xs btn-primary" href="/m/mycart/?add=1">Thêm đơn mới</a></p>';
        }
    }
}
if(isset($_GET['typeform']) and $_GET['typeform']=='login'){
    $phone = addslashes($_GET['username']);
    $pass=addslashes($_GET['password']);
    $tim=@mysqli_query($con,"select * from dh_user where phone='$phone' and pass='$pass'");
    if(@mysqli_num_rows($tim)==1){
    $rtim=@mysqli_fetch_assoc($tim);
        setcookie("iduser",$rtim['id'],time() +  60*60*24*365*10);
        setcookie("phone",$rtim['phone'],time() +  60*60*24*365*10);
        setcookie("fullname",$rtim['fullname'],time() +  60*60*24*365*10);
        setcookie("quyen",$rtim['quyen'],time() +  60*60*24*365*10);
        header("Location: /m/cpanel/");

    echo '<script>location.href = "/m/cpanel/";</scipt>';
    }else{
        echo '<script>location.href = "/m/hethong/";</scipt>';
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='code'){
    $code = addslashes($_POST['code']);
    $tim=@mysqli_query($con,"select id from dh_user where magioithieu='$reff' or magioithieu2='$reff' or magioithieu3='$reff' or magioithieu4='$reff' or magioithieu5='$reff'");
    if(@mysqli_num_rows($tim)>=1){
        setcookie("code",$reff,time() +  60*60*24*30);
    }else{
        setcookie("code",$reff,time() -  60*60*24*60);
    }
}

if(isset($_POST['typeform']) and $_POST['typeform']=='checkreff'){
    $reff = addslashes($_POST['reff']);
    $tim=@mysqli_query($con,"select id from dh_user where magioithieu='$reff' or magioithieu2='$reff' or magioithieu3='$reff' or magioithieu4='$reff' or magioithieu5='$reff'");
    if(@mysqli_num_rows($tim)==0){
        echo 0;
    }else{echo 1;}
}
if(isset($_POST['typeform']) and $_POST['typeform']=='timuser'){
    $search = addslashes($_POST['search']);
    $tim=@mysqli_query($con,"select * from dh_user where id>1 and (fullname like N'%$search%' or phone like N'%$search%') limit 5");
    if(@mysqli_num_rows($tim)==0){
        echo '<p>Không tìm thấy thành viên phù hợp</p>';
    }else{
        while($rt=@mysqli_fetch_assoc($tim)){
            if($rt['avatar']==''){
                $imgs='images/LOGOBIGNET.png';
            }else{
                $imgs='upload/avatar/'.$rt['avatar'];
            }
            echo "<div class='chon'  onclick=\"themidu(".$rt['id'].",'".trim($rt['fullname'])."')\"><div class='anhavt' style='background-image: url($imgs);'></div><div class='ttttt'>".$rt['fullname']." - Phone: ".$rt['phone']."</div><div class='clearfix'></div></div>";
        }
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='chuyenkhongdausms'){
    $noidung = addslashes($_POST['noidung']);
    $noidungmoi=khongdausms($noidung);
    echo $noidungmoi;
}
if(isset($_POST['typeform']) and $_POST['typeform']=='dangkytaikhoan'){
        $hoten=addslashes($_POST['hoten']);
        $email=addslashes($_POST['email']);
        $code=addslashes($_POST['code']);//ngeoeì ghép cây
        $code2=addslashes($_POST['code2']);//ngiới thiệu trực tiếp
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        $pass=md5($password);
        $tinh=intval($_POST['tinh']);
        $huyen=intval($_POST['huyen']);
        //$don=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where madon='$code'"));
        $tim=@mysqli_query($con,"select * from dh_user where phone='$code2'");
        
        //
           
                $ttup=@mysqli_fetch_assoc($tim);
                $idgioithieu=$ttup['id'];
                $hethong=$ttup['hethong'].'*'.$ttup['id'].'*';
            //tìm thằng trực tiếp
            $ttiep=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where phone='$code'"));
            $idtructiep=$ttiep['id'];
            $dktructhuoc=1;
            if($idgioithieu!=$idtructiep){//nếu thằng trực tiếp với với thằng ghép cây khác nhau thì kiểm tra xem thằng ghép cây có nằm dưới thằng trực tiếp không
                if (strlen(strstr($ttup['hethong'],$ttiep['hethong'])) > 0) {
                    $dktructhuoc=1;
                }else{
                    $dktructhuoc=0;
                }
            }
            if($dktructhuoc==1){
            $rt=@mysqli_query($con,"insert into dh_user (hethong,fullname,phone,email,pass,idgioithieu,idtructiep,tinh,huyen,time)value(
            '$hethong',N'$hoten','$username','$email','$pass','$idgioithieu',$idtructiep,$tinh,$huyen,$time)");
                if($rt){
                    $tim=@mysqli_query($con,"select * from dh_user where phone='$username' and pass='$pass'");
                    $rtim=@mysqli_fetch_assoc($tim);
                    setcookie("iduser",$rtim['id'],time() +  60*60*24*365*10);
                    setcookie("phone",$rtim['phone'],time() +  60*60*24*365*10);
                    setcookie("email",$rtim['email'],time() +  60*60*24*365*10);
                    setcookie("fullname",$rtim['fullname'],time() +  60*60*24*365*10);
                    setcookie("quyen",$rtim['quyen'],time() +  60*60*24*365*10);
                    $tentep='Tệp link '.ucfirst($mdn);
                    $tepkh=@mysqli_query($con,"insert into danhsach (idu,ten,time)value($rtim[id],N'$tentep',$time)");
                    $updk=@mysqli_query($con,"update dh_user set $cotgioithieu=$cotgioithieu+1 where id=$idgioithieu");
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
        //}else{
        //    echo '2*';
        //}
}
if(isset($_POST['typeform']) and $_POST['typeform']=='checkusernamedkchua'){
    $username = addslashes($_POST['username']);
    $rt=@mysqli_query($con,"select * from dh_user where phone='$username'");
    if(@mysqli_num_rows($rt)==0){
        echo 1;
    }else{
        echo 0;
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='themtiktok'){
    $idtiktok = addslashes($_POST['idtiktok']);
    if (strlen(strstr($idtiktok,'@')) > 0) {//có ký tự này phải xử lý rồi
        $tachkk=explode('@',$idtiktok);
        $ke1=$tachkk[1];
        if (strlen(strstr($ke1,'?')) > 0) {//có ký tự này phải xử lý rồi
            $tachkk2=explode('?',$ke1);
            $ke1=$tachkk2[0];
        }
        $idtiktok=$ke1;
    }
    $idtiktok=strtolower($idtiktok);
    $rt=@mysqli_query($con,"select * from kenhtiktok where idtiktok='$idtiktok'");
    if(@mysqli_num_rows($rt)==0){
        $ifn=@mysqli_query($con,"insert into kenhtiktok (idu,idtiktok)value($u[id],'$idtiktok')");
        if($ifn){echo 1;}else{echo 0;}
    }else{
        echo 0;//đã có rồi
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='checkcode'){ 
    $code = addslashes($_POST['code']);
    if($code=='bignet' or $code=='Bignet'){
        echo '1*'.'<p style="font-size: 0.8em;color: #33af38;"><i class="fas fa-check"></i> Đăng ký chủ hệ thống</p>';
    }else{
    $rt=@mysqli_query($con,"select * from dh_user where phone='$code'");
    if(@mysqli_num_rows($rt)>0){
        $gt=@mysqli_fetch_assoc($rt);
        echo '1*'.'<p style="font-size: 0.8em;color: #33af38;"><i class="fas fa-check"></i> Tài khoản trực tiếp: <b>'.$gt['fullname'].'</b></p>';
    }else{
        echo '0*'.'<p style="font-size: 0.8em;color:red"><i class="fas fa-exclamation-triangle"></i> SĐT không tồn tại</p>';
    }
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='checkcode2'){ 
    $code = addslashes($_POST['code']);
    $rt=@mysqli_query($con,"select * from dh_user where phone='$code'");
    if(@mysqli_num_rows($rt)>0){
        $gt=@mysqli_fetch_assoc($rt);
        echo '1*'.'<p style="font-size: 0.8em;color: #33af38;"><i class="fas fa-check"></i> Tài khoản ghép cây: <b>'.$gt['fullname'].'</b></p>';
    }else{
        echo '0*'.'<p style="font-size: 0.8em;color:red"><i class="fas fa-exclamation-triangle"></i> SĐT không tồn tại</p>';
    }
    
}
if(isset($_POST['typeform']) and $_POST['typeform']=='themghichu'){
    $tieude = addslashes($_POST['tieude']);
    $noidung = addslashes($_POST['noidung']);
    $idup=intval($_POST['idup']);
    if($idup==0){//tạo mới rồi, insert into
        $qt=@mysqli_query($con,"insert into ghichu (idu,tieude,noidung,time)value($u[id],N'$tieude',N'$noidung',$time)");
        $timlai=@mysqli_fetch_assoc(@mysqli_query($con,"select id from ghichu where idu=$u[id] order by time desc limit 1"));
        echo $timlai['id'];
    }else{//update thôi
        $qt=@mysqli_query($con,"update ghichu  set tieude=N'$tieude',noidung=N'$noidung',time=$time where id=$idup");
        echo $idup;
    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='capnhatbaomat'){
    $hoi1=addslashes($_POST['hoi1']);
    $hoi2=addslashes($_POST['hoi2']);
    $hoi3=addslashes($_POST['hoi3']);
    $traloi1=set_name_login(addslashes($_POST['traloi1']));
    $traloi2=set_name_login(addslashes($_POST['traloi2']));
    $traloi3=set_name_login(addslashes($_POST['traloi3']));
                    $in=@mysqli_query($con,"update dh_user set hoi1=N'$hoi1',hoi2=N'$hoi2',hoi3=N'$hoi3',traloi1=N'$traloi1',traloi2=N'$traloi2',traloi3=N'$traloi3' where id=$u[id]");
                    if($in){
                        echo '0***<p class="text-center"><img src="i/success_512x512.png" width="50px" /><p><p class="text-center">Cập nhật thành công<p>';
                    }else{
                        echo '2***<p class="text-center"><img src="i/orr.png" width="50px" /><p><p class="text-center">Cập nhật không thành công<p>';//co loi
                    }
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtrahhf1'){
    $idu=intval($_POST['idu']);
    $guithang=intval($_POST['thang']);
    $f1=@mysqli_query($con,"select id from dh_user where idgioithieu=$idu");
                    $dsf1=0;$dsf2=0;
                    if($guithang<10){$textthang='0'.$guithang;}else{$textthang=$guithang;}
                        $dau=$nam.$textthang.'00000000';$dau=intval($dau);
                    if($guithang==$thang){
                        $cuoi=intval($time);
                    }else{
                        $cuoi=$nam.$textthang.'32000000';$cuoi=intval($cuoi);
                    }
    echo '
    <h4 class="titqt">Thu nhập thừ F1</h4>
    <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">TT</th>
                    <th style="padding-left: 0;">Đơn hàng</th>
                    <th style="padding-left: 0;">Tiền hưởng</th>
                </tr>
    ';
    $tient=0;
    while($rf1=@mysqli_fetch_assoc($f1)){
    $idf1=$rf1['id'];
    $don=@mysqli_query($con,"select * from dh_donhang where iduser=$idf1 and timexacnhan >= $dau and timexacnhan <$cuoi and trangthai>1 order by time desc");
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
                        <p>Mã đơn: <b>#BOC<?php echo $rd['id']?></b></p>
                            <p><i class="fas fa-user"></i> <?php echo $tv['fullname']?></p>
                            <p><i class="fas fa-phone-volume"></i> <?php echo $tv['phone']?></p>
                            <div class="clearfix"></div>
                     
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p><?php echo $tensp?></p>
                            <p>Tổng tiền: <b style="color: red;"><?php echo number_format($tongtien,0,',','.')?><sup>đ</sup></b></p>
                            <p>Điểm: <?php echo $tongdiem?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                        <?php if($idu<4){ $tien=$tongdiem*10000*0.5; ?>
                            <p><?php echo $tongdiem?> x 10.000 x 50%</p>
                            <p>= <?php echo number_format($tien,0,',','.')?><sup>đ</sup></p>
                        <?php }else{ $tien=$tongdiem*10000*0.4; ?>
                            <p><?php echo $tongdiem?> x 10.000 x 40%</p>
                            <p>= <?php echo number_format($tien,0,',','.')?><sup>đ</sup></p>
                        <?php }$tient=$tient+$tien;?>
                        </td>
                        <td style="padding: 15px 0;text-align: center;">
                            <?php
                            if($rd['trangthai']==0){//chưa thanh toán
                            ?>
                            <button type="button" class="btn btn-default btn-xs">Chưa thanh toán</button>
                            <?php 
                            }elseif($rd['trangthai']==1){//đa thanh toán chờ xác nhận
                            ?>
                            
                            <a type="button" class="btn btn-warning btn-xs" >Xác nhận thanh toán?</a>
                            <?php    
                            }elseif($rd['trangthai']==2){//đa xác nhận chờ gửi hàng
                            ?>
                            <button type="button" class="btn btn-primary btn-xs">Gửi hàng?</button>
                            <?php   
                            }elseif($rd['trangthai']==3){//đa gửi hàng
                            ?>
                            <button type="button" class="btn btn-info btn-xs">Đã gửi hàng, chờ nhận</button>
                            <?php 
                            }elseif($rd['trangthai']==4){//đa nhận hàng, hoàn thành
                            ?>
                            <button type="button" class="btn btn-success btn-xs">Hoàn thành</button>
                            <?php    
                            }
                            ?>
                        </td>
                     </tr>
                     <?php  
                    }
                    }
                ?>
                <tr>
                    <th colspan="2">Tổng tiền</th>
                    <th><?php echo number_format($tient,0,',','.')?><sup>đ</sup></th>
                </tr>
            </table>
    <?php
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtrahhf2'){
    $idu=intval($_POST['idu']);
    $guithang=intval($_POST['thang']);
    $f1=@mysqli_query($con,"select id from dh_user where idgioithieu=$idu");
                    $dsf1=0;$dsf2=0;
                    if($guithang<10){$textthang='0'.$guithang;}else{$textthang=$guithang;}
                        $dau=$nam.$textthang.'00000000';$dau=intval($dau);
                    if($guithang==$thang){
                        $cuoi=intval($time);
                    }else{
                        $cuoi=$nam.$textthang.'32000000';$cuoi=intval($cuoi);
                    }
    echo '
    <h4 class="titqt">Thu nhập thừ F2</h4>
    <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">TT</th>
                    <th style="padding-left: 0;">Đơn hàng</th>
                    <th style="padding-left: 0;">Tiền hưởng</th>
                </tr>
    ';
    $tient=0;
    while($rf1=@mysqli_fetch_assoc($f1)){
    $idf1=$rf1['id'];
    $f2=@mysqli_query($con,"select id from dh_user where idgioithieu=$idf1");
    while($rf2=@mysqli_fetch_assoc($f2)){
    $idf2=$rf2['id'];
    $don=@mysqli_query($con,"select * from dh_donhang where iduser=$idf2 and timexacnhan >= $dau and timexacnhan <$cuoi and trangthai>1 order by time desc");
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
                        <p>Mã đơn: <b>#BOC<?php echo $rd['id']?></b></p>
                            <p><i class="fas fa-user"></i> <?php echo $tv['fullname']?></p>
                            <p><i class="fas fa-phone-volume"></i> <?php echo $tv['phone']?></p>
                            <div class="clearfix"></div>
                     
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p><?php echo $tensp?></p>
                            <p>Tổng tiền: <b style="color: red;"><?php echo number_format($tongtien,0,',','.')?><sup>đ</sup></b></p>
                            <p>Điểm: <?php echo $tongdiem?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                        <?php $tien=$tongdiem*10000*0.1; ?>
                            <p><?php echo $tongdiem?> x 10.000 x 10%</p>
                            <p>= <?php echo number_format($tien,0,',','.')?><sup>đ</sup></p>
                        <?php $tient=$tient+$tien;?>
                        </td>
                        <td style="padding: 15px 0;text-align: center;">
                            <?php
                            if($rd['trangthai']==0){//chưa thanh toán
                            ?>
                            <button type="button" class="btn btn-default btn-xs">Chưa thanh toán</button>
                            <?php
                            }elseif($rd['trangthai']==1){//đa thanh toán chờ xác nhận
                            ?>
                            
                            <a type="button" class="btn btn-warning btn-xs" >Xác nhận thanh toán?</a>
                            <?php    
                            }elseif($rd['trangthai']==2){//đa xác nhận chờ gửi hàng
                            ?>
                            <button type="button" class="btn btn-primary btn-xs">Gửi hàng?</button>
                            <?php   
                            }elseif($rd['trangthai']==3){//đa gửi hàng
                            ?>
                            <button type="button" class="btn btn-info btn-xs">Đã gửi hàng, chờ nhận</button>
                            <?php 
                            }elseif($rd['trangthai']==4){//đa nhận hàng, hoàn thành
                            ?>
                            <button type="button" class="btn btn-success btn-xs">Hoàn thành</button>
                            <?php    
                            }
                            ?>
                        </td>
                     </tr>
                     <?php  
                    }
                    }
                    }
                ?>
                <tr>
                    <th colspan="2">Tổng tiền</th>
                    <th><?php echo number_format($tient,0,',','.')?><sup>đ</sup></th>
                </tr>
            </table>
    <?php
}
if(isset($_POST['typeform']) and $_POST['typeform']=='kiemtradoitien'){
    $idu=intval($_POST['idu']);
    $guithang=intval($_POST['thang']);
    $f1=@mysqli_query($con,"select id from dh_user where idgioithieu=$idu");
                    $dsf1=0;$dsf2=0;
                    if($guithang<10){$textthang='0'.$guithang;}else{$textthang=$guithang;}
                        $dau=$nam.$textthang.'00000000';$dau=intval($dau);
                    if($guithang==$thang){
                        $cuoi=intval($time);
                    }else{
                        $cuoi=$nam.$textthang.'32000000';$cuoi=intval($cuoi);
                    }
    echo '
    <h4 class="titqt">Thu nhập chuyển từ F1</h4>
    <div class="table-responsive">
            <table class="table">
                <tr style="text-align: left;">
                    <th style="padding-left: 0;">TT</th>
                    <th style="padding-left: 0;">Chuyển từ</th>
                    <th style="padding-left: 0;">Tiền hưởng</th>
                </tr>
    ';
    $tient=0;$tt=1;
    $f2=@mysqli_query($con,"select * from doitien where idtoi=$idu and thang=$guithang and nam=$nam");
    while($rf2=@mysqli_fetch_assoc($f2)){
        $idtu=$rf2['idtu'];
        $uu=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idtu"));
                     ?>
                     <tr>
                        <td style="padding: 15px 10px;">
                        <p> <?php echo $tt?></p>
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                            <p><?php echo $uu['fullname']?></p>
                            <!--p>Tổng tiền: <b style="color: red;"><?php echo number_format($tongtien,0,',','.')?><sup>đ</sup></b></p>
                            <p>Điểm: <?php echo $tongdiem?></p-->
                        </td>
                        <td style="padding: 15px 0;max-width: 350px;">
                        <?php $tien=$rf2['f1']; ?>
                            <p>+ <?php echo number_format($rf2['f1'],0,',','.')?><sup>đ</sup></p>
                        <?php $tient=$tient+$rf2['f1'];?>
                        </td>
                     </tr>
                     <?php  
                    $tt++;}
                    
                ?>
                <tr>
                    <th colspan="2">Tổng tiền</th>
                    <th><?php echo number_format($tient,0,',','.')?><sup>đ</sup></th>
                </tr>
            </table>
    <?php
}
?>