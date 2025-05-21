
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('body,html').animate({
            scrollTop: 0
        }, 10);
    });
</script>
<?
$home=explode(",",$ru['home']);
for($v=0;$v<count($home);$v++){
    $idi=intval($home[$v]);
    $re=@mysqli_fetch_assoc(@mysqli_query($con,"select * from set_home where id=$idi"));
    if($re['an']==0){
        if($re['loai']=='slide' and $re['footer']==1){
            require_once('include/home/slide.php');
        }elseif($re['loai']=='anh' and $re['footer']==1){
            require_once('include/home/anh.php');
        }elseif($re['loai']=='textanh' and $re['footer']==1){
            require_once('include/home/textanh.php');
        }elseif($re['loai']=='videotext' and $re['footer']==1){
            require_once('include/home/videotext.php');
        }elseif($re['loai']=='trang' and $re['footer']==1){
            require_once('include/home/trang.php');
        }elseif($re['loai']=='sanpham' and $re['footer']==1){
            require_once('include/home/sanpham.php');
        }elseif($re['loai']=='baiviet' and $re['footer']==1){
            require_once('include/home/baiviet.php');
        }elseif($re['loai']=='slogan' and $re['footer']==1){
            require_once('include/home/slogan.php');
        }elseif($re['loai']=='map' and $re['footer']==1){
            require_once('include/home/map.php');
        }elseif($re['loai']=='video' and $re['footer']==1){
            require_once('include/home/video.php');
        }
    }
}
?>
    <div class="page-login-bottom"> 
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 page-login-bottom-left">
                    <p style="float:left;">Design by <?=$domains?>
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 page-login-bottom-center">
                    <p><?=date('Y')?> - Bản quyền thuộc về <?=$domains?>                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 page-login-bottom-right">
                    <span>Kết nối với chúng tôi</span> 
                    <a target="_bank" href="<?php echo $ru['facecn']; ?>"><img src="images/footer-icon-5.png" alt="face" /></a>
                    <a target="_bank" href="<?php echo $ru['youtube']; ?>"><img src="images/footer-icon-6.png" alt="you" /></a>
                    <a target="_bank" href="<?php echo $r['googleplus']; ?>"><img src="images/footer-icon-7.png" alt="zalo" /></a>
                </div>
            </div>
        </div>
    </div>
    
  

<script>
    jQuery(document).ready(function(){

        var w_screen = $('body').outerWidth();

        $(document).on('click', function(event) {
            if ( !$(event.target).closest('.wrap-loans-options').length ) {
                var search_form = $('#loans-options.body-popup-landing-option');
                if( search_form.hasClass('active') ){
                    search_form.removeClass('active');

                    if ( w_screen < 992  ) {
                        $('body,html').removeClass("ovfh");
                    }
                    return false;
                }

                var search_form = $('#loans-options');
                if( search_form.hasClass('active') ){
                    search_form.removeClass('active');

                    if ( w_screen < 992  ) {
                        $('body,html').removeClass("ovfh");
                    }

                }
            }
        });
    });
</script>    <a href="#" id="back-to-top"><i class="fa fa-angle-up"></i></a>

  