<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Planes</h2>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPlaneModal">Add Plane</button>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Model Name</th>
            <th>Seat Capacity</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="planeTable">
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

        // Чтение записей из таблицы "Planes" (Read)
        $sql = "SELECT * FROM planes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["model_name"] . "</td>
                        <td>" . $row["seat_capacity"] . "</td>
                        <td>
                            <a href='edit-plane.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>
                            <a href='delete-plane.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No planes found</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<!-- Модальное окно для добавления самолета -->
<div class="modal fade" id="addPlaneModal" tabindex="-1" role="dialog" aria-labelledby="addPlaneModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlaneModalLabel">Add Plane</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPlaneForm" action="add-plane.php" method="post">
                    <div class="form-group">
                        <label for="modelName">Model Name:</label>
                        <input type="text" class="form-control" id="modelName" name="modelName" required>
                    </div>
                    <div class="form-group">
                        <label for="seatCapacity">Seat Capacity:</label>
                        <input type="number" class="form-control" id="seatCapacity" name="seatCapacity" required>
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
        // Обработчик отправки формы добавления самолета через AJAX
        $('#addPlaneForm').submit(function(event) {
            event.preventDefault(); // Отмена стандартной отправки формы

            // Отправка данных формы через AJAX
            $.ajax({
                type: 'POST',
                url: 'add-plane.php', // URL для обработки запроса
                data: $(this).serialize(), // Сериализация данных формы
                success: function(response) {
                    // Очищаем таблицу перед добавлением новой строки
                    $('#planeTable').empty();
                    // Добавление новой строки к таблице самолетов после успешного добавления
                    $('#planeTable').append(response);
                    $('#addPlaneModal').modal('hide'); // Закрытие модального окна
                }
            });
        });
    });
</script>
</body>
</html>
