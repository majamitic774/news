<?php

namespace News\Controllers;

use News\Core\View;

class UsersController
{
    private $usersModel = null;
    private $auth = null;

    public function __construct($usersModel, $auth)
    {
        $this->usersModel = $usersModel;
        $this->auth = $auth;
    }

    public function create($fileName)
    {
        View::render($fileName);
    }

    public function createLogin($fileName)
    {
        View::render($fileName);
    }

    public function insert()
    {
        if (!$this->usersModel->userExists($_POST['email'])) {
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
                $this->usersModel->insert(
                    htmlspecialchars($_POST['username']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['password'])
                );
                $_SESSION['success_message'] = "You have successfully registered.";
            } else {
                $_SESSION['error_message'] = "All fields are required.";
            }
        } else {
            $_SESSION['error_message'] = "User already exists.";
        }
        header('location: ' . BASE_URL . "index.php?page=usersRegisterForm");
    }

    public function delete()
    {
        $this->usersModel->delete($_POST['id']);
    }

    public function logOut()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $this->auth->logOut();
        header('location: ' . BASE_URL . "index.php?page=usersLoginForm");
    }

    public function logIn()
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        if ($this->auth->logIn($email, $password)) {
            $_SESSION['success_message'] = "You have successfully logged in.";
            header('Location: ' . BASE_URL . 'index.php?page=news');
        } else {
            $_SESSION['error_message'] = "Wrong username or password!";
            header('location: ' . BASE_URL . "index.php?page=usersLoginForm");
        }
        exit();
    }
}
