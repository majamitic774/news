<!-- category -->
<nav class="navbar navbar-expand-lg navbar-light nav-categories">
    <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
            <?php foreach ($category as $cat) : ?>
                <li class="nav-item">
                    <a href="?page=news&category=<?php echo $cat['id'] ?>" class="nav-link"><?= $cat['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
<!-- and category  -->

<!-- all news  -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
            <!-- ovo mora da se vidi kako da se ispravi -->
        </div>
    </div>


    <div class="row">
        <?php foreach ($all_news as $news) : ?>
            <div class="col-md-4">
                <div class="card">
                    <a href="<?= BASE_URL ?>/index.php?page=single-news&news_id=<?php echo $news['id'] ?>">
                        <img class="card-img-top" src="<?= BASE_URL ?>storage/images/<?= $news['image'] ?>" alt="Slika vesti">
                    </a>
                    <div class="card-body">
                        <a href="<?= BASE_URL ?>/index.php?page=single-news&news_id=<?php echo $news['id'] ?>" class="link-dark text-decoration-none">
                            <h5 class="card-title"><?= $news['title'] ?></h5>
                        </a>
                        <small class="text-muted">Created: <?= $news['created_at'] ?></small>
                        <div class="d-flex">
                            <form action="<?= BASE_URL . 'index.php' ?>" method="POST">
                                <?php if (isset($_SESSION['token'])) : ?>
                                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                                    <input type="hidden" name="id" value="<?= $news['id'] ?>">
                                    <?php if (false == $auth->isAdmin()) : ?>
                                    <?php else : ?>
                                        <button type="submit" name="delete-news" class="btn btn-danger">delete</button><br />
                                    <?php endif; ?>
                                <?php endif; ?>
                            </form>
                            <?php if ($auth != False && false == $auth->isAdmin()) : ?>
                            <?php else : ?>
                                <a href="<?= BASE_URL ?>index.php?page=update-news&news_id=<?php echo $news['id'] ?>" class="btn btn-primary">edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;  ?>
    </div>
    <!-- and news  -->