<?php

include 'partials/connect.php';

session_start();

$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
   header('location:dangnhap.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `loinhan` WHERE id_loinhan = ?");
   $delete_message->execute([$delete_id]);
   header('location:ql_lienhe.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý liên hệ</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>

<?php include 'partials/admin_header.php' ?>
<span class=head5>Quản lý liên hệ</span>
   <section id="inner" class="inner-section section">
      <div class="inner-wrapper row">
			<div class="col-md-12">
				<table id="product" class="table table-bordered table-responsive table-striped">
					<thead class="th">
						<tr>
							<th>Tên khách hàng</th>
							<th>Số điện thoại</th>
                     <th>Email</th>
							<th>Nội dung liên hệ</th>
							<th></th>
						</tr>
					</thead>
               <?php
                  $select_messages = $conn->prepare("SELECT * FROM `loinhan`");
                  $select_messages->execute();
                  if($select_messages->rowCount() > 0){
                     while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
               ?>
					<tbody>
                  <tr>
                     <th><?= $fetch_messages['ten_khach']; ?></th>
							<th><?= $fetch_messages['sodienthoai']; ?></th>
                     <th><?= $fetch_messages['email']; ?></th>
							<th><?= $fetch_messages['loi_nhan']; ?></th>
							<th><a href="ql_lienhe.php?delete=<?= $fetch_messages['id_loinhan']; ?>" class="delete-btn detele" onclick="return confirm('Bạn muốn xóa liên hệ này?');">Xóa</a></th>
                  <tr>
				   </tbody>
               <?php
                     }
                  }else{
                     echo '<p class="empty">Chưa có thông tin liên hệ</p>';
                  }
               ?>
				</table>
				</div>
			</div> 
   </section>


<script src="js/admin_script.js"></script>

</body>
</html>