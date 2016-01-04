<?php
/**
 * Formulaire sur la page d'accueil pour s'enregistrer,
 * Comporte seulement username,email et mot de passe
 * puis redirige vers registerForm, plus complet avec les champs username,email et mot de passe
 * déjà remplis
 */
?>

<div class="preRegisterDiv">

    <h4>Nouveau sur Aaron ? Inscrivez-vous ! </h4>

    <!--PRE SIGN UP FORM-->
    <form class="form-horizontal" method="post" name="register" action="preregister">

        <!--EMAIL-->
        <?php
        if(isset($errors['email'])) { ?>
            <div class="control-group info">
                <input type="text" id="inputEmail inputInfo" name="email" placeholder="Email" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
        <?php
        }
        else{
            ?>
            <div class="control-group info">
                <input type="text" id="inputEmail inputInfo" name="email" placeholder="Email" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
        <?php
        }
        ?>

        <!--PASSWORD-->

        <?php
        if(isset($errors['password'])) { ?>
            <div class="control-group error">
                <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
            <?php
        }
        else{
            ?>
            <div class="control-group error">
                <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
            <?php
        }
        ?>

        <!--CONFIRM PASSWORD-->
        <?php
        if(isset($errors['password'])) { ?>
            <div class="control-group error">
                <input type="password" id="inputPassword" name="confirmPwd" placeholder="Confirmez votre mot de passe" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
            <?php
        }
        else{
            ?>
            <div class="control-group error">
                <input type="password" id="inputPassword" name="confirmPwd" placeholder="Confirmez votre mot de passe" required><br><br>
                <span class="help-inline"><?php $errors['email']?></span>
            </div>
            <?php
        }
        ?>

        <!--SUBMIT ACTION-->
        <button type="submit" name="action" value="register" class="btn">S'inscrire sur Aaron</button>

    </form>
</div>