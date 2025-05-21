<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);$quyen=$r['quyen'];
$tit='Danh sách thành viên hệ thống';
if(isset($_POST['cap1'])){
    $fullname=addslashes($_POST['fullname']);
    $chucdanh=addslashes($_POST['chucdanh']); 
    $phone=addslashes($_POST['phone']);
    $ticp=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where phone='$phone'"));
    if($ticp==0){
    $email=addslashes($_POST['email']);
    $tice=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where email='$email'"));
    if($tice==0){
    $mk=addslashes($_POST['pass']);
    $pass=md5($mk);
    if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/user/".$tenanh);
    $slogan=addslashes($_POST['slogan']);
    $address=addslashes($_POST['address']);
    $in1="insert into dh_user (fullname,avatar,phone,email,slogan,chucdanh,pass,address,time)value(N'$fullname',N'$tenanh','$phone','$email',N'$slogan',N'$chucdanh','$pass',N'$address',$time)";
    $qup=@mysqli_query($con,$in1);
    if($qup){
        $thongbao="<tr><th></th><td style='color:blue'>Tạo thành viên thành công!</td></tr>";
        $ten='';$tukhoa='';$thutu='';$des='';$tit='';
    }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
    }else{$thongbao="<tr><th></th><td style='color:red'>Ảnh là bắt buộc!</td></tr>";}
    }else{
        $thongbao="<tr><th></th><td style='color:red'>Email đã được sử dụng</td></tr>";
    }
    }else{
        $thongbao="<tr><th></th><td style='color:red'>Số điện thoại đã được sử dụng</td></tr>";
    }
}
if(isset($_GET['edit'])){
        $id=intval($_GET['edit']);
        $tmn="select * from dh_user where id=$id";$qmn=@mysqli_query($con,$tmn);$rmn=@mysqli_fetch_assoc($qmn);
    if(isset($_POST['edit'])){
        $fullname=addslashes($_POST['fullname']);
        $chucdanh=addslashes($_POST['chucdanh']); 
        $phone=addslashes($_POST['phone']);
        $ticp=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where id!=$id and phone='$phone'"));
        if($ticp==0){
        $email=addslashes($_POST['email']);
        $tice=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where id!=$id and email='$email'"));
        if($tice==0){
        $mk=addslashes($_POST['pass']);
        if($mk!=''){
            $pass=md5($mk);
        }else{
            $pass=$rmn['pass'];
        }
        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
            $tenanh=$_FILES['image']['name'];
            $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
            $tenanh=time().$tenanh;
            move_uploaded_file($_FILES['image']['tmp_name'],"upload/user/".$tenanh);
        }else{$tenanh=$rmn['avatar'];}
        $slogan=addslashes($_POST['slogan']);
        $address=addslashes($_POST['address']);
        if($_POST['level']){
            $level=intval($_POST['level']);
        }else{
            $level=$rmn['level'];
        }
        $virut=intval($_POST['virut']);
        $vimua=intval($_POST['vimua']);
        $in1="update dh_user set fullname=N'$fullname',avatar=N'$tenanh',phone='$phone',email='$email',slogan=N'$slogan',virut=$virut,vimua=$vimua,address=N'$address',pass='$pass',level=$level where id=$id";
        $qup=@mysqli_query($con,$in1);
        if($qup){
            $tmn="select * from dh_user where id=$id";$qmn=@mysqli_query($con,$tmn);$rmn=@mysqli_fetch_assoc($qmn);
            $thongbao="<tr><th></th><td style='color:blue'>Sửa thành viên thành công!</td></tr>";
            echo '
                <script language="JavaScript">
                var my_timeout=setTimeout("gotosite();",0);
                function gotosite()
                {
                window.location="taouser.php";
                }
                </script>
                ';// cái này là chuyển trang bằng javascript
                
        }else{$thongbao="<tr><th></th><td style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</td></tr>";}
        }else{
            $thongbao="<tr><th></th><td style='color:red'>Email đã được sử dụng</td></tr>";
        }
        }else{
            $thongbao="<tr><th></th><td style='color:red'>Số điện thoại đã được sử dụng</td></tr>";
        }
    }
}
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
    <?php if(isset($_GET['edit'])){
        ?>
        <style>
            .formdoi .form-group{}
            .formdoi .form-group label{
                line-height: 34px;
                padding: 0;
                text-align: right;
                font-weight: normal;
            }
            .formdoi .form-group label span{color: red;}
            .formdoi .form-group input.form-control{}
        </style>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / <a href="taouser.php"> Thành viên</a> / Sửa thông tin</div>
        <form id="form" class="formdoi" action="" method="post" enctype="multipart/form-data">
            
            <?php  echo $thongbao; ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Sửa tên:</label>
                    <div class="col-sm-8"><input class="form-control" name="fullname" value="<?php  echo $rmn['fullname']; ?>"  /></div>
                    <div class="clearfix"></div>
                </div>
                <?php if($rmn['idgioithieu']==1){?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Chức danh:</label>
                    <div class="col-sm-8">
                        <div class="checkbox" style="margin-top: 8px;">
                        <label style="padding-left: 20px; line-height: 21px;">
                        <input name="level" type="checkbox" value="2" <?php if($rmn['level']==2){echo 'checked=""';}?> />
                        Kích hoạt tài khoản "Quản lý cấp cao"
                        </label>
                        </div>
                        <p class="help-block">Chỉ những tài khoản đăng ký trực tiếp với Admin mới kích được "Quản lý cấp cao".</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php }else{?>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Chức danh:</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="level">
                          <option value="0" <?php if($rmn['level']==0){ echo 'selected=""';} ?>><?php echo capbac(0);?></option>
                          <option value="1" <?php if($rmn['level']==1){ echo 'selected=""';} ?>><?php echo capbac(1);?></option>
                          <option value="2" <?php if($rmn['level']==2){ echo 'selected=""';} ?>><?php echo capbac(2);?></option>
                          <option value="3" <?php if($rmn['level']==3){ echo 'selected=""';} ?>><?php echo capbac(3);?></option>
                          <option value="4" <?php if($rmn['level']==4){ echo 'selected=""';} ?>><?php echo capbac(4);?></option>
                          <option value="5" <?php if($rmn['level']==5){ echo 'selected=""';} ?>><?php echo capbac(5);?></option>
                          <option value="7" <?php if($rmn['level']==7){ echo 'selected=""';} ?>>CEO</option>
                        </select>
                        <!--div class="checkbox" style="margin-top: 8px;">
                        <label style="padding-left: 20px; line-height: 21px;">
                        <input name="level" type="checkbox" value="2" <?php if($rmn['level']==2){echo 'checked=""';}?> />
                        Kích hoạt tài khoản "Quản lý cấp cao"
                        </label>
                        </div-->
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php }?>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Ví rút:</label>
                    <div class="col-sm-8"><input class="form-control" type="number" name="virut" value="<?php  echo $rmn['virut']; ?>" required="" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Ví mua:</label>
                    <div class="col-sm-8"><input class="form-control" type="number" name="vimua" value="<?php  echo $rmn['vimua']; ?>" required="" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Số điện thoại:</label>
                    <div class="col-sm-8"><input class="form-control" type="number" name="phone" value="<?php  echo $rmn['phone']; ?>" required="" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Email:</label>
                    <div class="col-sm-8"><input class="form-control" type="email" name="email" value="<?php  echo $rmn['email']; ?>" required="" /></div>
                    <div class="clearfix"></div>
                </div>
                <?php if($rmn['avatar']==''){?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Avatar hiện tại:</label>
                    <div class="col-sm-8" style="line-height: 34px;">Chưa có ảnh</div>
                    <div class="clearfix"></div>
                </div>
                <?php }else{?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" style="line-height: 80px;">Avatar hiện tại:</label>
                    <div class="col-sm-8"><img src="upload/avatar/<?php echo $rmn['avatar']?>" onerror="this.src='images/unnamed.png'" height="80" /></div>
                    <div class="clearfix"></div>
                </div>    
                <?php }?>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Update ảnh:</label>
                    <div class="col-sm-8"><input class="form-control" style="padding: 0; width: 300px;" name="image" type="file" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Slogan cá nhân:</label>
                    <div class="col-sm-8"><input class="form-control" name="slogan" value="<?php  echo $rmn['slogan']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Địa chỉ:</label>
                    <div class="col-sm-8"><input class="form-control" type="text" name="address" value="<?php  echo $rmn['address']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Mật khẩu thành viên:</label>
                    <div class="col-sm-8"><input class="form-control" type="password" name="pass" value="" /><p style="font-size: 0.8em;">Nếu không thay đổi thì để trống</p></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><input class="btn btn-primary" type="submit" name="edit" value="SỬA THÀNH VIÊN" /></div>
                </div>
           
        </form>
    <?php }else{?>
        <!--div class="tit">Tạo thành viên</div>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php  echo $thongbao;  ?>
                <tr>
                    <th><span>*</span>Tên đầy đủ:</th><td><input class="form-control" name="fullname" required="" /></td>
                </tr>
                <tr>
                    <th>Chức danh:</th><td><input class="form-control" name="chucdanh" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Số điện thoại:</th><td><input class="form-control" type="number" name="phone" required="" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Email:</th><td><input class="form-control" type="email" name="email" required="" /></td>
                </tr>
                <tr>
                    <th><span>*</span> Ảnh đại diện:</th><td><input class="form-control" style="padding: 0; width: 300px;" name="image" required="" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>Chọn ảnh vuông (tốt nhất lấy ảnh đại diện facebook hoặc zalo)</td>
                </tr>
                <tr>
                    <th>Địa chỉ:</th><td><input class="form-control" type="text" name="address" /></td>
                </tr>
                <tr>
                    <th>Slogan cá nhân:</th><td><input class="form-control" name="slogan" value="" />
                    </td>
                </tr>
                <tr>
                    <th><span>*</span>Mật khẩu thành viên:</th><td><input class="form-control" type="password" name="pass" required="" /></td>
                </tr>
                <tr>
                    <th></th><td><input class="form-control" type="submit" name="cap1" value="TẠO THÀNH VIÊN" /></td>
                </tr>
            </table>
        </form-->
        <?php $timmn1="select * from dh_user where id>1 order by time desc";$qmenu1=@mysqli_query($con,$timmn1); ?>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Danh sách thành viên <span style="color: red;">(<?php echo @mysqli_num_rows($qmenu1);?>)</span></div>
        <div class="danhsach">
            <table  class="table table-striped" cellspacing="0" cellpadding="0">
                <tr>
                    <th></th><th>Thành viên</th><th>Thông tin</th><th>Quyền hạn</th>
                </tr>
                <?php  
                
                while($rmns=@mysqli_fetch_assoc($qmenu1)){ 
                    //tìm xem có downline không để còn cho xóa
                    $timco=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$rmns[id]"));
                    if($timco>0){
                        $xoaxoa='';
                    }else{
                        $xoaxoa=' - <a class="xoa" href="del.php?table=dh_user&del='.$rmns['id'].'" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\');">Xóa</a>';
                    }
                    ?>
                <tr>
                    <td><div style="width: 80px; height: 80px; background-image: url(<?php if($rmns['avatar']!=''){echo 'upload/avatar/'.$rmns['avatar'];}else{if($rmns['gioitinh']=='nu'){echo 'i/avatar_nu.png';}else{echo 'i/avatar_nam.png';}}?>); background-size: cover; background-position: center center;    border-radius: 50%;"></div></td>
                    <?php if($rmns['level']<2){?>
                    <td style="padding-top: 36px;font-weight: bold;color: #333;"><?php  echo $rmns['fullname']; ?>
                    <?php }else{?>
                    <td style="padding-top: 36px;font-weight: bold;color: #2196f3;"><?php  echo $rmns['fullname']; ?>    
                    <?php }
                    $j1=0;$j2=0;
                    if($rmns['docquyentinh']!=0){
                        $timtinh=@mysqli_fetch_assoc(@mysqli_query($con,"select * from tinh where id=$rmns[docquyentinh]"));
                        echo '<p>Độc quyền tại <b>'.$timtinh['loai'].' '.$timtinh['ten'].'</b></p>';
                        $j1=1;
                    }
                    if($rmns['docquyenhuyen']!=0){
                        $timhuyen=@mysqli_fetch_assoc(@mysqli_query($con,"select * from huyen where id=$rmns[docquyenhuyen]"));
                        echo '<p>Độc quyền tại <b>'.$timhuyen['loai'].' '.$timhuyen['ten'].'</b></p>';
                        //tim xem tinh dẫ có người độc quyền chưa
                        if(@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where docquyentinh=$rmns[tinh]"))>0){
                            $j2=1;
                        }else{
                            $j2=0;
                        }
                        
                    }
                    if($j1+$j2<2){
                        echo '<p style="font-weight: normal;padding-top: 10px;"><a style="color: red;font-style: italic;font-size: 0.9em;" href="/docquyen.php?user='.$rmns['phone'].'"><i class="fab fa-ups"></i> Kích hoạt độc quyền</a></p>';
                    }
                    ?>
                    </td>
                    <td style="font-size: 0.9em; text-align: left; line-height: 18px;">
                    <p>Loại tài khoản: <?php echo capbac($rmns['level']);?></p>
                    <p>Điện thoại: <?php echo $rmns['phone']?></p>
                    <p>Email: <?php echo $rmns['email']?></p>
                    <p>Tham gia: <?php echo retimefull($rmns['time'])?></p>
                    <p>Ví mua: <b style="color: #FF4242;"><?php echo number_format($rmns['vimua'],0,',','.')?><sup>đ</sup></b></p>
                    <p>Ví rút: <b style="color: #FF4242;"><?php echo number_format($rmns['virut'],0,',','.')?><sup>đ</sup></b></p>
                    </td>
                    <td><a class="sua" href="taouser.php?edit=<?php  echo $rmns['id']; ?>">Sửa</a> <?php echo $xoaxoa;?></td>
                </tr>
                <?php  } ?>
            </table>
        </div>
    
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