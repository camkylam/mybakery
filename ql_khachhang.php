<?php

include 'partials/connect.php';

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `khachhang` WHERE id_khach = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `dathang` WHERE id_khach = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `giohang` WHERE id_khach = ?");
   $delete_cart->execute([$delete_id]);
   header('location:ql_khachhang.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý tài khoản khách hàng</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
   <link rel="stylesheet" href="css/style_admin.css">
</head>

<body>

<?php include 'partials/admin_header.php' ?>
   <span class=head6>Quản lý khách hàng</span>
   <section id="inner" class="inner-section section">
      <div class="inner-wrapper row">
			<div class="col-md-12">
				<table id="product" class="table table-bordered table-responsive table-striped">
					<thead class="th"style="text-align:center; font-weight: bold;">
						<tr>
							<th>ID khách hàng</th>
							<th>Tên khách hàng</th>
							<th>Email khách hàng</th>
                     <th></th>
						</tr>
					</thead>
               <?php
                  $select_account = $conn->prepare("SELECT * FROM `khachhang`");
                  $select_account->execute();
                  if($select_account->rowCount() > 0){
                     while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
               ?>
					<tbody>
                  <tr style="text-align:center; font-size:16px">
                     <th><?= $fetch_accounts['id_khach']; ?></th>
							<th><?= $fetch_accounts['ten_khach']; ?></th>
                     <th><?= $fetch_accounts['email']; ?></th>
                     <th><a href="ql_khachhang.php?delete=<?= $fetch_accounts['id_khach']; ?>"class="delete-btn detele" onclick="return confirm('Bạn muốn xóa tài khoản này');">Xóa</a></th>
                  <tr>
					</tbody>
               <?php
                     }
                  }else{
                     echo '<p class="empty">Chưa có tài khoản thành viên</p>';
                  }
               ?>
				</table>
			</div> 
		</div>  
   </section>


<script src="js/admin_script.js"></script>

</body>
</html>