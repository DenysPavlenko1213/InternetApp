<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("Brak ID serwera.");
}

$order_id = intval($_GET["id"]);

$stmt = $pdo->prepare("
    SELECT orders.*, plans.name AS plan_name, plans.cpu, plans.ram, plans.storage 
    FROM orders 
    JOIN plans ON orders.plan_id = plans.id
    WHERE orders.id = ? AND orders.user_id = ?
");
$stmt->execute([$order_id, $_SESSION["user_id"]]);
$vps = $stmt->fetch();

if (!$vps)
    die("Serwer nie istnieje lub nie należy do Ciebie.");

function generate_password($length = 12)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    return substr(str_shuffle($chars), 0, $length);
}

if (isset($_POST["action"])) {

    $action = $_POST["action"];

    if ($action === "stop") {
        $stmt = $pdo->prepare("UPDATE orders SET status='Wyłączony' WHERE id=?");
        $stmt->execute([$order_id]);
    }

    if ($action === "start") {
        $stmt = $pdo->prepare("UPDATE orders SET status='Aktywny' WHERE id=?");
        $stmt->execute([$order_id]);
    }

    if ($action === "password") {
        $new_pass = generate_password();
        $stmt = $pdo->prepare("UPDATE orders SET root_password=? WHERE id=?");
        $stmt->execute([$new_pass, $order_id]);
    }

    header("Location: vps_manage.php?id=" . $order_id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie VPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <?php include "navbar.php"; ?>
    <div class="container py-5">
        <h1 class="fw-bold">Zarządzanie VPS</h1>
        <div class="card bg-dark text-light shadow-lg">
            <div class="card-body">

                <h3 class="mb-3"><?= htmlspecialchars($vps["plan_name"]) ?></h3>

                <span class="badge 
                    <?= $vps["status"] === 'Aktywny' ? 'bg-success' : 'bg-danger' ?> 
                    fs-6 px-3 py-2">
                    <?= $vps["status"] ?>
                </span>

                <hr class="border-light">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>IP:</strong> <?= $vps["ip"] ?></p>
                        <p><strong>System:</strong> <?= $vps["os"] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>CPU:</strong> <?= $vps["cpu"] ?></p>
                        <p><strong>RAM:</strong> <?= $vps["ram"] ?></p>
                        <p><strong>Dysk:</strong> <?= $vps["storage"] ?></p>
                    </div>
                </div>

                <hr class="border-light">

                <form method="POST" class="row g-3">

                    <div class="col-md-4">
                        <button name="action" value="restart" class="btn btn-warning w-100">
                            Restart
                        </button>
                    </div>

                    <div class="col-md-4">
                        <?php if ($vps["status"] === "Aktywny"): ?>
                            <button name="action" value="stop" class="btn btn-danger w-100">
                                Wyłącz
                            </button>
                        <?php else: ?>
                            <button name="action" value="start" class="btn btn-success w-100">
                                Włącz
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <button name="action" value="reinstall" class="btn btn-secondary w-100">
                            Reinstall systemu
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
