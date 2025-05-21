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
                $ngaysinh=$_POST['ngaysinh'];
                $cmnd=addslashes($_POST['cmnd']);
                $tinh=intval($_POST['tinh']);
                $huyen=intval($_POST['huyen']);
                $xa=intval($_POST['xa']);
                $diachi=addslashes($_POST['diachi']);
                
                if($fullname!='' and $email!='' and $ngaysinh!='' and $cmnd!='' and $tinh!=0 and $huyen!=0 and $xa!=0 and $diachi!=''){ 
                     $uplaitien=@mysql_query("update user set fullname=N'$fullname',email='$email',phone2='$phone2',cmnd='$cmnd',gioitinh='$gioitinh',ngaysinh='$ngaysinh',tinh=$tinh,huyen=$huyen,xa=$xa,diachi=N'$diachi' where id=$idkhach");
                if($uplaitien){
                    
                    echo '<script>window.location="/m/danhsachtin/";</script>';
                }else{
                    $thongbao='<p class="err" style="color:red"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                }else{$thongbao='<p class="err" style="color:red"><i class="fas fa-exclamation-triangle"></i> Nhập đầy đủ các trường bắt buộc!</p>';}
            }
        ?>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/danhsachtin/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Trở lại</a></h3>
    <div class="boxnaptien">
        <span class="titlabel">Cập nhật thông tin</span>
        <p>Đăng ký sau đó lưu tên đăng nhập và mật khẩu sàn:</p>
          
          <?
          $timsan=@mysql_query("select * from san order by id asc");$i=1;
          while($rsan=@mysql_fetch_assoc($timsan)){
            $timtaikhoan=@mysql_fetch_assoc(@mysql_query("select * from taikhoan where idu=$idkhach and idsan=$rsan[id]"));
          ?>
          <p style="margin-top: 12px;"><?=$i?>. <b><?=$rsan['tenmien']?></b></p>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <input type="text" class="form-control" value="<?=$timtaikhoan['user']?>" id="user<?=$rsan['id']?>" placeholder="Tên đăng nhập">
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <input type="text" class="form-control" value="<?=$timtaikhoan['pass']?>" id="pass<?=$rsan['id']?>" placeholder="Mật khẩu">
                  </div>
                  <button type="button" style="margin-bottom: 3px;" class="btn btn-success btn-xs" id="capnhat<?=$rsan['id']?>">Cập nhật</button> 
                  <span id="loading<?=$rsan['id']?>" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" style="height: 15px; width: 15px;margin-left: 20px;margin-top: -3px;"/> Đang lưu ...</span>
                  <script language="javascript">
                $('#capnhat<?=$rsan['id']?>').click(function(){
                    var user<?=$rsan['id']?> =$("#user<?=$rsan['id']?>").val();
                    var pass<?=$rsan['id']?> =$("#pass<?=$rsan['id']?>").val();
                    if(pass<?=$rsan['id']?> == '' && user<?=$rsan['id']?> == ''){
                        alert('Nhập tên đăng nhập và mật khẩu');
                        return false;
                    }else{
                    $('#loading<?=$rsan['id']?>').show();
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                             user : user<?=$rsan['id']?>,
                             pass : pass<?=$rsan['id']?>,
                             idu : <?=$idkhach?>,
                             idsan : <?=$rsan['id']?>,
                             typeform : "capnhattaikhoan"
                        },
                        success : function (result2){
                             $('#loading<?=$rsan['id']?>').hide();
                        }
                    });
                    }
                });
                </script>
          <?$i++;}?>
        <p><i></i></p>
    </div>
    </div>
    
    <div class="clearfix"></div>
</div>
     