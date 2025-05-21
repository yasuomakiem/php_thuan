  
    <?php
    $url=$_SERVER['HTTP_REFERER'];
    if($url==lay_url()){
        $url='/danhsach';
    }
    $id=intval($_GET['id']);
    $tenkh=@mysql_fetch_assoc(@mysql_query("select * from khachhang where id=$id and iduser=$_COOKIE[iduser]"));
    ?>
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
    <p>&nbsp;</p>
    <p><a href="<?php echo $url?>"><i class="fas fa-arrow-left"></i> Trở lại</a> / Lên lịch nhắc nhở</p>
    <?php if($me['chatbot']==0){?>
        <h4 class="text-center" style="color: red; padding-top: 20px;"><i class="fas fa-exclamation-triangle"></i> Quan trọng </h4>
        <p class="text-center"><b>Nhắc nhở</b> nghĩa là DSNQ-Online sẽ gửi thông báo nhắc nhở bạn nội dung mà bạn đã lên lịch.</p>
        <p class="text-center">Chúng tôi sẽ gửi thông báo này qua Messanger Facebook.</p>
        <p class="text-center">Do vậy chúng tôi cần bạn xác nhận kết nối giữa DSNQ-Online và Messanger nhận thông báo.</p>
        <p  class="text-center">Bấm vào nút <b>"Lấy mã xác nhận"</b> sau đó bấm bắt đầu để nhận mã. Sau khi có mã hãy copy mã đó dán vào ô <b>"Mã xác nhận"</b> và cập nhật.</p>
        <p class="text-center" style="padding: 25px 0;"><a type="button" class="btn btn-info" href="https://m.me/105367801845963?ref=ac" target="_blank">Lẫy mã xác nhận</a></p>
        <hr />
        <div id="thongbao"></div>
        <form role="form">
          <div class="form-group">
            <label>Nhập Mã xác nhận</label>
            <input type="number" class="form-control" id="maxacnhan" placeholder="Dán mã bạn vừa có được từ messanger vào đây"/>
          </div>
          <button type="button" class="btn btn-success" id="capnhatchatbot">Cập nhật</button>
        </form>
        <script type="text/javascript">
     $(document).ready(function()
    {  
            $('#capnhatchatbot').click(function(){
            
            var maxacnhan = $('#maxacnhan').val();
            if(maxacnhan==''){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Nội dung không được để trống");
                $('#maxacnhan').focus();
                setTimeout(function(){
                        $('#thongbao').html("");
                }, 2000);
                return false;   
            }
            $.ajax({
                url : "ajax.php",
                type : "post", 
                dateType:"text", 
                data : { 
                    maxacnhan : maxacnhan,
                    typeform : "capnhatmaxacnhan"
                },
                success : function (result2){
                    $('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Cập nhật thành công</p>");
                    setTimeout(function(){
                        window.location="<?php echo lay_url()?>";
                    }, 2000);
                },
                error:function(){
                    $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có lỗi, Hãy làm lại");                 
                }
                });
            })
     });
</script> 
        <hr />
        <p><b style="color: red;"><i class="fas fa-exclamation-triangle"></i> Lưu ý: </b></p>
        <p style="font-style: italic;font-weight: 600;">Sau khi kết nối Messager với DSNQ-Online bạn sẽ nhận được các loại thông báo sau:</p>
        <p>- Thông báo từ Danh sách người quen Online</p>
        <p>- Các lịch nhắc nhở mà bạn đã thiết đặt</p>
        <p>- Các thông báo chính thống từ công ty như vấn đề hàng hóa, chính sách, sự kiện...</p>
        <p>- Các thông báo về chương trình đào tạo, các zoom quan trọng của công ty</p>
        <p>- Thông báo từ tuyến trên của bạn (Nếu bạn chấp nhận kết nối với tuyến trên)</p>
        <p>- Những video chia sẻ kiến thức hay, hữu ích</p>
        <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
    <?php }else{?>
    <p>Đối tượng: <b><?php echo $tenkh['ten']?></b></p> 
    <div id="thongbao"></div>
           <form class="form-horizontal" role="form" action="javascript:void(0)" id="">
          <div class="form-group col-md-12">
          <label><i class="far fa-clipboard"></i> Nội dung nhắc</label>
            <textarea class="form-control" rows="3" name="nhacnho" id="nhacnho"></textarea>
          <label style="margin-top: 15px;"><i class="far fa-clock"></i> Đặt lịch</label>
          <p style="margin-bottom: 0px;line-height: 1px;">&nbsp;</p>
          <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" checked="" id="motlan" value="1"/> Nhắc 1 lần
            </label>
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" id="thuongxuyen" value="2"/> Nhắc thường xuyên
            </label>
            <p style="margin-bottom: 5px;line-height: 10px;">&nbsp;</p>
            <input class="form-control" style="width: calc(50% - 2px);width: -moz-calc(50% - 2px);width: -webkit-calc(50% - 2px);float: left;" type="time" id="gio" value="<?php echo date('h')?>:<?php echo date('i')?>" />
            <input class="form-control" type="date" style="width: calc(50% - 4px);width: -moz-calc(50% - 4px);width: -webkit-calc(50% - 4px); float: right;" id="ngay" value="<?php echo date('Y')?>-<?php echo date('m')?>-<?php echo date('d')?>" />
            <select class="form-control" id="chonthuongxuyen" style="width: calc(50% - 4px);width: -moz-calc(50% - 4px);width: -webkit-calc(50% - 4px); float: right; display: none;">
              <option value="1" selected="">Hàng ngày</option>
              <option value="2">2 ngày 1 lần</option>
              <option value="3">3 ngày 1 lần</option>
              <option value="4">4 ngày 1 lần</option>
              <option value="5">5 ngày 1 lần</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" id="themnhacnho"><i class="fas fa-cog"></i> Tạo nhắc nhở</button> 
          <button type="submit" class="btn btn-warning" id="test"><i class="fab fa-cloudscale"></i> Test thử</button>
          <span id="loading" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="images/loading.gif" height="15" /> Đang xác nhận ...</span>
          <div id="thongbao"></div>
        </form>
 <script type="text/javascript">
 $(document).ready(function()
{  
                    $('#motlan').change(function(){
                        var checkbox = document.getElementsByName("inlineRadioOptions");
                        for (var i = 0; i < checkbox.length; i++){
                            if (checkbox[i].checked === true){
                                $('#chonthuongxuyen').slideUp();
                                $('#ngay').slideDown();
                            }
                        }
                    });
                    $('#thuongxuyen').change(function(){
                        var checkbox = document.getElementsByName("inlineRadioOptions");
                        for (var i = 0; i < checkbox.length; i++){
                            if (checkbox[i].checked === true){
                                $('#chonthuongxuyen').slideDown();
                                $('#ngay').slideUp();
                            }
                        }
                    });
                    
                    
                    
        $('#themnhacnho').click(function(){
        var checkbox = document.getElementsByName("inlineRadioOptions");
        var chon = 0;
        for (var i = 0; i < checkbox.length; i++){
                            if (checkbox[i].checked === true){
                                chon=checkbox[i].value;
                            }
                        }
        var nhacnho = $('#nhacnho').val();
        if(nhacnho==''){
            $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Nội dung không được để trống");
            $('#nhacnho').focus();
            setTimeout(function(){
                    $('#thongbao').html("");
            }, 2000);
            return false;   
        }
        var gio = $('#gio').val();
        var thuongxuyen = $('#chonthuongxuyen').val();
        var ngay = $('#ngay').val();
        $.ajax({
            url : "ajax.php",
            type : "post", 
            dateType:"text", 
            data : { 
                nhacnho : nhacnho,
                id : <?php echo $id?>,
                loai : chon,
                gio : gio,
                ngay : ngay,
                thuongxuyen : thuongxuyen,
                typeform : "taonhacnho"
            },
            success : function (result2){
                if(Number(result2)==1){
                $('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Cài đặt thành công</p>");
                   
                setTimeout(function(){
                    window.location="<?php echo $url?>";
                }, 2000);
                }else{
                    $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có vẻ thời gian bạn chọn đã qua rồi"); 
                    setTimeout(function(){
                            $('#thongbao').html("");
                    }, 2000);
                }
            },
            error:function(){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có lỗi, Hãy làm lại");                 
            }
            });
        });
        
        $('#test').click(function(){
        var nhacnho = $('#nhacnho').val();
        if(nhacnho==''){
            $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Nội dung không được để trống");
            $('#nhacnho').focus();
            setTimeout(function(){
                    $('#thongbao').html("");
            }, 2000);
            return false;   
        }
        $.ajax({
            url : "ajax.php",
            type : "post", 
            dateType:"text", 
            data : { 
                nhacnho : nhacnho,
                id : <?php echo $id?>,
                typeform : "testnhacnho"
            },
            success : function (result2){
                $('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Đã gửi test thành công</p>");
                setTimeout(function(){
                            $('#thongbao').html("");
                    }, 2000);
            },
            error:function(){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có lỗi, Hãy làm lại");                 
            }
            });
        })
 });
</script> 
<?php }?>       
    </div>
    </div>