
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/nguyen-ly-trong-chien-luoc-dai-duong-xanh.jpg" />
                <div class="dealright">
                <p><b>Quản lý Khách hàng</b></p>
                <?php
                $tm=date("Y").date("m").date("d").'000000';
                $tm=intval($tm);
                $homnay=@mysql_num_rows(@mysql_query("select id from user where upline=$_COOKIE[iduser] and timecs>$tm"));
                $sll=@mysql_num_rows(@mysql_query("select * from user where upline=$_COOKIE[iduser] order by timecs asc"));
                ?>
                <p style="font-size: 0.88em;">
                Tổng số: <b><?php echo $sll?></b>  &nbsp; 
                Hoàn thành: <span class="badge" style="background: yellow; color: red;"><?php echo $homnay?></span>
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="boxland">
            
            <?php if(isset($_GET['add'])){?>
            <style>
            label.kieu{
                color: #0584be;
                font-weight: 500;
                padding-left: 10px;
                border-left: 4px solid #f44336;
                margin-bottom: 16px;
                line-height: 16px;
                margin-top: 15px;
            }
            label.kieu sup{color: red;}
            </style>
            <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/cpanel/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Thêm khách hàng</h4>
            <div class="boxme">
            <form role="form">
                <div id="thongbao"></div>
                  <div class="form-group">
                  <label class="kieu">Họ tên <sup>(*)</sup></label>
                    <input type="text" name="ten" class="form-control" id="hoten" required="" placeholder="Tên khách hàng" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số điện thoai <sup>(*)</sup></label>
                    <input type="number" name="phone" class="form-control" id="phone"  placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Mật khẩu <sup>(*)</sup></label>
                    <input type="text" name="pass" class="form-control" id="pass"  placeholder="Mật khẩu đăng nhập cho KH" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số điện thoai 2</label>
                    <input type="number" name="phone2" class="form-control" id="phone2"  placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Email <sup>(*)</sup></label>
                    <input type="email" name="email" class="form-control" id="email"  placeholder="Email khách hàng" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Facebook <sup>(*)</sup></label>
                    <input type="text" name="uid" class="form-control" id="uid" placeholder="UID facebook hoặc link 1 bài viết bất kỳ" />
                  </div>
                  
                  <label class="kieu">Giới tính</label><br />
                  <label class="radio-inline">
                      <input type="radio" name="gioitinh" checked="" id="nam" value="nam"/> Nam
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gioitinh" id="nu" value="nu"/> Nữ
                    </label>
                    
                  <div class="form-group" style="margin-bottom: 15px;margin-top: 15px;">
                    <label class="kieu">Lĩnh vực <sup>(*)</sup></label>
                    <input type="text" name="tag" class="form-control" id="linhvuc"  placeholder="VD: Chuyên đất nền, thổ cư, Nhà chung cư..." />
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Ngày sinh <sup>(*)</sup></label>
                    <input type="date" name="ngaysinh" class="form-control" id="ngaysinh"  placeholder="" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số CMND/TCC <sup>(*)</sup></label>
                    <input type="number" name="cmnd" class="form-control" id="cmnd" placeholder="Số Chứng minh nhân dân hoặc thẻ căn cước" />
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Tỉnh/Thành phố <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="tinh">
                    <option value="0">Chọn...</option>
                        <?php
                        $tinh=@mysql_query("select * from tinh order by ten2 asc");
                        while($rtinh=@mysql_fetch_assoc($tinh)){
                        ?>
                          <option value="<?php echo $rtinh['id']?>" <?php if($rtinh['id']==$u['tinh']){echo 'selected=""';}?>><?php echo $rtinh['ten']?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Quận/Huyện <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="huyen">
                        <option value="0">Chọn...</option>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Phường/Xã <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="xa">
                        <option value="0">Chọn...</option>
                    </select>
                  </div>
                  <label class="kieu">Ảnh đại diện <sup>(*)</sup></label>
            <br />
            <div id="showthu1" class="chonanh" onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture1" />
            
            
            <div class="clearfix"></div>
                <script>
                $('#tinh').change(function(){
                        var tinh = $('#tinh').val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    tinh : tinh,
                                    typeform : "taihuyen"
                                },
                                success : function (result2){
                                    $('#huyen').html(result2);
                                }
                        });
                    }); 
                    $('#huyen').change(function(){
                        var huyen = $('#huyen').val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    huyen : huyen,
                                    typeform : "taixa"
                                },
                                success : function (result2){
                                    $('#xa').html(result2);
                                }
                        });
                    }); 
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
                });
                
                
        function uploadimage(idfile) {
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
                url: 'uploads_avatar_kh.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    var inp = idfile.replace('main_','data_');
                    $('#'+inp).val(res);
                    $('#data_picture1').val(res);
                }
            });
        } else {
            $('.status').text('Chỉ được upload file ảnh');
        }
        return false;
    };
                </script> 
                  <button type="button" id="them" class="btn btn-primary" name="them"><i class="fas fa-plus-circle"></i> Thêm khách hàng</button>
                </form>
            <script>
                        $('body').ready(function(){
                            $('#them').click(function(){
                            var hoten = $('#hoten').val();
                            var uid = $('#uid').val();
                            var phone = $('#phone').val();
                            var phone2 = $('#phone2').val();
                            var email = $('#email').val();
                            var pass = $('#pass').val();
                            var anh1 = $("#data_picture1").val();
                            var checkbox = document.getElementsByName("gioitinh");
                            for (var i = 0; i < checkbox.length; i++){if (checkbox[i].checked === true){gioitinh=checkbox[i].value;}}
                            var linhvuc = $('#linhvuc').val();
                            var ngaysinh = $('#ngaysinh').val();
                            var cmnd = $('#cmnd').val();
                            var tinh = $('#tinh').val();
                            var huyen = $('#huyen').val();
                            var xa = $('#xa').val();
                            if(hoten==''){
                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Nhập tên người quen</p>');
                                $('#hoten').focus();
                                 setTimeout(function(){
                                    $('#thongbao').html('');
                                },4000)
                                return false;
                            }
                            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                            if (vnf_regex.test(phone) == false && phone!='') 
                            {
                                $('#thongbao').html('<p style="color:red; font-size:0.9em" class="text-center"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');
                                $('#phone').focus();
                               setTimeout(function(){
                                    $('#thongbao').html('');
                                },4000)
                                return false;
                            }
                            if(uid!=''){
                                $.ajax({
                                    url : "ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { 
                                    typeform : 'kiemtrauid',
                                    uid : uid
                                },
                                success : function (data){
                                    var uidok = Number(data);
                                    if(Number(data)==0){
                                        $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> UID không đúng định dạng. Hãy xem lại video hướng dẫn phía dưới</p>');
                                        $('#uid').val('');
                                        $('#uid').focus();
                                        setTimeout(function(){
                                            $('#thongbao').html('');
                                        },4000);
                                        return false;
                                    }else{
                                    $.ajax({
                                            url : "ajax.php", 
                                            type : "post",
                                            dateType:"text",
                                            data : { 
                                            typeform : 'registerkh',
                                                fullname : hoten,
                                                phone : phone,
                                                phone2 : phone2,
                                                email : email,
                                                avatar : anh1,
                                                gioitinh : gioitinh,
                                                password : pass,
                                                linhvuc : linhvuc,
                                                ngaysinh : ngaysinh,
                                                cmnd : cmnd,
                                                tinh : tinh,
                                                huyen : huyen,
                                                xa : xa,
                                                reff : <?php echo $u['id']?>,
                                                uid : uid
                                        },
                                        success : function (data2){
                                            if(Number(data2)==0){
                                                $('#thongbao').html('<p style="color:#4caf50" class="text-center"><i class="fas fa-check"></i> Thêm khách hàng thành công</p> <p class="text-center"><button type="button" class="btn btn-primary" onclick="location.href=\'/danhsach\'">Danh sách</button> <button type="button" onclick="location.href=\'/danhsach?add=1\'" class="btn btn-primary">Thêm tiếp</button></p>');
                                                setTimeout(function(){
                                                    window.location="/m/cpanel/";
                                                },0);
                                            }else if(Number(data2)==2){
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Người này đã được thêm rồi bạn ạ</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }else{
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công (#400)</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }
                                        }
                                    });    
                                    }
                                }
                                });
                            }else{
                                $.ajax({
                                            url : "ajax.php", 
                                            type : "post",
                                            dateType:"text",
                                            data : { 
                                            typeform : 'registerkh',
                                                fullname : hoten,
                                                phone : phone,
                                                phone2 : phone2,
                                                email : email,
                                                avatar : anh1,
                                                gioitinh : gioitinh,
                                                password : pass,
                                                linhvuc : linhvuc,
                                                ngaysinh : ngaysinh,
                                                cmnd : cmnd,
                                                tinh : tinh,
                                                huyen : huyen,
                                                xa : xa,
                                                reff : <?php echo $u['id']?>,
                                                uid : uid
                                        },
                                        success : function (data2){
                                            if(Number(data2)==1){
                                                $('#thongbao').html('<p style="color:#4caf50" class="text-center"><i class="fas fa-check"></i> Thêm khách hàng thành công</p> <p class="text-center"><button type="button" class="btn btn-primary" onclick="location.href=\'/danhsach\'">Danh sách</button> <button type="button" onclick="location.href=\'/danhsach?add=1\'" class="btn btn-primary">Thêm tiếp</button></p>');
                                                setTimeout(function(){
                                                    window.location="/m/cpanel/";
                                                },0);
                                            }else if(Number(data2)==3){
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Người này đã được thêm rồi bạn ạ</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }else{
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công (#400)</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }
                                        }
                                    });
                            }
                            
                            })
                            })
                        </script>
                
                </div>
                
            <?php }elseif(isset($_GET['edit'])){
                $edit=intval($_GET['edit']);
                $redit=@mysql_fetch_assoc(@mysql_query("select * from user where id=$edit and upline=$u[id]"));
                if(isset($_POST['sua'])){
                    $fullname=addslashes($_POST['ten']);
                    $phone=addslashes($_POST['phone']);
                    $phone2=addslashes($_POST['phone2']);
                    $email=addslashes($_POST['email']);
                    $password=addslashes($_POST['pass']);
                    $linhvuc = addslashes($_POST['linhvuc']);
                    $uid=layuid(addslashes($_POST['uid']));
                    $ngaysinh = addslashes($_POST['ngaysinh']);
                    $cmnd=addslashes($_POST['cmnd']);
                    $tinh=intval($_POST['tinh']);
                    $huyen=intval($_POST['huyen']);
                    $gioitinh = addslashes($_POST['gioitinh']);
                    $xa=intval($_POST['xa']);
                    $pass=md5($password);
                    if($_POST['anh1']!=''){$avatar=trim(addslashes($_POST['anh1']));}else{$avatar=$redit['avatar'];}
            
                $in="update user set fullname=N'$fullname',phone2='$phone2',pass='$pass',passro=N'$password',avatar=N'$avatar',
                uid=N'$uid',email='$email',linhvuc=N'$linhvuc',ngaysinh='$ngaysinh',cmnd='$cmnd',gioitinh='$gioitinh',tinh=$tinh,huyen=$huyen,xa=$xa where id=".intval($_GET['edit'])." and upline=".$_COOKIE['iduser'];
                $q=mysql_query($in);
                if($q){
                    echo '
                    <script language="JavaScript">
                    var my_timeout=setTimeout("gotosite();",0);
                    function gotosite()
                    {
                    window.location="/m/cpanel/";
                    }
                    </script>
                    ';// cái này là chuyển trang bằng javascript
                    exit();
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
                ?>
                
                <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/cpanel/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Sửa thông tin</h4>
            <style>
            p.tenn{
                margin-bottom: 3px;
                font-size: 0.9em;
                font-style: italic;
                color: #ca7a03;
            }
            </style>
            <div class="boxme">
            <form role="form" action="" method="post">
                <?php echo $thongbao?>
                <div id="thongbao"></div>
                  <div class="form-group">
                  <label class="kieu">Họ tên <sup>(*)</sup></label>
                    <input type="text" name="ten" class="form-control" id="hoten" required="" value="<?php echo $redit['fullname']?>" placeholder="Tên khách hàng" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số điện thoai <sup>(*)</sup></label>
                    <input type="number" name="phone" class="form-control" id="phone"  value="<?php echo $redit['phone']?>" readonly="" placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Mật khẩu <sup>(*)</sup></label>
                    <input type="text" name="pass" class="form-control" id="pass"  value="<?php echo $redit['passro']?>"  placeholder="Mật khẩu đăng nhập cho KH" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số điện thoai 2</label>
                    <input type="number" name="phone2" class="form-control" id="phone2"  value="<?php echo $redit['phone2']?>"  placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Email <sup>(*)</sup></label>
                    <input type="email" name="email" class="form-control" id="email"  value="<?php echo $redit['email']?>"   placeholder="Email khách hàng" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Facebook <sup>(*)</sup></label>
                    <input type="text" name="uid" class="form-control" id="uid"  value="<?php echo $redit['uid']?>"  placeholder="UID facebook hoặc link 1 bài viết bất kỳ" />
                  </div>
                  
                  <label class="kieu">Giới tính</label><br />
                  <label class="radio-inline">
                      <input type="radio" name="gioitinh" <?php if($redit['gioitinh']=='nam'){echo 'checked=""';}?> id="nam" value="nam"/> Nam
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gioitinh" <?php if($redit['gioitinh']=='nu'){echo 'checked=""';}?> id="nu" value="nu"/> Nữ
                    </label>
                    
                  <div class="form-group" style="margin-bottom: 15px;margin-top: 15px;">
                    <label class="kieu">Lĩnh vực <sup>(*)</sup></label>
                    <input type="text" name="linhvuc" class="form-control" id="linhvuc" value="<?php echo $redit['linhvuc']?>"  placeholder="VD: Chuyên đất nền, thổ cư, Nhà chung cư..." />
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Ngày sinh <sup>(*)</sup></label>
                    <input type="date" name="ngaysinh" class="form-control" id="ngaysinh"  value="<?php echo $redit['ngaysinh']?>" placeholder="" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Số CMND/TCC <sup>(*)</sup></label>
                    <input type="number" name="cmnd" class="form-control" id="cmnd"  value="<?php echo $redit['cmnd']?>" placeholder="Số Chứng minh nhân dân hoặc thẻ căn cước" />
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Tỉnh/Thành phố <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" name="tinh" id="tinh">
                    <option value="0">Chọn...</option>
                        <?php
                        $tinh=@mysql_query("select * from tinh order by ten2 asc");
                        while($rtinh=@mysql_fetch_assoc($tinh)){
                        ?>
                          <option <?php if($redit['tinh']==$rtinh['id']){echo 'selected=""';}?> value="<?php echo $rtinh['id']?>"><?php echo $rtinh['ten']?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Quận/Huyện <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" name="huyen" id="huyen">
                        <option value="0">Chọn...</option>
                        <?php
                        $huyen=@mysql_query("select * from huyen where tinh_id=$redit[tinh] order by ten asc");
                        while($rhuyen=@mysql_fetch_assoc($huyen)){
                        ?>
                          <option <?php if($redit['huyen']==$rhuyen['id']){echo 'selected=""';}?> value="<?php echo $rhuyen['id']?>"><?php echo $rhuyen['loai']?> <?php echo $rhuyen['ten']?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Phường/Xã <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" name="xa" id="xa">
                        <option value="0">Chọn...</option>
                        <?php
                        $xa=@mysql_query("select * from xa where huyen_id=$redit[huyen] order by ten asc");
                        while($rxa=@mysql_fetch_assoc($xa)){
                        ?>
                          <option <?php if($redit['xa']==$rxa['id']){echo 'selected=""';}?> value="<?php echo $rxa['id']?>"><?php echo $rxa['loai']?> <?php echo $rxa['ten']?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div style="color: red;" class="status"></div>
                  <label>Hình ảnh</label>
            <br />
            <div id="showthu1" class="chonanh" <?php if(trim($redit['avatar'])!=''){?>style="background-image: url('upload/avatar/<?php echo trim($redit['avatar'])?>');background-size: cover;"<?php }?> onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh1" id="data_picture1" />
            
            
            <div class="clearfix"></div>
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
                });
                
                function uploadimage(idfile) {
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
                            url: 'uploads_avatar_kh.php', // gửi đến file upload.php 
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
                $('#tinh').change(function(){
                        var tinh = $('#tinh').val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    tinh : tinh,
                                    typeform : "taihuyen"
                                },
                                success : function (result2){
                                    $('#huyen').html(result2);
                                }
                        });
                    }); 
                    $('#huyen').change(function(){
                        var huyen = $('#huyen').val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    huyen : huyen,
                                    typeform : "taixa"
                                },
                                success : function (result2){
                                    $('#xa').html(result2);
                                }
                        });
                    }); 
                </script> 
                  <button type="submit" class="btn btn-primary" name="sua"><i class="fas fa-edit"></i> Sửa thông tin</button>
                </form>
                <hr />
             </div>   
            <?php }else{?>
                <!--form class="form-inline">
                      <div class="form-group" style="width: 100%;">
                        <div class="input-group" style="width: 100%;margin-bottom: 10px;">
                          <input style="border: 0;" type="text" class="form-control" id="exampleInputAmount" placeholder="Tên hoặc số điện thoại">
                          <div style="background: none;width: 50px;border: 0;background: #03a9f4;color: white;" class="input-group-addon"><i class="fas fa-search-dollar"></i></div>
                        </div>
                      </div>
                </form-->
                
                <style>#seach{display: none;}</style>
                <div id="seach"></div>
                <div id="nomal">
                <?php
                $khtn=@mysql_query("select * from user where upline=$_COOKIE[iduser] order by timecs asc");
                $solg=@mysql_num_rows($khtn);
                $them='?page=';
                ?>
            
            <a style="float: right;padding-top: 7px;" href="/m/khachhang/?add=1"><i class="fas fa-plus-circle"></i> Thêm khách hàng</a>
            <div class="btn-group" style="margin-bottom: 10px;">
            <a style="float: left;padding-top: 7px;" href="/m/khachhang/"><i class="fas fa-sync-alt"></i> Tải lại</a>
            </div>
            <div class="clearfix"></div>
            <?php
            if($solg==0){
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Chưa có khách hàng nào được thêm vào.<br /><br /><a href="/m/khachhang/?add=1"  type="button" class="btn btn-primary">Thêm ngay vào danh sách</a></p>';
                }
            $page=isset($_GET["page"])?intval($_GET["page"]):1;
            if(isset($_GET['view'])){$rows_per_page=$_GET['view'];}else{$rows_per_page=60;}
            $page_start=($page-1)*$rows_per_page;
            $page_end=$page*$rows_per_page;
            $number_of_page=ceil($solg/$rows_per_page);
            if ($number_of_page>1)
            {
            // Ti?n h�nh in t?ng trang //
            for ($i=1; $i<=$number_of_page; $i++)
            {	
            // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
            if ($i==$page)
            {			
            $list_page.="<li class=\"active\"><span>$i</span></li>";
            }
            // Ngu?c l?i... //
            else
            {
                            //trường hợp có từ 6 trang trở lên thì tạo ra ...
            if($number_of_page>8){
            if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
            if($i<7){
            $list_page.="<li><a href=\"/m/khachhang/".$them.$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"/m/khachhang/".$them.$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"/m/khachhang/".$them.$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"/m/khachhang/".$them.$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"/m/khachhang/".$them.=$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"/m/khachhang/".$them."1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"/m/khachhang/".$them.$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){ $pcong=$page+1;
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"/m/khachhang/".$them.$pcong."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-right\"></i></span>
        		</a>
        	</li>
            ";
            }
            //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ <V
            if(1!=$page){
                $ptru=$page-1;
            $list_page="
            <li>
        		<a class=\"first \" aria-label=\"Previous\" href=\"/m/khachhang/".$them.$ptru."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-left\"></i></span>
        		</a>
        	</li>
            ".$list_page;
            }
            	
            }
            //end phân trang
            $ii=1;
            $a=0;
            $i=1;
            while($rkh=@mysql_fetch_assoc($khtn)){
                if ($ii>$page_start){
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 kh" id="khung<?php echo $rkh['id']?>">
                <p><b><?php echo $i?>. <?php echo $rkh['fullname']?></b> <i style="float: right;">Hạn dùng: <b><?php if($rkh['timedichvu']==0){echo 'N/a';}else{echo retime_ngay($rkh['timedichvu']);}?></b></i></p>
                <p class="nut"> 
                <?php if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" href="fb://profile/<?php echo $rkh['uid']?>">Tường</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" onclick="location.href='https://www.facebook.com/<?php echo $rkh['uid']?>'">Tường</a> 
                <?php }?>
                <?php if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" href="https://fb.com/msg/<?php echo $rkh['uid']?>">Messenger</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" href="https://www.facebook.com/messages/t/<?php echo $rkh['uid']?>">Messenger</a> 
                <?php }?>
                <?php if($rkh['phone']!=''){?><a type="button" class="btn btn-info btn-xs" href="https://zalo.me/<?php echo $rkh['phone']?>">Zalo</a><?php }?>
                <?php if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href="tel:<?php echo $rkh['phone']?>">Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $rkh['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href="sms:<?php echo $rkh['phone']?>">SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $rkh['phone']?>');">SMS</a>
                <?php }?>
                </p>
                
                <div class="thongtinu">
                    <p>SĐT: <?php echo $rkh['phone']?> - <?php echo $rkh['email']?></p>
                    <p>Tham gia: <?php echo retime($rkh['time'])?></p>
                </div>
                <div class="cuoi" style="padding-bottom: 5px;">
                <div class="nutdieuhuong"><a href="/m/saletaotin/?kh=<?php echo $rkh['id']?>&add=1"><i class="far fa-clipboard"></i><br />Tạo tin</a></div> 
                <div class="nutdieuhuong"><a href="/m/saletaotin/?kh=<?php echo $rkh['id']?>"><i class="far fa-clipboard"></i><br />Danh sách tin</a></div>
                <div class="nutdieuhuong"><a style="color: #FF8000;" href="/m/taichinhkhachhang/?idkhach=<?php echo $rkh['id']?>"><i class="fas fa-hand-holding-usd"></i><br />Tài chính</a></div>
                
                <div class="clearfix"></div>
                <script>
                $(function() {  
                
                $("#datuongtac<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            loai : 0,
                            typeform : "timedichvuxong"
                        },
                        success : function (result2){
                            $('#khung<?php echo $rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                
                $("#damua<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            typeform : "chuyen_tiem_nang_da_mua"
                        },
                        success : function (result2){
                            //window.location="khachhang/tiemnang.html";
                            //alert(result2);
                            $('#khung<?php echo $rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                });
                </script>
                </div>
                
                <div class="cuoi" style="border-top: 0; padding-top: 10px;">
                <div class="nutdieuhuong"><a style="color: red;" onclick="return confirm('Bạn các chắc chắn muốn xóa người này?')" href="del.php?del=<?php echo $rkh['id']?>&table=khachhang&iduser=<?php echo $rkh['iduser']?>"><i class="fas fa-trash-alt"></i><br />Xóa</a> </div>
                <div class="nutdieuhuong"><a style="color: #FF8000;" href="/m/khachhang/?edit=<?php echo $rkh['id']?>"><i class="fas fa-edit"></i><br />Sửa</a></div>
                <div class="nutdieuhuong"><a href="/m/khachhang/?chuyen=<?php echo $rkh['id']?>" style="color: #009688;"><i class="fas fa-user-plus"></i><br />Đăng nhập</a> </div>
                <div class="nutdieuhuong"><a href="javascritp:void(0)" id="datuongtac<?php echo $rkh['id']?>"><i class="fas fa-user-shield"></i><br />Hoàn thành</a> </div> 
                <div class="clearfix"></div> 
                </div>
            </div>    
            
            <?php }$i++;?>
            <?php
            if ($ii>=$page_end)
            {
            break;	
            }
            $ii++;
            } 
                if(isset($list_page)){
                $listxxx=('
                <div class="filter-right" style="margin-bottom:50px">
                <div class="collection-pagination text-center pagination-wrapper">       
                <ul class="pagination">
                '.$list_page.'
                </ul>
                </div>
				</div><!-- End. Filter 2-->
                ');
                }else{$listxxx='';}?> 
            <p>&nbsp;</p>
            <?php echo $listxxx?>
            </div>    
            
            <?php }?>
           
            </div>
            <div class="clearfix"></div>
</div>
     