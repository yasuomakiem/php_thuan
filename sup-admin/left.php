<div id="left">
        <div class="tit"><i class="fas fa-sun"></i> MENU QUẢN TRỊ</div>
        <ul>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="cpanel.php"><i class="fas fa-caret-right"></i> Trang chủ Admin</a></li>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="admin.php"><i class="fas fa-caret-right"></i> Cài đặt hệ thống</a></li>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="naptien.php"><i class="fas fa-caret-right"></i> Nạp tiền hệ thống</a></li>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?> class="chucnang"><a href="taouser.php"><i class="fas fa-caret-right"></i> Quản lý thành viên</a></li>
            <li><a href="thongbao.php"><i class="fas fa-caret-right"></i> Thông báo hệ thống</a></li>
            <li><a href="docquyen.php"><i class="fas fa-caret-right"></i> Quản lý độc quyền</a></li>
            <!--li><a href="admin-footer.php">Cài đặt chân trang</a></li>
            <li><a href="tao-menu.php">Quản lý menu</a></li> 
            <li><a href="tao-menus.php">Menu sản phẩm</a></li>
            <li><a href="tao-sanpham.php">Đăng sản phẩm</a></li>
            <li><a href="ds-sanpham.php">Danh sách sản phẩm</a></li>
            <li><a href="tao-baiviet.php">Tạo các bài viết</a></li>
            <li><a href="ds-baiviet.php">Danh sách bài viết</a></li-->
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?> class="chucnang"><a href="tao-sanpham.php"><i class="fas fa-caret-right"></i> Đăng sản phẩm</a></li>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?> class="chucnang"><a href="ds-sanpham.php"><i class="fas fa-caret-right"></i> Danh sách sản phẩm</a></li>
            <!--li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?> class="chucnang"><a href="landing.php"><i class="fas fa-caret-right"></i> Cài đặt Landing Page</a></li>
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?> class="chucnang"><a href="webinar.php"><i class="fas fa-caret-right"></i> Cài đặt Webinar</a></li-->
            <li class="chucnang"><a href="ds_mod.php?id=1"><i class="fas fa-caret-right"></i> Đào tạo sản phẩm</a></li>
            <li class="chucnang"><a href="ds_mod.php?id=2"><i class="fas fa-caret-right"></i> Đào tạo kỹ năng</a></li>
            <!--li class="chucnang"><a href="ds_mod.php?id=3"><i class="fas fa-caret-right"></i> Thư viện Media</a></li>
            <li class="chucnang"><a href="ds_mod.php?id=4"><i class="fas fa-caret-right"></i> Thư viện pháp lý</a></li-->
            <li class="chucnang"><a href="ds_mod.php?id=8"><i class="fas fa-caret-right"></i> Hỏi đáp hệ thống</a></li>
            
            <!--li class="chucnang"><a href="ds_mod.php?id=7"><i class="fas fa-caret-right"></i> Marketing Online</a></li-->
            
            <li class="chucnang"><a href="ds_mod.php?id=9"><i class="fas fa-caret-right"></i> Hướng dẫn kỹ thuật</a></li>
            <li class="chucnang"><a href="ds_mod.php?id=6"><i class="fas fa-caret-right"></i> Feedback Media</a></li>
            <li class="chucnang"><a href="ds_mod.php?id=5"><i class="fas fa-caret-right"></i> Thư viện quy trình</a></li>
            <!--li class="chucnang"><a href="tao21ngay.php"><i class="fas fa-caret-right"></i> 21 ngày Affilia</a></li-->
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="ds-donhang.php"><i class="fas fa-caret-right"></i> Danh sách đơn hàng</a></li>
            <!--li><a href="ds-thanhvien.php">Danh sách thành viên</a></li-->
            <!--li><a href="tao-bando.php">Cập nhật bản đồ</a></li-->
            <li <?php if($_COOKIE['iduser']!=1){echo 'style="display: none;"';}?>><a href="doi-mat-khau.php"><i class="fas fa-caret-right"></i> Đổi mật khẩu</a></li>
        </ul>
    </div>