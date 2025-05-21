<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tit='Thông báo hệ thống';

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
    <div class="col-md-9 col-xs-12 conleft">
        <?php 
        if(isset($_GET['list'])){
            ?>
            <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Quản lý thông báo <a style="float: right;" type="button"  class="btn btn-info btn-xs" href="/thongbao.php">Tạo mới</a></div>
            <?php
            $list=@mysqli_query($con,"select * from thongbao where loai='thongbaohethong' order by id asc limit 50");
            if(@mysqli_num_rows($list)==0){
                ?>
                <div class="text-center">
                <p style="color: silver; padding: 25px 10%;">Chưa có thông báo nào</p>
                <img src="images/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                
                </div>
                <?php 
            }else{$i=1;
                ?>
                
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                        <th>#</th><th>Tiêu đề</th><th>Đối tượng</th><th>Thời gian</th>
                    </tr>
                    <?php while($rlist=@mysqli_fetch_assoc($list)){
                        $doit=explode(",",$rlist['tepnhan']);
                        for($s=0;$s<count($doit);$s++){
                            if($tepm==''){
                                if($doit[$s]==-1){$tepm='Tất cả';}elseif($doit[$s]==7){$tepm='Thành viên cụ thể';}else{$tepm=capbac($doit[$s]);}
                            }else{
                                if($doit[$s]==-1){$tepm=$tepm.', '.'Tất cả';}elseif($doit[$s]==7){$tepm=$tepm.', '.'Thành viên cụ thể';}else{$tepm=$tepm.', '.capbac($doit[$s]);}
                            }
                        }
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                        <?php echo $rlist['tieude'];?>
                        </td>
                        <td><?php echo $tepm;?></td>
                        <td>
                        <?php echo retimefull($rlist['time']); ?>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </table>
                </div>
                <?php 
            }
        }else{
            if(isset($_POST['tao'])){
            // Lấy giá trị của tiêu đề
            $ten = isset($_POST['ten']) ? trim($_POST['ten']) : '';
        
            // Lấy giá trị của các checkbox (nếu có)
            $doituong = isset($_POST['doituong']) ? $_POST['doituong'] : [];
        
            // Kiểm tra và xử lý dữ liệu
            if (empty($ten)) {
                $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Tiêu đề là bắt buộc.</p>';
            }else{
        
            if (empty($doituong)) {
                $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Phải chọn ít nhất một đối tượng nhận.</p>';
            }else{
                $idnhan='';
                $tepnhan=implode(',',$doituong);
                for($i=0;$i<count($doituong);$i++){
                    $giatri=$doituong[$i];
                    if($giatri==-1){//tất cả
                        $uw=@mysqli_query($con,"select id from dh_user");
                        while($rw=@mysqli_fetch_assoc($uw)){
                            $idnhan=$idnhan.'*'.$rw['id'].'*';
                        }
                    }elseif($giatri==7){//thành viên cụ thể
                        $thanhvien=addslashes($_POST['thanhvien']);
                        $values = explode('*', $thanhvien);
                        // Lọc bỏ các giá trị trống
                        $values = array_filter($values);
                        
                        // Sử dụng mảng kết hợp để loại bỏ các giá trị trùng lặp và giữ thứ tự xuất hiện đầu tiên
                        $uniqueValues = array();
                        foreach ($values as $value) {
                            if (!in_array($value, $uniqueValues)) {
                                $uniqueValues[] = $value;
                            }
                        }
                        
                        // Kết hợp lại các giá trị thành chuỗi với dấu *
                        $result = '*' . implode('**', $uniqueValues) . '*';
                        
                        $idnhan=$idnhan.$result;
                    }else{//còn lại thì giá trị của doituong là level của user
                        $uw=@mysqli_query($con,"select id from dh_user where level=$giatri");
                        while($rw=@mysqli_fetch_assoc($uw)){
                            $idnhan=$idnhan.'*'.$rw['id'].'*';
                        }
                    }
                }
            if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
                    $anhdaidien=$_FILES['image']['name'];
                    $size = getimagesize($_FILES['image']['tmp_name']);
                    $rog=$size[0];$ca=$size[1];
                    $width_resize=100;
                    $height_resize=round($width_resize*$ca/$rog); 
                    $anhdaidien = preg_replace('/[^a-zA-Z0-9.]/','-',$anhdaidien);
                    $file='upload/thongbao/'.$anhdaidien;
                    resize_nhieu($width_resize,$height_resize,'image',$file);
                    }else{$anhdaidien='';}
                $anh=$anhdaidien;
                $noidung=addslashes($_POST['noidung']);
                $in=@mysqli_query($con,"insert into thongbao (tieude,anh,loai,tepnhan,idnhan,noidung,time)value(N'$ten','$anh','thongbaohethong','$tepnhan','$idnhan',N'$noidung',$time)");
                if($in){
                    $thongbao='<p class="active"><i class="fas fa-check"></i> Thao tác thành công! &nbsp; </p>';
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                
            }
            }
        }
        ?>
        <style>
        .chon{
            padding: 5px;
            cursor: pointer;
        }
        .chon .anhavt{
            width: 35px;
            height: 35px;
            background-size: contain;
            background-position: center;
            float: left;
            background-repeat: no-repeat;
            background-color: #FFC107;
            border-radius: 50%;
            margin-right: 8px;
        }
        .chon .ttttt{
            line-height: 35px;
        }
        span.app{
            padding: 4px 5px;
            background: aliceblue;
            margin-right: 5px;
            font-size: 11px;
            display: inline-block;
        }
        p.active{color: #4CAF50;}
        p.err{color: red;}
        </style>
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Quản lý thông báo  <a style="float: right;" type="button"  class="btn btn-info btn-xs" href="/thongbao.php?list">Danh sách</a></div>
        <form action="" role="form" method="post" enctype="multipart/form-data">
        <?php echo $thongbao?>
        <div class="form-group">
            <label>Tiêu đề</label>       
            <input type="text" class="form-control" name="ten" placeholder="Tên tiêu đề"/>        
        </div>
        <label>Đối tượng nhận:</label>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="-1"/> Tất cả thành viên
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="0"/> Thành viên chưa kích hoạt
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="1"/> Cộng tác viên
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="2"/> Nhà phân phối
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="3"/> Trưởng phòng kinh doanh
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="4"/> Giám đốc kinh doanh
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="5"/> Giám đốc kinh cương
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" value="6"/> CEO
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="doituong[]" id="checkbox7" value="7"/> Thành viên cụ thể
            </label>
        </div>
        <div class="form-group" id="thanhviencuthe" style="display: none;">
            <label>Gõ tên hoặc số điện thoại thành viên:</label>  
            <div style="margin-bottom: 10px;" id="textud"></div>     
            <input type="hidden" class="form-control" id="thanhvien" name="thanhvien"/>  
            
            <input type="text" class="form-control" id="sthanhvien" name="sthanhvien" placeholder="Gõ để tìm"/>  
            <div class="showtimuser" id="showtimuser"></div>      
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <label for="exampleInputFile">Ảnh đại diện</label>       
            <input id="anh" type="file" name="image" />       
        </div>
        
        <script>
            $(document).ready(function(){
                $('#checkbox7').change(function() {
                    if($(this).is(':checked')) {
                        $('#thanhviencuthe').show();
                    } else {
                        $('#thanhviencuthe').hide();
                    }
                });
                $('#sthanhvien').keyup(function() {
                    var search = $('#sthanhvien').val();
                    $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    search : search,
                                    typeform : "timuser"
                                },
                                success : function (result2){
                                    $('#showtimuser').html(result2);
                                }
                    });
                });
                
            });
            function themidu(idu,ten){
                var incu=$('#thanhvien').val();
                $('#thanhvien').val(incu+'*'+idu+'*');
                $('#textud').append('<span class="app">'+ten+'</span>');
            }
        </script>
        <div class="form-group">
            <label>Nội dung</label>
            <textarea id="thongtin" name="noidung" style="width: 100%; height: 600px;"></textarea>
        </div>
        <script type="text/javascript">
                    CKEDITOR.replace( 'thongtin',
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
        <button type="submit" name="tao" id="tao" class="btn btn-primary">Tạo thông báo</button>
        </form>
        <script language="javascript">
        $(document).ready(function() {
                    $('#phoneuser').keyup(function(){
                        var phoneuser =$("#phoneuser").val();
                        if(phoneuser.length>9){
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    phoneuser : phoneuser,
                                    typeform : "kiemtrauser"
                                },
                                success : function (result2){
                                    arr = result2.split('*');
                                    if(Number(arr[0])==1){
                                        $('#nutnaptien').show();
                                    }else{
                                        $('#nutnaptien').hide();
                                        setTimeout(function(){
                                            $('#listchusohuu').html('');
                                        },7000);
                                    }
                                    $('#listchusohuu').html(arr[1]);
                                }
                        });
                        }
                    })
        setTimeout(function(){$('#thongbao').html('');},5000);
        });
        
        </script>
        <p>&nbsp;</p>
        <?php
            
            }
            ?>
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