<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Newspartner */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Новости партнеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newspartner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить новость?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Name',
            'About',
            'Text:ntext',
            'establishment.Name',
            'Date',
            'Views',
            'Grey',
        ],
    ]) ?>

</div>
