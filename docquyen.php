<?php  
session_start();
require_once('include/connect.php');
require_once('include/function.php');
require_once('include/session.php');
$tit='Quản lý độc quyền tỉnh, huyện';

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
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Quản lý độc quyền </div>
        <form id="form" style="margin-top: 30px;" action="" method="post"  enctype="multipart/form-data">
            <div id="thongbao"><?php  echo $thongbao; ?></div>
               <div class="form-group">
                    <label>SĐT thành viên <span style="color: red;">(*)</span></label>
                    <input required="" type="number" class="form-control" name="phoneuser" id="phoneuser" value="<?php if(isset($_GET['user'])){echo $_GET['user'];}?>" />
                </div>
                <div id="listchusohuu"></div>
        </form>
        <script language="javascript">
        $(document).ready(function() {
            $('#phoneuser').keyup(function(){
                checktt();
            });
            <?php if(isset($_GET['user'])){?>
                $("#phoneuser").val('<?php echo $_GET['user'];?>');
                checktt();
            <?php }?>
            function checktt(){
            var phoneuser =$("#phoneuser").val();
                        if(phoneuser.length>9){
                        $.ajax({
                                url : "ajax.php",
                                type : "post", 
                                dateType:"text", 
                                data : { 
                                    phoneuser : phoneuser,
                                    typeform : "kiemtrauser_docquyen"
                                },
                                success : function (result2){
                                    $('#listchusohuu').html(result2);
                                }
                        });
                        }
            }
        
        });
        
        </script>
        <p>&nbsp;</p>
        <div class="tit"><i class="fas fa-landmark"></i> Đã setup độc quyền</div>
        <?php
            $list=@mysqli_query($con,"select * from dh_user where docquyentinh>0 or docquyenhuyen>0 order by id asc");
            if(@mysqli_num_rows($list)==0){
                ?>
                <div class="text-center">
                <p style="color: silver; padding: 25px 10%;">Chưa có vùng độc quyền nào được thiết lập</p>
                <img src="images/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                
                </div>
                <?php 
            }else{$i=1;
                ?>
                
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                        <th>#</th><th>Thành viên</th><th>Độc quyền tỉnh</th><th>Độc quyền huyện</th>
                    </tr>
                    <?php while($rlist=@mysqli_fetch_assoc($list)){
                        
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                        <i class="fas fa-user"></i> <?php echo $rlist['fullname'];?>
                        </td>
                        <td>
                        <?php 
                        if($rlist['docquyentinh']>0){
                            $htinh=@mysqli_fetch_assoc(@mysqli_query($con,"select * from tinh where id=$rlist[docquyentinh]"));
                            $stvtinh=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where tinh=$rlist[tinh]"));
                            echo '<p><b>'.$htinh['loai'].' '.$htinh['ten'].'</b></p>';
                            echo '<p><i>('.$stvtinh.' thành viên)</i></p>';
                            ?>
                            <p><a style="color: red;" href="up.php?table=dh_user&loai=docquyentinh&up=0&id=<?php echo $rlist['id'];?>"><i class="fas fa-trash-alt"></i> Xóa độc quyền</a></p>
                            <?php
                        }
                        ?>
                        </td>
                        <td>
                        <?php 
                        if($rlist['docquyenhuyen']>0){
                            $hhuyen=@mysqli_fetch_assoc(@mysqli_query($con,"select * from huyen where id=$rlist[docquyenhuyen]"));
                            $stvhuyen=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where huyen=$rlist[huyen]"));
                            echo '<p><b>'.$hhuyen['loai'].' '.$hhuyen['ten'].'</b></p>';
                            echo '<p><i>('.$stvhuyen.' thành viên)</i></p>';
                            ?>
                            <p><a style="color: red;" href="up.php?table=dh_user&loai=docquyenhuyen&up=0&id=<?php echo $rlist['id'];?>"><i class="fas fa-trash-alt"></i> Xóa độc quyền</a></p>
                            <?php
                        }
                        ?>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </table>
                </div>
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