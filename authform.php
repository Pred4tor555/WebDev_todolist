<?php
session_start(["use_strict_mode" => true]);
?>
<div class="container">
    <?php if (isset($_SESSION['username'])): ?>
        <div class="auth-block">
            <p>Вы вошли под именем <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
            <p><a href="auth.php?logout=1">Выйти</a></p>
        </div>
    <?php else: ?>
        <form method="post" action="auth.php">
            <h2>Вход</h2>
            <label for="id1">Логин:</label><br>
            <input name="login" id="id1" type="text" size="20" maxlength="40"><br>
            <label for="id2">Пароль:</label><br>
            <input name="password" id="id2" type="password" size="20" maxlength="40"><br>
            <input type="submit" value="Войти">
        </form>
    <?php endif; ?>

    <?php if (!empty($_SESSION['message'])): ?>
        <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</div>
