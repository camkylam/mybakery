<?php

include 'partials/connect.php';

session_start();

if(isset($_SESSION['id_khach'])){
   $user_id = $_SESSION['id_khach'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `khachhang` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $error[] = 'email đã tồn tại';
      include 'partials/show_error.php'; 
   }else{
      if($pass != $cpass){
         $error[] = 'Nhập lại mật khẩu không khớp';
         include 'partials/show_error.php'; 
      }else{
         $insert_user = $conn->prepare("INSERT INTO `khachhang`(ten_khach, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $error[] = 'Đăng ký thành công, đăng nhập ngay!';
         include 'partials/show_error.php'; 
      }
   }
}
?>

<!DOCTYPE html>
<html lang="vn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>
 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style_user.css">

</head>

<body>
   
<?php include 'partials/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <div class="form-group" style="padding: 9px 0;">
         <lable style="font-size: 20px;float:left;" for="ten">Họ và Tên:</lable>
         <input required type="text" name="name"  pattern=".{5,20}" title="Độ dài tối thiểu là 5 ký tự tối đa là 20 ký tự" class="form-control">
      </div>
      <div class="form-group" style="padding: 9px 0;">
         <lable style="font-size: 20px; float:left;" for="email">Email:</lable>
         <input type="Email" name="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Vui lòng nhập đúng định dạng email" class="form-control">
      </div>
      <div class="form-group" style="padding: 9px 0;">
         <lable style="font-size: 20px; float:left;" for="password">Password:</lable>
         <input type="password" name="pass" pattern=".{6,}" title="Mật khẩu có ít nhất 6 ký tự " class="form-control">
      </div>
      <div class="form-group" style="padding: 9px 0;">
         <lable style="font-size: 20px; float:left;" for="password">Nhập lại password:</lable>
         <input type="password" name="cpass" pattern=".{6,}" title="Mật khẩu có ít nhất 6 ký tự " class="form-control">
      </div>
      <button class="btn" name="submit" style="border-radius:20px; width:100%">Đăng ký</button> <br><br>
      <hr class="my-4">
      <div class="text-center mb-2" style="font-size: 18px;  font-family: Arial, Helvetica, sans-serif;">Bạn đã có tài khoản ?
         <a href="dangnhap.php" style=" font-family: Arial, Helvetica, sans-serif;" class="register-link">Đăng nhập</a>
      </div>
      </form>
</section>

<?php include 'partials/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>