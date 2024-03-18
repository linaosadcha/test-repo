<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(array_key_exists('full_name', $_POST) && array_key_exists('usser_id', $_POST) ){
        $db = new PDO("sqlite:./db.sqlite3");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        try{
            if(array_key_exists('password', $_POST) && $_POST["password"]){
                $stmt =  $db->prepare("update 'users' set 'full_name' = ?, 'password' = ? where 'id' = ?");
                $stmt->execute([
                    $_POST["full_name"],
                    password_hash($_POST["password"], PASSWORD_BCRYPT),
                    $_POST["user_id"],
                ]);
            }else{
                $stmt =  $db->prepare("update 'users' set 'full_name' = ? where 'id' = ?");

                $stmt->execute([
                    $_POST["full_name"],
                    $_POST["user_id"],
                ]);
            }
        } catch(Throwable $t){
            $_SESSION["session_error"] = "Помилка редагування профілю користувача";
            header("Location: /index.php");
            die;
        }
        $_SESSION["session_success"] = "Профіль успішно оновлено";
        header("Location: /show.php?user_id={$_POST["user_id"]}");
        die;
    }else{
        $_SESSION["form_error"] = "Не всі поля заповнені";
        header("Location: {$_SERVER ["HTTP_REFERER"]}");
        die;
    }
}else{
    header("Запитувана сторінка доступна лише через POST запит!", true, 404);
    die;
}