<?php
global $conn;
session_start(["use_strict_mode" => true]);
include("dbconnect.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<?php include("authform.php"); ?>

<?php if (isset($_SESSION['username'])): ?>
    <header class="header">
        <nav>
            <ul class="nav-menu">
                <li><a href="index.php?page=tasks">Задачи</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Получение списка категорий из БД -->
        <?php
        $categories = $conn->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Форма добавления задачи -->
        <h2>Добавить задачу</h2>
        <form class="task_form" action="addtask.php" method="post">
            <label for="task">Название задачи:</label>
            <input type="text" id="task" name="title" required>

            <!-- Выпадающий список категорий -->
            <label for="category">Категория:</label>
            <select id="category" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Добавить</button>
        </form>

        <?php
        $page = $_GET['page'] ?? 'tasks';

        switch ($page) {
            case 'tasks':
                include "tasks.php";
                break;
            default:
                echo "<p>Выберите раздел</p>";
        }
        ?>
    </div>
<?php endif; ?>

</body>
</html>
