<style>
.ttan{}
.ttan .khquantam{
    display: none;
}
.ttan .saledangban{
    display: none;
}
p.titqt{
    padding: 10px 0;
    border-bottom: 1px dotted #999999;
    margin-bottom: 20px
}
p.titqt a{
    float: right;
    color: #02b199;
    background: none;
    border: 0;
    font-size: 11px;
}
ul.showqt_o{
    list-style: auto;
    font-size: 0.9em;
    padding-left: 20px;
}
ul.showqt_o li a.nutu{
    background: none;
    color: #444444;
    border-color: #ffb2a0;
}
ul.showqt_o li h4{
    font-size: 14px;
    padding-top: 5px;
    font-weight: bold;
}
ul.showqt_o li .anhquantam{
    width: 23.5%;
    float: left;
    height: 80px;
    background-position: center;
    background-size: cover;
    margin-right: 1.5%;
    border-radius: 10px;
}
.ttk a{
    background: none !important;
    color: #03a2b7 !important;
    border-color: #d9ebff !important;
}
.ttk a:hover{
    background: #e7e7e7 !important;
}
p.thongbaotrong{
                color: #f44336;
                text-align: center;
                margin-bottom: 20px;
            }
            .dhj{}
            .dhj a{
                padding: 8px;
                background: #f5f7fa;
                background: -webkit-linear-gradient(180deg, #f5f7fa, #c3cfe2);
                background: linear-gradient(180deg, #f5f7fa, #c3cfe2);
                color: #333;
            }
            .under{
                font-size: 16px;
                font-weight: 300;
                color: #494949;
                line-height: 25px;
                margin: 30px 0 20px;
                padding-bottom: 5px;
                position: relative;
            }
            .under:after{
                content: "";
                display: block;
                height: 2px;
                width: 100px;
                background: #2888da;
                position: absolute;
                left: 0;
                bottom: -1px;
            }
            .listtin{
                width: 100%;
                margin-bottom: 20px;
            }
            .listtin .anh{
                width: 25%;
                float: left;
                height: 60px;
                background-image: url('images/xacnhan.jpg');
                background-size: cover;
                background-position: center;
                margin-top: 5px;
            }
            .listtin .anh img{
                width: 100%;
            }
            .listtin .thongtin{
                width: 72%;
                float: right;
            }
            .listtin .thongtin h4{
                margin-top: 0;
                font-size: 13px;
                font-weight: 600;
            }
            .listtin .thongtin p{}
.boxnaptien{
    width: 100%;
    padding: 20px 15px 5px 15px;
    position: relative;
    border: 1px solid #afaeae;
    border-radius: 8px;
    margin-bottom: 20px;
    margin-top: 35px;
}
.boxnaptien span{
    background: #f4f4f4;
    padding: 8px;
    position: absolute;
    top: -20px;
    left: 20px;
    font-weight: 600;
    color: red;
}
.titqt{
    font-size: 16px;
    padding-bottom: 10px;
    position: relative;
}
.titqt:after{
    content: "";
    display: block;
    height: 2px;
    width: 60px;
    background: #2888da;
    position: absolute;
    left: 0;
    bottom: -1px;
}
.itemdon{
    padding: 15px 10px;
    background: white;
    margin-top: 15px;
    border-radius: 8px;
}
.pstatus{
    text-align: center;padding-top: 15px;padding-bottom: 10px;
    font-size: 0.9em;line-height: 30px;
}
.pstatus a{padding: 0px 8px;color: #999797;}
.pstatus a.ustatus{
    font-weight: 600;
    color: #2196F3;
    border-bottom: 2px solid;
    padding-bottom: 5px;
}
</style>
<?php 
$idu=intval($u['id']);
$khach=@mysqli_fetch_assoc(@mysqli_query($con,"select * from user where id=$idu"));
if(!isset($_GET['status']) or $_GET['status']==-1){
    $status=-1;
    $dkstatus_link='';
    $dkstatus_sql='';
}else{
    $status=intval($_GET['status']);
    $dkstatus_link='&status='.$status;
    $dkstatus_sql='and trangthai = '.$status;
}
$link=lay_url();
if($status==-1){
    $link_status=$link;
    $link_status0=str_replace('&status=-1','&status=0',$link);
    $link_status1=str_replace('&status=-1','&status=1',$link);
    $link_status2=str_replace('&status=-1','&status=2',$link);
    $link_status3=str_replace('&status=-1','&status=3',$link);
    $link_status4=str_replace('&status=-1','&status=4',$link);
}
if($status==0){
    $link_status=str_replace('&status=0','&status=-1',$link);
    $link_status0=$link;
    $link_status1=str_replace('&status=0','&status=1',$link);
    $link_status2=str_replace('&status=0','&status=2',$link);
    $link_status3=str_replace('&status=0','&status=3',$link);
    $link_status4=str_replace('&status=0','&status=4',$link);
}
if($status==1){
    $link_status=str_replace('&status=1','&status=-1',$link);
    $link_status0=str_replace('&status=1','&status=0',$link);
    $link_status1=$link;
    $link_status2=str_replace('&status=1','&status=2',$link);
    $link_status3=str_replace('&status=1','&status=3',$link);
    $link_status4=str_replace('&status=1','&status=4',$link);
}
if($status==2){
    $link_status=str_replace('&status=2','&status=-1',$link);
    $link_status0=str_replace('&status=2','&status=0',$link);
    $link_status1=str_replace('&status=2','&status=1',$link);
    $link_status2=$link;
    $link_status3=str_replace('&status=2','&status=3',$link);
    $link_status4=str_replace('&status=2','&status=4',$link);
}
if($status==3){
    $link_status=str_replace('&status=3','&status=-1',$link);
    $link_status0=str_replace('&status=3','&status=0',$link);
    $link_status1=str_replace('&status=3','&status=1',$link);
    $link_status2=str_replace('&status=3','&status=2',$link);
    $link_status3=$link;
    $link_status4=str_replace('&status=3','&status=4',$link);
}
if($status==4){
    $link_status=str_replace('&status=4','&status=-1',$link);
    $link_status0=str_replace('&status=4','&status=0',$link);
    $link_status1=str_replace('&status=4','&status=1',$link);
    $link_status2=str_replace('&status=4','&status=2',$link);
    $link_status3=str_replace('&status=4','&status=3',$link);
    $link_status4=$link;
}
?>
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr" style="position: relative;">
        <img src="images/shopping.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Đơn hàng của tôi</b></p>
            <?php if($u['id']==1){?>
            <p><a href="/m/thongbao/?add=1">Tạo thông báo</a></p>
            <?php }else{?>
            <!--p>Hotline hỗ trợ: <a style="color: red;" href="tel:<?php echo $u['phone']?>"><?php echo $u['phone']?></a></p-->
            <?php }?>
            <p id="ttdon"></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php 
    if(isset($_GET['add'])){}else{
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
        if(!isset($_GET['time']) or $_GET['time']=='today'){
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
        }elseif($_GET['time']=='month'){
            $themdk='and time > '.$dauthang.'000000';
            $a_today='default';$a_tomorrow='default';$a_week='default';$a_month='primary';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Tháng '.date('m').'/'.date('Y').'</p></div>';
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
            <form action="/m/mycart/" method="GET" id="tututoitoi" style="padding-top:7px">
              <div class="row">
              <div class="col-lg-6 col-xs-6" style="margin-bottom: 2px; padding-right: 2px;">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Từ</button>
                  </span>
                  <input name="time" type="hidden" value="change" /><input name="status" type="hidden" value="'.$status.'" />
                  <input style="border: 0;line-height: 30px;height: 30px;" id="tutu" value="'.$tutu.'" type="date" name="tu" class="form-control"/>
                </div>
              </div>
              <div class="col-lg-6 col-xs-6" style="padding-left: 2px;">
                <div class="input-group">
                <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Tới</button>
                  </span>
                  <input style="border: 0;line-height: 30px;height: 30px;" type="date" id="toitoi" name="toi" value="'.$toitoi.'" class="form-control" />
                </div>
              </div>
            </div>
            <script>$(document).ready(function() {$("#tutu, #toitoi").change(function() {$("form#tututoitoi").submit();});});</script>
            </form>
            ';
        }
        ?>
    <div class="groupteam">              
    <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;">Đơn hàng</span> 
    
    </h3>
    <p>
            <a class="label label-<?php echo $a_today?>" href="/m/mycart/?time=today<?php echo $dkstatus_link?>">Hôm nay</a>
            <a class="label label-<?php echo $a_tomorrow?>" href="/m/mycart/?time=tomorrow<?php echo $dkstatus_link?>">Hôm qua</a>
            <a class="label label-<?php echo $a_week?>" href="/m/mycart/?time=week<?php echo $dkstatus_link?>">Tuần này</a>
            <a class="label label-<?php echo $a_month?>" href="/m/mycart/?time=month<?php echo $dkstatus_link?>">Tháng này</a>
            <a class="label label-<?php echo $a_change?>" href="/m/mycart/?time=change<?php echo $dkstatus_link?>">Tùy chỉnh</a>
    </p>
    
                <?php 
                echo $showtime;
                if($u['id']==1){
                    $don=@mysqli_query($con,"select * from donhang where 1=1 $themdk $dkstatus_sql order by time desc");
                }else{
                    $don=@mysqli_query($con,"select * from donhang where idu=$u[id] $themdk $dkstatus_sql order by time desc");
                }
                $sodon=@mysqli_num_rows($don);
                ?>
                <script>$('body').ready(function(){$('#ttdon').html('<i class="fas fa-shopping-cart"></i> <?php echo $sodon?> đơn hàng');})</script>
   
                <?php
                if($sodon==0){
                    echo '<p class="text-center">
                        <img class="fa5" style="float: none;" src="i/5fa.png" />
                    </p>
                    <p class="text-center">Chưa có đơn hàng được ghi nhận</p><p>&nbsp;</p>';
                }else{
                while($rd=@mysqli_fetch_assoc($don)){
                    $timsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rd[idsanpham]"));
                        $ten=cat_chu($timsp['ten'],6);
                            if($rd['trangthai']==0){//chờ thanh toán
                                $button='<button type="button" class="btn btn-xs btn-primary" style="float: right;">Chờ xác nhận</button>';    
                            }elseif($rd['trangthai']==1){//kh đã nhận đơn , chờ quyét toán
                                $button='<button type="button" class="btn btn-xs btn-info" style="float: right;">Hoàn thành</button>';    
                            }elseif($rd['trangthai']==7){//hủy đơn hoàn tiền
                                $button='<button type="button" class="btn btn-xs btn-danger" style="float: right;">Hủy hoàn tiền</button>';    
                            }
                            if($u['id']==1){$button='';}
                            //tìm xem ngày hôm đó nó có 3 đơn hay không
                            $donngay=@mysqli_query($con,"select * from donhang where idu=$u[id] $themdk order by time desc");
                            ?>
                    
                     <div class="itemdon">
                            <p style="font-weight: bold;"><a href="/m/mycart/?iddon=<?php echo $rd['id']?>"><?php echo $ten?></a> <?php echo $button?></p>
                            <p style="font-size: 0.85em; font-style: italic;position: relative;"><i class="far fa-clock"></i> <?php echo tra_lai_time($rd['time'])?>
                            
                            </p>
                            <div class="clearfix"></div>
                            <p>Mã đơn: <span style="color: #FF8000;"><?php echo $rd['time']?></span></p>
                            <p>Sản phẩm: <span><?php echo $rd['soluong']?></span></p>
                            <?php 
                            $cart=trim($rd['chuoi']);
                            $dj=explode(' ',$cart);
                            $tongtien=0;
                            for($i=0;$i<count($dj);$i++){
                                $scart=$dj[$i];
                                $stach=explode('-',$scart);
                                $idsp=$stach[0];$soluong=$stach[1];
                                $sp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                                echo '<p style="font-weight: bold;color: #009688;">'.($i+1).'. '.$sp['ten'].'</p>';   
                                echo '<p sttle="font-size: 0.85em;">&nbsp;&nbsp;&nbsp;&nbsp;Giá nhập: <span style="font-weight: 700;color: red;">'.number_format(($sp['gia']*(1-$rd['chietkhau']/100)),0,',','.').'đ</span><span style="font-size: 0.9em;text-decoration: line-through;color: darkgray;">'.number_format($sp['gia'],0,',','.').'đ</span></p>'; 
                                echo '<p sttle="font-size: 0.85em;">&nbsp;&nbsp;&nbsp;&nbsp;Số lượng: <span>'.$soluong.'</span> <span style="float: right;">Thành tiền: <i style="color:red">'.number_format(($sp['gia']*(1-$rd['chietkhau']/100)*$soluong),0,',','.').'đ</i></span></p>';
                                $tongtien=$tongtien+($sp['gia']*(1-$rd['chietkhau']/100)*$soluong);
                            } 
                            ?>
                            <hr />
                            <p>Tổng số tiền: <span style="float: right;"><b style="color: red;"><?php echo number_format($tongtien,0,',','.');?><sup>đ</sup></b></span></p>
                            <hr />
                            <p style="font-weight: bold;color: crimson;">Thông tin nhận hàng:</p>
                            <p><i class="fas fa-user-tag"></i> <b><?php echo $rd['hoten']?></b> - SĐT: <a href="tel:<?php echo $rd['sdt']?>"><?php echo $rd['sdt']?></a></p>
                            <p>Địa chỉ nhận hàng: <i><?php echo $rd['diachi']?></i></p>
                            <?php if($rd['ghichu']!=''){?>
                            <p><i class="far fa-comment-dots"></i> Ghi chú: <i><?php echo $rd['ghichu']?></i></p>
                            <?php 
                            }
                            if($u['id']==1){ 
                            ?>
                            <p>Trạng thái: 
                            <?php if($rd['trangthai']<=0 ){?>
                            <a type="button" class="btn btn-xs btn-success" onclick="return confirm('Bạn chắc chắn muốn xác nhận hoàn thành với đơn hàng này?')" href="xulydon.php?xuly=hoanthanh&iddon=<?php echo $rd['id'];?>">Hoàn thành?</a> 
                            <a type="button" class="btn btn-xs btn-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn và hoàn tiền với đơn hàng này?')" href="xulydon.php?xuly=huyhoantien&iddon=<?php echo $rd['id'];?>">Hủy đơn, hoàn tiền?</a> 
                            <?php }elseif($rd['trangthai']==1 ){?>
                            <button type="button" class="btn btn-xs btn-default">Đã hoàn thành</button>
                            <?php }elseif($rd['trangthai']==7 ){?>
                            <button type="button" class="btn btn-xs btn-default">Đã hủy đơn hoàn tiền</button>
                            <?php } ?>
                            </p>
                            <?php }?>
                        </div>
                     <?php  
                      
                    }
                    }
                ?>
            
    <?php }?>
    <div class="clearfix"></div>
</div>
</div>