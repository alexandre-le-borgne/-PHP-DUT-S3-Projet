<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 19/01/2016
 * Time: 23:29
 */
if(isset($authUrl)) {
    ?>
    <a href="<?php echo $authUrl; ?>">
        <div class="gologin">
            <img src="<?= View::getAsset('img/share-googleplus.png') ?>">
            <p>Connectez vous avec Google</p>
        </div>
    </a>
    <?php
}
if(isset($errors) && $errors != '') {
    echo '<br><div class="errors_fields">'.$errors.'</div>';
}