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
    <meta name="robots" content="noindex,nofollow">
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
                                echo '<li><a href="catalog?id='.$subitem->ID.'">'.$subitem->Name.'</a></li>';
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
        <li><a href="https://www.facebook.com/GdevDonetskecom/" class="fb" target="_blank"></a></li>
    </ul>
    <p class="site">
        <a href="http://gdevdonetske.com" target="_blank">Gdevdonetske.com</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::a(Yii::$app->user->isGuest ? 'вход в личный кабинет' : (((strpos(Yii::$app->controller->route, '/office')) || (!$u->Businessman)) ? 'выход' : 'вход в личный кабинет'), Yii::$app->user->isGuest ? 'login' : (((strpos(Yii::$app->controller->route, '/office')) || (!$u->Businessman)) ? 'logout' : 'office'), ['class' => 'acc_link'])?>
    </p>
    <p class="copy">© 2013 - 2016 Где в Донецке...?</p>
    <p class="copy2">Copyright: Ali Sayed. All Rights Reserved.</p>
    <div class="yandex_counter"><!-- Yandex.Metrika informer -->
        <a href="https://metrika.yandex.ru/stat/?id=30110674&amp;from=informer"
           target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/30110674/3_0_433F44FF_231F24FF_1_pageviews"
                                               style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:30110674,lang:'ru'});return false}catch(e){}" /></a>
        <!-- /Yandex.Metrika informer --></div>
</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter30110674 = new Ya.Metrika({
                    id:30110674,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/30110674" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
