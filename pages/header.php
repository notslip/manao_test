<!doctype html>
<html lang="en">
<?php session_start()?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo(!isset($TITLE) ? "Приложение" : $TITLE) ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<header class="bg-dark text-white">
    <div class="container-fluid container-lg">
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand link-decor" href="/pages/index.php">Приложение</a>
            <a class="navbar-brand link-decor" href="/pages/list.php">Список пользователей</a>
            <nav class="nav justify-content-end ">
                <?php if(isset($_SESSION['name'])){
                    echo "<h1>".$_SESSION['name']."</h1>";
                    echo '<a class="nav-link" id="exit" href="exit.php">Выйти</a>';
                }else{
                   echo '<a class="nav-link" href="registration.php">Зарегистрироваться</a>';
                   echo '<a class="nav-link" href="login.php">Войти</a>';
                }
                ?>

            </nav>
        </nav>
    </div>
</header>