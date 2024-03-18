<?php
session_start();
$db = new PDO("sqlite:./db.sqlite3");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt =  $db->prepare("select * from 'users' where 'id' = ?");
if($stmt){
$stmt->execute([$_GET["user_id"]]);
$user = $stmt->fetch();
}
if(empty($user)){
    header("HTTP/1.1 404 Not Found");
    die;
}

ob_start();
?>

<div class="card">
    <div class="card-header">
        <?= $user["full_name"] ?>
    </div>
    <div class="card-body">
       <div class="mb-4">
            <div class="small">
                Ім'я
            </div>
            <div class="fw-bold">
                <?= $user["full_name"] ?>
            </div>
        </div>
        <div>
            <div class="small">
                Email
            </div>
            <div class="fw-bold">
                <?= $user["email"] ?>
            </div>
        </div>
    </div>
</div>

<?php

$title = $user["full_name"];
$edit = $user['id'];
$delete = $user['id'];
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');
