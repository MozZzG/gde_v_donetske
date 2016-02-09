<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Newspartner */

$this->title = 'Изменить новость: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новости партнеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="newspartner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
