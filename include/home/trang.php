<?
if($re['bg']==''){
    $se1='';
        if($re['color']==''){$se2='';}else{$se2='style="background:'.$re['color'].'"';}
    }else{
        $se1='style="background: url(upload/banner/'.$re['bg'].');"';
        $se2='style="background:#ffffffc7;"';
    }
?>
<section class="p-b-15" <?=$se1?>>
<section <?=$se2?>>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?=$re['t1']?>
            </div>
        </div>
    </div>
</section>
</section>