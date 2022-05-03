<?php
$TITLE="Авторизация";
require_once("header.php");
?>
<main>
    <div class="container-fluid container-lg">
        <h1>Авторизация</h1>
        <form class="row g-3 needs-validation" id="loginform" >
            <div class="col-md-4">
                <label for="login" class="form-label">Логин</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" id="login" aria-describedby="inputGroupPrepend" required>
                    <div class="valid-feedback">
                        Добро пожаловать
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Пароль</label>
                <div class="input-group has-validation">
                    <input type="password" class="form-control" id="password" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>


            <div class="col-12">
                <button class="btn btn-primary" type="submit">Войти</button>
            </div>
        </form>
    </div>
</main>
<?php
require_once("footer.php");
?>
