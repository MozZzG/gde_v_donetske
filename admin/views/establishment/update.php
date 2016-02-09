<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Establishment */

$this->title = 'Изменить заведение: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="establishment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
