<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'About') ?>

    <?= $form->field($model, 'Text') ?>

    <?= $form->field($model, 'Photo') ?>

    <?php // echo $form->field($model, 'CategorynewsID') ?>

    <?php // echo $form->field($model, 'Date') ?>

    <?php // echo $form->field($model, 'Views') ?>

    <?php // echo $form->field($model, 'Grey') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
