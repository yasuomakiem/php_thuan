<?php
	session_start();
    require_once('include/connect.php');
	session_destroy();
    setcookie("iduser",'',time() - 259200);
    setcookie("email",'',time() - 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
    setcookie("fullname",'',time() - 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
    setcookie("quyen",0,time() - 259200);//khai b�o cookie c� t�n l� user, gi� tr? l� Admin v� th?i gian s?ng l� 10 gi�y k? t? khi khai b�o
   echo '
        <script language="JavaScript">
        var my_timeout=setTimeout("gotosite();",0);
        function gotosite()
        {
        window.location="'.$domain.'";
        }
        </script>
    ';// c�i n�y l� chuy?n trang b?ng javascript
    //echo '<meta http-equiv="refresh" content="0;';echo $_SERVER['HTTP_REFERER'];echo'">';
	exit();
?>