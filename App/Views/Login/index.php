<?php require base_path("App/Views/partials/header.php") ?>
<?php require base_path("App/Views/partials/nav.php") ?>

<div class="authContainer">
    <form class="authForm" action="/login" method="POST">
        <h1>Login to your account</h1>
        <input type="email" name="email" placeholder="Email Address" />
        <input type="password" name="password" placeholder="Password" />
        <button type="submit">Login</button>
        <?php if (isset($errors["email"])) : ?>
            <p class="error"><?= $errors["email"] ?></p>
        <?php endif ?>
        <?php if (isset($errors["password"])) : ?>
            <p class="error"><?= $errors["password"] ?></p>
        <?php endif ?>
        <span class="notRegistered" style="color: white;">Not registered? <a href="/register">Create an account</a></span>
    </form>
</div>

<?php require base_path("App/Views/partials/footer.php") ?>
