<?php
session_start();
ob_start();
?>

<div class="card">
    <div class="card-header">
        Новий користувач
    </div>
    <form action="/store.php" method="post">
        <div class="card-body">
            <div class="input-group mb-3">
                <span class="input-group-text">Ім'я</span>
                <input type="text" name="full_name" class="form-control" placeholder="Іван Петров" required required autocomplete="name">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Email</span>
                <input type="text" name="email" class="form-control" placeholder="example@example.com" required required autocomplete="email">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Password</span>
                <input type="password" name="password" class="form-control" required autocomplete="password">
            </div>
        </div>
        <div class="card-footer">
            <input class="btn btn-success" type="submit" value="Створити">
        </div>
    </form>
</div>

<?php

$title = "Створюємо нового користувача!";
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');

