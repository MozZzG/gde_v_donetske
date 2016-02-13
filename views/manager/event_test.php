<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="add_event?id=<?= $model->ID ?>" class="btn btn-success pull-left">Утвердить и добавить на сайт</a>
<p class="pull-right">E-mail пользователя: <strong><?= $user_mail ?></strong></p>
<div class="clr"></div>
<div class="event_test_block">
<div class="img"><img src="img/<?= $model->Photo ? 'events/'.$model->Photo : 'afisha_null.jpg' ?>" alt=""></div>
    <table>
        <tr>
            <td class="event_form_label">название:</td><td><?= $model->Name ?></td>
        </tr>
        <tr>
            <td class="event_form_label">место проведения:</td><td><?= $model->Place ?></td>
        </tr>
        <tr>
            <td class="event_form_label">начало:</td><td><?= $model->Time ?></td>
        </tr>
        <tr>
            <td class="event_form_label">контакты:</td><td><?= $model->Contacts ?></td>
        </tr>
        <tr>
            <td class="event_form_label">заведение:</td><td><a href="establishment?id=<?= $model->establishment->ID ?>"><?= $model->establishment->Name ?></a></td>
        </tr>
        <tr>
            <td class="event_form_label">категория:</td><td><?= $model->categoryevent->Name ?></td>
        </tr>
        <tr>
            <td class="event_form_label">подкатегория:</td><td><?= $subcat ?></td>
        </tr>
        <tr>
            <td class="event_form_label">дата:</td><td><?= $model->Date ?></td>
        </tr>
    </table>
</div>