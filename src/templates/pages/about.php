<?php include __DIR__ . "/../../templates/partials/header.php"; ?>
<h1>THIS IS ABOUT PAGE</h1>
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

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>