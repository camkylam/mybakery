<?php

include 'partials/connect.php';

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
};

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `dathang` SET trangthai_TT = ? WHERE id_dathang = ?");
   $update_status->execute([$payment_status, $order_id]);
   $error[] = 'Trạng thái đơn hàng đã được cập nhật!';
   include 'partials/show_error.php'; 
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `dathang` WHERE id_dathang = ?");
   $delete_order->execute([$delete_id]);
   header('location:ql_dathang.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý đặt hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="css/style_admin.css">
   
</head>
<body>

<?php include 'partials/admin_header.php' ?>
   <span class=head4>Quản Lý Đặt Hàng</span>
   <section id="inner" class="inner-section section">
      <div class="inner-wrapper row">
			<div class="col-md-12">
				<table id="product" class="table table-bordered table-responsive table-striped">
					<thead class="th">
						<tr>
							<th><b>Id khách hàng</b></th>
							<th><b>Thời gian đặt hàng</b></th>
                     <th><b>Tên khách<b></th>
							<th><b>Email<b></th>
							<th><b>Số điện thoại<b></th>
                     <th><b>Địa chỉ<b></th>
                     <th><b>Tổng sản phẩm<b></th>
                     <th><b>Tổng chi phí<b></th>
                     <th><b>Phương thức thanh toán<b></th>
                     <th></th>
                     <th></th>
						</tr>
					</thead>
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `dathang`");
                  $select_orders->execute();
                     if($select_orders->rowCount() > 0){
                        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
               ?>
					<tbody>
                  <tr>
                     <th><?= $fetch_orders['id_khach']; ?></th>
							<th><?= $fetch_orders['gio_dat']; ?></th>
                     <th><?= $fetch_orders['ten_khach']; ?></th>
							<th><?= $fetch_orders['email']; ?></th>
							<th><?= $fetch_orders['sodienthoai']; ?></th>
                     <th><?= $fetch_orders['diachi']; ?></th>
                     <th><?= $fetch_orders['tong_sp']; ?></th>
                     <th><?= $fetch_orders['tong_chiphi']; ?></th>
                     <th><?= $fetch_orders['phuongthuc']; ?></th>
                     <th>
                        <form action="" method="POST">
                           <input type="hidden" name="order_id" value="<?= $fetch_orders['id_dathang']; ?>">
                           <select name="payment_status" class="drop-down" style="border: 1px solid black; border-radius: 5px;">
                              <option value="Đang chờ duyệt"><?= $fetch_orders['trangthai_TT']; ?></option>
                              <option value="Đang chờ duyệt">Đang chờ duyệt</option>
                              <option value="Hoàn thành">Hoàn thành</option>
                           </select>
                     </th>
                     <th>
                           <div class="flex-btn">
                              <input type="submit" value="Cập nhật" class="option-btn update" name="update_payment">
                              <a href="ql_dathang.php?delete=<?= $fetch_orders['id_dathang']; ?>" class="delete-btn" onclick="return confirm('Bạn muốn xóa đặt hàng này?');">Xóa</a>
                           </div>
                     
                        </form>
                     </th>   
                  <tr>
					</tbody>
               <?php
                        }
                     }else{
                        echo '<p class="empty">Chưa có thông tin đặt hàng</p>';
                     }
               ?>
				</table>
			</div>
		</div> 
   </section>

<script src="js/admin_script.js"></script>

</body>
</html>