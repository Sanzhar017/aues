<?php
session_start();

// Подключение к базе данных
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "aues";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка запроса на регистрацию
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Хэширование пароля перед сохранением в базу данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка данных нового пользователя в базу данных
    $insert_query = "INSERT INTO authorization (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($insert_query) === TRUE) {
        echo "Вы успешно зарегистрированы.";
    } else {
        echo "Ошибка при регистрации: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<h2>Регистрация</h2>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit" name="register">Зарегистрироваться</button>
</form>
<p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
</body>
</html>
