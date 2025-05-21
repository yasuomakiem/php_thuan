<?php

        $id=intval($_GET['id']);
        $edit=@mysql_fetch_assoc(@mysql_query("select * from nguonban where id=$id"));
        if($edit['chu']!=0){
            $timchu=@mysql_fetch_assoc(@mysql_query("select ten from khachhang where id=$edit[chu]"));
            $tenchu=$timchu['ten'];
        }else{
            $tenchu='BĐS của tôi';
        }
        ?>
    <p><a href="m/nguon/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Sửa nguồn bán</p>
    <div class="boxme">
        <form role="form">
          <div class="form-group">
            <label>Tiêu đề gợi nhớ</label>
            <input type="text" class="form-control" id="ten" value="<?=$edit['ten']?>" placeholder="VD: Nhà 304 Nguyễn Trãi, anh Thành"/>
          </div>
          <div class="form-group">
            <label>Chủ sở hữu/Người gửi</label>
            <input type="text" class="form-control" id="showchusohuu" value="<?=$tenchu?>" placeholder="Gõ tên, sđt để tìm trong DSKH"/>
            <input type="hidden" class="form-control" id="chusohuu" value="<?=$edit['chu']?>"/>
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
                                    typeform : "showchusohuu"
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
            $pl=@mysql_query("select * from phanloai where loai=0 order by id asc");
            while($rpl=@mysql_fetch_assoc($pl)){ 
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($edit['loai']==$rpl['id']){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?}?>
            <p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Thuê - Cho thuê</p>
            <?
            $pl=@mysql_query("select * from phanloai where loai=1 order by id asc");
            while($rpl=@mysql_fetch_assoc($pl)){
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($edit['loai']==$rpl['id']){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?
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
              <input type="radio" name="phanloai" <?if($edit['loai']==$rpl['id']){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?
            }
            }
            $pl=@mysql_query("select * from phanloai where loai=1 and id in ($inn) order by id asc");
            if(@mysql_num_rows($pl)>0){
                echo '<p style="padding: 0 10px;border-left: 5px solid;margin-top: 15px;">Thuê - Cho thuê</p>';
            while($rpl=@mysql_fetch_assoc($pl)){
            ?>
            <label style="margin-left: 10px;margin-top: 10px;" class="radio-inline">
              <input type="radio" name="phanloai" <?if($edit['loai']==$rpl['id']){echo 'checked=""';}?> id="inlineRadio<?=$rpl['id']?>" value="<?=$rpl['id']?>"/> <?=$rpl['ten']?>
            </label>
            <?
            }
            }
            }
            ?>
          </div>
          <div class="form-group">
            <label>Diện tích</label>
            <input type="number" class="form-control" value="<?=$edit['dientich']?>" id="dientich" placeholder=""/>
          </div>
          <div class="form-group">
            <label>Hướng</label>
            <select class="form-control" id="huong">
            <option <?if($edit['huong']=='Chưa xác định'){echo 'selected=""';}?> value="Chưa xác định">Chưa xác định</option>
            <option <?if($edit['huong']=='Đông nam'){echo 'selected=""';}?> value="Đông nam">Đông nam</option>
            <option <?if($edit['huong']=='Đông bắc'){echo 'selected=""';}?> value="Đông bắc">Đông bắc</option>
            <option <?if($edit['huong']=='Tây nam'){echo 'selected=""';}?> value="Tây nam">Tây nam</option>
            <option <?if($edit['huong']=='Tây bắc'){echo 'selected=""';}?> value="Tây bắc">Tây bắc</option>
            <option <?if($edit['huong']=='Đông'){echo 'selected=""';}?> value="Đông">Đông</option>
            <option <?if($edit['huong']=='Tây'){echo 'selected=""';}?> value="Tây">Tây</option>
            <option <?if($edit['huong']=='Nam'){echo 'selected=""';}?> value="Nam">Nam</option>
            <option <?if($edit['huong']=='Bắc'){echo 'selected=""';}?> value="Bắc">Bắc</option>
            </select>
          </div>
          <div class="form-group">
            <label>Gửi địa điểm <i style="cursor: pointer;" onclick="shownote('<p>Là địa điểm như bạn vẫn thường gửi qua Zalo, message. Giúp sale khác có thể xác định vị trí dễ dàng.</p><p>Cách lấy:</p><p>Vào địa điểm giống như gửi trên Zalo, Messange --> Vào bản đồ --> Tùy chọn chia sẻ (dưới cùng) --> Chọn bảng nhớ tạm --> Sau đó dán vào ô gửi địa điểm trên LandBook</p>')" class="far fa-question-circle"></i></label>
            <input type="text" class="form-control" value="<?=$edit['diadiem']?>" id="diadiem" placeholder=""/>
             <script language="javascript">
                    $('#diadiem').blur(function(){
                        var diad=$('#diadiem').val();
                        var arrdiadiem = diad.split('http');
                        $('#diadiem').val('http'+arrdiadiem[1]);
                    });
             </script>
          </div>
          <div class="form-group">
            <label>Khu vực</label>
            <select class="form-control" id="tinh" style="margin-bottom: 8px;">
            <option value="0">Thuộc tỉnh/T.Phố</option>
            <?$tinh=@mysql_query("select * from tinh order by ten2 asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option <?if($rtinh['id']==$edit['tinh']){echo 'selected=""';}?> value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
            <?}?>
            </select>
            <select class="form-control" id="huyen" style="margin-bottom: 8px;">
            <option value="0">Huyện/T.Trấn</option>
            <?
            if($edit['tinh']!=0){
            $tinh=@mysql_query("select * from huyen where tinh_id=$edit[tinh] order by ten asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option <?if($rtinh['id']==$edit['huyen']){echo 'selected=""';}?> value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
            <?}}?>
            </select>
            <select class="form-control" id="xa" style="margin-bottom: 8px;">
            <option value="0">Xã/Phường</option>
            <?
            if($edit['huyen']!=0){
            $tinh=@mysql_query("select * from xa where huyen_id=$edit[huyen] order by ten asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option <?if($rtinh['id']==$edit['xa']){echo 'selected=""';}?> value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
            <?}}?>
            </select>
            <select class="form-control" id="duong" style="margin-bottom: 8px;">
            <option value="0">Đường, khu vực</option>
            <?
            if($edit['huyen']!=0){
            $tinh=@mysql_query("select * from duong where huyen_id=$edit[huyen] order by ten asc");while($rtinh=@mysql_fetch_assoc($tinh)){?>
              <option <?if($rtinh['id']==$edit['duong']){echo 'selected=""';}?> value="<?=$rtinh['id']?>"><?=$rtinh['loai']?> <?=$rtinh['ten']?></option>
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
                                    typeform : "loadduong"
                                },
                                success : function (result2){
                                    $('#duong').html(result2);
                                }
                        });
                    });
        </script>
          <div class="form-group">
            <label>Địa chỉ cụ thể</label>
            <input type="text" class="form-control" value="<?=$edit['diachi']?>" id="diachi" placeholder=""/>
          </div>
          <div class="form-group">
            <label>Giá gốc </label><b style="float: right;color: darkorange;font-weight: normal;" id="showgiagoc"></b>
            <input type="number" class="form-control" value="<?=$edit['giagoc']?>" id="giagoc" placeholder=""/>
            <div id="showgoiygiagoc"></div>
          </div>
          <script language="javascript">
                    $('#giagoc').keyup(function(){
                        var giag =$("#giagoc").val();
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    giag : giag,
                                    typeform : "goiygiagoc"
                                },
                                success : function (result2){
                                    var shog=result2.split('***');
                                    $('#showgiagoc').html(shog[0]+'đ');
                                    $('#showgoiygiagoc').html(shog[1]);
                                }
                        });
                    });
                    function addgiagoc(giagocc){
                        $("#giagoc").val(giagocc);
                        $('#showgiagoc').html(giagocc.replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'đ');
                        $(".agiagoc").hide();
                    }
        </script>
          <div class="form-group">
            <label>Giá bán ra</label>
            <input type="text" class="form-control" id="giaban" value="<?=$edit['giaban']?>" placeholder="500tr, 2tỷ5xx....Giá hiển thị cho sale khác"/>
            
          </div>
          
          <div class="form-group">
            <label>Phí Sale</label><b style="float: right;color: darkorange;font-weight: normal;" id="showsale"></b>
            <input type="number" class="form-control" id="phisale" value="<?=$edit['phisale']?>" placeholder=""/>
            <div id="showgoiysale"></div>
          </div>
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
            <div id="showthu1" class="chonanh" <?if($edit['anh1']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh1'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture1" <?if($edit['anh1']!=''){echo 'value="'.$edit['anh1'].'"';}?> />
            <div id="showthu2" class="chonanh" <?if($edit['anh2']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh2'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture2').click();"></div>
            <input type="file" id="main_picture2" name="image2"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture2"  <?if($edit['anh2']!=''){echo 'value="'.$edit['anh2'].'"';}?>/>
            <div id="showthu3" class="chonanh" <?if($edit['anh3']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh3'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture3').click();"></div>
            <input type="file" id="main_picture3" name="image3"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture3"  <?if($edit['anh3']!=''){echo 'value="'.$edit['anh3'].'"';}?>/>
            <div id="showthu4" style="margin-right: 0;<?if($edit['anh4']!=''){echo 'background-image: url(/upload/nguon/size200/'.$edit['anh4'].');background-size: cover;';}?>" class="chonanh"  onclick="document.getElementById('main_picture4').click();"></div>
            <input type="file" id="main_picture4" name="image4"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture4"  <?if($edit['anh4']!=''){echo 'value="'.$edit['anh4'].'"';}?>/>
            <div id="showthu5" class="chonanh" <?if($edit['anh5']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh5'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture5').click();"></div>
            <input type="file" id="main_picture5" name="image5" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture5"  <?if($edit['anh5']!=''){echo 'value="'.$edit['anh5'].'"';}?>/>
            <div id="showthu6" class="chonanh" <?if($edit['anh6']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh6'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture6').click();"></div>
            <input type="file" id="main_picture6" name="image6"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture6"  <?if($edit['anh6']!=''){echo 'value="'.$edit['anh6'].'"';}?>/>
            <div id="showthu7" class="chonanh" <?if($edit['anh7']!=''){echo 'style="background-image: url(/upload/nguon/size200/'.$edit['anh7'].');background-size: cover;"';}?> onclick="document.getElementById('main_picture7').click();"></div>
            <input type="file" id="main_picture7" name="image7"  style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture7"  <?if($edit['anh7']!=''){echo 'value="'.$edit['anh7'].'"';}?>/>
            <div id="showthu8" style="margin-right: 0;<?if($edit['anh8']!=''){echo 'background-image: url(/upload/nguon/size200/'.$edit['anh8'].');background-size: cover;';}?>" class="chonanh"  onclick="document.getElementById('main_picture8').click();"></div>
            <input type="file" id="main_picture8" name="image8"  style="display: none;" accept="image/*"/>
            <input type="hidden" id="data_picture8"  <?if($edit['anh8']!=''){echo 'value="'.$edit['anh8'].'"';}?>/>
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
                function readURL5(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu5').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            //$("#data_picture5").val(e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture5');
                    }
                }
                $("#main_picture5").change(function() {
                    readURL5(this);
                });
                function readURL6(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu6').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            //$("#data_picture6").val(e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture6');
                    }
                }
                $("#main_picture6").change(function() {
                    readURL6(this);
                });
                function readURL7(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu7').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            //$("#data_picture7").val(e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture7');
                    }
                }
                $("#main_picture7").change(function() {
                    readURL7(this);
                });
                function readURL8(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu8').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            //$("#data_picture8").val(e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture8');
                    }
                }
                $("#main_picture8").change(function() {
                    readURL8(this);
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
            <label>Thông tin BĐS</label>
            <textarea class="form-control" id="thongtin" rows="8"><?=str_replace("*manh*","\n",str_replace("<br />","\n",str_replace("????????","",$edit['thongtin'])))?></textarea>
          </div>
  <div class="checkbox"> 
    <label>
      <input type="checkbox" <?if($edit['guinguon']==1){echo 'checked=""';}?> value="1" name="guinguon"/> Đẩy nguồn lên chợ "Mua bán" để Sale khác liên hệ
    </label>
  </div>

  <button type="button" class="btn btn-primary" id="editdangtin"><i class="fas fa-paper-plane"></i> Sửa nguồn</button>
<p id="dk"></p>
</form>
<script language="javascript">
$('#editdangtin').click(function(){
    
    var ten =$("#ten").val();
    var chusohuu =$("#chusohuu").val();
    var phanloai = 0;
    var checkbox = document.getElementsByName("phanloai");
    for (var i = 0; i < checkbox.length; i++){if (checkbox[i].checked === true){phanloai=checkbox[i].value;}}
    var dientich =$("#dientich").val();
    var huong =$("#huong").val();
    var diadiem =$("#diadiem").val();
    var tinh =$("#tinh").val();
    var huyen =$("#huyen").val();
    var xa =$("#xa").val();
    var duong =$("#duong").val();
    var diachi =$("#diachi").val();
    var giagoc =$("#giagoc").val();
    var giaban =$("#giaban").val();
    var phisale =$("#phisale").val();
    var anh1 = $("#data_picture1").val();
    var anh2 = $("#data_picture2").val();
    var anh3 = $("#data_picture3").val();
    var anh4 = $("#data_picture4").val();
    var anh5 = $("#data_picture5").val();
    var anh6 = $("#data_picture6").val();
    var anh7 = $("#data_picture7").val();
    var anh8 = $("#data_picture8").val();
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
             dientich : dientich,
             huong : huong,
             diadiem : diadiem,
             tinh : tinh,
             huyen : huyen,
             xa : xa,
             duong : duong,
             diachi : diachi,
             giagoc : giagoc,
             giaban : giaban,
             phisale : phisale,
             anh1 : anh1,
             anh2 : anh2,
             anh3 : anh3,
             anh4 : anh4,
             anh5 : anh5,
             anh6 : anh6,
             anh7 : anh7,
             anh8 : anh8,
             thongtin : thongtin,
             guinguon : guinguon,
             id:<?=$id?>,
             typeform : "suanguonban"
        },
        success : function (result2){
             hideloading();
             window.location.href="/m/nguon/";
        }
    });
    }
});
</script>
        <div class="clearfix"></div>
    </div>
    <??>