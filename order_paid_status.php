<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location:auth/login.php");
    exit;
}

if (!isset($_GET["plan_id"])) {
    die("Brak planu.");
}
if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['success_token']) { 
    header("Location: index.php");
    exit(); 
} 
unset($_SESSION['success_token']);

$plan_id = intval($_GET["plan_id"]);

$stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
$stmt->execute([$plan_id]);
$plan = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zakup udany!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0d1117;
            color: #e6edf3;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-card {
            width: 100%;
            max-width: 500px;
            background: #161b22;
            border-radius: 15px;
            padding: 35px 25px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
        }

        .success-icon {
            font-size: 60px;
            color: #2ecc71;
        }

        @media (max-width: 576px) {
            .success-card {
                padding: 25px 18px;
            }

            .success-icon {
                font-size: 50px;
            }

            h1 {
                font-size: 1.7rem;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="success-card text-center">
        <h1 class="fw-bold">Dziękujemy za zakup!</h1>
        <p class="mt-3 fs-5">
            Twój serwer <strong><?= htmlspecialchars($plan["name"]) ?></strong> został pomyślnie aktywowany.
        </p>

        <a href="profile.php" class="btn btn-primary btn-lg mt-4 w-100">
            Przejdź do profilu
        </a>
    </div>

</body>

</html>
