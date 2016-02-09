<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $subcategory->Name.' | Информационный портал где в Донецке?';
$this->registerJsFile('js/catalog.js');
?>

<div class="row">
    <table>
    <tr>
    <td class="vert_top">
        <h2 class="text-center"><?= $subcategory->Name ?></h2>
        <!--
        <form id="podcat_filter" class="row">
            <div class="col-sm-4"><select><option>кухня</option></select></div>
            <div class="col-sm-4"><select><option>средний счет</option></select></div>
            <div class="col-sm-4"><select><option>дополнительно</option></select></div>
        </form>
        -->
        <div class="row podcat_top">
            <?php
            foreach ($establishments_top as $est) {
                $rate = $est->Rating * 19 + floor($est->Rating) * 6;
                ?>
                <div class="col-sm-4">
                    <a href="<?= Url::to(['establishment', 'id' => $est->ID]) ?>">
                        <img src="img/establishments/<?= $est->Photo1 ?>" alt="">
                        <div class="stars_big"><div class="stars_full" style="width: <?= $rate ?>px;"></div></div>
                        <p class="cat"><?= $subcategory->Name ?></p>
                        <h2><?= $est->Name ?></h2>
                        <p class="about"><?= $est->About ?></p>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <ul class="row podcat">
            <?= $this->render('_catalog', [
                'subcategory' => $subcategory,
                'establishments' => $establishments,
            ]) ?>
        </ul>
        <?php
        if ($more) echo '<a href="#" class="show_more" id="'.$subcategory->ID.'">показать еще</a>';
        ?>
    </td>
    <td class="vert_top index_banner">
        <div class="banner">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Страница заведений небоскреб -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="6693966142"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="banner">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Страница заведения маленький -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="2124165745"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </td>
    </tr>
    </table>
</div>
<div class="row news">
    <h1 class="text-center"><a href="news_partner">Новости партнеров</a></h1>
    <?php
        foreach ($news as $item) {
     ?>
            <div class="col-sm-2">
                <a href="news_item?id=<?= $item->ID ?>&partner=true">
                    <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                    <p class="new_caption"><?= $item->Name ?></p>
                    <p class="new_about"><?= $item->About ?></p>
                </a>
            </div>
    <?php
        }
    ?>
    <div class="clr"></div>
    <div class="banner_big">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Подраздел горизонтальный -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:980px;height:120px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="2879215343"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
    </div>
</div>