<?php
    $con = @mysqli_connect('localhost', 'root', '', 'goattest');
            if (!$con)
              {
              die('Không kết nối được: ' . @mysqli_error());
              }
             if (!$con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}           

            @mysqli_query($con,"SET CHARACTER SET 'utf8' ");
            date_default_timezone_set('Asia/Ho_Chi_Minh'); 
            $time=date("Y").date('m').date("d").date('His'); 
            $times=time(); 
            if (!$con->set_charset("utf8")) {
            } else {
            }
            $ngay=intval(date("d"));
            $thang=intval(date('m'));
            $nam=intval(date('Y'));
    $tenmien = $_SERVER['HTTP_HOST'];
    $tu="select * from dh_user where id=1";$qu=@mysqli_query($con,$tu);$ru=@mysqli_fetch_assoc($qu);
    if(isset($_COOKIE['iduser'])){
        $u=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$_COOKIE[iduser]"));
        if($ru['dkchinhthuc']==0 and $ru['id']!=1 and $ru['vip']==0){$uct=@mysqli_query($con,"update dh_user set vip=1 where id=$_COOKIE[iduser]");}
    }
    $domain="https://duonggiaadi.com/";
    $trang='';
    $domain_webinar='https://duonggiaadi.com/';
    $domain_chinh='https://duonggiaadi.com/';
    $domains=ucfirst("duonggiaadi.com");
    $domain_tat=$ru['viettat'];
    $thuonghieu='Duonggiaadi.com';
    $logo=$domain.'images/logoboc.png';
    $idu=$ru['id'];
    $demo=1;
    $iduser=1;
    

?>