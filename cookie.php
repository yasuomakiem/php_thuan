<?php
session_start();
require_once('include/connect.php');
$email=addslashes($_GET['email']);
$s=mysqli_fetch_assoc(mysqli_query($con,"select * from dh_user where email='$email'"));
$quyen=$s['quyen'];
$fullname=$s['fullname'];
setcookie("iduser",$s['id'],time() + 259200);
setcookie("email",$email,time() + 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
setcookie("fullname",$fullname,time() + 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
setcookie("quyen",$quyen,time() + 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
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