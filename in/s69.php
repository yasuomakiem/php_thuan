<style>
.s69{
    padding: 30px 0;
}
.s69 h2{}
.s56{
    
}
.s56 h2{}
.s56 .con2{
    
}
span.gach{
    background: #00a1e3 none repeat scroll 0 0;
    border-radius: 2px;
    display: block;
    height: 4px;
    margin: 20px auto;
    width: 60px;
}
.dieuhuong{
   text-align: center;
}
.dieuhuong a:hover,.dieuhuong a.ac {border: 0;}
.dieuhuong a{
    padding: 10px;
    color: #706f6f;
    font-weight: 400;
    text-decoration: none;
    width: 46%;
    display: inline-block;
    margin: 5px 0;
    background: white;
    font-size: 0.9em;
    padding-bottom: 7px;
}
.dieuhuong a:hover, .dieuhuong a.ac {
    color: #fff;
    background: cornflowerblue;
}
</style>
<div class="bigmem cpanel">
        <h3 style="color: white; padding-left: 30px; margin-top: 0; font-size: 18px; margin-bottom: 25px;"><a href="/m/cpanel/" style="color: white;"><i class="fas fa-globe"></i> Cpanel</a> <a style="float: right;font-size: 14px;padding-right: 20px;color: yellow;" href="logout.php">Thoát <i class="fas fa-sign-out-alt"></i></a></h3>
            <div class="contag dr">
                <img src="i/nguyen-ly-trong-chien-luoc-dai-duong-xanh.jpg" />
                <div class="dealright">
                <p><b>Danh sách người quen</b></p>
                <?
                $tm=date("Y").date("m").date("d").'000000';
                $tm=intval($tm);
                $homnay=@mysqli_num_rows(@mysqli_query($con,"select id from khachhang where iduser=$_COOKIE[iduser] and timecs>$tm"));
                $sll=@mysqli_num_rows(@mysqli_query($con,"select * from khachhang where iduser=$_COOKIE[iduser] order by timecs asc"));
                ?>
                <p style="font-size: 0.88em;">
                Tổng số: <b><?=$sll?></b>  &nbsp; 
                Chăm sóc: <span class="badge" style="background: yellow; color: red;"><?=$homnay?></span>
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="dieuhuong">
                <?
                $ds=addslashes($_GET['ds']);
                ?>
                <a class="" href="/m/danhsachnguoiquen/"><i class="fas fa-clipboard-list"></i> Danh sách</a><a class="ac" href="/m/ssauchin/"><i class="fas fa-atom"></i> S69</a>
                
            </div>
            <div class="boxland">
<section class="s69">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <p class="text-center" style="color: #00a1e3; font-size: 3em;"><i class="fas fa-snowflake"></i></p>
                    <h2 class="text-center">S69</h2>
                    <p style="font-weight: 600; font-size: 1.0em; padding: 5px 5%; text-align: center;">Trường đào tạo kinh doanh theo mạng hàng đầu thế giới</p>
                    <span class="gach"></span>
                    <p class="tit1"><i class="fas fa-passport"></i> Sứ mệnh</p>
                    <p class="con1">Làm cho thế giới này trở nên tốt đẹp hơn</p>
                    <p class="tit1"><i class="fas fa-passport"></i> Tầm nhìn</p>
                    <p class="con1">Phấn đấu trở thành Trường Đào tạo Kinh doanh Theo mạng Hàng đầu Thế giới vào năm 2030</p>
                    <p class="tit1"><i class="fas fa-passport"></i> Mục tiêu</p>
                    <p class="con1">Kết nối hàng triệu người Việt Nam trên khắp 5 châu 4 biển, những người yêu sức khỏe, những người có khát vọng tự do, và những người thích giúp đỡ người khác để cùng làm làm giàu tập thể</p>
                    <p class="tit1"><i class="fas fa-passport"></i> Giá trị cốt lõi</p>
                    <p class="con1">Đạo đức, Trí tuệ, Nghị lực</p>
                    <p class="tit1"><i class="fas fa-passport"></i> Văn hóa</p>
                    <p class="con1">Yêu hết mình và cho đi hết mình</p>
                    </div>
            </div>
</div>
</section>
<style>
.s56{
    background: url(images/bggoilai.png);
    background-size: cover;
    padding: 30px 0;
    color: white;
    background-attachment: fixed;
    background-position: center center;
}
.s56 h3{
    font-size: 20px;
    text-align: center;
}
.s56 span{
    background: #ffb900 none repeat scroll 0 0;
    border-radius: 2px;
    display: block;
    height: 4px;
    margin: 20px auto;
    width: 60px;
}
</style>
<section class="s56">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3>5 TIÊU CHUẨN CỦA CHIẾN BINH S69</h3><span></span>
                    <p class="con2">1. Sức khỏe tuyệt hảo.</p>
                    <p class="con2">2. Trách nhiệm và Bổn phận.</p>
                    <p class="con2">3. Làm chủ thế giới bên trong (Cảm xúc, Tư duy, Tinh thần).</p>
                    <p class="con2">4. Phát triển - mở rộng</p>
                    <p class="con2">5. Xây dựng đế chế kinh doanh theo mạng</p>
                    </div>
            </div>
</div>
</section>
<style>
.s66{
    background: white;
    padding: 30px 0;
}
.s66 h3{
    font-size: 20px;
    text-align: center;
}
.s66 span{
    background: #ffb900 none repeat scroll 0 0;
    border-radius: 2px;
    display: block;
    height: 4px;
    margin: 20px auto;
    width: 60px;
}
</style>
<section class="s66">
<div class="container-fluid main">
            <div class="row">
            <div class="col-md-12">
                    <h3 style="margin-top: 30px;">6 KHÔNG CỦA CHIẾN BINH S69</h3><span></span>
                    <p class="con2">1. Không tiêu cực</p>
                    <p class="con2">2. Không bán phá giá</p>
                    <p class="con2">3. Không ôm hàng</p>
                    <p class="con2">4. Không biến mình thành bác sĩ</p>
                    <p class="con2">5. Không cài cắm người vào hệ thống</p>
                    <p class="con2">6. Không lôi kéo người từ đội nhóm, hệ thống khác.</p>
                    </div>
            </div>
</div>
</section>
<style>
.thanhcong{
    padding: 30px 0;
    background: aliceblue;
}
</style>
<section class="thanhcong">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3>I. Bước đi nhỏ,thành công lớn: “4 số 1 mỗi ngày”</h3>
                    <p class="con3">1. Mỗi ngày gặp một người nói chuyện về sản phẩm</p>
                    <p class="con3">2. Mỗi ngày gặp một người nói chuyện về kinh doanh</p>
                    <p class="con3">3. Mỗi ngày dành một giờ đọc sách + nghe clips đào tạo về KDTM và phát triển bản thân</p>
                    <p class="con3">4. Mỗi ngày dành 3 phút trước khi đi ngủ thiền, nghĩ về những người mình đã giúp đỡ trong ngày + 3 phút ngay sau khi ngủ dậy để tượng tượng về hình ảnh thành công mà mình mong muốn</p>
                    <h3>II. Chiến lược thành công theo mức độ quan trọng</h3>
                    <p class="con3">1. Quan trọng nhất là tuyển tầng một cho mình</p>
                    <p class="con3">2. Quan trọng thứ hai là đào tạo cho thủ lĩnh trong mạng lưới</p>
                    <p class="con3">3. Quan trọng thứ ba là hỗ trợ cho mạng lưới</p>
                    <p class="con3">4. Quan trọng thứ tư là luôn hoàn thiện bản thân</p>
                    <h3>III.Tự nhắc nhở và kỷ luật với chính mình</h3>
                    <p class="con3">1. Mỗi buổi sáng thức dậy hãy nhìn vào gương và nói “Nếu các tư vấn viên của mình cũng làm việc như mình đang làm thì mạng lưới sẽ như thế nào”?</p>
                    <p class="con3">2. Trước khi định làm bất cứ việc gì hãy suy nghĩ: “Việc mình định làm các tư vấn viên của mình có sao chép được hay không”?</p>
                    <p class="con3">3. Cuối tháng hãy nhìn vào tổng thu nhập của mình trong tháng và nói “Chẳng lẽ giá trị của chính mình trên thương trường chỉ có thế này thôi sao”!</p>
                    <h4>Hãy làm theo cách này nhất định sẽ thành công</h4>
                    </div>
            </div>
</div>
</section>
<style>
.timkhach{
    padding: 30px 0;
}
</style>
<section class="timkhach">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3>BẠN SẼ TÌM KHÁCH HÀNG VÀ TƯ VẤN VIÊN TIỀM NĂNG Ở ĐÂU?</h3>
                    <p class="con4" style="font-weight: 500; font-style: italic;">Muốn bắt đầu thành công bạn cần phải có ít nhất 100 người quen, không cần phải đi đâu xa, trước
                    tiên bạn hãy lên danh sách nhiều người của bạn: hãy sử dụng danh bạ điện thoại di động, name card,
                    album ảnh, hoặc đơn giản bạn liệt kê theo danh sách sau:</p>
                    <p class="con4">1. Những người mà bạn biết từ khi học mẫu giáo</p>
                    <p class="con4">2. Những người mà bạn biết từ khi học phổ thông</p>
                    <p class="con4">3. Những người mà bạn biết từ khi học trung cấp, cao đẳng, đại học hoặc cao học</p>
                    <p class="con4">4. Những người mà dạy dỗ bạn</p>
                    <p class="con4">5. Đồng nghiệp lúc trước</p>
                    <p class="con4">6. Hàng xóm và các bạn bè khác</p>
                    <p class="con4">7. Bạn của bạn</p>
                    <p class="con4">8. Người bạn gặp lúc đợi xe</p>
                    <p class="con4">9. Người nhận danh thiếp của bạn</p>
                    <p class="con4">10. Người ở cùng chung cư</p>
                    <p class="con4">11. Bạn của vợ (chồng) bạn</p>
                    <p class="con4">12. Hội viên các đoàn thể</p>
                    <p class="con4">13. Người bạn ăn cơm cùng</p>
                    <p class="con4">14. Người uống cùng quán cà phê</p>
                    <p class="con4">15. Người đi cùng trên xe, tàu, máy bay...</p>
                    <p class="con4">16. Những đối tác làm việc của bạn ở công ty</p>
                    <p class="con4">17. Bạn của cha mẹ, anh chị em trong gia đình</p>
                    </div>
            </div>
</div>
</section>
<style>
.phatday{
    padding: 45px 0;
    background: url(images/hinh-nen-trang-kinh.jpg);
    background-size: cover;
    color: white;
    background-attachment: fixed;
    background-position: center center;
}
.con55{text-align: right;}
</style>
<section class="phatday">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center;">HÃY LIỆT KÊ TẤT CẢ NHỮNG NGƯỜI BẠN BIẾT VÀO DANH SÁCH NGƯỜI QUEN VÌ
                    KHÔNG AI LÀ KHÔNG CẦN SỨC KHỎE, SẮC ĐẸP VÀ TIỀN</h3>
                    <h3 style="font-size: 15px; text-align: center;">NHỮNG ĐIỀU GIẢNG DẠY CỦA ĐỨC PHẬT</h3>
                    <h3 style="font-size: 16px; text-align: center; padding-bottom: 25px;">MƯỜI BỐN ĐIỀU RĂN CỦA ĐỨC PHẬT</h3>
                    <p class="text-center">----- <i class="fas fa-praying-hands"></i> -----</p><p>&nbsp;</p>
                    <p class="con5 hidden-xs">1. Kẻ thù lớn nhất của đời người...là CHÍNH MÌNH</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">1. Kẻ thù lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là CHÍNH MÌNH</p>
                    <p class="con5 hidden-xs">2. Ngu dốt lớn nhất của đời người...là DỐI TRÁ</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">2. Ngu dốt lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là DỐI TRÁ</p>
                    <p class="con5 hidden-xs">3. Thất bại lớn nhất của đời người...là TỰ ĐẠI</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">3. Thất bại lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là TỰ ĐẠI</p>
                    <p class="con5 hidden-xs">4. Bi ai lớn nhất của đời người...là GHEN TỴ</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">4. Bi ai lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là GHEN TỴ</p>
                    <p class="con5 hidden-xs">5. Sai lầm lớn nhất của đời người...là ĐÁNH MẤT MÌNH</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">5. Sai lầm lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là ĐÁNH MẤT MÌNH</p>
                    <p class="con5 hidden-xs">6. Tội lớn nhất của đời người...là BẤT HIẾU</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">6. Tội lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là BẤT HIẾU</p>
                    <p class="con5 hidden-xs">7. Đáng thương lớn nhất của đời người...là TỰ TY</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">7. Đáng thương lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là TỰ TY</p>
                    <p class="con5 hidden-xs">8. Đáng khâm phục lớn nhất của đời người...là VƯƠN LÊN SAU KHI NGÃ</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">8. Đáng khâm phục lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là VƯƠN LÊN SAU KHI NGÃ</p>
                    <p class="con5 hidden-xs">9. Phá sản lớn nhất của đời người...là TUYỆT VỌNG</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">9. Phá sản lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là TUYỆT VỌNG</p>
                    <p class="con5 hidden-xs">10. Tài sản lớn nhất của đời người...là SỨC KHỎE</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">10. Tài sản lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là SỨC KHỎE</p>
                    <p class="con5 hidden-xs">11. Món nợ lớn nhất của đời người...là TRÍ TUỆ</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">11. Món nợ lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là TRÍ TUỆ</p>
                    <p class="con5 hidden-xs">12. Lễ vật lớn nhất của đời người...là TÌNH CẢM</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">12. Lễ vật lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là TÌNH CẢM</p>
                    <p class="con5 hidden-xs">13. Khiếm khuyết lớn nhất của đời người...là KHOAN DUNG</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">13. Khiếm khuyết lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là KHOAN DUNG</p>
                    <p class="con5 hidden-xs">14. An ủi lớn nhất của đời người...là KÉM HIỂU BIẾT BỐ THÍ</p>
                    <p class="con5 hidden-lg hidden-md hidden-sm">14. An ủi lớn nhất của đời người</p><p class="con55 hidden-lg hidden-md hidden-sm">...là KÉM HIỂU BIẾT BỐ THÍ</p>
</div>
            </div>
</div>
</section>
<style>
.thanchu{
    padding: 45px 0;
    background: url();
    background-size: cover;
    
    background-attachment: fixed;
    background-position: center center;
}
.con6{}
</style>
<section class="thanchu">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center; font-weight: bold;">NHỮNG CÂU THẦN CHÚ ĐỂ THÀNH CÔNG</h3>
                    <span class="gach"></span>
<p class="con6">1. Kết quả lớn nhất của một cuộc gặp là hẹn một cuộc gặp lần sau</p>
<p class="con6">2. Một sự bất tín vạn sự bất tin</p>
<p class="con6">3. Quyết định lớn được nảy sinh ra trong cảm xúc</p>
<p class="con6">4. Thành công = không lý do (TC = KLD)</p>
<p class="con6">5. Thành công = ước mơ + khát vọng + mục tiêu + kế hoạch + niềm tin + tự tin hành động</p>
<hr />
<h4 class="text-center" style="font-size: 0.9em;">THÀNH CÔNG LÀ MỘT QUÁ TRÌNH CHỨ KHÔNG PHẢI MỘT ĐIỂM ĐẾN THÀNH CÔNG KHÔNG PHẢI LÀ CÁI ĐỂ THEO ĐUỔI HAY TÌM KIẾM, MÀ THÀNH CÔNG LÀ CÁI MÀ BẠN THU HÚT ĐƯỢC BỞI CON NGƯỜI MÀ BẠN TRỞ THÀN </h4>
</div>
            </div>
</div>
</section>
<style>
.sailam{
    padding: 45px 0;
    background: url(images/background-ban-go-lam-viec_101227484.jpg);
    background-size: cover;
    color: white;
    
    background-position: center center;
}
.con7{}
</style>
<section class="sailam">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center; font-weight: bold;">MỘT SỐ SAI LẦM THƯỜNG MẮC PHẢI</h3>
                    <span class="gach"></span>
                        <p class="con7">1. Không sử dụng sản phẩm đúng, đủ, đều</p>
                        <p class="con7">2. Sáng tạo lại bánh xe đạp</p>
                        <p class="con7">3. Làm việc một mình</p>
                        <p class="con7">4. Không tuân thủ và làm việc theo S69</p>
                        <p class="con7">5. Không đi dự các sự kiện</p>
                        <p class="con7">6. Biến mình thành bác sĩ, chuyên đi chữa bệnh</p>
                        <p class="con7">7. Không nghe lời người hướng dẫn đã thành công</p>
                        <p class="con7">8. Quá soi mói vào sản phẩm</p>
                        <p class="con7">9. Không tự đào tạo mình</p>
</div>
            </div>
</div>
</section>
<style>
.nghethuat{
    padding: 45px 0;
}
.con88{text-align: right;}
</style>
<section class="nghethuat">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center; font-weight: bold;">NGHỆ THUẬT SỐNG</h3>
                    <span class="gach"></span>
                    <h2 class="text-center">GIEO GÌ?</h2><hr />
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Thành thật</b> ... Ta sẽ gặt <b>Lòng tin</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Thành thật</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Lòng tin</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Lòng tốt</b> ... Ta sẽ gặt <b>Thân thiện</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Lòng tốt</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Thân thiện</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Khiêm tốn</b> ... Ta sẽ gặt <b>Cao thượng</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Khiêm tốn</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Cao thượng</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Kiên nhẫn</b> ... Ta sẽ gặt <b>Chiến thắng</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Kiên nhẫn</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Chiến thắng</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Cân nhắc</b> ... Ta sẽ gặt <b>Hòa thuận</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Cân nhắc</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Hòa thuận</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Chăm chỉ</b> ... Ta sẽ gặt <b>Thành công</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Chăm chỉ</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Thành công</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Tha thứ</b> ... Ta sẽ gặt <b>Hòa giải</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Tha thứ</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Hòa giải</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Cởi mở</b> ... Ta sẽ gặt <b>Thân mật</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Cởi mở</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Thân mật</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Chịu đựng</b> ... Ta sẽ gặt <b>Cộng tác</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Chịu đựng</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Cộng tác</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Niềm tin</b> ... Ta sẽ gặt <b>Phép màu</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Niềm tin</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Phép màu</b></p>
                    <p>&nbsp;</p>
                    <p class="text-center">----- <i class="fas fa-shield-alt"></i> -----</p>
                    <h2 class="text-center">NHƯNG?</h2><hr />
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Dối trá</b> ... Ta sẽ gặt <b>Ngờ vực</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Dối trá</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Ngờ vực</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Ích kỷ</b> ... Ta sẽ gặt <b>Cô đơn</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Ích kỷ</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Cô đơn</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Kiêu hãnh</b> ... Ta sẽ gặt <b>Hủy diệt</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Kiêu hãnh</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Hủy diệt</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Đố kỵ</b> ... Ta sẽ gặt <b>Phiền muộn</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Đố kỵ</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Phiền muộn</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Lười biếng</b> ... Ta sẽ gặt <b>Mụ mẫ</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Lười biếng</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Mụ mẫn</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Cay đắng</b> ... Ta sẽ gặt <b>Cô lập</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Cay đắng</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Cô lập</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Tham lam</b> ... Ta sẽ gặt <b>Tổn hại</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Tham lam</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Tổn hại</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Lo lắng</b> ... Ta sẽ gặt <b>Âu lo</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Lo lắng</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Âu lo</b></p>
                    <p class="con8 hidden-xs">Nếu ta gieo <b>Tội lỗi</b> ... Ta sẽ gặt <b>Đau khổ</b></p>
                    <p class="con8 hidden-lg hidden-md hidden-sm">Nếu ta gieo <b>Tội lỗi</b></p><p class="con88 hidden-lg hidden-md hidden-sm">... Ta sẽ gặt <b>Đau khổ</b></p>
                    <p class="text-center" style="padding: 15px;border: 1px solid #00bcd4;margin-top: 20px;color: #00bcd4;"><b>Có những hạt giống khi gieo sẽ sớm lên mầm hạnh phúc, nhưng có những hạt giống khi đâm chồi sẽ gây khổ đau cho người và cho ta</b></p>
</div>
            </div>
</div>
</section>
<style>
.buocdi{
    padding: 45px 0;
    background: url(images/background-second-job.jpg);
    background-size: cover;
    color: silver;
    
    background-position: center center;
}
.con9{}
</style>
<section class="buocdi">
<div class="container-fluid main">
            <div class="row">
                
                    <div class="col-md-12">
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center; font-weight: bold;">6 BƯỚC ĐI ĐẦU TIÊN</h3>
                    <span class="gach"></span>
                        <p class="con7">1. Xây dựng niềm tin sản phẩm (Sử dụng sản phẩm đúng + đủ + đều)</p>
                        <p class="con7">2. Lập Danh sách người quen (200 người)</p>
                        <p class="con7">3. Thiết lập cuộc hẹn</p>
                        <p class="con7">4. Chia sẻ để tuyển dụng nhanh nhất 15 TÀU VÀNG</p>
                        <p class="con7">5. Chốt hợp đồng</p>
                        <p class="con7">6. Tự học và đào tạo cho đội nhóm theo Hệ thống 69</p>
                        <p>&nbsp;</p><p>&nbsp;</p>
                    <h3 style="font-size: 16px; line-height: 22px; text-align: center; font-weight: bold;">9 BÀI ĐÀO TẠO CƠ BẢN ĐỂ TRỞ THÀNH THỦ LĨNH</h3>
                    <span class="gach"></span>
                        <p class="con7">1. Hai câu hỏi tối quan trọng</p>
                        <p class="con7">2. Tại sao Siberi trả tiền cho bạn?</p>
                        <p class="con7">3. Sức mạnh của cấp số nhân (Sao chép và nhân bản)</p>
                        <p class="con7">4. Những bước đi đầu tiên</p>
                        <p class="con7">5. 6 bước làm việc với ý kiến phản đối</p>
                        <p class="con7">6. Vĩ đại do lựa chọn</p>
                        <p class="con7">7. 7 kỹ năng</p>
                        <p class="con7">8. Hệ thống sao chép</p>
                        <p class="con7">9. Bản đồ thành công</p>
</div>
            </div>
</div>
</section>
</div>
</div>