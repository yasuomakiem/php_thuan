<?php
function layuid($link){
    if (strlen(strstr($link,"facebook")) > 0) {//có chữ fb thi là link full con lại thi kiểm tra xem nó có phải uid không
        if (strlen(strstr($link,"posts")) > 0) {
            $uids=explode("/posts",$link);
            $uid1=$uids[0];
            $uids2=explode("facebook.com/",$uid1);
            $uid=$uids2[1];
            if(intval($uid)>1000000000){
                $uid=intval($uid);
            }else{
                $uid='';
            }
        }elseif (strlen(strstr($link,"&set=")) > 0) {
            $uids=explode("&set=",$link);
            $uid1=$uids[1];
            $uids2=explode(".",$uid1);
            $uid=$uids2[1];
        }elseif (strlen(strstr($link,"story_fbid=")) > 0) {
            $uids=explode("&id=",$link);
            $uid=$uids[1];
        }else{
            $uids=explode("profile.php?id=",$link);
            $uid=$uids[1];
        }
    }else{
        if(intval($link)>1000000000){
            $uid=intval($link);
        }else{
            $uid='';
        }
    }
    $uids=explode(".",$uid);
    $uid=$uids[0];
    $uids=explode("&",$uid);
    $uid=$uids[0];
    $uids=explode("/",$uid);
    $uid=$uids[0];
    if($uid==''){
        $uid=0;
    }else{
    $uid=intval($uid);
    }
    return $uid;
}
function tennhucau($so){
    if($so==0){$rt='N/a';}
    if($so==1){$rt='Cần mua';}
    if($so==2){$rt='Cần bán';}
    if($so==3){$rt='Đầu tư';} 
    return $rt;
}
function tenprice($tex){
    $atex=explode("-",$tex);
    $tu=intval($atex[0]);
    $toi=intval($atex[1]);
    if($toi==0){
        $rt='Không thiết đặt';
    }else{
        if($tu==$toi){
            if($toi<1000){
                $rt='Tầm '.$toi.' triệu';
            }else{
                $rt='Tầm '.($toi/1000).' tỷ';
            }
        }elseif($tu==0){
            if($toi<1000){
                $rt=$toi.' triệu quay đầu';
            }else{
                $rt=($toi/1000).' tỷ quay đầu';
            }
        }else{
            if($tu<1000){
                $rt='Từ '.$tu.' triệu - ';
            }else{
                $rt='Từ '.($tu/1000).' tỷ - ';
            }
            if($toi<1000){
                $rt.=$toi.' triệu';
            }else{
                $rt.=($toi/1000).' tỷ';
            }
        }
    }
    return $rt;
}
function chuyen_khong_dau_gach_ngang ($str){
            $str=rtrim($str);
            $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );
            foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            $str = str_replace('  ',' ',$str);// tìm có 2 dấu cách liền nhau đổi thành 1 dấu để tránh tình trạng trên
            $str = str_replace('  ',' ',$str);// thay thế lần 2 trong trường hợp nó có 3 khoảng cách
            $str = str_replace('  ',' ',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('  ',' ',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            $str = preg_replace('/[^a-zA-Z0-9]/','-',$str);
            $str = str_replace('--','-',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('--','-',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            $str = str_replace('-',' ',$str);
            $str = trim($str);
            $str = str_replace(' ','-',$str);
            $str = strtolower($str);
            return $str;
}
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a:%h:%i:%s');
}
function phantramlevel($level){
    if($level==1){$pt=1;}
    if($level==2){$pt=1.2;}
    if($level==3){$pt=1.4;}
    if($level==4){$pt=1.6;}
    if($level==5){$pt=1.8;}
    if($level==6){$pt=2;}
    if($level==7){$pt=2.2;}
    if($level==8){$pt=2.4;}
    return $pt;
}
function tiso($score){
    if($score=='s00'){$ts='0 - 0';}
    if($score=='s11'){$ts='1 - 1';}
    if($score=='s22'){$ts='2 - 2';}
    if($score=='s33'){$ts='3 - 3';}
    if($score=='s01'){$ts='0 - 1';}
    if($score=='s02'){$ts='0 - 2';}
    if($score=='s03'){$ts='0 - 3';}
    if($score=='s10'){$ts='1 - 0';}
    if($score=='s12'){$ts='1 - 2';}
    if($score=='s13'){$ts='1 - 3';}
    if($score=='s20'){$ts='2 - 0';}
    if($score=='s21'){$ts='2 - 1';}
    if($score=='s23'){$ts='2 - 3';}
    if($score=='s30'){$ts='3 - 0';}
    if($score=='s31'){$ts='3 - 1';}
    if($score=='s32'){$ts='3 - 2';}
    if($score=='s4'){$ts='Trên 4 bàn';}
    return $ts;
}

function khongdau($str){
            $str=rtrim($str);
            $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );
            foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            $str = str_replace('  ',' ',$str);// tìm có 2 dấu cách liền nhau đổi thành 1 dấu để tránh tình trạng trên
            $str = str_replace('  ',' ',$str);// thay thế lần 2 trong trường hợp nó có 3 khoảng cách
            $str = str_replace('  ',' ',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('  ',' ',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            $str = preg_replace('/[^a-zA-Z0-9]/','-',$str);
            $str = str_replace('--','-',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('--','-',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            return $str;
}
function set_name_login ($str){
            $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );
            foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            $str = str_replace('  ',' ',$str);// tìm có 2 dấu cách liền nhau đổi thành 1 dấu để tránh tình trạng trên
            $str = str_replace('  ','',$str);// thay thế lần 2 trong trường hợp nó có 3 khoảng cách
            $str = str_replace('  ','',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('  ','',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            $str = preg_replace('/[^a-zA-Z0-9]/','',$str);
            $str = str_replace('-','',$str);// thay thế lần 3 trong trường hợp nó có 4 khoảng cách
            $str = str_replace('--','',$str);// thay thế lần 4 trong trường hợp nó có 5 khoảng cách
            return strtolower($str);
}

function go_link ($str){
            $str=str_replace('href=','rel="nofollow" href=',$str);
            return $str;
}

function xoa_link ($str){
            $str=str_replace('href=','',$str);
            return $str;
}

function tra_lai_time($time){
            $timekt=$time;
            $timestr=(string)$timekt;
            $nam=substr($timestr,0,4);
            $thang=substr($timestr,4,2);
            $ngay=substr($timestr,6,2);
            $gio=substr($timestr,8,2);
            $phut=substr($timestr,10,2);
            $time=$gio.":".$phut." Ngày ".$ngay."/".$thang."/".$nam;
            //nếu = năm, = tháng, = ngày
            if(date('Y')==$nam){
            if(date('m')==$thang){
            if(date('d')==$ngay){
                            if(date('H')==$gio){
                                $tg= date('i')-$phut;
                                $xuat= $tg." phút trước.";// vẫn trong phạm vi 1 h thì hiển thị xem bao nhiêu phút
                            }elseif(date('H')-$gio ==1){// chênh nhau 1 giờ và quá 60 phút nên hiển thị cả giờ
                                if(date('i')>$phut){
                                    $tgp=date('i')-$phut;
                                    $tgg=date('H')-$gio;
                                    $tg=$tgg." giờ ".$tgp." phút";
                                }else{
                                    $tgp=$phut-date('i');$tgp=60-$tgp;// là trường hợp chênh nhau 1 giờ nhưng chưa quá 60phút cũng chỉ hiển thị phút
                                    $tgg=date('H')-$gio-1;
                                    $tg=$tgp." phút";
                                }
                                $xuat=$tg." trước.";
                            }elseif(date('H')-$gio <=5){// trong 5 giò thì hiển thị giờ và phút. ngoài thì hiển thị thêm hôm nay, hôm qua nữa
                                if(date('i')>$phut){
                                    $tgp=date('i')-$phut;
                                    $tgg=date('H')-$gio;
                                    $tg=$tgg." giờ ".$tgp." phút";
                                }else{
                                    $tgp=$phut-date('i');$tgp=60-$tgp;
                                    $tgg=date('H')-$gio-1;
                                    $tg=$tgg." giờ ".$tgp." phút";
                                }
                                $xuat=$tg." trước.";
                            }else{
                                $tg=$gio.":".$phut;
                                $xuat= "Lúc ".$tg." hôm nay";
                            }//end giờ
                        }elseif(date('m')-$ngay==1){$xuat="Lúc ".$gio.":".$phut."hôm qua";}else{$xuat=$time;}//end kt ngày
                    }else{$xuat=$time;}//end kt tháng
                }else{$xuat=$time;}//end kt năm
                return $xuat;
}
function retime($time){
            $timekt=$time;
            $timestr=(string)$timekt;
            $nam=substr($timestr,0,4);
            $thang=substr($timestr,4,2);
            $ngay=substr($timestr,6,2);
            $gio=substr($timestr,8,2);
            $phut=substr($timestr,10,2);
            $time=$gio.':'.$phut.' - '.$ngay."/".$thang."/".$nam;
                return $time;
}
function retime_ngay($time){
            $timekt=$time;
            $timestr=(string)$timekt;
            $nam=substr($timestr,0,4);
            $thang=substr($timestr,4,2);
            $ngay=substr($timestr,6,2);
            $gio=substr($timestr,8,2);
            $phut=substr($timestr,10,2);
            $time=$ngay."/".$thang."/".$nam;
                return $time;
}
function retime_gio($time){
            $timekt=$time;
            $timestr=(string)$timekt;
            $gio=substr($timestr,8,2);
            $phut=substr($timestr,10,2);
            $time=$gio.':'.$phut;
                return $time;
}
function per($level){
    if($level==1){$per=1;}
    if($level==2){$per=1.2;}
    if($level==3){$per=1.4;}
    if($level==4){$per=1.6;}
    if($level==5){$per=1.8;}
    if($level==6){$per=2;}
    if($level==7){$per=2.2;}
    if($level==8){$per=2.4;}
    return $per;
}
function levelusd($usd){
    if($usd<100){$lv=1;}
    if($usd>=100 and $usd<200){$lv=2;}
    if($usd>=200 and $usd<500){$lv=3;}
    if($usd>=500 and $usd<1000){$lv=4;}
    if($usd>=1000 and $usd<2500){$lv=5;}
    if($usd>=2500 and $usd<5000){$lv=6;}
    if($usd>=5000 and $usd<10000){$lv=7;}
    if($usd>=10000){$lv=8;}
}
function lay_ip(){  
                    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                        //check ip from share internet
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                        //to check ip is pass from proxy
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    }else{
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                }
function loc_html($name){
    $name=strip_tags($name,'');
    return $name;
}
function sodu($a,$b){
            $c = $a % $b;
            return $c;
}
function cat_chu($ten,$c){
            $ten=strtok($ten," ");
            $tensp='';
            $i=0;
            $c1=$c+1;
            while($ten){
            if($i<$c){
            $tensp=$tensp." ".$ten;
            }// chỉ cộng dồn biến tên sản phẩm khi <4 nhưng vẫn phải cho vòng lặp chạy tiếp để biết có cần phải xuất dấu ... hay không
            $ten=strtok(" \n");
            $i=$i+1;
            if($i==$c1){break;}
            }
            if($i>=$c1){$tensp=$tensp."...";}
            return $tensp;
}

function kiem_tra_file_doc($str){
            $mang=array();
            $mang=explode(".",$str);
            $kiemtra=1;
            for($i=0;$i<=count($mang);$i++){
                if($mang[$i]=='php' or $mang[$i]=='css' or $mang[$i]=='cs' or $mang[$i]=='js' or $mang[$i]=='java' or $mang[$i]=='spl' or $mang[$i]=='php3' or $mang[$i]=='php4' or $mang[$i]=='php5' or $mang[$i]=='phtml' or $mang[$i]=='inc' or $mang[$i]=='htaccess'){$kiemtra=0;}}return $kiemtra;}

function cat_kitu($tenv,$c,$d){
            $ten=substr($tenv,$c,$d);
            if($d<=strlen($tenv)){$ten=$ten."....";}
            return $ten;
}

function in_thuong_hoa_dau($string){
            $okmen=mb_convert_case($string, MB_CASE_LOWER, "UTF-8");
            $dautien1= substr($okmen,0,1);
            $dautien= strtoupper($dautien1);
            $cat=ltrim($okmen,$dautien1);
            $string=$dautien.$cat;
            return $string;
}

function in_dau_chu($string){
            $okmen=mb_convert_case($string, MB_CASE_LOWER, "UTF-8");
            $dautien1= substr($okmen,0,1);
            $dautien= strtoupper($dautien1);
            $cat=ltrim($okmen,$dautien1);
            $string=$dautien.$cat;
            $string=mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
            return $string;
}

function reset_gia ($str){
            $str=str_replace(".","",$str);//thay thế các ký tự vớ vẩn nhập vào bằng ký tự rỗng
            $str=str_replace(",","",$str);
            $str=str_replace(" ","",$str);
            $str=str_replace("vnđ","",$str);
            $str=str_replace("VNĐ","",$str);
            $str=str_replace(")","",$str);
            $str=str_replace("(","",$str);
            $str=str_replace("usd","",$str);
            $str=str_replace("USD","",$str);
            $str=str_replace("đô la","",$str);
            $str=str_replace("USĐ","",$str);
            $str=str_replace("usđ","",$str);
            $gia=$str;
            return $gia;
}
function cat_chuoi_thanh_mang_co_num_phan_tu($thetext,$num)
            {
            if (!$num)  $num=1;
                 $arr=array();
                $x=floor(strlen($thetext)/$num);
            while ($i<=$x)
            {
                 $y=substr($thetext,$j,$num);
                if ($y) {
                 array_push($arr,$y);
                }
               $i++;
               $j=$j+$num;
            }
                
                return $arr;
            }
function kiem_tra_anh($str){
            //$sstr=cat_chuoi_thanh_mang_co_num_phan_tu($str,1);
            //$cao=count($sstr);
            //$cao3=$cao-2;
            //$duoi= cat_kitu($str,$cao3,$cao);
            $duo=explode(".", $str);
            $sophantuduoccat=count($duo)-1;//tránh trường hợp trong tên của ảnh có nhiều dấu chấm
            $duoi=$duo[$sophantuduoccat];
            if($duoi=='jpg' or $duoi=='gif' or $duoi=='png' or $duoi=='JPG' or $duoi=='GIF' or $duoi=='PNG' or $duoi=='jpeg' or $duoi=='JPEG' ){
                $okkkk=1;
            }else {$okkkk=0;}
            return $okkkk;
            }
function kiem_tra_email($str){
            $duo=explode("@", $str);
            $duoi=$duo[1];
            if($duoi!=''){
                $okkkk=1;
            }else {$okkkk=0;}
            return $okkkk;
            }
function kiem_tra_file($str){
            //$sstr=cat_chuoi_thanh_mang_co_num_phan_tu($str,1);
            //$cao=count($sstr);
            //$cao3=$cao-2;
            //$duoi= cat_kitu($str,$cao3,$cao);
            $duo=explode(".", $str);
            $duoi=$duo[1];
            if($duoi=='doc' or $duoi=='xls' or $duoi=='pdf' or $duoi=='DOC' or $duoi=='XLS' or $duoi=='PDF' ){
                $okkkk=1;
            }else {$okkkk=0;}
            return $okkkk;
            }
function loc_nn ($str){
    $word= strtok($str," ");
    while($word){
    $kt=substr($word,8,10);
    
    if (strlen(strstr($word, "w")) > 0) {//cắt chuỗi con xong kiểm tra chiều dài chuỗi nếu nó >0 tức là tồn tại
        $w=0;
    }else{$w=1;}
    if (strlen(strstr($word, "z")) > 0) {//cắt chuỗi con xong kiểm tra chiều dài chuỗi nếu nó >0 tức là tồn tại
        $z=0;
    }else{$z=1;}
    if (strlen(strstr($word, "f")) > 0) {//cắt chuỗi con xong kiểm tra chiều dài chuỗi nếu nó >0 tức là tồn tại
        $f=0;
    }else{$f=1;}
    if (strlen(strstr($word, "j")) > 0) {//cắt chuỗi con xong kiểm tra chiều dài chuỗi nếu nó >0 tức là tồn tại
        $j=0;
    }else{$j=1;}
    $wzfj=$w*$f*$z*$j;//wzfj là các từ tiếng việt không có. đem nhân với nhau chỉ cần 1 cái =0 thì cho đứt luôn
    
    if($kt!="" or $wzfj==0){
        $kiemtra=0;
        break;
    }else{$kiemtra=1;}
    $word=strtok(" \n");
    }
    return $kiemtra; 
}


function loc_link ($str){
            $str=str_replace("href=","",$str);//thay thế các ký tự vớ vẩn nhập vào bằng ký tự rỗng
            $str=str_replace("</a>","",$str);
            $gia=$str;
            return $gia;
}
function lay_rong_cao_anh($filename )
{
$size_info=getimagesize($filename);
return $size_info;
}
function lay_url() {
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {if($_SERVER['HTTPS'] == 'on'){$pageURL .= "s";}}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    $trave=str_replace(":443","",$pageURL);
    return $trave;
}
function link_youtube($str){
    if(strlen(strstr($str,'youtu.be/')) > 0) {
        $cat=explode("youtu.be/",$str);
    }elseif(strlen(strstr($str,'/embed/')) > 0) {
        $cat=explode("/embed/",$str);
    }else{
        $cat=explode("=",$str);
    }
            $str=$cat[1];
            $str1=explode('&',$str);$k1=$str1[0];
            $str2=explode('/',$k1);$k2=$str2[0];
            $str3=explode('?',$k2);$k3=$str3[0];
            return $k2;
}
function check_email($email) {  // hàm kiểm tra email
            if (strlen($email) == 0) return false;
            if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) return true;
            return false;
        }
//Ham Resize anh khi Upload
function resize($new_width,$new_height,$file) 
{
		//Lay gia tri chieu ngang va chieu cao truoc khi resize
		list($width,$height) = getimagesize($_FILES['image']['tmp_name']);	
					
		//Bat dau Resize
	    $xpos = 0;
	   	$ypos = 0;
	    
		/* read binary data from image file */
		$imgString = file_get_contents($_FILES['image']['tmp_name']);
		/* create image from string */
		$image_old = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($new_width,$new_height);
	        			
		if($_FILES['image']['type'] == 'image/png'){	
			imagealphablending($tmp, false);
			imagesavealpha($tmp, true);
			$background = imagecolorallocatealpha($tmp,255,255,255,127);
			imagecolortransparent($tmp,$background);
		} else {
			$background = imagecolorallocate($tmp,255,255,255);
		}
			
		imagefilledrectangle($tmp,0,0,$new_width,$new_height,$background);
	    imagecopyresampled($tmp,$image_old,$xpos,$ypos,0,0,$new_width,$new_height,$width,$height);
					
		/* Save image */
		switch ($_FILES['image']['type']) {
			case 'image/jpeg':
				imagejpeg($tmp, $file, 100);
				break;
			case 'image/png':
				imagepng($tmp, $file, 0);
				break;
			case 'image/gif':
				imagegif($tmp, $file);
				break;
			default:
				exit;
				break;
		}
		
		/* cleanup memory */
		imagedestroy($image_old);
		imagedestroy($tmp);
		unset($width,$height,$file,$type,$scale,$new_width,$new_height,$xpos,$ypos);
	}	
 //Ham Resize anh khi Upload
function resize_nhieu($new_width,$new_height,$nameimg,$file)
{
		//Lay gia tri chieu ngang va chieu cao truoc khi resize
		list($width,$height) = getimagesize($_FILES[$nameimg]['tmp_name']);	
					
		//Bat dau Resize
	    $xpos = 0;
	   	$ypos = 0;
	    
		/* read binary data from image file */
		$imgString = file_get_contents($_FILES[$nameimg]['tmp_name']);
		/* create image from string */
		$image_old = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($new_width,$new_height);
	        			
		if($_FILES[$nameimg]['type'] == 'image/png'){	
			imagealphablending($tmp, false);
			imagesavealpha($tmp, true);
			$background = imagecolorallocatealpha($tmp,255,255,255,127);
			imagecolortransparent($tmp,$background);
		} else {
			$background = imagecolorallocate($tmp,255,255,255);
		}
			
		imagefilledrectangle($tmp,0,0,$new_width,$new_height,$background);
	    imagecopyresampled($tmp,$image_old,$xpos,$ypos,0,0,$new_width,$new_height,$width,$height);
					
		/* Save image */
		switch ($_FILES[$nameimg]['type']) {
			case 'image/jpeg':
				imagejpeg($tmp, $file, 100);
				break;
			case 'image/png':
				imagepng($tmp, $file, 0);
				break;
			case 'image/gif':
				imagegif($tmp, $file);
				break;
			default:
				exit;
				break;
		}
		
		/* cleanup memory */
		imagedestroy($image_old);
		imagedestroy($tmp);
		unset($width,$height,$file,$type,$scale,$new_width,$new_height,$xpos,$ypos);
	}
?> 