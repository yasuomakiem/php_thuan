<?php
	session_start();
    require_once('include/connect.php');
	session_destroy();
    setcookie("iduser",'',time() - 259200);
    setcookie("email",'',time() - 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
    setcookie("fullname",'',time() - 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
    setcookie("quyen",0,time() - 259200);//khai báo cookie có tên là user, giá tr? là Admin và th?i gian s?ng là 10 giây k? t? khi khai báo
   echo '
        <script language="JavaScript">
        var my_timeout=setTimeout("gotosite();",0);
        function gotosite()
        {
        window.location="'.$domain.'";
        }
        </script>
    ';// cái này là chuy?n trang b?ng javascript
    //echo '<meta http-equiv="refresh" content="0;';echo $_SERVER['HTTP_REFERER'];echo'">';
	exit();
?>