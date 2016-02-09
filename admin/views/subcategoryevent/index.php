<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubcategoryeventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подкатегории событий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoryevent-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить подкатегорию событий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            'categoryevent.Name',
            'Count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
