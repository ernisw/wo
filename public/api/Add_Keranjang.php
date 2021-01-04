<?php
 require_once 'koneksi.php';
 class usr{}
 $Nama = $_POST["nama_paket"];
 $ID = $_POST["ID"];
 $total = $_POST["total"];
 $NAMA = $_POST["nama_vendor"];
 $id = $_POST["id"];
 $gambar_vendor = $_POST["gambar_vendor"];
//  $settanggal_nikah = $_POST["set_tanggal_nikah"];
 $status="Proses";

	if ((empty($Nama))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($NAMA))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong";
		die(json_encode($response));
	} else {
        $sql = mysqli_query($conn," INSERT INTO tb_transaksi (id_vendor,id,nama_vendor,nama_paket,total,gambar_vendor,status)
        VALUES( '$ID','$id','$NAMA','$Nama','$total', '$gambar_vendor','$status')") or die(mysqli_error($conn));
				if ($sql){
					$response = new usr();
					$response->success = "true";
					$response->message = "Data berhasil ditambahkan, silahkan lanjutkan ke pembayaran.";
					die(json_encode($response));

				} else {
					$response = new usr();
					$response->success = "false";
					$response->message = "Data sudah ada";
					die(json_encode($response));
				}
            } 
           

	mysqli_close($conn);
?>