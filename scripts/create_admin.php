<?php
require __DIR__ . '/../src/bootstrap.php';

use Model\Database;

$pdo = Database::getConnection();

$roles = ['Admin','Discipline Officer','Teacher','Student'];
$stmt = $pdo->prepare("INSERT IGNORE INTO Role (Name, Description) VALUES (:n, :d)");
foreach ($roles as $r) {
    $stmt->execute([':n'=>$r, ':d'=>"$r role"]);
}

// create admin user (username: admin, password: Admin@123)
$username = 'admin';
$password = 'Admin@123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$pdo->prepare("INSERT IGNORE INTO `User` (Username, PasswordHash, FullName, Email) VALUES (:u,:p,:f,:e)")
    ->execute([':u'=>$username, ':p'=>$hash, ':f'=>'Site Administrator', ':e'=>'admin@example.local']);

// link admin to Admin role
$adminId = $pdo->query("SELECT UserID FROM `User` WHERE Username = 'admin'")->fetchColumn();
$roleId = $pdo->query("SELECT RoleID FROM Role WHERE Name='Admin'")->fetchColumn();
if ($adminId && $roleId) {
    $ins = $pdo->prepare("INSERT IGNORE INTO UserRole (UserID, RoleID) VALUES (:uid, :rid)");
    $ins->execute([':uid'=>$adminId, ':rid'=>$roleId]);
}

echo "Seed complete. Admin user: admin / Admin@123\n";