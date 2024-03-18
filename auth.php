<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(array_key_exists('email', $_POST) && array_key_exists('password', $_POST) ){
        $db = new PDO("sqlite:./db.sqlite3");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt =  $db->prepare("select * from 'users' where 'email' = ?");
        if(!$stmt){
            $_SESSION["form_error"] = "Помилка";
            header("Location: /index.php");
            die;
        }
        $stmt->execute([
            $_POST["email"]
        ]);
        $user = $stmt->fetch();
        if($user && password_verify($_POST["password"], $user["password"])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION["session_success"] = "{$user["full_name"]}, Ви вдало увійшли в систему!";
            header("Location: /index.php");
            // die;
        }else{
            $_SESSION["form_error"] = "Користувача не знайдено";
            header("Location: /login.php");
            die;
        }

        $stmt =  $db->prepare("insert into 'users' ('full_name', 'email', 'password') values (?, ?, ?)");
        $stmt->execute([
            $_POST["full_name"],
            $_POST["email"],
            password_hash($_POST["password"], PASSWORD_BCRYPT)
        ]);
        // $user_id = $sb->lastInsertId();
        $user_id = $db->lastInsertId();
        header("Location: /show.php?user_id=$user_id");
        die;

    }else{
        $_SESSION["form_error"] = "Не всі поля заповнені";
        header("Location: /login.php");
        die;
    }
}else{
    header("Запитувана сторінка доступна лише через POST запит!", true, 404);
    die;
}