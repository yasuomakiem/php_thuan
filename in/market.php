<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> <?php  echo $ru['viettatteam']?></a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr">
        <img src="i/nguon.jpg" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Sản phẩm hệ thống</b></p>
            <p style="color: #555; font-size: 0.9em;line-height: 20px;margin-bottom: 5px;"><i class="fab fa-magento"></i> Tổng số: <b id="sosanpham"></b> sản phẩm</p>
            <p style="color: #555; font-size: 0.85em;line-height: 20px;"><i class="fas fa-hand-holding-usd"></i> Ví mua: <b style="color: red;"><?php echo number_format($sodu,0,',','.')?><sup>đ</sup></b></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="groupteam" style="position: relative;">
    <style>
        .addc{
            width: 35%;
            height: 100px;
            background-position: center;
            background-size: cover;
            margin-top: 10px;
            float: left;
        }
        .ttc{
            width: 62%;
            float: right;
        }
        .ttc h4{
            font-size: 14px;
            font-weight: 600;
        }
        .ttc p{margin-bottom: 5px;}
        .ttc p.gia b{color: red;}
        .themcart{margin-top: 15px;}
        .themcart input{text-align: center;}
        .themcart span.input-group-addon{
            cursor: pointer;
        }
        .ttin{
            width: 100%;
            position: fixed;
            bottom: 0;
            background: #fff;
            max-width: 420px;
            margin-left: -17px;
            padding: 10px 20px;
            z-index: 100;
            box-shadow: 0 -1px 40px 0px gray;
        }
    </style>
    <?php 
        if($u['level']==0){
                    $chietkhau=0;
                }elseif($u['level']==1){
                    $chietkhau=$ru['phantramctv'];
                }else{
                    $chietkhau=$ru['phantramnpp'];
                }
        $sanpham=@mysqli_query($con,"select * from dh_sanpham order by id desc");
        $sosanpham=@mysqli_num_rows($sanpham);
    ?>
    <script language="javascript">$('body').ready(function(){$("#sosanpham").html(<?php echo $sosanpham?>);});</script>
    <?php
    if(isset($_GET['cart'])){
        $cart = addslashes($_GET['cart']);
        $cart=str_replace("++"," ",$cart);
        $cart=str_replace("+"," ",$cart);
        $cart=str_replace("  "," ",$cart);
        $cart=trim($cart);
        $dj=explode(' ',$cart);
        ?>
        <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px; margin-left: 15px;margin-top: 30px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel</a> / <a href="/m/sanpham/" style="color: #333;"> Sản phẩm </a> / <span style="color: red;">Thông tin đơn hàng</span> </h3>
        <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                <p style="padding-top: 10px;"><b><i class="fab fa-opencart"></i> Danh sách sản phẩm</b></p>
                <hr />
                <?php 
                $tongtien=0;
                for($i=0;$i<count($dj);$i++){
                    $scart=$dj[$i];
                    $stach=explode('-',$scart);
                    $idsp=$stach[0];$soluong=$stach[1];
                    $sp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
                    echo '<p style="font-weight: bold;color: #009688;">'.($i+1).'. '.$sp['ten'].'</p>';   
                    echo '<p sttle="font-size: 0.85em;">&nbsp;&nbsp;&nbsp;&nbsp;Giá nhập: <span style="font-weight: 700;color: red;">'.number_format(($sp['gia']*(1-$chietkhau/100)),0,',','.').'đ</span><span style="font-size: 0.9em;text-decoration: line-through;color: darkgray;">'.number_format($sp['gia'],0,',','.').'đ</span></p>'; 
                    echo '<p sttle="font-size: 0.85em;">&nbsp;&nbsp;&nbsp;&nbsp;Số lượng: <span>'.$soluong.'</span> <span style="float: right;">Thành tiền: <i style="color:red">'.number_format(($sp['gia']*(1-$chietkhau/100)*$soluong),0,',','.').'đ</i></span></p>';
                    $tongtien=$tongtien+($sp['gia']*(1-$chietkhau/100)*$soluong);
                } 
                ?>
                <hr />
                <p>Tổng số tiền: <span style="float: right;"><b style="color: red;"><?php echo number_format($tongtien,0,',','.');?><sup>đ</sup></b></span></p>
                </div>
        </div>
        <style>
        .alert {
            color: red;
            display: none;
        }
        .error-message{
            font-size: 0.8em;
            color: red;
            font-style: italic;
        }
        .alert-success {
            color: green;
            display: none;
        }
    </style>
        <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                <p style="padding-top: 10px;"><b><i class="fas fa-address-card"></i> Thông tin nhận hàng</b></p>
                <hr />
                <form>
                <div class="alert" id="alert"></div>
                <div class="alert-success" id="success-alert"></div>
                  <div class="form-group">
                  
                    <label>Họ tên <sup style="color: red;">*</sup></label>
                    <input type="text" class="form-control" id="ten" placeholder="Họ tên người nhận hàng" value="<?php echo $u['fullname']?>"/>
                    <div class="error-message" id="ten-error"></div>
                  </div>
                  <div class="form-group">
                    <label>Số điện thoại <sup style="color: red;">*</sup></label>
                    <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại nhận hàng" value="<?php echo $u['phone']?>"/>
                    <div class="error-message" id="sdt-error"></div>
                  </div>
                  <div class="form-group">
                    <label>Địa chỉ <sup style="color: red;">*</sup></label>
                    <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ người nhận hàng" value="<?php echo $u['address']?>"/>
                    <div class="error-message" id="diachi-error"></div>
                  </div>
                  <div class="form-group">
                    <label>Ghi chú đơn hàng</label>
                    <textarea class="form-control" id="note" rows="3"></textarea>
                  </div>
                  <button type="button" id="guidonhang" class="btn btn-primary">Gửi đơn hàng</button>
                </form>
                </div>
                <script>
        $(document).ready(function(){
            function validatePhoneNumber(phone) {
                var phoneRegex = /^(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/;
                return phoneRegex.test(phone);
            }

            $("#guidonhang").click(function(){
                var ten = $("#ten").val().trim();
                var sdt = $("#sdt").val().trim();
                var diachi = $("#diachi").val().trim();
                var note = $("#note").val().trim();
                var isValid = true;
                $("#guidonhang").hide();
                if (ten === '') {
                    $("#ten-error").html('<i class="fas fa-exclamation-triangle"></i> Họ tên là bắt buộc.').fadeIn();
                    isValid = false;
                }
                if (sdt === '') {
                    $("#sdt-error").html('<i class="fas fa-exclamation-triangle"></i> Số điện thoại là bắt buộc.').fadeIn();
                    isValid = false;
                } else if (!validatePhoneNumber(sdt)) {
                    $("#sdt-error").html('<i class="fas fa-exclamation-triangle"></i> Số điện thoại không hợp lệ.').fadeIn();
                    isValid = false;
                }
                if (diachi === '') {
                    $("#diachi-error").html('<i class="fas fa-exclamation-triangle"></i> Địa chỉ là bắt buộc.').fadeIn();
                    isValid = false;
                }

                if (!isValid) {
                    setTimeout(function(){
                        $(".error-message").fadeOut();
                        $("#guidonhang").show();
                    }, 5000);
                    return;
                }

                $.ajax({
                    url : "ajax.php",
                    type : "post", 
                    dateType:"text", 
                    data: {
                        typeform : "guidonhang",
                        ten: ten,
                        sdt: sdt,
                        diachi: diachi,
                        note: note,
                        tien: <?php echo $tongtien;?>,
                        chietkhau: <?php echo $chietkhau;?>,
                        chuoi:"<?php echo $cart;?>"
                    },
                    success : function (result2){
                        if (Number(result2) == 0) {
                            $("#alert").html('<i class="fas fa-exclamation-triangle"></i> Đã xảy ra lỗi. Vui lòng thử lại.').fadeIn();
                            setTimeout(function(){
                                $("#alert").fadeOut();
                            }, 5000);
                        } else if (Number(result2) == 1) {
                            $("#success-alert").html('<p style="text-align: center;padding: 10px;"><i class="fas fa-check"></i> Gửi đơn hàng thành công!</p>').fadeIn();
                            setTimeout(function(){
                                $("#success-alert").fadeOut();
                                window.location.href = "/m/sanpham/";
                            }, 5000);
                        }
                        //$("#guidonhang").show();
                    },
                    error: function() {
                        $("#alert").html('<i class="fas fa-exclamation-triangle"></i> Đã xảy ra lỗi khi gửi yêu cầu.').fadeIn();
                        setTimeout(function(){
                            $("#alert").fadeOut();
                        }, 5000);
                        $("#guidonhang").show();
                    }
                });
            });
        });
    </script>
        </div>
        <?php
    }elseif(isset($_GET['id'])){
        $idsp=intval($_GET['id']);
        $sp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
        ?>
        <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px; margin-left: 15px;margin-top: 30px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel</a> / <a href="/m/sanpham/" style="color: #333;"> Sản phẩm </a> / <span style="color: red;">Thông tin sản phẩm</span> </h3>
        <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                <p style="padding-top: 10px;"><b><i class="fab fa-opencart"></i> <?php echo $sp['ten']?></b></p>
                <hr />
                <img src="upload/sanpham/<?php  echo $sp['anh']?>" style="width: 100%;margin-bottom: 15px;" />
                <div class="chitietsp">
                    <?php echo $sp['thongtin']?>
                </div>
                </div>
        </div>
        <?php
    }else{
            while($rnguon=@mysqli_fetch_assoc($sanpham)){
                $giasauck=$rnguon['gia']*(1-$chietkhau/100);
            ?>
            
            <div class="boxme" style="margin-bottom: 15px;">
                <div class="nguonban">
                    <div id="ssp" class="ssp">
                        <a href="/m/sanpham/?id=<?php echo $rnguon['id']?>"><div class="addc"  style="background-image: url('upload/sanpham/<?php  echo $rnguon['anh']?>');"></div></a>
                        <div class="ttc">
                        <h4><a href="/m/sanpham/?id=<?php echo $rnguon['id']?>"><?php  echo $rnguon['ten']?></a></h4>
                        <p class="gia giale">Giá bán lẻ: <b><?php  echo number_format($rnguon['gia'],0,',','.')?><sup>đ</sup></b></p>
                        <p class="gia giack">Chiết khấu <i style="font-size: 0.8em;">(-<?php echo $chietkhau;?>%)</i>: <b><?php  echo number_format($giasauck,0,',','.')?><sup>đ</sup></b></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                    <div class="col-md-6 col-sm-6  col-xs-12 themcart">
                    <div class="input-group ">
                      <span class="input-group-addon" id="tru_<?php echo $rnguon['id'];?>">-</span>
                      <input type="number" id="soluong_<?php echo $rnguon['id'];?>" class="form-control" value="0">
                      <input type="hidden" id="truoc_soluong_<?php echo $rnguon['id'];?>" class="form-control" value="0">
                      <span class="input-group-addon" id="cong_<?php echo $rnguon['id'];?>">+</span>
                    </div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6 themcart" style="line-height: 30px;">
                      = <b id="tien_<?php echo $rnguon['id'];?>">0<sup>đ</sup></b>
                    </div>
                    <input type="hidden" id="giasauck_<?php echo $rnguon['id'];?>" value="<?php echo $giasauck;?>" />
                    <input type="hidden" class="tong" id="tienhang_<?php echo $rnguon['id'];?>" value="0" />
                    <input type="hidden" id="ck_<?php echo $rnguon['id'];?>" value="<?php echo $chietkhau;?>" />
                    <div class="clearfix"></div>
                    </div>
                    <script>
                    $(document).ready(function() {
                        // Hàm để cập nhật tiền
                        function updateTien<?php echo $rnguon['id'];?>() {
                            let soluong<?php echo $rnguon['id'];?> = parseInt($('#soluong_<?php echo $rnguon['id'];?>').val());
                            let giasauck<?php echo $rnguon['id'];?> = parseInt($('#giasauck_<?php echo $rnguon['id'];?>').val());
                            let ck<?php echo $rnguon['id'];?> = parseInt($('#ck_<?php echo $rnguon['id'];?>').val());
                            let tien<?php echo $rnguon['id'];?> = soluong<?php echo $rnguon['id'];?> * giasauck<?php echo $rnguon['id'];?>;
            
                            // Định dạng tiền với dấu chấm động
                            $('#tien_<?php echo $rnguon['id'];?>').text(tien<?php echo $rnguon['id'];?>.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                            $('#tienhang_<?php echo $rnguon['id'];?>').val(tien<?php echo $rnguon['id'];?>);
                            let sum = 0;
                            $('.tong').each(function() {
                                let value = parseInt($(this).val());
                                if (!isNaN(value)) {
                                    sum += value;
                                }
                            });
                            let sodumoi = <?php echo $sodu;?> - sum;
                            if(sodumoi > 0 && sodumoi < <?php echo $sodu;?>){$('#cartbottom').show();}else{$('#cartbottom').hide();}
                            if(sodumoi>=0){
                                $('#truoc_soluong_<?php echo $rnguon['id'];?>').val(soluong<?php echo $rnguon['id'];?>);
                                $('#intongsodu').val(sodumoi);
                                $('#tongsodu').text(sodumoi.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                            }else{
                                let soluongcu = parseInt($('#truoc_soluong_<?php echo $rnguon['id'];?>').val());
                                $('#soluong_<?php echo $rnguon['id'];?>').val(soluongcu);
                                let tiencu = soluongcu * giasauck<?php echo $rnguon['id'];?>;
                                $('#tien_<?php echo $rnguon['id'];?>').text(tiencu.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                                $('#tienhang_<?php echo $rnguon['id'];?>').val(tiencu);
                                let sum = 0;
                                $('.tong').each(function() {
                                    let value = parseInt($(this).val());
                                    if (!isNaN(value)) {
                                        sum += value;
                                    }
                                });
                                let sodumoi = <?php echo $sodu;?> - sum;
                                if(sodumoi > 0 && sodumoi < <?php echo $sodu;?>){$('#cartbottom').show();}else{$('#cartbottom').hide();}
                                $('#intongsodu').val(sodumoi);
                                $('#tongsodu').text(sodumoi.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                                alert('Số dư không đủ');
                            }
                            
                        }
                        // Tăng số lượng
                        $('#cong_<?php echo $rnguon['id'];?>').click(function() {
                            let soluong<?php echo $rnguon['id'];?> = parseInt($('#soluong_<?php echo $rnguon['id'];?>').val());
                            $('#soluong_<?php echo $rnguon['id'];?>').val(soluong<?php echo $rnguon['id'];?> + 1);
                            updateTien<?php echo $rnguon['id'];?>();
                        });
            
                        // Giảm số lượng
                        $('#tru_<?php echo $rnguon['id'];?>').click(function() {
                            let soluong<?php echo $rnguon['id'];?> = parseInt($('#soluong_<?php echo $rnguon['id'];?>').val());
                            if (soluong<?php echo $rnguon['id'];?> > 0) {
                                $('#soluong_<?php echo $rnguon['id'];?>').val(soluong<?php echo $rnguon['id'];?> - 1);
                                updateTien<?php echo $rnguon['id'];?>();
                            }
                        });
            
                        // Cập nhật tiền khi số lượng thay đổi
                        $('#soluong_<?php echo $rnguon['id'];?>').change(function() {
                            updateTien<?php echo $rnguon['id'];?>();
                        });
                    });
                </script>
                </div>
                </div>
            <?php  }?>
            <script>
                    $(document).ready(function() {
                        $('#cartbottom').click(function() {
                            let str = '';
                            <?php 
                            $spp=@mysqli_query($con,"select id from dh_sanpham order by id desc");
                            while($rss=@mysqli_fetch_assoc($spp)){
                            ?>
                            if(parseInt($('#soluong_<?php echo $rss['id'];?>').val())>0){
                                str = str + '+<?php echo $rss['id']?>-' + $('#soluong_<?php echo $rss['id'];?>').val() + '+';
                            } 
                            <?php }?>
                            window.location.href = "/m/sanpham/?cart="+str;
                        })   
                    });
            </script>
            <p>&nbsp;</p><p>&nbsp;</p>
            <div class="ttin">
                <input type="hidden" id="intongsodu" value="<?php echo $sodu;?>" />
                <p style="line-height: 40px;"><i class="fas fa-money-check-alt"></i> Tiền còn lại: <b style="color: red;" id="tongsodu"><?php echo number_format($sodu,0,',','.')?><sup>đ</sup></b>
                <button type="button" class="btn btn-success" style="float: right;display: none;" id="cartbottom"><i class="fas fa-cart-plus"></i> Đặt hàng</button>
                </p>
            </div>
            <?php }?>
    </div>
    <div class="clearfix"></div>
</div>
     