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
                height: 80px;
                background-image: url('images/xacnhan.jpg');
                background-size: cover;
                background-position: center;
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
</style>
<div class="bigmem cpanel">
<?if(isset($_GET['id'])){
    $idtin=intval($_GET['id']);$tin=@mysql_fetch_assoc(@mysql_query("select * from tin where id=$idtin"));
    $chutin=@mysql_fetch_assoc(@mysql_query("select * from user where id=$tin[idu]"));
    ?>
<h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Bảng điều khiển</a> </h3>
    <div class="contag dr">
        <img src="i/nguon.jpg" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Chi tiết tin</b></p>
            <p></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Chi tiết</a></h3>
    <h4><?=$tin['tieude']?></h4>
    <p>Khách hàng: <b><?=$chutin['fullname']?></b> - <?=$chutin['phone']?> </p>
    <p>Loại tin: <?=$tin['loaitin']?></p>
    <p>Chủng loại: <?=$tin['chungloai']?></p>
    <?
                    $rtinh=@mysql_fetch_assoc(@mysql_query("select loai,ten from tinh where id=$tin[tinh]"));
                    $rhuyen=@mysql_fetch_assoc(@mysql_query("select loai,ten from huyen where id=$tin[huyen]"));
                    $rxa=@mysql_fetch_assoc(@mysql_query("select loai,ten from xa where id=$tin[xa]"));
                    $rduong=@mysql_fetch_assoc(@mysql_query("select loai,ten from duong where id=$tin[duong]"));
                    ?>
    <p>Địa chỉ: <?=$rduong['duong'].', '.$rxa['ten'].', '.$rhuyen['ten'].', '.$rtinh['ten']?></p>
    <p>Diện tích: <?=$tin['dientich']?>m<sup>2</sup></p>
    <p>Dài: <?=$tin['dai']?>m</p>
    <p>Rộng: <?=$tin['rong']?>m</p>
    <p>Hướng: <?=$tin['huong']?></p>
    <p>Giá bán: <?=$tin['gia']?> <sup>đ</sup></p>
    <p>Pháp lý: <?=$tin['phaply']?></p>
    <p>Đường vào: <?=$tin['matduong']?>m</p>
    <p>Ảnh:</p>
    <?
    $anh=explode("***",$tin['anh']);
    for($i=0;$i<count($anh);$i++){
        if(trim($anh[$i])!=''){
    ?>
    <img style="width: 24%;" src="upload/tin/<?=$anh[$i]?>" />
    <?}}?>
    <div class="noidungtin"><textarea style="width: 100%; height: 400px;"><?=$tin['noidung']?></textarea></div>
    </div>
<?}else{?>
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Bảng điều khiển</a> </h3>
    <div class="contag dr">
        <img src="i/nguon.jpg" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Danh sách tin đăng</b></p>
            <p><a href="">Hướng dẫn xử lý đăng tin cho khách</a></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Danh sách chung</a></h3>
    <?
    $tin=@mysql_query("select * from tin where idnhanvien=$u[id] order by ((time_yeucau + 2*time_xuly + 3*time_hoanthanh) - trangthai*1000000) desc");
            $sotin=@mysql_num_rows($tin);
            if($sotin==0){
                echo '<p class="thongbaotrong"><i class="fas fa-exclamation-triangle"></i> Chưa có tin khách yêu cầu</p>';
            }else{
                while($rtin=@mysql_fetch_assoc($tin)){
                    $kh=@mysql_fetch_assoc(@mysql_query("select * from user where id=$rtin[idu]"));
                    $trutien=$rtin['trutien'];
                    if($trutien==0 and $kh['tien']>=86000){
                        $uptien=@mysql_query("update user set tien=tien-86000 where id=$rtin[idu]");
                        $uptin=@mysql_query("update tin set trutien=1 where id=$rtin[id]");
                        $inls=@mysql_query("insert into lichsutien (idu,tien,loai,time)value($rtin[idu],86000,'trutien',$time)");
                        $trutien=1;
                    }
                    $ttkh=1;
                    if($kh['fullname']=='' or $kh['email']=='' or $kh['ngaysinh']=='' or $kh['gioitinh']=='' or $kh['tinh']==0 or $kh['huyen']==0 or $kh['xa']==0 or $kh['diachi']==''){
                        $ttkh=0;
                    }
                    $timtk=@mysql_query("select * from taikhoan where idu=$rtin[idu]");
                    $sotk=@mysql_num_rows($timtk);
                    $dieukien=1;
                    if($trutien==0 or $ttkh==0 or $sotk<20){
                        $dieukien=0;
                    }
                    $anhdaidien='';
                    $anh=explode("***",$rtin['anh']);
                    for($is=0;$is<count($anh);$is++){
                        if($anh[$is]!=''){$anhdaidien=$anh[$is]; break;}
                    }
                    ?>
                    <div class="listtin">
                    <div class="anh" style="background-image: url(upload/tin/<?=$anhdaidien?>);"></div>
                    <div class="thongtin">
                        <h4><?if($rtin['tieude']==''){echo 'Khởi tạo yêu cầu '.retime($rtin['time_yeucau']);}else{echo $rtin['tieude'];}?></h4>
                        <?if($rtin['tieude']==''){?>
                        <p>
                        <a type="button" class="btn btn-default" <?if($dieukien==0){?>onclick="alert('Hãy cập nhật đầy đủ 3 trường phía dưới thành nút xanh: Tài chính, thông tin, tài khoản')"<?}else{?>href="/m/taotin/?idtin=<?=$rtin['id']?>"<?}?>>Tạo tin</a> 
                        <a type="button" class="btn btn-default" <?if($rtin['tieude']==''){?>onclick="alert('Hãy tạo tin trước khi đăng sàn')"<?}?>>Đăng sàn</a>
                        </p>
                        <?}?>
                        <p style="border: 1px solid #d1d1d1;padding: 4px 10px;font-size: 0.9em;line-height: 23px;font-style: italic;">Khách hàng: <b><?=$kh['fullname']?></b><br />
                        SĐT/Zalo: <?=$kh['phone']?><br />
                        Số dư: <b><?=number_format($kh['tien'],0,',','.')?><sup>đ</sup></b><br />
                        <?if($kh['uid']!=''){?>
                        <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="fb://profile/<?=$kh['uid']?>">Tường</a> 
                        <a type="button" class="btn btn-default btn-xs hidden-sm hidden-xs" onclick="location.href='https://www.facebook.com/<?=$kh['uid']?>'">Tường</a> 
                        <?}?>
                        
                        <?if($kh['uid']!=''){?>
                        <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="https://fb.com/msg/<?=$kh['uid']?>">Messenger</a> 
                        <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" href="https://www.facebook.com/messages/t/<?=$kh['uid']?>">Messenger</a> 
                        <?}?>
                        <?if($kh['phone']!=''){?><a type="button" class="btn btn-default btn-xs" href="https://zalo.me/<?=$kh['phone']?>">Zalo</a><?}?>
                        <?if($kh['phone']!=''){?>
                        <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="tel:<?=$kh['phone']?>">Gọi</a>
                        <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?=$kh['phone']?>');">Gọi</a>
                        <?}?>
                        <?if($kh['phone']!=''){?>
                        <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="sms:<?=$kh['phone']?>">SMS</a>
                        <a type="button" class="btn btn-default btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?=$kh['phone']?>');">SMS</a>
                        <?}?>
                    </p>
                        <a type="button" <?if($trutien==0){echo 'style="background: #d70303;border-color: red;"';}?> class="btn btn-success btn-xs" href="m/taichinhkhachhang/?idkhach=<?=$rtin['idu']?>">Tài chính</a>
                        <a type="button" <?if($ttkh==0){echo 'style="background: #d70303;border-color: red;"';}?> class="btn btn-success btn-xs" href="m/thongtinkhachhang/?idkhach=<?=$rtin['idu']?>">Thông tin</a>
                        <a type="button" <?if($sotk<20){echo 'style="background: #d70303;border-color: red;"';}?> class="btn btn-success btn-xs" href="m/danhsachtaikhoan/?idkhach=<?=$rtin['idu']?>">Tài khoản</a>
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
     