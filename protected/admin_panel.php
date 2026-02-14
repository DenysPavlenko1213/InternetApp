<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(404);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Panel administratora</h1>
    <p>Witaj, adminie! Tutaj możesz zarządzać planami VPS.</p>

    <form action="add_plan.php" method="post">
        <h2>Dodaj nowy plan VPS</h2>

        <label for="name">Nazwa:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="cpu">CPU (liczba rdzeni):</label><br>
        <input type="text" id="cpu" name="cpu" required><br><br>

        <label for="ram">RAM (GB):</label><br>
        <input type="text" id="ram" name="ram" required><br><br>

        <label for="storage">Dysk (GB):</label><br>
        <input type="text" id="storage" name="storage" required><br><br>

        <label for="bandwidth">Przepustowość (Mbps):</label><br>
        <input type="text" id="bandwidth" name="bandwidth" required><br><br>

        <label for="description">Opis:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Cena (PLN) za miesiąc:</label><br>
        <input type="text" id="price" name="price" step="0.01" required><br><br>

        <button type="submit">Dodaj plan</button>
    </form>
    <a href="../index.php">Powrót do strony głównej</a><br><br>
    <a href="../logout.php">Wyloguj się</a>
</body>
</html>
