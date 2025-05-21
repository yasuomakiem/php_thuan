<style>

.kh .cuoi a {
    padding: 5px 0;
    display: inline-table;
    width: 32.3%;
    text-align: center;
    box-shadow: 0 0 1px #b1b1b1;
    font-size: 0.9em;
}
</style>
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/nguyen-ly-trong-chien-luoc-dai-duong-xanh.jpg" />
                <div class="dealright">
                <p><b>Danh sách khách hàng</b></p>
                <?php
                $tm=date("Y").date("m").date("d").'000000';
                $tm=intval($tm);
                $homnay=@mysqli_num_rows(@mysqli_query($con,"select id from khachhang where iduser=$_COOKIE[iduser] and timecs>$tm"));
                $sll=@mysqli_num_rows(@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] order by timecs asc"));
                ?>
                <p style="font-size: 0.88em;">
                Tổng số: <b><?php echo $sll?></b>  &nbsp; 
                Chăm sóc: <span class="badge" style="background: yellow; color: red;"><?php echo $homnay?></span>
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <div class="boxland">
            <?php
            if($ds=='danhsachnguoiquen' or $ds==''){ 
                if(isset($_GET['add'])){?>
            <div class="row">
            <div class="col-md-12">
            
            <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/danhsachnguoiquen/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Thêm KH</h4>
            
            <form role="form">
                <div id="thongbao"></div>
                  <div class="form-group">
                    <input type="text" name="ten" class="form-control" id="hoten" required="" placeholder="Tên KH (*)" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="uid" class="form-control" id="uid" placeholder="UID facebook hoặc link 1 bài viết bất kỳ" />
                  </div>
                  <div class="form-group">
                    <input type="number" name="phone" class="form-control" id="phone"  placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="tiktok" class="form-control" id="tiktok"  placeholder="Link Tiktok" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="tag" class="form-control" id="tag"  placeholder="Đặt tag" />
                    <p style="padding-top: 6px; font-size: 0.8em;"><i>Tag là những từ khóa giúp phân loại khách hàng tốt nhất. Vd: nhóm ABC, khách ngoài, kh cũ, bạn cũ... Mỗi tag cách nhau 1 dấu phẩy (,) Để sau khi bấm vào "KH cũ" thì tất cả những ai có tag là "KH cũ" sẽ hiển thị</i></p>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="ghichu" rows="3" name="ghichu" placeholder="Ghi chú"><?php echo $ghh?></textarea>
                  </div>
                  <div class="form-group">
                  <select class="form-control" id="danhsach">
                  <option value="0">Chọn tệp lưu...</option>
                  <?php
                  $tds=@mysqli_query($con,"select * from danhsach where idu=$_COOKIE[iduser] order by time desc");
                  if(@mysqli_num_rows($tds)==0){
                  }else{
                    while($rds=@mysqli_fetch_assoc($tds)){
                  ?>
                    <option value="<?php echo $rds['id']?>"><?php echo $rds['ten']?></option>
                  <?php }}?>
                </select>
                </div>
                  <button type="button" id="them" class="btn btn-primary" name="them"><i class="fas fa-plus-circle"></i> Thêm danh sách</button>
                </form>
            <script>
                        $('body').ready(function(){
                            $('#them').click(function(){
                            var hoten = $('#hoten').val();
                            var uid = $('#uid').val();
                            var phone = $('#phone').val();
                            var tiktok = $('#tiktok').val();
                            var tag = $('#tag').val();
                            var ghichu = $('#ghichu').val();
                            var danhsach = $('#danhsach').val();
                            if(hoten==''){
                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Nhập tên KH</p>');
                                $('#hoten').focus();
                                 setTimeout(function(){
                                    $('#thongbao').html('');
                                },4000)
                                return false;
                            }
                            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                            if (vnf_regex.test(phone) == false && phone!='') 
                            {
                                $('#thongbao').html('<p style="color:red; font-size:0.9em" class="text-center"><i class="fas fa-exclamation-triangle"></i> Số điện thoại của bạn không đúng!</p>');
                                $('#phone').focus();
                               setTimeout(function(){
                                    $('#thongbao').html('');
                                },4000)
                                return false;
                            }
                            if(uid!=''){
                                $.ajax({
                                    url : "ajax_nguoiquen.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { 
                                    typeform : 'kiemtrauid',
                                    uid : uid
                                },
                                success : function (data){
                                    var uidok = Number(data);
                                    if(Number(data)==0){
                                        $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> UID không đúng định dạng. Hãy xem lại video hướng dẫn phía dưới</p>');
                                        $('#uid').val('');
                                        $('#uid').focus();
                                        setTimeout(function(){
                                            $('#thongbao').html('');
                                        },4000);
                                        return false;
                                    }else{
                                    $.ajax({
                                            url : "ajax_nguoiquen.php", 
                                            type : "post",
                                            dateType:"text",
                                            data : { 
                                            typeform : 'luukhachhang',
                                                hoten : hoten,
                                                phone : phone,
                                                danhsach:danhsach,
                                                tiktok : tiktok,
                                                tag : tag,
                                                ghichu : ghichu,
                                                uid : uid
                                        },
                                        success : function (data2){
                                            if(Number(data2)==1){
                                                $('#thongbao').html('<p style="color:#4caf50" class="text-center"><i class="fas fa-check"></i> Thêm người quen thành công</p> <p class="text-center"><button type="button" class="btn btn-primary" onclick="location.href=\'/m/danhsachnguoiquen/\'">Danh sách</button> <button type="button" onclick="location.href=\'/m/danhsachnguoiquen/?add=1\'" class="btn btn-primary">Thêm tiếp</button></p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                    window.location="/m/danhsachnguoiquen/";
                                                },10000)
                                            }else if(Number(data2)==3){
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Người này đã được thêm rồi bạn ạ</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }else{
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công (#400)</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }
                                        }
                                    });    
                                    }
                                }
                                });
                            }else{
                                $.ajax({
                                            url : "ajax_nguoiquen.php", 
                                            type : "post",
                                            dateType:"text",
                                            data : { 
                                            typeform : 'luukhachhang',
                                                hoten : hoten,
                                                phone : phone,
                                                tag : tag,
                                                danhsach:danhsach,
                                                tiktok : tiktok,
                                                ghichu : ghichu,
                                                uid : uid
                                        },
                                        success : function (data2){
                                            if(Number(data2)==1){
                                                $('#thongbao').html('<p style="color:#4caf50" class="text-center"><i class="fas fa-check"></i> Thêm KH thành công</p> <p class="text-center"><button type="button" class="btn btn-primary" onclick="location.href=\'/m/danhsachnguoiquen/\'">Danh sách</button> <button type="button" onclick="location.href=\'/m/danhsachnguoiquen/?add=1\'" class="btn btn-primary">Thêm tiếp</button></p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },10000)
                                            }else if(Number(data2)==3){
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Người này đã được thêm rồi bạn ạ</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }else{
                                                $('#thongbao').html('<p style="color:red" class="text-center"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công (#400)</p>');
                                                setTimeout(function(){
                                                    $('#thongbao').html('');
                                                },4000)
                                            }
                                        }
                                    });
                            }
                            
                            })
                            })
                        </script>
                <hr />
                <!--h4 class="titdulieu" style="font-size: 14px;">Hướng dẫn thêm người quen</h4-->
                
                </div>
            </div>
            <?php }elseif(isset($_GET['edit'])){
                $edit=intval($_GET['edit']);
                $redit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from khachhang where id=$edit and iduser=$u[id]"));
                if(isset($_POST['sua'])){
            $ten=addslashes($_POST['ten']);
            $tiktok=addslashes($_POST['tiktok']); 
            $uid=addslashes($_POST['uid']); 
            $uid=layuid($uid);
            if($uid==0){$uid='';}
            $phone=addslashes($_POST['phone']);
            $tagg=addslashes(str_replace(", ",",",str_replace(" ,",",",$_POST['tag'])));
            $tag=trim(strtolower($tagg));   
                $in="update khachhang set ten=N'$ten',uid='$uid',phone='$phone',tiktok=N'$tiktok',tag=N'$tag' where id=".intval($_GET['edit'])." and iduser=".$_COOKIE['iduser'];
                $q=mysqli_query($con,$in);
                if($q){
                    echo '
                    <script language="JavaScript">
                    var my_timeout=setTimeout("gotosite();",0);
                    function gotosite()
                    {
                    window.location="/m/danhsachnguoiquen/";
                    }
                    </script>
                    ';// cái này là chuyển trang bằng javascript
                    exit();
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
                ?>
                <div class="row">
                <div class="col-md-12">
                <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/danhsachnguoiquen/"><i class="fas fa-arrow-left"></i> Quay lại</a> / Sửa thông tin</h4>
            <style>
            p.tenn{
                margin-bottom: 3px;
                font-size: 0.9em;
                font-style: italic;
                color: #ca7a03;
            }
            </style>
            <form role="form" action="" method="post">
                <?php echo $thongbao?>
                <p></p>
                  <div class="form-group">
                    <p ><i class="fas fa-user"></i> Họ tên:</p>
                    <input type="text" name="ten" class="form-control" id="" required="" placeholder="Tên khách hàng" value="<?php echo $redit['ten']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fab fa-facebook"></i> UID hoặc link 1 bài viết bất kỳ:</p>
                    <input type="text" name="uid" class="form-control" id="" placeholder="UID hoặc link" value="<?php echo $redit['uid']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-phone"></i> Số điện thoại:</p>
                    <input type="number" name="phone" class="form-control" id=""  placeholder="Số điện thoại" value="<?php echo $redit['phone']?>">
                  </div>
                  <div class="form-group">
                  <p ><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg> Link Tiktok:</p>
                    <input type="text" name="tiktok" class="form-control" id=""  placeholder="Link Tiktok" value="<?php echo $redit['tiktok']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-tags"></i> Tag phân loại:</p>
                    <input type="text" name="tag" class="form-control" id=""  placeholder="Đặt tag" value="<?php echo $redit['tag']?>">
                    <p style="padding-top: 6px; font-size: 0.8em;"><i>Tag là những từ khóa giúp phân loại khách hàng tốt nhất. Vd: nhóm ABC, khách ngoài, kh cũ, bạn cũ... Mỗi tag cách nhau 1 dấu phẩy (,) Để sau khi bấm vào "KH cũ" thì tất cả những ai có tag là "KH cũ" sẽ hiển thị</i></p>
                  </div>
                  <button type="submit" class="btn btn-primary" name="sua"><i class="fas fa-edit"></i> Sửa thông tin</button>
                </form>
                <hr />
                </div>
            </div>
            <?php }else{?>
            <div class="row">
                <div class="col-md-12">
                <form class="form-inline">
                      <div class="form-group" style="width: 100%;">
                        <div class="input-group" style="width: 100%;margin-bottom: 10px;">
                          <input style="border-right: 0;" type="text" class="form-control" id="exampleInputAmount" placeholder="Tên hoặc số điện thoại">
                          <div style="background: none;width: 40px;" class="input-group-addon"><i class="fas fa-search-dollar"></i></div>
                        </div>
                      </div>
                </form>
                
                <style>#seach{display: none;}</style>
                <script>
                $(function() {  
                $('#exampleInputAmount').keyup(function(){
                        $('#nomal').hide();
                        $('#seach').show();
                        var key=$('#exampleInputAmount').val();
                        if(key==''){
                            $('#seach').hide();
                            $('#nomal').show();
                        }else{
                        $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            key : key,
                            loai:0,
                            idxem : <?php echo $_COOKIE['iduser']?>,
                            chinhchu : 1,
                            typeform : "searchkhtn"
                        },
                        success : function (result2){
                            $('#seach').html(result2);
                        },
                        error:function(){              }
                        });
                        }
                });
                /*$("#datuongtac<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            typeform : "activett"
                        },
                        success : function (result2){
                            $('#khung<?php echo $rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });*/
                });
                </script>
                <div id="seach"></div>
                <div id="nomal">
                <?php
                if(isset($_GET['list'])){
                    $themlist='and danhsach LIKE \'%*'.intval($_GET['list']).'*%\'';
                }else{
                    $themlist='';
                }
                if(isset($_GET['tag'])){
                    $nametag=addslashes($_GET['tag']);
                    if($nametag=='Yêu thích'){
                    $khtn=@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] $themlist and love=1 order by timecs asc");
                    }else{
                    $khtn=@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] $themlist and tag like N'%$nametag%' order by timecs asc");
                    }
                    $khtn2=@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] $themlist order by timecs asc");
                    $solg=@mysqli_num_rows($khtn2);
                    $them='?tag='.$nametag.'&page=';
                }else{
                $khtn=@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] $themlist order by timecs asc");
                $solg=@mysqli_num_rows($khtn);
                $them='?page=';
                }
                $tm=date("Y").date("m").date("d").'000000';
                $tm=intval($tm);
                $homnay=@mysqli_num_rows(@mysqli_query($con,"select id from khachhang where iduser=$_COOKIE[iduser] $themlist and timecs>$tm"));
                ?>
            
            <p>Tổng số: <b><?php echo $solg?></b> <span class="badge" title="Số tương tác hôm nay"><?php echo $homnay?></span> <a style="float: right;" href="/m/danhsachnguoiquen/?add=1"><i class="fas fa-plus-circle"></i> Thêm danh sách</a></p>
            <div class="btn-group" style="margin-bottom: 20px;">
            <button type="button" style=" border: 0;" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
            <?php if(!isset($_GET['list'])){echo 'Xem tất cả ';}else{
                $li=intval($_GET['list']);
                $timten=@mysqli_fetch_assoc(@mysqli_query($con,"select ten from danhsach where id=$li"));
                echo $timten['ten'];
            }?>
            &nbsp;<span class="caret"></span>
            </button>
            <style>
            .dropdown-menu>li>a.nutthem{
                margin-left: 20px !important;
                margin-right: 20px;
                color: white;
                margin-bottom: 10px
            }
            .dropdown-menu>li>a.nutthem:hover{
                background: #0000A0;
            }
            </style>
              <ul class="dropdown-menu" role="menu">
              <li><a href="/m/danhsachnguoiquen/">Xem tất cả</a></li>
              <?php
              $tds=@mysqli_query($con,"select * from danhsach where idu=$_COOKIE[iduser] order by time desc");
              if(@mysqli_num_rows($tds)==0){
              }else{
                while($rds=@mysqli_fetch_assoc($tds)){
              ?>
                <li><a href="/m/danhsachnguoiquen/?list=<?php echo $rds['id']?>"><?php echo $rds['ten']?> (<?php echo @mysqli_num_rows(@mysqli_query($con,"select id from khachhang where iduser=$_COOKIE[iduser] and danhsach LIKE '%*$rds[id]*%'"))?>)</a></li>
              <?php }}?>
                <li class="divider"></li>
                <li><a style="" type="button" class="btn btn-xs btn-primary nutthem" onclick="showpopupds()"><i class="fas fa-folder-plus"></i> Tạo tệp</a>
                <a  class="btn btn-xs btn-primary nutthem" type="button" href="/m/chuyends/?ds=chuyen"><i class="fas fa-bars"></i> Danh sách</a></li>
                
                <li></li>
              </ul>
            </div>
            <a href="/m/danhsachnguoiquen/?tag=Yêu+thích" class="btn btn-default btn-xs" style="margin-bottom: 20px;float: right; border: 0;" type="button"><i style="color: #65cc04;" class="fas fa-star"></i> Yêu thích <span class="badge" style="background: #65cc04;" id="dsyeuthich"><?php echo @mysqli_num_rows(@mysqli_query($con,"select id from khachhang where iduser=$me[id] and love=1"))?></span></a>
            <?php if(isset($_GET['tag'])){?>
            <p style="background: aliceblue;padding: 5px 10px;font-size: 0.9em;font-style: italic;">Tìm tag: <span><?php echo $nametag?></span> <a style="float: right;font-size: 0.9em; color: red;" href="/m/danhsachnguoiquen/"><i class="fas fa-trash-alt"></i> Xóa tag</a></p>
            <?php }?>
            <div class="clearfix"></div>
            <?php
            if($solg==0){
                if(isset($_GET['list'])){
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Không có khách hàng nào trong danh sách này.</p>';
                }else{
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Chưa có khách hàng nào được thêm vào.<br /><br /><a href="/m/danhsachnguoiquen/?add=1"  type="button" class="btn btn-primary">Thêm ngay vào danh sách</a></p>';
                    
                }}
            $page=isset($_GET["page"])?intval($_GET["page"]):1;
            if(isset($_GET['view'])){$rows_per_page=$_GET['view'];}else{$rows_per_page=60;}
            $page_start=($page-1)*$rows_per_page;
            $page_end=$page*$rows_per_page;
            $number_of_page=ceil($solg/$rows_per_page);
            if ($number_of_page>1)
            {
            // Ti?n h�nh in t?ng trang //
            for ($i=1; $i<=$number_of_page; $i++)
            {	
            // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
            if ($i==$page)
            {			
            $list_page.="<li class=\"active\"><span>$i</span></li>";
            }
            // Ngu?c l?i... //
            else
            {
                            //trường hợp có từ 6 trang trở lên thì tạo ra ...
            if($number_of_page>8){
            if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
            if($i<7){
            $list_page.="<li><a href=\"/m/danhsachnguoiquen/".$them.$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"/m/danhsachnguoiquen/".$them.$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"/m/danhsachnguoiquen/".$them.$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"/m/danhsachnguoiquen/".$them.$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"/m/danhsachnguoiquen/".$them.=$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"/m/danhsachnguoiquen/".$them."1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"/m/danhsachnguoiquen/".$them.$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){ $pcong=$page+1;
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"/m/danhsachnguoiquen/".$them.$pcong."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-right\"></i></span>
        		</a>
        	</li>
            ";
            }
            //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ <V
            if(1!=$page){
                $ptru=$page-1;
            $list_page="
            <li>
        		<a class=\"first \" aria-label=\"Previous\" href=\"/m/danhsachnguoiquen/".$them.$ptru."\">
        			<span aria-hidden=\"true\"><i class=\"fa fa-angle-left\"></i></span>
        		</a>
        	</li>
            ".$list_page;
            }
            	
            }
            //end phân trang
            $ii=1;
            $a=0;
            $i=1;
            while($rkh=@mysqli_fetch_assoc($khtn)){
                if ($ii>$page_start){
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 kh" id="khung<?php echo $rkh['id']?>">
                <p><b><?php echo $i?>. <?php echo $rkh['ten']?></b> &nbsp;&nbsp;&nbsp;&nbsp; <i style="color: <?php if($rkh['love']==1){echo '#65cc04';}else{echo 'silver';}?>; cursor: pointer;" id="<?php if($rkh['love']==1){echo 'dellove'.$rkh['id'];}else{echo 'addlove'.$rkh['id'];}?>" class="fas fa-star" title="Danh sách yêu thích"></i></p>
                <p class="nut">
                <?php if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" href='fb://profile/<?php echo $rkh['uid']?>'>Tường</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" href='https://www.facebook.com/<?php echo $rkh['uid']?>'>Tường</a> 
                <?php }?>
                <?php if($rkh['tiktok']!=''){?>
                <a type="button" style="background: black;color: white;" class="btn btn-primary btn-xs" href='<?php echo $rkh['tiktok']?>'>Tiktok</a> 
                <?php }?>
                <?php if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" href='https://fb.com/msg/<?php echo $rkh['uid']?>'>Message</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" href='https://www.facebook.com/messages/t/<?php echo $rkh['uid']?>'>Message</a> 
                <?php }?>
                <?php if($rkh['phone']!=''){?><a type="button" class="btn btn-info btn-xs" href='https://zalo.me/<?php echo $rkh['phone']?>'>Zalo</a><?php }?>
                <?php if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href='tel:<?php echo $rkh['phone']?>'>Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $rkh['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href='sms:<?php echo $rkh['phone']?>'>SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $rkh['phone']?>');">SMS</a>
                <?php }?>
                </p>
                <div id="note<?php echo $rkh['id']?>">
                <?php
                $gc=explode("***",$rkh['ghichu']);
                for($j=0;$j<count($gc);$j++){
                ?>
                <p class="note"><?php echo $gc[$j]?></p>
                <?php }?>
                </div>
                <p class="cuoi" style="padding-bottom: 0;">
                <a href="javascritp:void(0)" id="datuongtac<?php echo $rkh['id']?>"><i class="fas fa-user-shield"></i> Đã tương tác</a> 
                <a id="showpopup<?php echo $rkh['id']?>" href="javascritp:void(0)"><i class="far fa-clipboard"></i> Thêm chú thích</a>
                <a id="tagdown<?php echo $rkh['id']?>" href="javascritp:void(0)"><i class="fas fa-angle-down"></i> Tag</a>
                <a id="tagup<?php echo $rkh['id']?>" style="display: none;" href="javascritp:void(0)"><i class="fas fa-angle-up"></i> Tag</a>
                <script>
                $(function() {  
                $('#tagdown<?php echo $rkh['id']?>').click(function(){
                        $('#tagdown<?php echo $rkh['id']?>').hide();
                        $('#showtag<?php echo $rkh['id']?>').slideDown();
                        $('#tagup<?php echo $rkh['id']?>').show();
                });
                $('#tagup<?php echo $rkh['id']?>').click(function(){
                        $('#tagup<?php echo $rkh['id']?>').hide();
                        $('#showtag<?php echo $rkh['id']?>').slideUp();
                        $('#tagdown<?php echo $rkh['id']?>').show();
                });
                $("#datuongtac<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            loai : 0,
                            typeform : "activett"
                        },
                        success : function (result2){
                            //window.location="khachhang/tiemnang.html";
                            //alert(result2);
                            $('#khung<?php echo $rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                $("#addlove<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            typeform : "addlove"
                        },
                        success : function (result2){
                            $("#addlove<?php echo $rkh['id']?>").css('color','#65cc04');
                            $('#dsyeuthich').html(result2);
                        },
                        error:function(){              }
                        });
                    return false;
                });
                $("#dellove<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            typeform : "dellove"
                        },
                        success : function (result2){
                            $("#dellove<?php echo $rkh['id']?>").css('color','silver');
                            $('#dsyeuthich').html(result2);
                            <?php if(isset($_GET['tag']) and $_GET['tag']=='Yêu thích'){?>
                            $("#khung<?php echo $rkh['id']?>").hide();
                            <?php }?>
                        },
                        error:function(){              }
                        });
                    return false;
                });
                $("#damua<?php echo $rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax_nguoiquen.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?php echo $rkh['id']?>,
                            typeform : "chuyen_tiem_nang_da_mua"
                        },
                        success : function (result2){
                            //window.location="khachhang/tiemnang.html";
                            //alert(result2);
                            $('#khung<?php echo $rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                $('#showpopup<?php echo $rkh['id']?>').click(function(){
                        $('#droplive').fadeIn();
                        $('.popuplive').show();
                        $('#idkhach').val('<?php echo $rkh['id']?>');
                        $('#tenkhachhang').html('<?php echo $rkh['ten']?>');
                        <?php if($rkh['diem']==1){?>
                                $('#s1').addClass('xanh');
                                $('#s2').removeClass('xanh');
                                $('#s3').removeClass('xanh');
                                $('#s4').removeClass('xanh');
                                $('#s5').removeClass('xanh');
                                $('#s6').removeClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('1');
                        <?php }?>
                        <?php if($rkh['diem']==2){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').removeClass('xanh');
                                $('#s4').removeClass('xanh');
                                $('#s5').removeClass('xanh');
                                $('#s6').removeClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('2');
                        <?php }?>
                        <?php if($rkh['diem']==3){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').removeClass('xanh');
                                $('#s5').removeClass('xanh');
                                $('#s6').removeClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('3');
                        <?php }?>
                        <?php if($rkh['diem']==4){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').removeClass('xanh');
                                $('#s6').removeClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('4');
                        <?php }?>
                        <?php if($rkh['diem']==5){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').removeClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('5');
                        <?php }?>
                        <?php if($rkh['diem']==6){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').addClass('xanh');
                                $('#s7').removeClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('6');
                        <?php }?>
                        <?php if($rkh['diem']==7){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').addClass('xanh');
                                $('#s7').addClass('xanh');
                                $('#s8').removeClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('7');
                        <?php }?>
                        <?php if($rkh['diem']==8){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').addClass('xanh');
                                $('#s7').addClass('xanh');
                                $('#s8').addClass('xanh');
                                $('#s9').removeClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('8');
                        <?php }?>
                        <?php if($rkh['diem']==9){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').addClass('xanh');
                                $('#s7').addClass('xanh');
                                $('#s8').addClass('xanh');
                                $('#s9').addClass('xanh');
                                $('#s10').removeClass('xanh');$('#diemtiemnang').val('9');
                        <?php }?>
                        <?php if($rkh['diem']==10){?>
                                $('#s1').addClass('xanh');
                                $('#s2').addClass('xanh');
                                $('#s3').addClass('xanh');
                                $('#s4').addClass('xanh');
                                $('#s5').addClass('xanh');
                                $('#s6').addClass('xanh');
                                $('#s7').addClass('xanh');
                                $('#s8').addClass('xanh');
                                $('#s9').addClass('xanh');
                                $('#s10').addClass('xanh');$('#diemtiemnang').val('10');
                        <?php }else{?>
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
                        <?php } ?>
                        });
                });
                </script>
                </p>
                <p class="tag" id="showtag<?php echo $rkh['id']?>">
                <?php
                $tg=explode(",",$rkh['tag']);
                for($h=0;$h<count($tg);$h++){
                    if($tg[$h]!=''){
                ?>
                <a href="/m/danhsachnguoiquen/?tag=<?php echo $tg[$h]?>"><i class="fas fa-tags"></i> <?php echo ucfirst($tg[$h])?></a>
                <?php }}?>
                </p>
                <p class="cuoi" style="padding-top: 0px;">
                <!--a href="addnhacnho?id=<?php echo $rkh['id']?>" style="color: #FF8080;"><i class="fas fa-bullhorn"></i> Nhắc</a>  &nbsp;&nbsp; -->
                <a href="/m/chuyends/?ds=chuyen&id=<?php echo $rkh['id']?>" style="color: #009688;"><i class="fas fa-user-plus"></i> Tệp</a>
                <a style="color: #FF8000;" href="/m/danhsachnguoiquen/?edit=<?php echo $rkh['id']?>"><i class="fas fa-edit"></i> Sửa</a>
                <a style="color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa người này?')" href="del.php?del=<?php echo $rkh['id']?>&table=khachhang&iduser=<?php echo $rkh['iduser']?>"><i class="fas fa-trash-alt"></i> Xóa</a> 
                 
                
                <!--a href="javascritp:void(0)"><i class="fas fa-user-clock"></i> Đại lý TN</a-->
                </p>
                <div class="ddiem" id="ddiem<?php echo $rkh['id']?>" style="<?php if($rkh['diem']>0){?>display:block;<?php }else{?>display:none;<?php }?>"><span id="diem<?php echo $rkh['id']?>"><?php echo $rkh['diem']?></span><sup>đ</sup></div>
            </div>    
            
            <?php }$i++;?>
            <?php
            if ($ii>=$page_end)
            {
            break;	
            }
            $ii++;
            } 
                if(isset($list_page)){
                $listxxx=('
                <div class="filter-right" style="margin-bottom:50px">
                <div class="collection-pagination text-center pagination-wrapper">       
                <ul class="pagination">
                '.$list_page.'
                </ul>
                </div>
				</div><!-- End. Filter 2-->
                ');
                }else{$listxxx='';}?> 
            <p>&nbsp;</p>
            <?php echo $listxxx?>
            <!--p class="text-center"> <a href="https://drive.google.com/file/d/1ADRhobM4F6w7K1G1PY6ek51V-iWFO4K8/view" target="_blank"><i class="far fa-play-circle"></i> Video hướng dẫn</a></p-->
            <p>&nbsp;</p>          
            </div>    
            </div>
            <div class="clearfix"></div>
            
            
            </div>
            <?php }?>
            <?php }?>
            
            <?php if($ds=='chuyen'){require_once('in/chuyen.php');}?>
            <?php if($ds=='addnhacnho'){require_once('in/addnhacnho.php');}?>
            </div>
            <div class="clearfix"></div>
</div>
     