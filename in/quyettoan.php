<?php
if($u['id']!=1){exit();}
?>
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
                width: 30%;
                float: left;
                height: 85px;
                background: #eefb82;
                text-align: center;
                font-size: 1.2em;
                font-weight: 600;
                padding-top: 30px;
                color: red;
            }
            .listtin .anh img{
                width: 100%;
            }
            .listtin .thongtin{
                width: 67%;
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
.contag.dr .dealright{
    width: calc(100% - 85px);width: -moz-calc(100% - 85px);width: -webkit-calc(100% - 85px);
}
</style>
<?php if($ru['id']!=1){exit();}?>
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr" style="position: relative;">
        <div class="avatar"></div>
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Tài chính: <?php echo $u['fullname']?></b></p>
            <p>Số dư: <b style="color: red; font-size: 0.8em;"><?php echo number_format($sodu,0,',','.');?><sup>đ</sup></b> &nbsp;&nbsp;&nbsp; 
            <?php
            if($u['id']!=1){
                if($sodu==0){
                    ?>
                    <a type="button" class="btn btn-xs btn-default" id="ruttien01">Rút tiền</a>
                    <script>
                    $('#ruttien01').click(function(){
                        var te='<h4 style="color: red;padding-bottom: 15px;text-align:center"><i class="fas fa-exclamation-triangle"></i> Thông báo</h4><p style="text-align:center">Tài khoản của bạn không có số dư để rút tiền</p>';
                        shownote(te);
                    })
                    </script>
                    <?php
                }elseif($sodu>0 and $sodu<100000){
                    ?>
                    <a type="button" class="btn btn-xs btn-default" id="ruttien01">Rút tiền</a>
                    <script>
                    $('#ruttien01').click(function(){
                        var te='<h4 style="color: red;padding-bottom: 15px;text-align:center"><i class="fas fa-exclamation-triangle"></i> Thông báo</h4><p style="text-align:center">Số dư tối thiểu để rút tiền là 100.000đ.</p>';
                        shownote(te);
                    })
                    </script>
                    <?php
                }elseif($u['dongbang']>0){
                    ?>
                    <a type="button" class="btn btn-xs btn-default" id="ruttien01">Rút tiền</a>
                    <script>
                    $('#ruttien01').click(function(){
                        var te='<h4 style="color: red;padding-bottom: 15px;text-align:center"><i class="fas fa-exclamation-triangle"></i> Thông báo</h4><p style="text-align:center">Bạn đang đang có 1 lệnh rút tiền chờ xử lý, hãy đợi hoàn thành xong lệnh cũ trước khi yêu cầu 1 lệnh mới.</p>';
                        shownote(te);
                    })
                    </script>
                    <?php
                }else{
                    ?>
                    <a type="button" class="btn btn-xs btn-primary" href="/m/taichinh/<?php echo md5($ngay)?>">Rút tiền</a>
                    <?php
                }
            }
            ?>
            </p>
            <?php if($u['dongbang']>0){?>
                <p style="font-size: 0.83em;">(Bạn có <span style="color: red;"><?php echo number_format($u['dongbang'],0,'.',',');?> <sup><u>đ</u></sup></span> đang chờ thanh toán)</p>
            <?php }?>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="groupteam">
    <style>
.statistic-col {
  box-shadow: 0 2px 8px rgb(3 44 71 / 12%);
  border-radius: 6px;
  flex: 1;
  background-color: #fff;
  padding: 20px;
  margin-bottom: 10px;
  margin-top: 30px;
}

.statistic-title {
  display: flex;
  flex-direction: row;
  align-items: center;
  column-gap: 10px;
}

.statistic-title img {
  width: 48px;
  height: 48px;
}

.statistic-title h4 {
  margin: 0;
  flex: 1;
  font-weight: bold;
}

.statistic-content {
  margin-top: 10px;
  display: block;
  flex-direction: row;
  column-gap: 10px;
}
.statistic-content.cont2{
    display: block;
    padding-top: 15px;
}
.statistic-content.cont2 p b{
    float: right;
}
.statistic-content.cont2 p{
    background: #0a7bdd;
    padding: 10px;
    border-radius: 6px;
    color: white;
}
.statistic-content.cont2 p i{color: yellow;}
.statistic-group {
  flex: 1;
  display: flex;
  flex-direction: row;
  background: #f6f7fc;
  border-radius: 6px;
  align-items: center;
  padding: 10px;
  column-gap: 10px;
  margin-bottom: 10px;
}

.statistic-group-right .title {
  font-size: 11px;
  padding-left: 0;
}

.statistic-group-right .total {
  font-weight: bold;
  color: #172a6f;
  font-size: 16px;
}

.right-menu {
  padding-left: 15px;
  padding-right: 15px;
}
.thongbaoemail{
    text-align: center;
    border: 1px solid #e3e3e3;
    padding: 10px 0 5px;
    margin-bottom: 20px;
    margin-top: 25px;
    border-radius: 5px;
    background: aliceblue;
}
#formmaemail{display: none;}
#xacnhanrutien{display: none;}
.itemdon{
    padding: 15px 10px;
    background: white;
    margin-top: 15px;
    border-radius: 8px;
}
</style>
<?php if(!isset($_GET['trangthai'])){$dkthem='and trangthai=0';$trangthai=0;}else{$dkthem='and trangthai='.intval($_GET['trangthai']);$trangthai=intval($_GET['trangthai']);}?>
<h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;">Yêu cầu rút tiền (<?php echo @mysqli_num_rows(@mysqli_query($con,"select * from yeucauruttien where trangthai=0"));?>)</span></h3>
<a type="button" class="btn btn-<?php if($trangthai==0){echo 'primary';}else{echo 'default';}?> btn-xs" href="/m/quyettoan/?trangthai=0">Chờ thanh toán</a>
<a type="button" class="btn btn-<?php if($trangthai==1){echo 'primary';}else{echo 'default';}?> btn-xs" href="/m/quyettoan/?trangthai=1">Đã thanh toán</a>
<?php 
    if(isset($_GET['id'])){
        $idy=intval($_GET['id']);
        $don=@mysqli_query($con,"select * from yeucauruttien where id=$idy");
        $rd=@mysqli_fetch_assoc($don);
        $idyc=$rd['idu'];
        $timtv=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$rd[idu]"));
?>
<p style="padding-top: 15px;"><a href="/m/quyettoan/?trangthai=<?php echo $trangthai?>"><i class="fas fa-arrow-left"></i> Trở lại</a></p>
        <div class="itemdon">
            <p style="font-size: 0.85em; font-style: italic;position: relative;"><i class="far fa-clock"></i> <?php echo tra_lai_time($rd['time'])?></p>
            <div class="clearfix"></div>
            <p><i class="fas fa-user-tag"></i> <b><?php echo $timtv['fullname']?></b> - SĐT: <a href="tel:<?php echo $timtv['phone']?>"><?php echo $timtv['phone']?></a></p>
            <p>Mã lệnh: <span>#<?php echo $rd['ma']?></span></p>
            <p>Số tiền: <b style="color: red;"><?php echo number_format($rd['sotien'],0,',','.')?><sup>đ</sup></b></p>
            <div style="padding: 8px 0;">
            <div style="width: 48%; float: left;">
            <?php
                $nganhang=@mysqli_fetch_assoc(@mysqli_query($con,"select * from bank where id=$timtv[bank] limit 1"));
                $ndck=$ru['viettatteam'].' thu nhập Affiliate '.$rd['ma'];
                $past='https://img.vietqr.io/image/'.$nganhang['ten'].'-'.$timtv['banknumber'].'-compact.jpg?amount='.$rd['sotien'].'&addInfo='.$ndck.'&accountName='.$timtv['fullname'].'';
                echo '<img class="maqr" src="'.$past.'"/>';
            ?>
            </div>
            <div style="width: 48%; float: right; font-size: 0.9em;">
            <?php 
            echo '<p class="text-center" style="padding-top: 15px;">Quét mã hoặc chuyển khoản</p>';
            echo '<p class="text-center">CTK: <b>'.$timtv['fullname'].'</b></p>';
            echo '<p class="text-center">Ngân hàng: <b>'.$nganhang['ten'].'</b></p>';
            echo '<p class="text-center">STK: <b>'.$timtv['banknumber'].'</b></p>';
            echo '<p class="text-center">Nội dung: <i>'.$ndck.'</i></p>'; 
            ?>
            </div>
            <div class="clearfix"></div>
            </div>
            <p>&nbsp;</p>
            <p class="text-center">
            <!--a <?php if($rd['trangthai']>0 ){echo 'style="display: none;"';}?> type="button" class="btn btn-xs btn-danger" href="xulydon.php?xuly=huydon&iddon=<?php echo $rd['id'];?>">Đơn hủy</a--> 
            <a <?php if($rd['trangthai']>0 ){echo 'style="display: none;"';}?> type="button" class="btn btn-xs btn-success" href="/xulydon.php?xuly=chuyenkhoan&id=<?php echo $rd['id'];?>"><i class="fab fa-monero"></i> Xác nhận thanh toán</a> 
            </p>                        
        </div>
<div class="boxshow">
    <div class="statistic-col">  
    <div class="statistic-title" style="margin-bottom: 30px;">
                                <img src="images/cho-thue.svg">
                                <h4>Lịch sử nhận tiền</h4>
                            </div>                  
        <div class="boxlichsu">
        <?php 
        $ls=@mysqli_query($con,"select * from lichsutien where idu=$u[id] order by time desc");
        if(@mysqli_num_rows($ls)==0){
        ?>
        <p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png"></p><p class="text-center">Chưa có lịch sử nào được ghi nhận</p><p>&nbsp;</p>
        <?php    
        }else{
        while($rls=@mysqli_fetch_assoc($ls)){
        ?>
        <div style="border-bottom: 1px solid #eeeeee;">
        <p style="margin-top: 20px;margin-bottom: 5px;font-size: 0.9em;"><i class="fas fa-share"></i> <?php echo retimefull($rls['time']);?></p>
        <p><?php echo $rls['noidung'];?></p> 
        <p>Số tiền: <b style="color: red;"><?php echo number_format($rls['sotien'],0,',','.');?><sup>đ</sup></b></p>  
        </div>   
        <?php }}?>
        </div>
    </div>
</div>
<?php  
    }else{
    $dates = date('Y-m-d');
    $newdate = strtotime ( '-30 day' , strtotime ( $dates ) ) ;
    $newdate = date ( 'Ymd' , $newdate ).'000000';
    $don=@mysqli_query($con,"select * from yeucauruttien where time>$newdate $dkthem order by time desc");
    $sodon=@mysqli_num_rows($don);
    if($sodon==0){
        echo '<p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png" /></p><p class="text-center">Chưa có yêu cầu nào được ghi nhận</p><p>&nbsp;</p>';
    }else{
    while($rd=@mysqli_fetch_assoc($don)){
        $idyc=$rd['idu'];
        $timtv=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$rd[idu]"));
?>
        <div class="itemdon">
            <p style="font-size: 0.85em; font-style: italic;position: relative;"><i class="far fa-clock"></i> <?php echo tra_lai_time($rd['time'])?></p>
            <div class="clearfix"></div>
            <p><i class="fas fa-user-tag"></i> <b><?php echo $timtv['fullname']?></b> - SĐT: <a href="tel:<?php echo $timtv['phone']?>"><?php echo $timtv['phone']?></a></p>
            <p>Mã lệnh: <span>#<?php echo $rd['ma']?></span></p>
            <p>Số tiền: <b style="color: red;"><?php echo number_format($rd['sotien'],0,',','.')?><sup>đ</sup></b></p>
            <div style="padding: 8px 0;">
            <div style="width: 48%; float: left;">
            <?php
                $nganhang=@mysqli_fetch_assoc(@mysqli_query($con,"select * from bank where id=$timtv[bank] limit 1"));
                $ndck=$ru['viettatteam'].' thu nhập Affiliate '.$rd['ma'];
                $past='https://img.vietqr.io/image/'.$nganhang['ten'].'-'.$timtv['banknumber'].'-compact.jpg?amount='.$rd['sotien'].'&addInfo='.$ndck.'&accountName='.$timtv['fullname'].'';
                echo '<img class="maqr" src="'.$past.'"/>';
            ?>
            </div>
            <div style="width: 48%; float: right; font-size: 0.9em;">
            <?php 
            echo '<p class="text-center" style="padding-top: 15px;">Quét mã hoặc chuyển khoản</p>';
            echo '<p class="text-center">CTK: <b>'.$timtv['fullname'].'</b></p>';
            echo '<p class="text-center">Ngân hàng: <b>'.$nganhang['ten'].'</b></p>';
            echo '<p class="text-center">STK: <b>'.$timtv['banknumber'].'</b></p>';
            echo '<p class="text-center">Nội dung: <i>'.$ndck.'</i></p>'; 
            ?>
            </div>
            <div class="clearfix"></div>
            </div>
            <p>&nbsp;</p>
            <p class="text-center">
            <!--a <?php if($rd['trangthai']>0 ){echo 'style="display: none;"';}?> type="button" class="btn btn-xs btn-danger" href="xulydon.php?xuly=huydon&iddon=<?php echo $rd['id'];?>">Đơn hủy</a--> 
            <a <?php if($rd['trangthai']>0 ){echo 'style="display: none;"';}?> type="button" class="btn btn-xs btn-success" href="/xulydon.php?xuly=chuyenkhoan&id=<?php echo $rd['id'];?>"><i class="fab fa-monero"></i> Xác nhận thanh toán</a> 
            <a <?php if($rd['trangthai']>0 ){echo 'style="display: none;"';}?> type="button" class="btn btn-xs btn-warning" href="/m/quyettoan/?trangthai=<?php echo $trangthai?>&id=<?php echo $rd['id'];?>"><i class="fas fa-sync-alt"></i> Kiểm tra</a>
            </p>                        
        </div>
<?php  
                      
        }
    }
    }
?>


</div>
<div class="clearfix"></div>
</div>
     