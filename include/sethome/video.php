<?
            echo '<div class="tit">Cài đặt Video - Văn bản</div>';
            if(isset($_POST['taovideotext'])){
            $ten=addslashes($_POST['ten']);
            $t1=addslashes($_POST['t1']);
            $t2=addslashes($_POST['t2']);
            $t3=addslashes($_POST['t3']);
            $t4=addslashes($_POST['t4']);
            $t5=addslashes($_POST['t5']);
            $t6=addslashes($_POST['t6']);
            $t7=addslashes($_POST['t7']);
            $t8=addslashes($_POST['t8']);
            $t9=addslashes($_POST['t9']);
            $t10=addslashes($_POST['t10']);
            $t11=addslashes($_POST['t11']);
            $t12=addslashes($_POST['t12']);
                        $color=addslashes($_POST['color']);
                        if($_FILES['bg']['name']){
                        $tenanhbg=$_FILES['bg']['name'];
                        $tenanhbg = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanhbg);
                        $tenanhbg=time().$tenanhbg;$tenanhbg=str_replace(".php","",$tenanhbg);
                        move_uploaded_file($_FILES['bg']['tmp_name'],"upload/banner/".$tenanhbg);
                        }else{$tenanhbg='';}
                $in="update set_home set ten=N'$ten',t1=N'$t1',t2=N'$t2',t3=N'$t3',t4=N'$t4',t5=N'$t5',t6=N'$t6',t7=N'$t7',t8=N'$t8',t9=N'$t9',t10=N'$t10',t11=N'$t11',t12=N'$t12',bg='$tenanhbg',color='$color' where id=$re[id]";
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
                    $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Update thành công.</div>';
                }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, vui lòng làm lại.</div>';}
                
        }
        ?>
        <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th>Tên tab:</th><td><input required="" name="ten" value="<?php echo $re['ten']; ?>" /> <span style="color: red;">(*)</span></td>
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
                <tr>
                    <th>Tên video (1):</th><td><input required="" name="t1" value="<?php echo $re['t1']; ?>" /> <span style="color: red;">(*)</span></td>
                </tr>
                <tr>
                    <th>Link video Youtube (1):</th><td><input required="" name="t2" value="<?php echo $re['t2']; ?>" /> <span style="color: red;">(*)</span></td>
                </tr>
                <tr>
                    <th>Chú thích (1):</th><td><input required="" name="t3" value="<?php echo $re['t3']; ?>" /> <span style="color: red;">(*)</span></td>
                </tr>
                
                <tr>
                    <th>Tên video (2):</th><td><input  name="t4" value="<?php echo $re['t4']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link video Youtube (2):</th><td><input  name="t5" value="<?php echo $re['t5']; ?>" /></td>
                </tr>
                <tr>
                    <th>Chú thích (2):</th><td><input name="t6" value="<?php echo $re['t6']; ?>" /></td>
                </tr>
                
                <tr>
                    <th>Tên video (3):</th><td><input  name="t7" value="<?php echo $re['t7']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link video Youtube (3):</th><td><input  name="t8" value="<?php echo $re['t8']; ?>" /></td>
                </tr>
                <tr>
                    <th>Chú thích (3):</th><td><input  name="t9" value="<?php echo $re['t9']; ?>" /></td>
                </tr>
                
                <tr>
                    <th>Tên video (4):</th><td><input  name="t10" value="<?php echo $re['t10']; ?>" /></td>
                </tr>
                <tr>
                    <th>Link video Youtube (4):</th><td><input  name="t11" value="<?php echo $re['t11']; ?>" /></td>
                </tr>
                <tr>
                    <th>Chú thích (4):</th><td><input name="t12" value="<?php echo $re['t12']; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="taovideotext" value="CẬP NHẬT" /></td>
                </tr>
            </table>
        </form>