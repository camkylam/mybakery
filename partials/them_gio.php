
<?php

if(isset($_POST['them_gio'])){

   if($user_id == ''){
      header('location:dangnhap.php');
   }else{

      $id_sp = $_POST['id_sp'];
      $id_sp = filter_var($id_sp, FILTER_SANITIZE_STRING);
      $ten_sp = $_POST['ten_sp'];
      $ten_sp = filter_var($ten_sp, FILTER_SANITIZE_STRING);
      $gia_sp = $_POST['gia_sp'];
      $gia_sp = filter_var($gia_sp, FILTER_SANITIZE_STRING);
      $anh_sp = $_POST['anh_sp'];
      $anh_sp = filter_var($anh_sp, FILTER_SANITIZE_STRING);
      $soluong_sp = $_POST['soluong_sp'];
      $soluong_sp = filter_var($soluong_sp, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `giohang` WHERE ten_sp = ? AND id_khach = ?");
      $check_cart_numbers->execute([$ten_sp, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $error[] = 'Sản phẩm đã có trong giỏ hàng!';
      }else{

         $insert_cart = $conn->prepare("INSERT INTO `giohang`(id_khach, id_sp, ten_sp, gia_sp, soluong_sp, anh_sp) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $id_sp, $ten_sp, $gia_sp, $soluong_sp, $anh_sp]);
         $error[] = 'Sản phẩm được thêm vào giỏ hàng thành công';
      }

   }

}

?>
<?php include 'partials/show_error.php'; ?>
