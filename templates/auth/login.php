<?php
$redirect = urlencode($_GET['redirect'] ?? '');
?>
<h2>Login</h2>
<?php if (!empty($error)): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="?controller=auth&action=login<?= $redirect ? '&redirect=' . $redirect : '' ?>">
    <label>Username<br><input name="username" required></label><br>
    <label>Password<br><input type="password" name="password" required></label><br><br>
    <button type="submit">Login</button>
</form>