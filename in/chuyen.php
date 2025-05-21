  <style>
  section.main{background: white;}
  button:focus {
    outline: none !important;
  }
  </style>
  <?php 
  $url=$_SERVER['HTTP_REFERER'];
    if($url==lay_url()){
        $url='/m/danhsachnguoiquen/';
    }elseif (strlen(strstr($url,'del.php?')) > 0) {
        $url='/m/danhsachnguoiquen/';
    }
    if(isset($_GET['id'])){
  ?>
  <script type="text/javascript">
    function themdanhsach(danhsach,id){
        $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i đi
                danhsach : danhsach,
                id : id,
                typeform : "themvaodanhsach"
            },
            success : function (result2){
                if(Number(result2)==1){
                    $('#tep'+danhsach).removeClass('btn-default');
                    $('#tep'+danhsach).addClass('btn-info');
                }else{
                    $('#tep'+danhsach).addClass('btn-default');
                    $('#tep'+danhsach).removeClass('btn-info');
                }
                //$('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Thao tác thành công</p>");
                   
                //setTimeout(function(){
                //    window.location="<?php echo $url?>";
                //}, 1000);
                
            },
            error:function(){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có lỗi, Hãy làm lại");                 
            }
            });
    }
</script> 
    <?php 
    $id=intval($_GET['id']);
    $tenkh=@mysqli_fetch_assoc(@mysqli_query($con,"select * from khachhang where id=$id and iduser=$_COOKIE[iduser]"));
    $tds=@mysqli_query($con,"select * from danhsach where idu=$_COOKIE[iduser] order by time desc");
    ?>
    <div class="row">
    <div class="col-md-12">
    <p>&nbsp;</p>
    <p style="padding-bottom: 20px;"><a href="/m/danhsachnguoiquen/"><i class="fas fa-arrow-left"></i> Trở lại</a> / Thêm vào tệp</p>
    <div id="thongbao"></div>
    <?php 
    if(@mysqli_num_rows($tds)>0){
    ?>
    <p style="padding: 20px 0;">Thêm khách hàng <b><?php echo $tenkh['ten']?></b> vào tệp:</p> 
        <?php 
        while($rds=@mysqli_fetch_assoc($tds)){
            if (strlen(strstr($tenkh['danhsach'],'*'.$rds['id'].'*')) > 0) {
                $class='btn-info';
            }else{
                $class='btn-default';
            }
        ?>
        <button type="button" id="tep<?php echo $rds['id']?>" onclick="themdanhsach('<?php echo $rds['id']?>','<?php echo $id?>')" style="text-align: left; margin-bottom: 10px; border-color: #EBEBEB; width: 100%;" class="btn <?php echo $class;?>"><i class="fas fa-folder-open"></i> <?php echo $rds['ten']?></button>
        <?php }?>  
        <hr />
        <p class="text-center">
        <button style="" type="button" class="btn btn-default" onclick="showpopupds()"><i class="fas fa-plus"></i> Tạo thêm 1 tệp</button>
        </p>
    <?php }else{?>
    <p class="text-center" style="color: #FF3535; padding: 25px 0;"><i class="fas fa-exclamation-triangle"></i> Bạn chưa tạo tệp nào</p>
    <p class="text-center"><button type="button" class="btn btn-success" onclick="showpopupds()"><i class="fas fa-plus"></i> Tạo 1 tệp</button></p>
    <?php }?>     
    </div>
   
    </div>
    <?php }else{?>
    <script type="text/javascript">
    function themdanhsach(danhsach,id){
        $.ajax({
            url : "ajax_nguoiquen.php",
            type : "post", 
            dateType:"text", // d? li?u tr? v? d?ng text
            data : { // Danh sách các thu?c tính s? g?i đi
                danhsach : danhsach,
                id : id,
                typeform : "themvaodanhsach"
            },
            success : function (result2){
                if(Number(result2)==1){
                    $('#tep'+danhsach).removeClass('btn-default');
                    $('#tep'+danhsach).addClass('btn-primary');
                }else{
                    $('#tep'+danhsach).addClass('btn-default');
                    $('#tep'+danhsach).removeClass('btn-primary');
                }
                $('#thongbao').html("<p style='color: #4CAF50;padding-top: 15px;'><i class=\"far fa-check-circle\"></i> Thao tác thành công</p>");
                   
                //setTimeout(function(){
                //    window.location="<?php echo $url?>";
                //}, 1000);
                
            },
            error:function(){
                $('#thongbao').html("<p style='color: #F44336'><i class=\"fas fa-exclamation-triangle\"></i> Có lỗi, Hãy làm lại");                 
            }
            });
    }
</script> 
    <?php 
    if(isset($_GET['edit'])){
    $id=intval($_GET['edit']);
    $tep=@mysqli_fetch_assoc(@mysqli_query($con,"select * from danhsach where id=$id"));
    if(isset($_POST['ok'])){
        $ten=addslashes($_POST['ten']);
        $inp=@mysqli_query($con,"update danhsach set ten=N'$ten' where id=$id");
        if($inp){
            echo '
            <script language="JavaScript">
                var my_timeout=setTimeout("gotosite();",0);
                function gotosite(){window.location="/m/chuyends/?ds=chuyen";}
            </script>
            ';
        }else{
            $thongbao='Có lỗi';
        }
    }
    ?>
    <div class="row">
    <div class="col-md-12">
    <p>&nbsp;</p>
    <p style="padding-bottom: 20px;"><a href="/m/chuyends/?ds=chuyen"><i class="fas fa-arrow-left"></i> Trở lại</a> / Sửa tệp</p>
    <div id="thongbao"><?php echo $thongbao?></div>
    <form method="post" action="">
      <div class="form-group">
        <label for="exampleInputEmail1">Sửa tên</label>
        <input type="text" required="" name="ten" class="form-control" value="<?php echo $tep['ten']?>">
      </div>
      
      <button type="submit" name="ok" class="btn btn-primary">Sửa</button>
    </form>    
    </div>
   
    </div>  
    <?php
    }else{
    $tds=@mysqli_query($con,"select * from danhsach where idu=$_COOKIE[iduser] order by time desc");
    ?>
    <div class="row">
    <div class="col-md-12">
    <p>&nbsp;</p>
    <p style="padding-bottom: 20px;"><a href="/m/danhsachnguoiquen/"><i class="fas fa-arrow-left"></i> Trở lại</a> / Danh sách tệp</p>
    <div id="thongbao"></div>
    <?php 
    if(@mysqli_num_rows($tds)>0){
    
        while($rds=@mysqli_fetch_assoc($tds)){
        ?>
        <button type="button" style="width: calc(100% - 80px);width: -moz-calc(100% - 80px);width: -webkit-calc(100% - 80px);text-align: left; margin-bottom: 10px; border-color: #EBEBEB;" class="btn btn-default"><i class="fas fa-folder-open"></i> <?php echo $rds['ten']?></button>
        <a style="color: red; float: right;padding-top: 6px; width: 30px; text-align: center;" href="del.php?del=<?php echo $rds['id']?>&table=danhsach"><i class="far fa-trash-alt"></i></a>
        <a style="color: #FF8040; float: right;padding-top: 6px; width: 30px; text-align: center;" href="/m/chuyends/?ds=chuyen&edit=<?php echo $rds['id']?>"><i class="fas fa-edit"></i></a>
        <?php }?>  
        <button style="margin-top: 10px;" type="button" class="btn btn-success" onclick="showpopupds()"><i class="fas fa-plus"></i> Tạo thêm 1 tệp</button>
    <?php }else{?>
    <p class="text-center" style="color: #FF3535; padding: 25px 0;"><i class="fas fa-exclamation-triangle"></i> Bạn chưa tạo tệp nào</p>
    <p class="text-center"><button type="button" class="btn btn-success" onclick="showpopupds()"><i class="fas fa-plus"></i> Tạo 1 tệp</button></p>
    <?php }?>     
    </div>
   
    </div>    
    <?php }}?>