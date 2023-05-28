<?php

use News\Models\Comment;

$comment = new Comment();
$commentId = $_GET['comment_id'];
$comment = $comment->findById($commentId);

?>

<div class="container-short">
    <form action="<?= BASE_URL . 'index.php' ?>" method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <input type="hidden" name="comment_id" value="<?php echo $commentId; ?>"><br />
        <input type="hidden" name="news_id" value="<?php echo $_GET['news_id'] ?>"><br />
        <input type="hidden" name="user-commented-email" value="<?php echo $_GET['user-commented-email'] ?>"><br />

        <div class="mb-3">
            <label for="body" class="form-label">Edit comment</label>
            <input type="text" class="form-control" name="body" value="<?= $comment['body'] ?>"><br />
        </div>
        <button type="submit" name="update-comment" class="btn btn-primary">Edit</button>
    </form>
</div>