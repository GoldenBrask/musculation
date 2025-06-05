<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $user = $userModel->findByEmail($_POST['email']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit;
            } else {
                $error = 'Email ou mot de passe invalide';
            }
        }
        require_once __DIR__ . '/../views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            if ($userModel->findByEmail($_POST['email'])) {
                $error = 'Cet email est déjà utilisé';
            } else {
                $userModel->create($_POST['email'], $_POST['password']);
                header('Location: /login');
                exit;
            }
        }
        require_once __DIR__ . '/../views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>
