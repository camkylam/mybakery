
<header class="header">
<section class="flex">
   <a href="index.php" class="logo">Bakery<span></span></a>
   <nav>
      <ul class="nav justify-content-center ">
         <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="gioithieu.php">Giới thiệu</a>
         </li>

         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="sanpham.php" role="button" aria-expanded="false">Sản phẩm</a>
            <ul class="dropdown-menu">
               <li><a class="dropdown-item " href="sanpham.php">Tất cả sản phẩm</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="banhsinhnhat.php">Bánh sinh nhật</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="banhmi.php">Bánh mì</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="banhcupcake.php">Bánh cupcake</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="banhbonglan.php">Bánh bông lan</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="banhbao.php">Bánh bao</a></li>
            </ul>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="dathang.php">Đặt hàng</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="lienhe.php">Liên hệ</a>
         </li>
      </ul>
   </nav>
<div class="icons">
      <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `giohang` WHERE id_khach = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
      ?>
      <div id="menu-btn" class="fas fa-bars"></div>
      <a id="search-btn" href="search.php"><i class="fas fa-search"></i></a>
      <a href="giohang.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
      <div id="user-btn" class="fas fa-user"></div>
   </div>

   <div class="profile">
      <?php          
         $select_profile = $conn->prepare("SELECT * FROM `khachhang` WHERE id_khach = ?");
         $select_profile->execute([$user_id]);
         if($select_profile->rowCount() > 0){
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile["ten_khach"]; ?></p>
      <a href="hoso_user.php" class="btn">Cập nhật hồ sơ của bạn</a>
      <a href="dangxuat.php" class="delete-btn" onclick="return confirm('Bạn muốn đăng xuất?');">Đăng xuất</a> 
      <?php
         }else{
      ?>
      <p>Mời bạn đăng nhập</p>
      <div class="flex-btn">
         <a href="dangky.php" class="option-btn">Đăng ký</a>
         <a href="dangnhap.php" class="option-btn">Đăng nhập</a>
      </div>
      <?php
         }
      ?>      
    
</section>

</header>