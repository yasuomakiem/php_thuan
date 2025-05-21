<?
            echo '<div class="tit">Cài đặt Tab Slide</div>';
            if(isset($_GET['id'])){
                $idedit=intval($_GET['id']);
                $rsp=@mysqli_fetch_assoc(@mysqli_query($con,"select * from dh_banner where id=$idedit"));
                if(isset($_POST['suaanh'])){
                $ten=$_POST['ten'];
                $vitri=$_POST['vitri'];
                $target=$_POST['target'];
                $a=$_POST['a'];
                
                    if($_FILES['image']['name']){
                    $tenanh=$_FILES['image']['name'];
                    $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                    $tenanh=time().$tenanh;
                    $linkcu="upload/banner/".$rsp['anh'];
                    unlink($linkcu);
                    move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
                    }else{$tenanh=$rsp['anh'];}
                    // xong ảnh
                    $in="update dh_banner set ten=N'$ten',anh='$tenanh',a='$a',target='$target' where id=$idedit";
                    $q2=mysqli_query($con,$in);
                    if($q2){
                        echo '
                        <script language="JavaScript">
                        var my_timeout=setTimeout("gotosite();",0);
                        function gotosite()
                        {
                        window.location="/set-home.php?edit='.$edit.'";
                        }
                        </script>
                        ';// cái này là chuyển trang bằng javascript
                        exit();
                        $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo Banner thành công.</div>';
                    }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, sửa banner chưa thành công, vui lòng làm lại.</div>';}
                    
            }
                ?>
                <form id="form" action="" method="post"  enctype="multipart/form-data">
                <table>
                <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên banner:</th><td><input name="ten" value="<?php echo $rsp['ten']; ?>" /></td>
                </tr>
                <tr>
                    <th>Ảnh hiện tại:</th><td><img src="upload/banner/<?=$rsp['anh']?>" style="max-width: 100%; max-height: 100px;" /></td>
                </tr>
                <tr>
                    <th><span>*</span>Thay banner:</th><td><input style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                
                <tr>
                    <th>Liên kết tới:</th><td><input name="a" value="<?php echo $rsp['a']; ?>" /></td>
                </tr>
                
                <tr>
                    <th><span>*</span>Cách mở liên kết:</th><td>
                    <select name="target">
                        <option <?if($rsp['target']==''){echo 'selected="selected"';}?> value="">Mở trong tab hiện tại</option>
                        <option <?if($rsp['target']=='_blank'){echo 'selected="selected"';}?> value="_blank">Mở trong tab mới</option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="suaanh" value="SỬA BANNER" /></td>
                </tr>
            </table>
            </form>
                <?
            }else{
                if(isset($_POST['taobanner'])){
                    $ten=addslashes($_POST['ten']);
                    $vitri=2;
                    $target=$_POST['target'];
                    $a=addslashes($_POST['a']);
                
                        if($_FILES['image']['name']){
                        $tenanh=$_FILES['image']['name'];
                        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                        $tenanh=time().$tenanh;$tenanh=str_replace(".php","",$tenanh);
                        move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$tenanh);
                        // xong ảnh
                        $in="insert into dh_banner (ten,vitri,anh,a,target,time,iduser)value
                        (N'$ten','$vitri','$tenanh','$a','$target',$time,$iduser)";
                        $q=mysqli_query($con,$in);
                        if($q){
                            echo '
                            <script language="JavaScript">
                            var my_timeout=setTimeout("gotosite();",0);
                            function gotosite()
                            {
                            window.location="/set-home.php?edit='.$edit.'";
                            }
                            </script>
                            ';// cái này là chuyển trang bằng javascript
                            exit();
                            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo Banner thành công.</div>';
                        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, tạo banner chưa thành công, vui lòng làm lại.</div>';}
                        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Bạn chưa chọn ảnh, hoặc ảnh không đúng định dạng .jpg .png .gif .jpeg</div>';}
                        
                }
            ?>
            <form id="form" action="" method="post"  enctype="multipart/form-data">
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên banner:</th><td><input name="ten" value="<?php echo $ten; ?>" /></td>
                </tr>
                <input type="hidden" name="vitri" value="2" />
                <tr>
                    <th><span>*</span>Chọn banner:</th><td><input required="" style="padding: 0; width: 300px;" name="image" type="file" /></td>
                </tr>
                <tr>
                    <th></th><td>Kích thước của ảnh khuyến nghị Rộng nhất: 1350px - Cao: 300px.</td>
                </tr>
                <tr>
                    <th>Liên kết tới:</th><td><input name="a" value="<?php echo $a; ?>" /></td>
                </tr>
                <tr>
                    <th></th><td>- Mở trang bạn muốn liên kết tới, Copy đường link rồi dán vào đây.</td>
                </tr>
                <tr>
                    <th>Cách mở liên kết:</th><td>
                    <select name="target">
                        <option value="">Mở trong tab hiện tại</option>
                        <option value="_blank">Mở trong tab mới</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th></th><td><input type="submit" name="taobanner" value="TẠO BANNER" /></td>
                </tr>
            </table>
        </form>
        <?}?>
        </div>
        <div id="right">
        <div class="tit">Danh sách banner </div>
        <div class="danhsach">
            <table  cellspacing="0" cellpadding="0">
                <tr>
                    <th>TT</th><th>Banner</th><th>Thông số</th><th>Quyền hạn</th>
                </tr>
                <?php 
                $tsp="select * from dh_banner where vitri=2 and iduser=$iduser order by time desc";$qsp=mysqli_query($con,$tsp);$soluong=mysqli_num_rows($qsp);
                if($soluong==0){echo "<tr><td colspan='5'>Chưa có banner nào được sử dụng.</td></tr>";}
                $i=1;
                while($rsp=mysqli_fetch_assoc($qsp)){ 
                   $xoa="del-banner.php?del=".$rsp['id'];
                    ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td id="banner"><img style="max-width: 250px;" src="upload/banner/<?php echo $rsp['anh']; ?>" /></td>
                    <td  style="text-align: left;">
                    <?php 
                    if($rsp['a']==''){$a="Không liên kết";}else{$a=$rsp['a'];}
                    if($rsp['target']==''){$target="Trong tab hiện tại";}else{$target="Mở trong tab mới";}
                    echo "- Tên banner: ".$rsp['ten']."<br />";
                    echo "- Liên kết tới: ".$a."<br />";
                    echo "- Kiểu mở liên kết: ".$target."<br />";
                    ?>
                    </td>
                    <td>
                    <a class="sua" href="set-home.php?edit=<?=$edit?>&id=<?=$rsp['id']?>">Sửa</a> <br /><br />
                    <a class="xoa" href="<?php echo $xoa; ?>">Xóa</a>
                    </td>
                </tr>
                <?php 
                $i++;} ?>
            </table>
            </div>
        </div>
        