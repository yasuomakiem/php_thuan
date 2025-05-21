<section class="home-banner">
    <ul id="home-banner">
    <?$bn=@mysqli_query($con,"select * from dh_banner where vitri=2 and iduser=$iduser order by time desc");while($rb=@mysqli_fetch_assoc($bn)){?>
    <li>
    <a href = "<?=$rb['a']?>" target="<?=$rb['target']?>"><img src="upload/banner/<?=$rb['anh']?>" alt="<?=$rb['ten']?>" /></a>
                <div class = "container-slider" style = 'display: none'>
                    <div class="container">
                        <div class="box right">
                            <h2 style="color: "><?=$rb['ten']?></h2>
                            <div class="text" style="color: "></div>
                            <!--<a href="<?=$rb['a']?>" class="btn viewmore" style="background-color: ">Xem chi ti?t</a>-->
                            </div>
                    </div>
                </div>                    
    </li>
    <?}?>
    </ul>
</section>

<script>
    $(document).ready(function () {
        $('#home-banner').bxSlider({
//			mode: 'fade',
//			controls: false
// adaptiveHeight: true,
            mode: 'fade',
            auto: true,
            pause: 5000,
            //infiniteLoop: false,
            hideControlOnEnd: true

        });
        $(".bx-controls-direction a.bx-next").empty();
        $(".bx-controls-direction a.bx-prev").empty();
        $(".bx-pager").css('display', 'none');
    });
</script>
<style type="text/css">
    .home-banner{
        position: relative;
    }
    .home-banner li img{
        width: 100%;
    }
    .container-slider{
        position: absolute;
        top: 0px;
        width: 100%;
        height: 100%;
    }
    .container-slider .container{
        height: 100%;
    } 
    /*@media (max-width: 768px){
        .home-banner{
            margin-top: 30px;
        }
    }*/
</style>