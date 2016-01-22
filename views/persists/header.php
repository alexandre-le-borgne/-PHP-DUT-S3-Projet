<?php
/**
 * Created by PhpStorm.
 * User: maxbook
 * Date: 19/01/16
 * Time: 16:59
 */
?>


<header>
    <div id="profile">

    </div>
    <?php
    if ($this->isGranted(Session::USER_IS_CONNECTED)) {
        if ($this->isGranted(Session::USER_IS_ADMIN)) {
            ?>
            <a href="<?= View::getUrlFromRoute('admin') ?>">Panel Administrateur</a>
            <?php
        }
        $this->render('forms/logoutForm');
    } else {
        ?>
        <a href="login">Se connecter</a>
        <br>
        <a href="register">S'enregistrer</a>
        <br>
        <?php
    }
    ?>
</header>
