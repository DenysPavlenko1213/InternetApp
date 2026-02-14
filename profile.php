<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

if (!$user) {
    echo "Błąd: użytkownik nie istnieje.";
    exit;
}
$stmt = $pdo->prepare("
    SELECT orders.*, plans.name, plans.cpu, plans.ram, plans.storage 
    FROM orders 
    JOIN plans ON orders.plan_id = plans.id
    WHERE orders.user_id = ?
");
$stmt->execute([$_SESSION["user_id"]]);
$vps_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="profile.css" rel="stylesheet">

</head>

<body class="bg-dark text-light">
    <?php include "navbar.php"; ?>
    <div class="card-body text-center">
        <h2 class="mb-4">Twój profil</h2>
        <p><strong>Imie:</strong> <?= htmlspecialchars($user["username"]) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
        <a href="logout.php" class="btn btn-danger w-20">Wyloguj</a>
    </div>
    <h3 class="mt-5">Twoje VPS</h3>
    <div class="row  align-items-center g-3 mt-3">
            <?php foreach ($vps_list as $vps): ?>
                <div class="col-md-6">
                        <div class="vps-card">

                            <h5><?= htmlspecialchars($vps["name"]) ?></h5>

                            <div class="vps-info mt-3">
                                <p>
                                    <strong>Status:</strong> <?= $vps["status"] ?>
                                </p>

                                <p>
                                    <strong>IP:</strong> <?= $vps["ip"] ?>
                                </p>

                                <p>
                                    <strong>CPU:</strong> <?= $vps["cpu"] ?>
                                </p>

                                <p>
                                    <strong>RAM:</strong> <?= $vps["ram"] ?>
                                </p>

                                <p>
                                    <strong>Dysk:</strong> <?= $vps["storage"] ?>
                                </p>

                                <?php
                                    $start = new DateTime($vps["created_at"]); 
                                    $start->modify('+' . $vps["period"] . ' months'); 
                                    $expires = $start->format('d-m-Y');
                                ?>
                                <p><strong>Dziala do:</strong> <?= $expires ?></p>
                                <p>
                                    <strong>System:</strong> <?= $vps["os"] ?>
                                </p>
                            </div>
                            <br>
                            <a href="vps_manage.php?id=<?= $vps["id"] ?>" class="btn-manage w-100 mt-3">
                                Zarządzaj
                            </a>

                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>