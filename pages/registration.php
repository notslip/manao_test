<?php
$TITLE="Регистрация";
require_once("header.php");
?>
<main>
    <div class="container-fluid container-lg">
        <h1>Регистрация</h1>
        <form class="row g-3" id="registrationform" novalidate>
            <div class="col-md-4">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" required>

            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" required>

            </div>
            <div class="col-md-4">
                <label for="confirmpassword" class="form-label">Повторите пароль</label>
                <input type="password" class="form-control" id="confirmpassword" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</main>
<?php
require_once("footer.php");
?>
