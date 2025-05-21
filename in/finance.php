<div class="bigmem fina">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Tài chính <a style="float: right;font-size: 14px;padding-right: 20px;color: #ff9700;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag">
            <?
            if(isset($_GET['s']) and $_GET['s']=='recharge'){
            ?>
            <h4 class="nameunhead"><a href="/m/finance/"><i class="fas fa-arrow-circle-left"></i></a> Nạp tiền 
            <?
            if($u['tien_ung']==0){
            if(!isset($_GET['other'])){echo '<a style="float:right;font-size:12px;" href="/m/finance/?s=recharge&other=1"><i class="fab fa-google-wallet"></i> Nạp hộ</a>';}else{echo '<a style="float:right;font-size:12px;" href="/m/finance/?s=recharge"><i class="fas fa-diagnoses"></i> Nạp của tôi</a>';}
            }
            ?>
            </h4>
            <hr />
            <p style="font-weight: bold;">Nạp BTC (Ví HUOBI)</p>
            <p><img style="    width: 60%;margin: 10px auto;max-width: 180px;" src="i/btchuobi.png" /></p>
            <p style="font-style: italic;">Chỉ chuyển BTC tới địa chỉ này</p>
            <p class="text-left"><span style="color: #6F6F6F;">Mạng lưới:</span> <span style="font-weight: 500;">Bitcoin (BTC)</span></p>
            <p class="text-left"><span style="color: #6F6F6F;">Giá quy đổi:</span> <span style="font-weight: 500;">1 Bitcoin = <?=$admin['btcusdnap']?>$</span></p>
            
            <p style="text-align: left;">Địa chỉ ví:</p>
            <div class="text-left"><input id="foo" class="form-control adress" style="" readonly="" value="193NTgWDSyrVmYzPrdXNhgULiVdEjShZPn"/> <button type="button" class="btn btn-default copyed buttoncopy" data-clipboard-target="#foo"><i class="far fa-copy"></i></button></div>
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
                <p class="an" id="alecopy"><span>Đã copy xong</span></p>
                <div class="clearfix"></div>
                <hr />
                <div class="hids"><p><i class="far fa-check-circle fa-3x"></i></p>Giao dịch nạp tiền đã được ghi nhận. Số tiền bạn nạp đã được tạm ứng vào tài khoản. Cổng rút tiền tạm đóng cho tới khi chúng tôi xác nhận giao dịch<p>----------</p></div>
                <div class="hidb"><p><i class="far fa-check-circle fa-3x"></i></p>Giao dịch nạp tiền đã được ghi nhận. Vui lòng chờ trong khoảng 10 phút - 24 giờ để chúng tôi xác nhận giao dịch và cộng tiền cho bạn<p>----------</p></div>
            <p class="text-left">Khi chuyển xong, hãy điền các thông tin sau:</p>
            <form style="text-align: left;" role="form">
              <div class="form-group">
                <input type="number" class="form-control" id="ssbtc" placeholder="Số BTC đã chuyển"/>
              </div>
              <script>
              $('#ssbtc').keyup(function(){
                    var usd = Number($('#ssbtc').val())*<?=$admin['btcusdnap']?>;
                    $('#showusd').html(usd.toFixed(2));
                    $('#gousd').val(usd.toFixed(2));
              });
              </script>
              <p>Số USD sẽ được nạp: <b id="showusd">0</b>$</p>
              <input type="hidden" id="gousd" />
              <div class="form-group">
                <input type="number" class="form-control" id="command" placeholder="Số lệnh chuyển"/>
              </div>
              <?if(isset($_GET['other'])){?>
              <div class="form-group">
                <input type="text" class="form-control" id="userother" placeholder="Username của người nhận"/>
              </div>
              <div class="showuserother"></div>
              <?}if($u['tien_ung']==0 and !isset($_GET['other'])){?>
              <div class="checkbox" >
                <label>
                <input type="checkbox" id="Fast" type=""/> Nạp nhanh - Cộng tiền ngay lập tức
                </label>
              </div>
              <div class="nFast" id="nFast">
                <p>Nạp nhanh nghĩa là tiền sẽ được cộng vào tài khoản của bạn ngay lập tức dựa theo cơ chế "Hậu kiểm". Tuy nhiên bạn phải cân nhắc 3 lưu ý sau:</p>
                <p>- Trong thời gian chờ xác minh giao dịch chuyển tiền, Cổng rút tiền của bạn sẽ tạm khóa.</p>
                <p>- Bạn phải chắc chắn rằng mình chuyển BTC và điền các thông tin trên chính xác. Nếu sai bạn có thể bị trừ phí khắc phục sự cố, thậm chí bị khóa tài khoản nếu chúng tôi nhận thấy bạn đang cố tình gây khó khăn cho hệ thống.</p>
                <p>- Tài khoản đang ứng tiền và nạp hộ sẽ không có cơ chế nạp nhanh này</p>
              </div>
              <?}?>
              <div style="color: red;" id="alear"></div>
              <button type="button" style="margin-top: 10px; margin-bottom: 15px;" class="btn btn-success" id="depositmoney">Gửi yêu cầu xác nhận nạp</button>
              <p style="font-size: 0.8em;" id="timemax"><i class="far fa-clock"></i> Thời gian dự kiến xác nhận giao dịch 10 phút - 24 giờ</p>
            </form>
            <script>
            $('body').ready(function(){
                var nFast = 0;var userother='';
                <?if($u['tien_ung']==0 and !isset($_GET['other'])){?>
                document.getElementById('Fast').onclick = function(e){
                        if (this.checked){
                            $('#nFast').slideDown(1000);
                            $('#timemax').slideUp(1000);
                            nFast = 1;
                        }
                        else{
                            $('#nFast').slideUp(1000);
                            $('#timemax').slideDown(1000);
                        }
                    };
                <?}?>
                <?if(isset($_GET['other'])){?>
                $('#userother').keyup(function(){
                    var userother=$('#userother').val();
                    $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'loadusername',
                            userother:userother
                        },
                        success : function (data1){
                        $('.showuserother').html(data1);
                        }
                        });
                })
                <?}?>
                $('#depositmoney').click(function(){
                    var ssbtc=$('#ssbtc').val();
                    var gousd=$('#gousd').val();
                    var command=$('#command').val();
                    var userother=$('#userother').val();
                    if(ssbtc==''){
                        $('#alear').html('<p><i class="fas fa-exclamation-triangle"></i> Hãy nhập số BTC bạn đã chuyển</p>');
                        $('#ssbtc').focus();
                        setTimeout(function(){$('#alear').html('');},4000);
                        return false;
                    }else if(command==''){
                        $('#alear').html('<p><i class="fas fa-exclamation-triangle"></i> Hãy nhập lệnh chuyển tiền</p>');
                        $('#command').focus();
                        setTimeout(function(){$('#alear').html('');},4000);
                        return false;
                    }<?if(isset($_GET['other'])){?>
                    else if(userother==''){
                        $('#alear').html('<p><i class="fas fa-exclamation-triangle"></i> Hãy nhập tài khoản nhận tiền</p>');
                        $('#userother').focus();
                        setTimeout(function(){$('#alear').html('');},4000);
                        return false;
                    }  
                    <?}?>else{
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'depositmoney',
                            ssbtc : ssbtc,
                            command : command,
                            nFast : nFast,
                            userother:userother
                        },
                        success : function (data1){
                        if(Number(data1)==1){
                            $('.hids').show();
                            setTimeout(function(){window.location="/m/finance/";},4000);
                        }else if(Number(data1)==2){
                            $('.hidb').show();
                            setTimeout(function(){window.location="/m/finance/";},4000);
                        }else if(Number(data1)==3){
                            $('#alear').html('<p><i class="fas fa-exclamation-triangle"></i> Lỗi không xác định</p>');
                            setTimeout(function(){$('#alear').html('');},4000);
                        }
                        }
                        });
                    }
                    
                })
            })
            </script>
            <hr />
            <h4 class="nameunhead" style="padding-left: 0;">Tham khảo</h4>
            <div class="text-left">
            <?
            $bv=@mysql_query("select * from baiviet where menu=5");
            while($rbv=@mysql_fetch_assoc($bv)){
            ?>
            <p><a href="/post/<?=$rbv['menu']?>/<?=$rbv['link']?>/"><?=$rbv['ten']?></a></p>
            <?}?>
            </div>
            <?
            }elseif(isset($_GET['s']) and $_GET['s']=='withdraw'){
            ?>
            <h4 class="nameunhead"><a href="/m/finance/"><i class="fas fa-arrow-circle-left"></i></a> Rút tiền</h4>
            <hr />
            <?if($u['blockrut']>0){?>
            <div class="fiset"><div class="titfiset"><i class="fas fa-lock"></i> Cổng rút tạm khóa </div>
                <p class="text-center" style="font-size: 0.85em;"><?=$u['lydoblock']?></p>
            </div>
            <?}?>
            <div class="text-left" style="line-height: 32px;">
            <p>Số dư hiện tại: <b><?=number_format($u['tien'],2,',','.')?>$</b><button type="button" id="wmaximum" class="btn btn-default btn-xs" style="float: right;">Rút tối đa</button></p>
            <script>
            $('body').ready(function(){
                $('#wmaximum').click(function(){
                    var moneymax=<?if($u['tien']>=500){echo $u['tien']*0.2;}else{echo $u['tien'];}?>;
                    $('#kusdwithdraw').val(moneymax.toFixed(2));
                    var realmoney=moneymax - moneymax*0.05;
                    $('#usdwithdraw').html(realmoney.toFixed(2));
                    var btcreal=realmoney/<?=$admin['btcusdrut']?>;
                    $('#btcwithdraw').html(btcreal.toFixed(8));
                });
                $('#kusdwithdraw').keyup(function(){
                    var moneymax=$('#kusdwithdraw').val();
                    var realmoney=moneymax - moneymax*0.05;
                    $('#usdwithdraw').html(realmoney.toFixed(2));
                    var btcreal=realmoney/<?=$admin['btcusdrut']?>;
                    $('#btcwithdraw').html(btcreal.toFixed(8));
                })
            });
        </script>
            <div class="input-group noborder" style="margin-bottom: 10px;">
                <input type="number" id="kusdwithdraw" class="form-control" placeholder="Nhập số USD muốn rút"/>
                <span class="input-group-addon">$</span>
            </div>
            <p style="font-size: 0.9em; color: #555;">Hạn mức: <i>1 lần/ngày, không quá 20% tổng tài sản đối với tài khoản có số dư trên 500$</i></p>
            <p>Phí rút: 5%</p>
            <p>Số tiền thực nhận: <b id="usdwithdraw">0</b> $</p>
            <p>Số BTC thực nhận: <b id="btcwithdraw">0</b> Bitcoin</p>
            <p>Địa chỉ ví BTC: <a style="float: right;" type="button"><img src="https://d2xqxjfvpb1oa6.cloudfront.net/eyJidWNrZXQiOiJpbnZpdGF0aW9udXBsb2FkcyIsImtleSI6Imludml0YXRpb24uYXBwLmh1b2JpLmNvbS1wcm9tby1jb2Rlc180Mzc4MmUuY29tIiwiZWRpdHMiOnsicmVzaXplIjp7IndpZHRoIjoyNTYsImhlaWdodCI6MjU2LCJmaXQiOiJjb250YWluIiwid2l0aG91dEVubGFyZ2VtZW50Ijp0cnVlfX19" style="height: 20px;"/> Sàn Houbi</a></p>
            <div class="input-group noborder" style="margin-bottom: 20px;">
                <input type="text" class="form-control" id="houbi" placeholder="Nhập địa chỉ ví nhận"/>
                <span class="input-group-addon"><i class="far fa-address-card"></i></span>
            </div>
            </div>
            <p><button type="button" class="btn btn-success" id="dwithdraw"><i class="fas fa-sign-out-alt"></i> Yêu cầu rút tiền</button></p>
            <div id="vwithdraw"></div>
                <script>
                $('body').ready(function(){
                    $('#dwithdraw').click(function(){
                        var moneymax=<?if($u['tien']>=500){echo $u['tien']*0.2;}else{echo $u['tien'];}?>;
                        var money=<?=$u['tien']?>;
                        var wr = $('#kusdwithdraw').val();
                        var houbi = $('#houbi').val();
                        if(Number(wr)<50){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Số tiền rút tối thiểu 50$.</p>');
                                $('#kusdwithdraw').focus();
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                        }else if(wr==''){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Nhập số USD muốn rút.</p>');
                                $('#kusdwithdraw').focus();
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                        }else if(Number(wr) > moneymax){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Vượt quá số tiền được phép rút.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                        }else if(houbi==''){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Nhập địa chỉ nhận BTC ví Houbi.</p>');
                                $('#houbi').focus();
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                                return false;
                        }else{
                        $.ajax({
                                url : "./ajax.php", 
                                type : "post",
                                dateType:"text",
                                data : { 
                                typeform : 'houbiwithdraw',
                                wr : wr,
                                houbi : houbi
                            },
                            success : function (data1){
                            if(Number(data1)==1){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Bạn đang bị tạm khóa cổng rút tiền.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==2){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Chỉ được rút 1 lần/ngày.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==3){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Chỉ được rút tối đa 20% tài sản/ngày.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==4){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Số tiền muốn rút tối thiểu 50$.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==5){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Bạn đang bị tạm khóa cổng rút tiền do chưa hoàn ứng.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==6){
                                $('#vwithdraw').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Bạn đang bị tạm khóa cổng rút tiền bởi hệ thống.</p>');
                                setTimeout(function(){$('#vwithdraw').html('');},4000);
                            }else if(Number(data1)==0){
                                $('#vwithdraw').html('<p style="text-align: center;color: #4caf50;font-size: 0.9em;"><i class="fas fa-check"></i> Lệnh rút tiền đã được ghi nhận. BTC sẽ đwọc chuyển vào ví của bạn sau khi chúng tôi kiểm tra các giáo dịch hợp lệ của bạn.</p>');
                                setTimeout(function(){window.location="/m/finance/?s=withdraw";},4000);
                            }
                            }
                            });
                        }
                    });
                });
            </script>
            <p class="mnlevel">
            Bạn có thể sử dụng tất cả các địa chỉ nhận tiền tại các ví sàn như Binance, Huobi, Gate.io, Kucoin, Remitano, Coinbase... Tuy nhiên chúng tôi sẽ thanh khoản cho bạn từ ví sàn <b>Huobi</b> 
            cho nên nếu bạn cũng sử dụng ví Huobi để nhận tiền thì thời gian sẽ nhanh hơn và không mất thêm phí chuyển đổi khác sàn.<br />
            Nếu bạn dùng ví khác chúng tôi vẫn chuyển bình thường, nhưng thời gian sẽ chậm hơn chút (khoảng 20-30 phút) và bạn sẽ mất thêm khoảng 0.2% phí chuyển đổi coin giữa các sàn.
            </p>
            <?    
            }elseif(isset($_GET['s']) and $_GET['s']=='advance'){
            ?>
            <h4 class="nameunhead"><a href="/m/finance/"><i class="fas fa-arrow-circle-left"></i></a> Ứng tiền</h4>
            <hr />
            <p class="text-left"><b><i class="fas fa-hand-holding-usd"></i> Bạn muốn ứng bao nhiêu tiền:</b></p>
            <table style="width: 100%;">
            <tr>
                <td><a class="buttonorder" id="b100">100$</a></td>
                <td><a class="buttonorder" id="b200">200$</a></td>
                <td><a class="buttonorder" id="b300">300$</a></td>
            </tr>
            <tr style="padding-top: 30px;">
                <td><a class="buttonorder" id="b500">500$</a></td>
                <td><a class="buttonorder" id="b1000">1000$</a></td>
                <td><a class="buttonorder" id="b2000">2000$</a></td>
            </tr>
            </table>
            <hr />
            <div class="ac-advance" id="ac-advance">
            <div class="ale" id="ale"></div>
            <p>Số tiền ứng: <b id="a-money">200$</b></p>
            <input type="hidden" id="moneyad" />
            <?
            $date = date('Y-m-j');
            $newdate = strtotime ( '+7 day' , strtotime ( $date ) ) ;
            $newdate = date ( 'd/m/Y' , $newdate );
            ?>
            <p>Thời gian hoàn ứng: <b><?echo date('H:i').' - '.$newdate;?></b></p>
            <p>Phí hoàn ứng: <b>10%</b></p>
            <p><button type="button" class="btn btn-success" id="activeadv">Xác nhận giao dịch</button></p>
            <hr />
            </div>
            <script>
            $('body').ready(function(){
                $('#b100').click(function(){$('#ac-advance').show();$('#a-money').html('100$');$('.buttonorder').removeClass('accc');$('#b100').addClass('accc');$('#moneyad').val('100');});
                $('#b200').click(function(){$('#ac-advance').show();$('#a-money').html('200$');$('.buttonorder').removeClass('accc');$('#b200').addClass('accc');$('#moneyad').val('200');});
                $('#b300').click(function(){$('#ac-advance').show();$('#a-money').html('300$');$('.buttonorder').removeClass('accc');$('#b300').addClass('accc');$('#moneyad').val('300');});
                $('#b500').click(function(){$('#ac-advance').show();$('#a-money').html('500$');$('.buttonorder').removeClass('accc');$('#b500').addClass('accc');$('#moneyad').val('500');});
                $('#b1000').click(function(){$('#ac-advance').show();$('#a-money').html('1000$');$('.buttonorder').removeClass('accc');$('#b1000').addClass('accc');$('#moneyad').val('1000');});
                $('#b2000').click(function(){$('#ac-advance').show();$('#a-money').html('2000$');$('.buttonorder').removeClass('accc');$('#b2000').addClass('accc');$('#moneyad').val('2000');});
                $('#activeadv').click(function(){
                    var moneya=$('#moneyad').val();
                    $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'advance',
                            moneya : moneya
                        },
                        success : function (data1){
                        if(Number(data1)==1){
                            $('#ale').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Tài khoản đang ứng tiền rồi, không được ứng thêm.</p>');
                            setTimeout(function(){$('#ale').html('');},4000);
                            return false;
                        }else if(Number(data1)==2){
                            $('#ale').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Tài khoản không nằm trong 2 trường hợp được ứng tiền.</p>');
                            setTimeout(function(){$('#ale').html('');},4000);
                            return false;
                        }else if(Number(data1)==3){
                            $('#ale').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Lần ứng tiền gần nhất của bạn phải quá 10 ngày.</p>');
                            setTimeout(function(){$('#ale').html('');},4000);
                            return false;
                        }else if(Number(data1)==4){
                            $('#ale').html('<p style="color:red"><i class="fas fa-exclamation-triangle"></i> Lỗi không xác định.</p>');
                            setTimeout(function(){$('#ale').html('');},4000);
                            return false;
                        }else{
                            $('#ale').html('<p style="text-align: center;color: #4caf50;font-size: 1.2em;"><i class="fas fa-check"></i> Ứng tiền thành công</p>');
                            setTimeout(function(){
                                window.location="/m/finance/";
                            },2500);
                        }
                        }
                        });
                })
            });
        </script>
            <div class="text-left">
            <p><b><i class="fas fa-exclamation-circle"></i> Ứng tiền và giao dịch bằng tiền tạm ứng:</b></p>
            <p><b>1. Điều kiện ứng:</b></p>
            <p><i>Bạn được ứng tiền ở 1 trong 2 trường hợp sau:</i></p>
            <p>- Trường hợp 1: Lần đầu tiên tham gia sàn, chưa có bất kỳ giao dịch nào phát sinh.</p>
            <p>- Trường hợp 2: Khi bạn cháy tài khoản <i>(Nghĩa là bạn đặt cược không có bảo hiểm, nhưng bạn lại thua và tài khoản về 0)</i>. Nhưng phải sau ít nhất 10 ngày kể từ lần ứng trước đó.</p>
            <p><b>2. Giao dịch bằng tiền ứng:</b></p>
            <p>Không phải là tiền Demo chơi thử. Tiền mà bạn tạm ứng được sử dụng như tiền bạn nạp vào. Lợi nhuận mà nó tạo ra được nạp vào tài khoản có thể rút ra, Chỉ khác ở ngưỡng lợi nhuận/ngày, quyền rút, và các quyền lợi bổ sung (Xem mục 3,4,5)</p>
            <p><b>3. Ngưỡng lợi nhuận:</b></p>
            <p>Khi tài khoản của bạn vẫn còn khoản ứng chưa hoàn ứng thì ngưỡng lợi nhuận tối đa của bạn/ngày là 2%. Kể cả khi bạn đặt cược có bảo đảm hay đặt cược không bảo hiểm.</p>
            <p><b>4. Rút tiền:</b></p>
            <p>Khi tài khoản của bạn trong tình trạng ứng tiền, cổng rút tiền trên tài khoản của bạn sẽ tạm đóng. Khi bạn nạp đủ số tiền đã ứng, cổng rút tiền tự động mở (bạn không cần thực hiện thao tác báo cáo hay liên hệ gì)</p>
            <p><b>5. Quyền lợi bổ sung:</b></p>
            <p>Khi tài khoản của bạn trong tình trạng ứng tiền, giao dịch của bạn sẽ không tạo ra hoa hồng giới thiệu, không được hưởng quyền lợi Quỹ đầu tư (Nếu bạn đang có Quỹ đầu tư, thì Quỹ đầu tư cũng tạm ngưng trả lãi ngày), đồng thời không được hưởng tất cả các chương trình khuyến mãi của sàn (Nếu có)</p>
            <p><b>6. Thời gian hoàn ứng:</b></p>
            <p>Thời gian hoàn ứng là 7 ngày kể từ khi bạn ứng tiền. Sau 7 ngày bạn không hoàn ứng đủ, số dư tài khoản của bạn sẽ trở về 0 như tài khoản vừa đăng ký.</p>
            <p><b>7. Phí hoàn ứng:</b> 10% số tiền đã ứng.</p>
            </div>
            <?    
            }else{
            ?>
                <img src="i/804953.png" />
                <p><b><?=$u['usernamenot']?></b></p>
                <p>Tham gia: <i><?=retime($u['time'])?></i></p>
                <hr />
                <div class="acsmall">
                    <p><span class="cion"><i class="fas fa-award"></i></span>Level: <b><?=$u['levelnot']?>/8</b><span style="float: right;"><a class="alevel" href="/post/3/level-regulation/">Quy định Level</a></span></p>
                    <p><span class="cion"><i class="fas fa-donate"></i></span>Vé bảo hiểm hàng ngày: <b><?=per($u['levelnot'])?>%</b></p>
                </div>
                <hr />
                <div class="fina">
                <table class="fmoney">
                    <tr>
                        <th>Số dư</th>
                        <th>Đóng băng</th>
                        <th>Lợi nhuận</th>
                    </tr>
                    <tr>
                        <td><?=number_format($u['tien'],2,',','.')?>$</td>
                        <td><?=number_format($u['tien_dongbang'],2,',','.')?>$</td>
                        <td><?=number_format($u['tien_lai'],2,',','.')?>$</td>
                    </tr>
                </table>
                <?if($u['tien_ung']>0){?>
                <div class="boxadvance">
                    Bạn đang tạm ứng số tiền <b style="color: red;"><?=number_format($u['tien_ung'],2,',','.')?>$</b>. Thời gian chờ hoàn ứng còn lại là: 
                    <?
                    $timewait=explode(":",secondsToTime(($u['times_ung']+7*24*60*60)-$times));
                    ?>
                    <b><i><span id="d"><?=$timewait[0]?></span> ngày, <span id="h"><?=$timewait[1]?></span>:<span id="m"><?=$timewait[2]?></span>:<span id="s"><?=$timewait[3]?></span></i></b>
                
                <script>
                $('body').ready(function(){start();});
                var d = null; 
                var h = null;
                var m = null;
                var s = null;
                var timeout = null;
                function start()
                {
                    if (d === null)
                    {
                        d = <?=$timewait[0]?>;
                        h = <?=$timewait[1]?>;
                        m = <?=$timewait[2]?>;
                        s = <?=$timewait[3]?>;
                    }
                    if (s === -1){
                        m -= 1;
                        s = 59;
                    }
                    if (m === -1){
                        h -= 1;
                        m = 59;
                    }
                    if (h === -1){
                        d -= 1;
                        h = 24;
                    }
                    if (d == -1){
                        clearTimeout(timeout);
                        return false;
                    }
                    document.getElementById('d').innerText = d.toString();
                    document.getElementById('h').innerText = h.toString();
                    document.getElementById('m').innerText = m.toString();
                    if(s < 10){
                        document.getElementById('s').innerText = '0'+s.toString();
                    }else{
                        document.getElementById('s').innerText = s.toString();
                    }
                    timeout = setTimeout(function(){
                        s--;
                        start();
                    }, 1000);
                }
                </script>
                </div>
                <?}?>
                <table class="flist">
                    <tr>
                        <td><a class="accc" href="/m/finance/?s=recharge">Nạp tiền</a></td>
                        <td><a href="/m/finance/?s=withdraw">Rút tiền</a></td>
                        <td><a href="/m/finance/?s=advance">Ứng tiền</a></td>
                    </tr>
                </table>
                </div>
                <hr />
                <div class="acsmall">
                <p style="font-weight: 600;">Quỹ đầu tư dài hạn</p>
                    <table class="fmoney">
                    <tr>
                        <th>Tài chính quỹ</th>
                        <th>Lãi xuất/ngày</th>
                        <th>Lợi nhuận</th>
                    </tr>
                    <tr>
                        <td><?=number_format($u['tien_quy'],2,',','.')?>$</td>
                        <td>0.8%</td>
                        <td><?=number_format($u['tien_quy_lai'],2,',','.')?>$</td>
                    </tr>
                </table>
                <table class="flist">
                    <tr>
                        <td><a class="accc" type="button" id="withdraw-funds">Rút lãi</a></td>
                        <td colspan="2" style="text-align: right;"><a style="box-shadow: none;padding: 0;width: auto;color: #555;font-size: 0.8em;" href=""><i class="far fa-question-circle"></i> Quy định quỹ đầu tư?&nbsp;&nbsp;</a></td>
                    </tr>
                </table>
                </div>
            <?}?>
                <p>&nbsp;</p>
            </div>
        </div>
     