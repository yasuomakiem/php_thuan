<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tit='Nạp tiền cho thành viên hệ thống';

?>
<!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<meta name="robots" content="all" />	
<base href="<?php echo $domain?>" />	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>	
<meta name="description" content="<?php echo $des?>"/>		
<title><?php echo $tit?></title>
<meta property="description" content="<?php echo $des?>"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $tit?>"/>
<meta property="og:image" content="images/webinar.jpg"/>
<meta property="og:description" content="<?php echo $des?>"/>
<meta property="og:url" content="<?php echo lay_url()?>"/>
<meta property="og:site_name" content="<?php echo $tit?>"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $des?>" />
<meta name="twitter:title" content="<?php echo $tit?>" />
<meta name="twitter:image" content="images/webinar.jpg" />	
<link rel="icon" href="images/favi.png" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='js/bootstrap.min.js'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel="stylesheet"  href="css/admin.css"/>
</head>
<body>
<section class="titadmin">
    <div class="container">
        <div class="row">
            <?php 
                require_once('sup-admin/headadmin.php');
            ?>
        </div>
    </div>
</section>
<section class="contentmain">
<div class="container">
    <div class="row">
    <div class="col-md-9 col-xs-12 conleft">
        <?php 
            if(isset($_POST['tao'])){
            $phone=addslashes($_POST['phoneuser']);
            $sotien=intval($_POST['sotien']);
            if($phone!=''){
            if($sotien>=$u['kichhoatctv']){
                $level=1;
                $uus=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where phone='$phone'"));
                if($sotien>=$u['kichhoatnpp']){$level=2;}
                //cập nhật tiền cho thành viên
                if($uus['level']<2){
                    $upu=@mysqli_query($con,"update dh_user set level=$level,vimua=vimua+$sotien where id=$uus[id]");
                }else{
                    $upu=@mysqli_query($con,"update dh_user set vimua=vimua+$sotien where id=$uus[id]");
                }
                //luu lịch sử
                $inls=@mysqli_query($con,"insert into lichsunap (idu,sotien,time)value($uus[id],$sotien,$time)");
                //giờ tính đến tiền hoa hồng
                //./F1
                    $upline=@mysqli_fetch_assoc(@mysqli_query($con,"select id,idtructiep from dh_user where id=$uus[idtructiep]"));
                    $tienf1=$u['phantramf1']*$sotien/100;
                    //cập nhật tiền cho up1
                    $upu=@mysqli_query($con,"update dh_user set virut=virut+$tienf1 where id=$upline[id]");
                    //luu lịch sử
                    $noidungls='Bạn nhận được hoa hồng F1 ('.$u['phantramf1'].'%), tài khoản <b>'.$uus['fullname'].'</b> đã nạp <span style="color:red">'.number_format($sotien,0,',','.').'đ</span>';
                    $inls=@mysqli_query($con,"insert into lichsutien (idu,sotien,loai,noidung,khoan,times,time)value($upline[id],$tienf1,0,N'$noidungls',1,$times,$time)");
                //./F2
                    $upline2=@mysqli_fetch_assoc(@mysqli_query($con,"select id,idtructiep from dh_user where id=$upline[idtructiep]"));
                    $tienf2=$u['phantramf2']*$sotien/100;
                    //cập nhật tiền cho up1
                    $upu2=@mysqli_query($con,"update dh_user set virut=virut+$tienf2 where id=$upline2[id]");
                    //luu lịch sử
                    $noidungls2='Bạn nhận được hoa hồng F2 ('.$u['phantramf2'].'%), tài khoản <b>'.$uus['fullname'].'</b> đã nạp <span style="color:red">'.number_format($sotien,0,',','.').'đ</span>';
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
                if($upu){
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE"><i class="fas fa-check"></i> Thao tác thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>';}
            }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Số tiền nạp tối thiểu <b style="color:red">'.number_format($u['kichhoatctv'],0,',','.').'<sup>đ</sup></b>.</div>';}
            }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Hãy nhập đầy đủ các trường bắt buộc (*).</div>';}
        }
        ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Nạp tiền </div>
        <form id="form" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
            <div id="thongbao"><?php  echo $thongbao; ?></div>
               <div class="form-group">
                    <label>SĐT thành viên <span style="color: red;">(*)</span></label>
                    <input required="" type="number" class="form-control" name="phoneuser" id="phoneuser" value="" />
                </div>
                <div id="listchusohuu"></div>
                <div class="form-group">
                    <label>Số tiền nạp <span style="color: red;">(*)</span></label>
                    <input required="" type="number" class="form-control" name="sotien" id="sotien" value="" />
                </div>
                <div class="form-group" id="nutnaptien" style="display: none;">
                    <input type="submit" class="btn btn-primary" name="tao" value="NẠP TIỀN" />
                </div>
        </form>
        <script language="javascript">
        $(document).ready(function() {
                    $('#phoneuser').keyup(function(){
                        var phoneuser =$("#phoneuser").val();
                        if(phoneuser.length>9){
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    phoneuser : phoneuser,
                                    typeform : "kiemtrauser"
                                },
                                success : function (result2){
                                    arr = result2.split('*');
                                    if(Number(arr[0])==1){
                                        $('#nutnaptien').show();
                                    }else{
                                        $('#nutnaptien').hide();
                                        setTimeout(function(){
                                            $('#listchusohuu').html('');
                                        },7000);
                                    }
                                    $('#listchusohuu').html(arr[1]);
                                }
                        });
                        }
                    })
        setTimeout(function(){$('#thongbao').html('');},5000);
        });
        
        </script>
        <p>&nbsp;</p>
        <div class="tit"><i class="fas fa-landmark"></i> Lịch sử nạp tiền</div>
        <?php
            $list=@mysqli_query($con,"select * from lichsunap order by id desc limit 100");
            if(@mysqli_num_rows($list)==0){
                ?>
                <div class="text-center">
                <p style="color: silver; padding: 25px 10%;">Chưa có lần nạp tiền nào</p>
                <img src="images/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                
                </div>
                <?php 
            }else{$i=1;
                ?>
                
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                        <th>#</th><th>Thành viên</th><th>Số tiền</th><th>Thời gian</th>
                    </tr>
                    <?php while($rlist=@mysqli_fetch_assoc($list)){
                        $uss=@mysqli_fetch_assoc(@mysqli_query($con,"select fullname from dh_user where id=$rlist[idu]"));
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                        <i class="fas fa-user"></i> <?php echo $uss['fullname'];?>
                        </td>
                        <td><?php echo number_format($rlist['sotien'],0,',','.');?><sup>đ</sup></td>
                        <td>
                        <?php echo retimefull($rlist['time']); ?>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </table>
                </div>
                <?php 
            }
            
            ?>
    </div>
    <div class="col-md-3 col-xs-12 conright">
    <?php  require_once('sup-admin/left.php'); ?>
    </div>
    </div>
</section>
<section class="afooter">
    <?php  require_once('sup-admin/footer.php'); ?>
</section>
    
</body>
</html>