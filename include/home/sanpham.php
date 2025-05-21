<?
$sp=explode(',',$re['t1']);
$tachmoi='';
for($j=0;$$j<count($sp);$j++){
    if(@mysqli_num_rows(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"))>0){
        if($tachmoi==''){
            $tachmoi=$sp[$j];
        }else{
            $tachmoi.=','.$sp[$j];
        }
    }
}
$sps=explode(',',$tachmoi);
$sosp=count($sps);
if($re['bg']==''){
    $se1='';
        if($re['color']==''){$se2='';}else{$se2='style="background:'.$re['color'].'"';}
    }else{
        $se1='style="background: url(upload/banner/'.$re['bg'].');"';
        $se2='style="background:#ffffffc7;"';
    }
?>
<section class="sanphamhome" <?=$se1?>>
<section <?=$se2?>>
    <div class="container">
        <div class="row">
        <h3 class="section-title section-title-center"><b></b><span class="section-title-main"><?=$re['ten']?></span><b></b></h3>
        <?if($sosp==1){
             for($i=0;$i<$sosp;$i++){
                $idsp=intval($sp[$i]);
                $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
        ?>
            <div class="sanpham col-md-6 col-xs-12">
                <a href="/<?=$rsp['khongdau']?>.html"><img src="upload/sanpham/<?=str_replace(",","",$rsp['anh'])?>" alt="<?=$rsp['ten']?>" /></a>
                <div class="titsp">
                    <h4><a href="/<?=$rsp['khongdau']?>.html"><?=$rsp['ten']?></a></h4>
                    <p>Giá: <b><?=number_format($rsp['gia'],0,',','.')?><sup>đ</sup></b></p>
                </div>
            </div>
        <? }
        }elseif($sosp==2){
            for($i=0;$i<$sosp;$i++){
                $idsp=intval($sp[$i]);
                $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
        ?>
            <div class="sanpham col-md-6 col-xs-6">
                <a href="/<?=$rsp['khongdau']?>.html"><img src="upload/sanpham/<?=str_replace(",","",$rsp['anh'])?>" alt="<?=$rsp['ten']?>" /></a>
                <div class="titsp">
                    <h4><a href="/<?=$rsp['khongdau']?>.html"><?=$rsp['ten']?></a></h4>
                    <p>Giá: <b><?=number_format($rsp['gia'],0,',','.')?><sup>đ</sup></b></p>
                </div>
            </div>
        <? }?>
        <?}elseif($sosp>2){
            if($sosp%4==0){$class='col-md-3';}elseif($sosp%3==0){$class='col-md-4';}else{$class='col-md-3';}
            for($i=0;$i<$sosp;$i++){
                $idsp=intval($sp[$i]);
                $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$idsp"));
        ?>
            <div class="sanpham <?=$class?> col-xs-6">
                <a href="/<?=$rsp['khongdau']?>.html"><img src="upload/sanpham/<?=str_replace(",","",$rsp['anh'])?>" /></a>
                <div class="titsp">
                    <h4><a href="/<?=$rsp['khongdau']?>.html"><?=$rsp['ten']?></a></h4>
                    <p>Giá: <b><?=number_format($rsp['gia'],0,',','.')?><sup>đ</sup></b></p>
                </div>
            </div>
        <?}}?>
        </div>
    </div>
</section>
</section>