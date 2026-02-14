<?php
session_start();
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require "db.php";

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(404);
    exit();
}

$plan_name = $_POST["name"];
$cpu = $_POST["cpu"];
$ram = $_POST["ram"];
$storage = $_POST["storage"];
$bandwidth = $_POST["bandwidth"];
$price = $_POST["price"];
$description = $_POST["description"];
$stmt = $pdo->prepare("SELECT * FROM plans WHERE name = ?");
$stmt->execute([$plan_name]);
$plan = $stmt->fetch();

if ($plan) {
    die("Plan o nazwie '$plan_name' już istnieje.");
}

$stmt = $pdo->prepare("
    INSERT INTO plans (name, cpu, ram, storage, bandwidth, price, description)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([$plan_name, $cpu, $ram, $storage, $bandwidth, $price, $description]);
header("Location: admin_panel.php");
?>


