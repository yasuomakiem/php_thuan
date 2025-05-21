<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
//require_once('include/session.php');
if(!isset($_COOKIE['iduser']) or ($_COOKIE['iduser']!=1 and $_COOKIE['iduser']!=887)){exit();}
if(!isset($_GET['id'])){exit();}
$menu_mod=intval($_GET['id']);
$tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm);
?>
<!DOCTYPE html>
<html lang="vi" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<meta name="robots" content="all" />	
<base href="<?php echo $domain?>" />	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>	
<meta name="description" content="<?php echo $des?>"/>		
<title><?php echo $tit?></title>
<meta property="description" content="<?php echo $des?>"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $tit?>"/>
<meta property="og:image" content="images/webinar.jpg"/>
<meta property="og:description" content="<?php echo $des?>"/>
<meta property="og:url" content="<?php echo lay_url()?>"/>
<meta property="og:site_name" content="<?php echo $tit?>"/>	
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $des?>" />
<meta name="twitter:title" content="<?php echo $tit?>" />
<meta name="twitter:image" content="images/webinar.jpg" />	
<link rel="icon" href="images/favi.png" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'/>
<script src='js/bootstrap.min.js'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link type="text/css" href="ckeditor/_samples/sample.css"/>
<link rel="stylesheet"  href="css/admin.css"/>
</head>
<body>
<section class="titadmin">
    <div class="container">
        <div class="row">
            <?php 
                require_once('sup-admin/headadmin.php');
            ?>
        </div>
    </div>
</section>
<section class="contentmain">
<div class="container">
    <div class="row">
    <div  class="col-md-9 col-xs-12 conleft">
    <?php 
    if(isset($_GET['cd'])){
        $idchuyende=intval($_GET['cd']);
        $tm="select * from menu_mod where id=$menu_mod";$qtm=mysqli_query($con,$tm); $tenmod=@mysqli_fetch_assoc($qtm);
        $chuyende=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chuyende where id=$_GET[cd]"));
    ?>
    <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Danh sách video/bài học <a type="button"  class="dieuh btn btn-primary btn-xs" href="mod.php?id=<?php echo $menu_mod?>&cd=<?php echo $idchuyende?>">Thêm mới</a></div>
    <div style="line-height: 30px; padding-top: 20px;">
    <p><a class="butdo" href="ds_mod.php?id=<?php echo $menu_mod?>">Trở lại danh sách</a></p>
    <p>Danh mục: <b style="color: #0080FF;"><?php echo $tenmod['ten']?></b></p>
    <p>Chuyên đề: <b><?php echo $chuyende['ten']?></b></p>
    </div>
        <div class="danhsach">
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>TT</th><th>Video/bài học</th><th>Thứ tự</th><th>Quyền hạn</th>
                </tr>
                <?php  
                $tsp="select * from video where chuyende=$idchuyende order by thutu asc";$qsp=mysqli_query($con,$tsp);$soluong=mysqli_num_rows($qsp);
                //phan trang
                $page=isset($_GET["page"])?intval($_GET["page"]):1;
                $rows_per_page=20;
                $page_start=($page-1)*$rows_per_page;
                $page_end=$page*$rows_per_page;
                $number_of_page=ceil($soluong/$rows_per_page);
                if ($number_of_page>1)
                {
                        // Ti?n h�nh in t?ng trang //
                for ($i=1; $i<=$number_of_page; $i++)
                {	
                // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
                if ($i==$page)
                {			
                $list_page.="<td><span > <a style=\"color:#CE6700; background: silver;\" href=\"#\">[".$i."]</a> </span></td>";
                }
                // Ngu?c l?i... //
                else
                {
                    //trường hợp có từ 6 trang trở lên thì tạo ra ...
                    if($number_of_page>8){
                        if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
                            if($i<7){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$i."\">".$i."</a></td>";
                            }
                        }elseif($page>=($number_of_page-3)){
                            if($i>($number_of_page-7)){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$i."\">".$i."</a></td>";
                            }
                        }else{
                            $chamdauduoi=1;
                            if($i>($page-3) and $i<($page+3)){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$i."\">".$i."</a></td>";
                            }
                        }
                    }else{//còn không thì cộng list_page bình thường
                    $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$i."\">".$i."</a></td>";
                    }
                }
                }
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
                if($number_of_page>8 and $page<=4){$list_page=$list_page."<td>...</td><td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
                if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<td>...</td>".$list_page;}
                //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
                if($chamdauduoi==1){$list_page="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=1\">1</a></td><td>...</td>".$list_page."<td>...</td><td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ NEXT
                if($number_of_page!=$page){
                $list_page=$list_page."<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".($page+1)."\">NEXT</a></td>";
                }
                //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ PREV
                if(1!=$page){
                $list_page="<td><a href=\"ds_mod.php?id=$menu_mod&cd=$idchuyende&page=".($page-1)."\">PREV</a></td>".$list_page;
                }
                //cộng thêm chữ trang ở trước
                $list_page="<td style=\"border: 0px;background:none;color:black;\">Trang: </td><td style=\"border: 0px;background:none\"></td>".$list_page;	
                }
                //end phân trang
                $i=1;
                while($rsp=mysqli_fetch_assoc($qsp)){ 
                if ($i>$page_start){
                    $xoa="del.php?table=video&del=".$rsp['id'];
                    ?>
                <tr>
                    <td><?php  echo $i; ?></td>
                    <td style="text-align: left; line-height: 22px;"><?php  echo $rsp['ten']; ?>
                    <?php if($rsp['link']!=''){?>
                      <p>Link: <a style="color: #FF8080;" target="_blank" href="<?php echo $rsp['link']?>"><?php echo $rsp['link']?></a></p>  
                    <?php }?>
                    </td>
                    <td>
                    <?php  echo $rsp['thutu']; ?>
                    </td>
                    <td>
                    <a class="sua" href="mod.php?id=<?php echo $menu_mod?>&cd=<?php echo $idchuyende?>&edit=<?php  echo $rsp['id']; ?>">Sửa</a> - <a class="xoa" href="<?php  echo $xoa; ?>">Xóa</a>
                    </td>
                </tr>
                <?php  
                } 
                if ($i>=$page_end)
                {
                break;	
                }
                $i++;} ?>
            </table>
            
        </div>
        <?php 	
        // ? tr�n ta d? n?p n?i dung cho bi?n $list_page, b�y gi? th? in n� ra: //
        echo("
                        <table id=\"tabletr\" cellspacing=\"2\" cellpadding=\"0\" border=\"0\">
                        <tr>
                            ".$list_page."
                        </tr>
                        </table>
                   ");
        ?>
    <?php 
    }else{
    ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / <?php echo $tenmod['ten']?> <a type="button"  class="dieuh btn btn-primary btn-xs" href="mod.php?id=<?php echo $menu_mod?>">Thêm mới</a></div>
        <div class="danhsach">
            <table class="table"  cellspacing="0" cellpadding="0">
                <tr>
                    <th>TT</th><th>Chuyên đề</th><th>Ảnh đại diện</th><th>Bài học</th><th>Quyền hạn</th>
                </tr>
                <?php  
                $tsp="select * from chuyende where menu_mod=$menu_mod order by time desc";$qsp=mysqli_query($con,$tsp);$soluong=mysqli_num_rows($qsp);
                //phan trang
                $page=isset($_GET["page"])?intval($_GET["page"]):1;
                $rows_per_page=20;
                $page_start=($page-1)*$rows_per_page;
                $page_end=$page*$rows_per_page;
                $number_of_page=ceil($soluong/$rows_per_page);
                if ($number_of_page>1)
                {
                        // Ti?n h�nh in t?ng trang //
                for ($i=1; $i<=$number_of_page; $i++)
                {	
                // N?u $i b?ng $page hi?n gi? s? in d?m d? nh?n bi?t dang xem trang n�o //
                if ($i==$page)
                {			
                $list_page.="<td><span > <a style=\"color:#CE6700; background: silver;\" href=\"#\">[".$i."]</a> </span></td>";
                }
                // Ngu?c l?i... //
                else
                {
                    //trường hợp có từ 6 trang trở lên thì tạo ra ...
                    if($number_of_page>8){
                        if($page<=4){//nếu page đang ở những trang đầu thì chỉ xuất hiện ... ở cuối
                            if($i<7){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&page=".$i."\">".$i."</a></td>";
                            }
                        }elseif($page>=($number_of_page-3)){
                            if($i>($number_of_page-7)){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&page=".$i."\">".$i."</a></td>";
                            }
                        }else{
                            $chamdauduoi=1;
                            if($i>($page-3) and $i<($page+3)){
                                $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&page=".$i."\">".$i."</a></td>";
                            }
                        }
                    }else{//còn không thì cộng list_page bình thường
                    $list_page.="<td><a href=\"ds_mod.php?id=$menu_mod&page=".$i."\">".$i."</a></td>";
                    }
                }
                }
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
                if($number_of_page>8 and $page<=4){$list_page=$list_page."<td>...</td><td><a href=\"ds_mod.php?id=$menu_mod&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
                if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<td>...</td>".$list_page;}
                //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
                if($chamdauduoi==1){$list_page="<td><a href=\"ds_mod.php?id=$menu_mod&page=1\">1</a></td><td>...</td>".$list_page."<td>...</td><td><a href=\"ds_mod.php?id=$menu_mod&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ NEXT
                if($number_of_page!=$page){
                $list_page=$list_page."<td><a href=\"ds_mod.php?id=$menu_mod&page=".($page+1)."\">NEXT</a></td>";
                }
                //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ PREV
                if(1!=$page){
                $list_page="<td><a href=\"ds_mod.php?id=$menu_mod&page=".($page-1)."\">PREV</a></td>".$list_page;
                }
                //cộng thêm chữ trang ở trước
                $list_page="<td style=\"border: 0px;background:none;color:black;\">Trang: </td><td style=\"border: 0px;background:none\"></td>".$list_page;	
                }
                //end phân trang
                $i=1;
                while($rsp=mysqli_fetch_assoc($qsp)){ 
                if ($i>$page_start){
                    if($rsp['anh']!=''){$xoaanh='&img=*upload*mod*'.$rsp['anh'];}else{$xoaanh='';}
                    $xoa="del.php?table=chuyende$xoaanh&del=".$rsp['id'];
                    ?>
                <tr>
                    <td><?php  echo $i; ?></td>
                    <td><?php  echo $rsp['ten']; ?><br />
                    </td>
                    <td>
                    <img src="upload/mod/<?php  echo $rsp['anh']; ?>" width="100" />
                    </td>
                    <td>
                    <?php  
                        $tg1=@mysqli_num_rows(@mysqli_query($con,"select id from video where chuyende=$rsp[id]"));
                    ?>
                    <p style="margin-bottom: 20px;"><a class="butxanh" href="ds_mod.php?id=<?php echo $rsp['menu_mod']?>&cd=<?php echo $rsp['id']?>">Danh sách (<?php echo $tg1?>)</a></p>
                    <p><a class="butdo" href="mod.php?id=<?php echo $rsp['menu_mod']?>&cd=<?php echo $rsp['id']?>">+ Thêm bài</a></p>
                    </td>
                    <td>
                    <a class="sua" href="mod.php?id=<?php echo $menu_mod?>&edit=<?php  echo $rsp['id']; ?>">Sửa</a> - <a class="xoa" href="<?php  echo $xoa; ?>">Xóa</a>
                    </td>
                </tr>
                <?php  
                } 
                if ($i>=$page_end)
                {
                break;	
                }
                $i++;} ?>
            </table>
            
        </div>
        <?php 	
        // ? tr�n ta d? n?p n?i dung cho bi?n $list_page, b�y gi? th? in n� ra: //
        echo("
                        <table id=\"tabletr\" cellspacing=\"2\" cellpadding=\"0\" border=\"0\">
                        <tr>
                            ".$list_page."
                        </tr>
                        </table>
                   ");
        ?>
    <?php }?>
    </div>
    <div class="col-md-3 col-xs-12 conright">
    <?php  require_once('sup-admin/left.php'); ?>
    </div>
    </div>
</div>
</section>
<section class="afooter">
    <?php  require_once('sup-admin/footer.php'); ?>
</section>
</body>
</html>