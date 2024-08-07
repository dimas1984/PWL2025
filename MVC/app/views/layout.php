<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  require 'app/views/'.$view.'php';?>
</body>
</html>

<h1> welcome to home page</h1>
<h2> Users : </h2>
<ul>
    <?php foreach($users as $user): ?>
        <li> <?php echo $user['name']; ?></li>
        <?php endforeach ?>
</ul>