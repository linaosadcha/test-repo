<?php
session_start();
$db = new PDO("sqlite:./db.sqlite3");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

ob_start();
?>
<div class="d-flex justify-content-center">
    <div class="card" style="max-width: 400px">
        <div class="card-header">
            Вхід
        </div>
        <div class="card-body">
            <form action="/auth.php" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="email" name="email" class="form-control" placeholder="example@example.net" required autocomplete="email">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Пароль</span>
                    <input type="password" name="password" class="form-control" autocomplete="password" required>
                </div>
                <div class="card-footer text-center">
                    <input class="btn btn-success" type="submit" value="Вхід">
                </div>
            </form>
        </div>
    </div>
</div>
<?php

$title = "Вхід користувача";

$content = ob_get_contents();

ob_end_clean();

require ('layout.php');
