<?php session_start();
$url='/congty.php?r=1';  
date_default_timezone_set("Asia/Ho_Chi_Minh");    
if(isset($_POST['ssboc'])){
    $pass='boc@23'.date('d').date('m');
    if(addslashes($_POST['boc'])==$pass){
    $_SESSION['boc'] = 'yes';
    }
}
ob_clean();
		header('location: '.$url);
		exit();
?>