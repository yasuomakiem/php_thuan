<?
echo '<div class="tit">Cài đặt Văn bản - Ảnh</div>';
            if(isset($_POST['taotextanh'])){
            $ten=addslashes($_POST['ten']);
            $t1=addslashes($_POST['t1']);
            
                if($_FILES['image']['name']){
                $tenanh=$_FILES['image']['name'];
                $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                $tenanh=time().$tenanh;$tenanh=str_replace(".php","",$tenanh);
                move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
                $livu=$domain.'upload/banner/'.$re['t2'];unlink($livu);
                }else{$tenanh=$re['t2'];}
                // xong ảnh
                
                $color=addslashes($_POST['color']);
                if($_FILES['bg']['name']){
                $tenanhbg=$_FILES['bg']['name'];
                $tenanhbg = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanhbg);
                $tenanhbg=time().$tenanhbg;$tenanhbg=str_replace(".php","",$tenanhbg);
                move_uploaded_file($_FILES['bg']['tmp_name'],"upload/banner/".$tenanhbg);
                }else{$tenanhbg='';}
                $in="update set_home set ten=N'$ten',t1=N'$t1',t2=N'$tenanh',bg='$tenanhbg',color='$color' where id=$re[id]";
                $q=mysqli_query($con,$in);
                if($q){
                    echo '
                    <script language="JavaScript">
                    var my_timeout=setTimeout("gotosite();",0);
                    function gotosite()
                    {
                    window.location="set-home.php";
                    }
                    </script>
                    ';// cái này là chuyển trang bằng javascript
                    exit();
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update Banner thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
        ?>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th>Tên tab:</th><td><input required="" name="ten" value="<?php echo $re['ten']; ?>" /></td>
                </tr>
                <?IF($re['bg']!=''){?>
                <tr>
                    <th>Ảnh nền hiện tại:</th><td><img src="upload/banner/<?=$re['bg']?>" style="max-width: 400px; max-height: 100px;" />
                    <p style="padding: 5px 0;">
                    <a class="xoa" href="/set-home.php?edit=<?=$edit?>&delbg=<?=$re['bg']?>">Loại bỏ ảnh này</a>
                    </p>
                    </td>
                </tr>
                <?}?>
                <tr>
                    <th>Chọn ảnh nền:</th><td><input style="padding: 0; width: 300px;" name="bg" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>Kích thước của ảnh nền khuyến nghị Rộng nhất: 1350px - Cao: 300px.</td>
                </tr>
                <tr>
                    <th>Chọn màu nền:</th><td><input type="color" name="color" value="<?if($re['color']==''){echo '#ffffff';}else{echo $re['color'];}?>" /></td>
                </tr>
                <tr>
                    <th></th><td>Nếu có ảnh nền thì màu nền sẽ không có tác dụng nữa.</td>
                </tr>                
                <?IF($re['t2']!=''){?>
                <tr>
                    <th>Ảnh hiện tại:</th><td><img src="upload/banner/<?=$re['t2']?>" style="max-width: 100%; max-height: 100px;" /></td>
                </tr>
                <?}?>
                <tr>
                    <th>Ảnh:</th><td><input <?if($re['t2']==''){echo 'required=""';}?>  style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th>Văn bản:</th><td><textarea id="thongtin" name="t1"><?=$re['t1']?> </textarea></td>
                </tr>
                <script type="text/javascript">
                    CKEDITOR.replace( 'thongtin',
                    {
                    //toolbar: 'toolbar',
                    filebrowserBrowseUrl : 'ckfinder/ckfinder.htm',
                    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.htm?Type=Images',
                    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.htm?Type=Flash',
                    filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                    });
                    </script>
                <tr>
                    <th></th><td><input type="submit" name="taotextanh" value="CẬP NHẬT" /></td>
                </tr>
            </table>
        </form>