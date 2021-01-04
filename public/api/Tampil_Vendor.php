<?php

require 'koneksi.php';
$sql_get_nanas = "SELECT * FROM tb_vendor ORDER BY id_vendor DESC";
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

$response = ['status' => $status, 'vendor' => $response_data];
echo json_encode($response);
?>