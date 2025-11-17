<?php
use Service\Auth;
?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Disciplinary System</title>
    <style>
        body{font-family: Arial; margin:20px}
        nav a{margin-right:10px}
        table{border-collapse:collapse; width:100%}
        th,td{border:1px solid #ccc;padding:8px}
    </style>
</head>
<body>
    <nav>
        <a href="<?= BASE_URL ?>/?controller=student&action=index">Students</a>
        <a href="<?= BASE_URL ?>/?controller=incident&action=index">Incidents</a>
        <?php if (Auth::check()): ?>
            <span> | Logged in as <?= htmlspecialchars(Auth::user()['FullName'] ?? Auth::user()['Username']) ?></span>
            <a href="<?= BASE_URL ?>/?controller=auth&action=logout">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/?controller=auth&action=login">Login</a>
        <?php endif; ?>
    </nav>
    <hr>
    <?= $content ?? '' ?>
</body>
</html>