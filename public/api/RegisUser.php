<?php
 require_once 'koneksi.php';
 class usr{}
	$username = $_POST["username"];
    $no_telp = $_POST["no_telp"]; 
    $name = $_POST["name"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $password = md5($_POST["password"]);
    // $gambar_pengguna = ($_POST["gambar_pengguna"]);
	if ((empty($username))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom username tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($password))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom password tidak boleh kosong";
		die(json_encode($response));
	} else {
		// $query = mysqli_query($conn, "INSERT INTO tbl_user (username, password, name, email, no_telp, gambar )VALUES('".$username."','".$password."','".$nama_lengkap."','".$email."','".$no_telp."','".$gambar_pengguna."')");
        $sql = mysqli_query($conn, "INSERT INTO tb_pengguna(username,password,name,email,no_telp, alamat)
        VALUES( '$username','$password','$nama_lengkap','$email','$no_telp')") or die(mysqli_error($conn));
				if ($sql){
					$response = new usr();
					$response->success = "true";
					$response->message = "Register berhasil, silahkan login.";
					die(json_encode($response));

				} else {
					$response = new usr();
					$response->success = "false";
					$response->message = "Username sudah ada";
					die(json_encode($response));
				}
            } 
	mysqli_close($conn);
?>