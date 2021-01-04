<?php

require 'koneksi.php';
$id_pengguna = $_POST["id_pengguna"];
$status="Proses";
$sql_get_nanas = "SELECT * FROM tb_transaksi WHERE id_pengguna='$id_pengguna' AND status='$status'";
$query = $conn->query($sql_get_nanas);

$response_data = null;

while ($data = $query->fetch_assoc()) {
	$response_data[] = $data;
}

if (is_null($response_data)) {
	$status = false;
} else {
	$status = true;
}

header('Content-Type: application/json');

$response = ['status' => $status, 'transaksi' => $response_data];
echo json_encode($response);
?>