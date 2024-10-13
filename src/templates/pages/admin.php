<?php
include __DIR__ . "/../../templates/partials/header.php";
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('location: /');
}
?>

<h1>THIS IS ADMIN PAGE</h1>

<a href="/">Главная</a>

<form action="/add" method="post" enctype="multipart/form-data">
    <input type="text" name="email" placeholder="E-mail">
    <input type="text" name="password" placeholder="Пароль">
    <input type="file" name="image">
    <button type="submit">Добавить</button>
</form>

<table border="2">
    <tr>
        <th>ID</th>
        <th>EMAIL</th>
        <th>IMAGE</th>
        <th>UPDATE IT</th>
        <th>DELETE IT</th>
        <th>UPDATE IMAGE</th>
        <th>DELETE IMAGE</th>
    </tr>
    <?php foreach ($AllUsers as $item): ?>
        <tr>
            <td><h2><?=$item['0']?></h2></td>
            <td><h2><?=$item['1']?></h2></td>
            <td><img src="/src/uploads/<?=$item['3']?>" style="width: 130px; height: 130px"></td>
            <td><a href="update.php?id=<?=$item['0']?>">Обновить</a></td>
            <td>
                <form action="/delete" method="post">
                    <input type="hidden" name="id" value="<?=$item['0']?>">
                    <input type="hidden" name="image" value="<?=$item['3']?>">
                    <button type="submit">Удалить</button>
                </form>
            </td>
            <td>
                <form action="/update/avatar" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$item['0']?>">
                    <input type="file" name="image"> <br>
                    <input type="hidden" name="image_current" value="<?=$item['3']?>"> <br>
                    <button type="submit">Обновить фото</button>
                </form>
            </td>
            <td>
                <form action="/delete/avatar" method="post">
                    <input type="hidden" name="id" value="<?=$item['0']?>">
                    <input type="hidden" name="image" value="<?=$item['3']?>">
                    <button type="submit">Удалить фото</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>