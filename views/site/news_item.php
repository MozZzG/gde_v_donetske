<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->Name.' | Информационный портал где в Донецке?';
$this->registerJsFile('js/news.js');
?>

<div class="row white_cont news_item_block">
    <div class="index_banner right pull-right">
        <div class="banner">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Внутри новости -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="9146074942"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>

    <h1 class="news_zag"><?= $model->Name ?></h1><br>
    <span class="date"><?= Yii::$app->formatter->asDate($model->Date) ?></span><span class="views news_item_views"><?= $model->Views ?></span><br><br>
    <?= $model->Text ?>

    <div class="banner_big">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Новости прямоугольный -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:980px;height:120px"
             data-ad-client="ca-pub-6504546679081073"
             data-ad-slot="6414764545"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <h2 class="text-center">Популярные статьи</h2>
    <ul class="city_news">
        <?php
        foreach ($pop as $item) {
            ?>
            <li>
                <a href="news_item?id=<?= $item->ID ?>&partner=<?= $partner ? 'true' : 'false' ?>">
                    <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                    <div class="clr"></div>
                    <h5><?= $item->Name ?></h5>
                    <p class="text"><?= $item->About ?></p>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>

