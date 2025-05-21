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
                height: 100px;
                background-image: url('images/xacnhan.jpg');
                background-size: cover;
                background-position: center;
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
.boxnaptien span.titlabel{
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
            <p style="margin-bottom: 5px;"><b>Thông tin: <?=$khach['fullname']?></b></p>
            <p class="nut">
                <?if($khach['uid']!=''){?>
                <a type="button" class="btn btn-default btn-xs hidden-lg hidden-md" href="fb://profile/<?=$khach['uid']?>">Tường</a> 
                <a type="button" class="btn btn-default btn-xs hidden-sm hidden-xs" onclick="location.href='https://www.facebook.com/<?=$khach['uid']?>'">Tường</a> 
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
            
        </div>
        <div class="clearfix"></div>
        
    </div>
    <?
        $thongbao='';
        if(isset($_POST['capnhat'])){
                $fullname=addslashes($_POST['fullname']);
                $phone2=addslashes($_POST['phone2']);
                $email=addslashes($_POST['email']);
                $gioitinh='';
                if(isset($_POST['gioitinh'])){
                    $gioitinh=$_POST['gioitinh'];
                }
                $uid=layuid($_POST['uid']);
                $ngaysinh=$_POST['ngaysinh'];
                $cmnd=addslashes($_POST['cmnd']);
                $tinh=intval($_POST['tinh']);
                $huyen=intval($_POST['huyen']);
                $xa=intval($_POST['xa']);
                $diachi=addslashes($_POST['diachi']);
                
                if($fullname!='' and $email!='' and $ngaysinh!='' and $cmnd!='' and $tinh!=0 and $huyen!=0 and $xa!=0 and $diachi!=''){ 
                     $uplaitien=@mysql_query("update user set fullname=N'$fullname',email='$email',uid='$uid',phone2='$phone2',cmnd='$cmnd',gioitinh='$gioitinh',ngaysinh='$ngaysinh',tinh=$tinh,huyen=$huyen,xa=$xa,diachi=N'$diachi' where id=$idkhach");
                if($uplaitien){
                    echo '<script>window.location="/m/danhsachtin/";</script>';
                }else{
                    $thongbao='<p class="err" style="color:red"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                }else{$thongbao='<p class="err" style="color:red"><i class="fas fa-exclamation-triangle"></i> Nhập đầy đủ các trường bắt buộc!</p>';}
            }
        ?>
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
    background-image: url(<?if($khach['avatar']!=''){echo 'upload/avatar/'.$khach['avatar'];}else{if($khach['gioitinh']=='nu'){echo 'i/avatar_nu.png';}else{echo 'i/avatar_nam.png';}}?>);
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
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/danhsachtin/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Trở lại</a></h3>
    <div class="boxnaptien">
        <span class="titlabel">Cập nhật thông tin</span>
        <p>Giúp quản lý và đăng ký tài khoản cho khách hàng trên các sàn:</p>
        <form role="form" method="post" enctype="multipart/form-data" action="">
            <?=$thongbao?>
            <div class="avatar" id="avatar" onclick="document.getElementById('main_picture1').click();" style="">
                <span><i class="fas fa-sync-alt"></i></span>
                </div>
                <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
                <input type="hidden" name="iduser" value="<?=$idkhach?>" />
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
                url: 'uploads_avatar.php?iduser=<?=$idkhach?>', // gửi đến file upload.php 
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
          <div class="form-group">
            <label>Họ tên <sup style="color: red;">(*)</sup></label>
            <input type="text" required="" name="fullname" class="form-control" value="<?=$khach['fullname']?>" placeholder="Nhập họ tên"/>
          </div>
          <div class="form-group">
            <label>Số điện thoại 1</label>
            <input type="number" readonly="" class="form-control" value="<?=$khach['phone']?>"/>
          </div>
          <div class="form-group">
            <label>Số điện thoại 2</label>
            <input type="number" class="form-control" name="phone2" value="<?=$khach['phone2']?>" placeholder="Số điện thoại khác"/>
          </div>
          <div class="form-group">
            <label>Email <sup style="color: red;">(*)</sup></label>
            <input type="email" name="email" required="" class="form-control" value="<?=$khach['email']?>" placeholder="Nhập email của khách"/>
          </div>
          <div class="form-group">
            <label>UID Facebook </label>
            <input type="text" name="uid" required="" class="form-control" value="<?=$khach['uid']?>" placeholder="UID hoặc link 1 bài viết trên tường của KH"/>
          </div>
          <p>Giới tính: 
                <label class="radio-inline">
                  <input type="radio" name="gioitinh" <?if($khach['gioitinh']=='nam'){echo 'checked=""';}?> id="inlineRadio1" value="nam"/> Nam
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gioitinh" <?if($khach['gioitinh']=='nu'){echo 'checked=""';}?> id="inlineRadio2" value="nu"/> Nữ
                </label>
            </p>
            
        <div class="form-group">
                <label>Ngày sinh <sup style="color: red;">(*)</sup></label>
                <input class="form-control date" name="ngaysinh" type="date" id="ngaysinh" value="<?=$u['ngaysinh']?>" placeholder="Ngày sinh (*)" />
        </div>
        <div class="form-group">
            <label>Số CMND/Thẻ CCCD <sup style="color: red;">(*)</sup></label>
            <input type="number" class="form-control" required="" name="cmnd" value="<?=$khach['cmnd']?>" placeholder="Nhập cmnd hoặc Thẻ CCCD"/>
          </div>
        <div class="form-group" style="margin-top: 15px;">
            <label>Tỉnh <sup style="color: red;">(*)</sup></label>
            <select class="form-control" name="tinh"style="width: 100%;" id="tinh">
            <option value="0">--Chọn Tỉnh/tp--</option>
            <?
            $tinh=@mysql_query("select * from tinh order by ten asc");
            while($rtinh=@mysql_fetch_assoc($tinh)){
            ?>
              <option value="<?=$rtinh['id']?>" <?if($rtinh['id']==$khach['tinh']){echo 'selected=""';}?>><?=$rtinh['ten']?></option>
            <?}?>
            </select>
        </div>
        <div class="form-group" style="margin-top: 15px;">
            <label>Huyện <sup style="color: red;">(*)</sup></label>
            <select class="form-control" name="huyen" style="width: 100%;" id="huyen">
            <option value="0">--Chọn Quận/huyện--</option>
            <?
            if($khach['tinh']!=0){
            $tinh=@mysql_query("select * from huyen where tinh_id=$khach[tinh] order by ten asc");
            while($rtinh=@mysql_fetch_assoc($tinh)){
            ?>
              <option value="<?=$rtinh['id']?>" <?if($rtinh['id']==$khach['huyen']){echo 'selected=""';}?>><?=$rtinh['ten']?></option>
            <?}}?>
            </select>
        </div>
        <div class="form-group" style="margin-top: 15px;">
            <label>Xã <sup style="color: red;">(*)</sup></label>
            <select class="form-control" name="xa" style="width: 100%;" id="xa">
            <option value="0">--Chọn Phường/xã--</option>
            <?
            if($khach['huyen']!=0){
            $tinh=@mysql_query("select * from xa where huyen_id=$khach[huyen] order by ten asc");
            while($rtinh=@mysql_fetch_assoc($tinh)){
            ?>
              <option value="<?=$rtinh['id']?>" <?if($rtinh['id']==$khach['xa']){echo 'selected=""';}?>><?=$rtinh['ten']?></option>
            <?}}?>
            </select>
        </div>
        <script language="javascript">
                $('#tinh').change(function(){
                    var tinh =$("#tinh").val();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             tinh : tinh,
                             typeform : "loadhuyen"
                        },
                        success : function (result2){
                            $('#huyen').html(result2);
                        }
                    });
                    
                });
                $('#huyen').change(function(){
                    var huyen =$("#huyen").val();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             huyen : huyen,
                             typeform : "loadxa"
                        },
                        success : function (result2){
                            $('#xa').html(result2);
                        }
                    });
                    
                });
                </script>
        <div class="form-group">
            <label>Địa chỉ <sup style="color: red;">(*)</sup></label>
            <input type="text" name="diachi" required="" class="form-control" value="<?=$khach['diachi']?>" placeholder="Địa chỉ cụ thể"/>
          </div>
          <button type="submit" name="capnhat" class="btn btn-primary">Cập nhật</button>
        <p>&nbsp;</p>
        </form>
        <p><i></i></p>
    </div>
    </div>
    
    <div class="clearfix"></div>
</div>
     