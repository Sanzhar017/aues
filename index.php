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

    // Проверка, существует ли пользователь с таким же именем
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Пользователь с таким именем уже существует.";
    } else {
        // Хэширование пароля перед сохранением в базу данных
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Вставка данных нового пользователя в базу данных
        $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Вы успешно зарегистрированы.";
        } else {
            echo "Ошибка при регистрации: " . $conn->error;
        }
    }
}

// Обработка запроса на вход
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Поиск пользователя в базе данных
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Вы успешно вошли в систему.";
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    } else {
        echo "Неверное имя пользователя или пароль.";
    }
}

// Выход из системы
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пример регистрации и входа на PHP</title>
</head>
<body>
<h2>Регистрация</h2>
<form action="index.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit" name="register">Зарегистрироваться</button>
</form>

<h2>Вход</h2>
<form action="index.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit" name="login">Войти</button>
</form>

<?php if(isset($_SESSION['username'])): ?>
    <h2>Добро пожаловать, <?php echo $_SESSION['username']; ?></h2>
    <a href="index.php?logout=true">Выйти</a>
<?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
