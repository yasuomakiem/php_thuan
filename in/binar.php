
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr">
        <img src="i/filter.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Sử dụng Webinar hệ thống</b></p>
            <p>Số lượng: <b><?php echo @mysqli_num_rows(@mysqli_query($con,"select id from camplive"))?></b> </p>
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
h4.befo{
    padding-left: 25px;
    position: relative;
}
h4.befo:before{
    content: "\f144"; /* Unicode của biểu tượng clock trong Font Awesome */
    font-family: 'Font Awesome 5 Free'; /* Tên font chứa biểu tượng */
    margin-right: 5px;
    color: red;
    position: absolute;
    left: 0;
}
.noidunglink .tooltip.show{
  opacity: 1;
  pointer-events: auto;
}
.noidunglink label{font-weight: 500; color: #FF8000;}
.noidunglink .nguoicomment h4{
    margin-top: 40px; margin-bottom: 20px;
}
    </style>
    <div class="groupteam">
    <?php if(isset($_GET['xem'])){
        $xem=intval($_GET['xem']);
        $gc=@mysqli_query($con,"select * from camplive where id=$xem");
        $rgc=@mysqli_fetch_assoc($gc);
        $dks=@mysqli_query($con,"select * from webinarkhachhang where idgioithieu=$_COOKIE[iduser] and idcamp=$xem order by time desc");
        ?>
    <p style="padding: 15px 0;"><a href="/m/binar/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Danh sách xem webinar</p>
    <div class="boxme" style="margin-bottom: 10px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr style="margin-bottom: 0;" />
                <div class="teu" style="color: #444;">
                <p style="font-size: 0.9em;padding: 10px;margin-bottom: 25px;background: aliceblue;font-style: italic;"><span><i class="fas fa-exclamation-circle"></i> Khách hàng đã xem webinar từ nguồn link giới thiệu trực tiếp của bạn hoặc từ đăng ký landing page <br /></span></p>
                <?php 
                if(@mysqli_num_rows($dks)==0){
                ?>
                <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
                <p class="thongbaomo">Chưa có ai xem Webinar này từ link của bạn</p>
                <p class="text-center"><a href="/m/binar/" type="button" class="btn btn-xs btn-info"><i class="far fa-arrow-alt-circle-left"></i> Trở lại</a></p>
                <?php
                }else{
                $i=1; while($rdk=@mysqli_fetch_assoc($dks)){?>
                <div class="lisdk" style="margin-bottom: 25px;padding: 10px;border: 1px solid #d8d8d8;border-radius: 5px;">
                    <p><?php echo $i;?>. <b><?php echo $rdk['ten']; ?></b></p>
                    <p style="padding-left: 18px;"><i class="fas fa-phone-volume"></i> <a href="tel:<?php echo $rdk['sdt']; ?>"><?php echo $rdk['sdt']; ?></a></p>
                    <?php if($rdk['email']!=''){ ?>
                    <p style="padding-left: 18px;"><i class="far fa-envelope"></i> <a href="mailto:<?php echo $rdk['email']; ?>?view=cm"><?php echo $rdk['email']; ?></a></p>
                    <?php } ?>
                    <p style="padding-left: 18px;"><i class="far fa-clock"></i> <?php echo retimefull($rdk['time']); ?></p>
                    
                    <?php
                    $label='<span class="label label-default">'.gioxem($rdk['xem']).'</span> ';
                    $timdon=@mysqli_num_rows(@mysqli_query($con,"select id from donhang where idcamp=$rgc[id] and idkhach=$rdk[id]"));
                    if($timdon>0){$label=$label.'<span class="label label-primary">Mua hàng</span> ';}
                    $timcomment=@mysqli_num_rows(@mysqli_query($con,"select id from comment where idcamp=$rgc[id] and idnick=$rdk[id] and ao=1"));
                    if($timcomment>0){$label=$label.'<a href=""><span class="label label-info">Comment '.$timcomment.'</span></a> ';}
                    ?>
                    <p style="margin-bottom: 10px;padding-left: 20px"><?php echo $label?></p>
                </div>
                <?php $i++;}}?>
                </div>
            </div>
        </div>
    <?php }elseif(isset($_GET['comment'])){
    $comment=intval($_GET['comment']);
        $gc=@mysqli_query($con,"select * from camplive where id=$comment");
        $rgc=@mysqli_fetch_assoc($gc);
        ?>
    <p style="padding: 15px 0;"><a href="/m/binar/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Danh sách comment</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidunglink" style="color: #444;">
                <?php
                $dks=@mysqli_query($con,"select * from webinarkhachhang where idgioithieu=$_COOKIE[iduser] and idcamp=$comment order by time desc");
                if(@mysqli_num_rows($dks)==0){
                    ?>
                    <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
                    <p class="thongbaomo">Chưa có ai xem Webinar này từ link của bạn</p>
                    <p class="text-center"><a href="/m/binar/" type="button" class="btn btn-xs btn-info"><i class="far fa-arrow-alt-circle-left"></i> Trở lại</a></p>
                    <?php
                }else{
                    $coco=0;$tenk='';
                    while($rks=@mysqli_fetch_assoc($dks)){
                        $tcm=@mysqli_query($con,"select * from comment where idcamp=$comment and idnick=$rks[id] and ao=1 order by id desc");
                        if(@mysqli_num_rows($tcm)>0){$coco=1;
                            while($rcm=@mysqli_fetch_assoc($tcm)){
                                ?>
                                <div class="nguoicomment">
                                    <?php if($rks['ten']!=$tenk){ echo '<h4><i class="fas fa-user-edit"></i> '.$rks['ten'].'</h4>';$tenk=$rks['ten'];}?>
                                    <?php 
                                    echo '<p>'.$rcm['noidung'].'</p>';
                                    echo '
                                    <p style="opacity: 0.8;">
                                    <span class="label label-info"><i class="far fa-clock"></i> '.chuyenGiayThanhGioPhutGiay($rcm['timeshow']).'</span> 
                                    <span class="label label-warning"><i class="far fa-clock"></i> '.retimefull($rcm['time']).'</span> 
                                    </p>
                                    ';
                                    
                                    ?>
                                </div>
                                <?php
                            }
                        }
                    }
                    if($coco==0){
                        ?>
                        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
                        <p class="thongbaomo">Chưa có comment được ghi nhận</p>
                        <p class="text-center"><a href="/m/binar/" type="button" class="btn btn-xs btn-info"><i class="far fa-arrow-alt-circle-left"></i> Trở lại</a></p>
                        <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
    <?php     
    }elseif(isset($_GET['link'])){
        $set=intval($_GET['link']);
        $gc=@mysqli_query($con,"select * from camplive where id=$set");
        $rgc=@mysqli_fetch_assoc($gc);
        $m=$rgc['url'].'/';$m1=$rgc['url'].'-86/';
        ?>
    <p style="padding: 15px 0;"><a href="/m/binar/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Lấy link gửi cho khách</p>
    <div class="boxme" style="margin-bottom: 10px; padding-bottom: 25px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidunglink" style="color: #444;">
                <p><i class="fas fa-link"></i> Link để đi chia sẻ: </p>
               
                <form style="margin-bottom: 15px; padding-top: 15px;">
                <label>Link chung</label>
                <div class="input-group showid">
                  <input type="text" style="background: white; border-right: 0;" class="form-control" readonly="" id="magioithieu" value="<?php echo $domain_webinar.$m.$u['magioithieu']?>"/>
                  <span class="input-group-addon btn btn-primary" id="btncopy"><i class="far fa-copy"></i></span>
                  <span class="tooltip toooo">Đã copy</span>
                </div>
                <p style="font-size: 0.9em;font-style: italic;" class="help-block">Link này để gửi qua Zalo, Messenger, Facebook</p>
                
                <p style="padding: 10px 0 15px;font-size: 0.9em; display: none;"><i class="fas fa-chart-bar"></i> Truy cập: <b><?php //echo $rl['view'];?></b> &nbsp; &nbsp; <i class="fas fa-user-plus"></i> Đăng ký: <b><?php //echo $rl['dangky'];?></b></p>
                </form>
                <script>
                    const copyText = document.querySelector("#magioithieu");
                    const button = document.querySelector("#btncopy");
                    const tooltip = document.querySelector(".toooo");
                    button.addEventListener('click', function(){
                      copyText.select();
                      tooltip.classList.add("show");
                      setTimeout(function(){
                        tooltip.classList.remove("show");
                      },2000);
                      document.execCommand("copy");
                    });
                </script>
               
               <form style="margin-bottom: 15px;margin-bottom: 15px;padding: 10px;border: 1px solid red;margin-top: 40px;">
                <label>Link đặc biệt</label>
                <div class="input-group showid">
                  <input type="text" style="background: white; border-right: 0;" class="form-control" readonly="" id="magioithieu1" value="<?php echo $domain_webinar.$m1.$u['magioithieu']?>"/>
                  <span class="input-group-addon btn btn-primary" id="btncopy1"><i class="far fa-copy"></i></span>
                  <span class="tooltip toooo1">Đã copy</span>
                </div>
                <p style="font-size: 0.9em;font-style: italic;" class="help-block">Link này để gửi qua SMS, Website, Youtube</p>
                <p style="text-align: justify;line-height: 23px;color: darkcyan;font-style: italic;" class="help-block"><i class="fas fa-exclamation-triangle"></i> <b style="color: red;">Link đặc biệt</b> sẽ giúp khách hàng không cần copy link chuyển sang Chrome, CocCoc, Safari để xem, thuận tiện hơn rất nhiều giảm tỷ lệ thoát do xem webinar gặp khó khăn. Tuy nhiên nếu gửi nhầm link này trong Zalo, Messenger, Facebook sẽ gặp tình trạng video bị đơ không chạy.</p>
                <p style="padding: 10px 0 15px;font-size: 0.9em; display: none;"><i class="fas fa-chart-bar"></i> Truy cập: <b><?php //echo $rl['view'];?></b> &nbsp; &nbsp; <i class="fas fa-user-plus"></i> Đăng ký: <b><?php //echo $rl['dangky'];?></b></p>
                </form>
                <script>
                    const copyText1 = document.querySelector("#magioithieu1");
                    const button1 = document.querySelector("#btncopy1");
                    const tooltip1 = document.querySelector(".toooo1");
                    button1.addEventListener('click', function(){
                      copyText1.select();
                      tooltip1.classList.add("show");
                      setTimeout(function(){
                        tooltip1.classList.remove("show");
                      },2000);
                      document.execCommand("copy");
                    });
                </script>

                
                </div>
            </div>
        </div>
    <?php     
    
    }elseif(isset($_GET['sent'])){
        
        $sent=intval($_GET['sent']);
        $gc=@mysqli_query($con,"select * from camplive where id=$sent");
        $rgc=@mysqli_fetch_assoc($gc);
        $dks=@mysqli_query($con,"select * from campland order by time desc");
        
        ?>
    <p style="padding: 15px 0;"><a href="/m/binar/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Gửi Webinar cho người đăng ký</p>
    <style>
    .lisdk{
        margin-bottom: 25px;padding: 10px;border: 1px solid #d8d8d8;border-radius: 5px;color: #333;
    }
    .lisdkac{
        margin-bottom: 25px;
        padding: 10px;
        border: 1px solid #68eb2d;
        border-radius: 5px;
        background: #4CAF50;
        color: white;
    }
    button:active,
    button:focus {
      outline: none !important;
      border: none !important;
    }
    </style>
    <div class="boxme" style="margin-bottom: 10px;">
            <div class="ghichu">
                <h4 style="color: #029183;font-size: 15px;font-weight: 700;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr style="margin-bottom: 0;" />
                <div class="teu" style="color: #444;">
                <p style="font-size: 0.9em;padding: 10px;margin-bottom: 25px;background: aliceblue;font-style: italic;"><span><i class="fas fa-exclamation-circle"></i> Bạn muốn gửi Webinar cho khách xem hãy chọn tệp khách hàng đã đăng ở Landing Page nào. Sau đó có thể gửi hàng loạt cho khách bằng tin nhắn SMS hoặc Email <br /></span></p>
                
                <?php $i=1; while($rdk=@mysqli_fetch_assoc($dks)){?>
                <a href="/m/binar/?sent=<?php echo $sent?>&land=<?php echo $rdk['id']?>"><div class="<?php if(isset($_GET['land']) and $_GET['land']==$rdk['id']){echo 'lisdkac';}else{echo 'lisdk';}?>">
                    <p style="margin-bottom: 0;"><?php echo $i;?>. <b><?php echo $rdk['ten']; ?></b></p>
                </div></a>
                <?php $i++;}
                if(isset($_GET['land'])){
                    $dangky=intval($_GET['land']);
                    $dkskh=@mysqli_query($con,"select * from dangkyland where idu=$_COOKIE[iduser] and idcamp=$dangky order by time desc");
                    if(@mysqli_num_rows($dkskh)==0){
                        ?>
                        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
                        <p class="thongbaomo">Không có ai đăng ký trong tệp được chọn</p>
                        <p class="text-center"><a href="/m/binar/?sent=<?php echo $dangky?>" type="button" class="btn btn-xs btn-info"><i class="far fa-arrow-alt-circle-left"></i> Trở lại</a></p>
                        <?php
                    }else{
                ?>
                <hr />
                <div class="form-group">
                    <label>Nội dung tin nhắn</label>
                    <textarea class="form-control" id="noidung" rows="4">Đã tới giờ học, mời anh chị Click vào link dưới đây để vào lớp "<?php echo $rgc['tit'];?>" <?php echo $domain_webinar.$rgc['url'].'-86/'.$u['magioithieu']?></textarea>
                    <p style="padding-top: 10px; font-size: 0.8em; font-style: italic;">
                    Ký tự: <span id="kytu"></span> - SMS: <span id="sotin"></span>
                    <input type="hidden" id="noidungan" value="" />
                    <input type="hidden" id="trangthaicodau" value="1" />
                    <button style="float: right;margin-left: 5px;" id="khongdau" type="button" class="btn btn-default btn-xs">Không dấu</button> &nbsp;
                    <button style="float: right;" id="codau" type="button" class="btn btn-primary btn-xs">Có dấu</button>
                    <div class="loading" id="loading" style="text-align: center;font-size: 0.9em; font-style: italic;display: none;margin-top: 15px;"><img src="<?php echo $domain.'/images/loading.gif';?>" width="30px" /> Đang gửi <span id="slemailgui"></span> email ... hãy chờ 1 chút</div>
                    </p>
                </div>
                <hr />
                <div>
                <a style="width: 49%;" type="button" id="guismstoanbo" class="btn btn-default">Gửi SMS cho tất cả</a>
                <a style="width: 49%;" type="button" id="guiemail" class="btn btn-default">Gửi Email cho tất cả</a>
                </div>
                <script>
              $(document).ready(function() {
                updateCharacterCount(70);
                sentsms();
                $('#noidung').on('input', function() {
                  updateCharacterCount(70);
                  sentsms();
                  var trangthaicodau=$('#trangthaicodau').val();
                  if(Number(trangthaicodau)==1){
                      var noidungchinh=$('#noidung').val();
                      $('#noidungan').val(noidungchinh);
                  }
                });
                $('#codau').click(function(){
                    $('#codau').addClass('btn-primary');$('#khongdau').addClass('btn-default');$('#codau').removeClass('btn-default');$('#khongdau').removeClass('btn-primary');
                    var codauan = $('#noidungan').val();
                    $('#noidung').val(codauan);
                    $('#trangthaicodau').val(1);
                    updateCharacterCount(70);
                    sentsms();
                });
                $('#khongdau').click(function(){
                    $('#khongdau').addClass('btn-primary');$('#codau').addClass('btn-default');$('#khongdau').removeClass('btn-default');$('#codau').removeClass('btn-primary');
                    var noidungsms=$('#noidung').val();
                    $('#noidungan').val(noidungsms);
                    
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dataType:"text",
                        data : { 
                            typeform : 'chuyenkhongdausms',
                            noidung : noidungsms
                            },
                            success : function (timenow){
                                $('#noidung').val($.trim(timenow));
                                updateCharacterCount(160);
                                sentsms();
                                $('#trangthaicodau').val(0);
                            }
                        });
                });
                $('#guiemail').click(function(){
                    $('#loading').show();
                    var danhsachemail=$('#dsemail').val();
                    var soluongemail=$('#slemail').val();
                    $('#slemailgui').text(soluongemail);
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dataType:"text",
                        data : { 
                            typeform : 'guimailthongbaolophoc',
                            idcamp: <?php echo $rgc['id']?>,
                            danhsachemail : danhsachemail
                            },
                            success : function (timenow){
                                $('#loading').html('<p >Đã gửi mail thành công</p>');
                            }
                        });
                });
                function updateCharacterCount(k) {
                  // Đếm số ký tự
                  var soKyTu = $('#noidung').val().length;
                  $('#kytu').text(soKyTu);
            
                  // Tính số bản tin (mỗi bản tin tối đa 70 ký tự)
                  var soBanTin = Math.ceil(soKyTu / k);
                  $('#sotin').text(soBanTin);
                }
                function sentsms() {
                  // Đếm số ký tự
                  var txt = $('#noidung').val();
                  var smsto = $('#smsto').val();
                  var url = "sms:"+smsto+"?body="+txt;    
                  $('#guismstoanbo').attr('href', url); 
                }
              });
            </script>
            <hr />
            <?php $i=1;$smsto='';$dsmail='';$slmail=0; while($rdks=@mysqli_fetch_assoc($dkskh)){?>
                <div class="lisdk" style="margin-bottom: 25px;">
                    <p><?php echo $i;?>. <b><?php echo $rdks['name']; ?></b></p>
                    <p style="padding-left: 18px;"><i class="fas fa-phone-volume"></i> <a href="tel:<?php echo $rdks['phone']; ?>"><?php echo $rdks['phone']; ?></a></p>
                    <?php if($rdks['email']!=''){$slmail++; if($dsmail==''){$dsmail=$rdks['email'];}else{$dsmail=$dsmail.','.$rdks['email'];} ?>
                    <p style="padding-left: 18px;"><i class="far fa-envelope"></i> <a href="mailto:<?php echo $rdks['email']; ?>?view=cm"><?php echo $rdks['email']; ?></a></p>
                    <?php } ?>
                    <p style="padding-left: 18px;"><i class="far fa-clock"></i> <?php echo retimefull($rdks['time']); ?></p>
                </div>
                <?php $i++;
                if($smsto==''){$smsto=$rdks['phone'];}else{$smsto=$smsto.','.$rdks['phone'];}
                }?>
                <input type="hidden" id="smsto" value="<?php echo $smsto;?>" />
                <input type="hidden" id="dsemail" value="<?php echo $dsmail;?>" />
                <input type="hidden" id="slemail" value="<?php echo $slmail;?>" />
                <?php
                }
                }
                ?>
                </div>
            </div>
        </div>
    <?php 
    }else{?>
    <p style="padding: 15px 0;"><a href="m/cpanel/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Webinar</p>
    <?php 
        $gc=@mysqli_query($con,"select * from camplive order by time desc");
        if(@mysqli_num_rows($gc)==0){ 
        ?>
        <div class="boxme">
        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
        <p class="thongbaomo">Chưa có Webinar nào được chủ hệ thống cập nhật</p>
        </div>
        <?php }else{
            
            while($rgc=@mysqli_fetch_assoc($gc)){
                /*/kiểm tra xem có tệp trong danh sách khách hàng chưa
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
                */
        ?>
        <div class="boxme" style="margin-bottom: 10px;">
            <div class="ghichu">
                <h4 style="color: #222;" class="befo"> <?php echo $rgc['tit']?></h4>
                <hr />
                <div class="noidungghicu" style="color: #444;">
                
                <a href="/m/binar/?xem=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-chalkboard-teacher"></i></p><p class="te">Khách xem</p><p><b style="color: #2196F3;"><?php $sl0=@mysqli_num_rows(@mysqli_query($con,"select id from webinarkhachhang where idgioithieu=$_COOKIE[iduser] and idcamp=$rgc[id]"));echo $sl0;?></b></p></div></a>
                <a href="/m/binar/?cart=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-cart-plus"></i></p><p class="te">Đơn hàng</p><p><b style="color: #2196F3;">
    
                <?php 
                    $slccdon=@mysqli_num_rows(@mysqli_query($con,"SELECT *
                    FROM donhang
                    JOIN webinarkhachhang ON donhang.idkhach = webinarkhachhang.id
                    WHERE webinarkhachhang.idgioithieu = $_COOKIE[iduser] and donhang.idcamp=$rgc[id]"));
                    echo $slccdon;
                ?>
                </b></p></div></a>
                <a href="/m/binar/?form=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-address-book"></i></p><p class="te">Đăng ký</p><p><b style="color: #2196F3;">
                <?php 
                    $slccdk=@mysqli_num_rows(@mysqli_query($con,"SELECT *
                    FROM dangkyform
                    JOIN webinarkhachhang ON dangkyform.idkhach = webinarkhachhang.id
                    WHERE webinarkhachhang.idgioithieu = $_COOKIE[iduser] and dangkyform.idcamp=$rgc[id]"));
                    echo $slccdk;
                ?>
                </b></p></div></a>
                <a href="/m/binar/?comment=<?php echo $rgc['id']?>">
                    <div class="concon">
                    <p><i class="fas fa-comments-dollar"></i></p>
                    <p class="te">Comment</p>
                    <p><b style="color: #2196F3;">
                    <?php 
                    $slcc=@mysqli_num_rows(@mysqli_query($con,"SELECT *
                    FROM comment
                    JOIN webinarkhachhang ON comment.idnick = webinarkhachhang.id
                    WHERE webinarkhachhang.idgioithieu = $_COOKIE[iduser] and comment.idcamp=$rgc[id] and comment.ao=1"));
                    echo $slcc;
                    ?>
                    </b></p>
                    </div>
                </a>
                <a href="/m/binar/?sent=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-paper-plane"></i></p><p class="te">Gửi Webinar</p><p><i class="fas fa-angle-right"></i></p></div></a>
                <a href="/m/binar/?link=<?php echo $rgc['id']?>"><div class="concon"><p><i class="fas fa-link"></i></i></p><p class="te">Lấy Link</p><p><i class="fas fa-angle-right"></i></p></div></a>
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
     