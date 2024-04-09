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

// Получение информации о самолете по его ID
$sql = "SELECT * FROM planes WHERE id = $plane_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $model_name = $row['model_name'];
    $seat_capacity = $row['seat_capacity'];
} else {
    echo "Plane not found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plane</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Plane</h2>
    <form action="update-plane.php" method="post">
        <input type="hidden" name="plane_id" value="<?php echo $plane_id; ?>">
        <div class="form-group">
            <label for="modelName">Model Name:</label>
            <input type="text" class="form-control" id="modelName" name="modelName" value="<?php echo $model_name; ?>" required>
        </div>
        <div class="form-group">
            <label for="seatCapacity">Seat Capacity:</label>
            <input type="number" class="form-control" id="seatCapacity" name="seatCapacity" value="<?php echo $seat_capacity; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</body>
</html>
