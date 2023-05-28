<?php

namespace News\Models;

use News\Core\Database;

abstract class Model
{

    public function getAll($query = null)
    {
        $conn = Database::createInstance();
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute();
        $news = $stmt->fetchAll();
        return $news;
    }

    public function findById($id, $query = null)
    {
        $conn = Database::createInstance();
        $id = htmlspecialchars($id);
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute();
        $results = $stmt->fetch();
        return $results;
    }

    public function delete($id, $query = null)
    {
        $conn = Database::createInstance();
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute(array(":id" => $id));
    }
}
