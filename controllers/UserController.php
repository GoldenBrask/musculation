<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $user = $userModel->findByUsername($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit;
            } else {
                $error = 'Nom d\'utilisateur ou mot de passe invalide';
            }
        }
        require_once __DIR__ . '/../views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            if ($userModel->findByEmail($_POST['email'])) {
                $error = 'Cet email est déjà utilisé';
            } elseif (!preg_match('/^[a-zA-Z0-9]{3,18}$/', $_POST['username'])) {
                $error = "Le nom d'utilisateur doit faire entre 3 et 18 caractères alphanumériques";
            } elseif ($userModel->findByUsername($_POST['username'])) {
                $error = "Ce nom d'utilisateur est déjà pris";
            } else {
                $userModel->create($_POST['email'], $_POST['username'], $_POST['password']);
                header('Location: /login');
                exit;
            }
        }
        require_once __DIR__ . '/../views/register.php';
    }

    public function checkUsername() {
        $userModel = new User();
        $exists = $userModel->findByUsername($_GET['username']);
        header('Content-Type: application/json');
        echo json_encode(['available' => $exists ? false : true]);
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>
