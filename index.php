<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">О проекте</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="login-form">
        <h2>Вход в систему</h2>
        <form action="login.php" method="POST">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Войти</button>
        </form>
    </section>
</main>
</body>
</html>