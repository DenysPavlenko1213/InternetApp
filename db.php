<?php
$host = "localhost";
$user = "wrx98096";
$pass = "aqjaoo2WLMV6sfvbyQXKxuDLL";
$db = "wrx98096";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo 'Błąd połączenia z bazą danych';
}
?>
