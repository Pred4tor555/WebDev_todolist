<?php
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
