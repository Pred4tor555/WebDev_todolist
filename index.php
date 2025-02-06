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

<?php
if (isset($_SESSION['username'])) {
    include("header.php");
    echo "<div class='container'>";

    // Получение списка категорий из БД
    $categories = $conn->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);

    // Форма добавления задачи
    echo "<h2>Добавить задачу</h2>";
    echo "<form action='addtask.php' method='post'>";
    echo "    <label for='task'>Название задачи:</label>";
    echo "    <input type='text' id='task' name='title' required>";

    // Выпадающий список категорий
    echo "    <label for='category'>Категория:</label>";
    echo "    <select id='category' name='category_id' required>";
    foreach ($categories as $category) {
        echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['name']) . "</option>";
    }
    echo "    </select>";

    echo "    <button type='submit'>Добавить</button>";
    echo "</form>";

    $page = $_GET['page'] ?? '';

    switch ($page) {
        case 'tasks':
            include "tasks.php";
            break;
        default:
            echo "<p>Выберите раздел</p>";
    }

    echo "</div>";
}
?>

</body>
</html>
