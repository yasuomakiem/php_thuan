<?if($_GET['list']==1){$tenlist='Saler';}elseif($_GET['list']==2){$tenlist= 'Kỹ thuật';}else{$tenlist= 'Khách hàng';}?>
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/nguyen-ly-trong-chien-luoc-dai-duong-xanh.jpg" />
                <div class="dealright">
                <p><b>Tài khoản <?=$tenlist?></b></p>
                <?
                $sll=@mysql_num_rows(@mysql_query("select * from user where nhanvien=$_GET[list]"));
                ?>
                <p style="font-size: 0.88em;">
                Tổng số: <b><?=$sll?></b> <span class="badge" title="Số tương tác hôm nay"><?=$homnay?></span>
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="boxland">
            
            <?if(isset($_GET['add'])){
                if(isset($_POST['them'])){
                    $fullname=addslashes($_POST['ten']);
                    $phone=addslashes($_POST['phone']);
                    $email=addslashes($_POST['email']);
                    $pass=addslashes($_POST['pass']);
                    $uid=layuid(addslashes($_POST['uid']));
                    $password=md5($pass);
                    $nganhang=addslashes($_POST['nganhang']);
                    $avatar =trim(addslashes($_POST['avatar']));
                    $nhanvien=intval($_GET['list']);
                    $in=@mysql_query("insert into user (fullname,phone,pass,passro,uid,email,avatar,nganhang,nhanvien,time)value(N'$fullname','$phone',N'$password',N'$pass','$uid',N'$email',N'$avatar',N'$nganhang',$nhanvien,$time)");
                    if($in){
                        echo '<script>window.location="/m/danhsachuser/?list='.$_GET['list'].'";</script>';
                    }else{
                        $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                    }
                }
                ?>
            
            <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/danhsachuser/?list=<?=$_GET['list']?>"><i class="fas fa-arrow-left"></i> Quay lại</a> / Thêm tài khoản <?=$tenlist?></h4>
            <div class="boxme">
            <form role="form" action="" method="post">
                <div id="thongbao"><?=$thongbao?></div>
                  <div class="form-group">
                    <input type="text" name="ten" class="form-control" id="hoten" required="" placeholder="Tên <?=$tenlist?> (*)" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="uid" class="form-control" id="uid" placeholder="UID facebook hoặc link 1 bài viết bất kỳ" />
                  </div>
                  <div class="form-group">
                    <input type="number" name="phone" class="form-control" id="phone"  placeholder="Số điện thoại" />
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email"  placeholder="Email" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="pass" class="form-control" id="pass" placeholder="Mật khẩu" />
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="nganhang" rows="3" name="nganhang" placeholder="Thông tin ngân hàng"></textarea>
                  </div>
                  <div style="color: red;" class="status"></div>
                  <label>Hình ảnh</label>
            <br />
            <div id="showthu1" class="chonanh" onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" id="data_picture1" name="avatar" />
            
            <div class="clearfix"></div>
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
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
                url: 'uploads_avatar_kh.php', // gửi đến file upload.php 
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
                  <button type="submit" id="them" class="btn btn-primary" name="them"><i class="fas fa-plus-circle"></i> Thêm tài khoản</button>
                </form>
                </div>
                
            <?}elseif(isset($_GET['edit'])){
                $edit=intval($_GET['edit']);
                $redit=@mysql_fetch_assoc(@mysql_query("select * from user where id=$edit"));
                if(isset($_POST['sua'])){
                    $fullname=addslashes($_POST['fullname']);
                    $phone=addslashes($_POST['phone']);
                    $email=addslashes($_POST['email']);
                    $pass=addslashes($_POST['pass']);
                    $uid=layuid(addslashes($_POST['uid']));
                    $password=md5($pass);
                    $nganhang=addslashes($_POST['nganhang']);
                    $avatar =trim(addslashes($_POST['anh1']));
                    
                $in="update user set fullname=N'$fullname',uid='$uid',phone='$phone',email=N'$email',avatar=N'$avatar',pass='$password',passro='$pass',nganhang=N'$nganhang' where id=".intval($_GET['edit']);
                $q=mysql_query($in);
                if($q){
                    echo '
                    <script language="JavaScript">
                    var my_timeout=setTimeout("gotosite();",0);
                    function gotosite()
                    {
                    window.location="/m/danhsachuser/?list='.$_GET['list'].'";
                    }
                    </script>
                    ';// cái này là chuyển trang bằng javascript
                    exit();
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
                ?>
                
                <h4 class="titdulieu" style="font-size: 14px;margin-bottom: 15px;"><a href="/m/danhsachuser/?list=<?=$_GET['list']?>"><i class="fas fa-arrow-left"></i> Quay lại</a> / Sửa thông tin</h4>
            <style>
            p.tenn{
                margin-bottom: 3px;
                font-size: 0.9em;
                font-style: italic;
                color: #ca7a03;
            }
            </style>
            <div class="boxme">
            <form role="form" action="" method="post">
                <?=$thongbao?>
                <p></p>
                  <div class="form-group">
                    <p ><i class="fas fa-user"></i> Họ tên:</p>
                    <input type="text" name="fullname" class="form-control" id="" required="" placeholder="Tên " value="<?=$redit['fullname']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fab fa-facebook"></i> UID hoặc link 1 bài viết bất kỳ:</p>
                    <input type="text" name="uid" class="form-control" id="" placeholder="UID hoặc link" value="<?=$redit['uid']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-phone"></i> Số điện thoại:</p>
                    <input type="number" name="phone" class="form-control" id=""  placeholder="Số điện thoại" value="<?=$redit['phone']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-phone"></i> Email:</p>
                    <input type="text" name="email" class="form-control" id=""  placeholder="" value="<?=$redit['email']?>">
                  </div>
                  <div class="form-group">
                  <p ><i class="fas fa-phone"></i> Mật khẩu:</p>
                    <input type="text" name="pass" class="form-control" id=""  placeholder="" value="<?=$redit['passro']?>">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="nganhang" rows="3" name="nganhang" placeholder="Thông tin ngân hàng"><?=$redit['nganhang']?></textarea>
                  </div>
                  <div style="color: red;" class="status"></div>
                  <label>Hình ảnh</label>
            <br />
            <div id="showthu1" class="chonanh" <?if($redit['avatar']!=''){?>style="background-image: url('upload/avatar/<?=$redit['avatar']?>');background-size: cover;"<?}?> onclick="document.getElementById('main_picture1').click();"></div>
            <input type="file" id="main_picture1" name="image1" style="display: none;" accept="image/*"/> 
            <input type="hidden" name="anh1" id="data_picture1" value="<?=$redit['avatar']?>" />
            
            
            <div class="clearfix"></div>
                <script>
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#showthu1').html('<div style="width: 100%; height: 96px;border-radius: 10px;margin: 2px auto;background: url('+e.target.result+'); background-size: cover;background-position: center;"></div>');
                            
                        }
                        reader.readAsDataURL(input.files[0]);
                        uploadimage('main_picture1');
                    }
                }
                $("#main_picture1").change(function() {
                    readURL1(this);
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
                            url: 'uploads_kh.php', // gửi đến file upload.php 
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
                  <button type="submit" class="btn btn-primary" name="sua"><i class="fas fa-edit"></i> Sửa thông tin</button>
                </form>
                <hr />
             </div>   
            <?}else{?>
                <form class="form-inline">
                      <div class="form-group" style="width: 100%;">
                        <div class="input-group" style="width: 100%;margin-bottom: 10px;">
                          <input style="border: 0;" type="text" class="form-control" id="exampleInputAmount" placeholder="Tên hoặc số điện thoại">
                          <div style="background: none;width: 50px;border: 0;background: #03a9f4;color: white;" class="input-group-addon"><i class="fas fa-search-dollar"></i></div>
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
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            key : key,
                            loai:0,
                            idxem : <?=$_COOKIE['iduser']?>,
                            chinhchu : 1,
                            typeform : "searchkhtn_admin"
                        },
                        success : function (result2){
                            $('#seach').html(result2);
                        },
                        error:function(){              }
                        });
                        }
                });
                /*$("#datuongtac<?=$rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?=$rkh['id']?>,
                            typeform : "activett"
                        },
                        success : function (result2){
                            $('#khung<?=$rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });*/
                });
                </script>
                <div id="seach"></div>
                <div id="nomal">
                <?
                
                    $themlist=' nhanvien ='.intval($_GET['list']);
                    $khtn=@mysql_query("select * from user where nhanvien=3 order by id asc");
                    $solg=@mysql_num_rows($khtn);
                    $them='?page=';
                ?>
            
            
            </p>
            <div class="clearfix"></div>
            <?
            if($solg==0){
                if(isset($_GET['list'])){
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Không có khách hàng nào trong danh sách này.</p>';
                }elseif(isset($_GET['love'])){
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Không có khách hàng nào trong danh sách này.</p>';
                }else{
                    echo '<p class="text-center" style="color: #f44336;"><i class="fas fa-exclamation-triangle"></i> Chưa có khách hàng nào được thêm vào.<br /><br /><a href="/m/khachhang/?add=1"  type="button" class="btn btn-primary">Thêm ngay vào danh sách</a></p>';
                }
                }
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
            $list_page.="<li><a href=\"/m/danhsachtaikhoan/".$them.$i."\">".$i."</a></li>";
            }
            }elseif($page>=($number_of_page-3)){
            if($i>($number_of_page-7)){
            $list_page.="<li><a href=\"/m/danhsachtaikhoan/".$them.$i."\">".$i."</a></li>";
            }
            }else{
            $chamdauduoi=1;
            if($i>($page-3) and $i<($page+3)){
            $list_page.="<li><a href=\"/m/danhsachtaikhoan/".$them.$i."\">".$i."</a></li>";
            }
            }
            }else{//còn không thì cộng list_page bình thường
            $list_page.="<li><a href=\"/m/danhsachtaikhoan/".$them.$i."\">".$i."</a></li>";
            }
            }
            }
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
            if($number_of_page>8 and $page<=4){$list_page=$list_page."<li>...</li><li><a href=\"/m/danhsachtaikhoan/".$them.=$number_of_page."\">".$number_of_page."</a></li>";}
            //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
            if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<li>...</li>".$list_page;}
            //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
            if($chamdauduoi==1){$list_page="<li><a href=\"/m/danhsachtaikhoan/".$them."1\">1</a></li><li>...</li>".$list_page."<li>...</li>
            <li><a href=\"/m/danhsachtaikhoan/".$them.$number_of_page."\">".$number_of_page."</a></li>";}
            //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ >
            if($number_of_page!=$page){ $pcong=$page+1;
            $list_page=$list_page."
            <li>
        		<a class=\"last \" aria-label=\"Next\" href=\"/m/danhsachtaikhoan/".$them.$pcong."\">
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
        		<a class=\"first \" aria-label=\"Previous\" href=\"/m/danhsachuser/".$them.$ptru."\">
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
            while($rkh=@mysql_fetch_assoc($khtn)){
                if ($ii>$page_start){
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 kh" id="khung<?=$rkh['id']?>">
                <p><b><?=$i?>. <?=$rkh['fullname']?></b> [<?if($rkh['gioitinh']=='nu'){echo 'Nữ';}else{echo 'Nam';}?>] <i style="float: right;">Hạn dùng: <b><?if($rkh['timedichvu']==0){echo 'N/a';}else{echo retime_ngay($rkh['timedichvu']);}?></b></i></p>
                <p class="nut"> 
                <?if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" href="fb://profile/<?=$rkh['uid']?>">Tường</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" onclick="location.href='https://www.facebook.com/<?=$rkh['uid']?>'">Tường</a> 
                <?}?>
                <?if($rkh['uid']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" href="https://fb.com/msg/<?=$rkh['uid']?>">Messenger</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" href="https://www.facebook.com/messages/t/<?=$rkh['uid']?>">Messenger</a> 
                <?}?>
                <?if($rkh['phone']!=''){?><a type="button" class="btn btn-info btn-xs" href="https://zalo.me/<?=$rkh['phone']?>">Zalo</a><?}?>
                <?if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href="tel:<?=$rkh['phone']?>">Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?=$rkh['phone']?>');">Gọi</a>
                <?}?>
                <?if($rkh['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href="sms:<?=$rkh['phone']?>">SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?=$rkh['phone']?>');">SMS</a>
                <?}?>
                </p>
                <?
                $chuquan=@mysql_fetch_assoc(@mysql_query("select id,fullname from user where id=$rkh[upline]"));
                ?>
                <div class="thongtinu">
                    <p>ID: <b><?=$rkh['id']?></b></p>
                    <p>SĐT: <?=$rkh['phone']?> - <?=$rkh['email']?></p>
                    <?if($rkh['phone2']!=''){?>
                    <p>SĐT 2: <?=$rkh['phone2']?></p>
                    <?}?>
                    <p>MK: <?=$rkh['passro']?></p>
                    <p>Lĩnh vực: <?=$rkh['linhvuc']?></p>
                    <p>Ngày sinh: <?=$rkh['ngaysinh']?> - CMT: <?=$rkh['cmnd']?></p>
                    <?
                    $rtinh=@mysql_fetch_assoc(@mysql_query("select loai,ten from tinh where id=$rkh[tinh]"));
                    $rhuyen=@mysql_fetch_assoc(@mysql_query("select loai,ten from huyen where id=$rkh[huyen]"));
                    $rxa=@mysql_fetch_assoc(@mysql_query("select loai,ten from xa where id=$rkh[xa]"));
                    ?>
                    <p><?=$rxa['ten'].', '.$rhuyen['ten'].', '.$rtinh['ten']?></p>
                    <p>Tham gia: <?=retime($rkh['time'])?></p>
                    <p>Quản lý: <?=$chuquan['fullname']?></p>
                </div>
                <div class="cuoi" style="padding-bottom: 5px;">
                <div class="nutdieuhuong"><a href="/m/saletaotin/?kh=<?=$rkh['id']?>&add=1"><i class="far fa-clipboard"></i><br />Tạo tin</a></div> 
                <div class="nutdieuhuong"><a href="/m/saletaotin/?kh=<?=$rkh['id']?>"><i class="far fa-clipboard"></i><br />Danh sách tin</a></div>
                <div class="nutdieuhuong"><a style="color: #FF8000;" href="/m/taichinhkhachhang/?idkhach=<?=$rkh['id']?>"><i class="fas fa-hand-holding-usd"></i><br />Tài chính</a></div>
                
                <div class="clearfix"></div>
                <script>
                $(function() {  
                
                $("#datuongtac<?=$rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?=$rkh['id']?>,
                            loai : 0,
                            typeform : "timedichvuxong"
                        },
                        success : function (result2){
                            $('#khung<?=$rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                
                $("#damua<?=$rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            idkhach : <?=$rkh['id']?>,
                            typeform : "chuyen_tiem_nang_da_mua"
                        },
                        success : function (result2){
                            //window.location="khachhang/tiemnang.html";
                            //alert(result2);
                            $('#khung<?=$rkh['id']?>').slideUp();
                        },
                        error:function(){              }
                        });
                    return false;
                });
                $("#dangnhap<?=$rkh['id']?>").click(function()
                {
                    $.ajax({
                        url : "ajax.php",
                        type : "post", 
                        dateType:"text", 
                        data : { 
                            phone : '<?=$rkh['phone']?>',
                            password : '<?=$rkh['passro']?>',
                            typeform : "loginscore"
                        },
                        success : function (result2){
                            if(Number(result2)==0){
                                window.location="/m/cpanel/";
                            }
                        },
                        error:function(){              }
                        });
                    return false;
                });
                });
                </script>
                </div>
                
                <div class="cuoi" style="border-top: 0; padding-top: 10px;">
                <div class="nutdieuhuong"><a style="color: red;" onclick="return confirm('Bạn các chắc chắn muốn xóa người này?')" href="del.php?del=<?=$rkh['id']?>&table=user"><i class="fas fa-trash-alt"></i><br />Xóa</a> </div>
                <div class="nutdieuhuong"><a style="color: #FF8000;" href="/m/danhsachuser/?list=<?=$_GET['list']?>&edit=<?=$rkh['id']?>"><i class="fas fa-edit"></i><br />Sửa</a></div>
                <div class="nutdieuhuong"><a href="javascritp:void(0)" id="dangnhap<?=$rkh['id']?>" style="color: #009688;"><i class="fas fa-user-plus"></i><br />Đăng nhập</a> </div>
                <div class="nutdieuhuong"><a href="javascritp:void(0)" id="datuongtac<?=$rkh['id']?>"><i class="fas fa-user-shield"></i><br />Hoàn thành</a> </div> 
                <div class="clearfix"></div> 
                </div>
            </div>      
            
            <?}$i++;?>
            <?
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
            <?=$listxxx?>
            </div>    
            
            <?}?>
           
            </div>
            <div class="clearfix"></div>
</div>
     