<?php
class AuthController
{
    public function handle(): void
    {
        $action = $_POST['action'] ?? '';

        match($action) {
            'login'  => $this->login(),
            'logout' => $this->logout(),
            default  => $this->redirectLogin()
        };
    }

    private function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$username || !$password) {
            Session::flash('error', 'يرجى إدخال اسم المستخدم وكلمة المرور');
            $this->redirectLogin();
        }

        $db   = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            Session::flash('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
            $this->redirectLogin();
        }

        Session::set('user', [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'],
        ]);

        header('Location: /std_1_student_manager/');
        exit;
    }

    private function logout(): void
    {
        Session::destroy();
        $this->redirectLogin();
    }

    private function redirectLogin(): never
    {
        header('Location: /std_1_student_manager/?page=login');
        exit;
    }
}
