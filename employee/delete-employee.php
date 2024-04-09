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

// Проверяем, был ли передан идентификатор сотрудника для удаления
if(isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Запрос на удаление сотрудника
    $sql = "DELETE FROM Employees WHERE id=$employeeId";

    if ($conn->query($sql) === TRUE) {
        // После успешного удаления перенаправляем на страницу employees.php
        header("Location: employees.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
