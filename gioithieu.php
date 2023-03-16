<?php
include 'partials/connect.php';
session_start();
if(isset($_SESSION['id_khach'])){
    $user_id = $_SESSION['id_khach'];
}
else{
    $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giới thiệu</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">
</head>

<body>
<?php include 'partials/user_header.php'; ?>
    <section class="about">
         <div class="content">
            <h3>Tại sao lại chọn Bakery</h3><br><br>
            <ol>
               <li><b>Về an toàn vệ sinh thực phẩm:</b> Bakery cam kết không sử dụng chất phụ gia, chất bảo quản, hương liệu trong bánh. Nguyên liệu của Bakery cũng được lựa chọn rất kỹ càng, có nguồn gốc xuất xứ rõ ràng, đảm bảo an toàn vệ sinh cho mọi thực khách</li>
               <li><b>Đa dạng mẫu mã, kiểu dáng</b> cung cấp đa dạng các mẫu bánh sinh nhật, bánh mỳ, bánh bao,....</li>
               <li><b>Cam kết giao hàng đúng thời gian:</b> luôn chuẩn bị, hoàn thành sản phẩm theo yêu cầu của khách từ sớm để kịp cho việc vận chuyển đúng hạn. <b>TẬN TÂM</b> và <b>NHIỆT TÌNH</b> cho quý khách.</li>
               <li><b>Đội ngũ nhân viên chuyên nghiệp, nhiệt tình:</b> đội ngũ nhân viên cũng hết sức thân thiện, dễ thương và sẵn sàng tư vấn cũng như giải đáp thắc mắc cho mọi khách hàng.</li>
            </ol>
            <a href="lienhe.php" class="btn">Liên hệ ngay</a>
         <div>
    </section>

    <section class="introduce" id="introduce">
        <div class="content">
            <span style="color: #ce2448;">Bánh sinh nhật</span>
            <p>Bánh sinh nhật thường xuất hiện trong những bữa tiệc sinh nhật, tiệc cưới, tiệc mừng hay những buổi lễ quan trọng khác. Tuy nhiên bánh sinh nhật ngày nay trở nên thông dụng hơn trong cuộc sống của chúng ta, bánh sinh nhật là một món ăn ngọt có dạng cốt như một chiếc bánh bông lan xốp được dùng kem dày phủ lên để tăng hương vị và dùng để thực hiện trang trí cho chiếc bánh thêm hấp dẫn, bắt mắt. 
            <a href="banhsinhnhat.php" class="btn">Đến ngay nào</a>
        </div>
        <div class="image">
            <img src="images/gt5.jpg" alt="">
        </div>
    </section>

    <section class="introduce" id="introduce">
        <div class="image">
            <img src="images/gt6.jpg"style="height:400px" alt="">
        </div>
        <div class="content">
            <span style="color: #ce2448;">Bánh mì</span>
            <p style="font-size: 21px;">Bánh mì (bread): là các loại bánh được hình thành từ các loại nguyên liệu cơ bản như bột mì, men, muối, nước và các nguyên liệu bổ sung khác để tạo nên một dạng bánh xốp, dai, giòn và đặc trưng theo từng loại. bánh mì ngọt là các loại bánh có vỏ mềm, ruột xốp và thường được kết hợp với các nguyên liệu khác để tạo hình.
               </p>
            <a href="banhmi.php" class="btn">Đến ngay nào</a>
        </div>
    </section>
   
    <section class="introduce" id="introduce">
        <div class="content">
            <span style="color: #ce2448;">Bánh cupcake</span>
            <p>Cupcake là chiếc bánh nhỏ xinh, nhiều màu sắc sặc sỡ được phối hợp vô cùng hài hòa và bắt mắt. Chiếc bánh Cupcake thật ra là một chiếc bánh gato mini, được đựng trong những tờ giấy mỏng hoặc là lá nhôm có hình dạng “cup”, đó cũng là nguồn gốc tên của chiếc bánh này. Tuy nhỏ nhưng bề mặt bánh được trang trí bằng đủ loại màu sắc bằng kem hoặc kẹo, các loại mứt trái cây….</p>
            <a href="banhcupcake.php" class="btn">Đến ngay nào</a>
        </div>
        <div class="image">
            <img src="images/gt7.jpg" alt="">
        </div>
    </section>
    
    <section class="introduce" id="introduce">
        <div class="image">
            <img src="images/gt8.jpg"style="height:400px" alt="">
        </div>
        <div class="content">
            <span style="color: #ce2448;">Bánh bông lan</span>
            <p style="font-size: 21px;">Bánh bông lan là một loại bánh có nguồn gốc lâu đời, xuất hiện đầu tiên ở châu Âu. Bánh bông lan là một loại bánh có kết cấu vô cùng tinh tế, được ra đời từ thời Phục Hưng (khoảng thế kỷ XVII). Nguyên liệu cơ bản làm nên một chiếc bánh bông lan cơ bản chỉ có bột mì, bơ, đường, trứng.
               </p>
            <a href="banhbonglan.php" class="btn">Đến ngay nào</a>
        </div>
    </section>
    
    <section class="introduce" id="introduce">
        <div class="content">
            <span style="color: #ce2448;">Bánh bao</span>
            <p>Bánh bao là một loại bánh làm bằng bột mỳ có nhân và hấp chín, chiên hoặc nướng trước khi ăn trong ẩm thực Trung Hoa. Nó khá giống với loại bánh màn thầu truyền thống cũng của Trung Quốc nhưng hai loại bánh này hoàn toàn không liên quan gì đến nhau. Người ta sử dụng bánh bao như một món bánh tượng trưng cho sự trường thọ, sung túc cũng như mong ước của con người về điều này. Sự tròn đầy của bánh bao được ví với sự sung túc, đầy đặn nên rất thường được sử dụng trong một số bữa tiệc hay cúng bái.</p>
            <a href="banhbao.php" class="btn">Đến ngay nào</a>
        </div>
        <div class="image">
            <img src="images/gt10.jpg" alt="">
        </div>
    </section>
<br><br>
    <section class="introduce" id="introduce">
        <div class="content">
            <span style="color: #ce2448;"><b>HÃY ĐẾN VỚI FLOWER CHÚNG TÔI CAM KẾT SẼ HOÀN TIỀN 100% NHỮNG SẢN PHẨM NÀO CÓ DẤU HIỆU HƯ HỎNG</b></span>
        </div>
    </section>
   
<?php include 'partials/footer.php';?>


<script src="js/script.js"></script>

</body>
</html>