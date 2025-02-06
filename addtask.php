<?php
global $conn;
session_start(["use_strict_mode" => true]);
require('dbconnect.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Получаем user_id из БД по логину
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['message'] = "Ошибка: пользователь не найден!";
    header("Location: index.php");
    exit();
}

$user_id = $user['id'];  // ID авторизованного пользователя
$category_id = $_POST['category_id'] ?? null;
$title = trim($_POST['title']);

if ($category_id && $title) {
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, category_id, title) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $category_id, $title]);

    header("Location: index.php?page=tasks");
    exit();
} else {
    $_SESSION['message'] = "Ошибка: заполните все поля!";
    header("Location: index.php");
    exit();
}
