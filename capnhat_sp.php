<?php
include 'partials/connect.php';
include 'partials/show_error.php';

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $trangthai = $_POST['trangthai'];
   $trangthai = filter_var($trangthai, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `sanpham` SET ten_sp = ?, loai_sp = ?, gia_sp = ?, trangthai_sp = ?  WHERE id_sp = ?");
   $update_product->execute([$name, $category, $price, $trangthai, $pid]);

   $error[] = 'Sản phẩm đã được cập nhật';
   include 'partials/show_error.php'; 

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $error[] = 'Kích thước ảnh quá lớn!';
      }else{
         $update_image = $conn->prepare("UPDATE `sanpham` SET anh_sp = ? WHERE id_sp = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cập nhật sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>

<?php include 'partials/admin_header.php' ?>
<span class=head3>Cập nhật sản phẩm</span>
<section class="update-product">

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `sanpham` WHERE id_sp = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id_sp']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['anh_sp']; ?>">
      <img src="uploaded_img/<?= $fetch_products['anh_sp']; ?>" alt="">
      <span >Cập nhật tên sản phẩm</span>
      <input type="text" required placeholder="Nhập tên sản phẩm" name="name" maxlength="100" class="box" value="<?= $fetch_products['ten_sp']; ?>">
      <span>Cập nhật giá sản phẩm</span>
      <input type="number" required placeholder="Nhập vào giá sản phẩm" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['gia_sp']; ?>">
      <span>Cập nhật loại sản phẩm</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products['loai_sp']; ?>"><?= $fetch_products['loai_sp']; ?></option>
         <option value="Bánh sinh nhật">Bánh sinh nhật</option>
         <option value="Bánh mỳ">Bánh mỳ</option>
         <option value="Bánh Cupcake">Bánh Cupcake</option>
         <option value="Bánh bông lan">Bánh bông lan</option>
         <option value="Bánh bao">Bánh bao</option>
      </select>
      <span>Cập nhật trạng thái sản phẩm</span>
      <select name="trangthai" class="box" required>
         <option selected value="<?= $fetch_products['trangthai_sp']; ?>"><?= $fetch_products['trangthai_sp']; ?></option>
         <option value="Bình thường" >Bình thường</option>
         <option value="Được yêu thích nhất">Được yêu thích nhất</option>
         <option value="Được bán chạy nhất">Được bán chạy nhất</option>
      </select>
      <span>Cập nhật ảnh sản phẩm</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Cập nhật" class="btn" name="update">
         <a href="ql_sanpham.php" class="btn">Trở về</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">Chưa có sản phẩm được thêm vào</p>';
      }
   ?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>