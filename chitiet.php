<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
$tu="select * from dh_user where id=1";$qu=@mysqli_query($con,$tu);$ru=@mysqli_fetch_assoc($qu);
$trang='item';
$loaitrang='baiviet';
$m=addslashes($_GET['m']);//echo $_GET['m1'].'----'.$_GET['m2'].'----'.$_GET['m'];
$tr=@mysqli_query($con,"select * from dh_baiviet where khongdau='$m'");
if(@mysqli_num_rows($tr)==0){
    $loaitrang='sanpham';
    $tr=@mysqli_query($con,"select * from dh_sanpham where khongdau='$m'");
}
$rb=@mysqli_fetch_assoc($tr);
$tit=$rb['ten'];
$des=cat_chu($rb['trichdan'],20);
$m1=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau,ten,anh from dh_menu1 where khongdau='$_GET[m1]'"));
$imgmxh=$domain.'upload/'.$loaitrang.'/'.$rb['anh'];
if($_GET['m2']==1){
    $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <a class="bread-link bread-home" href="'.$m1['khongdau'].'.html" title="'.$m1['ten'].'">'.$m1['ten'].'</a>
        </div>
        ';
}else{
    $m2=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau,ten from dh_menu2 where khongdau='$_GET[m2]'"));
    $title='
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <a class="bread-link bread-home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <a class="bread-link bread-home" href="'.$m1['khongdau'].'.html" title="'.$m1['ten'].'">'.$m1['ten'].'</a>
            <span class="separator"> <i class="fa fa-angle-right"></i> </span>
            <a class="bread-link bread-home" href="'.$m2['khongdau'].'.html" title="'.$m2['ten'].'">'.$m2['ten'].'</a>
        </div>
        ';
}
?>
<!DOCTYPE html>
<html >
<head>
<?=require_once('include/header.php');?>

</head>
<body>
<?=require_once('include/head.php');?>
<?if($loaitrang=='sanpham'){?>
<section>
<div class="container">
    <div class="row">
        <?=$title?>  
        
    </div>
</div>
</section>
<?}else{?>
<div class="page-banner posr" style="background-image: url(upload/menu/<?=$m1['anh']?>)"></div>
<div class="main page-news-details-main">
    <section style="background-color: #F2F2F2;">
        <div class="container">
        <div class="head-post tac">
        <div>
        <h1 style="text-transform: uppercase;"><?=$rb['ten']?></h1>
        <time><?=tra_lai_time($rb['time'])?></time>
        </div>
        </div>
        <?=$title?>                
                <div class="col-xs-12" style="background: white; margin-bottom: 30px; padding-top: 20px;">
                    <div class="the-content">
                        <?=str_replace("\\","",$rb['noidung'])?>
                    </div>
                    
                </div>
                <hr/>
            <div class="share-post tac">
                <p>Chia sẻ bài viết</p>
                <!-- add item socialnetwork --> 
                <div class="item"><a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?=lay_url()?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/facebook-icon.png" alt="Facebook"></a></div>
                <div class="item"><a rel="nofollow" href="https://www.linkedin.com/shareArticle?trk=Instagram&url=<?=lay_url()?>" title="Share to linkedin" onclick="window.open(this.href, 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/linked-icon.png" alt="linked"></a></div>
                <div class="item"><a rel="nofollow" href="https://twitter.com/home?status=<?=lay_url()?>" title="Share to Twitter" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><img src="images/twitter-icon.png" alt="Twitter"></a></div>            </div>
        </div>
    </section>
    <?
    if($_GET['m2']!=1){
        $tt=@mysqli_query($con,"select * from dh_baiviet where muc2=$rb[muc2] and id!=$rb[id] order by rand() limit 4");
    }else{
        $tt=@mysqli_query($con,"select * from dh_baiviet where muc=$rb[muc] and id!=$rb[id] order by rand() limit 4");
    }
    if(@mysqli_num_rows($tt)>0){
    ?>
    <section style="background-color: #E6E6E6">
        <div class="container">
            <h3 style="margin-top: 40px;" class="page-title-section text-center">Các tin liên quan</h3> 
                    <div class="row">
                    <?
                    while($rtt=@mysqli_fetch_assoc($tt)){
                        $cmf=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau from dh_menu1 where id=$rtt[muc]"));
                        if($rtt['muc2']==0){
                            $link=$cmf['khongdau'].'/wp/'.$rtt['khongdau'].'.html';
                        }else{
                            $cmd=@mysqli_fetch_assoc(@mysqli_query($con,"select khongdau from dh_menu2 where id=$rtt[muc2]"));
                            $link=$cmf['khongdau'].'/'.$cmd['khongdau'].'/'.$rtt['khongdau'].'.html';
                        }
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="news-thumbnail">
                        <!--div class="time-up">
                            <p>2 tuần trước</p>
                        </div-->
                        <a class="img" href="<?=$link?>" style="background: url('upload/baiviet/<?=$rtt['anh']?>');background-size: 100% 100%;"></a>
                        <div class="text">
                            <!--div class="category-tags"><ul class="post-categories"><li><a href="" rel="category tag">Doanh Nghiệp</a></li></ul></div-->
                            <h3><a href="<?=$link?>"><?=$rtt['ten']?></a></h3> 
                            <div class="excerpt"><p><?=cat_chu($rtt['trichdan'],26)?></p></div>
                        </div>
                    </div>
                    </div>
                    <?}?>
                    </div> 
                <hr>
                <!--div class="text-center ttu" style=" color: #008848" >Từ khoá được tìm kiếm nhiều nhất</div>
                <ul class="list-keyword">
                <?
                   $link=@mysqli_query($con,"select * from dh_link order by id desc");
                   while($rl=@mysqli_fetch_assoc($link)){
                   ?>
                   <li><a href='<?=$rl['link']?>' title='<?=$rl['ten']?>' class='apple'><?=$rl['ten']?></a></li>
                <?}?>
                </ul-->        
                </div>
    </section>
    <?}}?>
</div>
    <?=require('include/footer.php');?>
    </body>
</html>
