<style>
.avatar{
    width: 75px;
    height: 75px;
    display: block;
    margin: 10px auto;
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
</style>
        <div class="bigmem">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag">
                <div class="avatar" id="avatar" onclick="document.getElementById('main_picture1').click();" style="">
                <span><i class="fas fa-sync-alt"></i></span>
                </div>
                <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            //$('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            $("#avatar").css("background-image", "url("+e.target.result+")");
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadavatar('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
                });
        function uploadavatar(idfile) {
        //Lấy ra files
        var file_data = $('#'+idfile).prop('files')[0];
        //lấy ra kiểu file
        var type = file_data.type;
        //Xét kiểu file được upload
        var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];
        //kiểm tra kiểu file
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3]) {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            //sử dụng ajax post
            $.ajax({
                url: 'uploads_avatar.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    var inp = idfile.replace('main_','data_');
                    $('#'+inp).val(res);
                }
            });
        } else {
            $('.status').text('Chỉ được upload file ảnh');
        }
        return false;
    };
                </script>
                <p style="padding-top: 10px;"><b><?php echo $u['fullname']?></b></p>
                <p>Tham gia: <i><?php echo retime($u['time'])?></i></p>
                <p>Tải khoản: <b><i><?php echo capbac($u['level']);?></i></b></p>
                <p>
                <a type="button" class="btn-<?php if(!isset($_GET['m'])){echo 'primary';}else{echo 'default';}?> btn btn-xs" href="/m/account/">Thông tin</a> 
                <a type="button" class="btn-<?php if(isset($_GET['m']) and $_GET['m']=='tiktok'){echo 'primary';}else{echo 'default';}?> btn btn-xs" href="/m/account/tiktok">ID Tiktok</a> 
                <a type="button" class="btn-<?php if(isset($_GET['m']) and $_GET['m']=='thanhtoan'){echo 'primary';}else{echo 'default';}?> btn btn-xs" href="/m/account/thanhtoan">Thanh toán</a> 
                <a type="button" class="btn-<?php if(isset($_GET['m']) and $_GET['m']=='matkhau'){echo 'primary';}else{echo 'default';}?> btn btn-xs" href="/m/account/matkhau">Mật khẩu</a> 
                </p>
                <hr />
                <?php if(!isset($_GET['m'])){?>
                <div class="acsmall">
                
                <p id="thanhcongroi" style="color: #008040; display: none;text-align: center;"><i class="fas fa-check"></i> Cập nhật thành công</p>
                <p id="tinhhuyen" style="color: red; text-align: center; margin-bottom: 15px;<?php if(!isset($_GET['yeucaucapnhat'])){echo 'display: none;';}?>"><i class="fas fa-exclamation-triangle"></i> Bạn cần cập nhật thông tin Tỉnh, Huyện nơi bạn đang ở để tiếp tục sử dụng phần mềm</p>
                <p style="font-weight: 600;"><i class="fas fa-user-shield"></i> Thông tin cá nhân</p>
                    <form class="" role="form">
                  <div class="form-group">
                    <input type="text" class="form-control" id="hoten" placeholder="Họ tên" value="<?php echo $u['fullname']?>">
                  </div>
                  <div class="form-group">
                    <input class="form-control" class="form-control" type="number" readonly="" id="phone" placeholder="Số điện thoại (*)" value="<?php echo $u['phone']?>" />
                  </div>
                  <div class="form-group">
                    <input class="form-control" class="form-control" type="email" id="email" placeholder="Email liên hệ(*)" value="<?php echo $u['email']?>" />
                  </div>
                  <div class="form-group">
                    <input class="form-control" class="form-control" type="text" id="facebook" placeholder="UID hoặc link bài viết facebook bất kỳ" value="<?php echo $u['facebook']?>" />
                  </div>
            <p>Giới tính: 
                <label class="radio-inline">
                  <input type="radio" name="gioitinh" <?php if($u['gioitinh']=='nam'){echo 'checked=""';}?> id="inlineRadio1" value="nam"/> Nam
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gioitinh" <?php if($u['gioitinh']=='nu'){echo 'checked=""';}?> id="inlineRadio2" value="nu"/> Nữ
                </label>
            </p>
            
            <div class="input-group" style="width: 100%;">
                <input class="form-control date" style="width: 100%;margin: 0;background: white;" type="date" id="ngaysinh" value="<?php echo $u['ngaysinh']?>" placeholder="Ngày sinh (*)" />
                <span class="input-group-addon" style="background: white;width: 90px;">Ngày sinh</span>
            </div>
            <div id="showngaysinh"></div>
            <div class="input-group" style="margin-top: 15px; margin-bottom: 12px;width: 100%;" id="stinh">
            <select class="form-control" style="width: 100%;" id="tinh">
            <option value="0" <?php if($rtinh['id']==$u['tinh']){echo 'selected=""';}?>>-- Chọn tỉnh --</option>
            <?php
            $tinh=@mysqli_query($con,"select * from tinh order by ten2 asc");
            while($rtinh=@mysqli_fetch_assoc($tinh)){
            ?>
              <option value="<?php echo $rtinh['id']?>" <?php if($rtinh['id']==$u['tinh']){echo 'selected=""';}?>><?php echo $rtinh['ten']?></option>
            <?php }?>
            </select>
            <span class="input-group-addon" style="background: white;width: 90px;"> &nbsp;Tỉnh <sup style="color: red;">(*)</sup>&nbsp; </span>
            </div>
            <div class="input-group" style="margin-top: 15px; margin-bottom: 12px;width: 100%;" id="shuyen">
            <select class="form-control" style="width: 100%;" id="huyen">
            <option value="0" <?php if($rtinh['id']==$u['huyen']){echo 'selected=""';}?>>-- Chọn huyện --</option>
            <?php
            $huyen=@mysqli_query($con,"select * from huyen where tinh_id=$u[tinh] order by ten asc");
            while($rhuyen=@mysqli_fetch_assoc($huyen)){
            ?>
              <option value="<?php echo $rhuyen['id']?>" <?php if($rhuyen['id']==$u['huyen']){echo 'selected=""';}?>><?php echo $rhuyen['loai'].' '.$rhuyen['ten'];?></option>
            <?php }?>
            </select>
            <span class="input-group-addon" style="background: white;width: 90px;"> &nbsp;Huyện <sup style="color: red;">(*)</sup>&nbsp; </span>
            </div>
           
                  <button type="button" class="btn btn-success" id="capnhatchung">Cập nhật</button>
                  <span id="loadingchung" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                </form>
                <script language="javascript">
                $('#tinh').change(function(){
        var tinh=$('#tinh').val();
        $.ajax({
            url : "./ajax.php", 
            type : "post",
            dateType:"text",
            data : { 
                typeform : 'loadhuyen',
                tinh : tinh
                },
            success : function (data5){
                $('#huyen').html(data5);
            }
        });
    });
                function checkEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
                $('#capnhatchung').click(function(){
                    var ten =$("#hoten").val();
                    var ngaysinh =$("#ngaysinh").val();
                    var tinh =$("#tinh").val();
                    var email =$("#email").val(); 
                    var facebook =$("#facebook").val();
                    var gioitinh = 0;
                    var checkboxgt = document.getElementsByName("gioitinh");
                    for (var i = 0; i < checkboxgt.length; i++){if (checkboxgt[i].checked === true){gioitinh=checkboxgt[i].value;}}
                    var tinh = $('#tinh').val();
                    var huyen = $('#huyen').val();
                    if(ten == ''){
                        $("#hoten").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập tên của bạn</p>');
                        $("#hoten").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 6000);
                        return false;
                    }else if(email==''){
                        $("#email").focus();
                        $("#email").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập email liên hệ của bạn</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 6000);
                        return false;
                    }else if(checkEmail(email)==false){
                        $("#email").focus();
                        $("#email").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Email không đúng định dạng</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 6000);
                        return false;
                    }else if(tinh == 0){
                        $("#stinh").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Bạn đang ở Tỉnh/TP nào?</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 6000);
                        return false;
                    }else if(huyen == 0){
                        $("#shuyen").after('<p class="thongbaodo" style="margin-top: -15px;"><i class="fas fa-exclamation-triangle"></i> Bạn đang ở Quận/Huyện nào?</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 60000);
                        return false;
                    }else{
                        
                    $('#loadingchung').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             fullname : ten,
                             ngaysinh : ngaysinh,
                             gioitinh : gioitinh,
                             email : email,
                             tinh : tinh,
                             huyen : huyen,
                             facebook : facebook,
                             typeform : "capnhataccountchung"
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            $('#thanhcongroi').show();
                            $('#tinhhuyen').hide();
                            setTimeout(function(){$(".thongbaodo").hide();}, 60000);
                            setTimeout(function(){
                                $('#thanhcongroi').hide();
                            }, 7000);
                             $('#loadingchung').hide();
                        }
                    });
                    }
                });
                </script>
                </div>
                <hr />
                <?php }?>
                <?php if(isset($_GET['m']) and $_GET['m']=='thanhtoan'){?>
                <div class="acsmall">
                <p style="font-weight: 600;"><i class="fas fa-money-check-alt"></i> Thông tin thanh toán</p>
                <form class="" role="form">
                    <div class="input-group" style="margin-top: 15px; margin-bottom: 12px;" id="baobank">
                    <span class="input-group-addon" style="background: white;"> &nbsp;Ngân hàng&nbsp; </span>
                    <select class="form-control"style="width: 100%;" id="bank">
                       <option value="0">Lựa chọn...</option>
                    <?php
                    $bank=@mysqli_query($con,"select * from bankbase order by id asc");
                    while($rbank=@mysqli_fetch_assoc($bank)){
                    ?>
                      <option value="<?php echo $rbank['id']?>" <?php if($rbank['id']==$u['bank']){echo 'selected=""';}?>><?php echo $rbank['ten']?> (<?php echo $rbank['viettat']?>)</option>
                    <?php }?>
                    </select>
                    
                    </div>
                  <div class="input-group" style="margin-top: 15px; margin-bottom: 12px;">
                    <span class="input-group-addon" style="background: white;">Chủ tài khoản</span>
                    <input type="text" class="form-control" id="hoten" readonly="" placeholder="Họ tên" value="<?php echo $u['fullname']?>">
                  </div>
                  <div class="input-group" style="margin-top: 15px; margin-bottom: 12px;" id="baostk">
                  <span class="input-group-addon" style="background: white;"> &nbsp;Số tài khoản&nbsp; </span>
                    <input class="form-control" class="form-control" type="number" id="sotaikhoan" placeholder="Số tài khoản (*)" value="<?php echo $u['banknumber']?>" />
                  </div>
                  
                  <button type="button" class="btn btn-success" id="capnhatbank">Cập nhật</button>
                  <span id="loadingchung2" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                </form>
                <script language="javascript">
                $('#capnhatbank').click(function(){
                    var bank =$("#bank").val();
                    var sotaikhoan =$("#sotaikhoan").val();
                    if(bank == 0){
                        $("#baobank").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy chọn tên ngân hàng của bạn</p>');
                        $("#bank").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(sotaikhoan==0 || sotaikhoan==''){
                        $("#sotaikhoan").focus();
                        $("#baostk").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số tài khoản của bạn</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else{
                    $('#loadingchung2').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             bank : bank,
                             banknumber : sotaikhoan,
                             typeform : "capnhatbank"
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            $('#droplive').fadeIn();
                            $('.contentnote').html(trave[1]);
                            $('.popupnote').show();
                            setTimeout(function(){
                                $('.contentnote').html('');
                                $('.popupnote').fadeOut();
                                $('#droplive').fadeOut();
                            }, 3000);
                             $('#loadingchung2').hide();
                        }
                    });
                    }
                });
                </script>
                </div>
                <hr />
                <?php }?>
                <?php if(isset($_GET['m']) and $_GET['m']=='tiktok'){?>
                <?php //if($u['vip']>0 or $u['ctv']==1){?>
                <?php if($u['ctv']==0){?>
                <style>
                .formlink .input-group {margin-bottom: 10px;}
                .formlink .input-group-addon:first-child {
                    background: none;
                    padding-right: 0;
                    border-right: 0;color: darksalmon;
                }
                .formlink .input-group-addon:last-child {
                    width: 70px;
                    border-left: 0;
                    cursor: pointer;
                }
                .formlink .input-group-addon.red{
                    background: red;
                    color: white;
                }
                .formlink .input-group-addon.ok{
                    background: #4caf50;
                    color: white;
                }
                .formlink input.form-control{
                    background: no-repeat;
                    border-left: 0;
                    padding-left: 0;
                }
                .showid{position: relative;}
.input-group .tooltip{
  position: absolute;
    /* font-size: 17px; */
    font-weight: 500;
    color: #07af0c;
    top: 5px;
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
    right: 72px;
}
.input-group .tooltip.show{
  opacity: 1;
  pointer-events: auto;
  padding-left: 5px;
  background: white;
  z-index: 5;
}
                </style>
                <div class="acsmall">
                <p style="font-weight: 600;"><i class="fas fa-link"></i> ID Tiktok của bạn</p>
                <?php
                $tktt=@mysqli_query($con,"select * from kenhtiktok where idu=$u[id]");
                if(@mysqli_num_rows($tktt)==0){
                    echo '<div class="boxlichsu"><p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png"></p><p class="text-center">Bạn chưa thêm tài khoản nào</p><p>&nbsp;</p> </div>';
                }else{
                    $i=1;
                    while($rtk=@mysqli_fetch_assoc($tktt)){
                ?>
                    <p><?php echo $i;?>. @<?php echo $rtk['idtiktok']?> <span style="float: right;font-size: 0.9em;"><i class="fas fa-shopping-basket"></i> Số đơn: <b><?php echo $rtk['sodon']?></b></span></p>
                <?php $i++;}}?> 
                  <form class="formlink" role="form">  
                  <div class="input-group" style="position: relative;">
                    <span class="input-group-addon">https://www.tiktok.com/@</span>
                    <input type="text" id="idtiktok" class="form-control" value=""/>
                    <span class="input-group-addon btn-primary" id="themtaikhoan">Thêm</span>
                  </div>
                  </form>
                  <script language="javascript">
                
                $('#themtaikhoan').click(function(){
                    var idtiktok=$("#idtiktok").val();
                    if(idtiktok == ''){
                        $(".formlink").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập ID Tài khoản Tiktok của bạn</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 5000);
                        return false;
                    }else{
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             idtiktok : idtiktok,
                             typeform : "themtiktok"
                        },
                        success : function (result2){
                            if(Number(result2)==1){
                                $(".formlink").after('<p class="" style="color: #4caf50;padding-top: 20px;"><i class="fas fa-exclamation-triangle"></i> Cập nhật thành công</p>');
                                setTimeout(function(){
                                    window.location="/m/account/tiktok";
                                }, 0);
                            }else {
                                $(".formlink").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Tài khoản đã tồn tại</p>');
                                $("#idtiktok").val('');
                                $("#idtiktok").focus();
                            }
                             
                        }
                    });
                    }
                });
               
                </script>
                 
                </div>
                
                <hr /> 
                <?php }else{?>
                <p style="color: red; padding: 25px 10%;">Rất tiếc, tài khoản của bạn chưa kích hoạt nên chưa có link giới thiệu</p>
                <img src="i/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                
                <p style="padding: 25px 10%;">Hãy mua tích lũy đủ 50 điểm để kích hoạt tài khoản</p>
                <p><a type="button" class="btn btn-info" href="/san-pham.html">Chọn mua sản phẩm <i class="fas fa-long-arrow-alt-right"></i></a></p> 
                <?php }?>
                <?php }?>
                <?php if(isset($_GET['m']) and $_GET['m']=='matkhau'){?>
                <div class="acsmall">
                <p style="font-weight: 600;"><i class="fas fa-lock"></i> Đổi mật khẩu</p>
                <p><a type="button" class="btn btn-<?php if(!isset($_GET['mk'])){echo 'info';}else{echo 'default';}?> btn-xs" href="/m/account/matkhau">Mật khẩu đăng nhập</a> <a type="button" class="btn btn-<?php if(isset($_GET['mk'])){echo 'info';}else{echo 'default';}?> btn-xs" href="/m/account/matkhau?mk=ruttien">Mật khẩu rút tiền</a></p>
                <?php if(!isset($_GET['mk'])){?>
                <form class="formpass" role="form">
                  <div class="form-group">
                    <input type="password" class="form-control" id="pass" placeholder="Mật khẩu cũ">
                  </div>
                
                  <div class="form-group">
                    <input type="password" class="form-control" id="newpass" placeholder="Mật khẩu mới">
                  </div>
                
                 <div class="form-group">
                    <input type="password" class="form-control" id="renewpass" placeholder="Nhập lại mật khẩu mới">
                  </div>
                  <button type="button" id="capnhatpass" class="btn btn-success">Cập nhật</button> 
                  <span id="loadingpass" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                </form>
                <script language="javascript">
                $('#capnhatpass').click(function(){
                    var pass =$("#pass").val();
                    var newpass =$("#newpass").val();
                    var renewpass =$("#renewpass").val();
                    if(pass == ''){
                        $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu cũ của bạn</p>');
                        $("#pass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(newpass==''){
                        $("#newpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu mới của bạn</p>');
                        $("#newpass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(renewpass==''){
                        $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu mới của bạn</p>');
                        $("#renewpass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(newpass!=renewpass){
                        $("#renewpass").focus();
                        $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else{
                    $('#loadingpass').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             pass : pass,
                             newpass : newpass,
                             typeform : "capnhatmatkhau"
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            if(Number(trave[0])==1){
                                $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu cũ không đúng</p>');
                                $("#pass").focus();
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else if(Number(trave[0])==2){
                                $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Cập nhật không thành công</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else{
                                $('#droplive').fadeIn();
                                $('.contentnote').html(trave[1]);
                                $('.popupnote').show();
                                setTimeout(function(){
                                    $('.contentnote').html('');
                                    $('.popupnote').fadeOut();
                                    $('#droplive').fadeOut();
                                }, 3000);
                            }
                             $('#loadingpass').hide();
                        }
                    });
                    }
                });
                </script>
                <?php }if(isset($_GET['mk'])){
                    if($u['passtien']!=''){
                    ?>
                <form class="formpass" role="form">
                  <div class="form-group">
                    <input type="password" class="form-control" id="pass" placeholder="Mật khẩu rút tiền cũ">
                  </div>
                
                  <div class="form-group">
                    <input type="password" class="form-control" id="newpass" placeholder="Mật khẩu rút tiền mới">
                  </div>
                
                 <div class="form-group">
                    <input type="password" class="form-control" id="renewpass" placeholder="Nhập lại mật khẩu mới">
                  </div>
                  <button type="button" id="capnhatpass" class="btn btn-success">Cập nhật</button> 
                  <span id="loadingpass" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                </form>
                <script language="javascript">
                $('#capnhatpass').click(function(){
                    var pass =$("#pass").val();
                    var newpass =$("#newpass").val();
                    var renewpass =$("#renewpass").val();
                    if(pass == ''){
                        $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu rút tiền cũ của bạn</p>');
                        $("#pass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(newpass==''){
                        $("#newpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu mới của bạn</p>');
                        $("#newpass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(renewpass==''){
                        $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu mới của bạn</p>');
                        $("#renewpass").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(newpass!=renewpass){
                        $("#renewpass").focus();
                        $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else{
                    $('#loadingpass').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             pass : pass,
                             newpass : newpass,
                             typeform : "capnhatmatkhauruttien"
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            if(Number(trave[0])==1){
                                $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu cũ không đúng</p>');
                                $("#pass").focus();
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else if(Number(trave[0])==2){
                                $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Cập nhật không thành công</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else{
                                $('#droplive').fadeIn();
                                $('.contentnote').html(trave[1]);
                                $('.popupnote').show();
                                setTimeout(function(){
                                    $('.contentnote').html('');
                                    $('.popupnote').fadeOut();
                                    $('#droplive').fadeOut();
                                }, 3000);
                            }
                             $('#loadingpass').hide();
                        }
                    });
                    }
                });
                </script>
                <?php }else{?>
                <form class="formpass" role="form">
                  <div class="form-group">
                    <input type="password" class="form-control" id="passtien" placeholder="Mật khẩu rút tiền">
                  </div>
                
                 <div class="form-group">
                    <input type="password" class="form-control" id="renewpasstien" placeholder="Nhập lại mật khẩu ">
                  </div>
                  <button type="button" id="taopasstien" class="btn btn-success">Tạo mật khẩu</button> 
                  <span id="loadingpasstienmoi" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>
                </form>
                <script language="javascript">
                $('#taopasstien').click(function(){
                    var passtien =$("#passtien").val();
                    var renewpasstien =$("#renewpasstien").val();
                    if(passtien == ''){
                        $("#passtien").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu rút tiền của bạn</p>');
                        $("#passtien").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(renewpasstien==''){
                        $("#renewpasstien").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu của bạn</p>');
                        $("#renewpasstien").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else if(passtien!=renewpasstien){
                        $("#renewpasstien").focus();
                        $("#renewpasstien").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không đúng</p>');
                        setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                        return false;
                    }else{
                    $('#loadingpasstienmoi').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             passtien : passtien,
                             typeform : "taomatkhauruttien" 
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            if(Number(trave[0])==1){
                                $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu cũ không đúng</p>');
                                $("#pass").focus();
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else if(Number(trave[0])==2){
                                $("#renewpasstien").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Cập nhật không thành công</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 2000);
                            }else{
                                $('#droplive').fadeIn();
                                $('.contentnote').html(trave[1]);
                                $('.popupnote').show();
                                setTimeout(function(){
                                    $('.contentnote').html('');
                                    $('.popupnote').fadeOut();
                                    $('#droplive').fadeOut();
                                }, 3000);
                                if(Number(trave[0])==0){
                                    window.location="/m/account/matkhau?mk=ruttien";
                                }
                            }
                            
                             $('#loadingpasstienmoi').hide();
                        }
                    });
                    }
                });
                </script>    
                <?php }?>
                
                <?php }?>
                </div>
                <hr />
                <?php }?>
                <?php /*?>
                <div class="acsmall">
                <p style="font-weight: 600;margin-bottom: 0;">Câu hỏi bảo mật</p>
                <p style="font-size: 0.8em; font-style: italic;">Dùng để lấy lại mật khẩu khi quên</p>
                    <form class="formpass" role="form">
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $u['hoi1']?>" id="hoi1" placeholder="Câu hỏi 1 (tự nhập)">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $u['traloi1']?>" id="traloi1" placeholder="Tự trả lời">
                  </div>
                    <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $u['hoi2']?>" id="hoi2" placeholder="Câu hỏi 2 (tự nhập)">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $u['traloi2']?>" id="traloi2" placeholder="Tự trả lời">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="hoi3" value="<?php echo $u['hoi3']?>" placeholder="Câu hỏi 3 (tự nhập)">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo $u['traloi3']?>" id="traloi3" placeholder="Tự trả lời">
                  </div>
                
                  <button type="button" id="cauhoibaomat" class="btn btn-success">Cập nhật</button> <span id="loadingbaomat" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang xác nhận ...</span>

                </form>
                <script language="javascript">
                $('#cauhoibaomat').click(function(){
                    var hoi1 =$("#hoi1").val();
                    var hoi2 =$("#hoi2").val();
                    var hoi3 =$("#hoi3").val();
                    var traloi1 =$("#traloi1").val();
                    var traloi2 =$("#traloi2").val();
                    var traloi3 =$("#traloi3").val();
                    if(hoi1 == '' && hoi2 == '' && hoi3 == ''){
                        $("#hoi1").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập ít nhất 1 cặp câu hỏi bảo mật</p>');
                        $("#hoi1").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi1=='' && traloi1 !=''){
                        $("#hoi1").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu hỏi số 1</p>');
                        $("#hoi1").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi1!='' && traloi1 ==''){
                        $("#traloi1").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu trả lời số 1</p>');
                        $("#traloi1").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi2=='' && traloi2 !=''){
                        $("#hoi2").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu hỏi số 2</p>');
                        $("#hoi2").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi2!='' && traloi2 ==''){
                        $("#traloi2").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu trả lời số 2</p>');
                        $("#traloi2").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi1=='' && traloi1 !=''){
                        $("#hoi3").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu hỏi số 3</p>');
                        $("#hoi3").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else if(hoi3!='' && traloi3 ==''){
                        $("#traloi3").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập câu trả lời số 3</p>');
                        $("#traloi3").focus();
                        setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                        return false;
                    }else{
                    $('#loadingbaomat').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             hoi1 : hoi1,
                             hoi2 : hoi2,
                             hoi3 : hoi3,
                             traloi1 : traloi1,
                             traloi2 : traloi2,
                             traloi3 : traloi3,
                             typeform : "capnhatbaomat"
                        },
                        success : function (result2){
                            var trave = result2.split('***');
                            if(Number(trave[0])==1){
                                $("#pass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Mật khẩu cũ không đúng</p>');
                                $("#pass").focus();
                                setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                            }else if(Number(trave[0])==2){
                                $("#renewpass").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Cập nhật không thành công</p>');
                                setTimeout(function(){$(".thongbaodo").hide();}, 10000);
                            }else{
                                $('#droplive').fadeIn();
                                $('.contentnote').html(trave[1]);
                                $('.popupnote').show();
                                setTimeout(function(){
                                    $('.contentnote').html('');
                                    $('.popupnote').fadeOut();
                                    $('#droplive').fadeOut();
                                    if(Number(trave[0])==0){
                                    window.location="/m/cpanel/";
                                    }
                                }, 3000);
                            }
                             $('#loadingbaomat').hide();
                        }
                    });
                    }
                });
                </script>
                </div><?php*/?>
                <p>&nbsp;</p>
            </div>
        </div>
     