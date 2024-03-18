<?php
session_start();
$db = new PDO("sqlite:./db.sqlite3");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt =  $db->prepare("select * from 'users'");
if($stmt){
$stmt->execute();
$users = $stmt->fetchAll();
}
ob_start();
?>

<?php if(!empty($users)){?>
    <?php foreach($users as $user){ ?>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div><?= $user["full_name"] ?></div>
                    <div>
                    <a href="/show.php?user_id=<?= $user['id'] ?>" class="btn btn-primary">Подивитись</a>
                    <a href="/edit.php?user_id=<?= $user['id'] ?>" class="btn btn-warning">Редагувати</a>
                    </div>
                </div>
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
    <?php } ?>
<?php }else{ ?>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Нема користувачів</h3>
        </div>
    </div>
<?php } ?>
<?php

$title = "Всі користувачі";
$content = ob_get_contents();

ob_end_clean();

require 'layout.php';
