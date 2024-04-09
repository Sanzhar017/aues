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
$plane_id = $_POST['plane_id'];
$model_name = $_POST['modelName'];
$seat_capacity = $_POST['seatCapacity'];

// Обновление информации о самолете в таблице "Planes"
$sql = "UPDATE planes SET model_name='$model_name', seat_capacity='$seat_capacity' WHERE id=$plane_id";

if ($conn->query($sql) === TRUE) {
    // После успешного обновления перенаправляем пользователя на страницу со списком самолетов
    header("Location: planes.php");
    exit();
} else {
    echo "Error updating plane: " . $conn->error;
}

$conn->close();
?>
