<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $subcategory->Name.' | Информационный портал где в Донецке?';
?>

    <?php
        foreach ($establishments as $est) {
            $rate = $est->Rating * 16 + floor($est->Rating) * 4;
            ?>
            <li class="col-sm-3">
                <a href="<?= Url::to(['establishment', 'id' => $est->ID]) ?>">
                    <img src="img/establishments/<?= $est->Photo1 ?>" alt="">
                    <div class="stars_small"><div class="stars_full" style="width: <?= $rate ?>px;"></div></div>
                    <p class="cat"><?= $subcategory->Name ?></p>
                    <h2><?= $est->Name ?></h2>
                    <p class="about"><?= $est->About ?></p>
                </a>
            </li>
        <?php
        }
    ?>