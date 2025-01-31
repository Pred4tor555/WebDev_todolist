<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
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
    <section class="task-form">
        <h2>Добавление задачи</h2>
        <form action="addtask.php" method="POST" enctype="multipart/form-data">
            <label for="task_name">Название задачи:</label>
            <input type="text" id="task_name" name="task_name" value="<?= htmlspecialchars($_COOKIE['task_name'] ?? $_POST['task_name'] ?? '') ?>" required>
            <br>

            <label for="task_description">Описание задачи:</label><br>
            <textarea id="task_description" name="task_description" rows="4" cols="30"><?= htmlspecialchars($_COOKIE['task_description'] ?? $_POST['task_description'] ?? '') ?></textarea>
            <br>

            <label>Приоритет:</label>
            <?php $priority = $_COOKIE['priority'] ?? $_POST['priority'] ?? 'medium'; ?>
            <input type="radio" id="high" name="priority" value="high" <?= $priority == 'high' ? 'checked' : '' ?>>
            <label for="high">Высокий</label>
            <input type="radio" id="medium" name="priority" value="medium" <?= $priority == 'medium' ? 'checked' : '' ?>>
            <label for="medium">Средний</label>
            <input type="radio" id="low" name="priority" value="low" <?= $priority == 'low' ? 'checked' : '' ?>>
            <label for="low">Низкий</label>
            <br>

            <label for="category">Категория:</label>
            <?php $category = $_COOKIE['category'] ?? $_POST['category'] ?? ''; ?>
            <select id="category" name="category">
                <option value="work" <?= $category == 'work' ? 'selected' : '' ?>>Работа</option>
                <option value="personal" <?= $category == 'personal' ? 'selected' : '' ?>>Личное</option>
                <option value="hobby" <?= $category == 'hobby' ? 'selected' : '' ?>>Хобби</option>
            </select>
            <br>

            <label>Дополнительные параметры:</label>
            <?php $options = json_decode($_COOKIE['options'] ?? '[]', true) ?? ($_POST['options'] ?? []); ?>
            <input type="checkbox" id="urgent" name="options[]" value="urgent" <?= in_array('urgent', $options) ? 'checked' : '' ?>>
            <label for="urgent">Срочно</label>
            <input type="checkbox" id="reminder" name="options[]" value="reminder" <?= in_array('reminder', $options) ? 'checked' : '' ?>>
            <label for="reminder">Напоминание</label>
            <br>

            <label for="due_date">Дата выполнения:</label>
            <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($_COOKIE['due_date'] ?? $_POST['due_date'] ?? '') ?>">
            <br>

            <label for="attachments">Вложения:</label>
            <input type="file" id="attachments" name="attachments[]" multiple><br>

            <?php if (!empty($_COOKIE['attachments'])): ?>
                <h3>Ранее загруженные файлы:</h3>
                <?php foreach (json_decode($_COOKIE['attachments'], true) as $file): ?>
                    <div>
                        <a href="<?= htmlspecialchars($file) ?>" target="_blank">
                            <img src="<?= htmlspecialchars($file) ?>" alt="Загруженное изображение" style="max-width: 100px; max-height: 100px;">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <br>

            <button type="submit">Добавить задачу</button>
        </form>
    </section>
</main>
</body>
</html>
