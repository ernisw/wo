<?php

include 'koneksi.php';
	class usr{}
	
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
	
	if ((empty($username)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}
	
	$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
		$response = new usr();
		$response->success = "true";
		$response->message = "Selamat datang ".$row['username'];
		$response->id = $row['id'];
        $response->username = $row['username']; 
        $response->name = $row['name']; 
        $response->email = $row['email']; 
        $response->no_telp = $row['no_telp']; 
        $response->alamat = $row['alamat']; 
        $response->gambar = $row['gambar']; 
        $response->foto = $row['foto']; 
     

		die(json_encode($response));
		
	} else { 
		$response = new usr();
		$response->success = "false";
		$response->message = "Username atau password salah, Mohon Ulangi";
		die(json_encode($response));
	}
	
	mysqli_close($conn);

?>