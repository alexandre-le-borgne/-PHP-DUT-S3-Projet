<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 13/01/2016
 * Time: 11:29
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $this->render('persists/head'); ?>
    </head>
    <body>
        <div id = "entete"></div>
        <?= $_content; ?>
        <a href="#entete">Remonter</a>
    </body>
</html>