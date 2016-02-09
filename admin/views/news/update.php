<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Изменение новости: ' . ' ' . $name;
$this->params['breadcrumbs'][] = ['label' => 'Новости города', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
        'items' => $items,
        'name' => $name,
        'about' => $about,
        'cat' => $cat,
        'date' => $date,
        'grey' => $grey,
    ]) ?>

</div>
