<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Newspartner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="newspartner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/newspartner/image-upload']),
            'plugins' => [
                'clips',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'file1')->fileInput() ?>

    <?= $form->field($model, 'est')->dropDownList($items) ?>

    <?= $form->field($model, 'date')->textInput(['placeholder' => '0000-00-00']) ?>

    <?= $form->field($model, 'grey')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
