<style>.gt1{margin-bottom: 15px;}.media1{padding-bottom: 25px;}</style>
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
        <div class="row">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
        
            <div class="col-md-6 col-xs-12 gt1">
            <?=$re['t1']?>
            </div>
            <div class="col-md-6 col-xs-12 media1"><img width="100%" src="upload/banner/<?=$re['t2']?>" alt="<?=$re['ten']?>" /></div>
        </div>
    </div>
</section>
</section>