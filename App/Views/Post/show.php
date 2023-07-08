<?php require base_path("App/Views/partials/header.php") ?>
<?php require base_path("App/Views/partials/nav.php") ?>

<div class="showPostContainer">
    <div class="showPostContent">
        <p>by <?= htmlspecialchars($post["author"]) ?></p>
        <h1 ><?= htmlspecialchars($post["post_title"]) ?></h1>
    <?php if (!empty($post["post_body"])) : ?>
        <p class="showPostBody" ><?= htmlspecialchars($post["post_body"]) ?></p>
    <?php endif ?>
    </div>
    <form class="commentForm" action="/comment?id=<?= $post["id"] ?>" method="POST">
        <?php if (isset($_GET['errors']) && $_GET['errors'] == 1) : ?>
        <p class="error">A body of no more than 1,000 characters is required.</p>
        <?php endif ?>
        <textarea name="commentBody" placeholder="Write a comment"></textarea>
        <button type="submit">Comment</button>
    </form>
    <div class="commentList">
        <?php if (!empty($comments)) : ?>
            <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <p class="commentAuthor">by <?= htmlspecialchars($comment["author"]) ?></p>
                <p class="commentBody"><?= htmlspecialchars($comment["body"]) ?></p>
            </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php require base_path("App/Views/partials/footer.php") ?>
