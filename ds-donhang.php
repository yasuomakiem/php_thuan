<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from donhang order by time desc";$que=mysqli_query($con,$tim);$num=mysqli_num_rows($que);
if(isset($_GET['veiw'])){$hienthi=$_GET['veiw'];}else{$hienthi=10;}
if(isset($_POST['chonhienthi'])){
    $hienthi=$_POST['hienthi'];
    echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="ds-donhang.php?veiw='.$hienthi.'";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
    }
$timu="select * from dh_user where id=1";$qu=mysqli_query($con,$timu);$r=mysqli_fetch_assoc($qu);$quyen=$_COOKIE['quyen'];
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
    <div style="min-height: 0;" id="right">
        <div class="tit">Danh sách đơn hàng 
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
                <th>TT</th><th>Họ tên</th><th>Địa chỉ</th><th>Số điện thoại</th><th>Yêu cầu</th><th>Thời gian</th><th>Xem chi tiết</th><th style="width: 150px;">Quyền</th>
            </tr>
                <?php 
                $tsp="select * from donhang order by time desc";$qsp=mysqli_query($con,$tsp);$soluong=mysqli_num_rows($qsp);
                if($soluong==0){echo "<tr><td colspan='8'>Chưa có đơn hàng nào được gửi tới.</td></tr>";}
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
                                $list_page.="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }elseif($page>=($number_of_page-3)){
                            if($i>($number_of_page-7)){
                                $list_page.="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }else{
                            $chamdauduoi=1;
                            if($i>($page-3) and $i<($page+3)){
                                $list_page.="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                            }
                        }
                    }else{//còn không thì cộng list_page bình thường
                    $list_page.="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$i."\">".$i."</a></td>";
                    }
                }
                }
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đuôi
                if($number_of_page>8 and $page<=4){$list_page=$list_page."<td>...</td><td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //nếu có xuất hiện dấu ... mà page đang ở đầu thì ccoongj thêm ... ở đầu
                if($number_of_page>8 and $page>=($number_of_page-3)){$list_page="<td>...</td>".$list_page;}
                //nếu xuất hiện dầu chấm ở hai đầu thì làm như sau
                if($chamdauduoi==1){$list_page="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=1\">1</a></td><td>...</td>".$list_page."<td>...</td><td><a href=\"ds-donhang.php?veiw=$hienthi&page=".$number_of_page."\">".$number_of_page."</a></td>";}
                //trường hợp trang hiện tại không phải là trang cuối thì hiện thị chữ NEXT
                if($number_of_page!=$page){
                $list_page=$list_page."<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".($page+1)."\">NEXT</a></td>";
                }
                //trường hợp trang hiện tại không phải là 1 thì hiện thị chữ PREV
                if(1!=$page){
                $list_page="<td><a href=\"ds-donhang.php?veiw=$hienthi&page=".($page-1)."\">PREV</a></td>".$list_page;
                }
                //cộng thêm chữ trang ở trước
                $list_page="<td style=\"border: 0px;background:none;color:black;\">Trang: </td><td style=\"border: 0px;background:none\"></td>".$list_page;	
                }
                //end phân trang
                $i=1;
                while($row=mysqli_fetch_assoc($qsp)){ 
                if ($i>$page_start){
                    if($_COOKIE['quyen']==1){$xoa="del-donhang.php?del=".$rsp['id'];}else{$xoa="#";}
                    ?>
                <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['hoten']; ?></td>
                <td style="text-align: left;"><?php echo $row['diachi']; ?></td>
                <td><?php echo $row['sdt']; ?></td>
                <td><?php echo $row['ghichu']; ?></td>
                <td><?php echo tra_lai_time($row['time']); ?></td>
                <td><a href="ds-donhang.php?fullname=<?php echo $row['hoten']; ?>&idsp=<?php echo $row['id']; ?>">Xem</a></td>
                <td style="line-height: 24px;">
                <?php if($row['trangthai']==0){?>
                <p><a onclick="return confirm('Bạn chắc chắn muốn xác nhận hoàn thành với đơn hàng này?')" href="<?php echo("xulydon.php?xuly=hoanthanh&iddon=$row[id]");?>">Xác nhận Hoàn thành</a></p>
                <p><a onclick="return confirm('Bạn chắc chắn muốn hủy đơn và hoàn tiền với đơn hàng này?')" style="color: red;" href="<?php echo("xulydon.php?xuly=huyhoantien&iddon=$row[id]");?>">Hủy đơn, hoàn tiền</a></p>
                <?php }elseif($row['trangthai']==7){?>
                    <span style="color: #820000;">Hủy đơn hoàn tiền</span>
                <?php }else{ ?>
                    Đã hoàn thành
                <?php }?>
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
        <!-- trình bày sản phẩm -->
        <div class="clr"></div>
        <?php if(isset($_GET['idsp'])){ ?>
    <div style="padding-bottom: 25px;padding-top: 25px;" class="tit">Danh sách sản phẩm <span style="color: #0080C0;"><?php echo $_GET['fullname']; ?> </span>đã đặt:
    <a style="float: right; color: red;" href="ds-donhang.php" title="Tắt xem chi tiết">X</a>
    </div>
    <div class="danhsach">
        <table cellpadding="0" cellspacing="0">
        <tr>
            <th>TT</th><th>Ảnh</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th>
        </tr>
            <?php
        $giohang=intval($_GET['idsp']);
        $don=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where id=$giohang"));
        $tach=array();
        $tongtien=0;
        $tach=explode(",",$giohang);
        $cart = addslashes($don['chuoi']);
        $cart=trim($cart);
        $tach=explode(' ',$cart);
        for($i=0;$i<count($tach);$i++){
            $idsl=$tach[$i];
            $tach2=array();
            $tach2=explode("-",$idsl);
            $idsp=$tach2[0];$solg=$tach2[1];
            $timsp="select * from dh_sanpham where id=$idsp";$qspham=mysqli_query($con,$timsp);$rspg=mysqli_fetch_assoc($qspham);
            echo "<tr>";
            $anhanh=explode(',',$rspg['anh']);
            echo "
            <td>".($i+1)."</td>
            <td><img src='upload/sanpham/$anhanh[0]' width='100' height='100' /></td>
            <td style='color:blue; text-align:left'>$rspg[ten]</td>
            <td>".$solg."</td>
            <td style='color:red;'>".number_format($rspg['gia'],0,',','.')." đ</td>
            <td style='color:red;'>".number_format(($rspg['gia']*$solg),0,',','.')." đ</td>
            ";
            echo "</tr>";
            $tongtien=($rspg['gia']*$solg)+$tongtien;
        }
    ?>
        </table>
    <h3 style="padding: 10px; float: right; text-align: right;">Tổng giá trị đơn hàng: <b style="color: red;"> 
    <?php
    echo number_format($tongtien,0,',','.')." VNĐ"; 
    ?>
    </b></h3>
    </div>
    <?php } ?>
    </div>
    <div style="clear: both;"></div>
    <?php require_once('sup-admin/footer.php'); ?>
    </div>
</body>
</html>