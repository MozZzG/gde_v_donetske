<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\InputWidget;

$this->title = $est->Name.' | Информационный портал где в Донецке?';
?>

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
    <?= $form->field($model, 'CategoryeventID')->dropDownList($cats, ['prompt' => 'категория', 'id' => 'event_cat'])->label(false) ?>
    <?= $form->field($model, 'Date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'выбрать дату'],
    ]) ?>
    <div class="clr"></div>
<?= $form->field($model, 'SubcategoryeventID')->dropDownList($subcats, ['prompt' => 'подкатегория', 'id' => 'event_subcat'])->label(false) ?>
<?php ActiveForm::end(); ?>