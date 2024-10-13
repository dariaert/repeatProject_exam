<?php include __DIR__ . "/../../templates/partials/header.php"; ?>

<h1>THIS IS CATALOG PAGE</h1>

<table border="2">
    <tr>
        <th>NAME</th>
        <th>IMAGE</th>
        <th>ABOUT IT</th>
    </tr>
    <?php foreach ($AllUsers as $item): ?>
        <tr>
            <td><h2><?=$item['1']?></h2></td>
            <td><img src="/src/uploads/<?=$item['3']?>" style="width: 100px; height: 100px"></td>
            <td><a href="about.php?id=<?=$item['0']?>">Подробнее</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . "/../../templates/partials/footer.php"; ?>