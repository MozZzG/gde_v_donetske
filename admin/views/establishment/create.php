<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Establishment */

$this->title = 'Добавить заведение';
$this->params['breadcrumbs'][] = ['label' => 'Заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establishment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
