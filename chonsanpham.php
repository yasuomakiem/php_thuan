<?php
session_start();
//if(isset($_COOKIE['iduser'])){
//   header("Location: /m/cpanel/");
//   exit;
//}
require_once('include/connect.php');
require_once('include/function.php');
$idu=intval($_GET['idu']);
?>
<!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>

<meta charset="UTF-8" />
<base href="<?php echo $domain?>" />
<meta name="robots" content="all" />		
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
<meta name="description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng          "/>		
<title>Chọn sản phẩm mẫu để bắt đầu hướng dẫn làm tiếp thị liên kết</title>
<meta property="description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng          "/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="Chọn sản phẩm mẫu để bắt đầu hướng dẫn làm tiếp thị liên kết"/>
<meta property="og:image" content=""/>
<meta property="og:description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng          "/>
<meta property="og:url" content="https://kiemtien.today/sanpham/"/>
<meta property="og:site_name" content="Chọn sản phẩm mẫu để bắt đầu hướng dẫn làm tiếp thị liên kết"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Là nền tảng kinh doanh trực tuyến mới kết nối nhà máy với trực tiếp người tiêu dùng          " />
<meta name="twitter:title" content="Chọn sản phẩm mẫu để bắt đầu hướng dẫn làm tiếp thị liên kết" />
<meta name="twitter:image" content="" />	
<link rel="icon" href="/i/house.png" type="image/x-icon" />		

<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&amp;display=swap&amp;subset=vietnamese" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/j/bootstrap.min.js"></script>	
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>
<style>
body{
    background-image: url(images/bgdoinhompc2.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;
    background-attachment: fixed;
}
.nguonban .ttk a.btn {
    font-size: 15px;
    width: 100%;
    margin-right: 1%;
    height: 40px;
    margin-bottom: 5px;
    line-height: 27px;
}
.titcart{}
</style>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<script src='j/land.js'></script>
</head>
<body>
<section class="main">	
    <div class="container" style="width: 100%;">
    <div class="bigmem cpanel">
    <div class="groupteam">
    <?php
    if(isset($_GET['idsp'])){
        $idsp=intval($_GET['idsp']);
        $sanpham=@mysqli_query($con,"select * from dh_sanpham where id=$idsp");
        $rnguon=@mysqli_fetch_assoc($sanpham);
            ?>
            <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                    <h4 style="color: #009688;text-align: center;line-height: 25px;padding: 10px;margin-bottom: -10px;background: aliceblue;font-size: 18px;"><?php  echo $rnguon['ten']?></h4>
                            <div class="anhnguon">
                                <div class="simg bonanh_1"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh']?>');"></div>
                                <div class="simg bonanh_2"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh2']?>');"></div>
                                <div class="simg bonanh_3"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh3']?>');"></div>
                                <div class="simg bonanh_4"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh4']?>');">
                                    <div class="conganh">+ 2</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                    <div class="ppp">
                        <div class="pcon" style="text-align: center;">Giá NY: <?php  echo number_format($rnguon['giacu'],0,',','.')?><sup>đ</sup></div>
                        <div class="pcon" style="text-align: center;">Giá bán: <b style="color: red;"><?php  echo number_format($rnguon['gia'],0,'.',',')?></b><sup>đ</sup></div>
                        <div class="clearfix"></div>
                        <hr style="border-color: #c1c4c4;margin: 8px 0 12px;" />
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH Chính <sup>(<?php echo $rnguon['pt_coban'].'%';?>)</sup><br /> <b style="color: #FF0080;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_coban']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH Bignet <sup>(<?php echo $rnguon['pt_them'].'%';?>)</sup><br /> <b style="color: #008040;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_them']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH 3 Đơn <sup>(<?php echo $rnguon['pt_3don'].'%';?>)</sup><br /> <b style="color: #804000;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_3don']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">Tổng HH <sup>(<?php echo $rnguon['pt_coban']+$rnguon['pt_them']+$rnguon['pt_3don'].'%';?>)</sup> <br /><b style="color: red;"><?php  echo number_format($rnguon['gia']*($rnguon['pt_coban']+$rnguon['pt_them']+$rnguon['pt_3don'])/100,0,',','.')?><sup>đ</sup></b></div>
                        
                        
                        <div class="clearfix"></div>
                        
                    </div>
                    <h3 class="titUT">Chọn thêm <span style="color: red;">sản phẩm bổ trợ</span></h3>
                    <div class="ttk">
                    
                    <div>
                    <img style="width: 24%; float: left; margin-right: 4%;margin-top: 15px;" src="images/banxoay.jpg" />
                    
                    <div class="checkbox" style="width: 70%;float: right;">
                        <h4>Bàn xoay nhỏ</h4>
                        <label>
                          <input class="items" id="banxoay" value="1" type="checkbox" data-price="60000"> Giá: <b>60.000đ</b>
                        </label>
                        <p style="margin-top: 15px;"><i>Phục vụ cho việc Livestream, live giấy mặt và live cắm máy không thể thiếu sản phẩm này. Nếu bạn có rồi thì bỏ qua, nhưng nễu chưa cho thì nhất thiết phải chọn mua mới làm việc được</i></p>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    <div>
                    <img style="width: 24%; float: left; margin-right: 4%;margin-top: 15px;" src="images/chankep.jpg" />
                    <div class="checkbox" style="width: 70%;float: right;">
                        <h4>Chân kẹp điện thoại</h4>
                        <label>
                          <input class="items"  id="chanquay" value="1" type="checkbox" data-price="15000"> Giá: <b>15.000đ</b>
                        </label>
                        <p style="margin-top: 15px;"><i>Phục vụ cho việc Livestream, làm video. Nếu bạn có rồi thì bỏ qua, nhưng nễu chưa cho thì nhất thiết phải chọn mua mới làm việc được</i></p>
                    </div>
                    <div class="clearfix"></div>
                    <input type="hidden" id="tongtien" value="<?php echo $rnguon['gia']?>" />
                    <h4><i class="fas fa-shopping-cart"></i> Tổng tiền cần thanh toán: <b style="color: red;" id="showtongtien"><?php echo number_format($rnguon['gia'],0,',','.')?><sup>đ</sup></b></h4>
                    </div>
                    <h3 class="titUT">Thông tin <span style="color: red;">nhận hàng</span></h3>
                    <div id="hoanthanh">
                    <p class="help-block" style="font-style: italic;"><i class="fas fa-donate"></i> Thanh toán khi nhận hàng (COD).</p>
                    <form style="padding-top: 15px;">
                  <div class="form-group">
                    <input type="text" class="form-control" id="ten" placeholder="Họ tên người nhận *"/>
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại *"/>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ nhận hàng *"/>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" rows="3" id="ghichu" placeholder="Ghi chú đơn hàng"></textarea>
                  </div>
                  <div id="error-message" style="color: red; text-align: center; font-style: italic;"></div>
                  <input type="hidden" id="reff" value="<?php echo $idu?>" />
                  <input type="hidden" id="nguon" value="Chọn sản phẩm" />
                  <button type="button" style="width: 100%;" class="btn btn-success guidonhang" id="guidonhang"><i class="fas fa-paper-plane"></i> Gửi đơn hàng</button>
                  
                </form>
                </div>
                    </div>
                    <script>
                    $(document).ready(function() {
                        $('.items').change(function() {
                            var tongTienElement = $('#tongtien');
                            var showtongTien = $('#showtongtien');
                            var tongTien = parseInt(tongTienElement.val());
                            var price = parseInt($(this).data('price'));
                            
                            if ($(this).prop('checked')) {
                                tongTien += price;
                            } else {
                                tongTien -= price;
                            }
                            
                            tongTienElement.val(tongTien);
                            $('#showtongtien').html(tongTien.toLocaleString('vi-VN') + '<sup>đ</sup>');
                        });
                    $("#guidonhang").click(function(){
                      var ten = $("#ten").val();
                      var sdt = $("#sdt").val();
                      var diachi = $("#diachi").val();
                      var ghichu = $('#ghichu').val();
                      var reff= $('#reff').val();
                      var nguon = $('#nguon').val();
                      var chanquay = $('#chanquay').is(':checked') ? $('#chanquay').val() : 0;
                      var banxoay = $('#banxoay').is(':checked') ? $('#banxoay').val() : 0;
                      // Kiểm tra dữ liệu nhập vào
                      if (ten === "" || sdt === "" || diachi === "") {
                        $("#error-message").html("<p><i class='fas fa-exclamation-triangle'></i> Vui lòng nhập đầy đủ thông tin.<p>");
                        setTimeout(function(){
                            $("#error-message").text("");
                        },5000)
                        return;
                      }
                
                      // Kiểm tra định dạng số điện thoại Việt Nam
                      var phoneNumberRegex = /^(0[1-9])+([0-9]{8,9})$/;
                      if (!phoneNumberRegex.test(sdt)) {
                        $("#error-message").html("<p><i class='fas fa-exclamation-triangle'></i> Định dạng số điện thoại không hợp lệ.<p>");
                        setTimeout(function(){
                            $("#error-message").text("");
                        },5000)
                        return;
                      }
                
                      // Nếu không có lỗi, tiến hành gửi dữ liệu bằng AJAX
                      $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        dateType:"text",
                        data : { 
                            typeform : 'dathangchonsanpham',
                            ten : ten,
                            sdt : sdt,
                            diachi : diachi,
                            ghichu : ghichu,
                            nguon : nguon,
                            reff : reff,
                            chanquay:chanquay,
                            banxoay:banxoay,
                            idsanpham : <?php echo $idsp?>
                            },
                            success : function (data1){
                                $('#hoanthanh').html(data1);
                                setTimeout(function(){close();},15000);
                        },
                        error: function(error) {
                          console.log("Lỗi khi gửi dữ liệu: " + error);
                        }
                      });
                    });
                    });
                    </script>
                </div>
                </div>
<?php
    }else{
        $sanpham=@mysqli_query($con,"select * from dh_sanpham where chonsanpham=1 order by id desc");
        $sosanpham=@mysqli_num_rows($sanpham);
        if($sosanpham>0){
            while($rnguon=@mysqli_fetch_assoc($sanpham)){
            ?>
            <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                    <h4 style="color: #009688;text-align: center;line-height: 25px;padding: 10px;margin-bottom: -10px;background: aliceblue;font-size: 18px;"><?php  echo $rnguon['ten']?></h4>
                            <div class="anhnguon">
                                <div class="simg bonanh_1"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh']?>');"></div>
                                <div class="simg bonanh_2"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh2']?>');"></div>
                                <div class="simg bonanh_3"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh3']?>');"></div>
                                <div class="simg bonanh_4"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh4']?>');">
                                    <div class="conganh">+ 2</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                    <div class="ppp">
                        <div class="pcon" style="text-align: center;">Giá NY: <?php  echo number_format($rnguon['giacu'],0,',','.')?><sup>đ</sup></div>
                        <div class="pcon" style="text-align: center;">Giá bán: <b style="color: red;"><?php  echo number_format($rnguon['gia'],0,'.',',')?></b><sup>đ</sup></div>
                        <div class="clearfix"></div>
                        <hr style="border-color: #c1c4c4;margin: 8px 0 12px;" />
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH Chính <sup>(<?php echo $rnguon['pt_coban'].'%';?>)</sup><br /> <b style="color: #FF0080;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_coban']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH Bignet <sup>(<?php echo $rnguon['pt_them'].'%';?>)</sup><br /> <b style="color: #008040;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_them']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">HH 3 Đơn <sup>(<?php echo $rnguon['pt_3don'].'%';?>)</sup><br /> <b style="color: #804000;"><?php  echo number_format($rnguon['gia']*$rnguon['pt_3don']/100,0,',','.')?><sup>đ</sup></b></div>
                        <div class="pcon" style="text-align: center;line-height: 25px;color: #585858;">Tổng HH <sup>(<?php echo $rnguon['pt_coban']+$rnguon['pt_them']+$rnguon['pt_3don'].'%';?>)</sup> <br /><b style="color: red;"><?php  echo number_format($rnguon['gia']*($rnguon['pt_coban']+$rnguon['pt_them']+$rnguon['pt_3don'])/100,0,',','.')?><sup>đ</sup></b></div>
                        
                        
                        <div class="clearfix"></div>
                        
                    </div>
                    
                    <div class="ttk">
                        <a type="button" class="btn btn-success" href="<?php echo $idu?>/chonsanpham/<?php echo $rnguon['id']?>"><i class="fas fa-recycle"></i> Chọn sản phẩm mẫu này</a>
                    </div>
                </div>
                </div>
            <?php  }?>
            
            <?php 
        } 
        }
    ?>                   
                </div>
    <div class="clearfix"></div>
</div>
             </div>
</section>

</body>
</html>