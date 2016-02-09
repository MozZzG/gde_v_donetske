<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerJsFile('js/news.js');

$this->title = $partner ? 'Новости партнеров | Информационный портал где в Донецке?' : 'Жизнь города | Информационный портал где в Донецке?';
?>

<div class="row white_cont">
    <table>
        <tr>
    <td class="vert_top">
        <h2 class="text-center"><?= $partner ? 'Новости партнеров' : 'Жизнь города' ?></h2>
        <?php
        if (!$partner) {
        ?>
        <ul class="news_links">
            <?php
            foreach ($category as $c) {
            ?>
                <li><a href="news?cat=<?= $c->ID ?>" <?= ($cat==$c->ID) ? 'class="active"' : null ?>><?= $c->Name ?></a></li>
            <?php
            }
            ?>
        </ul>
        <?php
        }
        ?>
        <div class="row news_page_block">
            <?php
            $i = 1;
            $position = [0, 3, 6, 1, 4, 7, 2, 5, 8];
            foreach ($position as $i) {
                $item = $news[$i];
                if ($i == 0) {
            ?>
                    <div class="col-sm-4">
                        <ul class="news_page">
            <?php
                }
                else if (($i == 1)||($i == 2)) {
            ?>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="news_page">
            <?php
                }
                if ($item) {
            ?>
                    <li <?= ($item->Grey) ? 'class="grey"' : null ?>>
                        <a href="news_item?id=<?= $item->ID ?>&partner=<?= $partner ? 'true' : 'false' ?>">
                            <img src="img/news/<?= $item->Photo ?>" alt="">
                            <div class="clr"></div>
                            <?php
                            if (!$partner) {
                            ?>
                            <p class="cat"><?= $item->categorynews->Name ?></p>
                            <?php } ?>
                            <p class="views"><?= $item->Views ?></p>
                            <div class="clr"></div>
                            <p class="news_h"><?= $item->Name ?></p>
                            <p class="about"><?= $item->About ?></p>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
                 </ul>
            </div>
            <div class="clr"></div>
            <?= LinkPager::widget([
                'pagination' => $pages,
                'prevPageLabel' => '<img src="img/page_l.png" alt="">',
                'nextPageLabel' => '<img src="img/page_r.png" alt="">',
            ]); ?>
        </div>
    </td>
    <td class="index_banner2 vert_top">
        <div class="banner">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Новости партнеров -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="2598183748"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </td>
    </tr>
    </table>
    <div class="clr"></div>
</div>