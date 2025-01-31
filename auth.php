<?php
session_start(["use_strict_mode" => true]);
unset($_SESSION['message']);

$valid_user = 'artem';
$valid_pass = '123456';

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    if ($_POST['login'] === $valid_user) {
        if ($_POST['password'] === $valid_pass) {
            $_SESSION['username'] = $_POST['login'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = 'Вы ввели неправильный пароль!';
        }
    } else {
        $_SESSION['message'] = 'Вы ввели неправильный логин!';
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_unset();
    $_SESSION['message'] = 'Вы успешно вышли из системы';
    header("Location: index.php");
    exit();
}
?>
