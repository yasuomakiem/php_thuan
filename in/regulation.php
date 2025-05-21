<div class="bigmem regulation">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><i class="fas fa-futbol"></i> Quy chế <a style="float: right;font-size: 14px;padding-right: 20px;color: #ff9700;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img style="float: none; width: 100%;" src="i/bru.png" />
                <div style="margin-top: 15px;">
                <?
                $qc=@mysql_query("select * from baiviet where menu=3");
                while($rc=@mysql_fetch_assoc($qc)){
                ?>
                    <h3><a href="/post/<?=$rc['menu']?>/<?=$rc['link']?>/"><i class="fas fa-arrow-circle-right"></i> <?=$rc['ten']?></a></h3>
                <?}?>
                </div>
                
                <p>&nbsp;</p>
            </div>
</div>
     