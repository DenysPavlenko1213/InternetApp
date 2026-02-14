<?php
session_start();
require "db.php";

if (!isset($_GET["id"])) {
    die("Brak ID planu.");
}

$id = intval($_GET["id"]);

$stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
$stmt->execute([$id]);
$plan = $stmt->fetch();

if (!$plan) {
    die("Plan nie istnieje.");
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($plan["name"]) ?> – VPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vps_details.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <!-- HEADER -->
    <div class="vps-header">
        <h1><?= htmlspecialchars($plan["name"]) ?></h1>
        <p>Profesjonalny serwer VPS dla wymagających</p>
    </div>

    <!-- CONTENT -->
    <div class="container">
        <div class="vps-box">

            <div class="row">
                <div class="col-md-6">
                    <h2>Specyfikacja</h2>
                    <ul class="vps-features">
                        <li><strong>CPU:</strong> <?= htmlspecialchars($plan["cpu"]) ?></li>
                        <li><strong>RAM:</strong> <?= htmlspecialchars($plan["ram"]) ?></li>
                        <li><strong>Dysk:</strong> <?= htmlspecialchars($plan["storage"]) ?></li>
                        <li><strong>Transfer:</strong> <?= htmlspecialchars($plan["bandwidth"]) ?></li>
                    </ul>
                </div>

                <div class="col-md-6 text-center">
                    <h3 class="mt-3">Cena: <span id="price"><?= $plan["price"] ?></span> zł</h3>
                    <p><?= nl2br(htmlspecialchars($plan["description"])) ?></p>

                    <form action="create-order.php" method="post">

                        <input type="hidden" name="id" value="<?= $plan["id"] ?>">
                        <input type="hidden" id="final_price" name="final_price" value="<?= $plan["price"] ?>">
                        <h4 class="mt-4">Wybierz okres</h4>
                        <select onchange="redrawPrice(<?= $plan["price"] ?>, this.value)" name="period" id="period" class="form-select mb-3">
                            <option value="1">1 miesiąc</option>
                            <option value="3">3 miesiące</option>
                            <option value="6">6 miesięcy</option>
                            <option value="12">12 miesięcy</option>
                        </select>

                        <h4>Wybierz system operacyjny</h4>
                        <select name="os" class="form-select mb-3">
                            <option value="Ubuntu 22.04">Ubuntu 22.04</option>
                            <option value="Ubuntu 24.04">Ubuntu 24.04</option>
                            <option value="Debian 12">Debian 12</option>
                            <option value="Debian 11">Debian 11</option>
                            <option value="CentOS 9 Stream">CentOS 9 Stream</option>
                            <option value="AlmaLinux 9">AlmaLinux 9</option>
                        </select>

                        <button type="submit" class="btn btn-buy w-100 mt-3">
                            Kup teraz
                        </button>
                    </form>



                </div>
            </div>

        </div>
    </div>
    <script src="utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>