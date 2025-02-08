<?php
global $conn;

if (!isset($_SESSION['username'])) {
    echo "<p>Вы не авторизованы!</p>";
    exit();
}

// Получаем user_id из БД по логину
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p>Ошибка: пользователь не найден!</p>";
    exit();
}

$user_id = $user['id'];  // ID авторизованного пользователя

// Запрос на выборку задач только для текущего пользователя
$stmt = $conn->prepare("SELECT tasks.id, tasks.title, categories.name AS category 
                        FROM tasks 
                        JOIN categories ON tasks.category_id = categories.id 
                        WHERE tasks.user_id = ?");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($tasks)) {
    echo "<p>У вас пока нет задач.</p>";
} else {
    echo "<h2>Ваши задачи</h2>";
    echo "<table border='1'>
            <tr>
                <th>Задача</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>";

    foreach ($tasks as $task) {
        echo "<tr>
                <td>" . htmlspecialchars($task['title']) . "</td>
                <td>" . htmlspecialchars($task['category']) . "</td>
                <td>
                    <form action='delete_task.php' method='post' style='display:inline;'>
                        <input type='hidden' name='task_id' value='" . $task['id'] . "'>
                        <button type='submit' class='delete-btn'>Удалить</button>
                    </form>
                </td>
              </tr>";
    }

    echo "</table>";
}

