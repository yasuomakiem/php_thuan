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
            window.location="ds-lienhe.php?veiw='.$hienthi.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }
$tim="select * from dh_user where id=1";$q=mysql_query($tim);$r=mysql_fetch_assoc($q);$quyen=$r['quyen'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="web300k" />
<meta name="description" content="web300k thế giới web giá rẻ và không thể rẻ hơn" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="sup-admin/main_admin.css" />
<style>
td#banner img{max-height: 200px; max-width: 400px;}
</style>
</head>
<body>
<?php require_once('sup-admin/head.php'); ?>
    <div id="main">
    <?php require_once('sup-admin/left.php'); ?>
    <div id="right">
        <div class="tit">Danh sách khách hàng yêu cầu báo giá 
        <div style="float: right; font-size: 13px;">
        <form action="" method="post">Hiển thị 
        <select style="padding: 2px 5px;" name="hienthi">
            <option value="5" <?php if($hienthi==5){echo 'selected="selected"';} ?>>5</option>
            <option value="10" <?php if($hienthi==10){echo 'selected="selected"';} ?>>10</option>
            <option value="15" <?php if($hienthi==15){echo 'selected="selected"';} ?>>15</option>
            <option value="20" <?php if($hienthi==20){echo 'selected="selected"';} ?>>20</option>
            <option value="25" <?php if($hienthi==25){echo 'selected="selected"';} ?>>25</option>
            <option value="30" <?php if($hienthi==30){echo 'selected="selected"';} ?>>30</option>
        </select>
        <input type="submit" value="OK" name="chonhienthi" />
        </form>
        </div>
        </div>
        <div class="danhsach">
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th>TT</th><th>Nội dung</th><th>Quyền hạn</th>
                </tr>
                <?php 
                $tsp="select * from dh_lienhe order by time desc";$qsp=mysql_query($tsp);$soluong=mysql_num_rows($qsp);
                if($soluong==0){echo "<tr><td colspan='5'>Chưa có Liên hệ nào được gửi tới.</td></tr>";}
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
                                $list_page.="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }elseif($page>=($number_of_page-3)){
                            if($i>($number_of_page-7)){
                                $list_page.="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }else{
                            $chamdauduoi=1;
                            if($i>($page-3) and $i<($page+3)){
                                $list_page.="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }
                    }else{//còn không thì cộng list_page bình thường
                    $list_page.="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                    }
                }
                }
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
                if($number_of_page>8 and $page<=4){$list_page=$list_page."<td>...</td><td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
                if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<td>...</td>".$list_page;}
                //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
                if($chamdauduoi==1){$list_page="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=1\">1</a></td><td>...</td>".$list_page."<td>...</td><td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ NEXT
                if($number_of_page!=$page){
                $list_page=$list_page."<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".($page+1)."\">NEXT</a></td>";
                }
                //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ PREV
                if(1!=$page){
                $list_page="<td><a href=\"ds-lienhe.php?veiw=$hienthi&page=".($page-1)."\">PREV</a></td>".$list_page;
                }
                //cộng thêm chữ trang ở trước
                $list_page="<td style=\"border: 0px;background:none;color:black;\">Trang: </td><td style=\"border: 0px;background:none\"></td>".$list_page;	
                }
                //end phân trang
                $i=1;
                while($rsp=mysql_fetch_assoc($qsp)){ 
                if ($i>$page_start){
                    if($_COOKIE['quyen']==1){$xoa="del-lienhe.php?del=".$rsp['id'];}else{$xoa="#";}
                    ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style="padding: 8px 15px; text-align: left; line-height: 22px;">
                    
                    
                    <p><?php echo $rsp['noidung']; ?></p>
                    <p>Gửi lúc: <b><?php echo tra_lai_time($rsp['time']); ?></b></p>
                    </td>
                    <td>
                    <a class="xoa" href="<?php echo $xoa; ?>">Xóa</a>
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