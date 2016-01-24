<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 19/01/2016
 * Time: 14:07
 */
$view->extend('layouts/layout');
$this->render('persists/header');

if(isset($errors)) {
    var_dump($errors);
    echo '<div class="errors_fields">'.$errors.'</div>';
}

echo $this->output('_content');
?>
<h1>
    <?php
    if (isset($channel))
    {
        echo '<a href="' . View::getUrlFromRoute('channel/' . $channel) . '">Blog de  ' . $this->escape($channel) . '</a>';
        echo '<a href="' . View::getUrlFromRoute('followchannel/' . $channel) . '"> Suivre</a>';
    }
    else
    {
        echo $this->output('title', 'Mes actualités');
    }
    ?>
</h1>
<div id="layout_connected">
    <?php
    if (isset($articles))
        $this->render('persists/feed', array('articles' => $articles));
    echo $this->renderControllerAction('aside');
    ?>
</div>