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

    $update_profile = $conn->prepare("UPDATE `khachhang` SET ten_khach=?, email=? WHERE id_khach = ?");
    $update_profile->execute([$name, $email, $user_id]);

    $empty_pass='';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass= $_POST['cpass'];
    $cpass = filter_var($cpass,FILTER_SANITIZE_STRING);

    if($old_pass == $empty_pass){
        $error[] ='Bạn hãy nhập vào password';
        include 'partials/show_error.php';
    }
    elseif($old_pass != $prev_pass){
        $error[]='Password cũ của bạn không khớp';
        include 'partials/show_error.php';
    }
    elseif($new_pass != $cpass){
        $error[] ='Nhập lại mật khẩu không khớp';
        include 'partials/show_error.php';
    }
    else{
        if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `khachhang` SET password = ? WHERE id_khach = ?");
            $update_pass->execute([$cpass, $user_id]);
            $error[] = 'Thông tin đã cập nhật thành công';
            include 'partials/show_error.php';
        }
        else {
            $error[] ='Nhập vào mật khẩu mới';
            include 'partials/show_error.php';
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
   <title>Chỉnh sửa hồ sơ</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="css/style_user.css">

</head>
<body>
    <?php include 'partials/user_header.php';?>

    <section class="form-container">
        <form action="" method="post">
            <h3><b>CẬP NHẬT THÔNG TIN CÁ NHÂN</b></h3>
            <div class="form-input">
                <input  type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?> ">
            </div>
            <div class="form-input">
            <input type="text" name="name" require placeholder="Nhập vào tên đăng nhập của bạn" maxlenght="20" class="box" value="<?= $fetch_profile["ten_khach"]; ?>">
            </div>
            <div class="form-input">
            <input type="email" name="email" require placeholder="Nhập vào email của bạn" maxlength="50" class="box" value="<?=$fetch_profile["email"]; ?>">
            </div>
            <div class="form-input">
                <input type="password" name="old_pass" pattern=".{6,}" title="Nhập vào mật khẩu cũ của bạn" placeholder="Nhập vào mật khẩu cũ của bạn" required>
            </div>
            <div class="form-input">
                <input type="password" name="new_pass" pattern=".{6,}" title="Nhập vào mật khẩu mới" placeholder="Nhập vào mật khẩu mới" required>
            </div>
            <div class="form-input">
                <input type="password" name="cpass" pattern=".{6,}" title="Nhập lại mật khẩu mới" placeholder="Nhập lại mật khẩu mới " required>
            </div>
            <input type="submit" value="CẬP NHẬT" class="btn" name="submit">
    
        </form>
    </section>
    <?php include 'partials/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>