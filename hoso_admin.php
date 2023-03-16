<?php

include 'partials/connect.php';

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `admin` SET ten=?, email=? WHERE id = ?");
   $update_profile->execute([$name, $email, $admin_id]);

   $empty_pass = '';
   $select_old_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
   $select_old_pass->execute([$admin_id]);
   $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = $_POST['confirm_pass'];
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $error[] ='Mật khẩu cũ không khớp';
         include 'partials/show_error.php';
      }elseif($new_pass != $confirm_pass){
         $error[] ='Nhập lại mật khẩu không khớp';
         include 'partials/show_error.php';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $admin_id]);
            $error[] ='Cập nhật mật khẩu thành công';
            include 'partials/show_error.php';
         }else{
            $error[] ='Vui lòng nhập vào password mới';
            include 'partials/show_error.php';
         }
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
   <title>Cập nhật tài khoản admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
   <link rel="stylesheet" href="css/style_admin.css">

</head>
<body>

<?php include 'partials/admin_header.php' ?>
<span class=head7>Cập nhật tài khoản admin</span>
<section class="form-container">

   <form action="" method="POST">
   <input type="text" name="name" require placeholder="Nhập vào tên đăng nhập của bạn" maxlenght="20" class="box" value="<?= $fetch_profile["ten"]; ?>">
      <input type="email" name="email" require placeholder="Nhập vào email của bạn" maxlength="50" class="box" value="<?=$fetch_profile["email"]; ?>">
      <input type="password" name="old_pass" maxlength="20" placeholder="Nhập vào mật khẩu cũ" class="box" >
      <input type="password" name="new_pass" maxlength="20" placeholder="Nhập vào mật khẩu mới" class="box" >
      <input type="password" name="confirm_pass" maxlength="20" placeholder="Nhập lại mật khẩu mới" class="box" >
      <input type="submit" value="Cập nhật" name="submit" class="btn">
   </form>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>