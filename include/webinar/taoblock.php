<?php 
$id=intval($_GET['id']);
$camp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from camplive where id=$id"));
?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Thêm Block <a type="button" class="dieuh btn btn-primary btn-xs" href="webinar.php">Trở lại</a></div>
        <p style="font-size: 12px; font-style: italic; color: #868686;">Là những cài đặt liên quan đến phiên live như seeding, sản phẩm, đăng ký...</p>
                <p style="">Webinar: <b><?php echo $camp['ten']?></b></p>
                <?php 
                if(isset($_POST['khoitao'])){
                    $ten=addslashes($_POST['ten']);
                    $soluong=1;$nguoicomment='';$ketthuc=0;
                    if(!isset($_GET['block'])){$block=1;}else{$block=intval($_GET['block']);}
                    $noidung=addslashes($_POST['noidung']);
                    if($block==1){
                        $soluong=intval($_POST['soluong']);
                    }elseif($block==2){
                        $soluong=1;
                    }
                    $batdau=intval($_POST['batdau_gio'])*3600+intval($_POST['batdau_phut'])*60+intval($_POST['batdau_giay']);
                    $ketthuc=intval($_POST['ketthuc_gio'])*3600+intval($_POST['ketthuc_phut'])*60+intval($_POST['ketthuc_giay']);
                    if($block==2){
                        $nguoicomment=addslashes($_POST['tennguoicomment']);
                    }else{
                        $nguoicomment='';
                    }
                    if($block==4 or $block==5 or $block==6){
                        $tieude=addslashes($_POST['tieude']);
                        $icon=addslashes($_POST['icon']);
                        $color=addslashes($_POST['color']);
                    }else{
                        $tieude='';
                        $icon='';
                        $color='';
                    }
                    if($block==5){
                        $idsanpham= intval($_POST['idsanpham']);
                    }else{
                        $idsanpham=0;
                    }
                    if($block==6){
                        $webinarform=intval($_POST['webinarform']);
                    }else{
                        $webinarform=0;
                    }
                    if($_FILES['avatar']['name'] and kiem_tra_anh($_FILES['avatar']['name'])==1){
                    $tenanh=$_FILES['avatar']['name'];
                    $size = getimagesize($_FILES['avatar']['tmp_name']);
                    $rog=$size[0];$ca=$size[1];
                    $width_resize=100;
                    $height_resize=round($width_resize*$ca/$rog); 
                    $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                    $file1='upload/avatar/'.$tenanh;
                    resize_nhieu($width_resize,$height_resize,'avatar',$file1);
                    }else{$tenanh='';}
                    if(isset($_POST['ghim'])){
                        $ghim=intval($_POST['ghim']);
                    }else{
                        $ghim=0;
                    }
                    $inn=@mysqli_query($con,"insert into block (idu,idcamp,ten,tieude,block,noidung,soluong,batdau,ketthuc,nguoicomment,icon,color,idsanpham,webinarform,avatar,ghim)value($camp[idu],$id,N'$ten',N'$tieude',$block,N'$noidung',$soluong,$batdau,$ketthuc,N'$nguoicomment','$icon','$color',$idsanpham,$webinarform,N'$tenanh',$ghim)");
                    if($inn){
                    $blockmoi=@mysqli_fetch_assoc(@mysqli_query($con,"select id from block order by id desc limit 1"));
                    if($block==1){//tạo block
                        $hienthi=$batdau;
                        for($i=0;$i<$soluong;$i++){
                            $noidungmoi=explode("|",$noidung);
                            $rand=rand(0,count($noidungmoi)-1);
                            $randnick=rand(1,250);
                            $noidungluu=$noidungmoi[$rand];
                            $hieutg=$ketthuc-$batdau;
                            $khoangcach=round($hieutg/$soluong);
                            $hienthi=$hienthi+$khoangcach;
                            //tao khong cach ko dong deu
                            $randcongtru=rand(0,2);
                            $hieu2kc=$khoangcach/2;
                            if($hieu2kc<2){
                                $hienthithat=$hienthi;
                            }elseif($hieu2kc==2){
                                if($randcongtru==0){
                                    $hienthithat=$hienthi-1;
                                }elseif($randcongtru==1){
                                    $hienthithat=$hienthi+1;
                                }else{
                                    $hienthithat=$hienthi;
                                }
                            }else{
                                $randkhac=rand(1,$hieu2kc-1);
                                if($randcongtru==0){
                                    $hienthithat=$hienthi-$randkhac;
                                }elseif($randcongtru==1){
                                    $hienthithat=$hienthi+$randkhac;
                                }else{
                                    $hienthithat=$hienthi;
                                }
                            }
                            $incomment=@mysqli_query($con,"insert into comment (idu,idcamp,idblock,timeshow,idnick,noidung,ao,nguoicomment,codinh)value($camp[idu],$id,$blockmoi[id],$hienthithat,$randnick,N'$noidungluu',0,'',0)");
                        }
                    }elseif($block==2){
                        $hienthi=$batdau;
                        $incomment=@mysqli_query($con,"insert into comment (idu,idcamp,idblock,timeshow,idnick,noidung,ao,nguoicomment,codinh)value($camp[idu],$id,$blockmoi[id],$hienthi,0,N'$noidung',0,N'$nguoicomment',1)");
                    }elseif($block==3){
                        $noidungmoi=explode("|",$noidung);
                        $soluongnick=count($noidungmoi);
                        $mangnick = array();
                        $hienthi=$batdau;
                        // Chọn $soluongnick số ngẫu nhiên không trùng lặp
                        while (count($mangnick) < $soluongnick) {
                          // Chọn số ngẫu nhiên từ 1 đến 250
                          $ngaunhiennick = rand(1, 250);
                          // Kiểm tra xem số đã được chọn hay chưa
                          if (!in_array($ngaunhiennick, $mangnick)) {
                            // Nếu số chưa được chọn, thêm số đó vào mảng
                            $mangnick[] = $ngaunhiennick;
                          }
                        }
                        for($v=0;$v<count($noidungmoi);$v++){
                            $idnick=$mangnick[$v];
                            $noidungcomment=$noidungmoi[$v];
                            
                            $hieutg=$ketthuc-$batdau;
                            $khoangcach=round($hieutg/$soluongnick);
                            $hienthi=$hienthi+$khoangcach;
                            //tao khong cach ko dong deu
                            $randcongtru=rand(0,2);
                            $hieu2kc=$khoangcach/2;
                            if($hieu2kc<2){
                                $hienthithat=$hienthi;
                            }elseif($hieu2kc==2){
                                if($randcongtru==0){
                                    $hienthithat=$hienthi-1;
                                }elseif($randcongtru==1){
                                    $hienthithat=$hienthi+1;
                                }else{
                                    $hienthithat=$hienthi;
                                }
                            }else{
                                $randkhac=rand(1,$hieu2kc-1);
                                if($randcongtru==0){
                                    $hienthithat=$hienthi-$randkhac;
                                }elseif($randcongtru==1){
                                    $hienthithat=$hienthi+$randkhac;
                                }else{
                                    $hienthithat=$hienthi;
                                }
                            }
                            $incomment=@mysqli_query($con,"insert into comment (idu,idcamp,idblock,timeshow,idnick,noidung,ao,nguoicomment,codinh)value($camp[idu],$id,$blockmoi[id],$hienthithat,$idnick,N'$noidungcomment',0,'',0)");
                        }
                    }
                    }
                }
                ?>
                
                <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo $camp['video']?>?h=b10534afe8&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                <hr />
                <form role="form" onsubmit="return validateForm()" action="" method="post"  enctype="multipart/form-data">
                <div class="form-group" style="margin-top: 20px;">
                    <label for="kieu">Loại Block <sup>(*)</sup></label>
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios1" value="1" <?php if(!isset($_GET['block']) or $_GET['block']==1){echo ' checked=""';}?>/>Comment ngẫu nhiên</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios2" value="2"<?php if($_GET['block']==2){echo ' checked=""';}?>/>Comment cố định (1 comment)</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios3" value="3"<?php if($_GET['block']==3){echo ' checked=""';}?>/>Comment cố định (Nhiều comment)</label>
                    </div>
                    
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios4" value="4"<?php if($_GET['block']==4){echo ' checked=""';}?>/>Popup dạng text tùy biến</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios5" value="5"<?php if($_GET['block']==5){echo ' checked=""';}?>/>Popup sản phẩm</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="loai" id="optionsRadios6" value="6"<?php if($_GET['block']==6){echo ' checked=""';}?>/>Popup form đăng ký</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ten">Tên Block <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="ten" name="ten" required="" placeholder="Chỉ để quản lý, không hiển ra ngoài"/>
                  </div>
                  <?php if(!isset($_GET['block']) or $_GET['block']==1){?>
                  <div class="form-group">
                    <label for="tieude">Nội dung comment <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="noidung" required="" name="noidung" placeholder="VD: SS|Ss|ss|sẵn sàng|san sang..."/>
                  </div>
                  <div class="form-group">
                    <label for="tieude">Số lượng <sup>(*)</sup></label>
                    <input type="number" class="form-control" id="soluong" required="" name="soluong" placeholder=""/>
                  </div>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu <sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Kết thúc <sup>(*)</sup> </label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <?php }elseif($_GET['block']==2){?>
                  <div class="form-group">
                    <label for="tieude">Nội dung comment <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="noidung" required="" name="noidung" placeholder="VD: Em đã làm kênh mấy lần rồi nhưng toàn bị out thôi. hi"/>
                  </div>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu hiển thị <sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <div class="form-group">
                    <label for="batdau">Tên người comment <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="nguoicomment" name="tennguoicomment" placeholder="VD: Nguyễn Thanh Hoài"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Avatar (1:1) <sup>(*)</sup></label>
                    <input type="file" name="avatar" required="" />
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ghim" value="1"> Ghim bình luận này
                    </label>
                  </div>
                  <?php }elseif($_GET['block']==3){?>
                  <div class="form-group">
                    <label for="tieude">Nội dung comment <sup>(*)</sup> <i id="socomment" style="font-weight: normal;"></i></label>
                    <input type="hidden" class="form-control" id="noidung" required="" name="noidung" placeholder="VD: Em chuyển khoản rồi nhé"/>
                    <textarea class="form-control" rows="6" id="noidungtho"></textarea>
                    <p class="help-block">Mỗi comment viết trên 1 dòng</p>
                  </div>
                  <script>
                  // Lắng nghe sự kiện khi người dùng nhập vào ô văn bản
                  document.getElementById("noidungtho").addEventListener("input", function() {
                    // Lấy giá trị đang nhập
                    var value = this.value;
                
                    // Tách các dòng ra thành một mảng
                    var lines = value.split("\n");
                
                    // Tạo một mảng mới chỉ chứa các dòng khác rỗng
                    var nonEmptyLines = lines.filter(function(line) {
                      return line.trim() !== "";
                    });
                
                    // Nếu mảng dòng khác rỗng có ít nhất một phần tử
                    if (nonEmptyLines.length > 0) {
                      // Thay thế ký tự xuống dòng bằng |
                      value = nonEmptyLines.join("|");
                
                      // Gán giá trị đã sửa đổi cho ô văn bản input
                      document.getElementById("noidung").value = value;
                    } else {
                      // Nếu không có dòng nào khác rỗng thì gán giá trị trống cho ô văn bản input
                      document.getElementById("noidung").value = "";
                    }
                    // Tách các dòng thành mảng
                        var lines = value.split("|");
                    
                        // Đếm số dòng đủ tiêu chuẩn (khác rỗng)
                        var countcm = 0;
                        for (var i = 0; i < lines.length; i++) {
                          if (lines[i].trim() !== "") {
                            countcm++;
                          }
                        }
                        // Hiển thị số dòng đủ tiêu chuẩn vào span
                        document.getElementById("socomment").textContent = ' (' + countcm + ' comment)';
                  });
                </script>


                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu hiển thị<sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Kết thúc <sup>(*)</sup> </label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="ketthuc_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <?php }elseif($_GET['block']==4){?>
                  <!--div class="form-group">
                    <label for="ten">Tiêu đề hiển thị <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="tieude" name="tieude" required="" placeholder="VD: Đăng ký thành viên"/>
                  </div-->
                  <div class="form-group">
                    <label for="tieude">Nội dung hiển thị <sup>(*)</sup></label>
                    <textarea class="form-control" id="noidung" required="" name="noidung"  rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="batdau">Icon tab phải <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="icon" name="icon" placeholder="Chọn icon bên dưới"/>
                  </div>
                  <p>
                  <button type="button" class="btn btn-default" id="but1"><i class="fas fa-tags"></i></button> 
                  <button type="button" class="btn btn-default" id="but2"><i class="fas fa-star"></i></button>
                  <button type="button" class="btn btn-default" id="but3"><i class="fas fa-shield-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but4"><i class="fas fa-sign-out-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but5"><i class="fas fa-shopping-bag"></i></button>
                  <button type="button" class="btn btn-default" id="but6"><i class="fas fa-shopping-basket"></i></button>
                  <button type="button" class="btn btn-default" id="but7"><i class="fas fa-recycle"></i></button>
                  <button type="button" class="btn btn-default" id="but8"><i class="fas fa-passport"></i></button>
                  <button type="button" class="btn btn-default" id="but9"><i class="fas fa-paper-plane"></i></button>
                  <button type="button" class="btn btn-default" id="but10"><i class="fas fa-layer-group"></i></button>
                  <button type="button" class="btn btn-default" id="but11"><i class="fas fa-list-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but12"><i class="fas fa-heartbeat"></i></button>
                  <button type="button" class="btn btn-default" id="but13"><i class="fas fa-gift"></i></button>
                  <button type="button" class="btn btn-default" id="but14"><i class="fas fa-funnel-dollar"></i></button>
                  <button type="button" class="btn btn-default" id="but15"><i class="fas fa-folder-open"></i></button>
                  <button type="button" class="btn btn-default" id="but16"><i class="fas fa-donate"></i></button>
                  <button type="button" class="btn btn-default" id="but17"><i class="fas fa-coffee"></i></button>
                  <button type="button" class="btn btn-default" id="but18"><i class="fas fa-cloud-upload-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but19"><i class="fas fa-chart-pie"></i></button>
                  <button type="button" class="btn btn-default" id="but20"><i class="fas fa-book-reader"></i></button>
                  <button type="button" class="btn btn-default" id="but21"><i class="fab fa-gg-circle"></i></button>
                  <button type="button" class="btn btn-default" id="but22"><i class="far fa-gem"></i></button>
                  <button type="button" class="btn btn-default" id="but23"><i class="fas fa-clipboard"></i></button>
                  <button type="button" class="btn btn-default" id="but24"><i class="fas fa-heart"></i></button>
                  <button type="button" class="btn btn-default" id="but25"><i class="fas fa-hand-holding-usd"></i></button>
                  <button type="button" class="btn btn-default" id="but26"><i class="fas fa-spa"></i></button>
                  <button type="button" class="btn btn-default" id="but27"><i class="fas fa-video"></i></button>
                  <button type="button" class="btn btn-default" id="but28"><i class="fas fa-user-plus"></i></button>
                  <button type="button" class="btn btn-default" id="but29"><i class="fas fa-user-edit"></i></button>
                  <button type="button" class="btn btn-default" id="but30"><i class="fas fa-gavel"></i></button>
                  </p>
                  <div class="form-group">
                    <label for="batdau">Màu Icon <sup>(*)</sup></label>
                    <input type="color" class="form-control" required="" id="color" name="color"/>
                  </div>
                  <script type="text/javascript">
                    CKEDITOR.replace( 'noidung',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                    $('button[id^="but"]').click(function() {
                        $('button[id^="but"]').not(this).removeClass('btn-primary').addClass('btn-default'); // remove class btn-primary and add class btn-default to other buttons
                        $(this).removeClass('btn-default').addClass('btn-primary'); // remove class btn-default and add class btn-primary to the clicked button
                        var icon = $(this).html(); // get the html content of the clicked button
                        $('#icon').val(icon); // set the value of the input with id 'icon'
                      });
                </script>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu <sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <?php }elseif($_GET['block']==5){?>
                  <label for="batdau">Chọn sản phẩm <sup>(*)</sup></label>
                  <?php 
                    $list=@mysqli_query($con,"select * from sanpham where idu=$idu order by time desc");
                    if(@mysqli_num_rows($list)==0){
                        ?>
                        <div class="text-center">
                        <p style="color: silver; padding: 25px 10%;">Chưa có sản phẩm nào được tạo</p>
                        <img src="images/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                        <p style="padding: 25px 10%;">Hãy tạo ngay bây giờ để bắt đầu phễu Marketing của bạn</p>
                        <p><a type="button" class="btn btn-info" href="/cpanel/createsp">Tạo 1 sản phẩm <i class="fas fa-long-arrow-alt-right"></i></a></p> 
                        </div>
                        <?php echo '<!--';?>
                        <?php 
                    }else{$i=1;
                ?>
                
                <div class="table-responsive">
                  <table class="table">
                    <?php while($rlist=@mysqli_fetch_assoc($list)){
                        if($rlist['loai']==0){
                            $loai='Sản phẩm vật lý';
                        }else{
                            $loai='Sản phẩm số';
                        }
                        ?>
                    <tr>
                        <td style="text-align: center;vertical-align: middle;"><input type="radio" style="width: auto;transform: scale(2);" name="idsanpham" id="h<?php echo $rlist['id']?>" value="<?php echo $rlist['id']?>" <?php if($i==1){echo 'checked=""';}?>/></td>
                        <td>
                        
                        <img src="/upload/sanpham/<?php echo $rlist['anh']?>" style="width: 150px;margin-bottom: 15px;" />
                        </td>
                        <td>
                        <p><b><i class="fas fa-folder-open"></i> <?php echo $rlist['ten']?></b></p>
                        <?php if($rlist['gianiemyet']!=0){?><p>Giá niêm yết: <span style="color: gray;"><?php echo number_format($rlist['gianiemyet'],0,',','.')?><sup>đ</sup></span></p><?php }?>
                        <p>Giá bán: <b style="color: red;"><?php echo number_format($rlist['giaban'],0,',','.')?><sup>đ</sup></b></p>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </table>
                </div>
                <?php 
            }
            ?>
                  <div class="form-group">
                    <label for="batdau">Icon tab phải <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="icon" name="icon" placeholder="Chọn icon bên dưới"/>
                  </div>
                  <p>
                  <button type="button" class="btn btn-default" id="but1"><i class="fas fa-tags"></i></button> 
                  <button type="button" class="btn btn-default" id="but2"><i class="fas fa-star"></i></button>
                  <button type="button" class="btn btn-default" id="but3"><i class="fas fa-shield-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but4"><i class="fas fa-sign-out-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but5"><i class="fas fa-shopping-bag"></i></button>
                  <button type="button" class="btn btn-default" id="but6"><i class="fas fa-shopping-basket"></i></button>
                  <button type="button" class="btn btn-default" id="but7"><i class="fas fa-recycle"></i></button>
                  <button type="button" class="btn btn-default" id="but8"><i class="fas fa-passport"></i></button>
                  <button type="button" class="btn btn-default" id="but9"><i class="fas fa-paper-plane"></i></button>
                  <button type="button" class="btn btn-default" id="but10"><i class="fas fa-layer-group"></i></button>
                  <button type="button" class="btn btn-default" id="but11"><i class="fas fa-list-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but12"><i class="fas fa-heartbeat"></i></button>
                  <button type="button" class="btn btn-default" id="but13"><i class="fas fa-gift"></i></button>
                  <button type="button" class="btn btn-default" id="but14"><i class="fas fa-funnel-dollar"></i></button>
                  <button type="button" class="btn btn-default" id="but15"><i class="fas fa-folder-open"></i></button>
                  <button type="button" class="btn btn-default" id="but16"><i class="fas fa-donate"></i></button>
                  <button type="button" class="btn btn-default" id="but17"><i class="fas fa-coffee"></i></button>
                  <button type="button" class="btn btn-default" id="but18"><i class="fas fa-cloud-upload-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but19"><i class="fas fa-chart-pie"></i></button>
                  <button type="button" class="btn btn-default" id="but20"><i class="fas fa-book-reader"></i></button>
                  <button type="button" class="btn btn-default" id="but21"><i class="fab fa-gg-circle"></i></button>
                  <button type="button" class="btn btn-default" id="but22"><i class="far fa-gem"></i></button>
                  <button type="button" class="btn btn-default" id="but23"><i class="fas fa-clipboard"></i></button>
                  <button type="button" class="btn btn-default" id="but24"><i class="fas fa-heart"></i></button>
                  <button type="button" class="btn btn-default" id="but25"><i class="fas fa-hand-holding-usd"></i></button>
                  <button type="button" class="btn btn-default" id="but26"><i class="fas fa-spa"></i></button>
                  <button type="button" class="btn btn-default" id="but27"><i class="fas fa-video"></i></button>
                  <button type="button" class="btn btn-default" id="but28"><i class="fas fa-user-plus"></i></button>
                  <button type="button" class="btn btn-default" id="but29"><i class="fas fa-user-edit"></i></button>
                  <button type="button" class="btn btn-default" id="but30"><i class="fas fa-gavel"></i></button>
                  </p>
                  <div class="form-group">
                    <label for="batdau">Màu Icon <sup>(*)</sup></label>
                    <input type="color" class="form-control" required="" id="color" name="color"/>
                  </div>
                  <script type="text/javascript">
                    $('button[id^="but"]').click(function() {
                        $('button[id^="but"]').not(this).removeClass('btn-primary').addClass('btn-default'); // remove class btn-primary and add class btn-default to other buttons
                        $(this).removeClass('btn-default').addClass('btn-primary'); // remove class btn-default and add class btn-primary to the clicked button
                        var icon = $(this).html(); // get the html content of the clicked button
                        $('#icon').val(icon); // set the value of the input with id 'icon'
                      });
                </script>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu <sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  
                  
                  
                  
                  <?php }elseif($_GET['block']==6){ ?>
                  <div class="form-group">
                    <label for="ten">Tiêu đề <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="tieude" name="tieude" required="" placeholder="VD: Đăng ký thành viên"/>
                  </div>
                  <div class="form-group">
                    <label for="tieude">Nội dung trích dẫn <sup>(*)</sup></label>
                    <textarea class="form-control" id="noidung" required="" name="noidung"  rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="ten">Chọn form <sup>(*)</sup></label>
                    <?php 
                    $fo=@mysqli_query($con,"select * from webinarform where idu=$_COOKIE[iduser]");
                    $slf=@mysqli_num_rows($fo);
                    if($slf==0){
                    ?>
                    <p>Bạn cần tạo ít nhất 1 Form <a type="button" class="btn btn-success btn-xs" href="webinarform.php?create">Tạo ngay bây giờ</a></p>
                    <input type="hidden" name="webinarform" value="0"/>
                    <?php
                    }else{
                    ?>
                    <select class="form-control" id="webinarform" name="form">
                        <?php while($rfo=@mysqli_fetch_assoc($fo)){ ?>
                        <option value="<?php echo $rfo['id']; ?>"><?php echo $rfo['ten']; ?></option>
                        <?php } ?>
                    </select>
                    <p style="text-align: right;"><a style="float: right; font-size: 0.8em; font-style: italic;" href="webinarform.php">Danh sách Form</a></p>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="batdau">Icon tab phải <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="icon" name="icon" placeholder="Chọn icon bên dưới"/>
                  </div>
                  <p>
                  <button type="button" class="btn btn-default" id="but1"><i class="fas fa-tags"></i></button> 
                  <button type="button" class="btn btn-default" id="but2"><i class="fas fa-star"></i></button>
                  <button type="button" class="btn btn-default" id="but3"><i class="fas fa-shield-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but4"><i class="fas fa-sign-out-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but5"><i class="fas fa-shopping-bag"></i></button>
                  <button type="button" class="btn btn-default" id="but6"><i class="fas fa-shopping-basket"></i></button>
                  <button type="button" class="btn btn-default" id="but7"><i class="fas fa-recycle"></i></button>
                  <button type="button" class="btn btn-default" id="but8"><i class="fas fa-passport"></i></button>
                  <button type="button" class="btn btn-default" id="but9"><i class="fas fa-paper-plane"></i></button>
                  <button type="button" class="btn btn-default" id="but10"><i class="fas fa-layer-group"></i></button>
                  <button type="button" class="btn btn-default" id="but11"><i class="fas fa-list-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but12"><i class="fas fa-heartbeat"></i></button>
                  <button type="button" class="btn btn-default" id="but13"><i class="fas fa-gift"></i></button>
                  <button type="button" class="btn btn-default" id="but14"><i class="fas fa-funnel-dollar"></i></button>
                  <button type="button" class="btn btn-default" id="but15"><i class="fas fa-folder-open"></i></button>
                  <button type="button" class="btn btn-default" id="but16"><i class="fas fa-donate"></i></button>
                  <button type="button" class="btn btn-default" id="but17"><i class="fas fa-coffee"></i></button>
                  <button type="button" class="btn btn-default" id="but18"><i class="fas fa-cloud-upload-alt"></i></button>
                  <button type="button" class="btn btn-default" id="but19"><i class="fas fa-chart-pie"></i></button>
                  <button type="button" class="btn btn-default" id="but20"><i class="fas fa-book-reader"></i></button>
                  <button type="button" class="btn btn-default" id="but21"><i class="fab fa-gg-circle"></i></button>
                  <button type="button" class="btn btn-default" id="but22"><i class="far fa-gem"></i></button>
                  <button type="button" class="btn btn-default" id="but23"><i class="fas fa-clipboard"></i></button>
                  <button type="button" class="btn btn-default" id="but24"><i class="fas fa-heart"></i></button>
                  <button type="button" class="btn btn-default" id="but25"><i class="fas fa-hand-holding-usd"></i></button>
                  <button type="button" class="btn btn-default" id="but26"><i class="fas fa-spa"></i></button>
                  <button type="button" class="btn btn-default" id="but27"><i class="fas fa-video"></i></button>
                  <button type="button" class="btn btn-default" id="but28"><i class="fas fa-user-plus"></i></button>
                  <button type="button" class="btn btn-default" id="but29"><i class="fas fa-user-edit"></i></button>
                  <button type="button" class="btn btn-default" id="but30"><i class="fas fa-gavel"></i></button>
                  </p>
                  <div class="form-group">
                    <label for="batdau">Màu Icon <sup>(*)</sup></label>
                    <input type="color" class="form-control" required="" id="color" name="color"/>
                  </div>
                  <script type="text/javascript">
                    $('button[id^="but"]').click(function() {
                        $('button[id^="but"]').not(this).removeClass('btn-primary').addClass('btn-default'); // remove class btn-primary and add class btn-default to other buttons
                        $(this).removeClass('btn-default').addClass('btn-primary'); // remove class btn-default and add class btn-primary to the clicked button
                        var icon = $(this).html(); // get the html content of the clicked button
                        $('#icon').val(icon); // set the value of the input with id 'icon'
                      });
                </script>
                  <div class="form-group" style="margin-bottom: 2px;">
                    <label for="batdau">Bắt đầu <sup>(*)</sup></label>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_gio" value="0"/>
                    <span class="input-group-addon">Giờ</span>
                  </div>
                  <div class="input-group" style="width: 33%; margin-right: 0.5%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_phut" value="0"/>
                    <span class="input-group-addon">Phút</span>
                  </div>
                  <div class="input-group" style="width: 33%; float: left;">
                    <input type="number" class="form-control" required="" name="batdau_giay" value="0"/>
                    <span class="input-group-addon">Giây</span>
                  </div>
                  <p style="margin-bottom: 0;">&nbsp;</p>
                  <?php }elseif($_GET['block']==7){?>
                  <div class="form-group">
                    <label for="uutien">Ưu tiên</label>
                    <select class="form-control" id="uutien" name="uutien">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                    <p class="help-block">Số càng cao thì càng ưu tiên.</p>
                  </div>
                  <?php }
                  if($_GET['block']==6 and $slf==0){
                  ?>
                  <p style="">&nbsp;</p>
                  <button type="button" class="btn btn-primary" disabled="disabled">Kéo lên trên vào tạo ít nhất 1 Form</button>
                  <p style="">&nbsp;</p>
                  <?php
                  }else{
                  ?>
                  <p style="">&nbsp;</p>
                  <button type="submit" name="khoitao" class="btn btn-primary">Tạo block</button>
                  <p style="">&nbsp;</p>
                  <?php } ?>
                </form>
            
            <script>
                $('body').ready(function(){
                    const radioInputs = document.getElementsByName("loai");
                    for (let i = 0; i < radioInputs.length; i++) {
                      const radioInput = radioInputs[i];
                      radioInput.addEventListener("click", function() {
                        const valueradio = radioInput.value;
                        if(valueradio==1){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=1";
                        }else if(valueradio==2){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=2";
                        }else if(valueradio==3){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=3";
                        }else if(valueradio==4){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=4";
                        }else if(valueradio==5){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=5";
                        }else if(valueradio==6){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=6";
                        }else if(valueradio==7){
                            window.location="/webinar.php?type=block&id=<?php echo $camp['id']?>&block=7";
                        }
                      });
                    }
                });
            </script>