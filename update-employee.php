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
$employee_id = $_POST['employee_id'];
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$position = $_POST['position'];

// Обновление информации о сотруднике в таблице "Employees"
$sql = "UPDATE Employees SET first_name='$first_name', last_name='$last_name', position='$position' WHERE id=$employee_id";

if ($conn->query($sql) === TRUE) {
    // После успешного обновления перенаправляем пользователя на страницу с информацией о сотруднике
    header("Location: employees.php");
    exit();
} else {
    echo "Error updating employee: " . $conn->error;
}

$conn->close();
?>
