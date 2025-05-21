<?php
if($u['tinh']==0 or $u['huyen']==0){echo "<script type=\"text/javascript\">$(document).ready(function(){window.location.href = '/m/account/?yeucaucapnhat';});</script>";}
?> 
<style>
.avatar{
    width: 72px;
    height: 72px;
    float: left;
    margin: 5px auto;
    background-size: cover;
    position: relative;
    cursor: pointer;
    background-position: center;
    border-radius: 50%;
    border: 2px solid #00a65e;
    background-image: url(<?php if($u['avatar']!=''){echo 'upload/avatar/'.$u['avatar'];}else{if($u['gioitinh']=='nu'){echo 'i/avatar_nu.png';}else{echo 'i/avatar_nam.png';}}?>);
}
.avatar span{
    position: absolute;
    bottom: -9px; 
    padding: 2px 5px;
    left: 36%;
    background: #00000057;
    color: white;
    border-radius: 50%;
    font-size: 0.8em;
}
.contag.dr .dealright{
    width: calc(100% - 85px);width: -moz-calc(100% - 85px);width: -webkit-calc(100% - 85px);
}
a.adk{
    background: #f86a6a;
    background: -webkit-linear-gradient(180deg,  #f86a6a, #940404);
    background: linear-gradient(180deg,  #f86a6a, #940404);
    padding: 0px 16px;
    color: #fff;
    height: 30px;
    line-height: 27px;
    margin-top: 5px;
    border-radius: 14px;
    font-size: 14px;
    margin-right: 8px;
    float: right;
    position: absolute;
    top: 34px;
    right: 0px;
}
a.yc{
    padding: 15px 25px;
    border: 1px solid #f4f4f4;
    border-radius: 35px;
    background: #2196f3;
    background: -webkit-linear-gradient(180deg, #2196f3, #25747e);
    background: linear-gradient(180deg, #5cb7ff, #15626c);
    font-weight: 700;
    color: #ffffff;
}
.showid{position: relative;}
.showid .tooltip{
  position: absolute;
    /* font-size: 17px; */
    font-weight: 500;
    color: #07af0c;
    top: 30px;
    z-index: 1;
    background: none;
    padding: 5px 10px;
    font-size: 0.7em;
    border-radius: 3px;
    letter-spacing: 1px;
    opacity: 0;
    font-style: italic;
    pointer-events: none;
    transition: opacity 0.4s, margin-left 0.4s;
    right: -10px;
}
.showid .tooltip.show{
  
  opacity: 1;
  pointer-events: auto;
}
.chuakichhoat{
    padding: 20px 10px;
    border: 1px solid red;
    margin-bottom: 20px;
    border-radius: 10px;
    text-align: center;
    color: red;
}
.chuakichhoat p{
    margin-bottom: 0;
    line-height: 42px;
}
div.item p {
    line-height: 18px;
}
.boxdulieu div.item p {
    line-height: 24px;
}
.boxdulieu div.item p b{
    font-size: 16px;
}
</style>
<?php 
$today = new DateTime();
        $firstDayOfWeek1 = $today->modify('this week')->modify('monday');
        $firstDayOfWeek2 = $today->modify('this week')->modify('monday');
        $yesterday = $today->modify('-1 day');
        $firstDayOfMonth = $today->modify('first day of this month');
        $todaynew = new DateTime();
        $date = date('Y-m-d-N');
        $newdategoc = strtotime ( '-1 day' , strtotime ( $date ) ) ;
        $dautuan0=  strtotime ( '-'.(date('N')-1).' day' , strtotime ( $date ) ) ;
        $homqua=date ( 'Ymd' , $newdategoc );
        $ngayhomqua=date ( 'd/m/Y' , $newdategoc );
        $thuhomqua = date ( 'N' , $newdategoc );
        $thuhomnay= $todaynew->format('N');
        $dautuan=date ( 'Ymd' , $dautuan0 );
        $dauthang = date('Ym01');
        $daysOfWeekNames = [
            1 => 'Thứ Hai',
            2 => 'Thứ Ba',
            3 => 'Thứ Tư',
            4 => 'Thứ Năm',
            5 => 'Thứ Sáu',
            6 => 'Thứ Bảy',
            7 => 'Chủ Nhật'
        ];
        if($_GET['time']=='today'){
            $themdk='and time > '.date('Y').date('m').date('d').'000000 and time < '.date('Y').date('m').date('d').'250000';
            $a_today='primary';$a_tomorrow='default';$a_week='default';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Hôm nay: '.$daysOfWeekNames[$thuhomnay].', ngày '.date('d/m/Y').'</p></div>';
        }elseif($_GET['time']=='tomorrow'){
            $themdk='and time > '.$homqua.'000000 and time < '.$homqua.'250000';
            $a_today='default';$a_tomorrow='primary';$a_week='default';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Hôm qua: '.$daysOfWeekNames[$thuhomqua].', ngày '.$ngayhomqua.'</p></div>';
        }elseif($_GET['time']=='week'){
            $themdk='and time > '.$dautuan.'000000';
            $a_today='default';$a_tomorrow='default';$a_week='primary';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Từ: Thứ 2, ngày '.date ( 'd/m/Y' , $dautuan0 ).' tới hôm nay</p></div>';
        }elseif(!isset($_GET['time']) or $_GET['time']=='month'){
            $themdk='and time > '.$dauthang.'000000';
            $a_today='default';$a_tomorrow='default';$a_week='default';$a_month='primary';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Từ 01 - '.date('d').'/'.date('m').'/'.date('Y').'</p></div>';
        }elseif($_GET['time']=='change'){
            $a_today='default';$a_tomorrow='default';$a_week='default';$a_month='default';$a_change='primary';
            if(!isset($_GET['tu'])){
                $tutu=date('Y-m-d',$newdategoc);
                $toitoi=date('Y-m-d');
            }else{
                $tutu=$_GET['tu'];
                $toitoi=$_GET['toi'];
            }
            $sltu=str_replace("-","",$tutu);
            $sltoi=str_replace("-","",$toitoi);
            $themdk='and time > '.$sltu.'000000 and time < '.$sltoi.'250000';
            $showtime='
            
            <form action="/m/cpanel/" method="GET" id="tututoitoi" style="padding-top:7px">
              <div class="row">
              <div class="col-lg-6 col-xs-6" style="margin-bottom: 2px; padding-right: 2px;">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Từ</button>
                  </span>
                  <input name="time" type="hidden" value="change" />
                  <input style="border: 0;line-height: 30px;height: 30px;" value="'.$tutu.'" type="date" id="tutu" name="tu" class="form-control"/>
                </div>
              </div>
              <div class="col-lg-6 col-xs-6" style="padding-left: 2px;">
                <div class="input-group">
                <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Tới</button>
                  </span>
                  <input style="border: 0;line-height: 30px;height: 30px;" type="date" name="toi" id="toitoi" value="'.$toitoi.'" class="form-control" />
                </div>
              </div>
            </div>
            
            </form>
            <script>$(document).ready(function() {$("#tutu, #toitoi").change(function() {$("form#tututoitoi").submit();});});</script>
            ';
        }
?>
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-globe"></i> <?php echo $ru['viettatteam']?> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php"><i class="fas fa-power-off"></i> Thoát </a></h3>
            <a href="/m/account/">
            <div class="contag dr" style="position: relative;">
                <div class="avatar" id="avatar" onclick="document.getElementById('main_picture1').click();" style="">
                <span><i class="fas fa-sync-alt"></i></span>
                </div>
                <div class="dealright">
                <p style="margin-bottom: 5px; color: #222;"><b><?php echo ucfirst($u['fullname'])?></b> <?php if($u['level']==1){?><span style="float: right;font-size: 0.9em;color: #4CAF50;"><i class="fas fa-shield-alt"></i> Cộng tác viên</span><?php }elseif($u['level']==2){?><span style="float: right;font-size: 0.9em;color: #4CAF50;"><i class="fas fa-sun"></i> Nhà phân phối</span><?php }?></p>
                <p style="color: #555; font-size: 0.85em;line-height: 20px;"><i class="fab fa-magento"></i> Ví mua <b style="color: red;"><?php echo number_format($sodu,0,',','.')?><sup>đ</sup></b> &nbsp;&nbsp; <i class="fas fa-hand-holding-usd"></i> Ví rút <b style="color: red;"><?php echo number_format($u['virut'],0,',','.')?><sup>đ</sup></b> 
                <br /><i class="far fa-clock"></i> Tham gia: <?php echo retime($u['time'])?> </p>
                </div>
                <div class="clearfix"></div>
            </div>
            </a>
            <div class="groupteam">
            <!--h3 class="titUT">Dữ liệu <span style="color: red;">thu nhập</span></h3>
            <p>
            <a class="label label-<?php echo $a_today?>" href="/m/cpanel/?time=today">Hôm nay</a>
            <a class="label label-<?php echo $a_tomorrow?>" href="/m/cpanel/?time=tomorrow">Hôm qua</a>
            <a class="label label-<?php echo $a_week?>" href="/m/cpanel/?time=week">Tuần này</a>
            <a class="label label-<?php echo $a_month?>" href="/m/cpanel/?time=month">Tháng này</a>
            <a class="label label-<?php echo $a_change?>" href="/m/cpanel/?time=change">Tùy chỉnh</a>
            </p>
            <?php 
                echo $showtime;
                $don=@mysqli_query($con,"select * from donhang where trangthai<3 and idu=$u[id] $themdk order by time desc");
                $sodon=@mysqli_num_rows($don);
                $af_tongdoanhso=0;
                $af_tonghoahong=0;
                while($rd=@mysqli_fetch_assoc($don)){
                    $timsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rd[idsanpham]"));
                        $af_tongdoanhso=$af_tongdoanhso + $rd['gia'];
                        $af_tonghoahong=$af_tonghoahong + $rd['gia']*$timsp['pt_coban']/100 + $rd['gia']*$timsp['pt_them']/100 + $rd['gia']*$timsp['pt_3don']/100;
                    }
                $net_tongdoanhso=0;
                $net_tonghoahong=0;
                $net_don=0;    
                $timnet=@mysqli_query($con,"select id from dh_user where idgioithieu=$u[id]");
                if(@mysqli_num_rows($timnet)>0){
                    while($rnet=@mysqli_fetch_assoc($timnet)){
                        $donnet=@mysqli_query($con,"select * from donhang where trangthai<3 and idu=$rnet[id] $themdk order by time desc");
                        $net_don=$net_don+@mysqli_num_rows($donnet);
                        while($rdnet=@mysqli_fetch_assoc($donnet)){
                            $timspnet=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rdnet[idsanpham]"));
                            $net_tongdoanhso=$net_tongdoanhso + $rdnet['gia'];
                            $net_tonghoahong=$net_tonghoahong + $rdnet['gia']*$timspnet['pt_hethong']/100;
                        }
                    }
                }
                //đơn của chính họ nữa nếu họ là chủ hệ thống hoăj nhà quản lý
                if($u['vip']>1){
                    $donnet=@mysqli_query($con,"select * from donhang where trangthai<3 and idu=$u[id] $themdk order by time desc");
                    $net_don=$net_don+@mysqli_num_rows($donnet);
                    while($rdnet=@mysqli_fetch_assoc($donnet)){
                            $timspnet=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rdnet[idsanpham]"));
                            $net_tongdoanhso=$net_tongdoanhso + $rdnet['gia'];
                            $net_tonghoahong=$net_tonghoahong + $rdnet['gia']*$timspnet['pt_hethong']/100;
                    }
                }
                if($af_tongdoanhso>0){$af_tongdoanhso=number_format($af_tongdoanhso/1000,0,',','.').'K';}
                if($af_tonghoahong>0){$af_tonghoahong=number_format($af_tonghoahong/1000,0,',','.').'K';}
                if($net_tongdoanhso>0){$net_tongdoanhso=number_format($net_tongdoanhso/1000,0,',','.').'K';}
                if($net_tonghoahong>0){$net_tonghoahong=number_format($net_tonghoahong/1000,0,',','.').'K';}
            ?>
            <div class="boxdulieu">
            
            <p style="margin-top: 10px;"><img style="height: 8px;margin-left: 15px;" src="i/3line.png"/> Cá nhân Affiliate</p>
                <a href="javascript:void(0)"><div class="item"><img src="i/product.png" /><p>Doanh số<br/><b><?php echo $af_tongdoanhso;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><img src="i/earning.png" /><p>Hoa hồng<br/><b><?php echo $af_tonghoahong;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><img src="i/brand-identity.png" /><p>Đơn hàng<br/><b><?php echo $sodon;?></b></p></div></a>
            <div class="clearfix"></div>
            <p style="margin-top: 10px;"><img style="height: 8px;margin-left: 15px;" src="i/3line.png"/> Network Affiliate</p>
                <a href="javascript:void(0)"><div class="item"><img src="i/shield.png" /><p>Doanh số<br/><b><?php echo $net_tongdoanhso;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><img src="i/moneybag.png" /><p>Hoa hồng<br/><b><?php echo $net_tonghoahong;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><img src="i/coins.png" /><p>Đơn hàng<br/><b><?php echo $net_don;?></b></p></div></a>
                <div class="clearfix"></div>
            <?php if($u['vip']>1){
                $ql_tongdoanhso=0;
                $ql_tonghoahong=0;
                $ql_don=0;    
                $timnet=@mysqli_query($con,"select id from dh_user where id=$u[id] or hethong like '%*$u[id]*%'");
                if(@mysqli_num_rows($timnet)>0){
                    while($rnet=@mysqli_fetch_assoc($timnet)){
                        $donnet=@mysqli_query($con,"select * from donhang where trangthai<3 and idu=$rnet[id] $themdk order by time desc");
                        $ql_don=$ql_don+@mysqli_num_rows($donnet);
                        while($rdnet=@mysqli_fetch_assoc($donnet)){
                            $timspnet=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rdnet[idsanpham]"));
                            $ql_tongdoanhso=$ql_tongdoanhso + $rdnet['gia'];
                            $ql_tonghoahong=$ql_tonghoahong + $rdnet['gia']*$timspnet['pt_hethong']/100;
                        }
                    }
                }
                if($af_tongdoanhso>0){$af_tongdoanhso=number_format($af_tongdoanhso/1000,0,',','.').'K';}
                if($af_tonghoahong>0){$af_tonghoahong=number_format($af_tonghoahong/1000,0,',','.').'K';}
                if($ql_tongdoanhso>0){$ql_tongdoanhso=number_format($ql_tongdoanhso/1000,0,',','.').'K';}
                if($ql_tonghoahong>0){$ql_tonghoahong=number_format($ql_tonghoahong/1000,0,',','.').'K';}
                if($u['vip']>=2){
            ?>
            <p style="margin-top: 10px;"><img style="height: 8px;margin-left: 15px;" src="i/3line.png"/> Hoa hồng Quản Lý</p>
                <a href="javascript:void(0)"><div class="item"><img src="i/transaction.png" /><p>Doanh số<br/><b><?php echo $ql_tongdoanhso;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><img src="i/wallet.png" /><p>Hoa hồng<br/><b><?php echo $ql_tonghoahong;?></b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><img src="i/secure-shopping.png" /><p>Đơn hàng<br/><b><?php echo $ql_don;?></b></p></div></a>
                <div class="clearfix"></div> 
            <?php
                }
            }?>
            <div style="display: none;">
                <hr />
                <p>Tiktok: </p>
                <a href="javascript:void(0)"><div class="item"><p>Doanh số<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Đơn hàng<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><p>Tổng Hoa Hồng<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Hoa hồng Tiktok (20%)<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Hoa hồng Bignet (10%)<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><p>Hoa hồng 3 Đơn (10%)<br/><b>0</b></p></div></a>
                <div class="clearfix"></div>
                <p>Khác: </p>
                <a href="javascript:void(0)"><div class="item"><p>Doanh số<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Đơn hàng<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item end"><p>Tổng hoa hồng<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Hoa hồng Bignet (35%)<br/><b>0</b></p></div></a>
                <a href="javascript:void(0)"><div class="item"><p>Hoa hồng 3 Đơn (10%)<br/><b>0</b></p></div></a>
                <div class="clearfix"></div>
                </div>
            </div-->
            <?php //if($u['vip']==1){?>
            <div style="padding: 15px 0;position: relative;" id="tieudiem">
            <div style="position: absolute;background: #f4f4f4;top: 4px;left: 15px;padding: 0 6px;font-weight: 700;color: red;">Tiêu điểm</div>
            <div style="border: 1px solid #d0d0d0;padding: 15px;border-radius: 8px;padding-bottom: 5px;">
            <?php 
            if($u['email']==''){
            ?>
            <p style="text-align: justify;font-size: 0.95em;">Bạn ơi, hãy cập nhật <b>email của bạn</b> để hệ thống có thể gửi những thông tin quan trọng như tài khoản, rút tiền, đơn hàng, hệ thống... 
            <a type="button" class="btn btn-warning btn-xs" href="/m/account/" style="font-size: 0.76em;padding: 1px 5px;">Cập nhật ngay</a></p>
            <?php
            }elseif($u['avatar']==''){
            ?>
            <p style="text-align: justify;font-size: 0.95em;">Bạn ơi, hãy cập nhật <b>Avatar của bạn</b> để hệ thống có thể hiển thị hình ảnh của bạn đẹp nhất nhé. 
            <a type="button" class="btn btn-warning btn-xs" href="/m/account/" style="font-size: 0.76em;padding: 1px 5px;">Cập nhật ngay</a></p>
            <?php    
            }elseif($u['tinh']=='' or $u['gioitinh']=='' or $u['ngaysinh']==''){
            ?>
            <p style="text-align: justify;font-size: 0.95em;">Bạn ơi, hãy cập nhật <b>ngày sinh, giới tính, khu vực</b> của bạn để hệ thống có thể phân phối data, kết nối đội nhóm phù hợp nhất với bạn nhé. 
            <a type="button" class="btn btn-warning btn-xs" href="/m/account/" style="font-size: 0.76em;padding: 1px 5px;">Cập nhật ngay</a></p>
            <?php    
            }else{
            ?>
            <script>$('#tieudiem').hide();</script>
            <?php
            }
            ?>
            </div>
            </div>
            <p style="margin: 0;line-height: 14px;">&nbsp;</p>
            <?php
            /*}else{
            ?>
            
            <div class="chuakichhoat">
            <p><i class="fas fa-exclamation-triangle"></i> Tài khoản chưa được kích hoạt <br /><a type="button" href="/san-pham.html" onclick="return confirm('Bạn cần đặt và thanh toán 1 đơn hàng tối thiểu 50 điểm')" class="btn btn-primary">Kích hoạt ngay</a></p>
            </div>
            <?php
            }*/
            if($u['quyen']==1){//admin
            ?>
            <p style="text-align: right;">
            <a style="float: left;" href="/m/quyettoan/"><i class="fas fa-money-check-alt"></i> YC Rút Tiền <span style="color: red;">(<?php echo @mysqli_num_rows(@mysqli_query($con,"select * from yeucauruttien where trangthai=0"));?>)</span></a>
            <a target="_blank" href="/cpanel.php"><i class="fas fa-users-cog"></i> Quyền Admin</a></p>
            <?php
            }
            
            $tin=@mysqli_query($con,"select * from thongbao where (idnhan like '%*$u[id]*%' or idnhan='') and daxem not like '%*$u[id]*%' order by time desc");
            $sotin=@mysqli_num_rows($tin);
            if($u['level']==0 and $u['id']!=1){
            ?>
            <div class="boxdulieu" style="margin-bottom: 15px;padding: 15px;margin-top: 0;"><?php echo $ru['footer1']?></div>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/userinfo.png" /><p>Thông tin<br/>tài khoản</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/send-money.png" /><p>Tài chính<br/>của tôi</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item end"><img src="i/herthong.png" /><p>Network<br/>của tôi</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/shopping-cart.png" /><p>Đơn hàng<br/>của tôi</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/linksanpham.png" /><p>Sản phẩm<br/>của tôi</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item end"><img src="i/sanpham.png" /><p>Đào tạo<br/>sản phẩm</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/kynang.png" /><p>Đào tạo<br/>kỹ năng</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/hoidap.png" /><p>Hỏi đáp<br/>hệ thống</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item end"><img src="i/book.png" /><p>Hướng dẫn<br/>kỹ thuật</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/social-media.png" /><p>Feedback<br/>Media</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item"><img src="i/quytrinh.png" /><p>Thư viện<br/>Quy trình</p></div></a>
            <a href="javascript:void(0)" onclick="alert('Tài khoản chưa kích hoạt')"><div class="item end"><img src="i/thongbao.png" /><p style="margin-bottom: 5px;">Thông báo</p><sup style="color: red;">(<?php echo $sotin?>)</sup></div></a>
            <?php    
            }else{
            ?>
            <a href="m/account/"><div class="item"><img src="i/userinfo.png" /><p>Thông tin<br/>tài khoản</p></div></a>
            <a href="m/taichinh/"><div class="item"><img src="i/send-money.png" /><p>Tài chính<br/>của tôi</p></div></a>
            <a href="m/hethong/"><div class="item end"><img src="i/herthong.png" /><p>Network<br/>của tôi</p></div></a>
            <a href="m/mycart/"><div class="item"><img src="i/shopping-cart.png" /><p>Đơn hàng<br/>của tôi</p></div></a>
            <a href="m/sanpham/"><div class="item"><img src="i/linksanpham.png" /><p>Sản phẩm<br/>của tôi</p></div></a>
            <a href="m/mod/dao-tao-san-pham/"><div class="item end"><img src="i/sanpham.png" /><p>Đào tạo<br/>sản phẩm</p></div></a>
            <?php if($u['level']>1){?>
            <a href="m/mod/dao-tao-ky-nang/"><div class="item"><img src="i/kynang.png" /><p>Đào tạo<br/>kỹ năng</p></div></a>
            <?php }else{?>
            <a href="javascript:void(0)" onclick="alert('Tính năng chỉ dành cho Nhà phân phối trở lên')"><div class="item"><img src="i/kynang.png" /><p>Đào tạo<br/>kỹ năng</p></div></a>
            <?php }?>
            <a href="m/mod/hoi-dap/"><div class="item"><img src="i/hoidap.png" /><p>Hỏi đáp<br/>hệ thống</p></div></a>
            <a href="m/mod/huong-dan/"><div class="item end"><img src="i/book.png" /><p>Hướng dẫn<br/>kỹ thuật</p></div></a>
            <a href="m/mod/thu-vien-feedback/"><div class="item"><img src="i/social-media.png" /><p>Feedback<br/>Media</p></div></a>
            <?php if($u['level']>1){?>
            <a href="m/mod/thu-vien-quy-trinh/"><div class="item"><img src="i/quytrinh.png" /><p>Thư viện<br/>Quy trình</p></div></a>
            <?php }else{?>
            <a href="javascript:void(0)" onclick="alert('Tính năng chỉ dành cho Nhà phân phối trở lên')"><div class="item"><img src="i/quytrinh.png" /><p>Thư viện<br/>Quy trình</p></div></a>
            <?php }?>
            <a href="m/thongbao/"><div class="item end"><img src="i/thongbao.png" /><p style="margin-bottom: 5px;">Thông báo</p><sup style="color: red;">(<?php echo $sotin?>)</sup></div></a>
            <?php }?>
            <div class="clearfix"></div>
            <h3 class="titUT">Link <span style="color: red;">quan trọng</span></h3>
            <p><i class="fas fa-link"></i> Link giới thiệu trực tiếp</p>
            <form style="margin-bottom: 15px;">
            <div class="input-group showid">
              <span class="input-group-addon">Link Downline: </span>
              <input type="text" style="background: white; border-right: 0;" class="form-control" readonly="" id="magioithieu" value="<?php echo $domain.'dangky/'.$u['phone']?>"/>
              <span class="input-group-addon btn btn-primary" id="btncopy"><i class="far fa-copy"></i></span>
              <span class="tooltip">Đã copy</span>
            </div>
            </form>
            <script>
                const copyText = document.querySelector("#magioithieu");
                const button = document.querySelector("#btncopy");
                const tooltip = document.querySelector(".tooltip");
                button.addEventListener('click', function(){
                  copyText.select();
                  tooltip.classList.add("show");
                  setTimeout(function(){
                    tooltip.classList.remove("show");
                  },2000);
                  document.execCommand("copy");
                });
            </script>
            <?php 
            if($ru['zalo']!=''){
            ?>
            <p><i class="fab fa-staylinked"></i> Nhóm Zalo hỗ trợ</p>
            <p><a href="<?php echo $ru['zalo'];?>" target="_blank"><i class="fas fa-link"></i> <?php echo $ru['zalo'];?></a></p>
            <?php 
            }
            if($ru['facebook']!=''){
            ?>
            <p><i class="fab fa-facebook"></i> Nhóm facebook hỗ trợ</p>
            <p><a href="<?php echo $ru['facebook'];?>" target="_blank"><i class="fas fa-link"></i> <?php echo $ru['facebook'];?></a></p>
            <?php }?>
            <?php 
            if($ru['youtube']!=''){
            ?>
            <p><i class="fab fa-youtube"></i> Kênh Youtube</p>
            <p><a href="<?php echo $ru['youtube'];?>" target="_blank"><i class="fas fa-link"></i> <?php echo $ru['youtube'];?></a></p>
            <?php } if($u['id']!=1){?>
            <div class="clearfix"></div>
            <h3 class="titUT">Team hỗ trợ <span style="color: red;">của bạn</span></h3>
            <style>
            .rightsupport{
                float: right;
                width: calc(100% - 110px);width: -moz-calc(100% - 110px);width: -webkit-calc(100% - 110px);
                text-align: left;
            }
            .rightsupport p.caphotro{
                font-family: "UT",Arial, Helvetica, sans-serif;
                padding-bottom: 0px;
                font-size: 19px;
                border-left: 4px solid #028f87;
                padding-left: 10px;
                margin-bottom: 7px;
                line-height: 20px !important;
            }
            .rightsupport p.tenht{
                font-family: "UT",Arial, Helvetica, sans-serif;
                font-size: 16px;
                margin-bottom: 7px;
                color: #777474;
                font-style: italic;
            }
            .rightsupport p.nut{}
            </style>
            <?php
            }
            if($u['idgioithieu']!=0){
            $tructiep=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$u[idgioithieu]"));
            ?>
            <div class="boxdulieu" style="margin-bottom: 10px;">
            <div class="item" style="background: none;height: auto; width: 100%;">
            <div style="border-radius: 50%;margin-bottom: 10px;width: 80px;height: 80px;float: left;margin-left: 15px;background-image: url(<?php if($tructiep['avatar']!=''){echo 'upload/avatar/'.$tructiep['avatar'];}else{if($tructiep['gioitinh']=='nu'){echo 'i/avatar_nu.png';}else{echo 'i/avatar_nam.png';}}?>); background-position: center; background-size: cover;"></div>
            <div class="rightsupport">
            <p class="caphotro"><?php echo $tructiep['fullname']?></p>
            <p class="tenht">Người hướng dẫn trực tiếp của bạn</p>
            <p class="nut">
                <?php if($tructiep['facebook']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" target="_blank" href='fb://profile/<?php echo $tructiep['facebook']?>'><i class="fab fa-facebook-square"></i></a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/<?php echo $tructiep['facebook']?>'><i class="fab fa-facebook-square"></i></a> 
                <?php }?>
                <?php if($tructiep['tiktok']!=''){?>
                <a type="button" style="background: black;color: white;" class="btn btn-primary btn-xs" target="_blank" href='<?php echo $tructiep['tiktok']?>'>Tiktok</a> 
                <?php }?>
                <?php if($tructiep['facebook']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" target="_blank" href='https://fb.com/msg/<?php echo $tructiep['facebook']?>'><i class="fab fa-facebook-messenger"></i></a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/messages/t/<?php echo $tructiep['facebook']?>'><i class="fab fa-facebook-messenger"></i></a> 
                <?php }?>
                <?php if($tructiep['phone']!=''){?><a type="button" class="btn btn-info btn-xs" target="_blank" href='https://zalo.me/<?php echo $tructiep['phone']?>'>Zalo</a><?php }?>
                <?php if($tructiep['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href='tel:<?php echo $tructiep['phone']?>'>Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $tructiep['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($tructiep['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href='sms:<?php echo $tructiep['phone']?>'>SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $tructiep['phone']?>');">SMS</a>
                <?php }?>
                </p>
            </div>
            </div>
            <div class="clearfix"></div>
            </div>
            <?php 
            }
            ?>
            </div>
            <div class="clearfix"></div>
            <p>&nbsp;</p>
        </div>
     