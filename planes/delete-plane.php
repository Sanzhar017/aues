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

// Получение ID самолета из параметров запроса
$plane_id = $_GET['id'];

// Удаление самолета из таблицы "Planes"
$sql = "DELETE FROM planes WHERE id=$plane_id";

if ($conn->query($sql) === TRUE) {
    // После успешного удаления перенаправляем пользователя на страницу со списком самолетов
    header("Location: planes.php");
    exit();
} else {
    echo "Error deleting plane: " . $conn->error;
}

$conn->close();
?>
