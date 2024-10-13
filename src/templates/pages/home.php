<?php include __DIR__ . "/../../templates/partials/header.php"; ?>

<h1>THIS IS HOME PAGE</h1>
<?php if(isset($_SESSION['user'])): ?>
    <h2>Текущий пользователь: </h2>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>IMAGE</th>
            <th>EMAIL</th>
        </tr>
        <tr>
            <td><h2><?=$_SESSION['user']['id']?></h2></td>
            <td><img src="/src/uploads/<?=$_SESSION['user']['image']?>" style="width: 150px; height: 150px"></td>
            <td><h2><?=$_SESSION['user']['email']?></h2></td>
        </tr>
    </table> <br>
    <form action="/logout" method="post">
        <button type="submit">Выход</button>
    </form> <br>
    <?php if($_SESSION['user']['role'] == 'admin'): ?>
        <a href="/admin">Админ панель</a> <br><br>
    <?php endif; ?>
<?php else: ?>
    <a href="/login">Вход в аккаунт</a> <br>
    <a href="/register">Регистрация</a> <br><br>
<?php endif; ?>

<a href="/catalog">Каталог</a> <br><br>

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>