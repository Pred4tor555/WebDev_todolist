<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Директория для загрузки файлов
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Обработка загруженных файлов
    $uploadedFiles = [];
    if (!empty($_FILES['attachments']['name'][0])) {
        foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['attachments']['name'][$key]);
            $targetPath = $uploadDir . time() . '_' . $fileName;
            if (move_uploaded_file($tmpName, $targetPath)) {
                $uploadedFiles[] = $targetPath;
            }
        }
    }

    // Сохранение данных в cookie
    setcookie('task_name', $_POST['task_name'], time() + 3600);
    setcookie('task_description', $_POST['task_description'], time() + 3600);
    setcookie('priority', $_POST['priority'], time() + 3600);
    setcookie('category', $_POST['category'], time() + 3600);
    setcookie('due_date', $_POST['due_date'], time() + 3600);
    setcookie('options', json_encode($_POST['options'] ?? []), time() + 3600);

    // Сохранение имен загруженных файлов в cookie
    if (!empty($uploadedFiles)) {
        setcookie('attachments', json_encode($uploadedFiles), time() + 3600);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат добавления задачи</title>
</head>
<body>
<h2>Задача добавлена</h2>
<p><strong>Название задачи:</strong> <?= htmlspecialchars($_POST['task_name'] ?? '') ?></p>
<p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($_POST['task_description'] ?? '')) ?></p>
<p><strong>Приоритет:</strong> <?= htmlspecialchars($_POST['priority'] ?? '') ?></p>
<p><strong>Категория:</strong> <?= htmlspecialchars($_POST['category'] ?? '') ?></p>
<p><strong>Дата выполнения:</strong> <?= htmlspecialchars($_POST['due_date'] ?? '') ?></p>
<p><strong>Дополнительные параметры:</strong> <?= isset($_POST['options']) ? implode(', ', $_POST['options']) : 'Нет' ?></p>

<h3>Загруженные файлы:</h3>
<?php if (!empty($uploadedFiles)): ?>
    <ul>
        <?php foreach ($uploadedFiles as $file): ?>
            <li>
                <a href="<?= $file ?>" target="_blank">
                    <img src="<?= $file ?>" alt="Загруженный файл" style="max-width: 200px;">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Файлы не загружены.</p>
<?php endif; ?>
</body>
</html>