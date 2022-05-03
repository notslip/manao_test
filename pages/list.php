<?php
$TITLE="Список пользователей";
require_once("header.php");
require_once "../models/model.php";
use MyModel\User;
?>
<main>
    <div class="container-fluid container-lg">
        <h1>Список пользователей</h1>
        <?php
            foreach (User::getListUsersName() as $user){
                echo "<p>".$user."</p>";
            }
        ?>
    </div>
</main>
<?php
require_once("footer.php");
?>
