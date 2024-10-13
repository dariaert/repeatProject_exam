<?php include __DIR__ . "/../../templates/partials/header.php"; ?>

<h1>THIS IS LOGIN PAGE</h1>

<form action="/auth" method="post">
    <input type ="text" name="email" placeholder="E-mail"> <br>
    <input type ="text" name="password" placeholder="Пароль"> <br>
    <button type="submit">Вход в аккаунт</button>
</form>

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>
