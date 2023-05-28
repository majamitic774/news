<?php

namespace News\Controllers;

use News\Core\Auth;
use News\Core\View;
use News\Models\Comment;

class CommentController
{
    private $commentModel;

    public function __construct($commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function insert()
    {
        if (isset($_SESSION['email'])) {
            $newsId = htmlspecialchars($_POST['news_id']);

            $this->commentModel->insert(
                htmlspecialchars($_POST['body']),
                htmlspecialchars($_POST['user_id']),
                $newsId
            );

            header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$newsId");
        }
    }

    public function delete()
    {
        $auth = new Auth();

        if (isset($_SESSION['email'])) {
            $loggedInUser = $auth->getLoggedInUser();
            $newsId = $_GET['news-id'];

            if (!$loggedInUser) {
                header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$newsId");
            }

            if ($loggedInUser['email'] == $_GET['user-commented-email'] || Auth::isAdmin()) {
                $this->commentModel->delete($_GET['comment-id'], $newsId);
            }
        }
    }
    public function update()
    {
        $comment_id = htmlspecialchars($_POST['comment_id']);
        $news_id = htmlspecialchars($_POST['news_id']);
        $body = htmlspecialchars($_POST['body']);

        if (isset($_SESSION['email'])) {
            if ($_SESSION['email'] == $_POST['user-commented-email']) {
                $this->commentModel->update($comment_id, $news_id, $body);
            } else {
                header('location: ' . BASE_URL . "index.php?page=single-news&news_id=$news_id");
            }
        }
    }

    public function showUpdateForm()
    {
        $comment = new Comment();
        $commentId = htmlspecialchars($_GET['comment_id']);

        $data = [
            "comment" => $comment->findById($commentId)
        ];

        View::render("updateCommentForm.php", $data);
    }
}
