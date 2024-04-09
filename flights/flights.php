<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Flights</h2>
    <div class="form-group">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by Flight Number">
    </div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addFlightModal">Add Flight</button>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Flight Number</th>
            <th>Departure Location</th>
            <th>Destination Location</th>
            <th>Departure Date</th>
            <th>Departure Time</th>
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

        // Чтение записей из таблицы "Flights" (Read)
        $sql = "SELECT * FROM flights";
        $result = $conn->query($sql);

        echo "<tbody id='flightTable'>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["flight_number"] . "</td>
                        <td>" . $row["departure_location"] . "</td>
                        <td>" . $row["destination_location"] . "</td>
                        <td>" . $row["departure_date"] . "</td>
                        <td>" . $row["departure_time"] . "</td>
                        <td>
                            <a href='edit-flight.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>
                            <a href='delete-flight.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No flights found</td></tr>";
        }
        echo "</tbody>";

        $conn->close();
        ?>
    </table>
</div>

<!-- Модальное окно для добавления полета -->
<!-- Модальное окно для добавления полета -->
<div class="modal fade" id="addFlightModal" tabindex="-1" role="dialog" aria-labelledby="addFlightModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFlightModalLabel">Add Flight</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addFlightForm" action="add-flight.php" method="post">
                    <div class="form-group">
                        <label for="flightNumber">Flight Number:</label>
                        <input type="text" class="form-control" id="flightNumber" name="flightNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="departureLocation">Departure Location:</label>
                        <input type="text" class="form-control" id="departureLocation" name="departureLocation" required>
                    </div>
                    <div class="form-group">
                        <label for="destinationLocation">Destination Location:</label>
                        <input type="text" class="form-control" id="destinationLocation" name="destinationLocation" required>
                    </div>
                    <div class="form-group">
                        <label for="departureDate">Departure Date:</label>
                        <input type="date" class="form-control" id="departureDate" name="departureDate" required>
                    </div>
                    <div class="form-group">
                        <label for="departureTime">Departure Time:</label>
                        <input type="time" class="form-control" id="departureTime" name="departureTime" required>
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
        // Обработчик отправки формы добавления полета через AJAX
        $('#addFlightForm').submit(function(event) {
            event.preventDefault(); // Отмена стандартной отправки формы

            // Отправка данных формы через AJAX
            $.ajax({
                type: 'POST',
                url: 'add-flight.php', // URL для обработки запроса
                data: $(this).serialize(), // Сериализация данных формы
                success: function(response) {
                    // Добавление новой строки к таблице полетов после успешного добавления
                    $('#flightTable').append(response);
                    $('#addFlightModal').modal('hide'); // Закрытие модального окна
                }

            });
        });
    });
</script>
</body>
</html>
