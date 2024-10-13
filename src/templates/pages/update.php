<?php include __DIR__ . "/../../templates/partials/header.php"; ?>

<h1>THIS IS UPDATE PAGE</h1>
<table border="2">
    <tr>
        <th>ID</th>
        <th>EMAIL</th>
        <th>IMAGE</th>
    </tr>
    <tr>
        <td><h2><?=$OneUser['id']?></h2></td>
        <td><h2><?=$OneUser['email']?></h2></td>
        <td><img src="/src/uploads/<?=$OneUser['image']?>" style="width: 100px; height: 100px"></td>
    </tr>

</table> <br>
<form action="/redact" method="post">
    <input type="hidden" name="id" value="<?=$OneUser['id']?>">
    <input type="hidden" name="image" value="<?=$OneUser['image']?>">
    <input type="text" name="email" value="<?=$OneUser['email']?>" placeholder="E-mail">
    <input type="hidden" name="password" value="<?=$OneUser['password']?>" placeholder="Пароль">
    <button type="submit" value="update">Редактировать</button>
</form>
<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>