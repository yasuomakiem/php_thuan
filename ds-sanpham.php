<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
if(isset($_GET['veiw'])){$hienthi=$_GET['veiw'];}else{$hienthi=10;}
if(isset($_POST['chonhienthi'])){
    $hienthi=$_POST['hienthi'];
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-sanpham.php?veiw='.$hienthi.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }
$tim="select * from dh_user where id=$iduser";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);$quyen=$r['quyen'];
$them='';
if(isset($_GET['m1'])){
    $them='where menu1='.$_GET['m1'].' ';
    $thempage='m1='.$_GET['m1'];
    $tsp="select * from dh_sanpham $them and iduser=$iduser order by time desc";$qsp=@mysqli_query($con,$tsp);$soluong=@mysqli_num_rows($qsp);
}elseif(isset($_GET['m2'])){
    $them='where menu2='.$_GET['m2'].' ';
    $thempage='m2='.$_GET['m2'];
    $tsp="select * from dh_sanpham $them and iduser=$iduser order by time desc";$qsp=@mysqli_query($con,$tsp);$soluong=@mysqli_num_rows($qsp);
}elseif(isset($_POST['timsp']) or isset($_GET['search'])){
    if(isset($_GET['search'])){$key=$_GET['search'];}else{
    $key=$_POST['k'];
    }
    $thempage='search='.$key;
    $tsp="select * from dh_sanpham where (ten like N'%$key%' or ma like N'%$key%') and iduser=$iduser order by time desc";$qsp=@mysqli_query($con,$tsp);$soluong=@mysqli_num_rows($qsp);
}else{
    $tsp="select * from dh_sanpham where iduser=$iduser order by time desc";$qsp=@mysqli_query($con,$tsp);$soluong=@mysqli_num_rows($qsp);
    $thempage='1=1';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="Quản trị hệ thống" />
<title>Trang quản trị</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>sup-admin/main_admin.css" />
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
        <div class="tit">Danh sách sản phẩm <span style="font-weight: normal; color: #333; font-size: 13px;">(hiện có <b style="color: red;"><?=$soluong?></b> sản phẩm)</span>
        </div>
        <div class="danhsach">
        
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th>TT</th><th style="">Tên sản phẩm</th><th>Ảnh sản phẩm</th><th>Giá bán</th><th>Quyền hạn</th>
                </tr>
                <?php 
                
                //phan trang
                $page=isset($_GET["page"])?intval($_GET["page"]):1;
                $rows_per_page=$hienthi;
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
                                $list_page.="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }elseif($page>=($number_of_page-3)){
                            if($i>($number_of_page-7)){
                                $list_page.="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }else{
                            $chamdauduoi=1;
                            if($i>($page-3) and $i<($page+3)){
                                $list_page.="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }
                    }else{//còn không thì cộng list_page bình thường
                    $list_page.="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                    }
                }
                }
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
                if($number_of_page>8 and $page<=4){$list_page=$list_page."<td>...</td><td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
                if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<td>...</td>".$list_page;}
                //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
                if($chamdauduoi==1){$list_page="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=1\">1</a></td><td>...</td>".$list_page."<td>...</td><td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ NEXT
                if($number_of_page!=$page){
                $list_page=$list_page."<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".($page+1)."\">NEXT</a></td>";
                }
                //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ PREV
                if(1!=$page){
                $list_page="<td><a href=\"ds-sanpham.php?veiw=$hienthi&page=".($page-1)."\">PREV</a></td>".$list_page;
                }
                //cộng thêm chữ trang ở trước
                $list_page="<td style=\"border: 0px;background:none;color:black;\">Trang: </td><td style=\"border: 0px;background:none\"></td>".$list_page;	
                }
                //end phân trang
                $i=1;
                while($rsp=@mysqli_fetch_assoc($qsp)){ 
                if ($i>$page_start){
                    
                    ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style=""><?php echo $rsp['ten']; ?>
                    
                    </td>
                    <td>
                    <?php 
                    
                    $xoa="del.php?table=dh_sanpham&del=".$rsp['id'].$xoaimg;
                    ?>
                    <img src="upload/sanpham/<?php echo $rsp['anh']; ?>" width="100" />
                    </td>
                    
                    <td style="text-align: left;color: red;">
                        <?php
                        
                        echo "".number_format($rsp['gia'],0,',','.').$r['tiente']." <br />
                        ";
                        
                        ?>
                    </td>
                    <td style="">
                    <p style="margin-bottom: 20px;"><a class="sua" href="edit-sanpham.php?edit=<?php echo $rsp['id']; ?>">Sửa</a> </p><p>
                    <a class="xoa" onclick="return confirm('Bạn chắc chắn muốn xóa nội dung này?')" href="<?php echo $xoa; ?>">Xóa</a></p>
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
    </div>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>