
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/nguyen-ly-trong-chien-luoc-dai-duong-xanh.jpg" />
                <div class="dealright">
                <p><b><?if(isset($_GET['add'])){echo 'Tạo tin đăng mới';}elseif($_GET['edit']){echo 'Cập nhật tin đăng';}else{echo 'Tạo tin đăng mới';}?></b></p>
                <?
                $idkh=intval($_GET['kh']);
                $khach=@mysql_fetch_assoc(@mysql_query("select * from user where id=$idkh"));
                ?>
                <p style="font-size: 0.88em;">
                Khách hàng: <b><?=$khach['fullname']?></b>  
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="boxland">
            
            <?if(isset($_GET['add'])){?>
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
            <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/cpanel/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Thêm tin mới</h4>
            <div class="boxme">
            <form role="form">
                <div id="thongbao"></div>
                  <div class="form-group">
                  <label class="kieu">Tiêu đề <sup>(*)</sup></label>
                    <input type="text" name="tieude" class="form-control" id="tieude" required="" placeholder="" />
                  </div>
                  <div class="form-group">
                    <label class="kieu">Loại tin <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="loaitin">
                        <option value="Bán nhà">Bán nhà</option>
                        <option value="Bán đất">Bán đất</option>
                        <option value="Cho thuê">Cho thuê</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="kieu">Chủng loại <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="chungloai">
                        <option value="Nhà trong ngõ">Nhà trong ngõ</option>
                        <option value="Căn hộ - chung cư">Căn hộ - chung cư</option>
                        <option value="Nhà mặt phố">Nhà mặt phố</option>
                        <option value="Nhà tập thể">Nhà tập thể</option>
                        <option value="Biệt thự - liền kề">Biệt thự - liền kề</option>
                        <option value="Cửa hàng - mặt bằng">Cửa hàng - mặt bằng</option>
                        <option value="Kho xưởng - trang trại">Kho xưởng - trang trại</option>
                        <option value="Đất ở - đất thổ cư">Đất ở - đất thổ cư</option>
                        <option value="Đất nền dự án">Đất nền dự án</option>
                        <option value="Văn phòng">Văn phòng</option>
                        <option value="Phòng trọ">Phòng trọ</option>
                        <option value="Khác">Khác</option>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Tỉnh/Thành phố <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="tinh">
                    <option value="0">Chọn...</option>
                        <?
                        $tinh=@mysql_query("select * from tinh order by ten2 asc");
                        while($rtinh=@mysql_fetch_assoc($tinh)){
                        ?>
                          <option value="<?=$rtinh['id']?>" <?if($rtinh['id']==$u['tinh']){echo 'selected=""';}?>><?=$rtinh['ten']?></option>
                        <?}?>
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
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Đường <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="duong">
                        <option value="0">Chọn...</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label class="kieu">Diện tích <sup>(*)</sup></label>
                    <input type="text" name="dientich" class="form-control" id="dientich" required="" placeholder="" />
                  </div>
                  <div class="form-group">
                  <label class="kieu">Chiều dài <sup>(*)</sup></label>
                    <input type="text" name="dai" class="form-control" id="dai" required="" placeholder="" />
                  </div>
                  <div class="form-group">
                  <label class="kieu">Chiều rộng <sup>(*)</sup></label>
                    <input type="text" name="rong" class="form-control" id="rong" required="" placeholder="" />
                  </div>
                  <div class="form-group">
                  <label class="kieu">Giá bán <sup>(*)</sup></label>
                    <input type="text" name="giaban" class="form-control" id="giaban" required="" placeholder="" />
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Pháp lý <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="phaply">
                        <option value="Sổ đỏ">Sổ đỏ</option>
                        <option value="Sổ hồng">Sổ hồng</option>
                        <option value="Hợp đồng mua bán">Hợp đồng mua bán</option>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Hướng <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="huong" name="huong">
                        <option value="Không xác định">Không xác định</option>
                        <option value="Đông">Đông</option>
                        <option value="Tây">Tây</option>
                        <option value="Nam">Nam</option>
                        <option value="Bắc">Bắc</option>
                        <option value="Tây nam">Tây nam</option>
                        <option value="Tây bắc">Tây bắc</option>
                        <option value="Đông nam">Đông nam</option>
                        <option value="Đông bắc">Đông bắc</option>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Đường vào <sup>(*)</sup></label>
                    <select class="form-control"style="width: 100%;" id="duongvao" name="duongvao">
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label class="kieu">Dự án <sup>(*)</sup></label>
                    <input type="text" name="duan" class="form-control" id="duan" required="" placeholder="" />
                  </div>
                  <div id="nha">
                      <div class="form-group">
                        <label class="kieu">Số tầng <sup>(*)</sup></label>
                        <input type="text" name="sotang" class="form-control" id="sotang" value="0" placeholder="" />
                      </div>
                      <div class="form-group">
                        <label class="kieu">Số phòng ngủ <sup>(*)</sup></label>
                        <input type="text" name="sophongngu" class="form-control" id="sophongngu" value="0" placeholder="" />
                      </div>
                      <div class="form-group">
                        <label class="kieu">Số Toilet <sup>(*)</sup></label>
                        <input type="text" name="sotoilet" class="form-control" id="sotoilet" value="0" placeholder="" />
                      </div>
                  </div>
                  <div class="form-group" style="margin-bottom: 15px;">
                    <label class="kieu">Nội dung <sup>(*)</sup></label>
                    <textarea class="form-control" rows="6" name="noidung" id="noidung"></textarea>
                  </div>
                  <div style="color: red;" class="status"></div>
                  <label>Ảnh đại diện</label>
            <br />
            <div id="showthu0" class="chonanh" onclick="document.getElementById('main_picture0').click();"></div>
            <input type="file" id="main_picture0" name="image0" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture0" />
            
                  <div style="color: red;" class="status0"></div>
                  <div class="clearfix"></div>
                  <label>Hình ảnh khác</label>
            <br />
            <div id="showthu1" class="chonanh" onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture1" />
            <div id="showthu2" class="chonanh" onclick="document.getElementById('main_picture2').click();"></div>
            <input type="file" id="main_picture2" name="image2"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture2" />
            <div id="showthu3" class="chonanh" onclick="document.getElementById('main_picture3').click();"></div>
            <input type="file" id="main_picture3" name="image3"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture3" />
            <div id="showthu4" style="margin-right: 0;" class="chonanh" onclick="document.getElementById('main_picture4').click();"></div>
            <input type="file" id="main_picture4" name="image4"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture4" />
            
            <div class="clearfix"></div>
                <script>
                function readURL0(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu0').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture0');
                    }
                }
                $("#main_picture0").change(function() {
                    readURL0(this);
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
                function readURL2(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu2').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                           
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture2');
                    }
                }
                $("#main_picture2").change(function() {
                    readURL2(this);
                });
                function readURL3(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu3').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture3');
                    }
                }
                $("#main_picture3").change(function() {
                    readURL3(this);
                });
                function readURL4(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu4').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture4');
                    }
                }
                $("#main_picture4").change(function() {
                    readURL4(this);
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
                url: 'upload_tin.php', // gửi đến file upload.php 
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
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    huyen : huyen,
                                    typeform : "taiduong"
                                },
                                success : function (result2){
                                    $('#duong').html(result2);
                                }
                        });
                    }); 
                </script> 
                
                  <button type="button" id="them" class="btn btn-primary" name="them"><i class="fas fa-plus-circle"></i> Tạo tin</button>
                </form>
            <script>
                        $('body').ready(function(){
                            $('#them').click(function(){
                            var tieude = $('#tieude').val();
                            var loaitin = $('#loaitin').val();
                            var chungloai = $('#chungloai').val();
                            var tinh = $('#tinh').val();
                            var huyen = $('#huyen').val();
                            var xa = $('#xa').val();
                            var duong = $('#duong').val();
                            var matduong = $('#duongvao').val();
                            var dientich = $('#dientich').val();
                            var dai = $('#dai').val();
                            var rong = $('#rong').val();
                            var giaban = $('#giaban').val();
                            var phaply = $('#phaply').val();
                            var noidung = $('#noidung').val();
                            var huong = $('#huong').val();
                            var anh0 = $("#data_picture0").val();
                            var anh1 = $("#data_picture1").val();
                            var anh2 = $("#data_picture2").val();
                            var anh3 = $("#data_picture3").val();
                            var anh4 = $("#data_picture4").val();
                            if(tieude==''){
                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Nhập tiêu đề tin</p>');
                                $('#tieude').focus();
                                 setTimeout(function(){
                                    $('#thongbao').html('');
                                },4000)
                                return false;
                            }
                            
                                    $.ajax({
                                            url : "ajax.php", 
                                            type : "post",
                                            dateType:"text",
                                            data : { 
                                            typeform : 'taotinmoi',
                                                tieude : tieude,
                                                loaitin : loaitin,
                                                chungloai : chungloai,
                                                tinh : tinh,
                                                huyen : huyen,
                                                xa : xa,
                                                duong : duong,
                                                phaply : phaply,
                                                dientich : dientich,
                                                dai : dai,
                                                rong : rong,
                                                huong : huong,
                                                matduong : matduong,
                                                noidung : noidung,
                                                gia : giaban,
                                                anh0 : anh0,
                                                anh1 : anh1,
                                                anh2 : anh2,
                                                anh3 : anh3,
                                                anh4 : anh4,
                                                idu : <?=$_GET['kh']?>,
                                                idnhanvien : <?=$u['id']?>
                                        },
                                        success : function (data2){
                                            if(Number(data2)==0){
                                                $('#thongbao').html('<p style="color:#4caf50" class="text-center"><i class="fas fa-check"></i> Thêm tin thành công</p> <p class="text-center"><button type="button" class="btn btn-primary" onclick="location.href=\'/danhsach\'">Danh sách</button> <button type="button" onclick="location.href=\'/danhsach?add=1\'" class="btn btn-primary">Thêm tiếp</button></p>');
                                                setTimeout(function(){
                                                    window.location="/m/khachhang/";
                                                },1000);
                                            }else{
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công (#400)</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }
                                        }
                                    });    
                            })
                            })
                        </script>
                
                </div>
                
            <?}elseif(isset($_GET['edit'])){
                $edit=intval($_GET['edit']);
                $redit=@mysql_fetch_assoc(@mysql_query("select * from khachhang where id=$edit and iduser=$u[id]"));
                if(isset($_POST['sua'])){
            $ten=addslashes($_POST['ten']);
            $uid=addslashes($_POST['uid']); 
            $uid=layuid($uid);
            if($uid==0){$uid='';}
            $phone=addslashes($_POST['phone']);
            $tagg=addslashes(str_replace(", ",",",str_replace(" ,",",",$_POST['tag'])));
            $tag=trim(strtolower($tagg));    
            if($_POST['anh1']!=''){$anh1=trim(addslashes($_POST['anh1']));}else{$anh1=$redit['anh1'];}
            if($_POST['anh2']!=''){$anh2=trim(addslashes($_POST['anh2']));}else{$anh2=$redit['anh2'];}
            if($_POST['anh3']!=''){$anh3=trim(addslashes($_POST['anh3']));}else{$anh3=$redit['anh3'];}
            if($_POST['anh4']!=''){$anh4=trim(addslashes($_POST['anh4']));}else{$anh4=$redit['anh4'];}
            $taichinhtu=intval($_POST['taichinhtu']);
            $taichinhtoi=intval($_POST['taichinhtoi']);
            $nhucau=intval($_POST['nhucau']);
                $in="update khachhang set ten=N'$ten',uid='$uid',phone='$phone',tag=N'$tag',anh1=N'$anh1',anh2=N'$anh2',anh3=N'$anh3',anh4=N'$anh4',taichinhtu=$taichinhtu,taichinhtoi=$taichinhtoi,nhucau=$nhucau where id=".intval($_GET['edit'])." and iduser=".$_COOKIE['iduser'];
                $q=mysql_query($in);
                if($q){
                    echo '
                    <script language="JavaScript">
                    var my_timeout=setTimeout("gotosite();",0);
                    function gotosite()
                    {
                    window.location="/m/khachhang/";
                    }
                    </script>
                    ';// cái này là chuyển trang bằng javascript
                    exit();
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
                ?>
                
                <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/khachhang/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Sửa thông tin</h4>
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
                <?=$thongbao?>
                <p></p>
                  <div class="form-group">
                    <p ><i class="fas fa-user"></i> Họ tên:</p>
                    <input type="text" name="ten" class="form-control" id="" required="" placeholder="Tên khách hàng" value="<?=$redit['ten']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fab fa-facebook"></i> UID hoặc link 1 bài viết bất kỳ:</p>
                    <input type="text" name="uid" class="form-control" id="" placeholder="UID hoặc link" value="<?=$redit['uid']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-phone"></i> Số điện thoại:</p>
                    <input type="number" name="phone" class="form-control" id=""  placeholder="Số điện thoại" value="<?=$redit['phone']?>">
                  </div>
                  <label>Nhu cầu</label><br />
                  <label class="radio-inline">
                      <input type="radio" name="nhucau" id="nhucau0" value="0" <?if($redit['nhucau']==0){echo 'checked=""';}?>/> N/a
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="nhucau" id="nhucau1" value="1" <?if($redit['nhucau']==1){echo 'checked=""';}?>/> Mua
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="nhucau" id="nhucau2" value="2" <?if($redit['nhucau']==2){echo 'checked=""';}?>/> Bán
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="nhucau" id="nhucau3" value="3" <?if($redit['nhucau']==3){echo 'checked=""';}?>/> Đầu tư
                    </label>
                    <label style="margin-top: 15px;">Tài chính <i style="font-weight: normal; font-size: 0.8em;">(x1000.000)</i></label>
                    <div class="clearfix"></div>
                    <div class="input-group col-md-6 col-xs-6" style="float: left;margin-bottom: 15px;">
                        <input type="number" value="<?=$redit['taichinhtu']?>" name="taichinhtu" id="taichinhtu" class="form-control">
                        <span class="input-group-addon" style="border-radius: 0;border-right: 0;">Từ</span>
                    </div>
                    <div class="input-group col-md-6 col-xs-6" style="float: right;margin-bottom: 15px;">
                        <input style="border-left: 0;border-radius: 0;" id="taichinhtoi" name="taichinhtoi" type="number" value="<?=$redit['taichinhtoi']?>" class="form-control">
                        <span class="input-group-addon">Tới</span>
                    </div>
                    <div class="clearfix"></div>
                    <p id="quayday" style="margin-top: -10px;font-size: 0.85em; font-style: italic;">
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('1000*1000')">Tầm 1 tỷ</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('2000*2000')">Tầm 2 tỷ</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('3000*3000')">Tầm 3 tỷ</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('5000*5000')">Tầm 5 tỷ</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('800*800')">Tầm 800</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('0*1000')">1 tỷ quay đầu</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('0*2000')">2 tỷ quay đầu</a>
                   <a type="button" class="agiagoc btn btn-default btn-xs" style="font-size: 10px;margin-bottom: 3px;" onclick="quaydau('0*3000')">3 tỷ quay đầu</a>
                  </p>
                  <script>
                  function quaydau(khoanggia){
                        var kg=khoanggia.split("*");
                        $('#taichinhtu').val(kg[0]);
                        $('#taichinhtoi').val(kg[1]);
                  }
                  </script>
                  <div class="input-group" style="margin-bottom: 15px;">
                    <input type="text" style="border-right: 0;" name="tag" value="<?=$redit['tag']?>" class="form-control" id="tag"  placeholder="Đặt tag" />
                    <span class="input-group-addon" style="background: none;border-left: 0; cursor: pointer;"onclick="shownote('<p>Tag là những từ khóa giúp phân loại khách hàng tốt nhất. Vd: nhóm ABC, khách ngoài, kh cũ, bạn cũ... Mỗi tag cách nhau 1 dấu phẩy (,) Để sau khi bấm vào <b>KH cũ</b> thì tất cả những ai có tag là <b>KH cũ</b> sẽ hiển thị</p>')"><i class="fas fa-info-circle"></i></span>
                  </div>
                  
                  <div style="color: red;" class="status"></div>
                  <label>Hình ảnh</label>
            <br />
            <div id="showthu1" class="chonanh" <?if($redit['anh1']!=''){?>style="background-image: url('upload/khachhang/<?=$redit['anh1']?>');background-size: cover;"<?}?> onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh1" id="data_picture1" />
            <div id="showthu2" class="chonanh" <?if($redit['anh2']!=''){?>style="background-image: url('upload/khachhang/<?=$redit['anh2']?>');background-size: cover;"<?}?> onclick="document.getElementById('main_picture2').click();"></div>
            <input type="file" id="main_picture2" name="image2"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh2" id="data_picture2" />
            <div id="showthu3" class="chonanh" <?if($redit['anh3']!=''){?>style="background-image: url('upload/khachhang/<?=$redit['anh3']?>');background-size: cover;"<?}?> onclick="document.getElementById('main_picture3').click();"></div>
            <input type="file" id="main_picture3" name="image3"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh3" id="data_picture3" />
            <div id="showthu4" style="margin-right: 0;" class="chonanh" <?if($redit['anh4']!=''){?>style="background-image: url('upload/khachhang/<?=$redit['anh4']?>');background-size: cover;"<?}?> onclick="document.getElementById('main_picture4').click();"></div>
            <input type="file" id="main_picture4" name="image4"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh4" id="data_picture4" />
            
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
                function readURL2(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu2').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                           
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture2');
                    }
                }
                $("#main_picture2").change(function() {
                    readURL2(this);
                });
                function readURL3(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu3').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture3');
                    }
                }
                $("#main_picture3").change(function() {
                    readURL3(this);
                });
                function readURL4(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu4').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture4');
                    }
                }
                $("#main_picture4").change(function() {
                    readURL4(this);
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
                            url: 'uploads_kh.php', // gửi đến file upload.php 
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
                  <button type="submit" class="btn btn-primary" name="sua"><i class="fas fa-edit"></i> Sửa thông tin</button>
                </form>
                <hr />
             </div>   
            <?}else{ ?>
                <!--form class="form-inline">
                      <div class="form-group" style="width: 100%;">
                        <div class="input-group" style="width: 100%;margin-bottom: 10px;">
                          <input style="border: 0;" type="text" class="form-control" id="exampleInputAmount" placeholder="Tên hoặc số điện thoại">
                          <div style="background: none;width: 50px;border: 0;background: #03a9f4;color: white;" class="input-group-addon"><i class="fas fa-search-dollar"></i></div>
                        </div>
                      </div>
                </form-->
                
                <style>#seach{display: none;}</style>
                <script>
                $(function() {  
                $('#exampleInputAmount').keyup(function(){
                        $('#nomal').hide();
                        $('#seach').show();
                        var key=$('#exampleInputAmount').val();
                        if(key==''){
                            $('#seach').hide();
                            $('#nomal').show();
                        }else{
                        $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            key : key,
                            loai:0,
                            idxem : <?=$_COOKIE['iduser']?>,
                            chinhchu : 1,
                            typeform : "searchkhtn"
                        },
                        success : function (result2){
                            $('#seach').html(result2);
                        },
                        error:function(){              }
                        });
                        }
                });
                /*$("#datuongtac<?=$rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?=$rkh['id']?>,
                            typeform : "activett"
                        },
                        success : function (result2){
                            $('#khung<?=$rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });*/
                });
                </script>
                <div id="seach"></div>
                <div id="nomal">
                <?
                $khtn=@mysql_query("select * from tin where idnhanvien=$_COOKIE[iduser] and idu=$_GET[kh] order by time asc");
                $solg=@mysql_num_rows($khtn);
                $them='&page=';
                ?>
            <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/cpanel/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Danh sách tin
            <a style="float: right;" href="/m/saletaotin/?kh=<?=$_GET['kh']?>&add=1"><i class="fas fa-plus-circle"></i> Thêm tin mới</a>
            </h4>
            <div class="clearfix"></div>
            <?
            if($solg==0){
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Chưa có tin nào.<br /><br /><a href="/m/saletaotin/?kh='.$_GET['kh'].'&add=1"  type="button" class="btn btn-primary">Thêm ngay vào danh sách</a></p>';
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
            $list_page.="<li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.=$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them."1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){ $pcong=$page+1;
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$pcong."\">
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
        		<a class=\"first \" aria-label=\"Previous\" href=\"/m/saletaotin/?kh=$_GET[kh]".$them.$ptru."\">
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
                    $anhdaidien='';
                    $anh=explode("***",$rkh['anh']);
                    for($is=0;$is<count($anh);$is++){
                        if($anh[$is]!=''){$anhdaidien=$anh[$is]; break;}
                    }
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 kh" id="khung<?=$rkh['id']?>">
                <div style="width: 100px; height: 60px; float: left; background: url(upload/tin/<?=$anhdaidien?>); background-size: cover; background-position: center;"></div>
                <div style="width: calc(100% - 110px);width: -moz-calc(100% - 110px);width: -webkit-calc(100% - 110px); float: right;">
                <b><a href=""><?=$rkh['tieude']?></a></b>
                <p style="font-size: 0.9em;">Tạo: <i><?=retime($rkh['time'])?></i></p>
                </div>
                <div class="clearfix"></div>
                <p style="margin: 0;">&nbsp;</p>
                <div class="thongtinu">
                    <p>Trạng thái: <span style="color: red;"><?if($rkh['trangthai']==0){echo 'Đang xử lý';}elseif($rkh['trangthai']==2){echo 'Bản nháp';}else{echo 'Đã xử lý xong';}?></span></p>
                </div>
            </div>    
            
            <?}$i++;?>
            <?
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
            <?=$listxxx?>
            </div>    
            
            <?}?>
           
            </div>
            <div class="clearfix"></div>
</div>
     