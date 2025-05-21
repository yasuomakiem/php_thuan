<?
            echo '<div class="tit">Cài đặt tab bài viết</div>';
            if(isset($_GET['delbg'])){
                $upd=@mysqli_query($con,"update set_home set bg='' where id=$edit and iduser=$iduser");
                unlink("/upload/banner/".addslashes($_GET['delbg']));
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
            }
                if(isset($_POST['setbaiviet'])){
                    $ten=addslashes($_POST['ten']);
                    $baiviet=$_POST['baiviet'];
                    
                    $chuoi=implode(',',$baiviet);
                        $color=addslashes($_POST['color']);
                        if($_FILES['bg']['name']){
                        $tenanhbg=$_FILES['bg']['name'];
                        $tenanhbg = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanhbg);
                        $tenanhbg=time().$tenanhbg;$tenanhbg=str_replace(".php","",$tenanhbg);
                        move_uploaded_file($_FILES['bg']['tmp_name'],"upload/banner/".$tenanhbg);
                        }else{$tenanhbg='';}
                        // xong ảnh
                        $in="update set_home set ten=N'$ten',t1='$chuoi',bg='$tenanhbg',color='$color' where id=$re[id]";
                        $q=mysqli_query($con,$in);
                        if($q){
                            echo '
                            <script language="JavaScript">
                            var my_timeout=setTimeout("gotosite();",0);
                            function gotosite()
                            {
                            window.location="/set-home.php";
                            }
                            </script>
                            ';// cái này là chuyển trang bằng javascript
                            exit();
                            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo Banner thành công.</div>';
                        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, thao tác chưa thành công, vui lòng làm lại.</div>';}
                        
                    
                }
            ?>
            <form id="form" action="" method="post"  enctype="multipart/form-data">
            <style>
            td a.xoa {
                background: url(admin/image/icon-del.png) no-repeat left;
                padding: 5px 0 5px 20px;
                color: red;
            }
            </style>
            <table>
            <?php echo $thongbao; ?>
                <tr>
                    <th><span>*</span>Tên tab:</th><td><input required="" name="ten" value="<?php echo $re['ten']; ?>" /></td>
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
                <?php 
                $tsp="select * from dh_baiviet where iduser=$iduser order by time desc";$qsp=mysqli_query($con,$tsp);$soluong=mysqli_num_rows($qsp);
                if($soluong==0){echo "<tr><td></td><td>Chưa có bài viết để chọn.</td></tr>";}
                $i=1;
                ?>
                <tr>
                    <td></td>
                    <td style="width: 450px;">
                    <div style="width: 100%;max-height: 600px;overflow-y: auto;">
                    <?while($rsp=mysqli_fetch_assoc($qsp)){ ?>
                    <img style="max-width: 80px; float: left; margin-top: 20px;" src="upload/baiviet/<?php echo str_replace(",","",$rsp['anh']); ?>" />
                    <div style="width: 310px; float: left; margin-top: 20px;margin-left: 15px;">
                    <p style="padding-bottom: 10px;"><b><?=$rsp['ten']?></b></p>
                    <?
                    $checked='';
                    $tac=explode(',',$re['t1']);
                    for($j=0;$j<count($tac);$j++){
                        if($tac[$j]==$rsp['id']){$checked='checked=""';}
                    }
                    ?>
                    <input style="width: auto;padding: 0;height: auto;" type="checkbox" name="baiviet[]" <?=$checked?> value="<?=$rsp['id']?>" /> Chọn bài viết này.
                    
                    </div>
                    <div style="clear: both;"></div>
                    <? $i++;} ?>
                    </div>
                    </td>
                    <td>
                    
                    </td>
                </tr>
                
                <tr>
                    <th></th><td><input type="submit" name="setbaiviet" value="CẬP NHẬT TAB" /></td>
                </tr>
            </table>
        </form>
        
        </div>
        