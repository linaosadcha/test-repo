<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('method', $_POST) && $_POST["method"] == "delete"){
    $db = new PDO("sqlite:./db.sqlite3");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt =  $db->prepare("delete from 'users' where 'id' = ?");
    if($stmt){
        $stmt->execute([$_POST["user_id"]]);

        if ($stmt->rowCount() > 0){
            $_SESSION["session_success"] = "Запис успішно видалено!";
            header("Location: /index.php");
            die;
        }else{
            $_SESSION["session_error"] = "Помилка видалення!";
            header("Location: {$_SERVER ["HTTP_REFERER"]}");
            die;
        }
    }else{
        $_SESSION["session_success"] = "Помилка видалення!";
        header("Location: /index.php");
        die;
    }
}else{
    header("Запитувана сторінка доступна лише через POST/DELETE запит!", true, 404);
    die;
}