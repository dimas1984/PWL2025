<h1> welcome to home page</h1>
<h2> Users : </h2>
<ul>
    <?php foreach($users as $user): ?>
        <li> <?php echo $user['name']; ?></li>
        <?php endforeach ?>
</ul>