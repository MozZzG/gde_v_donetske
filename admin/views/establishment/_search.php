<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstablishmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="establishment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'About') ?>

    <?= $form->field($model, 'Text') ?>

    <?= $form->field($model, 'Map') ?>

    <?php // echo $form->field($model, 'Video') ?>

    <?php // echo $form->field($model, 'Worktime') ?>

    <?php // echo $form->field($model, 'Phone') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'Website') ?>

    <?php // echo $form->field($model, 'Field1Name') ?>

    <?php // echo $form->field($model, 'Field1Value') ?>

    <?php // echo $form->field($model, 'Field2Name') ?>

    <?php // echo $form->field($model, 'Field2Value') ?>

    <?php // echo $form->field($model, 'Photo1') ?>

    <?php // echo $form->field($model, 'Photo2') ?>

    <?php // echo $form->field($model, 'Photo3') ?>

    <?php // echo $form->field($model, 'Photo4') ?>

    <?php // echo $form->field($model, 'Photo5') ?>

    <?php // echo $form->field($model, 'Photo6') ?>

    <?php // echo $form->field($model, 'Photo7') ?>

    <?php // echo $form->field($model, 'Photo8') ?>

    <?php // echo $form->field($model, 'Photo9') ?>

    <?php // echo $form->field($model, 'Photo10') ?>

    <?php // echo $form->field($model, 'SubcategoryID') ?>

    <?php // echo $form->field($model, 'Views') ?>

    <?php // echo $form->field($model, 'Likes') ?>

    <?php // echo $form->field($model, 'Comments') ?>

    <?php // echo $form->field($model, 'Rating') ?>

    <?php // echo $form->field($model, 'UserID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
