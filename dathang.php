<?php
include 'partials/connect.php';
session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đặt hàng</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">

</head>
<body>
   
<?php include 'partials/user_header.php'; ?>

<section class="orders">
   <h1 class="heading">Thông tin đặt hàng</h1>
   <div class="box-container">
   <?php
      if($user_id == ''){
         echo '<p class="empty">Mời bạn đăng nhập để thấy được thông tin đặt hàng</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `dathang` WHERE id_khach = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Tên khách hàng : <span><?= $fetch_orders['ten_khach']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Số điện thoại : <span><?= $fetch_orders['sodienthoai']; ?></span></p>
      <p>Địa chỉ : <span><?= $fetch_orders['diachi']; ?></span></p>
      <p>Phương thức thanh toán : <span><?= $fetch_orders['phuongthuc']; ?></span></p>
      <p>Sản phẩm đã đặt : <span><?= $fetch_orders['tong_sp']; ?></span></p>
      <p>Tổng chi phí : <span><?= $fetch_orders['tong_chiphi']; ?>,000đ</span></p>
      <p>Trạng thái : <span><?= $fetch_orders['trangthai_TT']; ?></span></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Không tìm thấy thông tin đặt hàng của bạn</p>';
      }
      }
   ?>
   </div>
</section>

<?php include 'partials/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>