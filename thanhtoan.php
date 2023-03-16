<?php

include 'partials/connect.php';


session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
   header('location:dangnhap.php');
};

if(isset($_POST['order'])){

   $name = $_POST['ten_khach'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $sodienthoai = $_POST['sodienthoai'];
   $sodienthoai = filter_var($sodienthoai, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phuongthuc = $_POST['phuongthuc'];
   $phuongthuc = filter_var($phuongthuc, FILTER_SANITIZE_STRING);
   $diachi =$_POST['add'];
   $diachi = filter_var($diachi, FILTER_SANITIZE_STRING);
   $tong_sp = $_POST['tong_sp'];
   $tong_tien = $_POST['tong_tien'];

   $check_cart = $conn->prepare("SELECT * FROM `giohang` WHERE id_khach = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `dathang`(id_khach, ten_khach, sodienthoai, email, phuongthuc, diachi, tong_sp, tong_chiphi) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $sodienthoai, $email, $phuongthuc, $diachi, $tong_sp, $tong_tien]);

      $delete_cart = $conn->prepare("DELETE FROM `giohang` WHERE id_khach = ?");
      $delete_cart->execute([$user_id]);

      $error[] = 'Đã đặt hàng thành công!';
      include 'partials/show_error.php';
   }else{
      $error[] = 'Giỏ hàng của bạn rỗng';
      include 'partials/show_error.php';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đặt hàng</title>
   
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style_user.css">

</head>
<body>
   
<?php include 'partials/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3><b>Thanh toán</b></h3>

      <div class="display-orders">
      <?php
         $tong_tien = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `giohang` WHERE id_khach = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['ten_sp'].' ('.$fetch_cart['gia_sp'].' x '. $fetch_cart['soluong_sp'].') - ';
               $tong_sp = implode($cart_items);
               $tong_tien += ($fetch_cart['gia_sp'] * $fetch_cart['soluong_sp']);
      ?>
         <p> <?= $fetch_cart['ten_sp']; ?> <span>(<?= $fetch_cart['gia_sp'].',000đ x '. $fetch_cart['soluong_sp']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Giỏ hàng của bạn rỗng!</p>';
         }
      ?>
         <input type="hidden" name="tong_sp" value="<?= $tong_sp; ?>">
         <input type="hidden" name="tong_tien" value="<?= $tong_tien; ?>" value="">
         <div class="grand-total">Tổng tiền : <span><?= $tong_tien; ?>,000 đ</span></div>
      </div>

      <h3><b>Thông tin đặt hàng</b></h3>

      <div class="flex">
         <div class="inputBox">
            <span>Tên của bạn :</span>
            <input type="text" name="ten_khach" placeholder="Nhập vào tên của bạn" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Số điện thoại :</span>
            <input type="text" name="sodienthoai" placeholder="Nhập vào số điện thoại của bạn" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>email :</span>
            <input type="email" name="email" placeholder="Nhập vào Email của bạn" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán :</span>
            <select name="phuongthuc" class="box" required>
               <option value="thanh toán bằng tiền mặt">Thanh toán bằng tiền mặt</option>
               <option value="Thanh toán bằng thẻ ATM">Thanh toán bằng thẻ ATM</option>
   
            </select>
         </div>
         <div class="inputBox">
            <span>Địa chỉ nhận hàng :</span>
            <input type="text" name="add" placeholder="Địa chỉ nhận hàng" class="box" maxlength="50" required>
         </div>
         
      </div>

      <input type="submit" name="order" class="btn <?= ($tong_tien > 1)?'':'disabled'; ?>" value="Đặt hàng">

   </form>

</section>


<?php include 'partials/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>