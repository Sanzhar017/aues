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
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$position = $_POST['position'];

// Вставка нового сотрудника в таблицу "Employees"
$sql = "INSERT INTO Employees (first_name, last_name, position) VALUES ('$first_name', '$last_name', '$position')";

if ($conn->query($sql) === TRUE) {
    // Если вставка прошла успешно, обновляем таблицу сотрудников и отправляем ее обратно в формате HTML
    $result = $conn->query("SELECT * FROM employees");
    echo "<tr>
            <td>$conn->insert_id</td>
            <td>$first_name</td>
            <td>$last_name</td>
            <td>$position</td>
            <td>
                <a href='edit-employee.php?id=$conn->insert_id' class='btn btn-primary btn-sm mr-2'>Edit</a>
                <a href='delete-employee.php?id=$conn->insert_id' class='btn btn-danger btn-sm'>Delete</a>
            </td>
        </tr>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
