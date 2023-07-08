<?php require base_path("App/Views/partials/header.php") ?>
<?php require base_path("App/Views/partials/nav.php") ?>

    <div class="createPostContainer">
        <form class="createPostForm" action="/create-post" method="POST">
            <?php if (isset($errors["title"])) : ?>
                <p class="error"><?= $errors["title"] ?></p>
            <?php endif ?>
            <input type="text" name="title" placeholder="Write a title (required)" />
            <textarea name="body" placeholder="Write something"></textarea>
            <button type="submit">Post</button>
        </form>
    </div>

<?php require base_path("App/Views/partials/footer.php") ?>