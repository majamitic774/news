<?php

namespace News\Models;

use News\Core\Database;

class Comment extends Model
{
    public $tableName = "comments";

    public function getAll($query = null)
    {
        $query = "SELECT * FROM comments";
        return parent::getAll($query);
    }

    public function findById($id,  $query = null)
    {
        $query = "SELECT * FROM $this->tableName where id=$id ";
        return parent::findById($id, $query);
    }

    public function insert($body, $user_id, $news_id)
    {
        $conn = Database::createInstance(); //isto 
        $sql = 'INSERT INTO comments (body, user_id, news_id) VALUES (:body, :user_id, :news_id)';
        $stmt = $conn->getConn()->prepare($sql); //isto
        $stmt->execute([':body' => $body, ':user_id' => $user_id, ':news_id' => $news_id]);
        header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$news_id");
    }

    public function delete($id, $newsId = null, $pdoQuery = null)
    {
        $pdoQuery = "DELETE FROM comments WHERE id=:id ";
        parent::delete($id, $pdoQuery);
        header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$newsId");
    }

    public function update($comment_id, $news_id, $body)
    {
        $conn = Database::createInstance();
        $sql = "UPDATE comments SET id=:id, body=:body WHERE id=:id";
        $stmt = $conn->getConn()->prepare($sql);
        $stmt->execute([":id" => $comment_id, ":body" => $body]);

        header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$news_id");
    }

    public function getComments($news_id)
    {
        $conn = Database::createInstance();
        $query = "SELECT comments.id, body, username, email  FROM comments INNER JOIN users ON comments.user_id=users.id WHERE news_id=:news_id"; #napravi samo sql string
        $stmt = $conn->getConn()->prepare($query);
        $stmt->execute([':news_id' => $news_id]);
        $comments = $stmt->fetchAll();
        return $comments;
    }
}
