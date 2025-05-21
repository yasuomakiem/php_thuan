
        <div class="bigmem deal">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Giao dịch <a style="float: right;font-size: 14px;padding-right: 20px;color: #ff9700;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/804953.png" />
                <div class="dealright">
                <p style="margin-bottom: 5px;"><b><?=ucfirst($u['usernamenot'])?></b></p>
                <p>ID: #<?=$u['id']?> - Level: <?=$u['levelnot']?>/8 </p>
                </div>
                <div class="clearfix"></div>
                <hr style="margin-top: 10px;" />
                
                <?
                $cuoc=@mysql_query("select * from cuoc where idu=$u[id] and trangthai=0 order by time desc");
                if(@mysql_num_rows($cuoc)>0){
                while($rcuoc=@mysql_fetch_assoc($cuoc)){
                    $trandau=@mysql_fetch_assoc(@mysql_query("select * from trandau where id=$rcuoc[tran]"));
                    $giai=@mysql_fetch_assoc(@mysql_query("select * from giadau where id=$trandau[giai]"));
                    $doi1=@mysql_fetch_assoc(@mysql_query("select * from doibong where id=$trandau[doi1]"));
                    $doi2=@mysql_fetch_assoc(@mysql_query("select * from doibong where id=$trandau[doi2]"));
                ?>
                <div class="boxitem">
                    <div class="one">
                        <img class="olds" src="<?=$doi1['logo']?>" />
                        <p><?=$doi1['ten']?></p>
                    </div>
                    <div class="two">
                        <h4><i class="far fa-futbol"></i> <?=$giai['ten']?></h4>
                        <p class="timego"><span><?if($trandau['gio']<10){echo '0'.$trandau['gio'];}else{echo $trandau['gio'];}?>:<?if($trandau['phut']<10){echo '0'.$trandau['phut'];}else{echo $trandau['phut'];}?></span> - <?if($trandau['ngay']<10){echo '0'.$trandau['ngay'];}else{echo $trandau['ngay'];}?>/<?if($trandau['thang']<10){echo '0'.$trandau['thang'];}else{echo $trandau['thang'];}?>/<?=$trandau['nam']?></p>
                    </div>
                    <div class="three">
                        <img class="olds" src="<?=$doi2['logo']?>" />
                        <p><?=$doi2['ten']?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="scorenow">
                        <div class="one">
                            <p class="tss" id="team1_<?=$trandau['id']?>"><?if($trandau['trangthai']==0){echo '-';}elseif($trandau['trangthai']==1){echo $trandau['ketqua1'];}?></p>
                        </div>
                        <div class="two">
                            <h5 class="acnow"><?if($trandau['trangthai']==0){echo 'Sắp diễn ra';}elseif($trandau['trangthai']==1){echo 'Đang diễn ra <img style="float: none;height: 20px;width: 20px;margin: 0;" src="i/Red_circle.gif"/>';}?></h5>
                            <p class="cssr">Tỉ số loại bỏ: <b><?=tiso($rcuoc['tiso'])?></b></p>
                        </div>
                        <div class="three">
                            <p class="tss" id="team2_<?=$trandau['id']?>"><?if($trandau['trangthai']==0){echo '-';}elseif($trandau['trangthai']==1){echo $trandau['ketqua2'];}?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?
                    if($trandau['trangthai']==1){?>
                        <script>$('body').ready(function(){
                            setInterval(function(){
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { 
                                    typeform : 'loadresult',
                                    score : <?=$trandau['id']?>
                                },
                                success : function (data1){
                                    var team=data1.split('-');
                                    $('#team1_<?=$trandau['id']?>').html(team[0]);
                                    $('#team2_<?=$trandau['id']?>').html(team[1]);
                                }
                                });
                                },3000);
                                })</script>
                    <?}?>
                    <div class="clearfix"></div>
                    <div class="leftf">
                        <h3>Tiền cược</h3>
                        <p><?=number_format($rcuoc['tiencuoc'],2,',','.')?>$</p>
                    </div>
                    <div class="rightf">
                        <h3>Lợi nhuận</h3>
                        <p><?=number_format($rcuoc['tienlai'],2,',','.')?>$</p>
                    </div>
                    <div class="clearfix"></div>
                    <p><i class="fas fa-angle-down"></i></p>
                    <div class="onshow">
                        <table>
                            <tr>
                                <td>
                                <?if($rcuoc['tienbaohiem']>0){?>
                                <p>Bảo hiểm: <?=number_format($rcuoc['tienbaohiem'],2,',','.')?>$</p>
                                <?}else{?>
                                <p>Thưởng quỹ ĐT: <?=number_format($rcuoc['quydautu'],2,',','.')?>$</p>    
                                <?}?>
                                </td>
                                <td>
                                <p>Phần trăm: <?=number_format($rcuoc['phantram'],2,',','.')?>%</p>
                                </td>
                            </tr>
                        </table>
                        <p>Thời gian: <?=retime($rcuoc['time'])?></p>
                        <?if($trandau['trangthai']==0){?><p><a type="button" class="btn btn-danger btn-xs" href="/m/deal/?del=<?=$rcuoc['id']?>">Hủy đơn</a></p><?}?>
                    </div>
                </div>
                <?    
                }
                }else{
                ?>
                
                    <p class="text-center">
                        <img class="fa5" style="float: none;" src="i/5fa.png" />
                    </p>
                    <p class="text-center">Hết giao dịch hiệu lực</p><p>&nbsp;</p>
                <?}?>
                <p>&nbsp;</p>
            </div>
        </div>
     