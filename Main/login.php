<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = ""; // Если у тебя есть пароль для MySQL, укажи его здесь
$dbname = "social_network";

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные из формы
$login = $_POST['login'] ?? '';
$pass = $_POST['password'] ?? '';

// Проверяем, заполнены ли поля
if (empty($login) || empty($pass)) {
    echo "Заполните все поля!";
    exit();
}

// Ищем пользователя в базе
$sql = "SELECT password_hash FROM users WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();

// Если пользователь найден
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Проверяем пароль
    if (password_verify($pass, $hashed_password)) {
        echo "success"; // Если пароль верный → успех
    } else {
        echo "Неверный логин или пароль!";
    }
} else {
    echo "Неверный логин или пароль!";
}

// Закрываем соединение
$stmt->close();
$conn->close();
?>
