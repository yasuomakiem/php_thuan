<?php 
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tim="select * from dh_user where id=1";$q=@mysqli_query($con,$tim);$r=@mysqli_fetch_assoc($q);
if(isset($_POST['capnhat'])){

    $phone=addslashes($_POST['phone']);
    $email=addslashes($_POST['email']);
    $zalo=addslashes($_POST['zalo']);
    $facebook=addslashes($_POST['facebook']);
    $viettatteam=addslashes($_POST['viettatteam']);
    $youtube=addslashes($_POST['youtube']);
    $footer1=addslashes($_POST['footer1']);
    $kichhoatctv=intval($_POST['kichhoatctv']);
    $phantramctv=intval($_POST['phantramctv']);
    $kichhoatnpp=intval($_POST['kichhoatnpp']);
    $phantramnpp=intval($_POST['phantramnpp']);
    $phantramf1=intval($_POST['phantramf1']);
    $phantramf2=intval($_POST['phantramf2']);
    $tai=intval($_POST['tai']);
    $ruttoithieu=intval($_POST['ruttoithieu']);
    $dkhuongdan = intval($_POST['dkhuongdan']);
    $dkquanlycapcao = intval($_POST['dkquanlycapcao']);
    $phantramdocquyenhuyen=intval($_POST['phantramdocquyenhuyen']);
    if($_FILES['image']['name']){
        $tenanh=$_FILES['image']['name'];
        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
        $tenanh=time().$tenanh;
        move_uploaded_file($_FILES['image']['tmp_name'],"upload/favicon/".$tenanh);
     }else{$tenanh=$r['favicon'];}
     if($_FILES['imgmxh']['name']){
        $imgmxh=$_FILES['imgmxh']['name'];
        $imgmxh = preg_replace('/[^a-zA-Z0-9.]/','-',$imgmxh);
        $imgmxh=time().$imgmxh;
        move_uploaded_file($_FILES['imgmxh']['tmp_name'],"upload/favicon/".$imgmxh);
     }else{$imgmxh=$r['imgmxh'];}
     if($_FILES['logo']['name']){
        $logo=$_FILES['logo']['name'];
        $logo = preg_replace('/[^a-zA-Z0-9.]/','-',$logo);
        $logo=time().$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'],"upload/favicon/".$logo);
     }else{$logo=$r['logo'];}
    $tit=addslashes($_POST['tit']);
    $footer=addslashes($_POST['footer']);
    $des=strip_tags($_POST['des'],'');
    $pt_ruttien=intval($_POST['pt_ruttien']);
    $up="update dh_user set favicon='$tenanh',kichhoatctv=$kichhoatctv,phantramctv=$phantramctv,kichhoatnpp=$kichhoatnpp,phantramnpp=$phantramnpp,phantramf1=$phantramf1,phantramf2=$phantramf2,tai=$tai,ruttoithieu=$ruttoithieu,footer1=N'$footer1',dkhuongdan=$dkhuongdan,dkquanlycapcao=$dkquanlycapcao,pt_ruttien=$pt_ruttien,viettatteam=N'$viettatteam',email='$email',zalo=N'$zalo',youtube=N'$youtube',facebook=N'$facebook',logo='$logo'
    ,footer=N'$footer',tit=N'$tit',des=N'$des',phantramdocquyenhuyen=$phantramdocquyenhuyen where id=1";
    $qup=@mysqli_query($con,$up);
    if($qup){
        $tim2="select * from dh_user where id=1";$q=@mysqli_query($con,$tim2);$r=@mysqli_fetch_assoc($q);
        $thongbao="<div class='col-sm-4'></div><div class='col-sm-8' style='color:blue'>Cập nhật thông tin thành công!</div>";
    }else{$thongbao="<div class='col-sm-4'></div><div class='col-sm-8' style='color:red'>Có lỗi, Cập nhật thông tin chưa thành công, vui lòng làm lại!</div>";}
    
}
$tit="Cài đặt hệ thống";
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
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Cài đặt hệ thống</div>
        <form id="form" class="formdoi" action="" method="post" enctype="multipart/form-data">
            
            <?php  echo $thongbao; ?>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Viết tắt hệ thống:</label>
                    <div class="col-sm-8"><input class="form-control" name="viettatteam" value="<?php echo $r['viettatteam']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Email:</label>
                    <div class="col-sm-8"><input class="form-control" name="email" value="<?php echo $r['email']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8" style="font-size: 0.9em;">Email dùng để đăng nhập hệ thống, nếu đổi email mới, lần sau hãy đăng nhập bằng email này.</div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm phí dịch vụ khi thành viên rút tiền:</label>
                    <div class="col-sm-8"><input type="number" class="form-control" name="pt_ruttien" value="<?php echo $r['pt_ruttien']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Favicon:</label>
                    <div class="col-sm-8"><img src="upload/favicon/<?=$r['favicon']?>" height="30px" style="float: left;" />
                    <input class="form-control" style="padding: 0; width: 260px; margin-left: 10px;" name="image" type="file" />
                    <p class="help-block">Để hiển thị đầu Tab trình duyệt. Kích thước 40x40</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Logo hiện tại:</label>
                    <div class="col-sm-8"><img src="upload/favicon/<?=$r['logo']?>" height="100px" style="background: url(/images/bgdoinhompc2.jpg) top center;background-size: 1800px;" />
                    <p class="help-block">Logo web khi vào trang đăng ký, đăng nhập. Kích thước 300x100</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Đổi logo khác:</label>
                    <div class="col-sm-8">
                    <input class="form-control" style="" name="logo" type="file" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Ảnh MXH hiện tại:</label>
                    <div class="col-sm-8"><img src="upload/favicon/<?=$r['imgmxh']?>" height="130px" />
                    <p class="help-block">Để hiển thị khi gửi link qua Mạng xã hội. Kích thước 1200x630</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Ảnh mạng xã hội:</label>
                    <div class="col-sm-8">
                    <input class="form-control" style="" name="imgmxh" type="file" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><b style="color: #0080FF;">Cài đặt thành viên</b></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kích hoạt CTV: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="kichhoatctv" value="<?php echo $r['kichhoatctv']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Số tiền tối thiểu để kích hoạt đơn hàng Cộng tác viên</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm CTV: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phantramctv" value="<?php echo $r['phantramctv']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Phần trăm chiết khấu khi Cộng tác viên mua hàng</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kích hoạt NPP: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="kichhoatnpp" value="<?php echo $r['kichhoatnpp']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Số tiền tối thiểu để kích hoạt đơn hàng Nhà phân phối</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm NPP: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phantramnpp" value="<?php echo $r['phantramnpp']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Phần trăm chiết khấu khi Nhà phân phối mua hàng</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm F1: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phantramf1" value="<?php echo $r['phantramf1']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Phần trăm hưởng khi có 1 F1 nạp tiền</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm F2: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phantramf2" value="<?php echo $r['phantramf2']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Phần trăm hưởng khi có 1 F2 nạp tiền</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phần trăm độc quyền huyện: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phantramdocquyenhuyen" value="<?php echo $r['phantramdocquyenhuyen']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Phần trăm hưởng khi có 1 thành viên nạp tiền mà họ thuộc huyện độc quyền</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tái nạp: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="tai" value="<?php echo $r['tai']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Số tiền phải nạp tối thiểu hàng tháng đối với các chức danh trên Nhà phân phối và độc quyền huyện</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Rút tối thiểu: </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="ruttoithieu" value="<?php echo $r['ruttoithieu']; ?>" />
                        <p class="help-block"><sup>(*)</sup>Số tiền tối thiểu cho 1 lệnh rút tiền</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--div class="form-group">
                    <label class="col-sm-4 control-label">Loại điều kiện:</label>
                    <div class="col-sm-8">
                        <select name="loaidieukien" class="form-control">
                          <option value="0" <?php if($r['loaidieukien']==0){echo "selected=''";}?>>Tính theo tổng số đơn user đạt được</option>
                          <option value="1" <?php if($r['loaidieukien']==1){echo "selected=''";}?>>Tính theo số đơn user đạt được trong 1 ngày</option>
                        </select>
                        <p class="help-block">- Khi user đạt được số đơn theo yêu cầu (*) phía trên theo ngày (lần đầu) hay tổng số đơn.</p>
                        <p class="help-block">- VD: Khi để điều kiện thành viên chính thức là 3, loại điều kiện là trong 1 ngày. Thì khi thành viên đó đạt được 3 đơn trong 1 ngày lần đầu tiên lúc đó tài khoản sẽ xác nhận thành viên chính thức. Còn khi đặt điều kiện là tổng số đơn thì cứ khi nào User đạt 3 đơn không cần biết là bao nhiêu ngày sẽ được kích hoạt thành viên chính thức.</p>
                        <p class="help-block">- Khi để điều kiện Thành viên chính thức là 0. Thì coi như không có điều kiện, đăng ký là trở thành Thành viên chính thức luôn</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Điều kiện HH hướng dẫn:</label>
                    <div class="col-sm-8">
                        <select name="dkhuongdan" class="form-control">
                          <option value="0" <?php if($r['dkhuongdan']==0){echo "selected=''";}?>>Không áp điều kiện</option>
                          <option value="1" <?php if($r['dkhuongdan']==1){echo "selected=''";}?>>Người mình hướng dẫn phải là Thành viên chính thức</option>
                        </select>
                        <p class="help-block">Nếu áp điều kiện nghĩa là: Người mà mình hướng dẫn ra phải là Thành viên chính thức thì mình mới được nhận thưởng hoa hồng hướng dẫn</p>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kích hoạt Quản lý cấp cao:</label>
                    <div class="col-sm-8"><input class="form-control" name="dkquanlycapcao" value="<?php echo $r['dkquanlycapcao']; ?>" />
                    <p class="help-block">Là số Thành viên chính thức trong hệ thống cần đạt được thì mới được nhận Hoa hồng quản lý</p>
                    </div>
                    
                    <div class="clearfix"></div>
                </div-->
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Chưa kích hoạt:</label>
                    <div class="col-sm-8"><textarea class="form-control" cols="3" id="footer1" name="footer1"><?php echo $r['footer1']; ?> </textarea>
                    <p class="help-block">Nếu thành viên đăng ký tài khoản, chưa nạp tiền để kích hoạt tài khoản thì sẽ hiển thị thông tin này</p>
                    </div>
                    <div class="clearfix"></div>
                    <script type="text/javascript">
                    CKEDITOR.replace( 'footer1',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
                        
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><b style="color: #0080FF;">Các nhóm hỗ trợ</b></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Nhóm Facebook:</label>
                    <div class="col-sm-8"><input class="form-control" name="facebook" value="<?php echo $r['facebook']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Nhóm Zalo:</label>
                    <div class="col-sm-8"><input class="form-control" name="zalo" value="<?php echo $r['zalo']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Kênh Youtube:</label>
                    <div class="col-sm-8"><input class="form-control" name="youtube" value="<?php echo $r['youtube']; ?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><b style="color: #0080FF;">Cài đặt SEO trang chủ</b></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Tên website:</label>
                    <div class="col-sm-8"><input class="form-control" required="" name="tit" value="<?php echo $r['tit']; ?>" /> 
                    
                    <i>Thẻ Title trang chủ</i></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Mô tả website:</label>
                    <div class="col-sm-8"><textarea class="form-control" cols="3" name="des"><?php echo $r['des']; ?> </textarea> <i>Thẻ Meta Description trang chủ</i></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span>*</span>Chân trang:</label>
                    <div class="col-sm-8"><textarea class="form-control" cols="3" id="footer" name="footer"><?php echo $r['footer']; ?> </textarea>
                    </div>
                    <div class="clearfix"></div>
                    <script type="text/javascript">
                    CKEDITOR.replace( 'footer',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
                        
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8"><input class="btn btn-primary" type="submit" name="capnhat" value="CẬP NHẬT THÔNG TIN" /></div>
                    <div class="clearfix"></div>
                </div>
        </form>
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