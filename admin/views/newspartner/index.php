<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewspartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости партнеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newspartner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            'About',
            'establishment.Name',
            'Date',
            // 'Views',
            // 'Grey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
