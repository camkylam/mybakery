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
   <title>Trang chủ</title>
 
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style_user.css">
  
</head>

<body>

<?php include 'partials/user_header.php'; ?>
   <section class="home">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="images/nav20.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5 class="multilang1" ><b>Welcome to the Bakery shop</b></h5>
                  <p class="multilang2" >Bring Your Special Days Wonderful All Feeling</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/nav21.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5 class="multilang1" ><b>Welcome to the Bakery shop</b></h5>
                  <p class="multilang2">Bring Your Special Days Wonderful All Feeling</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/nav24.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5 class="multilang1" ><b>Welcome to the Bakery shop</b></h5>
                  <p class="multilang2">Bring Your Special Days Wonderful All Feeling</p>
               </div>
            </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
   </section>

   <section class="category">
      <h1 class="heading"><b>Danh mục các sản phẩm</b></h1>
      <div class="swiper category-slider">
         <div class="swiper-wrapper slide1">
            <a href="banhsinhnhat.php" class="swiper-slide slide">
               <img src="images/id1.jpg" alt="">
               <h3>Bánh sinh nhật</h3>
            </a>
            <a href="banhmi.php" class="swiper-slide slide">
               <img src="images/id2.jpg" alt="">
               <h3>Bánh mỳ</h3>
            </a>
            <a href="banhcupcake.php" class="swiper-slide slide">
               <img src="images/id3.jpg" alt="">
               <h3>Bánh cupcake</h3>
            </a>
            <a href="banhbonglan.php" class="swiper-slide slide">
               <img src="images/id4.jpg" alt="">
               <h3>Bánh bông lan</h3>
            </a>
            <a href="banhbao.php" class="swiper-slide slide">
               <img src="images/id6.jpg" alt="">
               <h3>Bánh bao</h3>
            </a>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>

<section class="home-products">

   <h1 class="heading"><b>Sản phẩm được yêu thích nhất</b></h1>

   <div class="box-container">
        <?php
     $select_products = $conn->prepare("SELECT * FROM `sanpham` WHERE trangthai_sp='được yêu thích nhất'"); 
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
         echo '<p class="empty">Không tìm thấy sản phẩm</p>';
      }
   ?>
</div>
</section>

<section class="home-products">

   <h1 class="heading"><b>Sản phẩm được bán chạy nhất</b></h1>
   <div class="box-container">
   <?php
     $select_products = $conn->prepare("SELECT * FROM `sanpham` WHERE trangthai_sp='được bán chạy nhất'"); 
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
         echo '<p class="empty">Không tìm thấy sản phẩm</p>';
         }
   ?>
</div>
</section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>
   
   var swiper = new Swiper(".category-slider", {
      loop:true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable:true,
      },
      breakpoints: {
         0: {
            slidesPerView: 2,
         },
         650: {
            slidesPerView: 3,
         },
         768: {
            slidesPerView: 4,
         },
         1024: {
            slidesPerView: 5,
         },
      },
   });

</script>

</body>
<?php include 'partials/footer.php'; ?>
</html>
