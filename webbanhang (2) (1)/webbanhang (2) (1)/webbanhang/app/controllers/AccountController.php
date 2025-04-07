<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function register() {
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];

            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập username!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập fullname!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập password!";
            }
            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận chưa đúng!";
            }

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $errors['account'] = "Tài khoản này đã có người đăng ký!";
            }

            if (!empty($errors)) {
                include_once 'app/views/account/register.php';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $result = $this->accountModel->save($username, $hashedPassword); // Corrected to remove fullName

            if ($result) {
                header('Location: /webbanhang/account/login');
                exit;
            } else {
                echo "Lỗi khi lưu tài khoản."; // Improve error handling in production
            }
        }
    }

    public function logout() {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        session_destroy();
        header('Location: /webbanhang/product');
        exit;
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username); // Corrected method name

            if ($account) {
                $hashedPassword = $account->password;

                if (password_verify($password, $hashedPassword)) {
                    session_start();
                    $_SESSION['username'] = $account->username;
                    // $_SESSION['role'] = $account->role; // If role is implemented
                    header('Location: /webbanhang/product');
                    exit;
                } else {
                    echo "Mật khẩu không đúng.";
                }
            } else {
                echo "Lỗi: Không tìm thấy tài khoản.";
            }
        }
    }
}
?>