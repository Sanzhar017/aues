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

// Получение ID полета из параметров запроса
$flight_id = $_GET['id'];

// Удаление полета из таблицы "Flights"
$sql = "DELETE FROM flights WHERE id = $flight_id";

if ($conn->query($sql) === TRUE) {
    // После успешного удаления перенаправляем пользователя на страницу с информацией о полетах
    header("Location: flights.php");
    exit();
} else {
    echo "Error deleting flight: " . $conn->error;
}

$conn->close();
?>
