
        <div class="tit"><a href="cpanel.php"><i class="fas fa-palette"></i> Cpanel Main</a> / Danh sách Webinar <a type="button" class="dieuh btn btn-primary btn-xs" href="webinar.php?type=create">Tạo mới</a></div>
        <?php 
            $list=@mysqli_query($con,"select * from camplive order by time desc");
            if(@mysqli_num_rows($list)==0){
                ?>
                <div class="text-center">
                <p style="color: silver; padding: 25px 10%;">Chưa có Webinar nào được tạo</p>
                <img src="images/rabbit.png" style="width: 120px; margin: 20px auto; display: block;" />
                <p style="padding: 25px 10%;">Hãy tạo ngay bây giờ để bắt đầu phễu Marketing của bạn</p>
                <p><a type="button" class="btn btn-info" href="webinar.php?type=create">Khởi tạo 1 Webinar <i class="fas fa-long-arrow-alt-right"></i></a></p> 
                </div>
                <?php 
            }else{$i=1;
                ?>
                <style>
                .leftclock{
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 1; /*số row muốn ẩn*/
                    overflow: hidden;
                    white-space: nowrap; width: calc(100% - 45px);width: -moz-calc(100% - 45px);width: -webkit-calc(100% - 45px); float: left;
                    height: 30px;
                }
                </style>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                        <th>Webinar</th><th>Block</th><th>Thông số</th><th style="text-align: center; width: 60px;"></th>
                    </tr>
                    <?php while($rlist=@mysqli_fetch_assoc($list)){
                        if($rlist['loai']==1){
                            $chedophat='Phát ngay khi click vào link';
                        }elseif($rlist['loai']==2){
                            $khung=$rlist['thoidiem1'];
                            if($rlist['thoidiem2']!=''){
                                $khung=$khung.', '.$rlist['thoidiem2'];
                            }
                            if($rlist['thoidiem3']!=''){
                                $khung=$khung.', '.$rlist['thoidiem3'];
                            }
                            if($rlist['thoidiem4']!=''){
                                $khung=$khung.', '.$rlist['thoidiem4'];
                            }
                            if($rlist['thoidiem5']!=''){
                                $khung=$khung.', '.$rlist['thoidiem5'];
                            }
                            $chedophat='Phát vào lúc <b>'.$khung.'</b> hàng ngày';
                        }elseif($rlist['loai']==3){
                            $chedophat='Phát 1 lần lúc <b>'.$rlist['thoidiem'].'</b>';
                        }
                        ?>
                    <tr style="border-bottom: 1px solid gainsboro;">
                        
                        <td>
                        <p><b><i class="fas fa-folder-open"></i> <?php echo $rlist['ten']?></b></p>
                        <img src="/upload/live/<?php echo $rlist['img']?>" style="width: 100px;margin-bottom: 15px;" />
                        </td>
                        <td style="max-width: 250px; line-height: 30px;">
                        <?php 
                        $bloc=@mysqli_query($con,"select * from block where idcamp=$rlist[id]");
                        while($rbl=@mysqli_fetch_assoc($bloc)){
                            if($rbl['block']==1){$tile='Comment ngẫu nhiên';}
                            if($rbl['block']==2){$tile='Comment cố định duy nhất';}
                            if($rbl['block']==3){$tile='Comment cố định nhiều';}
                            if($rbl['block']==4){$tile='Popup dạng text tùy biến';}
                            if($rbl['block']==5){$tile='Popup sản phẩm';}
                            if($rbl['block']==6){$tile='Popup form đăng ký';}
                        ?>
                        <div class="leftclock" title="<?php echo $tile; ?>"><i style="font-size: 0.6em;" class="far fa-snowflake"></i> <?php echo $rbl['ten']?> </div>
                        <div style="width: 40px; float: right; text-align: right; height: 30px;">
                        <span style="font-size: 0.8em;">
                        <a title="Sửa Block" style="color: #FF8000;" href="webinar.php?type=block&edit=<?php echo $rbl['id']?>&id=<?php echo $rbl['idcamp']?>"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;
                        <a title="Xóa Block" style="color: red;" href="del-block.php?id=<?php echo $rbl['id']?>"><i class="fas fa-trash-alt"></i></a>
                        </span>
                        </div>
                        <?php }?>
                        <a href="webinar.php?type=block&id=<?php echo $rlist['id']?>" type="button" class="btn btn-info btn-xs"><i class="fas fa-plus"></i> Thêm Block</a>
                        </td>
                        <td>
                        <p>Tiêu đề: <?php echo $rlist['tit']?></p>
                        <p>URL: <a href="<?php echo $domain_webinar?><?php echo $rlist['url']?>" target="_blank"><?php echo $domain_webinar?><?php echo $rlist['url']?></a></p>
                        <p>Video: <a href="https://vimeo.com/<?php echo $rlist['video']?>" target="_blank">https://vimeo.com/<?php echo $rlist['video']?></a></p>
                        <p>Diễn giả: <b><?php echo $rlist['speaker']?></b></p>
                        <p>Chế độ phát: <?php echo $chedophat?></p>
                        </td>
                        <td style="text-align: center;background: aliceblue;">
                        <br />
                        <p style="padding-bottom: 10px;"><a style="color: #FF8000;" href="webinar.php?type=edit&id=<?php echo $rlist['id']?>"><i class="fas fa-edit"></i></a></p>
                        <p style="padding-bottom: 10px;"><a style="color: red;" href="del-webinar.php?del=<?php echo $rlist['id'];?>"><i class="fas fa-trash-alt"></i></a></p>
                        <p><a style="color: #0080FF;" href=""><i class="fas fa-chart-bar"></i></a></p>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </table>
                </div>
                <?php 
            }
            
?>