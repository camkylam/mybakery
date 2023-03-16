<?php

include 'partials/connect.php';
session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
   header('location:dangnhap.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phone = $_POST['number'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $address = $_POST['add'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `loinhan` WHERE ten_khach = ? AND email = ? AND sodienthoai = ? AND diachi = ? AND loi_nhan = ?");
   $select_message->execute([$name, $email, $phone,$address, $msg]);

   if($select_message->rowCount() > 0){
      $error[] = 'Lời nhắn đã tồn tại!';
      include 'partials/show_error.php';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `loinhan`(id_khach, ten_khach, email, sodienthoai ,diachi, loi_nhan) VALUES(?,?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $phone,$address, $msg]);

      $error[] = 'Gửi liên hệ thành công!';
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
   <title>Liên hệ</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">
</head>

<body>
<?php include 'partials/user_header.php'; ?>

   <section class="contact" id="contact">
      <h1 style="color: rgb(192, 146, 19); font-size:45px; font-family: serif; font-style: italic;"><b>Bakery</b></h1><br>
      <p class="lienhe1">
         <span class="lienhe">Add:</span>&nbsp; 3/2, Ninh Kiều, Cần Thơ 
      </p>
      <p class="lienhe1">
          <span class="lienhe">Hotline:</span>&nbsp;0326889223
      </p>
      <p class="lienhe1">
         <span class="lienhe">Email:</span>&nbsp; bakery@gmail.com
      </p>
      <p class="lienhe1"><span class="lienhe">Fanpage:</span>&nbsp; https://facebook.com/bakery </p>
      <p class="lienhe1">
         <span class="lienhe">Website:</span>&nbsp; https://bakery.com
      </p><br><br>
      <span class="gopy">Nếu bạn có góp ý, Vui lòng điền thông tin vào form bên dưới, chúng tôi sẽ trả lời trong thời gian sớm nhất có thể</span> <br><br>  
   </section>


   <section class="contact" id="contact">

      <h1 class="heading"> <span>Liên hệ</span></h1>

      <form action="" method="post">
         <div>
            <img style="width:300px; height:300px; " src="images/contact1.jpg">
         </div>
         <br>
         <div class="inputBox">
            <input required type="text" name="name" pattern=".{5,20}" placeholder="Họ và tên:" title="Độ dài tối thiểu là 5 ký tự tối đa là 20 ký tự">
            <input required name="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Vui lòng nhập đúng định dạng email" type="text" placeholder="email:">
         </div>

         <div class="inputBox">
            <input type="tel" name="number" required pattern="^(0[234][0-9]{8}|1[89]00[0-9]{4})$" title="Chỉ nhập số và đúng với định dạng số điện thoại" placeholder="Số điện thoại:">
            <input required name="add" pattern=".{10,}" title="Nhập vào địa chỉ của bạn, ít nhất 6 ký tự" type="text" placeholder="Địa chỉ liên hệ:">
         </div>
         <textarea required placeholder="Nội dung:" name="msg" id="" cols="30" rows="10" minlength="5" maxlength="90" title="Độ dài tối thiểu là 10 tối đa 90 ký tự "></textarea>
        <input type="submit" name="send" value="Gửi " class="btn">
      </form>
   </section>

   <?php include 'partials/footer.php' ?>
    <script src="js/script.js"></script>
</body>
</html>