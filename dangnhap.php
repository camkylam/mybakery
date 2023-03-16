<?php
include 'partials/connect.php';

session_start();
if(isset($_SESSION['id_khach'])){
    $user_id = $_SESSION['id_khach'];
}else{
    $user_id = '';
};
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass,FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `khachhang` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
        $_SESSION['id_khach'] = $row['id_khach'];
        header('location:index.php');
    }
    else if(isset($_POST['submit'])){
    $name = $_POST['email'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ?");
    $select_admin->execute([$name, $pass]);
    
    if($select_admin->rowCount() > 0){
       $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
       $_SESSION['id'] = $fetch_admin_id['id'];
       header('location:thongke.php');
    }else{
        $error[]="Sai username hoặc mật khẩu!";
        include 'partials/show_error.php';
    }
    }else{
        $error[]="Sai username hoặc mật khẩu!";
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
   <title>Đăng nhập</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="css/style_user.css">

</head>
<body>
<?php include 'partials/user_header.php'; ?>

    <section class="form-container">
        <form action="" method="post">
            <h3><b>ĐĂNG NHẬP</b></h3>
            <div class="form-input">
                <span><i class="fa fa-2x fas fa-envelope"></i></span>
                <input type="email"  name="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Vui lòng nhập đúng định dạng email" placeholder="Email:" required>
            </div>
            <div class="form-input">
                <span><i class="fa fa-2x fa-key" style="width:20px; height:20px"></i></span>
                <input type="password" name="pass" title="Đăng nhập đúng mật khẩu của bạn, phải có ít nhất 6 ký tự" placeholder="Password:" required>
            </div>
            <input type="submit" value="Đăng nhập" class="btn" name="submit">
            <div class="text-center mb-2" style="font-size: 14px; margin-top:20px;  font-family: Arial, Helvetica, sans-serif;">Bạn chưa có tài khoản đăng nhập 
                <a href="dangky.php"  style="font-size: 20px;  font-family: Arial, Helvetica, sans-serif;" class="register-link">Đăng ký tài khoản</a>
            </div>
        </form>
    </section>
   
    <?php include 'partials/footer.php' ?>
    <script src="js/script.js"></script>
</body>