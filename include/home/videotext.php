<?
if($re['bg']==''){
    $se1='';
        if($re['color']==''){$se2='';}else{$se2='style="background:'.$re['color'].'"';}
    }else{
        $se1='style="background: url(upload/banner/'.$re['bg'].');"';
        $se2='style="background:#ffffffc7;"';
    }
?>
<section class="gioithieu1" <?=$se1?>>
<section <?=$se2?>>
    <div class="container">
        <div class="row" style="padding-top: 5px; padding-bottom: 10px;">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
            <div class="col-md-6 col-xs-12 media1">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=link_youtube($re['t1'])?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="clearfix"></div>
            </div>
            </div>
            <div class="col-md-6 col-xs-12 gt1">
            <?=$re['t2']?>
            </div>
            
        </div> 
    </div>
</section>
</section>