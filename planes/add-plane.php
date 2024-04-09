<?php
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

// Получение данных из формы
$model_name = $_POST['modelName'];
$seat_capacity = $_POST['seatCapacity'];

// Вставка нового самолета в таблицу "Planes"
$sql = "INSERT INTO planes (model_name, seat_capacity) VALUES ('$model_name', '$seat_capacity')";

if ($conn->query($sql) === TRUE) {
    // Если вставка прошла успешно, перенаправляем пользователя на страницу с самолетами
    header("Location: planes.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
