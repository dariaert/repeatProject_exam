<?php include __DIR__ . "/../../templates/partials/header.php"; ?>

<h1>THIS IS REGISTER PAGE</h1>

<form action="/reg" method="post">
    <input type ="text" name="email" placeholder="E-mail"> <br>
    <input type ="password" name="password" placeholder="Пароль"> <br>
    <input type ="password" name="confirm_password" placeholder="Подтверждение пароля"> <br>
    <button type="submit">Регистрация</button>
</form>

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>
