<?php

require 'koneksi.php';
$id_vendors = $_POST["id_vendors"];
$sql_get_nanas = "SELECT * FROM tb_detail_paket WHERE id_vendor='$id_vendors' ORDER BY id_paket DESC";
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

$response = ['status' => $status, 'paket' => $response_data];
echo json_encode($response);
?>