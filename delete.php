<?php
require_once 'config.php';
require_once 'pelangganService.php';

$database = new Database();
$db = $database->getConnection();

$pelanggan = new Pelanggan($db);

$pelanggan->id = isset($_GET['id']) ? $_GET['id'] : die('Error id tidak ditemukan');

$pelanggan->delete();
header("Location: index.php");
exit();
?>