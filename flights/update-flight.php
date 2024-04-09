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
$flight_id = $_POST['flight_id'];
$flight_number = $_POST['flightNumber'];
$departure_location = $_POST['departureLocation'];
$destination_location = $_POST['destinationLocation'];
$departure_date = $_POST['departureDate'];
$departure_time = $_POST['departureTime'];

// Обновление информации о полете в таблице "Flights"
$sql = "UPDATE flights SET flight_number='$flight_number', departure_location='$departure_location', destination_location='$destination_location', departure_date='$departure_date', departure_time='$departure_time' WHERE id=$flight_id";

if ($conn->query($sql) === TRUE) {
    // После успешного обновления перенаправляем пользователя на страницу с информацией о полетах
    header("Location: flights.php");
    exit();
} else {
    echo "Error updating flight: " . $conn->error;
}

$conn->close();
?>
