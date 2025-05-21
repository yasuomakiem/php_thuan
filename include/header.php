    <base href="<?=$domain?>" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- ANTS Insight meta -->
	<meta name="adx:sections" content="<?=$ru['tit']?>" />
		<!-- End of ANTS Insight meta -->

	<link rel="shortcut icon" href="upload/favicon/<?=$ru['favicon']?>" type="image/x-icon" />
	<link rel="stylesheet" href="css/jquery-ui.css">
	
	<title><?=$tit?></title>

<!-- This site is optimized with the Yoast SEO plugin v4.5 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="<?=$des?>"/>
<meta name="robots" content="noodp"/>
<link rel="canonical" href="<?=$domain?>" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:locale:alternate" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$tit?>" />
<meta property="og:description" content="<?=$des?>" />
<meta property="og:url" content="<?=$domain?>" />
<meta property="og:site_name" content="<?=$ru['tit']?>" />
<meta property="og:image" content="<?=$imgmxh?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?=$des?>" />
<meta name="twitter:title" content="<?=$tit?>" />
<meta name="twitter:image" content="<?=$imgmxh?>" />
<?=str_replace("\\","",$ru['t1'])?>
<style type="text/css">
span.giacu{
    padding-left: 7px;
    text-decoration: line-through;
    font-size: 0.8em;
    color: #afadad;
}
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
#footer .row.footer-first,.page-login-bottom,#main .main-map:before,.header-form-search {
    background-color: <?=$ru['t8']?> !important;
}
.hhome,#header .head-secound #search-btn-show{color: <?=$ru['t8']?> !important;}
@media (max-width: 768px){
.tab-pill-menu-mobile:hover, .tab-pill-menu-mobile:active, .tab-pill-menu-mobile.focus {
    color: <?=$ru['t8']?> !important;
    top: 5px;
}
body{padding-top: 55px !important;
}
.tab-pill-menu-mobile {
    top: -44px !important;
    color: <?=$ru['t8']?> !important;
    right: 45px !important;
}
#header .head-secound .fr.right #search-btn-show {
    position: absolute;
    top: -38px;
    right: 5px;
}
.logo {
    margin-top: 5px !important;
    margin-bottom: 0 !important;
}
.tab-pill-menu-mobile:hover, .tab-pill-menu-mobile:active, .tab-pill-menu-mobile.focus {
    color: <?=$ru['t8']?> !important;
    top: -44px !important;
    right: 45px !important;
}
.hightbv,.excerpt{height: auto !important;}
}
.section-title {
    position: relative;
    -js-display: flex;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 40px;
    margin-top: 60px;
}
.section-title b {
    display: block;
    -ms-flex: 1;
    flex: 1;
    height: 1px;
    opacity: .5;
    background-color: #6c6d6d;
    
}
.section-title-center span, .section-title-bold-center span {
    text-align: center;
}
.section-title-center span {
    margin: 0 15px;
}
.section-title span {
    text-transform: uppercase;
    font-family: glober-book;
    font-size: 20px;
}
.sanpham{margin-bottom: 30px;padding-top: 10px;}
.sanpham:hover{background: #F3F3F3;}
.sanpham:after{
    display: block;
    content: "";
    background: #03A9F4;
    width: 40px;
    height: 2px;
    margin-top: 13px;
    width: 120px;
    margin: 10px auto;
}
.sanpham img{}
.sanpham .titsp{
        text-align: center;
    padding-top: 10px;
}
.sanpham .titsp h4{}
.sanpham .titsp p{}
.sanpham .titsp p b{color: red;}
.section-title-main{
    font-size: 15px;
    color: #101010;
    text-align: center;
    font-weight: bold;
}
.p-b-5{padding-bottom: 5px;}
.p-b-10{padding-bottom: 10px;}
.p-b-15{padding-bottom: 15px;}
.p-b-20{padding-bottom: 20px;}
.p-b-15{padding-bottom: 25px;}
.p-b-30{padding-bottom: 30px;}
.p-t-5{padding-top: 5px;}
.p-t-10{padding-top: 10px;}
.p-t-15{padding-top: 15px;}
.p-t-20{padding-top: 20px;}
.p-t-15{padding-top: 25px;}
.p-t-30{padding-top: 30px;}
.tittensp {
    font-size: 20px;
    color: <?=$ru['t8']?>;
    font-weight: bold;
}
.tittensp:after {
    display: block;
    content: "";
    background: <?=$ru['t8']?>;
    width: 40px;
    height: 2px;
    margin-top: 13px;
    width: 80px;
    margin-left: 0px;
    margin-right: auto;
    margin-top: 10px;
    margin-bottom: 0px;
}
.tabsanpham{}
.tabsanpham h4.gia{
    font-size: 1.5em;
    padding-top: 15px;
}
.tabsanpham h4.gia b{color: red;}
.tabsanpham p.mota{
    text-align: justify;
    font-style: italic;
}
.tabsanpham .nutmuahang{
    background: #2196F3;
    color: white;
    border-color: #2196F3;
    cursor: pointer;
}
.tabsanpham .an .input-group-addon:first-child,.tabsanpham .an .input-group-addon:last-child {
    border-right: 0;
    width: 40px;
    background: none;
}
.tabsanpham .an{display: none;}
.tabsanpham .an .input-group{width: 100%;}
.soluong{padding: 15px 0 25px;}
        .soluong span.congtru{
            border: 1px solid #eae9e9;
            padding: 10px;
            cursor: pointer;
            color: #797979;
        }
        .soluong span.congtru:hover{
            background: #D6D6D6;
        }
        .soluong input{
            padding: 7px;
            border: 0;
            width: 50px;
            text-align: center;
        }
        .soluong label{font-weight: normal; padding-right: 15px;}
        .muangay{
            border: 1px solid #2196F3;
            width: 49%;
            background: #2196F3;
            color: #fff;
            padding: 15px 0px;
            border-radius: 2px;
            -webkit-transition: all .3s ease-out;
            transition: all .3s ease-out;
            outline: none;
            cursor: pointer;
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            float: left;
            margin: 0px 1% 15px 0;
            font-size: 1.2em;
        }
        .muangay:hover{background: #009688;}
        .muangay.xemdanhgia{background: #76b72a;border: 1px solid #609c1a;margin: 0px 0 15px 1%;}
        .muangay.xemdanhgia:hover{background: #46770c;}
        .noidung h1, .noidung h2, .noidung h3, .noidung h4 {
            font-size: 18px;
            color: #009688;
            padding-left: 10px;
            border-left: 5px solid;
        }
.giayto .boxgiay img {
    width: 100%;
    margin: 15px 0;
    box-shadow: 0 0 30px #464545;
}
.video .chuthich {
    text-align: center;
    padding: 10px 10px 20px 10px;
    font-style: italic;
}
</style>
<link rel='stylesheet' id='menu-image-css'  href='css/menu-image.css?ver=1.1' type='text/css' media='all' />
<link rel='stylesheet' id='popup-maker-site-css'  href='css/site.min.css?ver=1.5.7' type='text/css' media='all' />
<link rel='stylesheet' id='wpsl-styles-css'  href='css/styles.min.css?ver=2.2.7' type='text/css' media='all' />
<link rel='stylesheet' id='forms-for-campaign-monitor-custom_cm_monitor_css-css'  href='css/app.css?ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href='css/style.css?ver=4.7.3' type='text/css' media='all' />
<link rel='stylesheet' id='mCustomcss-css'  href='css/jquery.mCustomScrollbar.css?ver=4.7.3' type='text/css' media='all' />
<script type='text/javascript' src='js/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='js/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='js/addons.js?ver=0.1'></script>
<link rel='stylesheet' id='siteorigin-widgets-css'  href='css/style2.css?ver=1.8.1' type='text/css' media='all' />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script type='text/javascript' src='js/main.js?ver=0.1'></script>
<script type='text/javascript' src='js/jquery.mCustomScrollbar.concat.min.js?ver=0.1'></script>
<script type='text/javascript' src='js/add.js?ver=0.1'></script>
<script type='text/javascript' src='js/z.min.js?ver=0.1'></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=vietnamese" rel="stylesheet">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	
	<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>