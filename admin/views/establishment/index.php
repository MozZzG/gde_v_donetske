<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstablishmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заведения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establishment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить заведение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Name',
            'About',
            'Text:ntext',
            // 'Map:ntext',
            // 'Video:ntext',
            // 'Worktime',
            // 'Phone',
            // 'Address',
            // 'Website:ntext',
            // 'Field1Name',
            // 'Field1Value',
            // 'Field2Name',
            // 'Field2Value',
            // 'Photo1:ntext',
            // 'Photo2:ntext',
            // 'Photo3:ntext',
            // 'Photo4:ntext',
            // 'Photo5:ntext',
            // 'Photo6:ntext',
            // 'Photo7:ntext',
            // 'Photo8:ntext',
            // 'Photo9:ntext',
            // 'Photo10:ntext',
            'subcategory.Name',
            // 'Views',
            // 'Likes',
            // 'Comments',
            // 'Rating',
            // 'UserID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
