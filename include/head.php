<div id="header">
		<div class="row head-secound">
			<div class="container">
        <div class="site-name">
        
            <a href="/" class="logo fl left" style="margin-top: 1px;">
                    <div class="img"> <img src="upload/banner/<?=$ru['logo']?>" alt="<?=$ru['tit']?>"></div>
                    <div class="des"></div>
                </a>
        </div>
<div class="fr right">
<ul class="menu-main">
<?
$menu=@mysqli_query($con,"select * from dh_menu1 where iduser=$iduser order by thutu asc");
while($rm=@mysqli_fetch_assoc($menu)){ 
    $timb=@mysqli_query($con,"select * from dh_baiviet where iduser=$iduser and muc=$rm[id]");
    if(@mysqli_num_rows($timb)!=1){
    $link=$rm['khongdau'].'.html';
    }else{
    $cmd=@mysqli_fetch_assoc($timb);
    $link=$cmd['khongdau'].'.html';
    }
?>
<li id="menu-item-<?=$rm['id']?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-<?=$rm['id']?>">
    <a href="<?=$link?>"  onclick="location.href='<?=$link?>'" class="menu-image-title-after"><span class="menu-image-title"><?=$rm['ten']?></span></a>
    <?
    $menu2=@mysqli_query($con,"select * from dh_menu2 where menu1=$rm[id] order by thutu asc");
    if(@mysqli_num_rows($menu2)>0){
    ?>
    <ul class="sub-menu">
        <?
            while($rm2=@mysqli_fetch_assoc($menu2)){
            $timb2=@mysqli_query($con,"select * from dh_baiviet where muc2=$rm2[id]");
            if(@mysqli_num_rows($timb2)==1){
                $link2=$rtimb2['khongdau'].'.html';
                }else{$link2=$rm2['khongdau'].'.html';}
        ?>
    	<li id="menu-item-<?=$rm2['id']?>" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?=$rm2['id']?>">
        <a href="<?=$link2?>" class="menu-image-title-after menu-image-not-hovered">
        <span class="menu-image-title"><?=$rm2['ten']?></span>
        </a>
        </li>
        <?}?>
    </ul>
    <?}?>
</li>
<?}?>
</ul>
					<a href="#" id="search-btn-show"><i class="fa fa-search"></i></a>
					<a href="#" class="tab-pill-menu-mobile"><i class="fa fa-bars" aria-hidden="true"></i></a>
					<script>
						jQuery(document).ready(function($){		

							//$('.menu-main > li > a').attr('href','#');

							$('#search-btn-show').click(function(){
								$('#site-form-search').addClass('active');
								return false;
							});
							
							$(document).on('click', function(event) {

								if ( !$(event.target).closest('#site-form-search').length ) {

									var search_form = $('#site-form-search');

									if( search_form.hasClass('active') ){
										search_form.removeClass('active');
									}

								}
							});

							$('.search-btn-mobile').click(function(){
								$('#site-form-search').removeClass('active');
								return false;
							});

							$('.tab-pill-menu-mobile').click(function(){

								$(this).stop().toggleClass('active');
								$('.menu-main').stop().slideToggle('slow');

								var heightHeader =  $('.head-secound').outerHeight();

								console.log(heightHeader);

								return false;
							});

						});
					</script>
				</div> <!-- End .fr -->
			</div> <!-- End .container -->
		</div> <!-- End .row -->
		<div id="site-form-search" class="header-form-search">
			<div class="container">
				<form action="tim-kiem.html" role="search" method="GET">
					<input type="search" placeholder="Nhập nội dung cần tìm và gõ Enter" value="" name="s" title="Tìm kiếm:" />
					<button type="submit"><i class="fa fa-search"></i></button>
					<a class="search-btn-mobile" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
				</form>
			</div>
		</div>
	</div> <!-- End #header -->
