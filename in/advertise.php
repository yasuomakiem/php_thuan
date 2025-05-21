<style>
.bigmem.advertise{
    background: url(i/regulation.png) no-repeat;
    background-size:100%;
    background-position: top;
    padding-top: 20px;
    margin-left: -15px;
    margin-right: -15px;
}
.contag.dr img{
    width: 100%;
}
.sadvertise{
    text-align: left;
}
.sadvertise .aditem{
        margin: 18px 0;
}
.sadvertise .aditem .aimg{
    width: 130px;
    height: 80px;
    background-position: top center;
    background-size: cover;
    float: left;
}
.sadvertise .aditem a{}
.sadvertise .aditem a span{
        background: #e91e63;
    color: #ffeb3b;
    font-size: 0.8em;
    padding: 3px;
    border-radius: 4px;
}
.sadvertise .aditem p.time{
    padding-top: 8px;
    font-style: italic;
    color: #888;
    font-size: 0.9em;
}
.sunitem{
    float: right;
    width: calc(100% - 145px);width: -moz-calc(100% - 145px);width: -webkit-calc(100% - 145px);
}
</style>
        <div class="bigmem advertise">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Thông báo - sự kiện <a style="float: right;font-size: 14px;padding-right: 20px;color: #ff9700;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img style="float: none; margin-bottom: 15px;" src="i/adr.jpg" />
                
                <div class="sadvertise">
                <?
                $bv=@mysql_query("select * from baiviet where menu=4 order by time desc");
                while($rbv=@mysql_fetch_assoc($bv)){
                ?>
                    <div class="aditem">
                        <div class="aimg" style="background-image: url(../upload/post/<?=$rbv['anh']?>);"></div>
                        <div class="sunitem">
                            <a href="/post/<?=$rbv['menu']?>/<?=$rbv['link']?>/"><span>Event:</span> <?=$rbv['ten']?></a>
                            
                            <p class="time"><i class="far fa-clock"></i> <?=retime($rbv['time'])?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?}?>
                </div>
                
                <p>&nbsp;</p>
            </div>
        </div>
     