<?php

include 'partials/connect.php';
 
session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
   header('location:dangnhap.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['id_gio'];
   $delete_cart_item = $conn->prepare("DELETE FROM `giohang` WHERE id_gio = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `giohang` WHERE id_khach = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:giohang.php');
}

if(isset($_POST['update_soluong'])){
   $id_gio = $_POST['id_gio'];
   $soluong_sp = $_POST['soluong_sp'];
   $soluong_sp = filter_var($soluong_sp, FILTER_SANITIZE_STRING);
   $update_soluong = $conn->prepare("UPDATE `giohang` SET soluong_sp = ? WHERE id_gio = ?");
   $update_soluong->execute([$soluong_sp, $id_gio]);
   $error[] = 'Sản phẩm đã được cập nhật trong giỏ hàng';
   include 'partials/show_error.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giỏ hàng</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">
    
</head>

<body>
   
<?php include 'partials/user_header.php'; ?>

<section class="products shopping-cart">
   <h3 class="heading">Giỏ hàng</h3>
   <div class="box-container">
   <?php
      $tong_tien = 0;
      $select_cart = $conn->prepare("SELECT * FROM `giohang` WHERE id_khach = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="id_gio" value="<?= $fetch_cart['id_gio']; ?>">
      <img src="uploaded_img/<?= $fetch_cart['anh_sp']; ?>" alt="">
      <div class="name1"><b><?= $fetch_cart['ten_sp']; ?></b></div>
      <div class="flex">
         <div class="price"><?= $fetch_cart['gia_sp']; ?>,000 đ</div>
         <input type="number" name="soluong_sp" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['soluong_sp']; ?>">
         <button type="submit" class="fas fa-edit" name="update_soluong"></button>
      </div>
      <div class="sub-total"> Tổng tiền cho sản phẩm : <span><?= $gia_sp = ($fetch_cart['gia_sp'] * $fetch_cart['soluong_sp']); ?>,000 đ</span> </div>
      <input type="submit" value="Xóa sản phẩm" onclick="return confirm('Bạn có muốn xóa sản phẩm này trong giỏ hàng?');" class="delete-btn" name="delete">
   </form>
   <?php
   $tong_tien += $gia_sp;
      }
   }else{
      echo '<p class="emptyy">Giỏ hàng của bạn rỗng</p>';
   }
   ?>
   </div>
   <div class="cart-total">
      <p>Tổng thanh toán : <span><?= $tong_tien; ?>,000 đ</span></p>
      <a href="giohang.php?delete_all" class="delete-btn <?= ($tong_tien > 1)?'':'disabled'; ?>" onclick="return confirm('Xóa tất cả sản phẩm trong giỏ hàng của bạn?');">Xóa tất cả sản phẩm</a>
      <a href="thanhtoan.php" class="btn <?= ($tong_tien > 1)?'':'disabled'; ?>">Mua hàng</a>
   </div>

</section>


<?php include 'partials/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>