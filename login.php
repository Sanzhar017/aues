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

// Обработка запроса на вход
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Поиск пользователя в базе данных
    $check_query = "SELECT * FROM authorization WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Вы успешно вошли в систему.";
            // Перенаправление на страницу с управлением
            header("Location: login.php");
            exit();
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    } else {
        echo "Неверное имя пользователя или пароль.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
<h2>Вход</h2>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit" name="login">Войти</button>
</form>
<p>Еще не зарегистрированы? <a href="register.php">Зарегистрироваться</a></p>
</body>
</html>
