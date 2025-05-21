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
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr" style="position: relative;">
        <div class="avatar"></div>
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Tài chính: <?php echo $u['fullname']?></b></p>
            <p style="color: #555; font-size: 0.85em;line-height: 20px;"><i class="fab fa-magento"></i> Ví mua <b style="color: red;"><?php echo number_format($sodu,0,',','.')?><sup>đ</sup></b></p>
            <p style="color: #555; font-size: 0.85em;line-height: 20px;">
            <i class="fas fa-hand-holding-usd"></i> Ví rút <b style="color: red;"><?php echo number_format($u['virut'],0,',','.')?><sup>đ</sup></b> &nbsp;&nbsp;&nbsp; 
            <?php
            if($u['id']!=1){
                if($sodu_rut==0){
                    ?>
                    <a type="button" class="btn btn-xs btn-default" id="ruttien01">Rút tiền</a>
                    <script>
                    $('#ruttien01').click(function(){
                        var te='<h4 style="color: red;padding-bottom: 15px;text-align:center"><i class="fas fa-exclamation-triangle"></i> Thông báo</h4><p style="text-align:center">Tài khoản của bạn không có số dư để rút tiền</p>';
                        shownote(te);
                    })
                    </script>
                    <?php
                }elseif($sodu_rut>0 and $sodu_rut<=$r['ruttoithieu']){
                    ?>
                    <a type="button" class="btn btn-xs btn-default" id="ruttien01">Rút tiền</a>
                    <script>
                    $('#ruttien01').click(function(){
                        var te='<h4 style="color: red;padding-bottom: 15px;text-align:center"><i class="fas fa-exclamation-triangle"></i> Thông báo</h4><p style="text-align:center">Số dư tối thiểu để rút tiền là <?php echo number_format($r['ruttoithieu'],0,',','.');?>đ.</p>';
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
                }elseif($sodu_rut>0){
                    ?>
                    <a type="button" class="btn btn-xs btn-primary" href="/m/taichinh/<?php echo md5($ngay)?>">Rút tiền</a> <a type="button" class="btn btn-xs btn-info" href="/m/taichinh/?chuyen">Chuyển</a>
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
</style>
    <?php if(isset($_GET['m']) and addslashes($_GET['m'])==md5($ngay)){
        if($u['passtien']==''){
            ?>
            <script>//window.location="/m/account/matkhau?mk=ruttien";</script>
            <?php
        }
        if($u['bank']==0 or $u['banknumber']==0){
            ?>
            <script>window.location="/m/account/thanhtoan";</script>
            <?php 
        }
        ?>
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-circle-left"></i> Home </a>/ <a href="/m/taichinh/" style="color: #333;"> Tài chính </a>/ Rút tiền</h3>
<div class="boxshow">
    <div class="statistic-col">
    <div class="statistic-title">
    <img src="images/withdraw.png">
    <h4>Rút tiền về tài khoản</h4>
    </div>
    <div class="statistic-content">
    <form role="form">
    <div id="formguityeucau">
    <p>Số dư hiện tại: <b><?php echo number_format($u['virut'],0,',','.')?><sup>đ</sup></b>
    <label style="float: right;font-weight: normal;margin-top: -2px;">
    <input type="checkbox" value="1" id="fullmoney" /> Rút hết
    </label>
    </p>
      <div class="form-group" id="showsotienrut">
        <label for="exampleInputEmail1">Số tiền rút</label>
        <input type="number" class="form-control" max="<?php echo $u['virut']?>" id="sotienrut" placeholder="Nhập số tiền cần rút">
      </div>
      <p>Phí dịch vụ (<?php echo $ru['pt_ruttien']?>%): <span id="phidichvu">0 ₫</span></p>
      <p>Số tiền thực nhận: <b style="color: red;" id="tienthucnhan">0 ₫</b></p>
      <p>Thông tin tài khoản nhận: </p>
      <?php $bankk=@mysqli_fetch_assoc(@mysqli_query($con,"select * from bankbase where id=$u[bank]"));?>
      <p>&nbsp;&nbsp;&nbsp;- NH: <?php echo $bankk['ten']?></p>
      <p>&nbsp;&nbsp;&nbsp;- STK: <?php echo $u['banknumber']?></p>
      <p>&nbsp;&nbsp;&nbsp;- CTK: <?php echo $u['fullname']?></p>
      <!--div class="form-group" id="showmkruttien">
        <label>Mật khẩu rút tiền</label>
        <input type="password" class="form-control" id="matkhauruttien" placeholder="Password">
      </div-->
      <input type="hidden" class="form-control" id="matkhauruttien" value="12345" placeholder="Password">
      </div>
      <div id="formmaemail">
      <!--div class="thongbaoemail">
      <?php
      $emailgui=explode('@',$u['email']);
      $phantruoc=$emailgui[0];
      $length_01 = strlen($phantruoc);
      $cat1=substr($phantruoc,2,$length_01-4);
      $tomail=str_replace($cat1,'**********',$u['email']);
      ?>
        <p>Một mã xác nhận đã được gửi tới email <?php echo $tomail?></p>
      </div-->
      <div class="form-group text-center" id="showmaemail">
        <label>Xác nhận rút số tiền: <b id="xnrt">0đ</b></label>
        <input type="hidden" class="form-control" id="maruttien" value="123456" placeholder="Mã rút tiền nhận từ email"/>
      </div>
      <p class="text-center" id="showback" style="display: none;"><a type="button" class="btn btn-default" href="/m/cpanel/">Trở lại trang chủ</a></p>
      </div>
      <button type="button" class="btn btn-primary" id="yeucaurutien">Yêu cầu rút tiền</button>
      <p class="text-center"><button type="button" class="btn btn-primary" id="xacnhanrutien">Xác nhận rút tiền</button></p>
      <span id="loadingajax">Vui lòng chờ ... <img src="images/ajax-loader.gif" /></span>
</form>
<script language="javascript">
    var sodu = <?php echo $u['virut']?>;
    const VND = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
    });
            document.getElementById('fullmoney').onclick = function(e){
                if (this.checked){
                    $('#sotienrut').val(sodu);
                    var phidichvu = sodu*0.0<?php echo $ru['pt_ruttien']?>;
                    $('#phidichvu').html(VND.format(phidichvu));
                    var tienthucnhan = sodu-phidichvu;
                    $('#tienthucnhan').html(VND.format(tienthucnhan));
                    $('#xnrt').html(VND.format(tienthucnhan));
                    $(".thongbaodo").hide();
                }
                else{
                    $('#sotienrut').val(0);
                    $('#phidichvu').html(VND.format(0));
                    $('#tienthucnhan').html(VND.format(0));
                }
            };
    $('#sotienrut').keyup(function(){
        keyuptien();
    });
    function keyuptien(){
        var sotienrut=$('#sotienrut').val();
        if(sotienrut>sodu){
            $(".thongbaodo").hide();
            $("#showsotienrut").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Số dư không đủ</p>');
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            $('#sotienrut').val(sodu);
            var phidichvu = sodu*0.0<?php echo $ru['pt_ruttien']?>;
            $('#phidichvu').html(VND.format(phidichvu));
            var tienthucnhan = sodu-phidichvu;
            $('#tienthucnhan').html(VND.format(tienthucnhan));
            keyuptien();
        }else{
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            var phidichvu = sotienrut*0.0<?php echo $ru['pt_ruttien']?>;
            $('#phidichvu').html(VND.format(phidichvu));
            var tienthucnhan = sotienrut-phidichvu;
            $('#tienthucnhan').html(VND.format(tienthucnhan));
        }
    }
    $('#yeucaurutien').click(function(){
        var sotienrut=$('#sotienrut').val();
        var phidichvu = sodu*0.0<?php echo $ru['pt_ruttien']?>;
        var tienthucnhan = sodu-phidichvu;
        var passruttien = $('#matkhauruttien').val();
        if(sotienrut>sodu){
            keyuptien();
            return false;
        }
        if(sotienrut<100000){
            $("#showsotienrut").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Số tiền tối thiểu cho 1 lần rút là 100.000đ</p>');
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            return false;
        }
        if(passruttien==''){
            $("#showmkruttien").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu rút tiền</p>');
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            $('#matkhauruttien').focus();
            return false;
        }else{
            $('#yeucaurutien').hide();
            $('#loadingajax').show();
            $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             passruttien : passruttien,
                             typeform : "kiemtramatkhauruttien"
                        },
                        success : function (result2){
                            var trave = Number(result2);
                            $('#loadingajax').hide();
                            if(trave==0){
                                $("#showmkruttien").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Mật khẩu rút tiền không đúng</p>');
                                $('#yeucaurutien').show();
                                setTimeout(function(){$(".thongbaodo").hide();}, 5000);
                            }else{
                                $('#xacnhanrutien').show();
                                $('#yeucaurutien').hide();
                                $('#formmaemail').show();
                                $('#formguityeucau').hide();
                            }
                        }
                    });
        }
    })
    $('#xacnhanrutien').click(function(){
        var sotienrut=$('#sotienrut').val();
        var phidichvu = sodu*0.0<?php echo $ru['pt_ruttien']?>;
        var tienthucnhan = sodu-phidichvu;
        var maruttien = $('#maruttien').val();
        if(maruttien==''){
            $("#showmaemail").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mã rút tiền được gửi tới email</p>');
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            $('#maruttien').focus();
            return false;
        }else{
            $('#xacnhanrutien').hide();
            $('#loadingajax').show();
            $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             maruttien : maruttien,
                             sotienrut : sotienrut,
                             typeform : "kiemtramaruttien"
                        },
                        success : function (result2){
                            var trave = Number(result2);
                            $('#loadingajax').hide();
                            if(trave==0){
                                $("#showmaemail").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Mã rút tiền không đúng</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 5000);
                                $('#xacnhanrutien').show();
                            }else if(trave==-1){
                                $("#showmaemail").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Có lỗi, vui lòng làm lại</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 5000);
                                $('#xacnhanrutien').show();
                            }else{
                                $('.thongbaoemail').html('<p style="color: #06a10f;"><i class="far fa-check-circle fa-3x"></i></p><p style="color: #06a10f;">Hoàn thành yêu cầu. Vui lòng đợi thanh toán từ BOC</p>');
                                $('#showback').show();
                                $('#showmaemail').hide();
                                $('#xacnhanrutien').hide();
                            }
                        }
                    });
        }
    })
</script>
</div>
</div>
</div>    
    <?php }elseif(isset($_GET['chuyen'])){?>
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-circle-left"></i> Home </a>/ <a href="/m/taichinh/" style="color: #333;"> Tài chính </a>/ Chuyển tiền</h3>
<div class="boxshow">
    <div class="statistic-col">
    <div class="statistic-title">
    <img src="images/withdraw.png">
    <h4>Chuyển tiền tới ví "mua hàng"</h4>
    </div>
    <div class="statistic-content">
    <form role="form">
    <div id="formguityeucau">
    <p>Số dư hiện tại: <b><?php echo number_format($u['virut'],0,',','.')?><sup>đ</sup></b>
    <label style="float: right;font-weight: normal;margin-top: -2px;">
    <input type="checkbox" value="1" id="fullmoney" /> chuyển hết
    </label>
    </p>
      <div class="form-group" id="showsotienrut">
        <label for="exampleInputEmail1">Số tiền chuyển</label>
        <input type="number" class="form-control" max="<?php echo $u['virut']?>" id="sotienrut" placeholder="Nhập số tiền cần chuyển">
      </div>
      <p>Số tiền chuyển: <b style="color: red;" id="tienthucnhan">0 ₫</b></p>
      <p style="font-size: 0.9em;font-style: italic;">Sau khi chuyển sang ví mua hàng tiền này chỉ có thể sử dụng để mua hàng, không thể rút hoặc chuyển ngược lại "ví rút"</p>
      </div>
      <button type="button" class="btn btn-primary" id="xacnhanchuyen">Xác nhận chuyển tiền</button>
      <span id="loadingajax">Vui lòng chờ ... <img src="images/ajax-loader.gif" /></span>
</form>
<script language="javascript">
    var sodu = <?php echo $u['virut']?>;
    const VND = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
    });
            document.getElementById('fullmoney').onclick = function(e){
                if (this.checked){
                    $('#sotienrut').val(sodu);
                    var tienthucnhan = sodu;
                    $('#tienthucnhan').html(VND.format(tienthucnhan));
                    $('#xnrt').html(VND.format(tienthucnhan));
                    $(".thongbaodo").hide();
                }
                else{
                    $('#sotienrut').val(0);
                    $('#tienthucnhan').html(VND.format(0));
                }
            };
    $('#sotienrut').keyup(function(){
        keyuptien();
    });
    function keyuptien(){
        var sotienrut=$('#sotienrut').val();
        if(sotienrut>sodu){
            $(".thongbaodo").hide();
            $("#showsotienrut").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Số dư không đủ</p>');
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            $('#sotienrut').val(sodu);
            var tienthucnhan = sodu;
            $('#tienthucnhan').html(VND.format(tienthucnhan));
            keyuptien();
        }else{
            setTimeout(function(){$(".thongbaodo").hide();}, 5000);
            var tienthucnhan = sotienrut;
            $('#tienthucnhan').html(VND.format(tienthucnhan));
        }
    }
    
    $('#xacnhanchuyen').click(function(){
        var sotienrut=$('#sotienrut').val();
        $('#xacnhanchuyen').hide();
            $('#loadingajax').show();
            $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             sotienrut : sotienrut,
                             typeform : "chuyentien"
                        },
                        success : function (result2){
                            var trave = Number(result2);
                            $('#loadingajax').hide();
                            if(trave==0){
                                $("#showmaemail").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Có lỗi, vui lòng làm lại</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 5000);
                                $('#xacnhanchuyen').show();
                            }else{
                                $('.thongbaoemail').html('<p style="color: #06a10f;"><i class="far fa-check-circle fa-3x"></i></p><p style="color: #06a10f;">Lệnh chuyển tiền đã được thực hiện</p>');
                                
                                $('#xacnhanchuyen').hide();
                                window.location.href = '/m/taichinh/';
                            }
                        }
                    });
    })
</script>
</div>
</div>
</div>    
    <?php }else{
$today = new DateTime();
        $firstDayOfWeek1 = $today->modify('this week')->modify('monday');
        $firstDayOfWeek2 = $today->modify('this week')->modify('monday');
        $yesterday = $today->modify('-1 day');
        $firstDayOfMonth = $today->modify('first day of this month');
        
        $date = date('Y-m-d-N');
        $newdategoc = strtotime ( '-1 day' , strtotime ( $date ) ) ;
        $dautuan0=  strtotime ( '-'.(date('N')-1).' day' , strtotime ( $date ) ) ;
        $homqua=date ( 'Ymd' , $newdategoc );
        $ngayhomqua=date ( 'd/m/Y' , $newdategoc );
        $thuhomqua = date ( 'N' , $newdategoc );
        $thuhomnay= $today->format('N');
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
            
            <form action="/m/taichinh/" method="GET" id="tututoitoi" style="padding-top:7px">
              <div class="row">
              <div class="col-lg-6 col-xs-6" style="margin-bottom: 2px; padding-right: 2px;">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button style="border: 0;" class="btn btn-default" type="button">Từ</button>
                  </span>
                  <input name="time" type="hidden" value="change" />
                  <input style="border: 0;line-height: 30px;height: 30px;" value="'.$tutu.'" id="tutu" type="date" name="tu" class="form-control"/>
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
            <script>$(document).ready(function() {$("#tutu, #toitoi").change(function() {$("form#tututoitoi").submit();});});</script>
            </form>
            ';
        }
?>
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-circle-left"></i> Home </a>/ Chi tiết tài chính của bạn</h3>
    <p>
            <a class="label label-<?php echo $a_today?>" href="/m/taichinh/?time=today">Hôm nay</a>
            <a class="label label-<?php echo $a_tomorrow?>" href="/m/taichinh/?time=tomorrow">Hôm qua</a>
            <a class="label label-<?php echo $a_week?>" href="/m/taichinh/?time=week">Tuần này</a>
            <a class="label label-<?php echo $a_month?>" href="/m/taichinh/?time=month">Tháng này</a>
            <a class="label label-<?php echo $a_change?>" href="/m/taichinh/?time=change">Tùy chỉnh</a>
    </p>
<?php
echo $showtime;
$timhh=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotien) tong from lichsutien where idu=$u[id] and loai=0 and khoan =1 $themdk order by time desc"));
$timhhhd=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotien) tong from lichsutien where idu=$u[id] and loai=0 and khoan = 2 $themdk order by time desc"));
?>
<form style="display: none;" role="form">
<div class="row">
<div class="col-md-6 col-xs-6" style="padding-right: 5px;">
<div class="input-group">
  <span class="input-group-addon" style="border: 0;">Từ</span>
  <input type="date" class="form-control" style="border: 0;" value="<?php echo date('Y')?>-<?php echo date('m')?>-01">
</div>
</div>
<div class="col-md-6 col-xs-6" style="padding-left: 5px;">
<div class="input-group">
  <span class="input-group-addon" style="border: 0;">Tới</span>
  <input type="date" class="form-control" style="border: 0;width: 125px;" value="<?php echo date('Y')?>-<?php echo date('m')?>-<?php echo date('d')?>">
</div>
</div>
</div>
</form>
<?php
$thg=date('Ym').'00000000';
$timnap=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotien) tong from lichsunap where idu=$u[id] and time > $thg"));
?>
<div class="boxshow">
<p style="text-align: center;
    border: 1px dotted #2196f3;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: -15px;"><i class="fas fa-funnel-dollar"></i> Tiền nạp tháng <?php echo date('m')?>: <b><?php echo number_format($timnap['tong'],0,',','.')?>đ</b></p>
    <div class="statistic-col">
                            <div class="statistic-title">
                                <img src="images/sang-nhuong.svg">
                                <h4>Hoa hồng của bạn</h4>
                            </div>
                            <div class="statistic-content">
                                <div class="statistic-group">
                                    <div class="statistic-group-left">
                                        <img src="images/statistical.svg">
                                    </div>
                                    <div class="statistic-group-right">
                                    <div class="total"><?php echo number_format($timhh['tong'],0,',','.');?><sup>đ</sup></div>
                                        <div class="title">Hoa hồng F1</div>
                                    </div>
                                </div>
                                <div class="statistic-group">
                                    <div class="statistic-group-left">
                                        <img src="images/statistical.svg">
                                    </div>
                                    <div class="statistic-group-right">
                                    <div class="total"><?php echo number_format($timhhhd['tong'],0,',','.');?><sup>đ</sup></div>
                                        <div class="title">Hoa hồng F2</div>
                                    </div>
                                </div>
                                <?php if($u['level']>2){$timhhql=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotien) tong from lichsutien where idu=$u[id] and loai=0 and (khoan >2 and khoan < 7)  $themdk"));?>
                                <div class="statistic-group">
                                    <div class="statistic-group-left">
                                        <img src="images/statistical.svg">
                                    </div>
                                    <div class="statistic-group-right">
                                    <div class="total"><?php echo number_format($timhhql['tong'],0,',','.');?><sup>đ</sup></div>
                                        <div class="title">Hoa hồng Rank</div>
                                    </div>
                                </div>    
                                <?php }?>
                                <?php if($u['docquyentinh']>0 or $u['docquyenhuyen']>0 ){$timhhql=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(sotien) tong from lichsutien where idu=$u[id] and loai=0 and khoan =7  $themdk"));?>
                                <div class="statistic-group">
                                    <div class="statistic-group-left">
                                        <img src="images/statistical.svg">
                                    </div>
                                    <div class="statistic-group-right">
                                    <div class="total"><?php echo number_format($timhhql['tong'],0,',','.');?><sup>đ</sup></div>
                                        <div class="title">Hoa hồng độc quyền</div>
                                    </div>
                                </div>    
                                <?php }?>
                            </div>
    </div>
    <div class="statistic-col">
                            <div class="statistic-title" style="margin-bottom: 30px;">
                                <img src="images/cho-thue.svg">
                                <h4>Lịch sử nhận tiền</h4>
                            </div>
                            <div class="boxlichsu">
                            <?php 
                            $ls=@mysqli_query($con,"select * from lichsutien where idu=$u[id] $themdk order by time desc");
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
    <div class="statistic-col">
                            <div class="statistic-title" style="margin-bottom: 30px;">
                                <img src="images/cho-thue.svg">
                                <h4>Lịch sử nạp tiền</h4>
                            </div>
                            <div class="boxlichsu">
                            <?php 
                            $ls=@mysqli_query($con,"select * from lichsunap where idu=$u[id] $themdk order by time desc");
                            if(@mysqli_num_rows($ls)==0){
                            ?>
                            <p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png"></p><p class="text-center">Chưa có lịch sử nào được ghi nhận</p><p>&nbsp;</p>
                            <?php    
                            }else{
                            while($rls=@mysqli_fetch_assoc($ls)){
                            ?>
                            <div style="border-bottom: 1px solid #eeeeee;">
                            <p style="margin-top: 20px;margin-bottom: 5px;font-size: 0.9em;"><i class="fas fa-share"></i> <?php echo retimefull($rls['time']);?>
                            - Số tiền: <b style="color: red;"><?php echo number_format($rls['sotien'],0,',','.');?><sup>đ</sup></b></p>  
                            </div>   
                            <?php }}?>
                            </div>
    </div>
</div>
<?php }?>
    </div>
    <div class="clearfix"></div>
</div>
     