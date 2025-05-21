<?
$bv=explode(',',$re['t1']);
if($re['bg']==''){
    $se1='';
        if($re['color']==''){$se2='';}else{$se2='style="background:'.$re['color'].'"';}
    }else{
        $se1='background: url(upload/banner/'.$re['bg'].');';
        $se2='style="background:#ffffffc7;"';
    }
?>
<section style="padding-bottom: 10px; <?=$se1?>">
<section <?=$se2?>>
    <div class="container">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
        <div class="row">
           <?
           for($i=0;$i<count($bv);$i++){
            $idbv=intval($bv[$i]);
            $r18=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_baiviet where id=$idbv"));
            $cmf=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau from dh_menu1 where id=$r18[muc]"));
            $link=$r18['khongdau'].'.html';
           ?>
           <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="news-thumbnail">               
                    <a class="img" href="<?=$link?>" style="background-image: url('upload/baiviet/<?=$r18['anh']?>');"></a>
                    <div class="text" style="background: #fcfcfc;">
                        <h3 class="hightbv" style="height: 80px;"><a style="font-size: 18px;" href="<?=$link?>"><?=$r18['ten']?></a></h3>
                        <div class="excerpt" style="<?if($ru['t4e']=='3'){echo 'height: 18px;';}?>"><p style="font-size: 0.9em;"><?=cat_chu($r18['trichdan'],50)?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>
                    
                    </div> <!-- End .row -->
    </div> <!-- End .container -->
</section>
</section>