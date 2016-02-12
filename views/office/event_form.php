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

<form enctype="multipart/form-data" action="add_img_event" method="post" name="add_img_event" id="adding_img_event" target="hiddenframe1" style="display: none;">
    <input id="add_photo_event" name="photo_event" type="file">
    <input id="event_id" name="event_id" type="hidden" value="<?= $event ?>">
</form>

<?php $form = ActiveForm::begin([
    'id' => 'event_form',
    'action' => 'test_event',
    'options' => [
        'autocomplete' => 'off',
    ],
    'fieldConfig' => [
        'template' => '{input}',
    ],
]); ?>
<div class="img"><img src="img/<?= $model->Photo ? 'events/'.$model->Photo : 'afisha_null.jpg' ?>" alt=""></div>
    <table>
        <tr>
            <td class="event_form_label">название:</td><td><?= $form->field($model, 'Name')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td class="event_form_label">место проведения:</td><td><?= $form->field($model, 'Place')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td class="event_form_label">начало:</td><td><?= $form->field($model, 'Time')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
        <tr>
            <td class="event_form_label">контакты:</td><td><?= $form->field($model, 'Contacts')->textInput(['placeholder' => 'редактировать'])->label(false) ?></td>
        </tr>
    </table>
    <?= $form->field($model, 'Photo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'EstablishmentID')->hiddenInput(['value' => $est->ID])->label(false) ?>
    <?= $form->field($model, 'EventID')->hiddenInput(['value' => $event])->label(false) ?>
    <?= $form->field($model, 'CategoryeventID')->dropDownList($cats, ['prompt' => 'категория', 'id' => 'event_cat'])->label(false) ?>
    <?= $form->field($model, 'Date')->widget(DatePicker::className(), ['language' => 'ru'])->label(false) ?>
    <?= $form->field($model, 'SubcategoryeventID')->dropDownList($subcats, ['prompt' => 'подкатегория', 'id' => 'event_subcat'])->label(false) ?>
    <div class="clr"></div>
    <a href="#" id="del_photo_event" <?= $model->Photo ? 'style="display: block;"' : '' ?>>удалить изображение</a>
    <div class="clr"></div>
    <p class="event_note">Минимальный размер афиши<br>570px - 400px;</p>
    <?= Html::submitButton('отправить на проверку') ?>
<?php ActiveForm::end(); ?>


<script type="text/javascript">jQuery(document).ready(function () {
        jQuery('#eventtestform-date').datepicker({"dateFormat":"yy-mm-dd"});});</script>
