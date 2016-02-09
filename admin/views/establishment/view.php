<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Establishment */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establishment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить это заведение?',
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
            'Map:ntext',
            'Video:ntext',
            'Worktime',
            'Phone',
            'Address',
            'Website:ntext',
            'Field1Name',
            'Field1Value',
            'Field2Name',
            'Field2Value',
            'subcategory.Name',
        ],
    ]) ?>

</div>
