<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoryevent */

$this->title = 'Изменить категорию: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Категрии событий', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="categoryevent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
