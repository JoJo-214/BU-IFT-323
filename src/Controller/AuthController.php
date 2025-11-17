<?php
namespace Controller;

use Service\Auth;

class AuthController
{
    public function login()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (Auth::login($username, $password)) {
                $redirect = $_GET['redirect'] ?? (BASE_URL . '/?controller=student&action=index');
                header('Location: ' . $redirect);
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }
        ob_start();
        include __DIR__ . '/../../templates/auth/login.php';
        $content = ob_get_clean();
        include __DIR__ . '/../../templates/layout.php';
    }

    public function logout()
    {
        Auth::logout();
        header('Location: ' . BASE_URL . '/?controller=auth&action=login');
        exit;
    }
}