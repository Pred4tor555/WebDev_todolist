<?php
global $conn;
session_start();
include("dbconnect.php");

if (!isset($_SESSION['username'])) {
    die("Ошибка: Вы не авторизованы.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Получаем user_id из БД по логину
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p>Ошибка: пользователь не найден!</p>";
        exit();
    }

    $user_id = $user['id'];

    // Удаляем задачу, принадлежащую пользователю
    $query = "DELETE FROM tasks WHERE id = :task_id AND user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: index.php?page=tasks");
        exit();
    } else {
        echo "Ошибка удаления задачи.";
    }
} else {
    echo "Некорректный запрос.";
}
