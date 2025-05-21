<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $ru['footer']?>
            </div>
        </div>
    </div>
</section>

<!--popup thêm chú thích-->
<div id="droplive"></div>
<img class="imgload" src="i/loading-gif-orange-5.gif" />
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popupnote" id="popupnote">
<span class="x">X</span>
<div class="contentnote"></div>
</div>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popupshowanh" id="popupshowanh">
<span class="x">X</span>
<div class="anhshowtrong"></div>
</div>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popupdanhsach" id="popupdanhsach">
<span id="x" class="x">X</span>
        <p class="titsmall"><i class="fab fa-python"></i> T?o danh sách:</p>
        <form class="form-horizontal" role="form" action="javascript:void(0)" id="form_cart">
          <div class="form-group col-md-12">
            <input type="text" id="tendanhsach" class="form-control" placeholder="Tên danh sách"/>
          </div>
          <button type="submit" class="btn btn-primary buttonnew" id="taodanhsach"><i class="fas fa-plus"></i> T?o danh sách</button> 
          <span id="loadingds" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" height="15"/> Ðang xác nh?n ...</span>
          <div id="thongbaods"></div>
        </form>
</div>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popupdanhsach" id="editpopupkhachhangquantam">
</div>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popupdanhsach" id="popupkhachhangquantam">
<span id="x" class="x">X</span>
        <p class="titsmall"><i class="fab fa-python"></i> Thêm KH quan tâm ð? qu?n l?:</p>
        <form class="form-horizontal" role="form" action="javascript:void(0)" id="form_cart">
          <div class="form-group col-md-12">
            <input type="text" id="timkhquantam" class="form-control" placeholder="G? tên, Sðt ð? t?m"/>
            <input type="hidden" id="quantam_idkhach" />
            <input type="hidden" id="quantam_idnguon" />
            <input type="hidden" id="quantam_sua" value="<?=$idquantam?>" />
          </div>
          <script>
              $('#timkhquantam').keyup(function(){
                $('#quantam_idkhach').val('');
                var keyquantam = $('#timkhquantam').val();
                var idnguon = $('#quantam_idnguon').val(); 
                $.ajax({
                    url : "ajax_nguoiquen.php",
                    type : "post", 
                    dateType:"text", 
                    data : {  
                        keyquantam : keyquantam,
                        idnguon : idnguon,
                        typeform : "timkhquantam"
                    },
                    success : function (result2){
                        $('#hienthikhquantam').html(result2);
                    }
                });
            });
            function chonkhachhangquantam(tenkhach,idkhach){ 
                $('#timkhquantam').val(tenkhach);
                $('#quantam_idkhach').val(idkhach);
                $('.listkhquantam').hide();
            }
          </script>
          <div id="hienthikhquantam"></div>
          <div class="form-group col-md-12">
            <textarea class="form-control" rows="2" id="quantam_ghichu" placeholder="Thêm ghi chú"></textarea>
          </div>
          <div style="color: red;" class="status"></div>
                  <label>H?nh ?nh</label>
            <br />
            <div id="qt_showthu1" class="chonanh" onclick="document.getElementById('qt_main_picture1').click();"></div>
            <input type="file" id="qt_main_picture1" name="qt_image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" name="qt_anh1" id="qt_data_picture1" />
            <div id="qt_showthu2" class="chonanh" onclick="document.getElementById('qt_main_picture2').click();"></div>
            <input type="file" id="qt_main_picture2" name="qt_image2"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="qt_anh2" id="qt_data_picture2" />
            <div id="qt_showthu3" class="chonanh" onclick="document.getElementById('qt_main_picture3').click();"></div>
            <input type="file" id="qt_main_picture3" name="qt_image3"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="qt_anh3" id="qt_data_picture3" />
            <div id="qt_showthu4" style="margin-right: 0;" class="chonanh" onclick="document.getElementById('qt_main_picture4').click();"></div>
            <input type="file" id="qt_main_picture4" name="qt_image4"  style="display: none;" accept="image/*"/> 
            <input type="hidden" name="qt_anh4" id="qt_data_picture4" />
            
            <div class="clearfix"></div>
                <script>
                function qt_readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#qt_showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        qt_uploadimage('qt_main_picture1');
                    }
                }
                $("#qt_main_picture1").change(function() {
                    qt_readURL1(this);
                });
                function qt_readURL2(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#qt_showthu2').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                           
                        }
                        reader.readAsDataURL(input.files[0]);
                        qt_uploadimage('qt_main_picture2');
                    }
                }
                $("#qt_main_picture2").change(function() {
                    qt_readURL2(this);
                });
                function qt_readURL3(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#qt_showthu3').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        qt_uploadimage('qt_main_picture3');
                    }
                }
                $("#qt_main_picture3").change(function() {
                    qt_readURL3(this);
                });
                function qt_readURL4(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#qt_showthu4').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        qt_uploadimage('qt_main_picture4');
                    }
                }
                $("#qt_main_picture4").change(function() {
                    qt_readURL4(this);
                });
                
                function qt_uploadimage(idfile) {
                    //L?y ra files
                    var file_data = $('#'+idfile).prop('files')[0];
                    //l?y ra ki?u file
                    var type = file_data.type;
                    //Xét ki?u file ðý?c upload
                    var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];
                    //ki?m tra ki?u file
                    if (type == match[0] || type == match[1] || type == match[2] || type == match[3]) {
                        //kh?i t?o ð?i tý?ng form data
                        var form_data = new FormData();
                        //thêm files vào trong form data
                        form_data.append('file', file_data);
                        //s? d?ng ajax post
                        $.ajax({
                            url: 'uploads_qt.php', // g?i ð?n file upload.php 
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
                        $('.status').text('Ch? ðý?c upload file ?nh');
                    }
                    return false;
                };
                </script> 
          <button type="submit" class="btn btn-primary buttonnew" id="themquantam"><i class="fas fa-plus"></i> Thêm quan tâm</button> 
          <span id="loadingad" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" height="15"/> Ðang xác nh?n ...</span>
          <div id="thongbaoad" style="float: right;"></div>
        </form>
</div>
<style>
.popupdanhsach,.popupnote,.popupshowanh{
    position: fixed !important;
    z-index: 1000003;
    background: white;
    box-shadow: 0 0 2px grey;
    padding: 20px;
    border-radius: 10px;
    top: 20%;
    display: none;
    transition: display 0.4s 0.1s ease-in-out;
    -moz-transition: display 0.4s 0.1s ease-in-out;
    -webkit-transition: display 0.4s 0.1s ease-in-out;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
}
.popupshowanh{
    padding: 5px 5px 0 5px;
    background: white;
}
.anhshowtrong{
    width: 100%;
    overflow-y: auto;
}
.anhshowtrong img{margin-bottom: 5px; border-radius: 8px;}
.popupshowds{
    display: block;
    transition: display 0.4s 0.1s ease-in-out;
    -moz-transition: display 0.4s 0.1s ease-in-out;
    -webkit-transition: display 0.4s 0.1s ease-in-out;
}
.imgload{
    width: 40%;
    position: fixed;
    top: 30%;
    left: 30%;
    z-index: 9999999;
    display: none;
}
@media all and (min-width: 768px){
    .imgload{
        width: 150px;
        top: 20%;
        left: calc(50% - 75px);left: -moz-calc(50% - 75px);left: -webkit-calc(50% - 75px);
    }
}
</style>
<script type="text/javascript">
function xoanguon(x){
    var checkxn = confirm('B?n ch?c ch?n mu?n xóa n?i dung này?');
    if (checkxn == true) {
         $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i ði
                idnguon : x,
                typeform : "xoanguonban"
            },
            success : function (result2){
                $('#boxme'+x).hide();
            }
            });
    }
    }
function dabannguon(x){
    var checkxn = confirm('B?n ch?c ch?n ngu?n này ð? bán và chuy?n vào lýu tr??');
    if (checkxn == true) {
         $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i ði
                idnguon : x,
                typeform : "dabannguonban"
            },
            success : function (result2){
                $('#boxme'+x).hide();
            }
            });
    }
    }
$(document).ready(function()
{  
    //khai báo nút submit form
    var submit   = $("#taodanhsach");   
    submit.click(function()
    {
        
        //khai báo các bi?n
        var tendanhsach = $("#tendanhsach").val(); //tên tendanhsach
        
        if(tendanhsach == ''){
            $('#tendanhsach').addClass('borderred');
            return false;
        }
        $('#loadingds').show();
        $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i ði
                tendanhsach : tendanhsach,
                idu : 1,
                typeform : "taodanhsach"
            },
            success : function (result2){
                setTimeout(function(){
                        $('#loadingds').hide();
                        $('#thongbaods').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> T?o thành công</p>");
                    }, 1000);
                setTimeout(function(){
                    $('.popupdanhsach').fadeOut();
                    $('#droplive').fadeOut();
                    location.reload();
                }, 1000);
                
            },
            error:function(){
                $('#thongbaods').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có l?i, H?y làm l?i");                 
            }
            });
        return false;
    });
});
function showpopupds(){
    $('#droplive').fadeIn();
    $('#popupdanhsach').show();
}
function showloading(){
    $('#droplive').fadeIn();
    $('.imgload').show();
}
function hideloading(){
    $('#droplive').fadeOut();
    $('.imgload').hide();
}
function showanh(idkhachhang){
    $('#droplive').fadeIn();
    $('.popupshowanh').show();
    var xcao = screen.height;
    
    $.ajax({
        url : "ajax_nguoiquen.php",
        type : "post", 
        dateType:"text", 
        data : { 
            idkhachhang : idkhachhang,
            typeform : "showanhkhachhang"
        },
        success : function (result2){
            var trav=result2.split('***');
            if(Number(trav[0])==0){
                $('.anhshowtrong').html(trav[1]);
                $('.anhshowtrong').css('height','auto');
                $('.popupshowanh').css('top','20%');
            }else{
                $('.anhshowtrong').css('height',xcao-150);
                $('.popupshowanh').css('top','40px');
                $('.anhshowtrong').html(trav[1]);
            }
        }
    });
}

function addkhachhangquantam(idnguon){
    $('#droplive').fadeIn();
    $('.popupdanhsach').show();
    $('#quantam_idnguon').val(idnguon);
    $('#editpopupkhachhangquantam').hide();
    $('#editpopupkhachhangquantam').html('');
}
$('#addkhachhangquantam').click(function(){
    $('#quantam_idkhach').val('');
    var keyquantam = $('#timkhquantam').val();
    var idnguon = $('#quantam_idnguon').val(); 
    $.ajax({
        url : "ajax_nguoiquen.php",
        type : "post", 
        dateType:"text", 
        data : { 
            keyquantam : keyquantam,
            idnguon : idnguon,
            typeform : "timkhquantam"
        },
        success : function (result2){
            $('#hienthikhquantam').html(result2);
        }
    });
});
$(document).ready(function()
{  
    var submit   = $("#themquantam");   
    submit.click(function()
    {
        var idkhach = $('#quantam_idkhach').val();
        var idnguon = $('#quantam_idnguon').val();
        var ghichu = $('#quantam_ghichu').val();
        var anh1 = $('#qt_data_picture1').val();
        var anh2 = $('#qt_data_picture2').val();
        var anh3 = $('#qt_data_picture3').val();
        var anh4 = $('#qt_data_picture4').val();
        var quantam_sua = $('#quantam_sua').val();
        if(idkhach == ''){
            $('#timkhquantam').addClass('borderred');
            setTimeout(function(){
               $('#timkhquantam').removeClass('borderred');
            }, 2000);
            return false;
        }
        $('#loadingad').show();
        $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i ði
                idkhach : idkhach,
                idnguon : idnguon,
                ghichu : ghichu,
                quantam_sua : quantam_sua,
                anh1 : anh1,
                anh2 : anh2,
                anh3 : anh3,
                anh4 : anh4,
                typeform : "themkhachquantam"
            },
            success : function (result2){
                setTimeout(function(){
                        $('#loadingad').hide();
                        $('#thongbaoad').html("<span style='color: #4CAF50;padding-top: 15px;line-height: 33px;'><i class=\"far fa-check-circle\"></i> Thành công</span>");
                    }, 0);
                setTimeout(function(){
                    $('.popupdanhsach').fadeOut();
                    $('#droplive').fadeOut();
                    //location.reload();
                    $('#khquantam'+idnguon).html(result2);
                }, 2000);
                
            },
            error:function(){
                $('#thongbaoad').html("<span style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có l?i, H?y làm l?i</span>");                 
            }
            });
        return false;
    });
});
function deletekhquantam(idkh,idnguon){
    $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", 
            data : { 
                idkh : idkh,
                idnguon : idnguon,
                loai : 'xoaquantam',
                typeform : "themkhachquantam"
            },
            success : function (result2){
                $('#khquantam'+idnguon).html(result2);
            }
            });
}
function editkhquantam(idquantam){
    $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", 
            data : { 
                idquantam : idquantam,
                typeform : "editkhachhangquantam"
            },
            success : function (result2){
                $('#droplive').fadeIn();
                $('#editpopupkhachhangquantam').show();
                $('#editpopupkhachhangquantam').html(result2);
            }
            }); 
}
$(function() {
$('#showdanhsach').click(function(){
        $('#droplive').fadeIn();
        $('.popupdanhsach').show();
});
$('#droplive').click(function(){
        $('.popupdanhsach').fadeOut();
        $('.imgload').fadeOut();
        $('#droplive').fadeOut();
        $('#popupshowanh').fadeOut();
        $('#popupdanhsach').removeClass('hienthi');
});
$('.x').click(function(){
        $('.popupdanhsach').fadeOut();
        $('.popupnote').fadeOut();
        $('.imgload').fadeOut();
        $('#droplive').fadeOut();
        $('#popupshowanh').fadeOut();
});

});
</script>

<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 popuplive" id="popuplive">
<span id="x" class="x">X</span>
        <p class="titsmall"><i class="fab fa-python"></i> Thêm chú thích:</p>
        <p>Khách hàng <b id="tenkhachhang"></b></p>
        <form class="form-horizontal" role="form" action="javascript:void(0)" id="form_cart">
          <div class="form-group col-md-12">
            <textarea class="form-control" rows="3" name="ghichu" id="ghichu"></textarea>
            <input type="hidden" id="idkhach" class="form-control"/>
            <input type="hidden" id="diemtiemnang" class="form-control"/>
            <p class="diem">
            <!--span>Ði?m: </span-->
            <span id="s1">1</span>
            <span id="s2">2</span>
            <span id="s3">3</span>
            <span id="s4">4</span>
            <span id="s5">5</span>
            <span id="s6">6</span>
            <span id="s7">7</span>
            <span id="s8">8</span>
            <span id="s9">9</span>
            <span id="s10">10</span>
            </p>
          </div>
          <button type="submit" class="btn btn-primary" id="themghichu"><i class="fas fa-plus"></i> Thêm chú thích</button> 
          <span id="loading" style="font-size: 0.9em;color: #2196F3;font-style: italic; display: none;"><img src="i/loading.gif" height="15"/> Ðang xác nh?n ...</span>
          <div id="thongbao"></div>
        </form>
<style>
p.diem{}
p.diem span{
    padding: 10px 6px 4px 6px;
    border-bottom: 3px solid #ececec;
    margin-left: 1px;
    cursor: pointer;
}
p.diem span.xanh{
    border-color: #2196F3;
    color: #2196F3;
}
p.diem i{}
.borderred{border-color: red;}
.popuplive{
    position: fixed !important;
    z-index: 1000003;
    background: white;
    box-shadow: 0 0 2px grey;
    padding: 20px;
    border-radius: 10px;
    top: 20%;
    display: none;
    transition: display 0.4s 0.1s ease-in-out;
    -moz-transition: display 0.4s 0.1s ease-in-out;
    -webkit-transition: display 0.4s 0.1s ease-in-out;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
}
.popupshow{
    display: block;
    transition: display 0.4s 0.1s ease-in-out;
    -moz-transition: display 0.4s 0.1s ease-in-out;
    -webkit-transition: display 0.4s 0.1s ease-in-out;
}
#droplive{
    width: 100%;
    height: 700px;
    background: rgba(0, 0, 0, 0.75);
    z-index: 1000001;
    position: fixed;
    top: 0;
    left: 0;
    display: none;
}
.x{
    position: absolute;
    top: -10px;
    right: -10px;
    /* padding: 10px; */
    background: white;
    color: red;
    border-radius: 50%;
    box-shadow: 0 0 6px #868484;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    font-weight: bold;
    cursor: pointer;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{  
    //khai báo nút submit form
    var submit   = $("#themghichu");   
    submit.click(function()
    {
        
        //khai báo các bi?n
        var ghichu = $("#ghichu").val(); //tên khách hàng
        var diemtiemnang = $("#diemtiemnang").val(); //sdt khách hàng  
        var idkhach=$("#idkhach").val(); //ð?a ch? khách hàng
        if(ghichu == ''){
            $('#ghichu').addClass('borderred');
            return false;
        }
        $('#loading').show();
        $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i ði
                ghichu : ghichu,
                diemtiemnang : diemtiemnang,
                idkhach : idkhach,
                typeform : "addkh"
            },
            success : function (result2){
                setTimeout(function(){
                        $('#loading').hide();
                        $('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Thêm thành công</p>");
                    }, 1000);
                setTimeout(function(){
                    $('.popuplive').fadeOut();
                    $('.popupfeedback').fadeOut();
                    $('#droplive').fadeOut();
                    var htmlcu = $('#note'+idkhach).html();
                    var ganhtml = '<p class="note">' + result2 + '</p>' + htmlcu;
                    $('#note'+idkhach).html(ganhtml);
                    $('#diem'+idkhach).html(diemtiemnang);
                    if(Number(diemtiemnang)>0){
                        $('#ddiem'+idkhach).show();
                    }else{
                        $('#ddiem'+idkhach).hide();
                    }
                    $('#thongbao').html('');
                    $('#s1').removeClass('xanh');
                    $('#s2').removeClass('xanh');
                    $('#s3').removeClass('xanh');
                    $('#s4').removeClass('xanh');
                    $('#s5').removeClass('xanh');
                    $('#s6').removeClass('xanh');
                    $('#s7').removeClass('xanh');
                    $('#s8').removeClass('xanh');
                    $('#s9').removeClass('xanh');
                    $('#s10').removeClass('xanh');
                    $('#diemtiemnang').val('0');
                    $("#ghichu").val('');
                    //window.location="/m/khachhang/";
                }, 2000);
                
            },
            error:function(){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có l?i, H?y làm l?i");                 
            }
            });
        return false;
    });
});
function showthongtin(id){
    $.ajax({
            url : "ajax.php",
            type : "post", 
            dateType:"text",
            data : { 
                id : id,
                typeform : "showthongtinuser"
            },
            success : function (result2){
               shownote(result2);
            }
    });
}
function showpopup(){
    $('#droplive').fadeIn();
    $('.popuplive').show();
}
function shownote(text){
    $('#droplive').fadeIn();
    $('.contentnote').html(text);
    $('.popupnote').show();
}
function uptopnguonban(idnguon){
    $('#droplive').fadeIn();
    $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text",
            data : {
                idnguon : idnguon,
                typeform : "uptopnguonban"
            },
            success : function (result2){
                $('.contentnote').html(result2);
                $('.popupnote').show();
                setTimeout(function(){
                    $('.contentnote').html('');
                    $('.popupnote').fadeOut();
                    $('#droplive').fadeOut();
                }, 5000); 
            }
            });
} 

$(function() {
$('#showpopup').click(function(){
//$("body,html").animate({scrollTop: 0}, "slow");
        $('#droplive').fadeIn();
        $('.popuplive').show();
});
$('#droplive').click(function(){
        $('.popuplive').fadeOut();
        $('.popupdaily').fadeOut();
        $('.popupnote').fadeOut();
        $('.popupfeedback').fadeOut();
        $('#droplive').fadeOut();
        $('#popuplive').removeClass('hienthi');
});
$('.x').click(function(){
        $('.popuplive').fadeOut();
        $('.popupdaily').fadeOut();
        $('.popupnote').fadeOut();
        $('.popupfeedback').fadeOut();
        $('#droplive').fadeOut();
});
$('#s1').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').removeClass('xanh');
                        $('#s3').removeClass('xanh');
                        $('#s4').removeClass('xanh');
                        $('#s5').removeClass('xanh');
                        $('#s6').removeClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('1');
                });
                $('#s2').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').removeClass('xanh');
                        $('#s4').removeClass('xanh');
                        $('#s5').removeClass('xanh');
                        $('#s6').removeClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('2');
                });
                $('#s3').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').removeClass('xanh');
                        $('#s5').removeClass('xanh');
                        $('#s6').removeClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('3');
                });
                $('#s4').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').removeClass('xanh');
                        $('#s6').removeClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('4');
                });
                $('#s5').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').removeClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('5');
                });
                $('#s6').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').addClass('xanh');
                        $('#s7').removeClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('6');
                });
                $('#s7').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').addClass('xanh');
                        $('#s7').addClass('xanh');
                        $('#s8').removeClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('7');
                });
                $('#s8').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').addClass('xanh');
                        $('#s7').addClass('xanh');
                        $('#s8').addClass('xanh');
                        $('#s9').removeClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('8');
                });
                $('#s9').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').addClass('xanh');
                        $('#s7').addClass('xanh');
                        $('#s8').addClass('xanh');
                        $('#s9').addClass('xanh');
                        $('#s10').removeClass('xanh');
                        $('#diemtiemnang').val('9');
                });
                $('#s10').click(function(){
                        $('#s1').addClass('xanh');
                        $('#s2').addClass('xanh');
                        $('#s3').addClass('xanh');
                        $('#s4').addClass('xanh');
                        $('#s5').addClass('xanh');
                        $('#s6').addClass('xanh');
                        $('#s7').addClass('xanh');
                        $('#s8').addClass('xanh');
                        $('#s9').addClass('xanh');
                        $('#s10').addClass('xanh');
                        $('#diemtiemnang').val('10');
                });
});
</script>
</div>