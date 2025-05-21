<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('include/connect.php');
require_once('include/function.php');
if($u['id']!=1){exit();}
$url=$_SERVER['HTTP_REFERER'];
if(isset($_GET['xuly']) and $_GET['xuly']=='huydon'){
    $iddon=intval($_GET['iddon']);
    $inn=@mysqli_query($con,"update donhang set trangthai=3 where id=$iddon");
    if($inn){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
}
if(isset($_GET['xuly']) and $_GET['xuly']=='choquyettoan'){
    $iddon=intval($_GET['iddon']);
    $inn=@mysqli_query($con,"update donhang set trangthai=1 where id=$iddon");
    if($inn){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
}
if(isset($_GET['xuly']) and $_GET['xuly']=='huyhoantien'){
    $iddon=intval($_GET['iddon']);
    $timdon=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where id=$iddon"));
    $hoantien=$timdon['tien'];
    $uptien=@mysqli_query($con,"update dh_user set vimua=vimua+$hoantien where id=$timdon[idu]");
        $tieudetb='Đơn hàng #'.$timdon['time'].' đã bị hủy';
        $noidungtb='Đơn hàng #'.$timdon['time'].' đã bị hủy bởi Admin. Số tiền <b style="color:red">'.number_format($hoantien,0,'.',',').'<sup>đ</sup></b> Đã được nạp lại vào tài khoản mua hàng.';
        $upsd=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('huyhoantien',1,'*$timdon[idu]*',N'$tieudetb',N'$noidungtb',$time)");
        $inn=@mysqli_query($con,"update donhang set trangthai=7 where id=$iddon");
    if($inn){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
}
if(isset($_GET['xuly']) and $_GET['xuly']=='hoan'){
    $iddon=intval($_GET['iddon']);
    $inn=@mysqli_query($con,"update donhang set trangthai=4 where id=$iddon");
    if($inn){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
}
if(isset($_GET['xuly']) and $_GET['xuly']=='hoanthanh'){
    $iddon=intval($_GET['iddon']);
    $inn=@mysqli_query($con,"update donhang set trangthai=1 where id=$iddon");
    if($inn){
		ob_clean();
		header('location: '.$url);
		exit();
	}
	else
		echo 'Có lỗi, Thao tác chưa thành công ';
}
if(isset($_GET['xuly']) and $_GET['xuly']=='quyettoan'){
    $iddon=intval($_GET['iddon']);
    $don=@mysqli_fetch_assoc(@mysqli_query($con,"select * from donhang where id=$iddon"));
    $sanpham=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$don[idsanpham]"));
    $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$don[idu]"));
    //cập nhật trạng thái ở đơn hàng
    $inn=@mysqli_query($con,"update donhang set trangthai=2 where id=$iddon");
    //cộng tiền cho người trực tiếp bán theo tỷ lệ %
   //trả tiền chính
    if($don['nentang']==1 and $nguoiban['vip']!=3){// đơn là != tiktok thì cộng tiền chính.....nếu là tiktok thì tiền này tiktok trả, ...trường hợp chủ hệ thống bỏ ra để cộng ở đoạn dưới 1 mẻ luôn cho tiện
        $tienchinh=$don['gia']*$sanpham['pt_coban']*0.01;
        $updatetien0=@mysqli_query($con,"update dh_user set sodu=sodu+$tienchinh where id=$don[idu]");
        //luu vào lịch sử
        $noidung='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán (HH cơ bản '.$sanpham['pt_coban'].'%)';
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($don[idu],$tienchinh,N'$noidung',0,$time,$times)");
    }
    //nếu trường hợp người bán là chủ hệ thống....thì cộng hết 1 lượt cho họ
    if($nguoiban['vip']==3){
        if($don['nentang']==1){// đơn là != tiktok thì cộng tiền chính.....nếu là tiktok thì tiền này tiktok trả,
            $tientatca=$don['gia']*$sanpham['pt_coban']*0.01+$don['gia']*$sanpham['pt_them']*0.01+$don['gia']*$sanpham['pt_3don']*0.01+$don['gia']*$sanpham['pt_hethong']*0.01;
            $noidung='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán. <br />Tài khoản Chủ hệ thống bán lẻ, bạn nhân được tất cả các khoản hoa hồng như sau: <br />HH cơ bản '.$sanpham['pt_coban'].'%<br /> HH Bignet '.$sanpham['pt_them'].'%<br /> HH hướng dẫn '.$sanpham['pt_huongdan'].'%<br /> HH quản lý '.$sanpham['pt_hethong'].'%<br />Phần lợi nhuận dành rêng cho chủ hệ thống vui lòng xem tại Tài chính chủ hệ thống';
        }else{
            $tientatca=$don['gia']*$sanpham['pt_them']*0.01+$don['gia']*$sanpham['pt_3don']*0.01+$don['gia']*$sanpham['pt_hethong']*0.01;
            $noidung='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán. <br />Tài khoản Chủ hệ thống bán lẻ, bạn nhân được tất cả các khoản hoa hồng như sau: <br />HH cơ bản '.$sanpham['pt_coban'].'% (Tiktok trả)<br /> HH Bignet '.$sanpham['pt_them'].'%<br /> HH hướng dẫn '.$sanpham['pt_huongdan'].'%<br /> HH quản lý '.$sanpham['pt_hethong'].'%<br />Phần lợi nhuận dành rêng cho chủ hệ thống vui lòng xem tại Tài chính chủ hệ thống';
        }
        $updatetien0=@mysqli_query($con,"update dh_user set sodu=sodu+$tientatca where id=$don[idu]");
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($don[idu],$tientatca,N'$noidung',0,$time,$times)");
        $tennhan=$nguoiban['fullname'];
    }else{//trường hợp còn lại
   //Trả tiền thêm
    $tienthem=$don['gia']*$sanpham['pt_them']*0.01;
    $updatetien1=@mysqli_query($con,"update dh_user set sodu=sodu+$tienthem where id=$don[idu]");
    //luu vào lịch sử
    $noidung='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán (HH Bignet '.$sanpham['pt_them'].'%)';
    $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($don[idu],$tienthem,N'$noidung',1,$time,$times)");
   //kiểm tra tình trạng 3 đơn
    $batdau=substr($don['time'],0,8).'000000';
    $ketthuc=substr($don['time'],0,8).'235959';
    $badon=@mysqli_query($con,"select * from donhang where idu=$don[idu] and trangthai=2 and time>=$batdau and time<=$ketthuc");
    $tongsodontrong1ngay=@mysqli_num_rows($badon);
    if($tongsodontrong1ngay>=3){
        while($rbadon=@mysqli_fetch_assoc($badon)){
            //tim lại sản phẩm
            $splai=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_sanpham where id=$rbadon[idsanpham]"));
            if($rbadon['datra3don']==0){
                 //Trả tiền thêm
                $tien3don=$rbadon['gia']*$splai['pt_3don']*0.01;
                $updatetien2=@mysqli_query($con,"update dh_user set sodu=sodu+$tien3don where id=$don[idu]");
                $updatedatra=@mysqli_query($con,"update donhang set datra3don=1 where id=$rbadon[id]");
                //luu vào lịch sử
                $noidung='Quyết toán đơn hàng <b>'.$rbadon['madon'].'</b> bạn bán (HH 3 đơn '.$splai['pt_3don'].'%)';
                $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($don[idu],$tien3don,N'$noidung',2,$time,$times)");
            }
        }
    }
    //kiểm tra và kích hoạt thành viên chính thức trước đã
    //nếu không áp điều kiện thì đã kích hoạt ở trang connect.php
    if($nguoiban['vip']==0 and $nguoiban['id']!=1){
        if($ru['loaidieukien']==0){//tính theo tổng số đơn
            if(@mysqli_num_rows(@mysqli_query($con,"select * from donhang where idu=$don[idu] and trangthai=2"))>=$ru['dkuserchinhthuc']){
                $uct=@mysqli_query($con,"update dh_user set vip=1 where id=$don[idu]");
                $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$don[idu]"));
            }
        }else{//tính theo số đơn 1 ngày
            if($tongsodontrong1ngay>=$ru['dkuserchinhthuc']){
                $uct=@mysqli_query($con,"update dh_user set vip=1 where id=$don[idu]");
                $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$don[idu]"));
            }
        }
    }
    //trả cho upline
    //đầu tiên kiểm tra xem có áp điều kiện nhận hoa hồng hướng dẫn không
    $dknhanhh=0;
    if($ru['dkhoahong']==0){//ko áp điều kiện
        $dknhanhh=1;
    }else{
        if($nguoiban['vip']==1){
            $dknhanhh=1;
        }
    }
    $congthemhhhuongdancht=0;
    //trường hơp tk bá là admin, hoặc quản lý cấp cao thì phần upline này cộng luôn cho họ
    if($nguoiban['id']==1){//đây là admin --- trường hợp này không cần thiết
        $idupline=1;
        $tienup=$don['gia']*$sanpham['pt_huongdan']*0.01;
        $updatetien4=@mysqli_query($con,"update dh_user set sodu=sodu+$tienup where id=$idupline");
        //luu vào lịch sử
        $noidung4='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán (HH hướng dẫn '.$sanpham['pt_huongdan'].'%)';
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($idupline,$tienup,N'$noidung4',3,$time,$times)");
    }elseif($nguoiban['vip']==2){//đây là nhà quản lý --- khi được kích lên thì họ sẽ tự nhận hoa hồng hướng dẫn của chính ho....động viên họ phấn đấu và có kết quả để làm hệ thống
        $idupline=$nguoiban['id'];
        $tienup=$don['gia']*$sanpham['pt_huongdan']*0.01;
        $updatetien4=@mysqli_query($con,"update dh_user set sodu=sodu+$tienup where id=$idupline");
        //luu vào lịch sử
        $noidung4='Quyết toán đơn hàng <b>'.$don['madon'].'</b> bạn bán (HH hướng dẫn '.$sanpham['pt_huongdan'].'%). Ưu đãi Nhà quản lý, bạn nhận được hoa hồng hướng dẫn của chính bạn';
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($idupline,$tienup,N'$noidung4',3,$time,$times)");
    }elseif($dknhanhh==1){
        $idupline=$nguoiban['idgioithieu'];
        $tienup=$don['gia']*$sanpham['pt_huongdan']*0.01;
        $updatetien4=@mysqli_query($con,"update dh_user set sodu=sodu+$tienup where id=$idupline");
        //luu vào lịch sử
        $noidung4='Quyết toán đơn hàng <b>'.$don['madon'].'</b> do <b>'.$nguoiban['fullname'].'</b> bán (HH hướng dẫn '.$sanpham['pt_huongdan'].'%)';
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($idupline,$tienup,N'$noidung4',3,$time,$times)");
    }else{
        $congthemhhhuongdancht=1;
    }
    //giờ đến trường hợp cộng tiền cho Quản lý
    //kiểm tra xem nhà quản lý đã được xác nhận là ok chưa nếu rồi thì khỏi kiểm tra
    $congquanly=0;
    $congchoCHT=0;
    if($nguoiban['id']==1 or $nguoiban['vip']==2){//trường hợp admin hoặc quản lý bán đơn của họ
        $congquanly=1;
        $idquanly=$nguoiban['id'];
        $tennhan=$nguoiban['fullname'];
    }else{
        //giờ đi tìm người quản lý của người bán
        $hethong=str_replace("**","-",$nguoiban['hethong']);
        $hethong=trim(str_replace("*","",$hethong));
        $tachht=explode("-",$hethong);
        if(count($tachht)==2){//người bán có hethong dạng *1**12*. Mà lại không phải là nhà quản lý (vì NQL có vip=2 ở trên rồi). Thì rõ ràng là gắn với CHT mà ko được kích hoạt NQL
            $congchoCHT=1;
        }else{
            $idquanly=$tachht[1];
            $quanly=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$idquanly"));
            if($quanly['kichhoatcapcao']==1){//đã kích hoạt rồi thì khỏi bàn
                $congquanly=1;
                $tennhan=$quanly['fullname'];
            }else{//chưa thì kiểm tra xem có kich hoạt được không
                if($u['dkquanlycapcao']==0){//cài đặt không có điều kiện. Khỏi bàn luôn
                    $congquanly=1;
                    $tennhan=$quanly['fullname'];
                }else{
                    //tìm số thành viên chính thức
                    $keytim='*'.$idquanly.'*';
                    $sothanhvien=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where hethong like '%$keytim%' and vip=1"));
                    if($sothanhvien>=$u['dkquanlycapcao']){
                        $congquanly=1;
                        $updatecc=@mysqli_query($con,"update dh_user set kichhoatcapcao=1 where id=$idquanly");
                        $tennhan=$quanly['fullname'];
                    }else{//trường hợp chưa kích hoạt thì cộng tiền cho CHT
                        $congchoCHT=1;
                    }
                }
            }
        }
    }
    //giờ cộng thôi
    if($congquanly==1){
        $tienupql=$don['gia']*$sanpham['pt_hethong']*0.01;
        $updatetien5=@mysqli_query($con,"update dh_user set sodu=sodu+$tienupql where id=$idquanly");
        //luu vào lịch sử
        $noidung5='Quyết toán đơn hàng <b>'.$don['madon'].'</b> do <b>'.$nguoiban['fullname'].'</b> bán (HH Quản lý '.$sanpham['pt_hethong'].'%)';
        $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($idquanly,$tienupql,N'$noidung5',4,$time,$times)");
    }
    }
    //giờ xử lý đơn cho chủ hệ thống
    //bước 1 xác định đơn là của ai
    $htb=explode("**",$nguoiban['hethong']);
    if(count($htb)==1){//hethong nick chủ hẹ thống là *1* nên có chỉ có 1 giá trị
        $idchuhethong=$nguoiban['id'];
        $tenf='';
    }else{
        $idchuhethong=intval(str_replace("*","",$htb[1]));
        $tenf=' [F'.(count($htb)+1).']';
    }
    $tiencht=$don['gia']-$don['gia']*$sanpham['pt_coban']*0.01-$don['gia']*$sanpham['pt_them']*0.01-$don['gia']*$sanpham['pt_3don']*0.01-$don['gia']*$sanpham['pt_huongdan']*0.01-$don['gia']*$sanpham['pt_hethong']*0.01-$sanpham['chuhethong']-$don['gia']*0.115;
    if($congchoCHT==1){
        $tiencht=$tiencht+$don['gia']*$sanpham['pt_hethong']*0.01;
        $timtencht=@mysqli_fetch_assoc(@mysqli_query($con,"select fullname from dh_user where id=$idchuhethong"));
        $tennhan=$timtencht['fullname'];
        $ptql=0;
    }else{
        $ptql=$sanpham['pt_hethong'];
    }
    if($congthemhhhuongdancht==1){
        $tiencht=$tiencht+$don['gia']*$sanpham['pt_huongdan']*0.01;
        $pthd=0;
    }else{
        $pthd=$sanpham['pt_huongdan'];
    }
    $phi=$don['gia']*0.115;
    $note='';
    $luutaichinh=@mysqli_query($con,"insert into donhangcht (
        idcht,idban,iddon,
        idsanpham,slsanpham,gia,
        hhcoban,hhthem,hh3don,
        hhhuongdan,hhhethong,nhanhhhethong,
        phi,loinhuan,time,note
        )value(
        $idchuhethong,$nguoiban[id],$don[id],
        $sanpham[id],1,$don[gia],
        $sanpham[pt_coban],$sanpham[pt_them],$sanpham[pt_3don],
        $pthd,$ptql,N'$tennhan',
        $phi,$tiencht,$time,N'$note'
        )");
    $updatetien6=@mysqli_query($con,"update dh_user set sodu=sodu+$tiencht where id=$idchuhethong");
    //luu vào lịch sử
    $timee=$time+10;
    $timese=$times+10;
    $noidung6='Quyết toán đơn hàng <b>'.$don['madon'].'</b> hệ thống do <b>'.$nguoiban['fullname'].'</b>'.$tenf.' bán. Trả lợi nhuận Chủ hệ thống sau khi trừ tất cả các chi phí.';
    $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,khoan,time,times)value($idchuhethong,$tiencht,N'$noidung6',6,$timee,$timese)");
    //trờ về thôi
		ob_clean();
		header('location: '.$url);
		exit();
}

if(isset($_GET['xuly']) and $_GET['xuly']=='chuyenkhoan'){
    $idy=intval($_GET['id']);
    $don=@mysqli_fetch_assoc(@mysqli_query($con,"select * from yeucauruttien where id=$idy"));
    $nguoiban=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_user where id=$don[idu]"));
    //cập nhật trạng thái ở yêu cầu rút tiền
    $inn=@mysqli_query($con,"update yeucauruttien set trangthai=1,timexuly=$time where id=$idy");
    //cập nhật số dư đóng băng
    $inn2=@mysqli_query($con,"update dh_user set dongbang=0 where id=$don[idu]");
   //luu vao lich su
   //luu vào lịch sử
    $noidung='Yêu cầu rút tiền <b>'.$don['ma'].'</b> đã được xử lý';
    $luuls=@mysqli_query($con,"insert into lichsutien (idu,sotien,noidung,loai,time,times)value($don[idu],$don[sotien],N'$noidung',1,$time,$times)");
   //thông báo nữa
    $madon=$don['ma'];
    $tieudetb='Lệnh rút tiền '.$madon.' Đã được xử lý';
    $noidungtb='Hệ thống đã thanh toán tiền hoa hồng của bạn <b style="color:red">'.number_format($don['sotien'],0,'.',',').'<sup>đ</sup></b> (Mã lệnh: '.$madon.') lúc '.retimefull($time).'. Chúc mừng và mong nhận được ngày càng nhiều yêu cầu của bạn trong thời gian tới.';
    $upsd=@mysqli_query($con,"insert into thongbao (loai,idgui,idnhan,tieude,noidung,time)value('trahoahong',1,'*$don[idu]*',N'$tieudetb',N'$noidungtb',$time)");
    //trờ về thôi
		ob_clean();
		header('location: '.$url);
		exit();
}
?>