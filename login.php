<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <!-- Подключение стилей Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Дополнительные стили для формы */
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        h2 {
            margin-bottom: 20px;
        }
        button[type="submit"] {
            width: 100%;
        }
        p {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Вход</h2>
    <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Имя пользователя" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Войти</button>
    </form>
    <p>Еще не зарегистрированы? <a href="register.php">Зарегистрироваться</a></p>
</div>
</body>
</html>