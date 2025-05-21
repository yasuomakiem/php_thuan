<?php
//cập nhật lại cấp bậc Rank
/*
1. TPKD: 40/20/20 : 2%
2. GĐKD: 80/40/40 : 3%
3. GĐKC: 160/80/80 : 4%
4. CEO: 320/160/160 : 5%
*/

?>
<link rel="Stylesheet" href="css/giaphahp.css" type="text/css" />
<style>
.filetree i.fas{
    color: #a6a5a5;
    cursor: pointer;
}
</style>
<script type="text/javascript" src="js/jquery.treeview.min.js"></script>
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/treemap.png" />
                <div class="dealright">
                <p><b>Sơ đồ cây hệ thống</b></p>
                <?php
                $themdk='';
                /*if(!isset($_GET['m']) or $_GET['m']=='active'){
                    $themdk='and vip=1';
                }elseif($_GET['m']=='noactive'){
                    $themdk='and vip=0';
                }elseif($_GET['m']=='all'){
                    $themdk='and vip>=0';
                }elseif($_GET['m']=='waiting'){
                    $themdk='and vip=-1';
                }*/

                if(!isset($_GET['start'])){
                    $idv0=$u['id'];
                    $namecay=$u['fullname'];
                }else{
                    $idv0=intval($_GET['start']);
                    $timname=@mysqli_fetch_assoc(@mysqli_query($con,"select fullname,idgioithieu from dh_user where id=$idv0"));
                    $namecay=$timname['fullname'];
                }
                $sll=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where hethong like '%*$idv0*%' $themdk"));
                ?>
                <p style="font-size: 0.88em;">
                Tổng số: <b><?php echo $sll?></b> thành viên
                </p>
                </div>
                <div class="clearfix"></div> 
            </div>
            <div class="boxland">
            <div id="nomal">
            <?php
            if($u['id']==1 or $u['level']>1){
                $sonhanh=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idgioithieu=$u[id]"));
                $sof1=@mysqli_num_rows(@mysqli_query($con,"select id from dh_user where idtructiep=$u[id]"));
            ?>
            <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 10px; margin-top: 30px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;">Đội nhóm của tôi</span> </h3>
            <style>
            p.vee{
                margin-bottom: 23px;
                font-family: "UT", Arial, Helvetica, sans-serif;
                font-size: 16px;
            }
            p.vee a{color: #9d9b9b;}
            p.vee a.acca{
                border-bottom: 3px solid;
                padding-bottom: 5px;
                color: teal;
            }
            </style>
            <p class="vee"><a <?php if(!isset($_GET['f1']) and !isset($_GET['nhanh'])){echo ' class="acca"';}?> href="/m/hethong/" style="margin-right: 15px;">Tất cả hệ thống</a> 
            <a <?php if(isset($_GET['nhanh'])){echo ' class="acca"';}?> style="margin-right: 15px;" href="/m/hethong/?nhanh">Thống kê nhánh<sup style="color: red;">(<?php echo $sonhanh;?>)</sup></a> 
            <a <?php if(isset($_GET['f1'])){echo ' class="acca"';}?> href="/m/hethong/?f1">Trực tiếp F1<sup style="color: red;">(<?php echo $sof1;?>)</sup></a></p>
            <?php }else{?>
            <h3 class="titUT" style="font-size: 17px;text-transform: none;margin-bottom: 17px;"><a href="/m/cpanel/" style="color: #333;"><i class="fas fa-arrow-left"></i> Cpanel </a> / <span style="color: red;">Đội nhóm của tôi</span> </h3>
            <?php
            }
            if(($u['id']==1 or $u['level']>1) and !isset($_GET['f1']) and !isset($_GET['nhanh'])){
            ?>
            <div class="cay">
            <div class="uptree">
                
            </div>
            <?php if(!isset($_GET['start']) or $_GET['start']==$u['id']){echo '<i style="color: cornflowerblue;" class="fas fa-funnel-dollar fa-2x"></i>';}else{
            ?>
            <a href="m/hethong/?start=<?php echo $timname['idgioithieu']?>"  type="button" class="btn btn-primary btn-xs"><i class="fas fa-angle-left"></i> Lùi lại</a>
            <?php
            }?>
            <ul style="margin-left: 10px;" id="foldertree" class="filetree">
            <li>
                <span class="male" id="iduser_1"> &nbsp; <a style="text-decoration: none; color: #004040; font-weight: bold;" href="/m/hethong/?start=<?php echo $idv0?>"> <?php echo $namecay?></a></span>
                <ul>
                <?php
                $v0=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv0 $themdk");
                while($rv0=@mysqli_fetch_assoc($v0)){
                    $idv1=$rv0['id'];
                    $v1=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv1 $themdk");
                    $slv1=@mysqli_num_rows($v1);
                    if($rv0=='nu'){$gender='female';}else{$gender='male';}
                ?>
                    <li<?php if($slv1>30){echo ' class="closed"';}?>>
                        <span class="<?php echo $gender?>" id="3"> &nbsp; <a href="/m/hethong/?start=<?php echo $rv0['id']?>"> <?php echo $rv0['fullname']?></a> &nbsp; <i onclick="showthongtin(<?php echo $rv0['id']?>)" class="fas fa-info-circle"></i></span>
                        <?php if($slv1>0){?>
                        <ul>
                        <?php
                        while($rv1=@mysqli_fetch_assoc($v1)){
                        $idv2=$rv1['id'];
                        $v2=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv2 $themdk");
                        $slv2=@mysqli_num_rows($v2);
                        if($rv1['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                        ?>
                            <li<?php if($slv2>0){echo ' class="closed"';}?>>
                            <span class="<?php echo $gender?>" id="3"> &nbsp; <a href="/m/hethong/?start=<?php echo $rv1['id']?>"> <?php echo $rv1['fullname']?></a></span> &nbsp; <i onclick="showthongtin(<?php echo $rv1['id']?>)" class="fas fa-info-circle"></i>
                                <?php if($slv2>0){?>
                                <ul>
                                <?php
                                while($rv2=@mysqli_fetch_assoc($v2)){
                                $idv3=$rv2['id'];
                                $v3=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv3 $themdk");
                                $slv3=@mysqli_num_rows($v3);
                                if($rv2['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                ?>
                                    <li<?php if($slv3>0){echo ' class="closed"';}?>>
                                    <span class="<?php echo $gender?>" id="3"> &nbsp; <a href="/m/hethong/?start=<?php echo $rv2['id']?>"> <?php echo $rv2['fullname']?></a></span> &nbsp; <i onclick="showthongtin(<?php echo $rv2['id']?>)" class="fas fa-info-circle"></i>
                                        <?php if($slv3>0){?>
                                        <ul>
                                        <?php
                                        while($rv3=@mysqli_fetch_assoc($v3)){
                                        $idv4=$rv3['id'];
                                        $v4=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv4 $themdk");
                                        $slv4=@mysqli_num_rows($v4);
                                        if($rv3['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                        ?>
                                            <li<?php if($slv4>0){echo ' class="closed"';}?>>
                                            <span class="<?php echo $gender?>" id="3"> &nbsp; <a href="/m/hethong/?start=<?php echo $rv3['id']?>"> <?php echo $rv3['fullname']?></a></span> &nbsp; <i onclick="showthongtin(<?php echo $rv3['id']?>)" class="fas fa-info-circle"></i>
                                                <?php if($slv4>0){?>
                                                <ul>
                                                <?php
                                                while($rv4=@mysqli_fetch_assoc($v4)){
                                                $idv5=$rv4['id'];
                                                $v5=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv5 $themdk");
                                                $slv5=@mysqli_num_rows($v5);
                                                if($rv4['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                ?>
                                                    <li<?php if($slv5>0){echo ' class="closed"';}?>>
                                                    <span class="<?php echo $gender?>" id="3"> &nbsp; <a href="/m/hethong/?start=<?php echo $rv4['id']?>"> <?php echo $rv4['fullname']?></a></span> &nbsp; <i onclick="showthongtin(<?php echo $rv4['id']?>)" class="fas fa-info-circle"></i>
                                                        <?php if($slv5>0){?>
                                                        <ul>
                                                        <?php
                                                        while($rv5=@mysqli_fetch_assoc($v5)){
                                                        $idv6=$rv5['id'];
                                                        $v6=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv6 $themdk");
                                                        $slv6=@mysqli_num_rows($v6);
                                                        if($rv5['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                        ?>
                                                            <li<?php if($slv6>0){echo ' class="closed"';}?>>
                                                            <span class="<?php echo $gender?>" id="3"> &nbsp; 
                                                            <a href="/m/hethong/?start=<?php echo $rv5['id']?>"> <?php echo $rv5['fullname']?></a></span> &nbsp; 
                                                            <i onclick="showthongtin(<?php echo $rv5['id']?>)" class="fas fa-info-circle"></i>
                                                                <?php if($slv6>0){?>
                                                                <ul>
                                                                <?php
                                                                while($rv6=@mysqli_fetch_assoc($v6)){
                                                                $idv7=$rv6['id'];
                                                                $v7=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv7 $themdk");
                                                                $slv7=@mysqli_num_rows($v7);
                                                                if($rv6['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                                ?>
                                                                    <li<?php if($slv7>0){echo ' class="closed"';}?>>
                                                                    <span class="<?php echo $gender?>" id="3"> &nbsp; 
                                                                    <a href="/m/hethong/?start=<?php echo $rv6['id']?>"> <?php echo $rv6['fullname']?></a></span> &nbsp; 
                                                                    <i onclick="showthongtin(<?php echo $rv6['id']?>)" class="fas fa-info-circle"></i>
                                                                        <?php if($slv7>0){?>
                                                                        <ul>
                                                                        <?php
                                                                        while($rv7=@mysqli_fetch_assoc($v7)){
                                                                        $idv8=$rv7['id'];
                                                                        $v8=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv8 $themdk");
                                                                        $slv8=@mysqli_num_rows($v8);
                                                                        if($rv7['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                                        ?>
                                                                            <li<?php if($slv8>0){echo ' class="closed"';}?>>
                                                                            <span class="<?php echo $gender?>" id="3"> &nbsp; 
                                                                            <a href="/m/hethong/?start=<?php echo $rv7['id']?>"> <?php echo $rv7['fullname']?></a></span> &nbsp; 
                                                                            <i onclick="showthongtin(<?php echo $rv7['id']?>)" class="fas fa-info-circle"></i>
                                                                                <?php if($slv8>0){?>
                                                                                <ul>
                                                                                <?php
                                                                                while($rv8=@mysqli_fetch_assoc($v8)){
                                                                                $idv9=$rv8['id'];
                                                                                $v9=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv9 $themdk");
                                                                                $slv9=@mysqli_num_rows($v9);
                                                                                if($rv8['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                                                ?>
                                                                                    <li<?php if($slv9>0){echo ' class="closed"';}?>>
                                                                                    <span class="<?php echo $gender?>" id="3"> &nbsp; 
                                                                                    <a href="/m/hethong/?start=<?php echo $rv8['id']?>"> <?php echo $rv8['fullname']?></a></span> &nbsp; 
                                                                                    <i onclick="showthongtin(<?php echo $rv8['id']?>)" class="fas fa-info-circle"></i>
                                                                                        <?php if($slv9>0){?>
                                                                                        <ul>
                                                                                        <?php
                                                                                        while($rv9=@mysqli_fetch_assoc($v9)){
                                                                                        $idv10=$rv9['id'];
                                                                                        $v10=@mysqli_query($con,"select id,fullname,gioitinh from dh_user where idgioithieu=$idv10 $themdk");
                                                                                        $slv10=@mysqli_num_rows($v10);
                                                                                        if($rv9['gioitinh']=='nu'){$gender='female';}else{$gender='male';}
                                                                                        ?>
                                                                                            <li<?php if($slv10>0){echo ' class="closed"';}?>>
                                                                                            <span class="<?php echo $gender?>" id="3"> &nbsp; 
                                                                                            <a href="/m/hethong/?start=<?php echo $rv9['id']?>"> <?php echo $rv9['fullname']?></a></span> &nbsp; 
                                                                                            <i onclick="showthongtin(<?php echo $rv9['id']?>)" class="fas fa-info-circle"></i>
                                                                                            
                                                                                            </li>
                                                                                        <?php }?>
                                                                                        </ul>
                                                                                        <?php }?>
                                                                                    </li>
                                                                                <?php }?>
                                                                                </ul>
                                                                                <?php }?>
                                                                            </li>
                                                                        <?php }?>
                                                                        </ul>
                                                                        <?php }?>
                                                                    </li>
                                                                <?php }?>
                                                                </ul>
                                                                <?php }?>
                                                            </li>
                                                        <?php }?>
                                                        </ul>
                                                        <?php }?>
                                                    </li>
                                                <?php }?>
                                                </ul>
                                                <?php }?> 
                                            </li>
                                        <?php }?>
                                        </ul>
                                        <?php }?>
                                    </li>
                                <?php }?>
                                </ul>
                                <?php }?>
                            </li>
                        <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                <?php }?>
                </ul> 
            </li>
        </ul>
        </div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
$("#foldertree").treeview();
});
//]]>
</script>
<?php 
}else{
?>
<style>
.cay .avt{
    background-size: cover;
    width: 80px;
    height: 80px;
    float: left;
    background-position: center;
    margin: 10px 0 5px 10px;
    border-radius: 50%;
}
.cay .tts {
    width: calc(100% - 105px);width: -moz-calc(100% - 105px);width: -webkit-calc(100% - 105px);
    float: right;
}
.cay .tts h4{
    font-family: "UT", Arial, Helvetica, sans-serif;
}
</style>
<?php
if(isset($_GET['idf1'])){
    if(isset($_GET['code']) and $_GET['code']==$u['pass']){
        $idup=intval($_GET['idf1']);
        $uu=@mysqli_query($con,"update dh_user set vip=2 where id=$idup");
        if($uu){
            echo '
            <script language="JavaScript">
            var my_timeout=setTimeout("gotosite();",0);
            function gotosite()
            {
            window.location="/m/hethong/?f1";
            }
            </script>
            ';// cái này là chuyển trang bằng javascript
            exit();
        }
    }
        $v0=@mysqli_query($con,"select * from dh_user where id=$_GET[idf1]");
        $rv0=@mysqli_fetch_assoc($v0);
        if($rv0['avatar']==''){$av='images/LOGOBIGNET.png';}else{$av='upload/avatar/'.$rv0['avatar'];}
?>
    <div class="cay">
    <div class="avt" style="background-image: url(<?php echo $av?>);"></div>
    <div class="tts">
    <h4><?php echo $rv0['fullname']?></h4>
    <p style="font-size: 0.9em;margin-bottom: 5px;">Tham gia: <?php echo retimefull($rv0['time'])?></p>
    <p style="font-size: 0.95em;">Level: <?php echo capbac($rv0['level']);?></p>
    
    <p class="nut">
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" target="_blank" href='fb://profile/<?php echo $rv0['facebook']?>'>FB</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/<?php echo $rv0['facebook']?>'>FB</a> 
                <?php }?>
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" target="_blank" href='https://fb.com/msg/<?php echo $rv0['facebook']?>'>Mess</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/messages/t/<?php echo $rv0['facebook']?>'>Mess</a> 
                <?php }?>
                <?php if($rv0['tiktok']!=''){?>
                <a type="button" style="background: black;color: white;" class="btn btn-primary btn-xs" target="_blank" href='<?php echo $rv0['tiktok']?>'>Tiktok</a> 
                <?php }?>
                <?php if($rv0['phone']!=''){?><a type="button" class="btn btn-info btn-xs" target="_blank" href='https://zalo.me/<?php echo $rv0['phone']?>'>Zalo</a><?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href='tel:<?php echo $rv0['phone']?>'>Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href='sms:<?php echo $rv0['phone']?>'>SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">SMS</a>
                <?php }?>
    </p>
    </div>
    <div class="clearfix"></div>
    <hr style="margin: 10px 0;" />
    <div style="text-align: justify;line-height: 1.8em;">
    <p>1. Khi kích hoạt người này làm Nhà Quản Lý (NQL), ngay sau đó những đơn hàng do NQL trực tiếp bán sẽ được cộng thêm hoa hồng Hướng dẫn và hoa hồng Quản lý. Chỉ áp dụng với những đơn bán của chính họ.</p>
    <p>2. NQL sẽ nhận được hoa hồng Quản lý của tất cả các đơn hàng phát sinh trong hệ thống dưới NQL bán ra. Điều này tự động áp dụng khi NQL đáp ứng đủ điều kiện có <b><?php echo $ru['dkquanlycapcao']?> Affiliate chính thức</b> trong hệ thống</p>
    <p>3. Affiliate chính thức nghĩa là thành viên đã có <?php echo $ru['dkuserchinhthuc']?> đơn hàng.</p>
    </div>
    <p class="text-center">
        <a href="/m/hethong/?f1&idf1=<?php echo $rv0['id']?>&code=<?php echo $u['pass']?>" type="button" class="btn btn-primary">Xác nhận kích hoạt NQL</a>
    </p>
    <div class="clearfix"></div>
    </div>
<?php 
    }elseif(isset($_GET['f1'])){
        
$v0=@mysqli_query($con,"select * from dh_user where idtructiep=$u[id]");
if(@mysqli_num_rows($v0)==0){
    echo '<div class="cay"><p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png" /></p><p class="text-center">Chưa có thành viên nào do bạn hướng dẫn</p><p>&nbsp;</p></div>';
}else{
while($rv0=@mysqli_fetch_assoc($v0)){
    if($rv0['avatar']==''){$av='images/LOGOBIGNET.png';}else{$av='upload/avatar/'.$rv0['avatar'];}
?>
    <div class="cay">
    <div class="avt" style="background-image: url(<?php echo $av?>);"></div>
    <div class="tts">
    <h4><?php echo $rv0['fullname']?></h4>
    <p style="font-size: 0.9em;margin-bottom: 5px;">Tham gia: <?php echo retimefull($rv0['time'])?></p>
    <p style="font-size: 0.95em;">Level: <?php echo capbac($rv0['level']); ?></p>
    
    <p class="nut">
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" target="_blank" href='fb://profile/<?php echo $rv0['facebook']?>'>FB</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/<?php echo $rv0['facebook']?>'>FB</a> 
                <?php }?>
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" target="_blank" href='https://fb.com/msg/<?php echo $rv0['facebook']?>'>Mess</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/messages/t/<?php echo $rv0['facebook']?>'>Mess</a> 
                <?php }?>
                <?php if($rv0['tiktok']!=''){?>
                <a type="button" style="background: black;color: white;" class="btn btn-primary btn-xs" target="_blank" href='<?php echo $rv0['tiktok']?>'>Tiktok</a> 
                <?php }?>
                <?php if($rv0['phone']!=''){?><a type="button" class="btn btn-info btn-xs" target="_blank" href='https://zalo.me/<?php echo $rv0['phone']?>'>Zalo</a><?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href='tel:<?php echo $rv0['phone']?>'>Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href='sms:<?php echo $rv0['phone']?>'>SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">SMS</a>
                <?php }?>
    </p>
    <hr style="margin: 10px 0;" />
    <table style="width: 100%; font-size: 0.95em;">
    <tr>
    <?php 
    $donp=@mysqli_query($con,"select * from dh_user where hethong like '%$rv0[hethong]*$rv0[id]*%'");
    $ht=@mysqli_num_rows($donp);
    $tru=@mysqli_query($con,"select * from dh_user where idtructiep=$rv0[id]");
    $tructiep=@mysqli_num_rows($tru);
    $npp=@mysqli_query($con,"select * from dh_user where hethong like '%$rv0[hethong]*$rv0[id]*%' and level=2");
    $rpp=@mysqli_num_rows($npp);
    ?>
    <td style="width: 50%;">Hệ thống:&nbsp; <b><?php echo $ht?></b></td><td style="width: 50%;">Trực tiếp:&nbsp; <b><?php echo $tructiep?></b></td>
    </tr>
    <tr>
    <td style="padding: 10px 0;" colspan="2">NPP:&nbsp; <b><?php echo $rpp?></b></td>
    </tr>
    </table>
    
    </div>
    <div class="clearfix"></div>
    </div>
<?php }}
    }elseif(isset($_GET['nhanh'])){
$v0=@mysqli_query($con,"select * from dh_user where idgioithieu=$u[id]");
if(@mysqli_num_rows($v0)==0){
    echo '<div class="cay"><p class="text-center"><img class="fa5" style="float: none;" src="i/5fa.png" /></p><p class="text-center">Chưa có thành viên nào do bạn hướng dẫn</p><p>&nbsp;</p></div>';
}else{
while($rv0=@mysqli_fetch_assoc($v0)){
    if($rv0['avatar']==''){$av='images/LOGOBIGNET.png';}else{$av='upload/avatar/'.$rv0['avatar'];}
?>
    <div class="cay">
    <div class="avt" style="background-image: url(<?php echo $av?>);"></div>
    <div class="tts">
    <h4><?php echo $rv0['fullname']?></h4>
    <p style="font-size: 0.9em;margin-bottom: 5px;">Tham gia: <?php echo retimefull($rv0['time'])?></p>
    <p style="font-size: 0.95em;">Level: <?php echo capbac($rv0['level']); ?></p>
    
    <p class="nut">
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-primary btn-xs hidden-lg hidden-md" target="_blank" href='fb://profile/<?php echo $rv0['facebook']?>'>FB</a> 
                <a type="button" class="btn btn-primary btn-xs  hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/<?php echo $rv0['facebook']?>'>FB</a> 
                <?php }?>
                <?php if($rv0['facebook']!=''){?>
                <a type="button" class="btn btn-success btn-xs hidden-lg hidden-md" target="_blank" href='https://fb.com/msg/<?php echo $rv0['facebook']?>'>Mess</a> 
                <a type="button" class="btn btn-success btn-xs hidden-sm  hidden-xs" target="_blank" href='https://www.facebook.com/messages/t/<?php echo $rv0['facebook']?>'>Mess</a> 
                <?php }?>
                <?php if($rv0['tiktok']!=''){?>
                <a type="button" style="background: black;color: white;" class="btn btn-primary btn-xs" target="_blank" href='<?php echo $rv0['tiktok']?>'>Tiktok</a> 
                <?php }?>
                <?php if($rv0['phone']!=''){?><a type="button" class="btn btn-info btn-xs" target="_blank" href='https://zalo.me/<?php echo $rv0['phone']?>'>Zalo</a><?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-warning btn-xs hidden-lg hidden-md" href='tel:<?php echo $rv0['phone']?>'>Gọi</a>
                <a type="button" class="btn btn-warning btn-xs hidden-sm  hidden-xs" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">Gọi</a>
                <?php }?>
                <?php if($rv0['phone']!=''){?>
                <a type="button" class="btn btn-Primary btn-xs hidden-lg hidden-md" style="background: #607D8B;color: white;" href='sms:<?php echo $rv0['phone']?>'>SMS</a>
                <a type="button" class="btn btn-Primary btn-xs hidden-sm  hidden-xs" style="background: #607D8B;color: white;" onclick="alert('SĐT khách hàng là: <?php echo $rv0['phone']?>');">SMS</a>
                <?php }?>
    </p>
    <hr style="margin: 10px 0;" />
    <table style="width: 100%; font-size: 0.95em;">
    <tr>
    <?php 
    $donp=@mysqli_query($con,"select * from dh_user where hethong like '%$rv0[hethong]*$rv0[id]*%'");
    $ht=@mysqli_num_rows($donp);
    $tru=@mysqli_query($con,"select * from dh_user where idtructiep=$rv0[id]");
    $tructiep=@mysqli_num_rows($tru);
    $npp=@mysqli_query($con,"select * from dh_user where hethong like '%$rv0[hethong]*$rv0[id]*%' and level=2");
    $rpp=@mysqli_num_rows($npp);
    ?>
    <td style="width: 50%;">Hệ thống:&nbsp; <b><?php echo $ht?></b></td><td style="width: 50%;">Trực tiếp:&nbsp; <b><?php echo $tructiep?></b></td>
    </tr>
    <tr>
    <td style="padding: 10px 0;" colspan="2">NPP:&nbsp; <b><?php echo $rpp?></b></td>
    </tr>
    </table>
    
    </div>
    <div class="clearfix"></div>
    </div>
<?php }}}} ?>
<div class="clearfix"></div>
<p>&nbsp;</p>
</div>    
</div>
<div class="clearfix"></div>
</div>
     