<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_reset();
    $_SESSION["session_success"] = "Ви успішно вийшли із системи";
    header("Location: /login.php");
    die;
}else{
    header("HTTP/1.1 404 Not Found");
    die;
}
