<?php

namespace News\Models;

use News\Core\Database;

require_once '../src/utils/constants.php';

class News extends Model
{
    public $tableName = "news";

    public function getAll($query = null)
    {
        $query = "SELECT news.category_id, categories.name, news.title, news.body, news.created_at, news.id, news.image 
        FROM `news` INNER JOIN `categories` ON news.category_id=categories.id 
        ORDER BY news.created_at DESC";
        return parent::getAll($query);
    }

    public function findById($id, $query = null)
    {
        $query = "SELECT * FROM $this->tableName where id=$id ";
        return parent::findById($id, $query);
    }

    public function getCategories()
    {
        $conn = Database::createInstance();
        $query = "SELECT * FROM categories";
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }


    public function insert($title, $body, $category_id, $imageName)
    {
        $conn = Database::createInstance();
        $sql = 'INSERT INTO news (title, body, category_id, image) VALUES (:title, :body, :category_id, :image)';
        $stmt = $conn->getConn()->prepare($sql);

        $stmt->execute([
            ':title' => $title,
            ':body' => $body,
            ':category_id' => $category_id,
            ':image' => $imageName
        ]);

        header('location: ' . BASE_URL . "index.php?page=news");
    }

    public function update($id, $title, $body, $image)
    {
        $conn = Database::createInstance();
        if ($image == null) {
            $sql = "UPDATE news SET title=:title, body=:body WHERE id=:id";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([":id" => $id, ":title" => $title, ":body" => $body]);
        } else {
            $sql = "UPDATE news SET title=:title, body=:body, image=:image WHERE id=:id";
            $stmt = $conn->getConn()->prepare($sql);
            $stmt->execute([":id" => $id, ":title" => $title, ":body" => $body, ":image" => $image]);
        }
        header('location: ' . BASE_URL . "index.php?page=news");
    }

    public function delete($id, $newsId = null, $pdoQuery = null)
    {
        $pdoQuery = "DELETE FROM news WHERE id=:id ";
        parent::delete($id, $pdoQuery);
        header('location: ' . BASE_URL . "index.php?page=news");
    }
}
