<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subcategoryevent */

$this->title = 'Добавить подкатегорию событий';
$this->params['breadcrumbs'][] = ['label' => 'Подкатегории событий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoryevent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
