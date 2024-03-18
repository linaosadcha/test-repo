<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (array_key_exists('full_name', $_POST) && array_key_exists('email', $_POST) && array_key_exists('password', $_POST)) {
        $db = new PDO("sqlite:./db.sqlite3");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $db->prepare("create table if not exists 'users' (
            'id' integer primary key,
            'full_name' varchar(255) not null,
            'email' varchar(255) not null unique,
            'password' varchar(255) not null
            )");
        $stmt->execute();

        $stmt = $db->prepare("select count (*) as 'founded' from 'users' where 'email' = ?");
        $stmt->execute([$_POST["email"]]);
        if ($stmt->fetch()["founded"] > 0) {
            $_SESSION["form_error"] = "{$_POST["email"]} - вже зайнято!";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            die;
        }
        $stmt = $db->prepare("insert into 'users' ('full_name', 'email', 'password') values (?, ?, ?)");
        $stmt->execute([
            $_POST["full_name"],
            $_POST["email"],
            password_hash($_POST["password"], PASSWORD_BCRYPT)
        ]);
        // $user_id = $sb->lastInsertId();
        $user_id = $db->lastInsertId();
        header("Location: /show.php?user_id=$user_id");
        die;

    } else {
        $_SESSION["form_error"] = "Не всі поля заповнені";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        die;
    }
} else {
    header("Запитувана сторінка доступна лише через POST запит!", true, 404);
    die;
}