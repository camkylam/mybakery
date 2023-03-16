<?php

include 'partials/connect.php';

session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
};
include 'partials/them_gio.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tìm kiếm</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">
</head>

<body>
<?php include 'partials/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Nhập tên sản phẩm cần tìm kiếm." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search'];
         $select_products = $conn->prepare("SELECT * FROM `sanpham` WHERE ten_sp LIKE '%$search_box%'"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="id_sp" value="<?= $fetch_product['id_sp']; ?>">
                  <input type="hidden" name="ten_sp" value="<?= $fetch_product['ten_sp']; ?>">
                  <input type="hidden" name="loai_sp" value="<?= $fetch_product['loai_sp']; ?>">
                  <input type="hidden" name="gia_sp" value="<?= $fetch_product['gia_sp']; ?>">
                  <input type="hidden" name="anh_sp" value="<?= $fetch_product['anh_sp']; ?>">
                  <img src="uploaded_img/<?= $fetch_product['anh_sp']; ?>" alt="">
                  <div class="name"><?= $fetch_product['loai_sp']; ?></div>
                  <div class="name1"><b><?= $fetch_product['ten_sp']; ?></b></div>
                  <div class="flex">
                     <div class="price"><?= $fetch_product['gia_sp']; ?>,<span>000 đ</span></div>
                     <input type="number" name="soluong_sp" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="them_gio">
               </form>
   <?php
            }
         }else{
            echo '<p class="emptyy">Không tìm thấy sản phẩm</p>';
            }
      }
   ?>
   </div>
</section>

<?php include 'partials/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>