<?php

namespace News\Models;

use News\Core\Database;

class User extends Model
{
    public $tableName = "users";

    public function getAll($query = null)
    {
        $query = "SELECT * FROM users";
        return parent::getAll($query);
    }

    public function findById($id, $queri = null)
    {
        $query = "SELECT * FROM $this->tableName where id=$id ";
        return parent::findById($id, $query);
    }

    public function userExists($email)
    {
        $conn = Database::createInstance();
        $query = "SELECT * FROM users where email='$email'";
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute();
        $users = $stmt->fetch();
        return $users;
    }

    public function insert($username, $email, $password)
    {
        $conn = Database::createInstance();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $stmt = $conn->getConn()->prepare($sql);
        $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password]);
        header('location: ' . BASE_URL . "index.php");
    }

    public function delete($id, $newsId = null, $pdoQuery = null)
    {
        // $conn = Database::createInstance();
        $pdoQuery = "DELETE FROM users WHERE id=:id ";
        parent::delete($id, $newsId = null, $pdoQuery);
        // $stmt = $conn->getConn()->prepare($pdoQuery);
        // $stmt->execute(array(":id" => $id));
        header('location: ' . BASE_URL . "index.php");
    }
}
