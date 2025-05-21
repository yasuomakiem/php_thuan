<?php 
$m=addslashes($_GET['m']);
$danhmuc=@mysqli_fetch_assoc(@mysqli_query($con,"select * from menu_mod where khongdau='$m'"));
$sochuyende=@mysqli_num_rows(@mysqli_query($con,"select id from chuyende where menu_mod=$danhmuc[id]"));
$sovideo=@mysqli_num_rows(@mysqli_query($con,"select id from video where menu_mod=$danhmuc[id]"));
?>
<style>
.sdieuhuong{
    
}
.listcd{
    margin: 15px auto 2px;
    padding: 15px 15px 15px 15px;
    background: #fbfbfb;
    border-radius: 10px;
    box-shadow: 0px 0px 5px #e3e3e3;
}
.listcd .anhcd{
    width: 125px;
    height: 80px;
    background-size: cover;
    float: left;
    border-radius: 8px;background-position: center center;
}
.listcd .ttcd{
    width: calc(100% - 140px);width: -moz-calc(100% - 140px);width: -webkit-calc(100% - 140px);
    float: right;
}
.listcd .ttcd h4{
    margin-top: 0;
    color: #3e3d3d;
    font-weight: 300;
    font-size: 18px;
    line-height: 22px;
}
.listcd .ttcd p.mt{font-style: italic; color: gray; font-size: 0.9em;}
.listcd .ttcd p.mt span{color: #333;}
.titvideo{
    font-size: 18px;
    line-height: 24px;
    padding-left: 15px;
    border-left: 5px solid gray;
}
</style>
        <div class="bigmem cpanel" style="min-height: 800px;">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/<?php echo $m?>.png" />
                <div class="dealright">
                <p style="margin-bottom: 5px;"><b><?php echo $danhmuc['ten']?></b></p>
                <p>Mod: <?php echo $sochuyende?> - Nội dung: <?php echo $sovideo?> </p>
                </div>
                <div class="clearfix"></div>
                </div>
                <?php 
                if(isset($_GET['cd'])){
                    if(isset($_GET['vd'])){
                        $cd=intval($_GET['cd']);
                        $chuyende=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$cd"));
                        $vd=intval($_GET['vd']);
                        $video=@mysqli_fetch_assoc(@mysqli_query($con,"select * from video where id=$vd"));
                        $upvideo=@mysqli_fetch_assoc(@mysqli_query($con,"update video set xem=xem+1 where id=$vd"));
                ?>
                
                <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 0px; margin-left: 15px;margin-top: 30px;width: calc(100% - 30px);width: -moz-calc(100% - 30px);width: -webkit-calc(100% - 30px);
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    overflow: hidden;">
                <a href="/m/cpanel/" style="color: #333;"><i class="fas fa-home"></i> </a></a> / 
                <a href="/m/mod/<?php echo $m?>/"><?php echo $danhmuc['ten']?> </a> / 
                <a href="/m/mod/<?php echo $m?>/?cd=<?php echo $chuyende['id']?>"><?php echo $chuyende['ten']?></a>
                </h3>
                
                <div class="col-md-12">
                
                <?php if($video['link']!=''){?>
                            <div style="margin-top: 25px;" class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo link_youtube($video['link'])?>"></iframe>
                            </div>
                <?php }?>
                <h3 class="titvideo"><?php echo $video['ten']?></h3>
                <p><i class="far fa-clock"></i> Cập nhật: <?php echo tra_lai_time($video['time'])?></p>
                <div style="padding-bottom: 10px;" class="noidungbai"><?php echo $video['noidung']?></div>
                <?php 
                $cuoc=@mysqli_query($con,"select * from video where chuyende=$chuyende[id] and id!=$video[id] order by time desc");
                if(@mysqli_num_rows($cuoc)>0){
                ?>
                <h3 class="titchu">Nội dung liên quan</h3>
                <?php 
                while($rcuoc=@mysqli_fetch_assoc($cuoc)){
                    
                ?>
                <a href="/m/mod/<?php echo $m?>/?cd=<?php echo $cd?>&vd=<?php echo $rcuoc['id']?>">
                <div class="listcd">
                <?php if($rcuoc['link']!=''){?>
                    <div class="anhcd" style="background-image: url(https://i.ytimg.com/vi/<?php echo link_youtube($rcuoc['link'])?>/hqdefault.jpg);"></div>
                    <div class="ttcd">
                        <h4 style="font-size: 15px;"><?php echo $rcuoc['ten']?></h4>
                    </div>
                <?php }else{?>
                    <div style="width: 100%;" class="ttcd">
                        <h4><?php echo $rcuoc['ten']?></h4>
                    </div>
                <?php }?>
                    <div class="clearfix"></div>
                </div>
                </a>
                <?php     
                } }
                ?>
                </div>
                <?php 
                    }else{
                    $cd=intval($_GET['cd']);
                    $chuyende=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$cd"));
                ?>
                
                <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 0px; margin-left: 15px;margin-top: 30px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <a href="/m/mod/<?php echo $m?>/"><?php echo $danhmuc['ten']?> </a></h3>
                
                <div class="clearfix"></div>
                <h4 style="padding: 0px 0 0 10px;font-size: 15px;border-left: 5px solid #ed0909;margin-left: 15px;margin-top: 20px;"><?php echo $chuyende['ten']?></h4>
                <div class="col-md-12">
                <?php 
                $cuoc=@mysqli_query($con,"select * from video where chuyende=$chuyende[id] order by thutu asc");
                if(@mysqli_num_rows($cuoc)>0){
                while($rcuoc=@mysqli_fetch_assoc($cuoc)){
                    
                ?>
                <a href="/m/mod/<?php echo $m?>/?cd=<?php echo $cd?>&vd=<?php echo $rcuoc['id']?>">
                <div class="listcd">
                <?php if($rcuoc['link']!=''){?>
                    <div class="anhcd" style="background-image: url(https://i.ytimg.com/vi/<?php echo link_youtube($rcuoc['link'])?>/hqdefault.jpg);"></div>
                    <div class="ttcd">
                        <h4 style="font-size: 14px;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;"><?php echo $rcuoc['ten']?></h4>
                        <p style="font-size: 0.85em;color: #555;font-style: italic;" class="author"><i class="fas fa-edit"></i> Author: <b style="color: #009688;"><?php echo $rcuoc['author']?></b></p>
                    </div>
                <?php }else{?>
                    <div style="width: 100%;" class="ttcd">
                        <h4 style="font-size: 14px;"><?php echo $rcuoc['ten']?></h4>
                        <p style="font-size: 0.85em;color: #555;font-style: italic;" class="author"><i class="fas fa-edit"></i> Author: <b style="color: #009688;"><?php echo $rcuoc['author']?></b></p>
                    </div>
                <?php }?>
                    <div class="clearfix"></div>
                </div>
                </a>
                <?php     
                }    
                }
                }
                }else{?>
                <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 20px; margin-left: 15px;margin-top: 30px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;"><?php echo $danhmuc['ten']?></span> </h3>
                
                <div class="col-md-12">
                <?php 
                $cuoc=@mysqli_query($con,"select * from chuyende where menu_mod=$danhmuc[id] order by time desc");
                if(@mysqli_num_rows($cuoc)>0){
                while($rcuoc=@mysqli_fetch_assoc($cuoc)){
                    $xem=@mysqli_fetch_assoc(@mysqli_query($con,"select SUM(xem) luotxem from video where chuyende=$rcuoc[id]"));
                ?>
                <a href="/m/mod/<?php echo $m?>/?cd=<?php echo $rcuoc['id']?>">
                <div class="listcd">
                    <div class="anhcd" style="background-image: url(upload/mod/<?php echo $rcuoc['anh']?>);"></div>
                    <div class="ttcd">
                        <h4 style="font-size: 16px"><?php echo $rcuoc['ten']?></h4>
                        <p class="mt"><i class="fas fa-clipboard-list"></i> <span><?php echo  @mysqli_num_rows(@mysqli_query($con,"select id from video where chuyende=$rcuoc[id]"));?></span> &nbsp;&nbsp;&nbsp;&nbsp; <i class="far fa-eye"></i> <span><?php echo $xem['luotxem']?></span></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </a>
                <?php     
                }
                }else{
                ?>
                
                    <p class="text-center">
                        <img class="fa5" style="float: none;" src="i/5fa.png" />
                    </p>
                    <p class="text-center">Danh mục đang được hoàn thiện</p><p>&nbsp;</p>
                <?php }?>
                </div>
                <?php }?>
                <p>&nbsp;</p>
            
        </div>
     