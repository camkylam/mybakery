<?php
include 'partials/connect.php';
session_start();
$admin_id = $_SESSION['id'];
if(!isset($admin_id)){
   header('location:dangnhap.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thống kê</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="css/style_admin.css">
</head>

<body>
   <?php include 'partials/admin_header.php' ?>
   <section class="dashboard">
      <h1 class="heading">Thống kê</h1>
      <div class="box-container">

         <div class="box">
            <p>Sản phẩm đã được thêm</p>
            <?php
               $select_products = $conn->prepare("SELECT * FROM `sanpham`");
               $select_products->execute();
               $numbers_of_products = $select_products->rowCount();
            ?>
            <h3><?= $numbers_of_products; ?></h3>
            <a href="ql_sanpham.php" class="btn">Xem chi tiết</a>
         </div>

         <div class="box">
            <p>Tổng đơn đặt hàng</p>
            <?php
               $select_orders = $conn->prepare("SELECT * FROM `dathang`");
               $select_orders->execute();
               $numbers_of_orders = $select_orders->rowCount();
            ?>
            <h3><?= $numbers_of_orders; ?></h3>
            <a href="ql_dathang.php" class="btn">Xem chi tiết</a>
         </div>


         <div class="box">
            <p>Tổng đơn đang chờ duyệt</p>
            <?php
               $total_pendings = 0;
               $select_pendings = $conn->prepare("SELECT * FROM `dathang` WHERE trangthai_TT = ?");
               $select_pendings->execute(['đang chờ duyệt']);
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['tong_chiphi'];
               }
               $numbers_of_pending = $select_pendings->rowCount();
            ?>
            <h3></h3>
            <h3><?= $numbers_of_pending ?> (<?= $total_pendings; ?><span style="font-family: Arial, Helvetica, sans-serif;  color: black;  font-weight: bold; font-size: 2.7rem;">000 đ</span>)</h3>
            <a href="ql_dathang.php" class="btn">Xem chi tiết</a>
         </div>

         <div class="box">
            <p>Tổng đơn hoàn thành</p>
            <?php
               $total_completes = 0;
               $select_completes = $conn->prepare("SELECT * FROM `dathang` WHERE trangthai_TT = ?");
               $select_completes->execute(['Hoàn thành']);
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['tong_chiphi'];
               }
               $numbers_of_completes = $select_completes->rowCount();
            ?>
            <h3></h3>
            <h3><?= $numbers_of_completes ?> (<?= $total_completes; ?><span style="font-family: Arial, Helvetica, sans-serif;  color: black;  font-weight: bold; font-size: 2.7rem;">000 đ</span>)</h3>
            <a href="ql_dathang.php" class="btn">Xem chi tiết</a>
         </div>

         
         
         <div class="box">
            <p>Tài khoản khách hàng</p>
            <?php
               $select_users = $conn->prepare("SELECT * FROM `khachhang`");
               $select_users->execute();
               $numbers_of_users = $select_users->rowCount();
            ?>
            <h3><?= $numbers_of_users; ?></h3>
            <a href="ql_khachhang.php" class="btn">Xem chi tiết</a>
         </div>

         
         <div class="box">
            <p>Liên hệ mới</p>
            <?php
               $select_messages = $conn->prepare("SELECT * FROM `loinhan`");
               $select_messages->execute();
               $numbers_of_messages = $select_messages->rowCount();
            ?>
            <h3><?= $numbers_of_messages; ?></h3>
            <a href="ql_lienhe.php" class="btn">Xem chi tiết</a>
         </div>
      </div>
   </section>

   <script src="js/admin_script.js"></script>
</body>
</html>