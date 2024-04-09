<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Employees</h2>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEmployeeModal">Add Employee</button>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Action</th>
        </tr>
        </thead>
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

        // Чтение записей из таблицы "Employees" (Read)
        $sql = "SELECT * FROM Employees";
        $result = $conn->query($sql);

        echo "<tbody id='employeeTable'>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["position"] . "</td>
                        <td>
                            <a href='edit-employee.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>
                            <a href='delete-employee.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No employees found</td></tr>";
        }
        echo "</tbody>";

        $conn->close();
        ?>
    </table>
</div>

<!-- Модальное окно для добавления сотрудника -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" action="add-employee.php" method="post">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Обработчик отправки формы добавления сотрудника через AJAX
        $('#addEmployeeForm').submit(function(event) {
            event.preventDefault(); // Отмена стандартной отправки формы

            // Отправка данных формы через AJAX
            $.ajax({
                type: 'POST',
                url: 'add-employee.php', // URL для обработки запроса
                data: $(this).serialize(), // Сериализация данных формы
                success: function(response) {
                    // Обновление таблицы сотрудников после успешного добавления
                    $('#employeeTable').html(response);
                    $('#addEmployeeModal').modal('hide'); // Закрытие модального окна
                }
            });
        });
    });


</script>
</body>
</html>
