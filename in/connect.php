<?php
    $con = mysql_connect('localhost','dangtin_data','Sqtt@886596');
            if (!$con)
              {
              die('Không kết nối được: ' . mysql_error());
              }           
    $querry=mysql_select_db("dangtin_data", $con);
            mysql_query("SET CHARACTER SET 'utf8' ");
            date_default_timezone_set('Asia/Ho_Chi_Minh'); 
            $time=date("Y").date('m').date("d").date('His');
            $times=time(); 
    $domain="http://dangtin.me/";
    $trang='';
    $domains="Dangtin.vn";
    if(isset($_COOKIE['iduser'])){
        $u=@mysql_fetch_assoc(@mysql_query("select * from user where id=$_COOKIE[iduser]"));
    }
?>