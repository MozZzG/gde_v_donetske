<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

?>

<form enctype="multipart/form-data" action="add_img_event" method="post" name="add_img_event" id="adding_img_event" target="hiddenframe1" style="">
    <input id="add_photo_event" name="photo_event" type="file">
    <input id="event_id" name="event_id" type="hidden" value="1">
</form>
<iframe id="hiddenframe1" name="hiddenframe1" style=""></iframe>
<?php $form = ActiveForm::begin([
    'options' => [
        'autocomplete' => 'off',
    ],
    'fieldConfig' => [
        'template' => '{input}',
    ],
]); ?>
<div class="img"><img src="img/afisha_null.jpg" alt=""></div>
    <table>
        <tr>
            <td>название:</td><td><?= $form->field($model, 'Name')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td>место проведения:</td><td><?= $form->field($model, 'Place')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td>начало:</td><td><?= $form->field($model, 'Time')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td>контакты:</td><td><?= $form->field($model, 'Contacts')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
    </table>
    <?= $form->field($model, 'Photo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'CategoryeventID')->dropDownList($cats, ['prompt' => 'категория', 'id' => 'event_cat'])->label(false) ?>
    <?= $form->field($model, 'Date')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'yy-MM-dd'])->label(false) ?>
    <?= $form->field($model, 'SubcategoryeventID')->dropDownList($subcats, ['prompt' => 'подкатегория', 'id' => 'event_subcat'])->label(false) ?>
    <div class="clr"></div>
<?php ActiveForm::end(); ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/office.js"></script>
<script src="js/datepicker-ru.js"></script>
<script type="text/javascript">jQuery(document).ready(function () {
        jQuery('#eventtestform-date').datepicker({"dateFormat":"MM d, yy"});});</script>
