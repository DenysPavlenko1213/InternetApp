<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST["id"])) {
    die("Brak ID planu.");
}

$plan_id = intval($_POST["id"]);
$period = $_POST["period"] ?? "1 miesiąc";
$os = $_POST["os"] ?? "Ubuntu 22.04";
$stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
$stmt->execute([$plan_id]);
$plan = $stmt->fetch();

if (!$plan) {
    die("Plan nie istnieje.");
}
$final_price = $_POST["final_price"] ?? $plan["price"];
function fake_ip() {
    return rand(10, 250) . "." . rand(0, 255) . "." . rand(0, 255) . "." . rand(1, 254);
}

$ip = fake_ip();

$stmt = $pdo->prepare("
    INSERT INTO orders (user_id, plan_id, status, ip, period, os, price)
    VALUES (?, ?, 'Aktywny', ?, ?, ?, ?)
");
$stmt->execute([$_SESSION["user_id"], $plan_id, $ip, $period, $os, $final_price]);
$token = bin2hex(random_bytes(16));
$_SESSION['success_token'] = $token;
header("Location: order_paid_status.php?plan_id=" . $plan_id . "&token=" . $token);
exit;


