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
$flight_number = $_POST['flightNumber'];
$departure_location = $_POST['departureLocation'];
$destination_location = $_POST['destinationLocation'];
$departure_date = $_POST['departureDate'];
$departure_time = $_POST['departureTime'];

// Вставка нового полета в таблицу "Flights"
$sql = "INSERT INTO Flights (flight_number, departure_location, destination_location, departure_date, departure_time) VALUES ('$flight_number', '$departure_location', '$destination_location', '$departure_date', '$departure_time')";

if ($conn->query($sql) === TRUE) {
    // Если вставка прошла успешно, обновляем таблицу полетов и отправляем ее обратно в формате HTML
    $result = $conn->query("SELECT * FROM Flights");
    echo "<tr>
            <td>$conn->insert_id</td>
            <td>$flight_number</td>
            <td>$departure_location</td>
            <td>$destination_location</td>
            <td>$departure_date</td>
            <td>$departure_time</td>
            <td>
                <a href='edit-flight.php?id=$conn->insert_id' class='btn btn-primary btn-sm mr-2'>Edit</a>
                <a href='delete-flight.php?id=$conn->insert_id' class='btn btn-danger btn-sm'>Delete</a>
            </td>
        </tr>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
