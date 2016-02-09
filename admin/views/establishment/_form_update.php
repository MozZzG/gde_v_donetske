<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Establishment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="establishment-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'map')->textInput() ?>

    <?= $form->field($model, 'video')->textInput() ?>

    <?= $form->field($model, 'worktime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput() ?>

    <?= $form->field($model, 'field1name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field1value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field2name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field2value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file1')->fileInput()->label('Фото 1') ?>

    <?= $form->field($model, 'file2')->fileInput()->label('Фото 2') ?>

    <?= $form->field($model, 'file3')->fileInput()->label('Фото 3') ?>

    <?= $form->field($model, 'file4')->fileInput()->label('Фото 4') ?>

    <?= $form->field($model, 'file5')->fileInput()->label('Фото 5') ?>

    <?= $form->field($model, 'file6')->fileInput()->label('Фото 6') ?>

    <?= $form->field($model, 'file7')->fileInput()->label('Фото 7') ?>

    <?= $form->field($model, 'file8')->fileInput()->label('Фото 8') ?>

    <?= $form->field($model, 'file9')->fileInput()->label('Фото 9') ?>

    <?= $form->field($model, 'file10')->fileInput()->label('Фото 10') ?>

    <?= $form->field($model, 'subcat')->dropDownList($items) ?>

    <?= $form->field($model, 'top')->checkbox() ?>

    <?= $form->field($model, 'indextop')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
