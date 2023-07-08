<div class="nav">
    <a href="/">discuss-it</a>
    <?php if ($_SESSION["user"] ?? false) : ?>
    <div class="nav-btns">
            <form method="POST" action="/logout">
                <a href="/create-post"><button type="button" class="nav-btn">New post</button></a>
                    <button class="nav-btn" type="submit">Log Out</button>
            </form>
    </div>
    <?php else :?>
    <div class="nav-btns">
        <a href="/login"><button class="nav-btn">Login</button></a>
    </div>
    <?php endif ?>
</div>
<div class="container">