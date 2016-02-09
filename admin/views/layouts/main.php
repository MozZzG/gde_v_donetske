<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Где в Донецке..?',
        'brandUrl' => 'http://gdevdonetske.com',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Категории', 'url' => ['/category/index']],
            ['label' => 'Подкатегории', 'url' => ['/subcategory/index']],
            ['label' => 'Заведения', 'url' => ['/establishment/index']],
            ['label' => 'Новости', 'items' => [
                ['label' => 'Новости города', 'url' => ['/news/index']],
                ['label' => 'Новости партнеров', 'url' => ['/newspartner/index']],
            ]],
            ['label' => 'Категории событий', 'url' => ['/categoryevent/index']],
            ['label' => 'Подкатегории событий', 'url' => ['/subcategoryevent/index']],
            ['label' => 'События', 'url' => ['/event/index']],
            /*
            Yii::$app->user->isGuest ?
                ['label' => 'Войти', 'url' => ['/site/login']] :
                [
                    'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
            */
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
