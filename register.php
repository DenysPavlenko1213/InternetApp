<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $password2 = trim($_POST["password2"]);

    if ($password !== $password2) {
        $error = "Hasła nie są takie same";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $error = "Użytkownik z takim email już istnieje";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $result = $stmt->execute([$username, $email, $hashed]);

            if ($result) {
                 $_SESSION["user_id"] = $pdo->lastInsertId();
                 $_SESSION["email"] = $email;
                 header("Location: index.php");
                 exit;
            } else {
                $error = "Błąd przy rejestracji";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="authentication.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-card">

        <h2 class="text-center">Rejestracja</h2>

        <?php if (!empty($error)): ?>
            <div class="error-box"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Imię</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hasło</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Potwierdź hasło</label>
                <input type="password" name="password2" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Zarejestruj się</button>
        </form>

        <p class="mt-3 text-center">
            Juz masz konto? <a href="login.php">Zaloguj się</a>
        </p>

    </div>
    </div>

</body>

</html>
