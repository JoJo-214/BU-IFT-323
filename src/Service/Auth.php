<?php
namespace Service;

use Model\User as UserModel;

class Auth
{
    public static function login(string $username, string $password): bool
    {
        $um = new UserModel();
        $user = $um->findByUsername($username);
        if (!$user) return false;
        if (!password_verify($password, $user['PasswordHash'])) return false;
        $_SESSION['user_id'] = (int)$user['UserID'];
        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
    }

    public static function user(): ?array
    {
        if (empty($_SESSION['user_id'])) return null;
        $um = new UserModel();
        return $um->findById((int)$_SESSION['user_id']);
    }

    public static function check(): bool
    {
        return (bool)self::user();
    }

    public static function roles(): array
    {
        $u = self::user();
        if (!$u) return [];
        $um = new UserModel();
        return $um->getRoles((int)$u['UserID']);
    }

    public static function hasRole($roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        $userRoles = self::roles();
        foreach ($roles as $r) {
            if (in_array($r, $userRoles, true)) return true;
        }
        return false;
    }

    public static function requireRole($roles)
    {
        if (!self::check()) {
            header('Location: ' . BASE_URL . '/?controller=auth&action=login&redirect=' . urlencode($_SERVER['REQUEST_URI']));
            exit;
        }
        if (!self::hasRole($roles)) {
            http_response_code(403);
            echo "403 Forbidden - insufficient privileges";
            exit;
        }
    }
}