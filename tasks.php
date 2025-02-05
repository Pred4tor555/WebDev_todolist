<?php
global $conn;
$result = $conn->query("SELECT id, user_id, category_id, title FROM tasks");

echo "<div class='table-container'>";
echo "<table>
<tr><th>ID</th><th>ID пользователя</th><th>ID категории</th><th>Задача</th></tr>";

while ($row = $result->fetch()) {
    echo "<tr><td>".$row['id']."</td><td>".$row['user_id']."</td><td>".$row['category_id']."</td><td>".$row['title']."</td></tr>";
}

echo "</table>";
echo "</div>";

