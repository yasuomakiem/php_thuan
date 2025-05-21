<?php 
$edit=intval($_GET['id']);
$cam=@mysqli_fetch_assoc(@mysqli_query($con,"select * from camplive where id=$edit"));
if($cam['idu']!=$_COOKIE['iduser']){exit();}
?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Sửa Webinar <a type="button" class="dieuh btn btn-primary btn-xs" href="webinar.php">Danh sách</a></div>
        <?php
        if(isset($_POST['khoitao'])){
                    $ten=addslashes($_POST['ten']);
                    $tit=addslashes($_POST['tit']);
                    $des=addslashes($_POST['des']);
                    $url=addslashes($_POST['url']);
                    $loai=intval($_POST['loai']);
                    $video=addslashes($_POST['video']);
                    $thoiluong=intval($_POST['thoiluong']);
                    $speaker=addslashes($_POST['speaker']);
                    $thoidiem=addslashes($_POST['thoidiem']);
                    $thoidiem1=addslashes($_POST['thoidiem1']);
                    $thoidiem2=addslashes($_POST['thoidiem2']);
                    $thoidiem3=addslashes($_POST['thoidiem3']);
                    $thoidiem4=addslashes($_POST['thoidiem4']);
                    $thoidiem5=addslashes($_POST['thoidiem5']);
                    $xem=intval($_POST['xem']);
                    if($_FILES['anh']['name'] and kiem_tra_anh($_FILES['anh']['name'])==1){
                    $tenanh=$_FILES['anh']['name'];
                    $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                    $tenanh=time().$tenanh;
                    move_uploaded_file($_FILES['anh']['tmp_name'],"upload/live/".$tenanh);
                    $linkcu="upload/live/".$cam['img'];unlink($linkcu);
                    }else{$tenanh=$cam['img'];}
                    $inn=@mysqli_query($con,"update camplive set 
                    ten=N'$ten',tit=N'$tit',des=N'$des',url='$url',loai=$loai,video='$video',thoiluong=$thoiluong,speaker=N'$speaker',
                    thoidiem='$thoidiem',thoidiem1='$thoidiem1',thoidiem2='$thoidiem2',
                    thoidiem3='$thoidiem3',thoidiem4='$thoidiem4',thoidiem5='$thoidiem5',img='$tenanh',xem=$xem where id=$edit");
                    if($inn){
                        echo '
                        <script language="JavaScript">
                        var my_timeout=setTimeout("gotosite();",0);
                        function gotosite()
                        {
                        window.location="webinar.php";
                        }
                        </script>
                        ';// cái này là chuyển trang bằng javascript
                        exit();
                    }
                }
                ?>
                <hr />
                <form role="form" onsubmit="return validateForm()" action="" method="post"  enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="ten">Tên Webinar <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="ten" required="" name="ten" value="<?php echo $cam['ten']?>" placeholder="Chỉ để quản lý, không hiển ra ngoài"/>
                  </div>
                  <div class="form-group">
                    <label for="tieude">Tiêu đề <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="tit" required="" name="tit" value="<?php echo $cam['tit']?>" placeholder="Tiêu đề Webinar hiển thị"/>
                  </div>
                  <div class="form-group">
                    <label for="tieude">Mô tả <sup>(*)</sup></label>
                    <textarea class="form-control" id="thongtin" name="des" rows="3"><?php echo $cam['des']?></textarea>
                    <script type="text/javascript">
                    CKEDITOR.replace( 'thongtin',
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
                </script>
                  </div>
                  <div class="form-group has-feedback" id="baourl">
                    <label for="tieude">Url <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="url" name="url" value="<?php echo $cam['url']?>" placeholder="Nhập để tạo đường link phát webinar"/>
                    <p class="help-block"><i class="fas fa-link"></i> <?php echo $domain_webinar?><span id="viewurl"><?php echo $cam['url']?></span></p>
                     
                  </div>
                  <div class="form-group">
                    <label for="idvideo">ID Video <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="video" name="video" value="<?php echo $cam['video']?>" placeholder="Nhập Link video trên Vimeo"/>
                  </div>
                  <div class="form-group">
                    <label for="thoiluong">Thời lượng (giây) <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="thoiluong" value="<?php echo $cam['thoiluong']?>" name="thoiluong" placeholder="Thời lượng video tính bằng giây"/>
                  </div>
                  <div class="form-group">
                    <label for="thoiluong">Mắt xem <sup>(*)</sup></label>
                    <input type="text" class="form-control" required="" id="xem" name="xem" value="<?php echo $cam['xem']?>" placeholder="Lượng mắt xem live"/>
                  </div>
                  <div class="form-group">
                    <label for="diengia">Diễn giả <sup>(*)</sup></label>
                    <input type="text" class="form-control" id="speaker" required="" value="<?php echo $cam['speaker']?>" name="speaker" placeholder="Tên người diễn thuyết"/>
                  </div>
                  <div class="form-group">
                    <label for="kieu">Kiểu Webinar <sup>(*)</sup></label>
                    <div class="radio">

                      <label>
                    
                        <input type="radio" name="loai" id="optionsRadios1" value="1" <?php if($cam['loai']==1){echo 'checked=""';}?>>
                    
                        Phát tùy ý, người xem click là phát Live
                    
                      </label>
                    
                    </div>
                    
                    <div class="radio">
                    
                      <label>
                    
                        <input type="radio" name="loai" id="optionsRadios2" value="2" <?php if($cam['loai']==2){echo 'checked=""';}?>>
                    
                        Phát theo khung giờ nhất định, lặp lại
                    
                      </label>
                    
                    </div>
                    <div class="radio">
                    
                      <label>
                    
                        <input type="radio" name="loai" id="optionsRadios2" value="3" <?php if($cam['loai']==3){echo 'checked=""';}?>/>
                    
                        Phát 1 thời điểm nhất định, duy nhất và không lặp lại
                    
                      </label>
                    
                    </div>
                  </div>
                  <?php if($cam['loai']==3){?>
                    <style>.date-time-input-sing{display: block;}</style>
                  <?php }?>
                  <?php if($cam['loai']==2){?>
                    <style>.date-time-input{display: block;}</style>
                  <?php }?>
                  <div class="form-group date-time-input-sing" id="thoidiemphat">
                    <label for="tieude">Thời điểm phát <sup>(*)</sup></label>
                    <input type="datetime-local" id="date-time-input" class="form-control" name="thoidiem" value="<?php echo $cam['thoidiem']?>" placeholder=""/>
                  </div>
                  <div class="form-group date-time-input" id="thoidiemphat1">
                    <label for="tieude">Khung phát 1<sup>(*)</sup></label>
                    <input type="time" id="time1" class="form-control" name="thoidiem1" value="<?php echo $cam['thoidiem1']?>" placeholder=""/>
                  </div>
                  <div class="form-group date-time-input" id="thoidiemphat2">
                    <label for="tieude">Khung phát 2</label>
                    <input type="time" id="time2" class="form-control" name="thoidiem2" value="<?php echo $cam['thoidiem2']?>" placeholder=""/>
                  </div>
                  <div class="form-group date-time-input" id="thoidiemphat3">
                    <label for="tieude">Khung phát 3</label>
                    <input type="time" id="time3" class="form-control" name="thoidiem3" value="<?php echo $cam['thoidiem3']?>" placeholder=""/>
                  </div>
                  <div class="form-group date-time-input" id="thoidiemphat4">
                    <label for="tieude">Khung phát 4</label>
                    <input type="time" id="time4" class="form-control" name="thoidiem4" value="<?php echo $cam['thoidiem4']?>" placeholder=""/>
                  </div>
                  <div class="form-group date-time-input" id="thoidiemphat5">
                    <label for="tieude">Khung phát 5</label>
                    <input type="time" id="time5" class="form-control" name="thoidiem5" value="<?php echo $cam['thoidiem5']?>" placeholder=""/>
                  </div>
                  <p><img src="upload/live/<?php echo $cam['img']?>" style="width: 200px;" /></p>
                  <div class="form-group">
                
                    <label for="exampleInputFile">Ảnh đại diện (16:9) <sup>(*)</sup></label>
                
                    <input type="file" name="anh" id="exampleInputFile"/>
                
                    <p class="help-block">Ảnh xuất hiện khi chia sẻ link Webinar và trong Live</p>
                
                  </div>
                
                  <button type="submit" name="khoitao" class="btn btn-primary">Cập nhật</button>
                
                </form>
            
            <script>
                $('body').ready(function(){
                   const inputurl = document.querySelector('input#url');
                   const video = document.querySelector('input#video');
                    function removeVietnameseChars(str) {
                      str = str.toLowerCase();
                      str = str.trim();
                      str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
                      return str;
                    }
                    
                    function formatText(str) {
                      str = removeVietnameseChars(str);
                      str = str.replace(/[^\w\s-]/g, '');
                      str = str.replace(/\s+/g, '-');
                      str = str.replace(/^-+|-+$/g, '');
                      return str;
                    }
                    
                    inputurl.addEventListener('blur', function() {
                      let value = this.value;
                      value = formatText(value);
                      this.value = value;
                      $('#viewurl').html(value);
                      $.ajax({
                        url : "ajax_webinar.php",
                        type : "post",
                        dateType:"text",
                        data : { 
                            urlcamp : value,
                            typeform : 'checkurlcamp'
                        },
                        success : function (result){
                            var trave=Number(result);
                            if(trave==1){
                                $('#baourl').addClass('has-success');
                                $('#baourl').removeClass('has-warning');
                                $('#baourl').append('<span class="glyphicon glyphicon-ok form-control-feedback urloki"></span>');
                                $('.urlnooki').hide();
                            }else{
                                $('#baourl').removeClass('has-success');
                                $('#baourl').addClass('has-warning');
                                $('#baourl').append('<span class="glyphicon glyphicon-remove form-control-feedback urlnooki"></span>');
                                $('.urloki').hide();
                            }
                        }
                        });
                    });
                    video.addEventListener('blur', function() {
                        const url = $('#video').val();
                        const videoId = getVimeoVideoId(url);
                        $('#video').val(videoId);
                    })
                    function getVimeoVideoId(url) {
                      const regex = /(?:https?:\/\/(?:www\.)?)?(?:player\.)?(?:vimeo\.com\/(?:video\/)?|vimeo\.com\/manage\/videos\/)(\d+)/;
                      const match = url.match(regex);
                      if (match) {
                        return match[1];
                      } else {
                        return null;
                      }
                    }
                    const radioInputs = document.getElementsByName("loai");
                    for (let i = 0; i < radioInputs.length; i++) {
                      const radioInput = radioInputs[i];
                      radioInput.addEventListener("click", function() {
                        const valueradio = radioInput.value;
                        if(valueradio==1){
                            $('.date-time-input').slideUp();
                            $('.date-time-input-sing').slideUp();
                        }else if(valueradio==2){
                            $('.date-time-input').slideDown();
                            $('.date-time-input-sing').slideUp();
                        }else if(valueradio==3){
                            $('.date-time-input').slideUp();
                            $('.date-time-input-sing').slideDown();
                        }
                      });
                    }
                    function validateForm() {
                      var radios = document.querySelectorAll('input[name="loai"]');
                      var selectedValue;
                    
                      for (var i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                          selectedValue = radios[i].value;
                          break;
                        }
                      }
                      
                      var name = document.getElementById("name").value;
                      var email = document.getElementById("email").value;
                      var message = document.getElementById("message").value;
                    
                      // Kiểm tra xem các trường nhập có được điền đầy đủ hay không
                      if (name == "" || email == "" || message == "") {
                        alert("Vui lòng điền đầy đủ thông tin.");
                        return false; // Ngăn không cho biểu mẫu được gửi đi
                      }
                    }
                });
            </script>
       