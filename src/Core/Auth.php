<?php

namespace News\Core;

use News\Models\User;

class Auth
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function logIn($email, $password)
    {
        if ($user = $this->user->userExists($email)) {
            $isPasswordCorrect = password_verify($password, $user['password']);
            if ($isPasswordCorrect) {
                $_SESSION['email'] = $email;
                return true;
            }
        }
        return false;
    }

    public function logOut()
    {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }
    }

    public function getLoggedInUser()
    {
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $result = $this->user->userExists($email);
            return $result;
        }

        return false;
    }

    public static function isAdmin()
    {
        if (isset($_SESSION['email'])) {
            if ($_SESSION['email'] == "admin@admin.com") {
                return true;
            }
        }

        return false;
    }
}
