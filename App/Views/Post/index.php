<?php require base_path("App/Views/partials/header.php") ?>
<?php require base_path("App/Views/partials/nav.php") ?>

    <?php foreach ($posts as $post) : ?>
        <div class="post">
            <div class="postRating">
                <form class="likeForm" id="likeForm" action="/like-post" method="POST">
                    <input type="hidden" name="id" value="<?= $post["id"] ?>">
                    <button class="likeIcon <?= $post["liked"] === true ? "liked" : "" ?>" type="submit"><i class="fa-solid fa-thumbs-up"></i></button>
                </form>
                <p class="postRatingScore"><?= $post["rating"] ?></p>
                <form class="dislikeForm" id="dislikeForm" action="/dislike-post" method="POST">
                    <input type="hidden" name="id" value="<?= $post["id"] ?>">
                    <button class="dislikeIcon <?= $post["disliked"] === true ? "disliked" : "" ?>" type="submit"><i class="fa-solid fa-thumbs-down"></i></button>
                </form>
            </div>
                <div class="postContainer">
                    <a class="postAnchor" href="/post?id=<?= htmlspecialchars($post["id"])?>">
                        <p class="postAuthor">Posted by <?= $post["author"] ?></p>
                        <h2 class="postTitle"><?= htmlspecialchars($post["post_title"]) ?></h2>
                    </a>
                </div>
        </div>
    <?php endforeach ?>

<?php require base_path("App/Views/partials/footer.php") ?>