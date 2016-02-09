<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Newspartner */

$this->title = 'Добавить новость';
$this->params['breadcrumbs'][] = ['label' => 'Новости партнеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newspartner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
