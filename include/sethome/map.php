<?
            echo '<div class="tit">Cài đặt Bản đồ</div>';
            if(isset($_POST['taomap'])){
            $ten=addslashes($_POST['ten']);
            $t1=addslashes($_POST['t1']);
            $t2=addslashes($_POST['t2']);
            $t3=addslashes($_POST['t3']);
            $t4=addslashes($_POST['t4']);
            $t5=addslashes($_POST['t5']);
            $t6=addslashes($_POST['t6']);
                $in="update set_home set ten=N'$ten',t1=N'$t1',t2=N'$t2',t3=N'$t3',t4=N'$t4',t5=N'$t5',t6=N'$t6' where id=$re[id]";
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
                    <th>Tên tab:</th><td><input required="" name="ten" value="<?php echo $re['ten']; ?>" /></td>
                </tr>
                
                <tr>
                    <th>Tọa độ:</th><td><input required="" name="t1" value="<?php echo $re['t1']; ?>" /></td>
                </tr>
                <tr>
                    <th>Công ty:</th><td><input required="" name="t2" value="<?php echo $re['t2']; ?>" /></td>
                </tr>
                <tr>
                    <th>Địa chỉ:</th><td><input required="" name="t3" value="<?php echo $re['t3']; ?>" /></td>
                </tr>
                <tr>
                    <th>SĐT:</th><td><input required="" name="t4" value="<?php echo $re['t4']; ?>" /></td>
                </tr>
                <tr>
                    <th>Email:</th><td><input required="" name="t5" value="<?php echo $re['t5']; ?>" /></td>
                </tr>
                <tr>
                    <th>Hiển thị:</th>
                    <td>
                    <select name="t6">
                        <option value="" <?if($re['t6']==''){echo 'selected=""';}?>>Full màn hình</option>
                        <option value="nofull" <?if($re['t6']=='nofull'){echo 'selected=""';}?>>Trong khuôn khổ trang</option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="taomap" value="CẬP NHẬT" /></td>
                </tr>
            </table>
            <h3>Cách lấy tọa độ:</h3>
        <p>Bước 1: truy cập vào trang bản đồ của google: <a target="_blank" href="https://www.google.com/maps/">Click</a></p>
        <p>Bước 2: Tìm tới vị trí cần tạo bản đồ. sau đó click đơn vào vị trí địa chỉ của bạn</p>
        <p></p><br /><br />
        <a href="admin/b1.png" target="_blank"><img src="admin/b1.png" style="width: 100%;" /></a>
        <p></p>
        <p></p>
        </form>