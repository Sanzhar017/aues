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
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Дополнительные стили для формы */
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        h2 {
            margin-bottom: 20px;
        }
        button[type="submit"] {
            width: 100%;
        }
        p {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Регистрация</h2>
    <form action="register.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Имя пользователя" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Зарегистрироваться</button>
    </form>
    <p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
</div>
</body>
</html>
