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
.contag.dr .dealright{
    width: calc(100% - 85px);width: -moz-calc(100% - 85px);width: -webkit-calc(100% - 85px);
}
</style>
<?
$idkhach=intval($_GET['idkhach']);
$khach=@mysql_fetch_assoc(@mysql_query("select * from user where id=$idkhach"));
?>
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Bảng điều khiển</a> </h3>
    <div class="contag dr" style="position: relative;">
        <img src="images/internet-banking.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Tài chính: <?=$khach['fullname']?></b></p>
            <p class="nut">
                <?if($khach['uid']!=''){?>
                <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="fb://profile/<?=$khach['uid']?>">Tường</a> 
                <a type="button" class="btn btn-default btn-xs  hidden-sm  hidden-xs" onclick="location.href='https://www.facebook.com/<?=$khach['uid']?>'">Tường</a> 
                <?}?>
                
                <?if($khach['uid']!=''){?>
                <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="https://fb.com/msg/<?=$khach['uid']?>">Messenger</a> 
                <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" href="https://www.facebook.com/messages/t/<?=$khach['uid']?>">Messenger</a> 
                <?}?>
                <?if($khach['phone']!=''){?><a type="button" class="btn btn-default btn-xs" href="https://zalo.me/<?=$khach['phone']?>">Zalo</a><?}?>
                <?if($khach['phone']!=''){?>
                <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="tel:<?=$khach['phone']?>">Gọi</a>
                <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?=$khach['phone']?>');">Gọi</a>
                <?}?>
                <?if($khach['phone']!=''){?>
                <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="sms:<?=$khach['phone']?>">SMS</a>
                <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?=$khach['phone']?>');">SMS</a>
                <?}?>
            </p>
            <p><i class="far fa-clock"></i> Thời hạn: <b style="color: red; font-size: 0.8em;"><?if($khach['timedichvu']==0){echo 'Chưa nap tiền';}else{echo retime_ngay($khach['timedichvu']);}?> <?if($khach['timedichvu']<$time and $khach['timedichvu']!=0){?><i style="font-weight: normal;">(Hết hạn)</i><?}?></b></p>
        </div>
        <div class="clearfix"></div>
        <?if($u['nhanvien']==0){?><a type="button" style="position: absolute; bottom: 25px; right: 20px;" class="btn btn-primary btn-xs" href="/m/taichinhkhachhang/?idkhach=<?=$idkhach?>&nap=1">Nạp</a><?}?>
    </div>
    <?if(isset($_GET['nap'])){
        if($u['nhanvien']!=0){exit();}
        $thongbao='';
        if(isset($_POST['nap'])){
                $tien=intval($_POST['tien']);
                if($tien>=360000){
                    $uu=@mysql_fetch_assoc(@mysql_query("select * from user where id=$idkhach"));
                    $idsale=$uu['upline'];
                    if($uu['timedichvu']==0){
                        $date = date('Y-m-j');
                    }else{
                        $date = str_replace("/","-",retime_ngay($uu['timedichvu']));
                    }
                
                    if($_FILES['image']['name']){
                        $anhthem1=$_FILES['image']['name'];
                        $size = getimagesize($_FILES['image']['tmp_name']);
                        $rog=$size[0];$ca=$size[1];
                        $width_resize=300;
                        $height_resize=round($width_resize*$ca/$rog); 
                        $anhthem1 = preg_replace('/[^a-zA-Z0-9.]/','-',$anhthem1);
                        $file1='upload/bill/'.$anhthem1;
                        resize_nhieu($width_resize,$height_resize,'image',$file1);
                    }else{
                        $anhthem1='';
                    }
                    $songay=round($tien/12000);
                    $newdate = strtotime ( "+$songay day" , strtotime ( $date ) ) ; 
                    $newdate = date ( 'Y-m-d' , $newdate );
                    $ngayhethan=str_replace("-","",$newdate).'235900';
                    //lich su cho khach hang
                    $noidung1='Bạn đã nạp số tiền <b>'.number_format($tien,0,',','.').'<sup>đ</sup></b> thời gian dịch vụ của bạn là '.tra_lai_time($ngayhethan);
                    $in=@mysql_query("insert into lichsutien (idu,idnap,tien,bill,loai,noidung,time)value($idkhach,$u[id],$tien,N'$anhthem1','naptien',N'$noidung1',$time)");
                    //lich su cho khach hang
                    $tiensale=round($tien*160/360);
                    $noidung2='Khách hàng <b>'.$uu['fullname'].'</b> đã nạp số tiền <b>'.number_format($tien,0,',','.').'<sup>đ</sup></b>. Bạn được cộng <b>'.number_format($tiensale,0,',','.').'<sup>đ</sup></b>';
                    $in=@mysql_query("insert into lichsutien (idu,idnap,tien,bill,loai,noidung,time)value($idsale,$u[id],$tiensale,N'$anhthem1','congtiensale',N'$noidung2',$time)");
                if($in){
                    $uplaitien=@mysql_query("update user set timedichvu=$ngayhethan where id=$idkhach");
                    $uplaitiensale=@mysql_query("update user set tien=tien+$tiensale where id=$idsale");
                    echo '<script>window.location="/m/danhsachuser/?list=3";</script>';
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                
                }else{$thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Số tiền phải lớn hơn 360.000đ!</p>';}
            }
        ?>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/danhsachuser/?list=3" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Trở lại</a></h3>
    <div class="boxnaptien">
        <span>Nạp tiền</span>
        <p>Khi khách hàng gửi Bill cho bạn, hãy kiểm tra và nạp tiền cho khách hàng:</p>
        <form role="form" method="post" enctype="multipart/form-data" action="">
            <?=$thongbao?>
          <div class="form-group">
        
            <label>Nạp tài khoản: <?=$khach['fullname']?></label>
        
            <input type="number" required="" name="tien" min="360000" class="form-control" placeholder="Nhập số tiền (*)"/>
        
          </div>
        
          <div class="form-group"> 
            <label>Ảnh Bill gửi tiền</label>
            <input type="file" name="image"/>
          </div>
        
          <button type="submit" name="nap" class="btn btn-primary">Nạp tiền</button>
        <p>&nbsp;</p>
        </form>
        <p style="display: none;"><i>Sau khi bạn nạp tiền sẽ được cộng tạm thời vào tài khoản của khách hàng. Chúng tôi sẽ xác minh lại sau.</i></p>
    </div>
    </div>
    <?}else{
    ?>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/khachhang/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Trở lại danh sách khách hàng</a></h3>
    <div class="boxnaptien">
        <span>Thông tin nạp tiền</span>
        <p>A/c vui lòng nạp tối thiểu 360.000đ với thông tin chuyển khoản như sau:</p>
        <p>Tài khoản: 23777137</p>
        <p>Ngân hàng: ACB Thái Bình - Bùi Văn Mạnh</p>
        <p>Nội dung nạp tiền: DT<?=$khach['phone']?></p>
        <p><i>Sau khi chuyển khoản hệ thống sẽ kiểm tra và nạp tiền vào tài khoản trong 5 phút - 24 giờ mà không cần thao tác gì thêm. Tuy nhiên bạn nên chụp Bill gửi cho nhân viên tư vấn để nạp ngay lập tức.</i></p>
    </div>
    <h3 class="titqt">Lịch sử tiền</h3>
    <?
    $tin=@mysql_query("select * from lichsutien where idu=$_GET[idkhach] order by time desc");
            $sotin=@mysql_num_rows($tin);
            if($sotin==0){
                echo '<br /><p class="thongbaotrong"><i class="fas fa-exclamation-triangle"></i> Chưa có giao dịch nào được ghi nhận</p><br />';
            }else{
                while($rtin=@mysql_fetch_assoc($tin)){
                    ?>
                    <div class="listtin">
                    <div class="anh"><?=number_format($rtin['tien'],0,',','.')?><sup>đ</sup></div>
                    <div class="thongtin">
                        <p><?=$rtin['noidung']?></p>
                        <p style="font-size: 0.9em;line-height: 20px;font-style: italic;"><i class="far fa-clock"></i> <?=retime($rtin['time'])?></p>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    <?
                }
    }
    ?>
    </div>
    <?}?>
    <div class="clearfix"></div>
</div>
     