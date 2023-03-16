<?php

include 'partials/connect.php';
include 'partials/show_error.php'; 

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $trangthai = $_POST['trangthai'];
   $trangthai = filter_var($trangthai, FILTER_SANITIZE_STRING);


   $select_products = $conn->prepare("SELECT * FROM `sanpham` WHERE ten_sp = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $error[] = 'Tên sản phẩm đã tồn tại';
      include 'partials/show_error.php'; 
   }else{
      if($image_size > 2000000){
         $error[] = 'Kích thước ảnh quá rộng';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `sanpham`(ten_sp, loai_sp, gia_sp, anh_sp,trangthai_sp) VALUES(?,?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image, $trangthai]);

         $error[] = 'Sản phẩm mới đã được thêm vào';
         include 'partials/show_error.php'; 
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `sanpham` WHERE id_sp = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `sanpham` WHERE id_sp = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `giohang` WHERE id_sp = ?");
   $delete_cart->execute([$delete_id]);
   header('location:ql_sanpham.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <link rel="stylesheet" href="css/style_admin.css">
</head>

<body>

<?php include 'partials/admin_header.php' ?>
<span class=head>Thêm Sản Phẩm</span>
<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="text" required placeholder="Nhập vào tên sản phẩm" name="name" maxlength="100" class="box">
      <input type="number" required placeholder="Nhập vào giá sản phẩm" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="Bánh sinh nhật" >Bánh sinh nhật</option>
         <option value="Bánh mỳ">Bánh mỳ</option>
         <option value="Bánh cupcake">Bánh cupcake</option>
         <option value="Bánh bông lan">Bánh bông lan</option>
         <option value="Bánh bao">Bánh bao</option>
      </select>
      <select name="trangthai" class="box" required>
         <option value="Bình thường" >Bình thường</option>
         <option value="Được yêu thích nhất">Được yêu thích nhất</option>
         <option value="Được bán chạy nhất">Được bán chạy nhất</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Thêm sản phẩm" name="add_product" class="btn">
   </form>

</section>

<span class=head1>Sản Phẩm Đã Được Thêm</span>
<section id="inner" class="inner-section section">
   <div class="inner-wrapper row">
	   <div class="col-md-12">
			<table id="product" class="table table-bordered table-responsive table-striped">
				<thead class="th" style="text-align:center; font-weight: bold; font-size:20px">
					<tr>
                  <th><b>Tên sản phẩm</b></th>
						<th><b>Ảnh sản phẩm<b></th>
                  <th><b>Giá sản phẩm<b></th>
						<th><b>Loại sản phẩm<b></th>
                  <th><b>Trạng thái sản phẩm<b></th>
						<th></th>
                  <th></th>
					</tr>
				</thead>
            <?php
               $show_products = $conn->prepare("SELECT * FROM `sanpham`");
               $show_products->execute();
               if($show_products->rowCount() > 0){
                  while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
            ?>
				<tbody>
               <tr style="text-align:center;">
                  <th><?= $fetch_products['ten_sp']; ?></th>
						<th><img src="uploaded_img/<?= $fetch_products['anh_sp']; ?>" alt=""></th>
                  <th><?= $fetch_products['gia_sp']; ?></th>
						<th><?= $fetch_products['loai_sp']; ?></th>
                  <th><?= $fetch_products['trangthai_sp']; ?></th>
						<th><a href="capnhat_sp.php?update=<?= $fetch_products['id_sp']; ?>" class="option-btn update">Cập nhật</a></th>
                  <th> <a href="ql_sanpham.php?delete=<?= $fetch_products['id_sp']; ?>" class="delete-btn detele" onclick="return confirm('Bạn muốn xóa sản phẩm này?');">Xóa</a></th>
               <tr>
				</tbody>
            <?php
                  }
               }else{
                  echo '<p class="empty">Chưa có sản phẩm được thêm</p>';
               }
            ?>
			</table>
		</div> 
	</div>    
</section>
<script src="js/admin_script.js"></script>

</body>
</html>