
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr">
        <img src="i/flag.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Sử dụng Landing Page</b></p>
            <p>Số lượng: <b><?php echo @mysqli_num_rows(@mysqli_query($con,"select id from campland"))?></b> </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <style>
    .noidungghicu{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3; /*số row muốn ẩn*/
        overflow: hidden;
    }
    .concon{
        text-align: center;
        width: 33.3%;
        float: left;
        padding-bottom: 10px;
        padding-top: 10px;
    }
    .concon:hover{
        background: aliceblue;
    }
    .concon p.te{
        font-size: 0.85em;
        color: #333;
    }
    .concon i{
        color: #333;
    }
.noidunglink .tooltip{
  position: absolute;
    /* font-size: 17px; */
    font-weight: 500;
    color: #07af0c;
    top: 30px;
    z-index: 1;
    background: none;
    padding: 5px 10px;
    font-size: 0.7em;
    border-radius: 3px;
    letter-spacing: 1px;
    opacity: 0;
    font-style: italic;
    pointer-events: none;
    transition: opacity 0.4s, margin-left 0.4s;
    right: -10px;
}
.noidunglink .tooltip.show{
  opacity: 1;
  pointer-events: auto;
}
.noidunglink label{font-weight: 500; color: #FF8000;}
h4.befo{
    padding-left: 25px;
    position: relative;
}
h4.befo:before{
    content: "\f45f"; /* Unicode của biểu tượng clock trong Font Awesome */
    font-family: 'Font Awesome 5 Free'; /* Tên font chứa biểu tượng */
    margin-right: 5px;
    color: red;
    position: absolute;
    left: 0;
}
    </style>
    <div class="groupteam">
    <?php if(isset($_GET['dangky'])){
        $dangky=intval($_GET['dangky']);
        $gc=@mysqli_query($con,"select * from campland where id=$dangky");
        $rgc=@mysqli_fetch_assoc($gc);
        $themf='';if($rgc['url']==''){$linkk='https://'.$rgc['domain'].'/';}else{$linkk='https://'.$rgc['domain'].'/'.$rgc['url'].'/';}
        if(isset($_GET['reff'])){
            $dks=@mysqli_query($con,"select * from dangkyland where idu=$_COOKIE[iduser] and idreff=$_GET[reff] and idcamp=$dangky order by time desc");
            $thongtin=@mysqli_fetch_assoc(@mysqli_query($con,"select * from reffland where id=$_GET[reff]"));
            $themf='
            <p style="margin-bottom: 5px;text-align: center;"><i class="fas fa-tags"></i> Xem của: <b>'.$thongtin['ten'].'</b></p>
            <p style="font-style: italic;font-size: 0.9em;text-align: center;"><i class="fas fa-link"></i> Link: '.$linkk.$thongtin['reff'].'</p>
            <p style="text-align: center;margin-bottom: 20px;"><a type="button" class="btn btn-xs btn-info" href="/m/landingpage/?dangky='.$dangky.'">Trở lại danh sách tổng</a></p>
            ';
        }else{
            $dks=@mysqli_query($con,"select * from dangkyland where idu=$_COOKIE[iduser] and idcamp=$dangky order by time desc");
        }
        ?>
    <p style="padding: 15px 0;"><a href="/m/landingpage/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Danh sách đăng ký</p>
    <div class="boxme" style="margin-bottom: 10px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr style="margin-bottom: 0;" />
                <div class="teu" style="color: #444;">
                <p style="text-align: center;
                line-height: 2em;
                display: block;
                background: #e6fee5;
                padding: 15px 0;
                margin-top: 0;
                font-weight: 600;
                border-radius: 0 0 5px 5px;margin-bottom: 25px;"><span>Khách hàng đăng ký <br />
                 <b><?php echo @mysqli_num_rows($dks);?></b></span></p>
                 <?php echo $themf;?>
                <?php $i=1; while($rdk=@mysqli_fetch_assoc($dks)){?>
                <div class="lisdk" style="margin-bottom: 25px;">
                    <p><?php echo $i;?>. <b><?php echo $rdk['name']; ?></b></p>
                    <p style="padding-left: 18px;"><i class="fas fa-phone-volume"></i> <a href="tel:<?php echo $rdk['phone']; ?>"><?php echo $rdk['phone']; ?></a></p>
                    <?php if($rdk['email']!=''){ ?>
                    <p style="padding-left: 18px;"><i class="far fa-envelope"></i> <a href="mailto:<?php echo $rdk['email']; ?>?view=cm"><?php echo $rdk['email']; ?></a></p>
                    <?php } ?>
                    <p style="padding-left: 18px;"><i class="far fa-clock"></i> <?php echo retimefull($rdk['time']); ?></p>
                </div>
                <?php $i++;}?>
                </div>
            </div>
        </div>
    <?php }elseif(isset($_GET['setup'])){
        $set=intval($_GET['setup']);
        $gc=@mysqli_query($con,"select * from campland where id=$set");
        $rgc=@mysqli_fetch_assoc($gc);
        ?>
    <p style="padding: 15px 0;"><a href="/m/landingpage/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Cài đặt riêng</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidungghi" style="color: #444;">
                <p><i class="fas fa-link"></i> Link chuyển hướng sau đăng ký: </p>
               
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="macdinh" value="0">
                    Link mặc định
                  </label>
                </div>
                <pre style="text-align: center;"><code><?php echo $rgc['linkout'];?></code></pre>
                <?php 
                $i=1;$checked=0;
                $timlink=@mysqli_query($con,"select * from setupcamp_user where idu=$_COOKIE[iduser] and idcamp=$rgc[id]");
                if(@mysqli_num_rows($timlink)>0){echo '<hr />';}
                while($rl=@mysqli_fetch_assoc($timlink)){
                ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="canhan<?php echo $rl['id'];?>" value="<?php echo $rl['id'];?>" <?php if($rl['sudung']==1){echo 'checked';$checked++;}?>>
                    Link cá nhân hóa (<?php echo $i;?>)
                  </label>
                </div>
                <pre style="text-align: center;"><code><?php echo $rl['linkout'];?></code></pre>
                <?php $i++;} 
                if($checked==0){
                ?>
                <script>$('#macdinh').attr('checked', true);</script>
                <div id="thongbaook" style="color: #17A81F; font-size: 0.9em; font-style: italic;"></div>
                <?php }?>
<script>
    $(document).ready(function() {
        // Sự kiện change cho input optionsRadios
        $('input[name="optionsRadios"]').change(function() {
            // Lấy giá trị được chọn
            var selectedValue = $('input[name="optionsRadios"]:checked').val();

            // Gửi Ajax
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {typeform : 'thaydoilinkout',idcamp : <?php echo $rgc['id'];?>, selectedValue: selectedValue },
                success: function() {
                    // Hiển thị thông báo và ẩn sau 5 giây
                    $('#thongbaook').html('<i class="fas fa-check"></i> Cài đặt đã được lưu').show();
                    setTimeout(function() {
                        $('#thongbaook').fadeOut();
                    }, 3000);
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Xử lý lỗi Ajax nếu cần
                    console.error('Lỗi Ajax:', textStatus, errorThrown);
                }
            });
        });
    });
</script>
                <hr />
                <p><i class="fas fa-plus"></i> Thêm link của riêng bạn:</p>
                <div class="input-group">
                  <input type="text" class="form-control" id="link" placeholder="Link chuyển hướng của bạn?"/>
                  <span class="input-group-addon" id="themlink" style="cursor: pointer;"><i class="far fa-paper-plane"></i> Thêm link</span>
                </div>
                <div id="error-message" style="color: red; margin-top: 5px;"></div>
<script>
$('body').ready(function(){
    $('#themlink').click(function(){
        var linkValue = $('#link').val();
            if ($.trim(linkValue) === '') {
                $('#error-message').html('<i class="fas fa-exclamation-triangle"></i> Vui lòng nhập link.');
                return;
            }
            var linkRegex = /^(ftp|http|https):\/\/[^ "]+$/;
            if (!linkRegex.test(linkValue)) {
                $('#error-message').html('<i class="fas fa-exclamation-triangle"></i> Link không hợp lệ.');
                return;
            }
        $.ajax({
            url : "ajax.php", 
            type : "post",
            dateType:"text",
            data : { 
                typeform : 'themlinkout',
                linkout : linkValue,
                idcamp : <?php echo $rgc['id'];?>
            },
            success : function (data2){
                location.reload();
            }
        });           
        // Nếu mọi thứ đều hợp lệ, có thể gửi Ajax từ đây
        $('#error-message').html('');            
    })
})
</script>
                </div>
            </div>
        </div>
    <?php     
    }elseif(isset($_GET['chitiet'])){}elseif(isset($_GET['link'])){
        
        $set=intval($_GET['link']);
        $gc=@mysqli_query($con,"select * from campland where id=$set");
        $rgc=@mysqli_fetch_assoc($gc);
        if($rgc['url']==''){$m='/';}else{$m='/'.$rgc['url'].'/';}
        ?>
    <p style="padding: 15px 0;"><a href="/m/landingpage/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Cài đặt link</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidunglink" style="color: #444;">
                <p><i class="fas fa-link"></i> Link để đi chia sẻ: </p>
                <?php 
                $i=1;$checked=0;
                $timlink=@mysqli_query($con,"select * from reffland where idu=$_COOKIE[iduser] and idcamp=$rgc[id]");
                while($rl=@mysqli_fetch_assoc($timlink)){
                ?>
                <form style="margin-bottom: 15px;">
                <label><?php echo $i.'. '.$rl['ten'];?></label>
                <div class="input-group showid">
                  <input type="text" style="background: white; border-right: 0;" class="form-control" readonly="" id="magioithieu<?php echo $rl['id'];?>" value="https://<?php echo $rgc['domain'].$m.$rl['reff']?>"/>
                  <span class="input-group-addon btn btn-primary" id="btncopy<?php echo $rl['id'];?>"><i class="far fa-copy"></i></span>
                  <span class="tooltip toooo<?php echo $rl['id'];?>">Đã copy</span>
                </div>
                <p style="padding: 10px 0 15px;font-size: 0.9em;"><i class="fas fa-chart-bar"></i> Truy cập: <b><?php echo $rl['view'];?></b> &nbsp; &nbsp; <i class="fas fa-user-plus"></i> Đăng ký: <b><a href="/m/landingpage/?dangky=<?php echo $rgc['id']?>&reff=<?php echo $rl['id'];?>"><?php echo $rl['dangky'];?></a></b></p>
                </form>
                <script>
                    const copyText<?php echo $rl['id'];?> = document.querySelector("#magioithieu<?php echo $rl['id'];?>");
                    const button<?php echo $rl['id'];?> = document.querySelector("#btncopy<?php echo $rl['id'];?>");
                    const tooltip<?php echo $rl['id'];?> = document.querySelector(".toooo<?php echo $rl['id'];?>");
                    button<?php echo $rl['id'];?>.addEventListener('click', function(){
                      copyText<?php echo $rl['id'];?>.select();
                      tooltip<?php echo $rl['id'];?>.classList.add("show");
                      setTimeout(function(){
                        tooltip<?php echo $rl['id'];?>.classList.remove("show");
                      },2000);
                      document.execCommand("copy");
                    });
                </script>
                <?php $i++;} ?>

                <hr />
                <p style="font-weight: 700;color: #2196F3;border-bottom: 1px solid;padding-bottom: 6px;"><i class="fas fa-plus"></i> Thêm link của riêng bạn:</p>
                <label>URL</label>
                <div class="input-group" style="position: relative;">
                  <input type="text" class="form-control" id="link" placeholder="Gõ vào đây rồi ấn Check"/>
                  <span id="iconok" class="glyphicon glyphicon-ok form-control-feedback" style="right: 70px;color: #4CAF50;display: none;" aria-hidden="true"></span>
                  <span id="iconnook" class="glyphicon glyphicon-remove form-control-feedback" style="right: 70px;color: red; display: none;" aria-hidden="true"></span>
                  <span class="input-group-addon" id="themlink" style="cursor: pointer;"><i class="fas fa-spell-check"></i> Check</span>
                </div>
                <p class="help-block">https://<?php echo $rgc['domain'].$m;?><span id="andlink"></span></p>
                <div id="tenluukhiok" style="display: none;">
                <label>Đặt tên cho nó</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="tenlink" placeholder="Tên để quản lý"/>
                  <span class="input-group-addon" id="luulink" style="cursor: pointer;"><i class="far fa-paper-plane"></i> Lưu</span>
                </div>
                </div>
                <div id="error-message" style="color: red; margin-top: 5px;"></div>
<script>
$('body').ready(function(){
    $('#themlink').click(function(){
        var urlcamp = $('#link').val();
            if ($.trim(urlcamp) === '') {
                $('#error-message').html('<i class="fas fa-exclamation-triangle"></i> Vui lòng nhập link.');
                setTimeout(function(){
                        $('#error-message').html('');
                      },5000);
                return;
            }
        $.ajax({
            url : "ajax.php", 
            type : "post",
            dateType:"text",
            data : { 
                typeform : 'checkurlcamp',
                urlcamp : urlcamp,
                idcamp : <?php echo $rgc['id'];?>
            },
            success : function (data2){
                if($.trim(data2) ==='linkkhongok'){
                    $('#iconnook').show();
                    $('#tenluukhiok').hide();
                    $('#iconok').hide();
                    $('#link').focus();
                }else{
                    $('#iconok').show();
                    $('#tenluukhiok').show();
                    $('#iconnook').hide();
                    $('#link').val($.trim(data2));
                    $('#andlink').html($.trim(data2));
                };
            }
        });           
        // Nếu mọi thứ đều hợp lệ, có thể gửi Ajax từ đây
        $('#error-message').html('');            
    })
    $('#link').keyup(function(){
        $('#iconnook').hide();
        $('#tenluukhiok').hide();
        $('#iconok').hide();
        $('#error-message').html('');            
    })
    $('#luulink').click(function(){
        var tenlink = $('#tenlink').val();
        var urlcamp = $('#link').val();
            if ($.trim(tenlink) === '') {
                $('#error-message').html('<i class="fas fa-exclamation-triangle"></i> Vui lòng nhập tên để quản lý.');
                setTimeout(function(){
                        $('#error-message').html('');
                      },5000);
                return;
            }
        $.ajax({
            url : "ajax.php", 
            type : "post",
            dateType:"text",
            data : { 
                typeform : 'luutenlinkcamp',
                urlcamp : urlcamp,
                tenlink : tenlink,
                idcamp : <?php echo $rgc['id'];?>
            },
            success : function (data2){
                location.reload();
            }
        });           
        // Nếu mọi thứ đều hợp lệ, có thể gửi Ajax từ đây
        $('#error-message').html('');            
    })
})
</script>
                </div>
            </div>
        </div>
    <?php     
    
    }elseif(isset($_GET['huongdan'])){
        $huongdan=intval($_GET['huongdan']);
        $gc=@mysqli_query($con,"select * from campland where id=$huongdan");
        $rgc=@mysqli_fetch_assoc($gc);
        ?>
    <p style="padding: 15px 0;"><a href="/m/landingpage/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Hướng dẫn làm việc</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidunglink" style="color: #444;">
                <p><i class="far fa-question-circle"></i> Hướng dẫn của Leader: </p>
                <?php
                echo $rgc['huongdan']; 
                ?>
                </div>
            </div>
        </div>
    <?php     
    
    
    }elseif(isset($_GET['xephang'])){
        $xephang=intval($_GET['xephang']);
        $gc=@mysqli_query($con,"select * from campland where id=$xephang");
        $rgc=@mysqli_fetch_assoc($gc);
        ?>
    <p style="padding: 15px 0;"><a href="/m/landingpage/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Xếp hạng đội nhóm</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
    <style>
    .top100{
        background: aliceblue;
        padding: 15px 0 0 15px;
        border-radius: 8px;
    }
    .top100 p.titt{
        font-weight: 600;
        color: #408080;
    }
    </style>
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidunglink" style="color: #444;">
                <p><i class="far fa-question-circle"></i> Top hiệu quả: </p>
                <?php
                $i=1;
                //$timtop=@mysqli_query($con,"SELECT * FROM viewland WHERE idcamp=$rgc[id] and dangky > 0 ORDER BY dangky DESC limit 100");
                $timtop=@mysqli_query($con,"SELECT * FROM viewland WHERE idcamp=$rgc[id] ORDER BY dangky DESC limit 100");
                if(@mysqli_num_rows($timtop)==0){}else{
                    while($rtop=@mysqli_fetch_assoc($timtop)){
                        $nam=@mysqli_fetch_assoc(@mysqli_query($con,"select fullname from dh_user where id=$rtop[idu]"));
                        ?>
                        <div class="top100" style="<?php if($i==3){echo 'background: antiquewhite;';}elseif($i==1){echo 'background: aqua;';}elseif($i==2){echo 'background: #FFEB3B;';}?>">
                            <p class="titt"><?php echo $i;?>. <span><?php echo $nam['fullname']?></span></p>
                            <p style="padding: 0px 0 15px;font-size: 0.9em; color: gray;"><i class="fas fa-user-plus"></i> Đăng ký: <b><?php echo $rtop['dangky']?></b> &nbsp; &nbsp; <i class="fas fa-chart-bar"></i> Truy cập: <b><?php echo $rtop['view']?></b></p>
                        </div>
                        <?php
                    $i++;}
                }
                ?>
                </div>
            </div>
        </div>
    <?php     
    
    }else{?>
    <p style="padding: 15px 0;"><a href="m/cpanel/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Landing Page</p>
    <?php 
        $gc=@mysqli_query($con,"select * from campland order by time desc");
        if(@mysqli_num_rows($gc)==0){ 
        ?>
        <div class="boxme">
        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
        <p class="thongbaomo">Chưa có trang nào được chủ hệ thống cập nhật</p>
        </div>
        <?php }else{
            
            while($rgc=@mysqli_fetch_assoc($gc)){
                //kiểm tra xem có tệp trong danh sách khách hàng chưa
                $timtep=@mysqli_query($con,"select * from danhsach where landing=$rgc[id] and idu=$_COOKIE[iduser]");
                if(@mysqli_num_rows($timtep)==0){//tạo tệp
                    $intep=@mysqli_query($con,"insert into danhsach (idu,ten,landing,time)value($_COOKIE[iduser],N'$rgc[tit]',$rgc[id],$time)");
                }
                //kiểm tra xem có trong thoongs ke viewland chwa thi tao
                $timtep=@mysqli_query($con,"select * from viewland where idcamp=$rgc[id] and idu=$_COOKIE[iduser]");
                if(@mysqli_num_rows($timtep)==0){//tạo tệp
                    $intep=@mysqli_query($con,"insert into viewland (idu,idcamp)value($_COOKIE[iduser],$rgc[id])");
                }
                //kiểm tra xem có list reffland hay chua
                $timtep=@mysqli_query($con,"select * from reffland where idcamp=$rgc[id] and idu=$_COOKIE[iduser]");
                if(@mysqli_num_rows($timtep)==0){//tạo tệp
                    $intep=@mysqli_query($con,"insert into reffland (ten,idu,reff,idcamp)value(N'Mặc định',$_COOKIE[iduser],N'$u[magioithieu]',$rgc[id])");
                }
                if($rgc['url']==''){$xempage='https://'.$rgc['domain'].'/view';}else{$xempage='https://'.$rgc['domain'].'/'.$rgc['url'].'/view';}
        ?>
        <div class="boxme" style="margin-bottom: 10px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidun" style="color: #444;">
                <div class="concon"><p><i class="fas fa-street-view"></i></p><p class="te">Truy cập</p><p><b style="color: #2196F3;"><?php $sl=@mysqli_fetch_assoc(@mysqli_query($con,"select view from viewland where idu=$_COOKIE[iduser] and idcamp=$rgc[id]"));echo $sl['view'];?></b></p></div>
                <a href="/m/landingpage/?dangky=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-user-plus"></i></p><p class="te">Đăng ký</p><p><b style="color: #2196F3;"><?php $sl=@mysqli_fetch_assoc(@mysqli_query($con,"select dangky from viewland where idu=$_COOKIE[iduser] and idcamp=$rgc[id]"));echo $sl['dangky'];?></b></p></div></a>
                <a href="/m/landingpage/?setup=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-user-cog"></i></p><p class="te">Cài đặt</p><p><i class="fas fa-angle-right"></i></p></div></a>
                <!--a href="/m/landingpage/?chitiet=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-layer-group"></i></p><p class="te">Chi tiết</p><p><i class="fas fa-angle-right"></i></p></div></a-->
                <a href="/m/landingpage/?link=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-link"></i></i></p><p class="te">Lấy Link</p></div></a>
                <a href="/m/landingpage/?huongdan=<?php echo $rgc['id']?>"><div class="concon"><p><i class="far fa-question-circle"></i></p><p class="te">Cách làm</p></div></a>
                <a href="/m/landingpage/?xephang=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-trophy"></i></p><p class="te">Xếp hạng</p></div></a>
                <!--a href="<?php echo $xempage;?>" target="_blank"><div class="concon"><p><i class="fas fa-globe"></i></p><p class="te">Xem Page</p></div></a-->
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php 
        }
        }?>
        
    <?php }?>
    </div>
    <div class="clearfix"></div>
</div>
     