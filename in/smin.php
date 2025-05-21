<style>
.bigmem.regulation{
    background: url(i/regulation.png) no-repeat;
    background-size:100%;
    background-position: top;
    padding-top: 20px;
    margin-left: -15px;
    margin-right: -15px;
}
.contag.dr img{
    width: 100%;
}
.regulation h3{
        text-align: left;
    padding-left: 15px;
    font-size: 16px;
}
.regulation h3 a{}
.regulation.admin h3{
        text-align: center;
    box-shadow: 0 0 10px 1px #d7d7d7;
    padding: 24px 0;
    width: 90%;
    margin: 24px auto 0;
}
.regulation.admin h3 a{}
.regulation.admin td{width: 33.3333%;}
.biox{
        margin-bottom: 20px;
    background: #fff;
    text-align: left;
    padding: 10px;
    padding-bottom: 1px;
    box-shadow: 0 0 8px 0 #e1e1e1;
}
.biox span.crow{
    white-space: nowrap;
}
</style>
        <div class="bigmem regulation">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Admin</h3>
            <div class="contag dr">
            <?
            if(isset($_GET['s']) and $_GET['s']=='naptien'){
            ?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Nạp tiền</h4>
            <hr />
            <h4 class="text-left">Chờ duyệt:</h4>
            <?
            $lenhnap=@mysql_query("select * from naptien where trangthai=0 and rut=0 order by time asc");
            while($rlenh=@mysql_fetch_assoc($lenhnap)){
                $thanhvien=@mysql_fetch_assoc(@mysql_query("select * from usernot where id=$rlenh[idu]"));
                ?>
                <div class="biox">
                    <p>Thành viên: <b>@<?=$thanhvien['usernamenot']?></b> (<?=$thanhvien['emailnot']?>) <br /> ĐK: <?=retime($thanhvien['time'])?></p>
                    <p>
                    <span class="crow">Tiền: <?=$thanhvien['tien']?>$</span> - 
                    <span class="crow">Đóng băng: <?=$thanhvien['tien_dongbang']?>$</span> - 
                    <span class="crow">Tạm ứng: <?=$thanhvien['tien_ung']?>$</span>
                    </p>
                    <p>Nạp: 
                    <span class="crow">BTC: <span style="color: red;"><?=$rlenh['btc']?></span></span> - 
                    <span class="crow">USD: <span style="color: red;"><?=$rlenh['usd']?></span></span> - 
                    <span class="crow">Lệnh: <?=$rlenh['solenh']?></span> <br /> 
                    <span class="crow">Loại: <b><?if($rlenh['nhanh']==1){echo 'Nạp nhanh';}else{echo 'Nạp chờ';}?></b></span> - <?=retime($rlenh['time'])?>
                    </p>
                    
                    <p>
                    <button type="button" id="<?=$rlenh['id']?>duyet" class="btn btn-primary btn-xs">Duyệt</button> &nbsp; 
                    <button type="button" id="<?=$rlenh['id']?>huy" class="btn btn-danger btn-xs">Hủy</button> 
                    </p>
                    <form style="display: none;" id="formhuy<?=$rlenh['id']?>" role="form">
                      <div class="form-group">
                      <label>Lý do hủy</label>
                        <input type="text" class="form-control" id="lyho<?=$rlenh['id']?>" placeholder="Lý do hủy" value="Không ghi nhận lệnh nạp tiền với mã lệnh tương ứng. Nếu bạn cho rằng quyết định của chúng tôi là sai, hãy cũng cấp tất cả những chứng từ có liên quan và thông tin tài khoản gửi tới email support@notscore.com. Chúng tôi sẽ xem xét giải quyết trong thời gian sớm nhất."/>
                      </div>
                      <div class="form-group">
                        <label>Phạt ($)</label>
                        <input type="number" class="form-control" value="0" id="phat<?=$rlenh['id']?>"/>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" id="block<?=$rlenh['id']?>"/> Khóa tài khoản
                        </label>
                      </div>
                      <button type="button" id="huylenh<?=$rlenh['id']?>" class="btn btn-default">Hủy lệnh</button>
                    </form>
                    <div>
                    
                    </div>
                </div>
                <script>
                $('body').ready(function(){
                    $('#<?=$rlenh['id']?>duyet').click(function(){
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'duyetnaptien',
                            id : <?=$rlenh['id']?>
                        },
                        success : function (data1){
                            setTimeout(function(){
                                window.location="/m/admin/?s=naptien";
                            },2000);
                        }
                        });
                    });
                    $('#<?=$rlenh['id']?>huy').click(function(){
                        $('#formhuy<?=$rlenh['id']?>').slideDown();
                    });
                    $('#huylenh<?=$rlenh['id']?>').click(function(){
                        var blocktk=0;
                        var checkbox = document.getElementById('block<?=$rlenh['id']?>');
                        for (var i = 0; i < checkbox.length; i++){
                            if (checkbox[i].checked === true){
                                blocktk = 1;
                            }
                        }
                        var lydo=$('#lyho<?=$rlenh['id']?>').val();
                        var phat=$('#phat<?=$rlenh['id']?>').val();
                       $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'huynaptien',
                            blocktk : blocktk,
                            lydo : lydo,
                            phat : phat,
                            id : <?=$rlenh['id']?>
                        },
                        success : function (data1){
                            setTimeout(function(){
                                window.location="/m/admin/?s=naptien";
                            },2000);
                        }
                        });
                    });
                })
                </script>
                <?
            }
            ?>
            <?}elseif(isset($_GET['s']) and $_GET['s']=='ruttien'){?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Rút tiền</h4>
            <hr />
            <script src="j/clipboard/dist/clipboard.min.js"></script>
            <h4 class="text-left">Chờ duyệt:</h4>
            <?
            $lenhnap=@mysql_query("select * from naptien where trangthai=0 and rut=1 order by time asc");
            while($rlenh=@mysql_fetch_assoc($lenhnap)){
                $thanhvien=@mysql_fetch_assoc(@mysql_query("select * from usernot where id=$rlenh[idu]"));
                ?>
                <div class="biox">
                    <p>Thành viên: <b>@<?=$thanhvien['usernamenot']?></b> (<?=$thanhvien['emailnot']?>) <br /> ĐK: <?=retime($thanhvien['time'])?></p>
                    <p>
                    <span class="crow">Tiền: <?=$thanhvien['tien']?>$</span> - 
                    <span class="crow">Đóng băng: <?=$thanhvien['tien_dongbang']?>$</span> - 
                    <span class="crow">Tạm ứng: <?=$thanhvien['tien_ung']?>$</span>
                    </p>
                    <p>Nạp: 
                    <span class="crow">BTC rút: <span style="color: red;"><?=number_format($rlenh['btc'],8,',','.')?></span></span> - 
                    <span class="crow">USD chưa phí: <span style="color: red;"><?=$rlenh['usd_baophi']?></span></span> - 
                    <span class="crow">USD sau phí: <span style="color: red;"><?=$rlenh['usd']?></span></span>
                    </p>
                    <p>
                    <span class="crow">Ví: </span> 
                    <input id="foo<?=$rlenh['id']?>" class="form-control adress" style="" readonly="" value="<?=$rlenh['diachi']?>"/> <button type="button" class="btn btn-default copyed<?=$rlenh['id']?> buttoncopy" data-clipboard-target="#foo<?=$rlenh['id']?>"><i class="far fa-copy"></i></button>
                    <p class="an" id="alecopy<?=$rlenh['id']?>"><span>Đã copy xong</span></p>
                    <div class="clearfix"></div>
                    <script>
                    var clipboard<?=$rlenh['id']?> = new ClipboardJS('.copyed<?=$rlenh['id']?>');
                    clipboard<?=$rlenh['id']?>.on('success', function(e) {
                            console.info('Action:', e.action);
                            console.info('Text:', e.text);
                            console.info('Trigger:', e.trigger);
                        
                            e.clearSelection();
                            $('#alecopy<?=$rlenh['id']?>').show('4000');
                            setTimeout(function(){$('#alecopy<?=$rlenh['id']?>').html('');},5000);
                        });
                
                    clipboard<?=$rlenh['id']?>.on('error', function(e) {
                            console.error('Action:', e.action);
                            console.error('Trigger:', e.trigger);
                        });
                    </script>
                    <br /> 
                    <span class="crow">Lúc: <?=retime($rlenh['time'])?></span>
                    </p>
                    <p>
                    <button type="button" id="<?=$rlenh['id']?>xong" class="btn btn-primary btn-xs">Xong</button> &nbsp; 
                    <button type="button" id="<?=$rlenh['id']?>hoan1" class="btn btn-warning btn-xs">Hoàn nghi ngờ</button> &nbsp; 
                    <button type="button" id="<?=$rlenh['id']?>hoan2" class="btn btn-warning btn-xs">Hoàn ví sai</button> &nbsp; 
                    <button type="button" id="<?=$rlenh['id']?>huy" class="btn btn-danger btn-xs">Hủy</button> 
                    </p>
                    <div>
                    
                    </div>
                </div>
                <script>
                $('body').ready(function(){
                    $('#<?=$rlenh['id']?>xong').click(function(){
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'xongruttienamin1',
                            id : <?=$rlenh['id']?>
                        },
                        success : function (data1){
                            setTimeout(function(){
                                window.location="/m/admin/?s=ruttien";
                            },1000);
                        }
                        });
                    });
                    $('#<?=$rlenh['id']?>hoan2').click(function(){
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'hoanruttienamin2',
                            id : <?=$rlenh['id']?>
                        },
                        success : function (data1){
                            setTimeout(function(){
                                window.location="/m/admin/?s=ruttien";
                            },1000);
                        }
                        });
                    });
                })
                </script>
                <?
            }
            ?>    
            <?}elseif(isset($_GET['s']) and $_GET['s']=='giaidau'){?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Giải đấu</h4>
            <hr />
            <?
            $tgiaidau=@mysql_query("select * from giadau order by id desc");
            while($giaidau=@mysql_fetch_assoc($tgiaidau)){
            ?>
            <a href="/m/admin/?s=doibong&giaidau=<?=$giaidau['id']?>">
            <div class="giaidau" style="border: 1px solid silver; padding: 15px; margin: 15px auto; border-radius: 8px;">
                <img src="<?=$giaidau['logo']?>" style="width: 25%; float: left;" />
                <div style="width: 72%; float: right;">
                    <h4><?=$giaidau['ten']?></h4>
                    <p><?=$giaidau['chuthich']?></p>
                    <p>Số đội: <?=$giaidau['sodoi']?> - Hệ số: <?=$giaidau['heso']?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            </a>
            <?}?>
            <?}elseif(isset($_GET['s']) and $_GET['s']=='doibong'){ ?>
            <h4 class="nameunhead text-left"><a href="/m/admin/?s=giaidau"><i class="fas fa-arrow-circle-left"></i></a> Đội bóng 
            <?if(isset($_GET['gon'])){?><a style="float: right;font-size: 12px;" href="/m/admin/?s=doibong&giaidau=<?=$_GET['giaidau']?>">Full</a><?}else{?><a style="float: right;font-size: 12px;" href="/m/admin/?s=doibong&giaidau=<?=$_GET['giaidau']?>&gon=1">Thu gọn</a><?}?>
            </h4>
            <hr />
            <?
            $gd=intval($_GET['giaidau']);
            $giaidau=@mysql_fetch_assoc(@mysql_query("select * from giadau where id=$gd"));
            if(isset($_POST['nhapdoi'])){
                $ttgiaidau=$giaidau['id'];
                $ten=addslashes($_POST['ten']);
                $thuhang=intval($_POST['thuhang']);
                $logo=addslashes($_POST['logo']);
                $thang=intval($_POST['thang']);
                $hoa=intval($_POST['hoa']);
                $thua=intval($_POST['thua']);
                $banthang=intval($_POST['banthang']);
                $banthua=intval($_POST['banthua']);
                $tran1=intval($_POST['tran1']);
                $tran2=intval($_POST['tran2']);
                $tran3=intval($_POST['tran3']);
                $tran4=intval($_POST['tran4']);
                $tran5=intval($_POST['tran5']);
                $bang=addslashes($_POST['bang']);
                $innn=@mysql_query("insert into doibong (ten,thuhang,logo,giaidau,thang,hoa,thua,banthang,banthua,tran1,tran2,tran3,tran4,tran5,bang)value(N'$ten',$thuhang,'$logo',$ttgiaidau,$thang,$hoa,$thua,$banthang,$banthua,$tran1,$tran2,$tran3,$tran4,$tran5,'$bang')");
            
            }
            ?>
            <p>Giải: <b><?=$giaidau['ten'].' ('.$giaidau['chuthich'].')';?></b></p>
            <?if(!isset($_GET['gon'])){?>
            <form role="form" action="" method="post" >

              <div class="form-group">
                <input type="text" name="ten" class="form-control" placeholder="Tên"/>
              </div>
              <div class="form-group">
                <input type="number" name="thuhang" class="form-control" value="0" placeholder="Thứ hạng"/>
              </div>
              <div class="form-group">
                <input type="text" name="logo" class="form-control" placeholder="Logo"/>
              </div>
              <div class="form-group">
                <input type="number" name="thang" class="form-control" value="0" placeholder="Thắng"/>
              </div>
              <div class="form-group">
                <input type="number" name="hoa" class="form-control" value="0" placeholder="Hòa"/>
              </div>
              <div class="form-group">
                <input type="number" name="thua" class="form-control" value="0" placeholder="Thua"/>
              </div>
              <div class="form-group">
                <input type="number" name="banthang" class="form-control" value="0" placeholder="Bàn thắng"/>
              </div>
              <div class="form-group">
                <input type="number" name="banthua" class="form-control" value="0" placeholder="Bàn thua"/>
              </div>
              <div class="form-group">
                <input type="number" name="tran1" class="form-control" value="0" placeholder="Trận 1"/>
              </div>
              <div class="form-group">
                <input type="number" name="tran2" class="form-control" value="0" placeholder="Trận 2"/>
              </div>
              <div class="form-group">
                <input type="number" name="tran3" class="form-control" value="0" placeholder="Trận 3"/>
              </div>
              <div class="form-group">
                <input type="number" name="tran4" class="form-control" value="0" placeholder="Trận 4"/>
              </div>
              <div class="form-group">
                <input type="number" name="tran5" class="form-control" value="0" placeholder="Trận 5"/>
              </div>
              <p>0: Thắng; 1: Hòa; 2: Thua; 3: Không thi đấu</p>
              <div class="form-group">
                <input type="text" name="bang" class="form-control" value="" placeholder="Bảng"/>
              </div>
              <button type="submit" name="nhapdoi" class="btn btn-default">Submit</button>
            
            </form>
            <hr />
            <?}?>
            <style>
            table.doi{}
            table.doi th{
                text-align: center;
                font-size: 12px;
                background: gray;
                color: white;
                padding: 8px 0;
            }
            table.doi td{
                text-align: center;
                padding: 10px 0;
            }
            table.doi td span{cursor: pointer;}
            </style>
            <?
            
            $tdoibong=@mysql_query("select * from doibong where giaidau=$gd order by (bang+thuhang) asc");
            while($doibong=@mysql_fetch_assoc($tdoibong)){
            ?>
            <div class="giaidau" style="border: 1px solid silver; padding: 15px; margin: 15px auto; border-radius: 8px; text-align: left;">
                    <h4><img src="<?=$doibong['logo']?>" style="width: 8%; float: left;" /> <?=$doibong['ten']?> <?if($doibong['bang']!=''){echo ' (Bảng '.$doibong['bang'].')';}?></h4>
                    <table style="width: 100%;" class="doi">
                        <tr>
                        <th>TH</th><th>Thắng</th><th>Hòa</th><th>Thua</th><th>BThắng</th><th>Bthua</th>
                        </tr>
                        <tr>
                        <td><span id="th<?=$doibong['id']?>"><?=$doibong['thuhang']?></span></td>
                        <script>$('body').ready(function(){
                            $('#th<?=$doibong['id']?>').click(function(){
                                var th = document.getElementById("th<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangthuhangdoibong',iddoi : <?=$doibong['id']?>,th:th,max:<?=$giaidau['sodoi']?>},
                                success : function (data1){
                                    $('#th<?=$doibong['id']?>').html(data1);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="thang<?=$doibong['id']?>"><?=$doibong['thang']?></span></td>
                        <script>$('body').ready(function(){
                            $('#thang<?=$doibong['id']?>').click(function(){
                                var thang = document.getElementById("thang<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangtranthangdoibong',iddoi : <?=$doibong['id']?>,thang:thang},
                                success : function (data2){
                                    $('#thang<?=$doibong['id']?>').html(data2);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="hoa<?=$doibong['id']?>"><?=$doibong['hoa']?></span></td>
                        <script>$('body').ready(function(){
                            $('#hoa<?=$doibong['id']?>').click(function(){
                                var hoa = document.getElementById("hoa<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangtranhoadoibong',iddoi : <?=$doibong['id']?>,hoa:hoa},
                                success : function (data3){
                                    $('#hoa<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="thua<?=$doibong['id']?>"><?=$doibong['thua']?></span></td>
                        <script>$('body').ready(function(){
                            $('#thua<?=$doibong['id']?>').click(function(){
                                var thua = document.getElementById("thua<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangtranthuadoibong',iddoi : <?=$doibong['id']?>,thua:thua},
                                success : function (data4){
                                    $('#thua<?=$doibong['id']?>').html(data4);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="banthang<?=$doibong['id']?>"><?=$doibong['banthang']?></span></td>
                        <script>$('body').ready(function(){
                            $('#banthang<?=$doibong['id']?>').click(function(){
                                var banthang = document.getElementById("banthang<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangbanthangdoibong',iddoi : <?=$doibong['id']?>,banthang:banthang},
                                success : function (data5){
                                    $('#banthang<?=$doibong['id']?>').html(data5);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="banthua<?=$doibong['id']?>"><?=$doibong['banthua']?></span></td>
                        <script>$('body').ready(function(){
                            $('#banthua<?=$doibong['id']?>').click(function(){
                                var banthua = document.getElementById("banthua<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tangbanthuadoibong',iddoi : <?=$doibong['id']?>,banthua:banthua},
                                success : function (data3){
                                    $('#banthua<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <tr>
                        <td>Cuối:</td>
                        <td><span id="tran1<?=$doibong['id']?>"><?=$doibong['tran1']?></span></td>
                        <script>$('body').ready(function(){
                            $('#tran1<?=$doibong['id']?>').click(function(){
                                var tran1 = document.getElementById("tran1<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tran1doibong',iddoi : <?=$doibong['id']?>,tran1:tran1},
                                success : function (data3){
                                    $('#tran1<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="tran2<?=$doibong['id']?>"><?=$doibong['tran2']?></span></td>
                        <script>$('body').ready(function(){
                            $('#tran2<?=$doibong['id']?>').click(function(){
                                var tran2 = document.getElementById("tran2<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tran2doibong',iddoi : <?=$doibong['id']?>,tran2:tran2},
                                success : function (data3){
                                    $('#tran2<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="tran3<?=$doibong['id']?>"><?=$doibong['tran3']?></span></td>
                        <script>$('body').ready(function(){
                            $('#tran3<?=$doibong['id']?>').click(function(){
                                var tran3 = document.getElementById("tran3<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tran3doibong',iddoi : <?=$doibong['id']?>,tran3:tran3},
                                success : function (data3){
                                    $('#tran3<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="tran4<?=$doibong['id']?>"><?=$doibong['tran4']?></span></td>
                        <script>$('body').ready(function(){
                            $('#tran4<?=$doibong['id']?>').click(function(){
                                var tran4 = document.getElementById("tran4<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tran4doibong',iddoi : <?=$doibong['id']?>,tran4:tran4},
                                success : function (data3){
                                    $('#tran4<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        <td><span id="tran5<?=$doibong['id']?>"><?=$doibong['tran5']?></span></td>
                        <script>$('body').ready(function(){
                            $('#tran5<?=$doibong['id']?>').click(function(){
                                var tran5 = document.getElementById("tran5<?=$doibong['id']?>").innerHTML;
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tran5doibong',iddoi : <?=$doibong['id']?>,tran5:tran5},
                                success : function (data3){
                                    $('#tran5<?=$doibong['id']?>').html(data3);
                                }
                                });
                            });
                        })
                        </script>
                        </tr>
                        </tr>
                    </table>
                <div class="clearfix"></div>
            </div>
            
            <?}?>
            <?}elseif(isset($_GET['s']) and $_GET['s']=='trandau'){ 
                if(isset($_GET['tao'])){
                ?>
                <h4 class="nameunhead text-left"><a href="/m/admin/?s=trandau"><i class="fas fa-arrow-circle-left"></i></a> Trận đấu 
                <a style="float: right;font-size: 12px;" href="/m/admin/?s=trandau">Danh sách</a>
                </h4>
                <hr />
                <style>.input-group-addon{cursor: pointer;}</style>
            <?

            if(isset($_POST['taotran'])){
                $giai=intval($_POST['giai']);
                $doi1=intval($_POST['doi1']);
                $doi2=intval($_POST['doi2']);
                $s00=floatval($_POST['s00']);
                $s11=floatval($_POST['s11']);
                $s22=floatval($_POST['s22']);
                $s33=floatval($_POST['s33']);
                $s01=floatval($_POST['s01']);
                $s02=floatval($_POST['s02']);
                $s03=floatval($_POST['s03']);
                $s10=floatval($_POST['s10']);
                $s12=floatval($_POST['s12']);
                $s13=floatval($_POST['s13']);
                $s20=floatval($_POST['s20']);
                $s21=floatval($_POST['s21']);
                $s23=floatval($_POST['s23']);
                $s30=floatval($_POST['s30']);
                $s31=floatval($_POST['s31']);
                $s32=floatval($_POST['s32']);
                $s4=floatval($_POST['s4']);
                $ngay=intval($_POST['ngay']); if($ngay<10){$strngay='0'.$ngay;}else{$strngay=$ngay;}
                $thang=intval($_POST['thang']);if($thang<10){$strthang='0'.$thang;}else{$strthang=$thang;}
                $nam=intval($_POST['nam']);
                $gio=intval($_POST['gio']);if($gio<10){$strgio='0'.$gio;}else{$strgio=$gio;}
                $phut=intval($_POST['phut']);if($phut<10){$strphut='0'.$phut;}else{$strphut=$phut;}
                $timetran=intval($nam.$strthang.$strngay.$strgio.$strphut.'00');
                $innn=@mysql_query("insert into trandau (giai,doi1,doi2,s00,s11,s22,s33,s01,s02,s03,s10,s12,s13,s20,s21,s23,s30,s31,s32,s4,gio,phut,ngay,thang,nam,timetran,time)
                value($giai,$doi1,$doi2,$s00,$s11,$s22,$s33,$s01,$s02,$s03,$s10,$s12,$s13,$s20,$s21,$s23,$s30,$s31,$s32,$s4,$gio,$phut,$ngay,$thang,$nam,$timetran,$time)");
                if($innn){
                    echo 'ok';
                }else{echo 'NO';}
            
            }
            ?>
            
            <form role="form" action="" method="post" >

              <div class="form-group text-left">
              <label>Chọn giải đấu:</label>
                <select class="form-control" id="chongiaidau" name="giai">
                <option>Chọn giải...</option>
                <?
                $tngi=@mysql_query("select * from giadau");
                while($rgiai=@mysql_fetch_assoc($tngi)){
                ?>
                  <option value="<?=$rgiai['id']?>"><?=$rgiai['ten']?> <br /> <?=$rgiai['chuthich']?></option>
                <?}?>
                </select>
              </div>
              <div class="form-group text-left">
              <label>Chọn đội:</label>
                <select class="form-control" id="doi1" name="doi1">
                
                </select>
              </div>
              <div class="form-group">
              <label>VS</label>
                <select class="form-control" id="doi2" name="doi2">
                
                </select>
              </div>
              <script>$('body').ready(function(){
                            $('#chongiaidau').change(function(){
                                var giai = $('#chongiaidau').val();
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'taotrantrondoi',giai : giai},
                                success : function (data1){
                                    $('#doi1').html(data1);
                                    $('#doi2').html(data1);
                                }
                                });
                            });
                            $('#doi1').change(function(){
                                loadphantram();
                            });
                            $('#doi2').change(function(){
                                loadphantram();
                            });
                            function loadphantram(){
                                var giai = $('#chongiaidau').val();
                                var doi1 = $('#doi1').val();
                                var doi2 = $('#doi2').val();
                                $.ajax({
                                    url : "./ajax.php", 
                                    type : "post",
                                    dateType:"text",
                                    data : { typeform : 'tinhtoanphantram',giai : giai,doi1:doi1,doi2:doi2},
                                    success : function (data1){
                                        var arr=data1.split('@');
                                    $('#s00').val(Number(arr[0]));
                                    $('#s11').val(Number(arr[1]));
                                    $('#s22').val(Number(arr[2]));
                                    $('#s33').val(Number(arr[3]));
                                    $('#s01').val(Number(arr[4]));
                                    $('#s02').val(Number(arr[5]));
                                    $('#s03').val(Number(arr[6]));
                                    $('#s12').val(Number(arr[7]));
                                    $('#s13').val(Number(arr[8]));
                                    $('#s23').val(Number(arr[9]));
                                    
                                    $('#s30').val(Number(arr[10]));
                                    $('#s31').val(Number(arr[11]));
                                    $('#s32').val(Number(arr[12]));
                                    $('#s20').val(Number(arr[13]));
                                    $('#s21').val(Number(arr[14]));
                                    $('#s10').val(Number(arr[15]));
                                    $('#s4').val(Number(arr[16]));
                                    $('#Tong').html(arr[17]);
                                    $('#Tongtren').html(arr[17]);
                                }
                                });
                            }
                            function tinhtoanlai(){
                                var tong = (Number($('#s00').val())*100+Number($('#s11').val())*100+Number($('#s22').val())*100+Number($('#s33').val())*100+Number($('#s01').val())*100+Number($('#s02').val())*100+Number($('#s03').val())*100+Number($('#s12').val())*100+Number($('#s13').val())*100+Number($('#s23').val())*100+Number($('#s30').val())*100+Number($('#s31').val())*100+Number($('#s32').val())*100+Number($('#s20').val())*100+Number($('#s21').val())*100+Number($('#s10').val())*100+Number($('#s4').val())*100)/100;
                                $('#Tong').html(tong);
                                $('#Tongtren').html(tong);
                            }
                            $('#tru00').click(function(){
                                var giatri=(Number($('#s00').val())*100-10)/100;$('#s00').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#cong00').click(function(){
                                var giatri=(Number($('#s00').val())*100+10)/100;$('#s00').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#tru11').click(function(){
                                var giatri=(Number($('#s11').val())*100-10)/100;;$('#s11').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#cong11').click(function(){
                                var giatri=(Number($('#s11').val())*100+10)/100;;$('#s11').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#tru22').click(function(){
                                var giatri=(Number($('#s22').val())*100-10)/100;;$('#s22').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#cong22').click(function(){
                                var giatri=(Number($('#s22').val())*100+10)/100;;$('#s22').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#tru33').click(function(){
                                var giatri=(Number($('#s33').val())*100-10)/100;;$('#s33').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#cong33').click(function(){
                                var giatri=(Number($('#s33').val())*100+10)/100;;$('#s33').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            
                            $('#tru01').click(function(){
                                var giatri=(Number($('#s01').val())*100-10)/100;
                                $('#s01').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s10').val())*100+10)/100;
                                $('#s10').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong01').click(function(){
                                var giatri=(Number($('#s01').val())*100+10)/100;
                                $('#s01').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s10').val())*100-10)/100;
                                $('#s10').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru02').click(function(){
                                var giatri=(Number($('#s02').val())*100-10)/100;
                                $('#s02').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s20').val())*100+10)/100;
                                $('#s20').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong02').click(function(){
                                var giatri=(Number($('#s02').val())*100+10)/100;
                                $('#s02').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s20').val())*100-10)/100;
                                $('#s20').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru03').click(function(){
                                var giatri=(Number($('#s03').val())*100-10)/100;
                                $('#s03').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s30').val())*100+10)/100;
                                $('#s30').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong03').click(function(){
                                var giatri=(Number($('#s03').val())*100+10)/100;
                                $('#s03').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s30').val())*100-10)/100;
                                $('#s30').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            $('#tru10').click(function(){
                                var giatri=(Number($('#s10').val())*100-10)/100;
                                $('#s10').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s01').val())*100+10)/100;
                                $('#s01').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong10').click(function(){
                                var giatri=(Number($('#s10').val())*100+10)/100;
                                $('#s10').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s01').val())*100-10)/100;
                                $('#s01').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru12').click(function(){
                                var giatri=(Number($('#s12').val())*100-10)/100;
                                $('#s12').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s21').val())*100+10)/100;
                                $('#s21').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong12').click(function(){
                                var giatri=(Number($('#s12').val())*100+10)/100;
                                $('#s12').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s21').val())*100-10)/100;
                                $('#s21').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru13').click(function(){
                                var giatri=(Number($('#s13').val())*100-10)/100;
                                $('#s13').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s31').val())*100+10)/100;
                                $('#s31').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong13').click(function(){
                                var giatri=(Number($('#s13').val())*100+10)/100;
                                $('#s13').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s31').val())*100-10)/100;
                                $('#s31').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            $('#tru20').click(function(){
                                var giatri=(Number($('#s20').val())*100-10)/100;
                                $('#s20').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s02').val())*100+10)/100;
                                $('#s02').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong20').click(function(){
                                var giatri=(Number($('#s20').val())*100+10)/100;
                                $('#s20').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s02').val())*100-10)/100;
                                $('#s02').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru21').click(function(){
                                var giatri=(Number($('#s21').val())*100-10)/100;;
                                $('#s21').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s12').val())*100+10)/100;;
                                $('#s12').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong21').click(function(){
                                var giatri=(Number($('#s21').val())*100+10)/100;;
                                $('#s21').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s12').val())*100-10)/100;;
                                $('#s12').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru23').click(function(){
                                var giatri=(Number($('#s23').val())*100-10)/100;;
                                $('#s23').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s32').val())*100+10)/100;;
                                $('#s32').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong23').click(function(){
                                var giatri=(Number($('#s23').val())*100+10)/100;
                                $('#s23').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s32').val())*100-10)/100;
                                $('#s32').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru30').click(function(){
                                var giatri=(Number($('#s30').val())*100-10)/100;
                                $('#s30').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s03').val())*100-10)/100;
                                $('#s03').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong30').click(function(){
                                var giatri=(Number($('#s30').val())*100+10)/100;
                                $('#s30').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s03').val())*100-10)/100;
                                $('#s03').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru31').click(function(){
                                var giatri=(Number($('#s31').val())*100-10)/100;
                                $('#s31').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s13').val())*100+10)/100;
                                $('#s13').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong31').click(function(){
                                var giatri=(Number($('#s31').val())*100+10)/100;
                                $('#s31').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s13').val())*100-10)/100;
                                $('#s13').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#tru32').click(function(){
                                var giatri=(Number($('#s32').val())*100-10)/100;
                                $('#s32').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s23').val())*100+10)/100;
                                $('#s23').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#cong32').click(function(){
                                var giatri=(Number($('#s32').val())*100+10)/100;
                                $('#s32').val(giatri.toFixed(2));
                                var giatringuoc=(Number($('#s23').val())*100-10)/100;
                                $('#s23').val(giatringuoc.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            
                            
                            $('#notru01').click(function(){
                                var giatri=(Number($('#s01').val())*100-10)/100;
                                $('#s01').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong01').click(function(){
                                var giatri=(Number($('#s01').val())*100+10)/100;
                                $('#s01').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru02').click(function(){
                                var giatri=(Number($('#s02').val())*100-10)/100;
                                $('#s02').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong02').click(function(){
                                var giatri=(Number($('#s02').val())*100+10)/100;
                                $('#s02').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru03').click(function(){
                                var giatri=(Number($('#s03').val())*100-10)/100;
                                $('#s03').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong03').click(function(){
                                var giatri=(Number($('#s03').val())*100+10)/100;
                                $('#s03').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            $('#notru10').click(function(){
                                var giatri=(Number($('#s10').val())*100-10)/100;
                                $('#s10').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong10').click(function(){
                                var giatri=(Number($('#s10').val())*100+10)/100;
                                $('#s10').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru12').click(function(){
                                var giatri=(Number($('#s12').val())*100-10)/100;
                                $('#s12').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong12').click(function(){
                                var giatri=(Number($('#s12').val())*100+10)/100;
                                $('#s12').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru13').click(function(){
                                var giatri=(Number($('#s13').val())*100-10)/100;
                                $('#s13').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong13').click(function(){
                                var giatri=(Number($('#s13').val())*100+10)/100;
                                $('#s13').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            $('#notru20').click(function(){
                                var giatri=(Number($('#s20').val())*100-10)/100;
                                $('#s20').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong20').click(function(){
                                var giatri=(Number($('#s20').val())*100+10)/100;
                                $('#s20').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru21').click(function(){
                                var giatri=(Number($('#s21').val())*100-10)/100;
                                $('#s21').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong21').click(function(){
                                var giatri=(Number($('#s21').val())*100+10)/100;
                                $('#s21').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru23').click(function(){
                                var giatri=(Number($('#s23').val())*100-10)/100;
                                $('#s23').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong23').click(function(){
                                var giatri=(Number($('#s23').val())*100+10)/100;
                                $('#s23').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru30').click(function(){
                                var giatri=(Number($('#s30').val())*100-10)/100;
                                $('#s30').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong30').click(function(){
                                var giatri=(Number($('#s30').val())*100+10)/100;
                                $('#s30').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru31').click(function(){
                                var giatri=(Number($('#s31').val())*100-10)/100;
                                $('#s31').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong31').click(function(){
                                var giatri=(Number($('#s31').val())*100+10)/100;
                                $('#s31').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#notru32').click(function(){
                                var giatri=(Number($('#s32').val())*100-10)/100;
                                $('#s32').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            $('#nocong32').click(function(){
                                var giatri=(Number($('#s32').val())*100+10)/100;
                                $('#s32').val(giatri.toFixed(2));
                                tinhtoanlai();
                            });
                            
                            
                            
                            $('#tru4').click(function(){
                                var giatri=(Number($('#s4').val())*100-10)/100;;$('#s4').val(giatri.toFixed(2));tinhtoanlai();
                            });
                            $('#cong4').click(function(){
                                var giatri=(Number($('#s4').val())*100+10)/100;;$('#s4').val(giatri.toFixed(2));tinhtoanlai();
                            });
                        })
              </script>
              <p>Tổng: <b id="Tongtren"></b></p>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru00">-</span>
                <input type="text" id="s00" name="s00" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="cong00">0:0</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru11">-</span>
                <input type="text" id="s11" name="s11" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="cong11">1:1</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru22">-</span>
                <input type="text" id="s22" name="s22" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="cong22">2:2</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru33">-</span>
                <input type="text" id="s33" name="s33" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="cong33">3:3</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru01">-</span>
                <span class="input-group-addon" id="notru01">--</span>
                <input type="text" id="s01" name="s01" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong01">+</span>
                <span class="input-group-addon" id="cong01">0:1</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru10">-</span>
                <span class="input-group-addon" id="notru10">--</span>
                <input type="text" id="s10" name="s10" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong10">+</span>
                <span class="input-group-addon" id="cong10">1:0</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru02">-</span>
                <span class="input-group-addon" id="notru02">--</span>
                <input type="text" id="s02" name="s02" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong02">+</span>
                <span class="input-group-addon" id="cong02">0:2</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru20">-</span>
                <span class="input-group-addon" id="notru20">--</span>
                <input type="text" id="s20" name="s20" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong20">+</span>
                <span class="input-group-addon" id="cong20">2:0</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru03">-</span>
                <span class="input-group-addon" id="notru03">--</span>
                <input type="text" id="s03" name="s03" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong03">+</span>
                <span class="input-group-addon" id="cong03">0:3</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru30">-</span>
                <span class="input-group-addon" id="notru30">--</span>
                <input type="text" id="s30" name="s30" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong30">+</span>
                <span class="input-group-addon" id="cong30">3:0</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru12">-</span>
                <span class="input-group-addon" id="notru12">--</span>
                <input type="text" id="s12" name="s12" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong12">+</span>
                <span class="input-group-addon" id="cong12">1:2</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru21">-</span>
                <span class="input-group-addon" id="notru21">--</span>
                <input type="text" id="s21" name="s21" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong21">+</span>
                <span class="input-group-addon" id="cong21">2:1</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru13">-</span>
                <span class="input-group-addon" id="notru13">--</span>
                <input type="text" id="s13" name="s13" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong13">+</span>
                <span class="input-group-addon" id="cong13">1:3</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru31">-</span>
                <span class="input-group-addon" id="notru31">--</span>
                <input type="text" id="s31" name="s31" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong31">+</span>
                <span class="input-group-addon" id="cong31">3:1</span>
              </div>
              </div>
              
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru23">-</span>
                <span class="input-group-addon" id="notru23">--</span>
                <input type="text" id="s23" name="s23" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong23">+</span>
                <span class="input-group-addon" id="cong23">2:3</span>
              </div>
              </div>
              
              
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru32">-</span>
                <span class="input-group-addon" id="notru32">--</span>
                <input type="text" id="s32" name="s32" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="nocong32">+</span>
                <span class="input-group-addon" id="cong32">3:2</span>
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="tru4">-</span>
                <input type="text" id="s4" name="s4" class="form-control" value="0" placeholder="Phần trăm"/>
                <span class="input-group-addon" id="cong4">4++</span>
              </div>
              </div>
              <p>Tổng: <b id="Tong"></b></p>
              <div class="form-group text-left">
              <label style="">Thời gian:</label>
              <div class="clearfix"></div>
              <input type="number" style="width: 20%; float: left;" name="gio" class="form-control" required="" value="" placeholder="Giờ"/>
              <input type="number" style="width: 20%; float: left;" name="phut" class="form-control" required="" value="" placeholder="Phút"/>
              <input type="number" style="width: 20%; float: left;" name="ngay" class="form-control" value="<?=date('d')?>" placeholder="Ngày"/>
              <input type="number" style="width: 20%; float: left;" name="thang" class="form-control" value="<?=date('m')?>" placeholder="Tháng"/>
              <input type="number" style="width: 20%; float: left;" name="nam" class="form-control" value="<?=date('Y')?>" placeholder="Năm"/>
              <div class="clearfix"></div>
              </div>
              <button type="submit" name="taotran" class="btn btn-default">Tạo trận</button>
            
            </form>
                <?
                }else{
                ?>
            
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Trận đấu 
                <a style="float: right;font-size: 12px;" href="/m/admin/?s=trandau&tao=1">Tạo mới</a>
                </h4>
                <hr />
           
            <style>
            table.doi{}
            table.doi th{
                text-align: center;
                font-size: 12px;
                background: gray;
                color: white;
                padding: 8px 0;
            }
            table.doi td{
                text-align: center;
                padding: 10px 0;
            }
            table.doi td span{cursor: pointer;}
            </style>
            <?
            
            $tran=@mysql_query("select * from trandau where trangthai<=3 order by time asc");
            while($rtran=@mysql_fetch_assoc($tran)){
                $giai=@mysql_fetch_assoc(@mysql_query("select * from giadau where id=$rtran[giai]"));
                $doi1=@mysql_fetch_assoc(@mysql_query("select * from doibong where id=$rtran[doi1]"));
                $doi2=@mysql_fetch_assoc(@mysql_query("select * from doibong where id=$rtran[doi2]"));
            ?>
            
                    <div class="boxitem">
                    <div class="one">
                        <img style="width: 50px;float: none;" src="<?=$doi1['logo']?>" />
                        <p><?=$doi1['ten']?></p>
                    </div>
                    <div class="two">
                        <h4><i class="far fa-futbol"></i> <?=$giai['ten']?></h4>
                        <p class="timego"><span><?if($rtran['gio']<10){echo '0'.$rtran['gio'];}else{echo $rtran['gio'];}?>:<?if($rtran['phut']<10){echo '0'.$rtran['phut'];}else{echo $rtran['phut'];}?></span> - <?if($rtran['ngay']<10){echo '0'.$rtran['ngay'];}else{echo $rtran['ngay'];}?>/<?if($rtran['thang']<10){echo '0'.$rtran['thang'];}else{echo $rtran['thang'];}?>/<?=$rtran['nam']?></p>
                        
                    </div>
                    <div class="three">
                        <img style="width: 50px;float: none;" src="<?=$doi2['logo']?>" />
                        <p><?=$doi2['ten']?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="scorenow">
                        <div class="one">
                            <p class="tss" id="team1_<?=$rtran['id']?>"><?if($rtran['trangthai']==0){echo '-';}elseif($rtran['trangthai']==1){echo $rtran['ketqua1'];}?></p>
                        </div>
                        <div class="two">
                            <h5 class="acnow" id="thongbaotrangthai<?=$rtran['id']?>"><?if($rtran['trangthai']==0){echo 'Sắp diễn ra';}elseif($rtran['trangthai']==1){echo 'Đang diễn ra <img style="float: none;height: 20px;width: 20px;margin: 0;" src="i/Red_circle.gif"/>';}?></h5>
                            <p class="cssr">***</p>
                        </div>
                        <div class="three">
                            <p class="tss" id="team2_<?=$rtran['id']?>"><?if($rtran['trangthai']==0){echo '-';}elseif($rtran['trangthai']==1){echo $rtran['ketqua2'];}?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <table id="supdatescore<?=$rtran['id']?>" style="text-align: center; width: 100%;margin-top: 15px;">
                        <tr>
                            <td><button type="button" id="cong11<?=$rtran['id']?>" class="btn btn-success">+ 1 bàn</button><button id="accong11<?=$rtran['id']?>" style="display: none;" type="button" class="btn btn-success">Xác nhận</button></td>
                            <td><button type="button" id="ketthuc<?=$rtran['id']?>" class="btn btn-danger">Kết thúc</button><button id="acketthuc<?=$rtran['id']?>" style="display: none;" type="button" class="btn btn-danger">Xác nhận</button></td>
                            <td><button type="button" id="cong12<?=$rtran['id']?>" class="btn btn-success">+ 1 bàn</button><button id="accong12<?=$rtran['id']?>" style="display: none;" type="button" class="btn btn-success">Xác nhận</button></td>
                        </tr>
                    </table>
                </div>
                <div class="clearfix"></div>
            <script>
            $('body').ready(function(){
                $('#cong11<?=$rtran['id']?>').click(function(){
                    $('#accong11<?=$rtran['id']?>').show();
                    $('#cong11<?=$rtran['id']?>').hide();
                });
                $('#cong12<?=$rtran['id']?>').click(function(){
                    $('#accong12<?=$rtran['id']?>').show();
                    $('#cong12<?=$rtran['id']?>').hide();
                });
                $('#ketthuc<?=$rtran['id']?>').click(function(){
                    $('#acketthuc<?=$rtran['id']?>').show();
                    $('#ketthuc<?=$rtran['id']?>').hide();
                });
                // xác nhận
                $('#accong11<?=$rtran['id']?>').click(function(){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : { 
                            typeform : 'tangtyso_update_doi1',
                            score : <?=$rtran['id']?>
                        },
                        success : function (data1){
                            $('#team1_<?=$rtran['id']?>').html(data1);
                        }
                    });
                });
                $('#accong12<?=$rtran['id']?>').click(function(){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : { 
                            typeform : 'tangtyso_update_doi2',
                            score : <?=$rtran['id']?>
                        },
                        success : function (data1){
                            $('#team2_<?=$rtran['id']?>').html(data1);
                        }
                    });
                });
                $('#acketthuc<?=$rtran['id']?>').click(function(){
                    $.ajax({
                        url : "./ajax.php", 
                        type : "post",
                        dateType:"text",
                        data : { 
                            typeform : 'ketthuc_update_tran',
                            score : <?=$rtran['id']?>
                        },
                        success : function (data1){
                            $('#thongbaotrangthai<?=$rtran['id']?>').html(data1);
                            $('#supdatescore<?=$rtran['id']?>').hide();
                            setTimeout(function(){
                                window.location="/m/admin/?s=trandau";
                            },1000);
                        }
                    });
                });
            })
            </script>
            
            <?}}?>
            <?}elseif(isset($_GET['s']) and $_GET['s']=='baiviet'){
                if(isset($_GET['tao'])){
                ?>
            <h4 class="nameunhead text-left"><a href="/m/admin/?s=baiviet"><i class="fas fa-arrow-circle-left"></i></a> Tạo bài viết</h4>
            <hr />
            <div class="text-left">
            <?
            
                if(isset($_POST['tao'])){
                    $ten=addslashes($_POST['ten']);
                    $link=addslashes($_POST['link']);
                    $menu=intval($_POST['menu']);
                    $video=addslashes($_POST['video']);
                    $noidung=addslashes($_POST['noidung']);
                        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
                        $tenanh=$_FILES['image']['name'];
                        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                        $tenanh=time().$tenanh;
                        move_uploaded_file($_FILES['image']['tmp_name'],"upload/post/".$tenanh);
                        }else{$tenanh="";}
                        // xong ảnh
                        $in="insert into baiviet (ten,link,menu,anh,noidung,video,time)value
                        (N'$ten','$link',$menu,'$tenanh',N'$noidung',N'$video',$time)";
                        $q=mysql_query($in);
                        if($q){
                            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Tạo bài viết thành công.</div>';
                        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, tạo bài viết chưa thành công, vui lòng làm lại.</div>';}
                }
            ?>
            <style>.main{max-width: 100% !important; text-align: left;}</style>
            <script type="text/javascript" src="ciik/ckeditor.js"></script>
            <link type="text/css" href="ciik/_samples/sample.css"/>
            <?=$thongbao?>
            <form role="form" action="" method="post" enctype="multipart/form-data">

              <div class="form-group">
            
                <label>Tiêu đề</label>
            
                <input type="text" class="form-control" required="" name="ten" />
            
              </div>
            
              <div class="form-group">
            
                <label>Link</label>
            
                <input type="text" name="link" required="" class="form-control"/>
            
              </div>
             <div class="form-group">
            
                <label>Menu</label>
            
                <select class="form-control" name="menu">
                    <option value="0">Không chọn</option>
                    <?$mn=@mysql_query("select * from menu order by thutu asc");while($rm=@mysql_fetch_assoc($mn)){?>
                      <option value="<?=$rm['id']?>"><?=$rm['ten']?></option>
                    <?}?>
                </select>
            
              </div>
              <div class="form-group">
            
                <label for="exampleInputFile">Ảnh đại diện</label>
            
                <input type="file" required="" name="image" />
            
                
              </div>
            <div class="form-group">
            
                <label>Nội dung</label>
            
                <textarea class="form-control" required="" name="noidung" id="noidung" rows="3"></textarea>
            <script type="text/javascript">
                    CKEDITOR.replace( 'noidung',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
              </div>
              <div class="form-group">
            
                <label>Video (nếu có)</label>
            
                <input type="text" name="video" class="form-control"/>
            
              </div>
            
              <button type="submit" name="tao" class="btn btn-default">Đăng</button>
            
            </form>
            </div>
            <?
            }elseif(isset($_GET['edit'])){
                $idedit=intval($_GET['edit']);
                $edit=@mysql_fetch_assoc(@mysql_query("select * from baiviet where id=$idedit"));
                if(isset($_POST['sua'])){
                    $ten=addslashes($_POST['ten']);
                    $link=addslashes($_POST['link']);
                    $menu=intval($_POST['menu']);
                    $video=addslashes($_POST['video']);
                    $noidung=addslashes($_POST['noidung']);
                        if($_FILES['image']['name'] and kiem_tra_anh($_FILES['image']['name'])==1){
                        $tenanh=$_FILES['image']['name'];
                        $tenanh = preg_replace('/[^a-zA-Z0-9.]/','-',$tenanh);
                        $tenanh=time().$tenanh;
                        move_uploaded_file($_FILES['image']['tmp_name'],"upload/post/".$tenanh);
                        }else{$tenanh=$edit['anh'];}
                        // xong ảnh
                        $in="update baiviet set ten=N'$ten',link='$link',menu=$menu,anh='$tenanh',noidung=N'$noidung',video=N'$video' where id=$idedit";
                        $q=mysql_query($in);
                        if($q){
                            $thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#00CECE">Sửa bài viết thành công.</div>';
                            $edit=@mysql_fetch_assoc(@mysql_query("select * from baiviet where id=$idedit"));
                        }else{$thongbao='<div style="width:100%; margin: 0 auto; text-align:center;color:#FF3E3E">Có lỗi, sửa bài viết chưa thành công, vui lòng làm lại.</div>';}
                }
            ?>
            <h4 class="nameunhead text-left"><a href="/m/admin/?s=baiviet"><i class="fas fa-arrow-circle-left"></i></a> Sửa bài viết</h4>
            <hr />
            <div class="text-left">
            <style>.main{max-width: 100% !important; text-align: left;}</style>
            <script type="text/javascript" src="ciik/ckeditor.js"></script>
            <link type="text/css" href="ciik/_samples/sample.css"/>
            <?=$thongbao?>
            <form role="form" action="" method="post" enctype="multipart/form-data">

              <div class="form-group">
            
                <label>Tiêu đề</label>
            
                <input type="text" class="form-control" required="" name="ten" value="<?=$edit['ten']?>" />
            
              </div>
            
              <div class="form-group">
            
                <label>Link</label>
            
                <input type="text" name="link" required="" value="<?=$edit['link']?>" class="form-control"/>
            
              </div>
             <div class="form-group">
            
                <label>Menu</label>
            
                <select class="form-control" name="menu">
                    <option value="0">Không chọn</option>
                    <?$mn=@mysql_query("select * from menu order by thutu asc");while($rm=@mysql_fetch_assoc($mn)){?>
                      <option <?if($rm['id']==$edit['menu']){echo 'selected=""';}?> value="<?=$rm['id']?>"><?=$rm['ten']?></option>
                    <?}?>
                </select>
            
              </div>
              <img src="upload/post/<?=$edit['anh']?>" style="width: auto; height: 80px;" />
              <div class="clearfix"></div>
              <div class="form-group">
            
                <label for="exampleInputFile">Ảnh đại diện</label>
            
                <input type="file" name="image" />
            
                
              </div>
            <div class="form-group">
            
                <label>Nội dung</label>
            
                <textarea class="form-control" required="" name="noidung" id="noidung" rows="3"><?=$edit['noidung']?></textarea>
            <script type="text/javascript">
                    CKEDITOR.replace( 'noidung',
                    {
                    toolbar: [
                        { name: 'document', items : [ 'Source'] },
                        { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                        { name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
                        { name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
                        
                        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                        
                        
                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                        { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
                    ]
                    });
                </script>
              </div>
              <div class="form-group">
            
                <label>Video (nếu có)</label>
            
                <input type="text" name="video" value="<?=$edit['video']?>" class="form-control"/>
            
              </div>
            
              <button type="submit" name="sua" class="btn btn-default">Sửa</button>
            
            </form>
            </div>
            <?
            }else{
            ?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> List bài viết <a style="float: right; font-size: 12px;" href="/m/admin/?s=baiviet&tao=1">Tạo mới</a></h4>
            <hr />
            <div class="text-left">
            <?
            $tbv=@mysql_query("select * from baiviet order by time desc");
            while($bv=@mysql_fetch_assoc($tbv)){
                if($bv['menu']==0){
                    $dm='<span title="Không danh mục">nonlist</span>';
                }else{
                    $dnm=@mysql_fetch_assoc(@mysql_query("select ten,link from menu where id=$bv[menu]"));
                    $dm='<span title="'.$dnm['ten'].'">'.$dnm['link'].'</span>';
                }
            ?>
            
            <div class="giaidau" style="border: 1px solid silver; padding: 15px; margin: 15px auto; border-radius: 8px;">
                <img src="upload/post/<?=$bv['anh']?>" style="width: 25%; float: left;" />
                <div style="width: 72%; float: right;">
                    <h4 style="font-size: 15px;margin-bottom: 0;"><?=$bv['ten']?></h4>
                    <p>/post/<?=$dm?>/<?=$bv['link']?>/</p>
                    <p><a type="button" class="btn btn-warning btn-xs" href="/m/admin/?s=baiviet&edit=<?=$bv['id']?>">Sửa</a> - <a type="button" class="btn btn-danger btn-xs">Xóa</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <?}?>
            </div>
            <?}?>
            <?}elseif(isset($_GET['s']) and $_GET['s']=='setup'){?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Tham số</h4>
            <hr />
            <div class="text-left">
                <?
                $amin=@mysql_fetch_assoc(@mysql_query("select * from admin where id=1"));
                if(isset($_POST['update'])){
                    $btcusdnap=intval($_POST['btcusdnap']);
                    $btcusdrut=intval($_POST['btcusdrut']);
                    $phantramcuoc=intval($_POST['phantramcuoc']);
                    if(isset($_POST['blockweb'])){$blockweb=$_POST['blockweb'];}else{$blockweb=$amin['blockweb'];}
                    if(isset($_POST['blockrut'])){$blockrut=$_POST['blockrut'];}else{$blockrut=$amin['blockrut'];}
                    $upp=@mysql_query("update admin set btcusdnap=$btcusdnap,btcusdrut=$btcusdrut,phantramcuoc=$phantramcuoc,blockweb=$blockweb,blockrut=$blockrut where id=1");
                    if($upp){
                        $amin=@mysql_fetch_assoc(@mysql_query("select * from admin where id=1"));
                    }else{
                        echo "Erorr";
                    }
                }
                ?>
                <form role="form" action="" method="post">

                  <div class="form-group">
                    <label>BTC - USD nạp</label>
                    <input type="number" name="btcusdnap" class="form-control" value="<?=$amin['btcusdnap']?>" />
                  </div>
                    <div class="form-group">
                    <label>BTC - USD rút</label>
                    <input type="number" name="btcusdrut" class="form-control" value="<?=$amin['btcusdrut']?>" />
                  </div>
                  <div class="form-group">
                    <label>Phần trăm cược</label>
                    <input type="number" name="phantramcuoc" class="form-control" value="<?=$amin['phantramcuoc']?>" />
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="blockweb" <?if($amin['blockweb']==1){echo 'checked=""';}?>/> Block website
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="blockrut" <?if($amin['blockrut']==1){echo 'checked=""';}?>/> Block rút tiền
                    </label>
                  </div>
                  <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
                
                </form>
            </div>    
            <?}elseif(isset($_GET['s']) and $_GET['s']=='ungtien'){?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Ứng tiền</h4>
            <hr />
            <div class="text-left"></div>     
            <?}elseif(isset($_GET['s']) and $_GET['s']=='thanhvien'){?>
            <style>
            table.uro{width: 100%; line-height: 30px; margin: 15px auto;}
            </style>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Thành viên</h4>
            <hr />
            <div class="text-left">
                <?
                $tbv=@mysql_query("select * from usernot order by time desc");
                while($bv=@mysql_fetch_assoc($tbv)){
                ?>
                
                <div class="giaidau" style="border: 1px solid silver; padding: 15px; margin: 15px auto; border-radius: 8px;">
                    
                        <h4 style="font-size: 15px;margin-bottom: 0;"><b><?=$bv['usernamenot']?></b> (#<?=$bv['id']?> Level: <?=$bv['levelnot']?>/8)</h4>
                        <table class="uro">
                            <tr>
                                <td>Số dư: <?=$bv['tien']?>$</td><td>Đóng băng: <?=$bv['tien_dongbang']?>$</td>
                            </tr>
                            <tr>
                                <td>ĐK: <?=retime($bv['time'])?></td><td>Ứng tiền: <?=$bv['tien_ung']?>$</td>
                            </tr>
                        </table>
                        <p><a type="button" class="btn btn-warning btn-xs" href="/m/admin/?s=baiviet&edit=<?=$bv['id']?>">Sửa</a> - <a type="button" class="btn btn-danger btn-xs">Xóa</a></p>
                        <p class="text-center"><i style="cursor: pointer;" id="down<?=$bv['id']?>" class="fas fa-angle-down"></i><i style="display: none;cursor: pointer;" id="up<?=$bv['id']?>" class="fas fa-angle-up"></i></p>
                        <table id="showthem<?=$bv['id']?>" class="uro" style="display: none;">
                            <tr>
                                <td>Tổng 1: <?$tong1=@mysql_fetch_assoc(@mysql_query("select id,usernamenot from usernot where id=$bv[idtong1]"));echo '<span title="('.$tong1['id'].')">@'.$tong1['usernamenot'].'</span>';?></td>
                                <td>Tổng 2: <?$tong2=@mysql_fetch_assoc(@mysql_query("select id,usernamenot from usernot where id=$bv[idtong2]"));echo '<span title="('.$tong2['id'].')">@'.$tong2['usernamenot'].'</span>';?></td>
                            </tr>
                            <tr>
                                <td>Đã nạp: <?=$bv['tien_danap']?>$</td><td>Đã rút: <?=$bv['tien_darut']?>$</td>
                            </tr>
                            <tr>
                                <td>Tiền lãi: <?=$bv['tien_lai']?>$</td><td>Hoa hồng HT: <?=$bv['tien_hoahong']?>$</td>
                            </tr>
                            <tr>
                            <?$up1=@mysql_fetch_assoc(@mysql_query("select id,usernamenot from usernot where id=$bv[upline1]"));?>
                            <?$up2=@mysql_fetch_assoc(@mysql_query("select id,usernamenot from usernot where id=$bv[upline2]"));?>
                            <?$up3=@mysql_fetch_assoc(@mysql_query("select id,usernamenot from usernot where id=$bv[upline3]"));?>
                                <td colspan="2">Upline: <?echo '<span title="(#'.$up3['id'].')">@'.$up3['usernamenot'].'</span>/<span title="(#'.$up2['id'].')">@'.$up2['usernamenot'].'</span>/<span title="(#'.$up1['id'].')">@'.$up1['usernamenot'].'</span>';?></td>
                            </tr>
                        </table>
                        <script>
                            $('body').ready(function(){
                                $('#down<?=$bv['id']?>').click(function(){
                                    $('#showthem<?=$bv['id']?>').show();
                                    $('#down<?=$bv['id']?>').hide();
                                    $('#up<?=$bv['id']?>').show();
                                });
                                $('#up<?=$bv['id']?>').click(function(){
                                    $('#showthem<?=$bv['id']?>').hide();
                                    $('#down<?=$bv['id']?>').show();
                                    $('#up<?=$bv['id']?>').hide();
                                });
                            })
                            </script>
                </div>
                
                <?}?>
            </div> 
            <?}elseif(isset($_GET['s']) and $_GET['s']=='taichinh'){?>
            <h4 class="nameunhead text-left"><a href="/m/admin/"><i class="fas fa-arrow-circle-left"></i></a> Tài chính</h4>
            <hr />
            <div class="text-left"></div> 
            <?}else{?>
                <img src="i/admin-1.jpg" />
                
                <div class="regulation admin">
                <table style="width: 100%;">
                    <tr>
                        <td><h3><a href="/m/admin/?s=setup">Tham số</a></h3></td>
                        <td><h3><a href="/m/admin/?s=naptien">Nạp tiền</a></h3></td>
                        <td><h3><a href="/m/admin/?s=ruttien">Rút tiền</a></h3></td>
                    </tr>
                    <tr>
                        <td><h3><a href="/m/admin/?s=ungtien">Ứng tiền</a></h3></td>
                        <td><h3><a href="/m/admin/?s=trandau">Trận đấu</a></h3></td>
                        <td><h3><a href="/m/admin/?s=giaidau">Giải đấu</a></h3></td>
                    </tr>
                    <tr>
                        <td><h3><a href="/m/admin/?s=baiviet">Bài viết</a></h3></td>
                        <td><h3><a href="/m/admin/?s=thanhvien">Thành viên</a></h3></td>
                        <td><h3><a href="/m/admin/?s=taichinh">Tài chính</a></h3></td>
                    </tr>
                </table>
                </div>
            <?}?>
                <p>&nbsp;</p>
            </div>
        </div>
     