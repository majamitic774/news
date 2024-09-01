<div class="container-short">
    <form action="" method="POST" enctype="multipart/form-data">
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['success_message']; ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>


        <?php if (isset($_SESSION['token'])) : ?>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <?php endif; ?>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Categories</label>
            <select name="category_id" class="form-select" id="inputGroupSelect01">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['name']  ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Content here -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="editor" class="form-label">Body</label>
            <textarea class="form-control" id="editor" name="body" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="id">
        </div>
        <button type="submit" name="insert-news" class="btn btn-primary">Submit</button>
    </form>
</div>

<script type="module">
    import {
        ClassicEditor,
        Heading,
        Link,
        List,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Image,
        ImageToolbar,
        ImageCaption,
        ImageUpload
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#editor'), {
            plugins: [Essentials, Bold, Link, Italic, Font, List, Paragraph, Heading,
                Image, ImageToolbar, ImageCaption, ImageUpload
            ],
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'heading', 'link', 'numberedList', 'bulletedList', '|',
                    'insertImage'
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative', 'toggleImageCaption', 'imageStyle:inline',
                    'imageStyle:block', 'imageStyle:side'
                ]
            }
        })
        .then( /* ... */ )
        .catch( /* ... */ );
</script>