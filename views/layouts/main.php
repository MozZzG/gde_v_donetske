<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Category;
use app\models\Subcategory;
use yii\helpers\Url;

AppAsset::register($this);
use app\models\Users;
if (!Yii::$app->user->isGuest) {
    $u = Users::find()->where(['ID' => Yii::$app->user->ID])->one();
}
$this->registerLinkTag([
    'rel' => 'shortcut icon',
    'type' => 'image/x-icon',
    'href' => 'favicon.ico',
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container">
    <header>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-sm-10 col-md-8">
                <div class="row head_center">
                    <h1><a href="index">Где в Донецке</a></h1>
                    <form id="search_form">
                        <input type="text" id="search" placeholder="поиск"><input type="submit" value="?">
                    </form>
                </div>
            </div>
            <div class="col-sm-2 text-center right"><a href="http://gdevdonetske.com/forum" target="_blank" class="forum_link">Форум</a></div>
        </div>
        <div class="head_line"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-10 col-md-10 menu_block">
                <ul class="menu">
                    <?php
                    $menu = Category::find()->all();
                    foreach ($menu as $item) {
                        $submenu = Subcategory::find()->where(['CategoryID' => $item->ID])->all();
                        echo '<li><a href="#" class="nolink">'.$item->Name.'</a>';
                            echo '<ul>';
                            foreach ($submenu as $subitem) {
                                echo '<li><a href="'.Url::to(['catalog', 'id' => $subitem->ID]).'">'.$subitem->Name.'</a></li>';
                            }
                            echo '</ul>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-sm-1 right"></div>
        </div>
    </header>


    <?= $content ?>


</div>
<footer>
    <p class="text">По вопросам рекламы и размещению организаций на сайте:</p>
    <p class="contacts">+38 099 671 34 74&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+38 099 960 15 20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;m@gdevdonetske.com</p>
    <ul class="social">
        <li><a href="http://vk.com/public57981472" class="vk" target="_blank"></a></li>
        <li><a href="https://plus.google.com/+GdevDonetske" class="gp" target="_blank"></a></li>
        <li><a href="https://www.youtube.com/channel/UC81s33D-RehZec9RG2hr0zg" class="yt" target="_blank"></a></li>
        <li><a href="mailto:gdevdonetske@mail.ru" class="mail" target="_blank"></a></li>
        <li><a href="https://www.facebook.com/profile.php?id=100002094017082" class="fb" target="_blank"></a></li>
    </ul>
    <p class="site">
        <a href="http://gdevdonetske.com" target="_blank">Gdevdonetske.com</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::a(Yii::$app->user->isGuest ? 'вход в личный кабинет' : (((strpos(Yii::$app->controller->route, 'office')) || (!$u->Businessman)) ? 'выход' : 'вход в личный кабинет'), Yii::$app->user->isGuest ? 'login' : (((strpos(Yii::$app->controller->route, 'office')) || (!$u->Businessman)) ? 'logout' : 'office'), ['class' => 'acc_link'])?>
    </p>
    <p class="copy">© 2013 - 2016 Где в Донецке...?</p>
    <p class="copy2">Copyright: Ali Sayed. All Rights Reserved.</p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
