<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categoryevent */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории событий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoryevent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
