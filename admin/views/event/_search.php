<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Photo') ?>

    <?= $form->field($model, 'Date') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Place') ?>

    <?php // echo $form->field($model, 'Time') ?>

    <?php // echo $form->field($model, 'Contacts') ?>

    <?php // echo $form->field($model, 'CategoryEventID') ?>

    <?php // echo $form->field($model, 'SubcategoryEventID') ?>

    <?php // echo $form->field($model, 'EstablishmentID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
