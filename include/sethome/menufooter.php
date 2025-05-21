<?
if($edit==0){echo '<div class="tit">Cài đặt logo trên Menu</div>';}
            if(isset($_POST['taologo'])){
                if($_FILES['image']['name']){
                $tenanh=$_FILES['image']['name'];
                $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                $tenanh=time().$tenanh;$tenanh=str_replace(".php","",$tenanh);
                move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
                $livu=$domain.'upload/banner/'.$r['logo'];unlink($livu);
                }else{$tenanh=$r['logo'];}
                
                $in="update dh_user set logo=N'$tenanh' where id=$r[id]";
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
                <!--tr>
                    <th>Chọn màu nền:</th><td><input type="color" name="color" value="<?if($re['color']==''){echo '#ffffff';}else{echo $re['color'];}?>" /></td>
                </tr>
                <tr>
                    <th></th><td>Nếu có ảnh nền thì màu nền sẽ không có tác dụng nữa.</td>
                </tr-->                
                <?IF($r['logo']!=''){?>
                <tr>
                    <th>Logo hiện tại:</th><td><img src="upload/banner/<?=$r['logo']?>" style="max-width: 100%; max-height: 100px;" /></td>
                </tr>
                <?}?>
                <tr>
                    <th>Logo:</th><td><input <?if($r['logo']==''){echo 'required=""';}?>  style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>Kích thước của ảnh  Rộng: 150px - Cao: 50px.</td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="taologo" value="CẬP NHẬT" /></td>
                </tr>
            </table>
        </form>
        