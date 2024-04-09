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

// Получение информации о полете по его ID
$sql = "SELECT * FROM flights WHERE id = $flight_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $flight_number = $row['flight_number'];
    $departure_location = $row['departure_location'];
    $destination_location = $row['destination_location'];
    $departure_date = $row['departure_date'];
    $departure_time = $row['departure_time'];
} else {
    echo "Flight not found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Flight</h2>
    <form action="update-flight.php" method="post">
        <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
        <div class="form-group">
            <label for="flightNumber">Flight Number:</label>
            <input type="text" class="form-control" id="flightNumber" name="flightNumber" value="<?php echo $flight_number; ?>" required>
        </div>
        <div class="form-group">
            <label for="departureLocation">Departure Location:</label>
            <input type="text" class="form-control" id="departureLocation" name="departureLocation" value="<?php echo $departure_location; ?>" required>
        </div>
        <div class="form-group">
            <label for="destinationLocation">Destination Location:</label>
            <input type="text" class="form-control" id="destinationLocation" name="destinationLocation" value="<?php echo $destination_location; ?>" required>
        </div>
        <div class="form-group">
            <label for="departureDate">Departure Date:</label>
            <input type="date" class="form-control" id="departureDate" name="departureDate" value="<?php echo $departure_date; ?>" required>
        </div>
        <div class="form-group">
            <label for="departureTime">Departure Time:</label>
            <input type="time" class="form-control" id="departureTime" name="departureTime" value="<?php echo $departure_time; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</body>
</html>
