<?php
session_start();
require_once('include/connect.php');
$email=addslashes($_GET['email']);
$s=mysqli_fetch_assoc(mysqli_query($con,"select * from dh_user where email='$email'"));
$quyen=$s['quyen'];
$fullname=$s['fullname'];
setcookie("iduser",$s['id'],time() + 259200);
setcookie("email",$email,time() + 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
setcookie("fullname",$fullname,time() + 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
setcookie("quyen",$quyen,time() + 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
if($quyen==1){
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="m/cpanel/";
            }
            </script>
            ';
            exit();
    }else{
            exit();
    }
?>