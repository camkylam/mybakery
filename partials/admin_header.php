
<header class="header">
   <section class="flex">
      <a href="index.php" class="logo">Bakery<span></span> </a>
      <nav>
         <ul class="nav justify-content-center">
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="thongke.php">Thống kê</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="ql_sanpham.php">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="ql_dathang.php">Quản lý đặt hàng</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="ql_khachhang.php">Quản lý khách hàng</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="ql_lienhe.php">Quản lý liên hệ</a>
            </li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['ten']; ?></p>
         <a href="hoso_admin.php" class="btn">Cập nhật thông tin</a>
         <a href="dangxuat.php" onclick="return confirm('Bạn muốn đăng xuất khỏi website');" class="btn-delete">Đăng xuất</a>
      </div>
   </section>
</header>