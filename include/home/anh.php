<?
if($re['bg']==''){
    $se1='';
        if($re['color']==''){$se2='';}else{$se2='style="background:'.$re['color'].'"';}
    }else{
        $se1='style="background: url(upload/banner/'.$re['bg'].');"';
        $se2='style="background:#ffffffc7;"';
    }
//tim xem no co bao nhieu anh d? con biet
$ta=@mysqli_query($con,"select * from dh_banner where idvitri=$re[id] and iduser = $iduser");
echo "select * from dh_banner where idvitri=$re[id] and iduser = $iduser";
$soa=@mysqli_num_rows($ta);
?>
<section class="giayto" <?=$se1?>>  
<section <?=$se2?>>
    <div class="container<?if($re['t1']=='' and $soa==1){echo '-fluid';}?>">
    <?if($soa==1){$ranh=@mysqli_fetch_assoc($ta);?>
    <div class="row">
    <a href="<?if($ranh['a']==''){echo 'javascript:void(0)';}else{echo $ranh['a'];}?>" target="<?=$ranh['target']?>"><img src="upload/banner/<?=$ranh['anh']?>" width="100%" alt="<?=$ranh['ten']?>"></a>
    </div>
    <?}elseif($soa==0){?>
    <div class="row">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
    </div>
    <?}else{?>
        <div class="row">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
        <?while($ranh=@mysqli_fetch_assoc($ta)){?>
        <div class="col-md-<?if($soa%3==0 and $soa<6){echo 4;}else{echo 3;}?> col-xs-12 boxgiay">
        <a href="<?if($ranh['a']==''){echo 'javascript:void(0)';}else{echo $ranh['a'];}?>" target="<?=$ranh['target']?>"><img src="upload/banner/<?=$ranh['anh']?>" width="100%" alt="<?=$ranh['ten']?>"></a>
        </div>
        <?}?>
        <div class="clearfix"></div>
        </div>
        <p>&nbsp;</p>
    <?}?>
    
    </div>
</section>
</section>