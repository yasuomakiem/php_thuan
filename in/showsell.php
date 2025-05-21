<?
        $nguonban=@mysql_query("select * from nguonban where daban=0 and idu=$u[id] order by time desc");
        if(@mysql_num_rows($nguonban)>0){
            ?>
            <p style="margin: 20px 0 20px;border-top: 1px solid #d6d7d6;padding-top: 11px;"><a type="button" href=""><i class="fas fa-paper-plane"></i> Đang bán</a> &nbsp; <a type="button" style="color: silver;"><i class="fas fa-user-lock"></i> Đã bán</a> <a type="button" href="m/nguon/?nguon=addsell" style="float: right;"><i class="fas fa-folder-plus"></i> Thêm</a></p>
            <?while($rnguon=@mysql_fetch_assoc($nguonban)){
                $soanh=0; for($v=1;$v<9;$v++){if($rnguon['anh'.$v]!=''){$soanh++;}}
            ?>
            <div class="boxme" id="boxme<?=$rnguon['id']?>" style="margin-bottom: 15px;">
                <div class="nguonban">
                    <h4 style="color: #009688;"><i class="fas fa-map-marker-alt"></i> <?=$rnguon['ten']?></h4>
                    <?
                    if($rnguon['dientich']>0 or $rnguon['huong']!='Chưa xác định' or $rnguon['giagoc']!=0 or $rnguon['giaban']!=0 or $rnguon['phisale']!=0){
                    ?>
                    <div class="ppp">
                        <?if($rnguon['dientich']>0){?><div class="pcon"><i class="fas fa-drafting-compass"></i> <?=$rnguon['dientich']?> m<sup>2</sup></div><?}?>
                        <?if($rnguon['huong']!='Chưa xác định'){?><div class="pcon"><i class="fas fa-street-view"></i> <?=$rnguon['huong']?></div><?}?>
                        <?if($rnguon['giagoc']!=0){?><div class="pcon"><i class="fas fa-user-lock"></i> <?if($rnguon['giagoc']>1000000000){echo round($rnguon['giagoc']/1000000000,3);echo' tỷ';}else{echo $rnguon['giagoc']/1000000;echo' triệu';}?></div><?}?>
                        <?if($rnguon['giaban']!=''){?><div class="pcon"><i class="fas fa-paper-plane"></i> <?echo $rnguon['giaban'];?></div><?}?>
                        <?if($rnguon['phisale']!=0){?><div class="pcon"><i class="fas fa-hand-holding-usd"></i> <?echo $rnguon['phisale']/1000000;echo' triệu';?></div><?}?>
                        <div class="clearfix"></div>
                    </div>
                    <?}
                    ?>
                    <div><?=str_replace("*manh*","<br />",str_replace("????","***",$rnguon['thongtin']))?></div>
                    <?
                    if($soanh>0){
                        if($soanh==1){
                            ?> 
                            <div class="anhnguon">
                                <div class="simg motanh"  style="background-image: url('upload/nguon/size600/<?=$rnguon['anh1']?>');"></div>
                            </div>
                            <?
                        }elseif($soanh==2){
                            ?>
                            <div class="anhnguon">
                                <div class="simg haianh_1"  style="background-image: url('upload/nguon/size400/<?=$rnguon['anh1']?>');"></div>
                                <div class="simg haianh_2"  style="background-image: url('upload/nguon/size400/<?=$rnguon['anh2']?>');"></div>
                                <div class="clearfix"></div>
                            </div>
                            <?
                        }elseif($soanh==3){
                            ?>
                            <div class="anhnguon">
                                <div class="simg baanh_1"  style="background-image: url('upload/nguon/size600/<?=$rnguon['anh1']?>');"></div>
                                <div class="simg baanh_2"  style="background-image: url('upload/nguon/size400/<?=$rnguon['anh2']?>');"></div>
                                <div class="simg baanh_3"  style="background-image: url('upload/nguon/size400/<?=$rnguon['anh3']?>');"></div>
                                <div class="clearfix"></div>
                            </div>
                            <?
                        }elseif($soanh>=4){
                            ?>
                            <div class="anhnguon">
                                <div class="simg bonanh_1"  style="background-image: url('upload/nguon/size600/<?=$rnguon['anh1']?>');"></div>
                                <div class="simg bonanh_2"  style="background-image: url('upload/nguon/size200/<?=$rnguon['anh2']?>');"></div>
                                <div class="simg bonanh_3"  style="background-image: url('upload/nguon/size200/<?=$rnguon['anh3']?>');"></div>
                                <div class="simg bonanh_4"  style="background-image: url('upload/nguon/size200/<?=$rnguon['anh4']?>');">
                                    <?if($soanh>4){?><div class="conganh">+ <?=$soanh-3;?></div><?}?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?
                        }
                    }
                    ?>
                    <div class="ttk">
                        <a type="button" class="btn btn-primary btn-xs" id="nutkhquantam<?=$rnguon['id']?>"><i class="fas fa-podcast"></i> KH Quan tâm</a><a type="button" id="nutsaleban<?=$rnguon['id']?>" class="btn btn-success btn-xs"><i class="fas fa-recycle"></i> Sale đang bán</a><a type="button" class="btn btn-warning btn-xs" style="margin-right: 0;background: #a91775;border-color: #7c0d55;"><i class="fab fa-telegram-plane"></i> Gửi nguồn</a>
                        <a type="button" class="btn btn-warning btn-xs" style="background: coral;" onclick="uptopnguonban(<?=$rnguon['id']?>)"><i class="fas fa-level-up-alt"></i> Up Top</a><a type="button" class="btn btn-info btn-xs"><i class="fas fa-search-location"></i> Khớp nguồn</a><a type="button"style="margin-right: 0;" class="btn btn-info btn-xs"><i class="fab fa-internet-explorer"></i> Tạo Web</a>
                        <a type="button" class="btn btn-warning btn-xs" href="/m/nguon/?nguon=editsell&id=<?=$rnguon['id']?>"><i class="fas fa-user-edit"></i> Chỉnh sửa</a><a type="button" onclick="dabannguon(<?=$rnguon['id']?>)" class="btn btn-danger btn-xs"><i class="fab fa-expeditedssl"></i> Đã bán</a><a type="button" class="btn btn-danger btn-xs" style="margin-right: 0;color: red !important;" onclick="xoanguon(<?=$rnguon['id']?>)"><i class="far fa-trash-alt"></i> Xóa</a>  
                    </div>
                    <div class="ttan">
                    <p class="text-center" id="hidequantam<?=$rnguon['id']?>" style="display: none;"><i style="cursor: pointer;" class="fas fa-chevron-up"></i></p>
                        <div class="khquantam" id="khquantam<?=$rnguon['id']?>">
                        <?
                        $timlai=@mysql_query("select * from khachhangquantam where idnguon=$rnguon[id] order by time desc");
                        if(@mysql_num_rows($timlai)>0){
                        ?>
                        <p class="titqt"><b>KH quan tâm</b> <a id="addkhachhangquantam" onclick="addkhachhangquantam(<?=$rnguon['id']?>)" type="button" class="btn btn-info btn-xs"><i class="far fa-edit"></i> Add thêm ngay</a></p>
                        <ul class="showqt_o">
                        <?
                        while($rtim=@mysql_fetch_assoc($timlai)){
                            $khach=$rtim['idkhach'];
                            $rkh=@mysql_fetch_assoc(@mysql_query("select * from khachhang where id=$khach"));
                            
                            ?>
                            <li>
                                <h4><?=$rkh['ten']?>
                                <?if($rkh['phone']!=''){?>
                                    &nbsp; <a style="font-size: 12px;" type="button" href="tel:<?=$rkh['phone']?>"><i class="fas fa-phone-volume"></i> <?=$rkh['phone']?></a>
                                <?}?>
                                
                                <a style="float: right;color: red;opacity: 0.6;cursor: pointer;" onclick="deletekhquantam(<?=$rtim['id']?>,<?=$rnguon['id']?>)" type="button"><i class="far fa-trash-alt"></i></a> 
                                <a style="float: right;color: #ff9800;margin-right: 15px;opacity: 0.6; cursor: pointer;" onclick="editkhquantam(<?=$rtim['id']?>)" type="button"><i class="far fa-edit"></i></a> 
                                </h4>
                                <p class="nut"> 
                                    <?if($rkh['uid']!=''){?>
                                    <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md nutu" href="fb://profile/<?=$rkh['uid']?>">Tường</a> 
                                    <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs nutu" onclick="location.href='https://www.facebook.com/<?=$rkh['uid']?>'">Tường</a> 
                                    <?}?>
                                    <?if($rkh['uid']!=''){?>
                                    <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md nutu" href="https://fb.com/msg/<?=$rkh['uid']?>">Messenger</a> 
                                    <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs nutu" href="https://www.facebook.com/messages/t/<?=$rkh['uid']?>">Messenger</a> 
                                    <?}?>
                                    <?if($rkh['phone']!=''){?><a type="button" class="btn btn-info btn-xs nutu" href="https://zalo.me/<?=$rkh['phone']?>">Zalo</a><?}?>
                                    
                                    <?if($rkh['phone']!=''){?>
                                    <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md nutu" href="sms:<?=$rkh['phone']?>">SMS</a>
                                    <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs nutu" onclick="alert('SĐT khách hàng là: <?=$rkh['phone']?>');">SMS</a>
                                    <?}?>
                                </p>
                                <?if($rtim['ghichu']!=''){?>
                                    <p style="font-size: 0.9em;"><?=$rtim['ghichu']?></p>
                                <?}?>
                                <?if($rtim['anh1']!=''){?>
                                    <div class="anhquantam" style="background-image: url(upload/quantam/size200/<?=$rtim['anh1']?>);"></div>
                                <?}?>
                                <?if($rtim['anh2']!=''){?>
                                    <div class="anhquantam" style="background-image: url(upload/quantam/size200/<?=$rtim['anh2']?>);"></div>
                                <?}?>
                                <?if($rtim['anh3']!=''){?>
                                    <div class="anhquantam" style="background-image: url(upload/quantam/size200/<?=$rtim['anh3']?>);"></div>
                                <?}?>
                                <?if($rtim['anh4']!=''){?>
                                    <div class="anhquantam" style="background-image: url(upload/quantam/size200/<?=$rtim['anh4']?>);"></div>
                                <?}?>
                                <div class="clearfix"></div>
                            </li>
                            <?
                        }
                        ?>
                        </ul>
                        <?
                        }else{
                        ?>
                            <p class="text-center"><img style="width: 60px;margin-top: 20px;" class="fa5" src="i/shooting-star.png"></p>
                            <p class="thongbaomo">Chưa có khách hàng nào quân tâm</p>
                            <p class="text-center"><a onclick="addkhachhangquantam(<?=$rnguon['id']?>)" type="button" class="btn btn-info btn-xs"><i class="far fa-edit"></i> Add thêm ngay</a></p>
                        <?}?>
                        </div>
                        <div class="saledangban" id="saledangban<?=$rnguon['id']?>">
                            <p class="text-center"><img style="width: 60px;margin-top: 20px;" class="fa5" src="i/khquantam.png"></p>
                            <p class="thongbaomo">Chưa có Sale nào nhận bán nguồn này</p>
                            <!--p class="text-center"><a href="" type="button" class="btn btn-info btn-xs"><i class="far fa-edit"></i> Add thêm ngay</a></p-->
                             
                        </div>
                    </div>
                    <script>
                    $("#nutkhquantam<?=$rnguon['id']?>").click(function(){
                        if( jQuery("#khquantam<?=$rnguon['id']?>").hasClass("nonhienthi")){
                            jQuery("#khquantam<?=$rnguon['id']?>").removeClass("nonhienthi");
                            $("#khquantam<?=$rnguon['id']?>").slideUp(500);
                            $("#hidequantam<?=$rnguon['id']?>").slideUp(500);
                        }else{
                            jQuery("#khquantam<?=$rnguon['id']?>").addClass("nonhienthi");
                            jQuery("#saledangban<?=$rnguon['id']?>").removeClass("nonhienthi");
                            $("#khquantam<?=$rnguon['id']?>").slideDown(500);
                            $("#saledangban<?=$rnguon['id']?>").slideUp(500);
                            $("#hidequantam<?=$rnguon['id']?>").show();
                        }
                        
                    });
                    $("#nutsaleban<?=$rnguon['id']?>").click(function(){
                        if( jQuery("#saledangban<?=$rnguon['id']?>").hasClass("nonhienthi")){
                            jQuery("#saledangban<?=$rnguon['id']?>").removeClass("nonhienthi");
                            $("#saledangban<?=$rnguon['id']?>").slideUp(500);
                        }else{
                            jQuery("#saledangban<?=$rnguon['id']?>").addClass("nonhienthi");
                            jQuery("#khquantam<?=$rnguon['id']?>").removeClass("nonhienthi");
                            $("#saledangban<?=$rnguon['id']?>").slideDown(500);
                            $("#khquantam<?=$rnguon['id']?>").slideUp(500);
                        }
                        
                    });
                    $("#hidequantam<?=$rnguon['id']?>").click(function(){
                        $("#khquantam<?=$rnguon['id']?>").slideUp(500);
                        $("#saledangban<?=$rnguon['id']?>").slideUp(500);
                        jQuery("#khquantam<?=$rnguon['id']?>").removeClass("nonhienthi");
                        jQuery("#saledangban<?=$rnguon['id']?>").removeClass("nonhienthi");
                        $("#hidequantam<?=$rnguon['id']?>").slideUp(500);
                    });
                    </script>
                </div>
                </div>
            <?}?>
            
            <?
        }else{
        ?>
        <div class="boxme">
        <p class="text-center"><img class="fa5" src="i/5fa.png" /></p>
        <p class="thongbaomo">Chưa có nguồn nào</p>
        <p class="text-center"><a href="m/nguon/?nguon=addsell" type="button" class="btn btn-info btn-xs"><i class="fas fa-plus"></i> Thêm mới</a></p>
        <hr />
        <h4>Tác dụng: Quản lý nguồn bán</h4>
        <div style="text-align: justify;">
        <p>Nguồn bán là những BĐS của bạn, của khách hàng ký gửi hoặc của Sale khác share cho bạn. Theo thời gian số lượng nguồn bán của bạn sẽ ngày càng nhiều để đáp ứng ngay được nhu cầu của khách hàng khi cần. Do đó bạn cần phải quản lý một cách khoa học, dễ dàng lọc, bổ sung thông tin, nắm bất tiến độ. Module quản lý nguồn bán có 1 số lợi thế sau:</p>
        <p>- Thống kê tất cả những nguồn bán bạn đang nắm trong tay một cách khoa học, có phân loại, dễ tìm kiếm theo nhu cầu</p>
        <p>- Gắn thêm khách hàng đang quan tâm vào mỗi nguồn để tiện chăm sóc và tư vấn.</p>
        <p>- Chia sẻ nguồn cho Team hoặc cho người khác 1 cách nhanh chóng</p>
        <p>- Đẩy thông tin nguồn lên chợ <b>Mua bán</b> để các Sale khác tìm hiểu và liên hệ khi có khách hàng phù hợp</p>
        <p>- Tự động gợi ý <b>Khớp nguồn</b> khi có Sale khác cập nhật <b>Nguồn mua</b> phù hợp với <b>Nguồn bán</b> của bạn.</p>
        </div>
        </div>
        
    <? 
        }
    ?>