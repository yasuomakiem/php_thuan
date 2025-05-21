<p><a href="/m/nguon/?nguon=showbuy"><i class="fas fa-chevron-left"></i> Trở lại</a> / Thêm nguồn mua</p>
    <div class="boxme">
        <form role="form">
          <div class="form-group">
            <label>Tiêu đề gợi nhớ</label>
            <input type="text" class="form-control" id="ten" placeholder="VD: Cần mua đất khu Nguyễn Trãi"/>
          </div>
          <div class="form-group">
            <label>Khách hàng</label>
            <input type="text" class="form-control" id="showchusohuu" placeholder="Gõ tên, sđt để tìm trong DSKH"/>
            <input type="hidden" class="form-control" id="chusohuu" value=""/>
            <div id="listchusohuu"></div>
            <script language="javascript">
                    $('#showchusohuu').keyup(function(){
                        var showchusohuu =$("#showchusohuu").val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    showchusohuu : showchusohuu,
                                    typeform : "showchunhucau"
                                },
                                success : function (result2){
                                    $('#listchusohuu').html(result2);
                                }
                        });
                    });
                    function chonkhachhang(id,ten){
                        $("#showchusohuu").val(ten);
                        $("#chusohuu").val(id);
                        $(".luachonkh").hide();
                    }
            </script>
          </div>
          <div class="form-group">
        
            <label>Phân loại</label>
            <a type="button" href="/m/account/" class="btn btn-default btn-xs" style="float: right;border: 0;font-size: 0.8em;padding-top: 4px;color: #ff5722;"><i class="fas fa-user-cog"></i> Cài đặt</a>
            <br />
            <?if($u['linhvuc']==''){?>
            <p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Mua - Bán</p>
            <?
            $b=1;
            $pl=@mysql_query("select * from phanloai where loai=0 order by id asc");
            while($rpl=@mysql_fetch_assoc($pl)){ 
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($b==1){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?$b++;}?>
            <p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Thuê - Cho thuê</p>
            <?
            $pl=@mysql_query("select * from phanloai where loai=1 order by id asc");
            while($rpl=@mysql_fetch_assoc($pl)){
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($b==1){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?
            $b++;
            }
            }else{
            $inn=str_replace('[','',str_replace(']','',str_replace('][',',',$u['linhvuc'])));
            $b=1;
            $pl=@mysql_query("select * from phanloai where loai=0 and id in ($inn) order by id asc");
            if(@mysql_num_rows($pl)>0){
                echo '<p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Mua - Bán</p>';
            while($rpl=@mysql_fetch_assoc($pl)){ 
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($b==1){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?$b++;}?>
            <?
            }
            $pl=@mysql_query("select * from phanloai where loai=1 and id in ($inn) order by id asc");
            if(@mysql_num_rows($pl)>0){
                echo '<p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Thuê - Cho thuê</p>';
            while($rpl=@mysql_fetch_assoc($pl)){
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($b==1){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?$b++;}?>
            <?
            }
            }
            ?>
          </div>
          <!--div class="form-group">
            <label>Diện tích</label>
            <input type="number" class="form-control" value="0" id="dientich" placeholder=""/>
          </div>
          <div class="form-group">
            <label>Hướng</label>
            <select class="form-control" id="huong">
            <option value="Chưa xác định">Chưa xác định</option>
            <option value="Đông nam">Đông nam</option>
            <option value="Đông bắc">Đông bắc</option>
            <option value="Tây nam">Tây nam</option>
            <option value="Tây bắc">Tây bắc</option>
            <option value="Đông">Đông</option>
            <option value="Tây">Tây</option>
            <option value="Nam">Nam</option>
            <option value="Bắc">Bắc</option>
            </select>
          </div-->
          <div class="form-group">
            <label>Khu vực</label>
            <select class="form-control" id="tinh" style="margin-bottom: 8px;">
            <option value="0">Thuộc tỉnh/T.Phố</option>
            <?$tinh=@mysql_query("select * from tinh order by ten2 asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option <?if($rtinh['id']==$u['tinh']){echo 'selected=""';}?> value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
            <?}?>
            </select>
            <select class="form-control" id="huyen" style="margin-bottom: 8px;">
            <option value="0">Huyện/T.Trấn</option>
            <?$tinh=@mysql_query("select * from huyen where tinh_id=$u[tinh] order by ten asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
            <?}?>
            </select>
            <div id="xa"></div>
            <div id="duong"></div>
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
                                    $('#duong').html('<option value="0">Đường, khu vực</option>');
                                    $('#xa').html('<option value="0">Xã/Phường</option>');
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
                                    chonnhieu : 1,
                                    typeform : "loadxa"
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
                                    chonnhieu : 1,
                                    typeform : "loadduong"
                                },
                                success : function (result2){
                                    $('#duong').html(result2);
                                }
                        });
                    });
        </script>
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
          <div class="clearfix"></div>
          <label>Phí Sale </label><b style="float: right;color: darkorange;font-weight: normal;" id="showsale"></b>
          <div class="input-group" style="margin-bottom: 15px;">
          <input type="number" style="border-right: 0;" name="phisale" class="form-control" id="phisale" value="0"  placeholder="Phí cho sale" />
          <span class="input-group-addon" style="background: none;border-left: 0; cursor: pointer;"onclick="shownote('<p><b>Phí sale</b></p><p>Là khoản phí chia sẻ mà bạn sẽ trả cho Sale khác khi họ tìm được nguồn phù hợp với nhu cầu mua này. </p><p>VD: Có 1 khách hàng nhờ bạn mua giúp căn nhà với tiêu chí ABC nào đó và phí KH trả cho bạn là 20 triệu. Bạn cập nhật nguồn mua này vào LandBook vào chọn chế độ đẩy lên chợ nguồn. Và bạn sẽ niêm yết phí Sale là 5 triệu chẳng hạn. Khi đó các Sale khác (Bao gồm cả hệ thống Cộng tác viên của Landbook) sẽ biết được là nếu tìm được nguồn cho khách hàng của bạn họ sẽ được 5 triệu. </p><p>Tất nhiên việc ghi phí Sale ở đây chỉ là tương đối. Khi các saler kết hợp với nhau các bạn sẽ tự đàm phán sao cho phù hợp.</p>')"><i class="far fa-question-circle"></i></span>
          </div>
          <div id="showgoiysale"></div>
          <script language="javascript">
                    $('#phisale').keyup(function(){
                        var gsale =$("#phisale").val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    gsale : gsale,
                                    typeform : "goiysale"
                                },
                                success : function (result2){
                                    var shog=result2.split('***');
                                    $('#showsale').html(shog[0]+'đ');
                                    $('#showgoiysale').html(shog[1]);
                                }
                        });
                    });
                    function addsale(giasalec){
                        $("#phisale").val(giasalec);
                        $('#showsale').html(giasalec.replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'đ');
                        $(".asale").hide();
                    }
        </script>
            <div class="form-group">
            <p class="status"></p>
            <label>Hình ảnh</label>
            <br />
            <div id="showthu1" class="chonanh" <?=$e_anhthem[1]?> onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture1" />
            <div id="showthu2" class="chonanh" <?=$e_anhthem[2]?> onclick="document.getElementById('main_picture2').click();"></div>
            <input type="file" id="main_picture2" name="image2"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture2" />
            <div id="showthu3" class="chonanh" <?=$e_anhthem[3]?> onclick="document.getElementById('main_picture3').click();"></div>
            <input type="file" id="main_picture3" name="image3"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture3" />
            <div id="showthu4" style="margin-right: 0;" class="chonanh" <?=$e_anhthem[4]?> onclick="document.getElementById('main_picture4').click();"></div>
            <input type="file" id="main_picture4" name="image4"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture4" />
            <div class="clearfix"></div>
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            //$("#data_picture1").val(e.target.result);
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
                            //$("#data_picture2").val(e.target.result);
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
                            //$("#data_picture3").val(e.target.result);
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
                            //$("#data_picture4").val(e.target.result);
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
                url: 'uploads.php', // gửi đến file upload.php 
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
        

  </div>
    <div class="form-group">
            <label>Thông tin khác</label>
            <textarea class="form-control" id="thongtin" rows="6"></textarea>
          </div>
  <div class="checkbox">

    <label>

      <input type="checkbox" checked="" value="1" name="guinguon"/> Đẩy nguồn lên chợ "Mua bán" để kết nối nguồn

    </label>
  </div>

  <button type="button" class="btn btn-primary" id="dangtin"><i class="fas fa-paper-plane"></i> Lưu nguồn</button>
<p id="dk"></p>
</form>
<script language="javascript">
$('#dangtin').click(function(){
    
    var ten =$("#ten").val();
    var chusohuu =$("#chusohuu").val();
    var phanloai = 0;
    var checkbox = document.getElementsByName("phanloai");
    for (var i = 0; i < checkbox.length; i++){if (checkbox[i].checked === true){phanloai=checkbox[i].value;}}
    //var dientich =$("#dientich").val();
    //var huong =$("#huong").val();
    var tinh =$("#tinh").val();
    var huyen =$("#huyen").val();
    var listxa = document.getElementsByName('xa');
    var xa = "";
                        for (var i = 0; i < listxa.length; i++){
                            if (listxa[i].checked === true){
                                xa += '[' + listxa[i].value + ']';
                            }
                        }
    var listduong = document.getElementsByName('duong');
    var duong = "";
                        for (var i = 0; i < listduong.length; i++){
                            if (listduong[i].checked === true){
                                duong += '[' + listduong[i].value + ']';
                            }
                        }
    var taichinhtu =$("#taichinhtu").val();
    var taichinhtoi =$("#taichinhtoi").val();
    var phisale =$("#phisale").val();
    var anh1 = $("#data_picture1").val();
    var anh2 = $("#data_picture2").val();
    var anh3 = $("#data_picture3").val();
    var anh4 = $("#data_picture4").val();
    var thongtin = $("#thongtin").val(); 
    thongtin = thongtin.replace(/\r?\n/g, "*manh*");
    var checkbox2 = document.getElementsByName('guinguon');
    var guinguon = 0;
    for (var ii = 0; ii < checkbox2.length; ii++){if (checkbox2[ii].checked === true){guinguon = 1;}}
    if(ten == ''){
        $("#ten").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy nhập tên của nguồn</p>');
        $("#ten").focus();
        setTimeout(function(){$(".thongbaodo").hide();}, 3000);
        return false;
    }else if(chusohuu==''){
        $("#showchusohuu").after('<p class="thongbaodo"><i class="fas fa-exclamation-triangle"></i> Hãy gõ tên và chọn 1 người</p>');
        $("#showchusohuu").focus();
        setTimeout(function(){$(".thongbaodo").hide();}, 3000);
        return false;
    }else{
    showloading();
    $.ajax({
        url : "ajax.php",
        type : "post", 
        dateType:"text", 
        data : { 
             ten : ten,
             chusohuu : chusohuu,
             phanloai : phanloai,
             //dientich : dientich,
             //huong : huong,
             tinh : tinh,
             huyen : huyen,
             xa : xa,
             duong : duong,
             taichinhtu : taichinhtu,
             taichinhtoi : taichinhtoi,
             phisale : phisale,
             anh1 : anh1,
             anh2 : anh2,
             anh3 : anh3,
             anh4 : anh4,
             thongtin : thongtin,
             guinguon : guinguon,
             typeform : "dangnguonmua"
        },
        success : function (result2){
             hideloading();
             window.location.href="/m/nguon/?nguon=showbuy";
        }
    });
    }
});
</script>
        <div class="clearfix"></div>
    </div>
    <??>