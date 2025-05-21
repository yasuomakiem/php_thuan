<?
            echo '<div class="tit">Cài đặt Slogan-SĐT</div>';
            if(isset($_POST['taoslogan'])){
            $ten=addslashes($_POST['ten']);
            $t1=addslashes($_POST['t1']);
            $t2=addslashes($_POST['t2']);
                $in="update set_home set ten=N'$ten',t1=N'$t1',t2=N'$t2' where id=$re[id]";
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
                    <th>Slogan:</th><td><input required="" name="t1" value="<?php echo $re['t1']; ?>" /></td>
                </tr>
                <tr>
                    <th>Số điện thoại:</th><td><input required="" name="t2" value="<?php echo $re['t2']; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="taoslogan" value="CẬP NHẬT" /></td>
                </tr>
            </table>
        </form>