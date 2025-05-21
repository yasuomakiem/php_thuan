<style>
.ttan{}
.ttan .khquantam{
    display: none;
}
.ttan .saledangban{
    display: none;
}
p.titqt{
    padding: 10px 0;
    border-bottom: 1px dotted #999999;
    margin-bottom: 20px
}
p.titqt a{
    float: right;
    color: #02b199;
    background: none;
    border: 0;
    font-size: 11px;
}
ul.showqt_o{
    list-style: auto;
    font-size: 0.9em;
    padding-left: 20px;
}
ul.showqt_o li a.nutu{
    background: none;
    color: #444444;
    border-color: #ffb2a0;
}
ul.showqt_o li h4{
    font-size: 14px;
    padding-top: 5px;
    font-weight: bold;
}
ul.showqt_o li .anhquantam{
    width: 23.5%;
    float: left;
    height: 80px;
    background-position: center;
    background-size: cover;
    margin-right: 1.5%;
    border-radius: 10px;
}
.ttk a{
    background: none !important;
    color: #03a2b7 !important;
    border-color: #d9ebff !important;
}
.ttk a:hover{
    background: #e7e7e7 !important;
}
p.thongbaotrong{
                color: #f44336;
                text-align: center;
                margin-bottom: 20px;
            }
            .dhj{}
            .dhj a{
                padding: 8px;
                background: #f5f7fa;
                background: -webkit-linear-gradient(180deg, #f5f7fa, #c3cfe2);
                background: linear-gradient(180deg, #f5f7fa, #c3cfe2);
                color: #333;
            }
            .under{
                font-size: 16px;
                font-weight: 300;
                color: #494949;
                line-height: 25px;
                margin: 30px 0 20px;
                padding-bottom: 5px;
                position: relative;
            }
            .under:after{
                content: "";
                display: block;
                height: 2px;
                width: 100px;
                background: #2888da;
                position: absolute;
                left: 0;
                bottom: -1px;
            }
            .listtin{
                width: 100%;
                margin-bottom: 15px;
            }
            .listtin .anh{
                width: 25%;
                float: left;
                height: 60px;
                background-image: url('images/xacnhan.jpg');
                background-size: cover;
                background-position: center;
                margin-top: 5px;
                box-shadow: 2px 2px 7px grey;
                border-radius: 0 5px 0 5px;
            }
            .listtin .anh img{
                width: 100%;
                
            }
            .listtin .thongtin{
                width: 70%;
                float: right;
            }
            .listtin .thongtin h4{
                margin-top: 0;
                font-size: 13px;
                font-weight: 600;
            }
            .listtin .thongtin p.tenbai{
                font-weight: 600;color: #222;padding-top: 5px;
            }
.boxnaptien{
    width: 100%;
    padding: 20px 15px 5px 15px;
    position: relative;
    border: 1px solid #afaeae;
    border-radius: 8px;
    margin-bottom: 20px;
    margin-top: 35px;
}
.boxnaptien span{
    background: #f4f4f4;
    padding: 8px;
    position: absolute;
    top: -20px;
    left: 20px;
    font-weight: 600;
    color: red;
}
.titqt{
    font-size: 16px;
    padding-bottom: 10px;
    position: relative;
}
.titqt:after{
    content: "";
    display: block;
    height: 2px;
    width: 60px;
    background: #2888da;
    position: absolute;
    left: 0;
    bottom: -1px;
}
</style>
<div class="bigmem cpanel">
    <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="m/cpanel/" style="color: white;font-size: 15px;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
    <div class="contag dr" style="position: relative;">
        <img src="images/cs.png" />
        <div class="dealright">
            <p style="margin-bottom: 5px;"><b>Chính sách - Quy định</b></p>
            <?php if($u['id']==1){?>
            <p><a href="/m/chinhsach/?add=1">Tạo bài chính sách</a></p>
            <?php }else{?>
            <p>Hotline: <a style="color: red;" href="tel:0977069099">0977.069.099</a></p>
            <?php }?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if(isset($_GET['add'])){
        if(isset($_POST['tao'])){
                $ten=addslashes($_POST['ten']);
                $khongdau=chuyen_khong_dau_gach_ngang($ten).'-'.substr($time,0,2);
                $thutu=intval($_POST['thutu']);
                $noidung=addslashes($_POST['noidung']);
                if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
                    $anhdaidien=$_FILES['image']['name'];
                    $size = getimagesize($_FILES['image']['tmp_name']);
                    $rog=$size[0];$ca=$size[1];
                    $width_resize=300;
                    $height_resize=round($width_resize*$ca/$rog); 
                    $anhdaidien = preg_replace('/[^a-zA-Z0-9.]/','-',$anhdaidien);
                    $file='upload/baiviet/'.$anhdaidien;
                    resize_nhieu($width_resize,$height_resize,'image',$file);
                    $anh=$anhdaidien;
                $in=@mysqli_query($con,"insert into chinhsach (ten,khongdau,anh,thutu,noidung,time)value(N'$ten','$khongdau','$anh',$thutu,N'$noidung',$time)");
                if($in){
                    $thongbao='<p class="active"><i class="fas fa-check"></i> Thao tác thành công! &nbsp; <button type="button" class="btn btn-xs btn-success" onclick="location.href=\'/m/chinhsach/\'">Danh sách</button> &nbsp; <button type="button" class="btn btn-xs btn-success" onclick="location.href=\'m/huongdan/?add=1\'">Đăng tiếp</button></p>';
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                }else{$thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Thiếu ảnh đại diện!</p>';}
            }
        ?>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <link type="text/css" href="ckeditor/_samples/sample.css"/>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/chinhsach/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Tạo mới</a></h3>
    <form action="" role="form" method="post" enctype="multipart/form-data">
        <?php echo $thongbao?>
        <div class="form-group">
            <label>Tên bài viết</label>       
            <input type="text" class="form-control" name="ten" placeholder="Tên bài viết"/>        
        </div>
        <div class="form-group">
            <label>Thứ tự</label>       
            <input type="number" class="form-control" name="thutu" placeholder="Thứ tự hiển thị"/>        
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Ảnh đại diện</label>
            <input type="file" name="image" />
        </div>
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
        <button type="submit" name="tao" class="btn btn-primary">Xuất bản</button>
        </form>
    </div>
    <?php 
    }elseif(isset($_GET['edit'])){
        $edit=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chinhsach where id=$_GET[edit]"));
        if(isset($_POST['sua'])){
                $ten=addslashes($_POST['ten']);
                $khongdau=chuyen_khong_dau_gach_ngang($ten).'-'.substr($time,0,3);
                $thutu=intval($_POST['thutu']);
                $noidung=addslashes($_POST['noidung']);
                if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
                    $anhdaidien=$_FILES['image']['name'];
                    $size = getimagesize($_FILES['image']['tmp_name']);
                    $rog=$size[0];$ca=$size[1];
                    $width_resize=300;
                    $height_resize=round($width_resize*$ca/$rog); 
                    $anhdaidien = preg_replace('/[^a-zA-Z0-9.]/','-',$anhdaidien);
                    $file='upload/baiviet/'.$anhdaidien;
                    resize_nhieu($width_resize,$height_resize,'image',$file);
                    $anh=$anhdaidien;
                }else{$anh=$edit['anh'];}
                $in=@mysqli_query($con,"update chinhsach set ten=N'$ten',khongdau='$khongdau',anh='$anh',thutu=$thutu,noidung=N'$noidung' where id=$_GET[edit]");
                if($in){
                    $thongbao='<script>window.location="/m/chinhsach/";</script>';
                }else{
                    $thongbao='<p class="err"><i class="fas fa-exclamation-triangle"></i> Có lỗi, thao tác không thành công!</p>';
                }
                
            }
        ?>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <link type="text/css" href="ckeditor/_samples/sample.css"/>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/chinhsach/" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Sửa thông tin</a></h3>
    <form action="" role="form" method="post" enctype="multipart/form-data">
        <?php echo $thongbao?>
        <div class="form-group">
            <label>Tên bài viết</label>       
            <input type="text" class="form-control" name="ten" value="<?php echo $edit['ten']?>" placeholder="Tên bài viết">        
        </div>
        <div class="form-group">
            <label>Thứ tự</label>       
            <input type="number" class="form-control" name="thutu" value="<?php echo $edit['thutu']?>" placeholder="Thứ tự hiển thị">        
        </div>
        <div><img src="upload/baiviet/<?php echo $edit['anh']?>" width="60" /></div>
        <div class="form-group">
            <label for="exampleInputFile">Ảnh đại diện</label>       
            <input type="file" name="image" />       
                 
        </div>
        
        <div class="form-group">
            <label>Nội dung</label>
            <textarea id="thongtin" name="noidung" style="width: 100%; height: 600px;"><?php echo $edit['noidung']?></textarea>
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
        <button type="submit" name="sua" class="btn btn-primary">Sửa</button>
        </form>
    </div>
        <?php 
    }elseif(isset($_GET['m'])){
        $nd=@mysqli_fetch_assoc(@mysqli_query($con,"select * from chinhsach where khongdau='$_GET[m]'"));
    ?>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-circle-left"></i> Home </a>/ <a href="/m/chinhsach/" style="color: #333;">Chính sách - Quy định</a></h3>
    <h4 style="color: #0574cd;padding-top: 15px;"><?php echo $nd['ten']?></h4>
    <p style="font-style: italic; font-size: 0.9em;"><i class="far fa-clock"></i> <?php echo tra_lai_time($nd['time'])?></p>
    <hr />
    <div class="noidungtin">
        <?php echo $nd['noidung']?>
    </div>
    </div>
    <?php     
    }else{?>
    <div class="groupteam">
    <h3 class="titqt" style="font-size: 14px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-circle-left"></i> Home </a>/ Chính sách - Quy định</h3>
    <p style="font-size: 0.2em;">&nbsp;</p>
    <?php 
    $tin=@mysqli_query($con,"select * from chinhsach order by thutu asc");
            $sotin=@mysqli_num_rows($tin);
            if($sotin==0){
                echo '<br /><p class="thongbaotrong"><i class="fas fa-exclamation-triangle"></i> Chưa có bài viết nào được ghi nhận</p><br />';
            }else{
                while($rtin=@mysqli_fetch_assoc($tin)){
                    ?>
                    
                    <div class="listtin">
                    <a href="/m/chinhsach/?m=<?php echo $rtin['khongdau']?>">
                    <div class="anh" style="background-image: url(upload/baiviet/<?php echo $rtin['anh']?>);"></div>
                    </a>
                    <div class="thongtin">
                        <a href="/m/chinhsach/?m=<?php echo $rtin['khongdau']?>">
                        <p class="tenbai"><?php echo $rtin['ten']?></p>
                        </a>
                        <?php if($u['id']==1){?>
                        <p><a href="/m/chinhsach/?edit=<?php echo $rtin['id']?>">Sửa</a> --- <a href="del.php?table=chinhsach&del=<?php echo $rtin['id']?>" style="color: red;" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a></p>
                        <?php }?>
                        <p style="font-size: 0.9em;line-height: 20px;font-style: italic;"><i class="far fa-clock"></i> <?php echo retime($rtin['time'])?></p>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    
                    <?php 
                }
    }
    ?>
    </div>
    <?php }?>
    <div class="clearfix"></div>
</div>
     