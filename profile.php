<?php
session_start();
session_start();
ini_set('display_errors', 1);

// Если пользователь не залогинен — отправляем на login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

// Загружаем данные пользователя из базы
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

if (!$user) {
    echo "Błąd: użytkownik nie istnieje.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Profil użytkownika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card bg-secondary text-light">
                    <div class="card-body text-center">

                        <h2 class="mb-4">Twój profil</h2>

                        <p><strong>Login:</strong> <?= htmlspecialchars($user["username"]) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
                        <a href="logout.php" class="btn btn-danger w-100">Wyloguj</a>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>