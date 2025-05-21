<section style="background-color: #F3F3F3; padding-bottom: 40px;)">
    <div class="container">
        <h3 class="hhome"><?=$ru['t18']?></h3>
        <div class="row">
           <?
           $t18=@mysqli_query($con,"select * from dh_baiviet where t1=1 order by time desc limit 4");
           while($r18=@mysqli_fetch_assoc($t18)){
            $cmf=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau from dh_menu1 where id=$r18[muc]"));
                    if($r18['muc2']==0){
                        $link=$cmf['khongdau'].'/wp/'.$r18['khongdau'].'.html';
                    }else{
                        $cmd=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau from dh_menu2 where id=$r18[muc2]"));
                        $link=$cmf['khongdau'].'/'.$cmd['khongdau'].'/'.$r18['khongdau'].'.html';
                    }
           ?>
           <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="news-thumbnail">
                    <!--div class="time-up">
                        <p>7 tháng trước</p>
                    </div-->
                                        
                    <a class="img" href="<?=$link?>" style="background-image: url('upload/baiviet/<?=$r18['anh']?>');"></a>
                    <div class="text">
                        <h3 style="height: 80px;"><a href="<?=$link?>"><?=$r18['ten']?></a></h3>
                        <div class="excerpt"><p><?=cat_chu($r18['trichdan'],50)?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>
                    
                    </div> <!-- End .row -->
    </div> <!-- End .container -->
</section>