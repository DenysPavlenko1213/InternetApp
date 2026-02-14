<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $email;
            if($user["role"] === "admin") {
                $_SESSION["role"] = "admin";
                header("Location: protected/admin_panel.php");
                exit;
            }
            header("Location: index.php");
            exit;

        } else {
            $error = "Nieprawidłowe hasło";
        }

    } else {
        $error = "Użytkownik z takim email nie istnieje";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="authentication.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="login-card">

            <h2 class="text-center">Login</h2>

            <?php if (!empty($error)): ?>
                <div class="error-box"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hasło</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Zaloguj się</button>
            </form>

            <p class="mt-3 text-center">
                Nie masz konta? <a href="register.php">Zarejestruj się</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
