<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subcategory */

$this->title = 'Добавление подкатегории';
$this->params['breadcrumbs'][] = ['label' => 'Подкатегории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
