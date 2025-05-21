
        <div class="bigmem downline">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Đại lý <a style="float: right;font-size: 14px;padding-right: 20px;color: #ff9700;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/804953.png" />
                <div class="dealright">
                <p style="margin-bottom: 5px;"><b><?=ucfirst($u['usernamenot'])?></b></p>
                <p>ID: #<?=$u['id']?> - Level: <?=$u['levelnot']?>/8 </p>
                </div>
                <script src="j/clipboard/dist/clipboard.min.js"></script>
                <script>
                var clipboard = new ClipboardJS('.copyed');
            
                clipboard.on('success', function(e) {
                        console.info('Action:', e.action);
                        console.info('Text:', e.text);
                        console.info('Trigger:', e.trigger);
                    
                        e.clearSelection();
                        $('#alecopy').show('4000');
                        setTimeout(function(){$('#alecopy').html('');},5000);
                    });
            
                clipboard.on('error', function(e) {
                        console.error('Action:', e.action);
                        console.error('Trigger:', e.trigger);
                    });
                </script>
                </p>
                
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <hr style="margin-top: 10px;" />
                <p style="text-align: left;">Mã giới thiệu: <b><?=$u['id']?></b></p>
                <p style="text-align: left;">Link giới thiệu:</p>
                <input id="foo" class="form-control adress" style="" readonly="" value="https://notscore.com/?reff=<?=$u['id']?>"/> <button type="button" class="btn btn-default copyed buttoncopy" data-clipboard-target="#foo"><i class="far fa-copy"></i></button>
                <p class="an" id="alecopy"><span>Đã copy xong</span></p>
                <div class="clearfix"></div>
                <hr style="margin-top: 10px;" />
                <div class="fdownline">
                <p class="dtit">Downline tầng 1 <span><?if($u['levelnot']<4){echo 5;}elseif($u['levelnot']==4){echo 8;}elseif($u['levelnot']==5){echo 9;}elseif($u['levelnot']==6){echo 10;}elseif($u['levelnot']==7){echo 11;}elseif($u['levelnot']==8){echo 12;}?>%</span></p>
                <p class="userline" style="line-height: 15px;padding-bottom: 21px;"><b style="background: blueviolet;"><?=@mysql_num_rows(@mysql_query("select id from usernot where upline1=$u[id]"))?></b><span><strong><?=number_format($u['tiendownline1du'],2,',','.')?>$</strong></span><br /><span style="font-size: 0.83em;">Tổng: <?=number_format($u['tiendownline1tong'],2,',','.')?>$</span></p>
                <p class="dtit">Downline tầng 2 <span><?if($u['levelnot']<4){echo 3;}else{echo 5;}?>%</span></p>
                <p class="userline" style="line-height: 15px;padding-bottom: 21px;"><b><?=@mysql_num_rows(@mysql_query("select id from usernot where upline2=$u[id]"))?></b><span><strong><?=number_format($u['tiendownline2du'],2,',','.')?>$</strong></span><br /><span style="font-size: 0.83em;">Tổng: <?=number_format($u['tiendownline2tong'],2,',','.')?>$</span></p>
                <p class="dtit">Downline tầng 3 <span><?if($u['levelnot']<4){echo 1;}else{echo 3;}?>%</span></p>
                <p class="userline" style="line-height: 15px;padding-bottom: 21px;"><b style="background: #00e89a;"><?=@mysql_num_rows(@mysql_query("select id from usernot where upline3=$u[id]"))?></b><span><strong><?=number_format($u['tiendownline3du'],2,',','.')?>$</strong></span><br /><span style="font-size: 0.83em;">Tổng: <?=number_format($u['tiendownline3tong'],2,',','.')?>$</span></p>
                </div>
                <p style="font-size: 0.7em;">Hoa hồng được rút về tài khoản chính khi đủ 50$</p>
                <p><button type="button" class="btn btn-success" id="dwithdraw"><i class="fas fa-sign-out-alt"></i> Nhận hoa hồng</button></p>
                <div id="vwithdraw"></div>
                <script>
                $('body').ready(function(){
                    $('#dwithdraw').click(function(){
                        var wvalue=<?=($u['tiendownline1du']+$u['tiendownline2du']+$u['tiendownline2du'])?>;
                        $.ajax({
                                url : "./ajax.php", 
                                type : "post",
                                dateType:"text",
                                data : { 
                                typeform : 'dwithdraw',
                                wvalue : wvalue
                            },
                            success : function (data1){
                            if(Number(data1)==2){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Lệnh rút không khả dụng.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                            }else if(Number(data1)==1){
                                $('#vwithdraw').html('<p style="text-align: center;color: #4caf50;font-size: 0.9em;"><i class="fas fa-check"></i> Tiền đã được rút về tài khoản chính.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                            }
                            }
                            });
                    });
                });
            </script>
            <p class="mnlevel">Dưới Level 4: Lợi nhuận lần lượt là 5% 3% 1%<br />
            Level 4: Lợi nhuận lần lượt là: 8% 5% 3%<br />
            Level 5: Lợi nhuận lần lượt là: 9% 5% 3%<br />
            Level 6: Lợi nhuận lần lượt là: 10% 5% 3%<br />
            Level 7: Lợi nhuận lần lượt là: 11% 5% 3%<br />
            Level 8: Lợi nhuận lần lượt là: 12% 5% 3%<br />
            </p>
                <p>&nbsp;</p>
            </div>
        </div>
     