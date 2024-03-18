<?php
session_start();

$db = new PDO("sqlite:./db.sqlite3");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt =  $db->prepare("select * from 'users' where 'id' = ?");
if($stmt){
    $stmt->execute([$_GET["user_id"]]);
    $user = $stmt->fetchAll();
}
if(empty($user)){
    header("HTTP/1.1 404 Not Found");
    die;
}
ob_start();
?>

<div class="card">
    <div class="card-header">
        Редагувати <?=  $user["full_name"] ?>
    </div>
    <form action="/update.php" method="post">
        <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
        <div class="card-body">
            <div class="input-group mb-3">
                <span class="input-group-text">Нове ім'я</span>
                <input type="text" name="full_name" class="form-control" placeholder="Іван Петров" required value="<?= $user["full_name"] ?>" required autocomplete="name">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Новий пароль (можна ігнорувати)</span>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>
        </div>
        <div class="card-footer">
            <input class="btn btn-warning" type="submit" value="Змінити">
        </div>
    </form>
</div>

<?php

$title = "{$user["full_name"]} - Редагування";
$delete = $user["id"];
$show = $user["id"];
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');

