<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= $title ?></title>
    <style>
         .auth-name{
            color: #e0e0e0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }
        a.login-button{
            color: #e0e0e0;
            text-decoration: none;
            font-size: 12px;
            transition: color 300ms;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }
        a.login-button:hover {
            color: white;
        }
        a.nav-menu-button {
            color: #fafafa;
            text-decoration: none;
            display: block;
            font-size: 12px;
            padding: 10px 0;
            transition: background-color 300ms;
            text-transform: uppercase;
        }
        a.nav-menu-button:hover {
            color: white;
            background-color: #188050;
        }
        span.input-group-text {
            min-width: 100px;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="container-fluid  bg-success">
        <div class="container">
            <div class="row">
                <div clas="col py-3">
                    <div class="d-flex justify-content-beetwen">
                        <h3 class="text-white"> SIMPLE Project</h3>
                        <?php if(array_key_exists('user_id', $_SESSION)) { ?>
                           <div class="auth-name"><?= $_SESSION['full_name'] ?>, <a href="#" class="login-button" onclick="logout()">Вихід</a></div>
                           <form action="/logout.php" method="post" name="logout_request" class ="d-none">
                            </form>
                        <?php }else{ ?>
                            <a href="/login.php" class="login-button">Вхід</a>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-4 shadow bg-success" style="border-top: 1px solid #23954a; border-bottom: 1px solid #23954a;">
        <div class="container">
        <div class="row text-center">
                <div class="col-3 px-0" style="border-left: 1px solid #23954a; border-right: 1px solid #23954a;">
                    <a href="/index.php" class="nav-menu-button">Всі користувачі</a>
                </div>
                <div class="col-3 px-0" style="border-right: 1px solid #23954a;">
                    <a href="/create.php" class="nav-menu-button">Створити користувача</a>
                </div>
                <?php if( isset($edit) ){ ?>
                <div class="col-3 px-0" style="border-right: 1px solid #23954a;">
                    <a href="/edit.php?user_id=<?= $edit ?>" class="nav-menu-button">Редагувати</a>
                </div>
                <?php } ?>
                <?php if( isset($show) ){ ?>
                <div class="col-3 px-0" style="border-right: 1px solid #23954a;">
                    <a href="/show.php?user_id=<?= $show ?>" class="nav-menu-button">Показати</a>
                </div>
                <?php } ?>
                <?php if( isset($delete) ){ ?>
                <div class="col-3 px-0" style="border-right: 1px solid #23954a;">
                    <form action="/delete.php" method="post" name="delete_action">
                        <input type="hidden" name="user_id" value="<?= $delete ?>">
                        <input type="hidden" name="method" value="delete">
                        <a href="#" class="nav-menu-button" onclick="delete_hndl()">Видалити</a>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
             <div class="col">
             <?php if(array_key_exists("session_error", $_SESSION)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION["session_error"] ?>
                    <?php unset($_SESSION["session_error"]) ?>
                </div>
            <?php } ?>

            <?php if(array_key_exists("form_error", $_SESSION)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION["form_error"] ?>
                    <?php unset($_SESSION["form_error"]) ?>
                </div>
            <?php } ?>

            <?php if(array_key_exists("session_success", $_SESSION)){ ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION["session_success"] ?>
                    <?php unset($_SESSION["session_success"]) ?>
                </div>
            <?php } ?>
                <?= $content ?>
            </div>
        </div>
    </div>
    <script>

        function delete_hndl(form) {
            document.delete_action.submit();
        }

        function logout(form) {
            document.delete_action.submit();
        }

    </script>
</body>
</html>