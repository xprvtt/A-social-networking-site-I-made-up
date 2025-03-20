<?php
header("Content-Type: text/plain");

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "social_network";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Проверяем, существует ли логин
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $checkStmt->bind_param("s", $login);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Ошибка: логин уже используется!";
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    // Хешируем пароль
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (login, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $login, $passwordHash);

    if ($stmt->execute()) {
        echo "Успешная регистрация!";
    } else {
        echo "Ошибка при регистрации: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
