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
</style>
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr" style="position: relative;">
        <img src="images/shopping.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Đơn hàng chủ hệ thống</b></p>
            <p id="ttdon"></p>
        </div>
        <div class="clearfix"></div>
    </div>
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
        if(!isset($_GET['time']) or $_GET['time']=='today'){
            $themdk='and donhang.time > '.date('Y').date('m').date('d').'000000 and donhang.time < '.date('Y').date('m').date('d').'250000';
            $a_today='primary';$a_tomorrow='default';$a_week='default';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Hôm nay: '.$daysOfWeekNames[$thuhomnay].', ngày '.date('d/m/Y').'</p></div>';
        }elseif($_GET['time']=='tomorrow'){
            $themdk='and donhang.time > '.$homqua.'000000 and donhang.time < '.$homqua.'250000';
            $a_today='default';$a_tomorrow='primary';$a_week='default';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Hôm qua: '.$daysOfWeekNames[$thuhomqua].', ngày '.$ngayhomqua.'</p></div>';
        }elseif($_GET['time']=='week'){
            $themdk='and donhang.time > '.$dautuan.'000000';
            $a_today='default';$a_tomorrow='default';$a_week='primary';$a_month='default';$a_change='default';
            $showtime='<div style="padding-top: 10px;margin-bottom: 20px;font-style: italic;font-size: 13px;"><p><i class="far fa-clock"></i> Từ: Thứ 2, ngày '.date ( 'd/m/Y' , $dautuan0 ).' tới hôm nay</p></div>';
        }elseif($_GET['time']=='month'){
            $themdk='and donhang.time > '.$dauthang.'000000';
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
            $themdk='and donhang.time > '.$sltu.'000000 and donhang.time < '.$sltoi.'250000';
            $showtime='
            <form action="/m/donhangcht/" method="GET" style="padding-top:7px">
              <div class="row">
              <div class="col-lg-6 col-xs-6" style="margin-bottom: 2px; padding-right: 2px;">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Từ</button>
                  </span>
                  <input name="time" type="hidden" value="change" />
                  <input style="border: 0;line-height: 30px;height: 30px;" value="'.$tutu.'" type="date" name="tu" class="form-control"/>
                </div>
              </div>
              <div class="col-lg-6 col-xs-6" style="padding-left: 2px;">
                <div class="input-group">
                <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Tới</button>
                  </span>
                  <input style="border: 0;line-height: 30px;height: 30px;" type="date" name="toi" value="'.$toitoi.'" class="form-control" />
                </div>
              </div>
            </div>
            <button type="submit" style="margin-top: 7px;border: 0;" class="btn btn-default">Xem thu nhập <i class="fas fa-search-dollar"></i></button>
            </form>
            ';
        }
        ?>
    <div class="groupteam">    
    <?php
    if(isset($_GET['iddon'])){
        $iddon=intval($_GET['iddon']);
        $don=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where id=$iddon"));
        $sanpham=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$don[idsanpham]"));
        $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$don[idu]"));
        $f='<span style="font-weight: normal;"> [F'.(count(explode("**",$nguoiban['hethong']))-1).']</span>';
    ?>
    <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <a href="/m/donhangcht/" style="color: #333;">DS đơn </a> / <span style="color: red;">Chi tiết đơn</span> </h3>
    <script>$('body').ready(function(){$('#ttdon').html('<i class="fas fa-shopping-cart"></i> Xem chi tiết');})</script>
    <div class="itemdon">
                            <p style="font-weight: bold;">Sản phẩm: <?php echo $sanpham['ten']?></p>
                            <p style="font-size: 0.85em; font-style: italic;position: relative;"><i class="far fa-clock"></i> <?php echo tra_lai_time($don['time'])?>
                            <?php if($don['nentang']==0){?>
                            <p>Nền tảng: Tiktok Affiliate</p>
                            <?php }else{?>
                            <p>Nền tảng: Đa nền tảng</p>
                            <?php }?>
                            </p>
                            <div class="clearfix"></div>
                            <p>Mã đơn: <span style="color: #FF8000;"><?php echo $don['madon']?></span></p>
                            <p>Đơn hàng của: <b><?php echo $nguoiban['fullname'].$f?></b></p>
                            <?php 
                            if($don['trangthai']==0){//chờ thanh toán
                                echo '<p>Trạng thái: Chờ thanh toán</p>';    
                            }elseif($don['trangthai']==1){//kh đã nhận đơn , chờ quyét toán
                                echo '<p>Trạng thái: KH đã nhận, chờ quyết toán</p>';    
                            }elseif($don['trangthai']==2){//đa quyết toán
                                echo '<p>Trạng thái: Đã quyết toán</p>';      
                            }elseif($don['trangthai']==3){//đa hủy
                                echo '<p>Trạng thái: Đơn hủy</p>';      
                            }elseif($don['trangthai']==4){//không hoàn thành
                                echo '<p>Trạng thái: Giao hàng không thành</p>';      
                            }
                            ?>
                            <?php if($don['nentang']!=0){?>
                            <p><i class="fas fa-user-tag"></i> <b><?php echo $don['hoten']?></b> - SĐT: <a href="tel:<?php echo $don['sdt']?>"><?php echo $don['sdt']?></a></p>
                            <p>Địa chỉ nhận hàng: <i><?php echo $don['diachi']?></i></p>
                            <?php
                            if($don['chanquay']==1){echo '<p> Chân quay: 01</p>';}
                            ?>
                            <?php
                            if($don['banxoay']==1){echo '<p> Bàn xoay: 01</p>';}
                            ?>
                            <?php }
                            if($don['trangthai']!=2){
                            ?>
                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                    <td class="text-left">Doanh thu:</td>
                                    <th class="text-right" style="color: red;"><?php echo number_format($don['gia'],0,',','.')?><sup>đ</sup></th>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng cơ bản - <?php echo $sanpham['pt_coban']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*$sanpham['pt_coban']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng Bignet - <?php echo $sanpham['pt_them']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*$sanpham['pt_them']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng 3 đơn - <?php echo $sanpham['pt_3don']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*$sanpham['pt_3don']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng hướng dẫn - <?php echo $sanpham['pt_huongdan']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*$sanpham['pt_huongdan']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng quản lý - <?php echo $sanpham['pt_hethong']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*$sanpham['pt_hethong']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phí (Sàn+Ship) - 11.5%:</td>
                                    <td class="text-right">-<?php echo number_format($don['gia']*0.115,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Giá Cost:</td>
                                    <th class="text-right">-<?php echo number_format($sanpham['chuhethong'],0,',','.')?><sup>đ</sup></th>
                                </tr>
                                <tr>
                                    <td class="text-left">Lợi nhuận tạm tính:</td>
                                    <?php $tienln=$don['gia']-$don['gia']*$sanpham['pt_coban']*0.01-$don['gia']*$sanpham['pt_them']*0.01-$don['gia']*$sanpham['pt_3don']*0.01-$don['gia']*$sanpham['pt_huongdan']*0.01-$don['gia']*$sanpham['pt_hethong']*0.01-$sanpham['chuhethong']-$don['gia']*0.115; ?>
                                    <th class="text-right" style="color: <?php if($don['trangthai']==2){echo '#29b12e';}else{ echo 'red';}?>;"><?php if($don['trangthai']>2){echo 0;}else{ echo number_format($tienln,0,',','.');}?><sup>đ</sup></th>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2" style="font-style: italic;font-size: 0.9em;padding-top: 20px;text-align: justify;"><b>Lưu ý: </b> Lợi nhuận tạm tính là lợi nhuận khi trừ tất cả các chi phí. Tuy nhiên khi đơn hàng quyết toán hệ thống sẽ kiểm tra các điều kiện hoa hồng và có thể cộng thêm vào lợi nhuận này nếu như điều kiện HH Hướng dẫn và HH Quản lý của người nhận không thỏa mãn.</td>
                                </tr>
                              </table>
                              <?php }else{
                                $doncht=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhangcht where iddon=$don[id]"));
                                ?>
                              <div class="table-responsive">
                              <table class="table">
                                <tr>
                                    <td class="text-left">Doanh thu:</td>
                                    <th class="text-right" style="color: red;"><?php echo number_format($doncht['gia'],0,',','.')?><sup>đ</sup></th>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng cơ bản - <?php echo $doncht['hhcoban']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['gia']*$doncht['hhcoban']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng Bignet - <?php echo $doncht['hhthem']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['gia']*$doncht['hhthem']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng 3 đơn - <?php echo $doncht['hh3don']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['gia']*$doncht['hh3don']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng hướng dẫn - <?php echo $doncht['hhhuongdan']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['gia']*$doncht['hhhuongdan']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Hoa hồng quản lý - <?php echo $doncht['hhhethong']?>%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['gia']*$doncht['hhhethong']/100,0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phí (Sàn+Ship) - 11.5%:</td>
                                    <td class="text-right">-<?php echo number_format($doncht['phi'],0,',','.')?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Giá Cost:</td>
                                    <th class="text-right">-<?php echo number_format($sanpham['chuhethong'],0,',','.')?><sup>đ</sup></th>
                                </tr>
                                <tr>
                                    <td class="text-left">Lợi nhuận dòng:</td>
                                    <th class="text-right" style="color: #29b12e;"><?php echo number_format($doncht['loinhuan'],0,',','.')?><sup>đ</sup></th>
                                </tr>
                              </table>  
                              <?php }?>
                            </div>
                        </div>
                        <p>&nbsp;</p>
    <?php    
    }else{
    ?>          
    <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;">Đơn hàng hệ thống</span> 
    <?php if($u['vip']==3){?><a style="float: right;" type="button" href="/m/mycart/"> Đơn hàng của tôi</a><?php }?></h3>
    <p>
            <a class="label label-<?php echo $a_today?>" href="/m/donhangcht/?time=today">Hôm nay</a>
            <a class="label label-<?php echo $a_tomorrow?>" href="/m/donhangcht/?time=tomorrow">Hôm qua</a>
            <a class="label label-<?php echo $a_week?>" href="/m/donhangcht/?time=week">Tuần này</a>
            <a class="label label-<?php echo $a_month?>" href="/m/donhangcht/?time=month">Tháng này</a>
            <a class="label label-<?php echo $a_change?>" href="/m/donhangcht/?time=change">Tùy chỉnh</a>
    </p>
    
                <?php 
                echo $showtime;
                $tdon=@mysqli_query($con,"select * from donhang where ((idu IN (SELECT id FROM dh_user WHERE hethong LIKE '%*$u[id]*%')) or idu=$u[id]) $themdk order by time desc");
                $sodon=@mysqli_num_rows($tdon);
                ?>
                <script>$('body').ready(function(){$('#ttdon').html('<i class="fas fa-shopping-cart"></i> <?php echo $sodon?> đơn hàng');})</script>
                <?php
                if($sodon==0){
                    echo '<p class="text-center">
                        <img class="fa5" style="float: none;" src="i/5fa.png" />
                    </p>
                    <p class="text-center">Chưa có đơn hàng được ghi nhận</p><p>&nbsp;</p>';
                }else{
                while($rdon=@mysqli_fetch_assoc($tdon)){
                    $timsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rdon[idsanpham]"));
                        $ten=$timsp['ten'];
                            if($rdon['trangthai']==0){//chờ thanh toán
                                $button='<p>Trạng thái: Chờ thanh toán</p>';    
                            }elseif($rdon['trangthai']==1){//kh đã nhận đơn , chờ quyét toán
                                $button='<p>Trạng thái: KH đã nhận, chờ quyết toán</p>';    
                            }elseif($rdon['trangthai']==2){//đa quyết toán
                                $button='<p>Trạng thái: Đã quyết toán</p>';      
                            }elseif($rdon['trangthai']==3){//đa hủy
                                $button='<p>Trạng thái: Đơn hủy</p>';      
                            }elseif($rdon['trangthai']==4){//không hoàn thành
                                $button='<p>Trạng thái: Giao hàng không thành</p>';      
                            }
                            //tìm xem người bán là ai
                            $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$rdon[idu]"));
                            $f='<span style="font-weight: normal;"> [F'.(count(explode("**",$nguoiban['hethong']))-1).']</span>';
                            ?>
                    
                     <div class="itemdon">
                            <p style="font-weight: bold;"><a href="/m/donhangcht/?iddon=<?php echo $rdon['id']?>"><?php echo $ten?></a> </p>
                            <p style="font-size: 0.85em; font-style: italic;position: relative;"><i class="far fa-clock"></i> <?php echo tra_lai_time($rdon['time'])?></p>
                            <?php if($rdon['nentang']==0){?>
                            <p>Nền tảng: Affiliate Tiktok</p>
                            <?php }else{?>
                            <p>Nền tảng: Affiliate đa nền tảng</p>
                            <?php }?>
                            
                            <?php echo $button?>
                            <div class="clearfix"></div>
                            <p>Mã đơn: <span style="color: #FF8000;"><?php echo $rdon['madon']?></span></p>
                            <p>Đơn hàng của: <b><?php echo $nguoiban['fullname'].' '.$f?></b></p>
                            <p>Doanh số cơ sở: <b><?php echo number_format($rdon['gia'],0,',','.')?><sup>đ</sup></b></p>
                            <?php
                            if($rdon['trangthai']==2){
                                $doncht=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhangcht where iddon=$rdon[id]"));
                                $loinhuan='<i style="font-weight: normal;">Lợi nhuận:</i> <span style="color:#29b12e">'.number_format($doncht['loinhuan'],0,',','.').'<sup>đ</sup></span>';
                            }else{
                                $tienln=$rdon['gia']-$rdon['gia']*$timsp['pt_coban']*0.01-$rdon['gia']*$timsp['pt_them']*0.01-$rdon['gia']*$timsp['pt_3don']*0.01-$rdon['gia']*$timsp['pt_huongdan']*0.01-$rdon['gia']*$timsp['pt_hethong']*0.01-$timsp['chuhethong']-$rdon['gia']*0.115;
                                if($rdon['trangthai']>2){
                                    $loinhuan='<i style="font-weight: normal;">Lợi nhuận:</i> 0</span>';
                                }else{
                                    $loinhuan='<i style="font-weight: normal;">Lợi nhuận dự kiến:</i> <span style="color:red">'.number_format($tienln,0,',','.').'<sup>đ</sup></span>';
                                }
                            }
                            ?>
                            <p style=""> <b><?php echo $loinhuan?></b> <a style="float: right;" href="/m/donhangcht/?iddon=<?php echo $rdon['id']?>">Xem chi tiết</a></p>
                            
                        </div>
                     <?php  
                      
                    }
                    }
                ?>
    <div class="clearfix"></div>
    <?php }?>
</div>
</div>