<?php

class Home extends Controller {

    public function index() {
        $data = [];
        if (!empty($_SESSION['username'])) {
            redirect('category');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new User();
            if ($data = $user->validate($_POST)) {
                $check = $user->first(['username' => $data['username']]);
                if (!empty($check)) {
                    if (password_verify($data['password'], $check->password)) {
                        $_SESSION['username'] = $check->username;
                        redirect('category');
                    }
                    else {
                        $user->errors['username'] = "Wrong username or password!";
                    }
                }
            }
            $data['errors'] = $user->errors;
        }

        $this->view('authentication/login', $data);
    }

    public function register() {
        $data = [];
        if (!empty($_SESSION['username'])) {
            redirect('category');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new User();
            if ($data = $user->validate($_POST)) {
                $check = $user->first(['username' => $data['username']]);
                if (!empty($check)) {
                    $user->errors['username'] = 'Username already taken';
                }else {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $user->insert($data);
                    $_SESSION['username'] = $data['username'];
                    redirect('category');
                }
            }
            $data['errors'] = $user->errors;
        }

        $this->view('authentication/register', $data);
    }

    public function logout() {
        if (!empty($_SESSION['username'])) {
            session_unset();
            session_destroy();
        }
        redirect('home');
    }
}
