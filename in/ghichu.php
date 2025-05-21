
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr">
        <img src="i/homework.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Quản lý ghi nhớ</b></p>
            <p>Số lượng: <b><?php echo @mysqli_num_rows(@mysqli_query($con,"select id from ghichu where idu=$u[id]"))?></b> </p>
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
    </style>
    <div class="groupteam">
    <?php if(!isset($_GET['plus'])){?>
    <p><a href="m/cpanel/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Ghi chú <a type="button" style="float: right;margin-top: -5px;" href="/m/ghinho/?plus=add" class="btn btn-info btn-xs"><i class="fas fa-plus"></i> Thêm mới</a></p>
    <?php 
        $gc=@mysqli_query($con,"select * from ghichu where idu=$u[id] order by time desc");
        if(@mysqli_num_rows($gc)==0){ 
        ?>
        <div class="boxme">
        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
        <p class="thongbaomo">Chưa có ghi chú nào</p>
        <p class="text-center"><a href="m/ghinho/?plus=add" type="button" class="btn btn-info btn-xs"><i class="fas fa-plus"></i> Thêm mới</a></p>
        </div>
        <?php }else{
            while($rgc=@mysqli_fetch_assoc($gc)){
                
        ?>
        <a href="/m/ghinho/?plus=add&edit=<?php echo $rgc['id']?>">
        <div class="boxme" style="margin-bottom: 10px;">
        <div class="ghichu">
            <?php if($rgc['tieude']!=''){?><h4 style="color: #222;"><?php echo $rgc['tieude']?></h4><?php }?>
            <div class="noidungghicu" style="color: #444;"><?php echo str_replace("*manh*","\n",str_replace("<br />","\n",str_replace("????????","",$rgc['noidung'])))?></div>
            <p class="text-right" style="padding-top: 10px; color: silver;"><?php echo tra_lai_time($rgc['time'])?></p>
        </div>
        </div>
        </a>
        <?php 
        }
        }?>
        
    <?php }elseif($_GET['plus']=='add'){
        $tieude='';
        $noidung='';
        $idghichu=0;
        if(isset($_GET['edit'])){
            $id=intval($_GET['edit']);
            $timed=@mysqli_fetch_assoc(@mysqli_query($con,"select * from ghichu where id=$id"));
            $tieude=$timed['tieude'];
            $noidung=str_replace("*manh*","\n",str_replace("<br />","\n",str_replace("????????","",$timed['noidung'])));
            $idghichu=$id;
        }
        ?>
    <p><a href="m/ghinho/"><i class="fas fa-chevron-left"></i> Trở lại</a> / Ghi chú</p>
    <div class="boxme">
        <form role="form">
          <div class="form-group">
            <input type="text" class="form-control" id="tieudeghichu" value="<?php echo $tieude?>" placeholder="Tiêu đề"/>
            <input type="hidden" id="idup" value="<?php echo $idghichu?>" />
          </div>
            <div class="form-group">
            <textarea class="form-control" rows="20" id="noidungghichu" placeholder="Nhập nội dung"><?php echo $noidung?></textarea>
          </div>
            <button type="submit" class="btn btn-primary" id="themghichu"><i class="fas fa-paper-plane"></i> Lưu</button>
        </form>
        <script language="javascript">
        $('#themghichu').click(function(){
            var tieude =$("#tieudeghichu").val();
            var noidung = $("#noidungghichu").val(); 
            noidung = noidung.replace(/\r?\n/g, "*manh*");
            var idup = $('#idup').val();
            if(noidung != ''){
            $.ajax({
                url : "ajax.php",
                type : "post", 
                dateType:"text", 
                data : { 
                     tieude : tieude,
                     noidung : noidung,
                     idup : idup,
                     typeform : "themghichu"
                },
                success : function (result2){
                     window.location.href="/m/ghinho/";
                }
            });
            }
        });
        
        function autoluughichu(){
            var tieude =$("#tieudeghichu").val();
            var noidung = $("#noidungghichu").val(); 
            noidung = noidung.replace(/\r?\n/g, "*manh*");
            var idup = $('#idup').val();
            if(noidung != ''){
            $.ajax({
                url : "ajax.php",
                type : "post", 
                dateType:"text", 
                data : { 
                     tieude : tieude,
                     noidung : noidung,
                     idup : idup,
                     typeform : "themghichu"
                },
                success : function (result2){
                     $('#idup').val(result2);
                }
            });
        }
        }
        $(document).ready(function()
        { 
        setInterval(function(){
            autoluughichu();
        }, 5000);
        })
        </script>
        <div class="clearfix"></div>
    </div>
    <?php }?>
    </div>
    <div class="clearfix"></div>
</div>
     