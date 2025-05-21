<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=$_COOKIE[iduser]";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
if(isset($_GET['add'])){
    $loai=addslashes($_GET['add']);
    if($loai!=''){
        if($loai=='slide'){$tentab='Slide trang chủ';}else{$tentab='';}
        $in1=@mysqli_query($con,"insert into set_home (ten,loai,iduser)value(N'$tentab','$loai',$iduser)");
        $timlai=@mysqli_fetch_assoc(@mysqli_query($con,"select id from set_home order by id desc limit 1"));
        $idmoi=$timlai['id'];
        if($r['home']==''){$home=$idmoi;}else{$home=$r['home'].','.$idmoi;}
        $up1=@mysqli_query($con,"update dh_user set home='$home' where id=$_COOKIE[iduser]");
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="set-home.php?edit='.$idmoi.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }
}
if(isset($_GET['up'])){
    $up = addslashes($_GET['up']);
	$sql = "update dh_user set home='$up' where id =$_COOKIE[iduser]";
	$result = @mysqli_query($con,$sql);
    $tim="select * from dh_user where id=$_COOKIE[iduser]";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
}
if(isset($_GET['updown'])){
    $new=addslashes($_GET['updown']);
    if($new!=''){
        $up1=@mysqli_query($con,"update dh_user set home='$new' where id=$iduser");
        echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="set-home.php";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="sup-admin/main_admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel='stylesheet' id='siteorigin-widgets-css'  href='css/style2.css?ver=1.8.1' type='text/css' media='all' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"/>
<style>
       .haiben{
           width: 100%;
       }
       #right #form table.haiben td{vertical-align: top;}
       #right #form table.haiben td.mot{
            padding-left: 20px;
            padding-top: 30px;
            line-height: 40px;
            font-size: 1.1em;
            width: 50%;
            border-right: 1px solid #EFEFEF;
            
       }
       #right #form table.haiben th{
            width: 50%;
            text-align: center;
            padding: 10px 0;
            background: #427e7f;
            color: white;
       }
       #right #form table.haiben td.mot a{
         color: #2196F3;
       }
       #right #form table.haiben td.mot a i{font-size: 0.9em;color: #444;}
       #right #form table.haiben td.mot a:hover{color: red; font-weight: bold;}
       .tabhome{
        padding: 10px;
        border: 1px solid #49BEB9;
        margin-bottom: 8px;
       }
       .lenxuong{float: right; font-size: 0.9em;}
       .lenxuong a{color: #FF0080;}
       .lenxuong a:hover{color: #333;}
       p.chucnang{
        font-size: 10px;
        padding-top: 16px;
        border-top: 1px solid #e2e1e1;
        margin-top: 10px;
       }
       a.capnhat{
        color: white;
        background: #2985ce;
        padding: 3px 5px;
        border-radius: 2px;
        margin-right: 3px;
       }
       a.capnhat:hover{background: #004A95;}
       a.an{
        color: white;
        background: #6c6c6d;
        padding: 3px 5px;
        border-radius: 2px;
        margin-right: 3px;
       }
       a.an:hover{background: #313131;}
       a.hien{
        color: white;
        background: #3ca240;
        padding: 3px 5px;
        border-radius: 2px;
        margin-right: 3px;
       }
       a.hien:hover{background: #247528;}
       a.xoa{
        color: white;
        background: #F44336;
        padding: 3px 5px;
        border-radius: 2px;
        margin-right: 3px;
       }
       a.xoa:hover{background: #d61709;}
       a.chan-off{
        float: right;
        background: none;
        color: #333;
       }
       a.chan-off:hover{
        color: white;
        background: cadetblue;
        padding: 3px;
       }
       a.chan-on{
        float: right;
        color: white;
        background: cadetblue;
        padding: 3px;
       }
       a.chan-on:hover{background: #d61709;}
       </style>
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
    <?
    if(isset($_GET['edit'])){
        $edit=intval($_GET['edit']);
        if($edit<=0){
            require_once('include/sethome/menufooter.php');
        }else{
        $re=@mysqli_fetch_assoc(@mysqli_query($con,"select * from set_home where id=$edit"));
        if($re['iduser']!=$_COOKIE['iduser']){exit();}
        if($re['loai']=='slide'){
            require_once('include/sethome/slide.php');
        }elseif($re['loai']=='anh'){
            require_once('include/sethome/anh.php');
        }elseif($re['loai']=='textanh'){
            require_once('include/sethome/textanh.php');
        }elseif($re['loai']=='videotext'){
            require_once('include/sethome/videotext.php');
        }elseif($re['loai']=='trang'){
            require_once('include/sethome/trang.php');
        }elseif($re['loai']=='sanpham'){
            require_once('include/sethome/sanpham.php');
        }elseif($re['loai']=='baiviet'){
            require_once('include/sethome/baiviet.php');
        }elseif($re['loai']=='slogan'){
            require_once('include/sethome/slogan.php');
        }elseif($re['loai']=='map'){
            require_once('include/sethome/map.php');
        }elseif($re['loai']=='video'){
            require_once('include/sethome/video.php');
        }
        }
    }else{
    ?>
        <div class="tit">Cài đặt trang chủ</div>
        <div class="nhacnho">
        </div>
        <form id="form">
            <table class="haiben">
                <tr>
                    <th>Các tool có thể thêm</th><th>Trang chủ hiện tại</th>
                </tr>
                <tr>
                    <td class="mot">
                    <p><a href="/set-home.php?add=slide"><i class="fas fa-plus-circle"></i> Tab Silde ảnh lớn </a></p>
                    <p><a href="/set-home.php?add=sanpham"><i class="fas fa-plus-circle"></i> Tab Sản phẩm </a></p>
                    <p><a href="/set-home.php?add=baiviet"><i class="fas fa-plus-circle"></i> Tab Bài viết </a></p>
                    <p><a href="/set-home.php?add=anh"><i class="fas fa-plus-circle"></i> Tab Ảnh </a></p>
                    <p><a href="/set-home.php?add=video"><i class="fas fa-plus-circle"></i> Tab Video </a></p>
                    <p><a href="/set-home.php?add=textanh"><i class="fas fa-plus-circle"></i> Tab Văn bản + Ảnh </a></p>
                    <p><a href="/set-home.php?add=videotext"><i class="fas fa-plus-circle"></i> Tab Video + Văn bản </a></p>
                    <p><a href="/set-home.php?add=map"><i class="fas fa-plus-circle"></i> Tab Bản đồ </a></p>
                    <p><a href="/set-home.php?add=slogan"><i class="fas fa-plus-circle"></i> Tab Slogan + SĐT </a></p>
                    <p><a href="/set-home.php?add=trang"><i class="fas fa-plus-circle"></i> Tab Trắng </a></p>
                    </td>
                    <td>
                    <div class="tabhome">
                            <p><b>Menu trang</b>
                            <span class="lenxuong">
                                Cố định
                            </span>
                            </p>
                            <p class="chucnang">
                            <a class="capnhat" href="/set-home.php?edit=0"><i class="fas fa-sync-alt"></i> Cập nhật</a>
                            </p>
                    </div>
                    <?
                    $homes=explode(",",$r['home']);
                    for($i=0;$i<count($homes);$i++){
                        $rhome=@mysqli_fetch_assoc(@mysqli_query($con,"select * from set_home where id=$homes[$i]"));
                        if($rhome['loai']=='slide'){$tenloai='Slide';}
                        if($rhome['loai']=='textanh'){$tenloai='Text-Ảnh';}
                        if($rhome['loai']=='sanpham'){$tenloai='Sản phẩm';}
                        if($rhome['loai']=='videotext'){$tenloai='Video-Text';}
                        if($rhome['loai']=='trang'){$tenloai='Tab trắng';}
                        if($rhome['loai']=='baiviet'){$tenloai='Bài viết';}
                        if($rhome['loai']=='slogan'){$tenloai='Slogan+SĐT';}
                        if($rhome['loai']=='map'){$tenloai='Bản đồ';}
                        if($rhome['loai']=='video'){$tenloai='Video';}
                        if($rhome['loai']=='anh'){$tenloai='Ảnh';}
                        $idtruoc=$homes[$i-1];
                        $idsau=$homes[$i+1];
                        $idnow=$homes[$i];
                        if($i==0){$uplai=str_replace("$homes[$i],","",$r['home']);}else{$uplai=str_replace(",$homes[$i]","",$r['home']);}
                        $strlen=str_replace("$idtruoc,$idnow","$idnow,$idtruoc",$r['home']);
                        $strxuong=str_replace("$idnow,$idsau","$idsau,$idnow",$r['home']);
                        ?>
                        <div class="tabhome" <?if($rhome['an']==1){echo 'style="opacity: 0.4;"';}?>>
                            <p><?=$tenloai?>: <?if($rhome['ten']==''){echo '<i>Chưa có tên</i>';}else{echo '<b>'.$rhome['ten'].'</b>';}?>
                            <span class="lenxuong">
                                <?if($i!=0){?><a href="set-home.php?updown=<?=$strlen?>"><i class="fas fa-arrow-up"></i> Lên</a> <?}?> 
                                <?if($i!=0 and $i!=(count($homes)-1)){echo '-';}?>
                                <?if($i!=(count($homes)-1)){?><a href="set-home.php?updown=<?=$strxuong?>"><i class="fas fa-arrow-down"></i> Xuống</a><?}?>
                            </span>
                            </p>
                            <p class="chucnang">
                            <a class="capnhat" href="/set-home.php?edit=<?=$idnow?>"><i class="fas fa-sync-alt"></i> Cập nhật</a>
                            <?if($rhome['an']==0){?><a class="an" href="up.php?table=set_home&id=<?=$idnow?>&up=1&loai=an"><i class="fas fa-eye-slash"></i> Ẩn</a><?}?>
                            <?if($rhome['an']==1){?><a class="hien" href="up.php?table=set_home&id=<?=$idnow?>&up=0&loai=an"><i class="fas fa-eye"></i> Hiện</a><?}?>
                            <a class="xoa" href="set-home.php?table=dh_user&up=<?=$uplai?>&loai=home"><i class="fas fa-trash-alt"></i> Xóa</a>
                            <a style="float: right;" class="chan-<?if($rhome['footer']==0){echo 'off';}else{echo 'on';}?>" href="<?if($rhome['footer']==0){echo 'up.php?table=set_home&id='.$rhome['id'].'&up=1&loai=footer';}else{echo 'up.php?table=set_home&id='.$rhome['id'].'&up=0&loai=footer';}?>"><i class="fas fa-trash-alt"></i> Chân trang</a>
                            </p>
                        </div>
                        <?
                    }
                    ?>
                    
                    </td>
                </tr>
            </table>
        </form>
    <?}?>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>