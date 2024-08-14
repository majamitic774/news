<div class="container-short">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL . 'index.php' ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <input type="hidden" name="id" value="<?php echo $_GET['news_id'] ?>"> <br />
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?= $news['title'] ?>">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input type="text" class="form-control" name="body" value="<?= $news['body'] ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image"><br />
        </div>
        <button type="submit" name="updateNews" class="btn btn-primary">Edit</button>
    </form>
</div>