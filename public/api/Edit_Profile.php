<?php
include 'koneksi.php';
$id         =$_POST['id'];
$name       =$_POST['name'];
$username   =$_POST['username'];
$email      =$_POST['email'];
$password   =$_POST['password'];
$no_telp     =$_POST['no_telp'];
$alamat     =$_POST['alamat'];
$pass=password_hash($password, PASSWORD_DEFAULT);
$sql ="UPDATE users SET username='$username',password='$pass',name='$name',email='$email',no_telp='$no_telp' WHERE id='$id'";
// $query =mysqli_query($conn,$sql);

// echo json_encode($response);
	if ($conn->query($sql) === TRUE) {
    // echo $status="true";
    // json_encode($status);
	} else {
   	// echo "Gagal Ditambahkan pesanan". $conn->error;
	}
?>