<?php require base_path("App/Views/partials/header.php") ?>
<?php require base_path("App/Views/partials/nav.php") ?>

<div class="authContainer">
    <form class="authForm" action="/register" method="POST">
        <h1>Register a new account</h1>
        <input type="text" name="username" placeholder="Username" />
        <input type="email" name="email" placeholder="Email Address" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="confirmPassword" placeholder="Confirm Password" />
        <button type="submit">Register</button>
        <?php if (isset($errors["username"])) : ?>
            <p class="error"><?= $errors["username"] ?></p>
        <?php endif ?>
        <?php if (isset($errors["email"])) : ?>
            <p class="error"><?= $errors["email"] ?></p>
        <?php endif ?>
        <?php if (isset($errors["password"])) : ?>
            <p class="error"><?= $errors["password"] ?></p>
        <?php endif ?>
        <span class="alreadyRegistered" style="color: white;">Already registered? <a href="/login">Log in</a></span>
    </form>
</div>

<?php require base_path("App/Views/partials/footer.php") ?>
