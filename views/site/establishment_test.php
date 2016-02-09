<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->registerJsFile('js/bootstrap.min.js');
$this->registerJsFile('js/establishment.js');


$this->title = $est->Name.' | Информационный портал где в Донецке?';
$rate = $est->Rating * 19 + floor($est->Rating) * 6;
?>

<div class="row">
    <div class="col-sm-10">
        <a href="add_est?id=<?= $est->ID ?>" class="btn btn-success pull-left">Утвердить и добавить на сайт</a>
        <p class="pull-right">E-mail пользователя: <strong><?= $user_mail ?></strong></p>
        <div class="clr"></div>
        <br>
        <table class="establ_block">
            <tr>
                <td class="photos_block">
                    <div class="shadow">
                        <ul id="photos">
                            <li>
                                <div id="myCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="active item">
                                            <img src="img/establishments/<?= $est->Photo1 ?>" alt="">
                                        </div>
                                        <?php if ($est->Photo2) { ?>
                                        <div class="item">
                                            <img src="img/establishments/<?= $est->Photo2 ?>" alt="">
                                        </div>
                                        <?php } ?>
                                        <?php if ($est->Photo3) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo3 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo4) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo4 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo5) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo5 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo5) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo5 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo6) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo6 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo7) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo7 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo8) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo8 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo9) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo9 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <?php if ($est->Photo10) { ?>
                                            <div class="item">
                                                <img src="img/establishments/<?= $est->Photo10 ?>" alt="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <a class="prev carousel-control left" href="#myCarousel" data-slide="prev"></a><a class="next carousel-control left" href="#myCarousel" data-slide="next"></a>
                                <div class="stars_big"><div class="stars_full" style="width: <?= $rate ?>px;"></div></div>
                                <div class="about"><h1><?= $est->Name ?></h1><?= $est->About ?></div>
                            </li>
                        </ul>
                    </div>
                </td>
                <td class="about_block">
                    <ul class="establ_menu">
                        <li class="active"><a href="#" id="main_link">основное</a></li>
                        <li><a href="#" id="about_link">о заведении</a></li>
                        <li><a href="#" id="video_link">видео</a></li>
                        <li><a href="#" id="map_link">карта</a></li>
                    </ul>
                    <div id="main" class="live_block">
                    <?php if ($est->Text) { ?>
                    <div class="about_text"><?= $est->Text ?></div>
                    <?php }?>
                    <div class="line"></div>
                    <?php if ($est->Field1Value) { ?>
                    <p class="name"><?= $est->Field1Name ?>:</p><p class="value"><?= $est->Field1Value ?></p>
                    <div class="clr"></div>
                    <?php }?>
                    <?php if ($est->Field2Value) { ?>
                    <p class="name"><?= $est->Field2Name ?>:</p><p class="value"><?= $est->Field2Value ?></p>
                    <div class="clr"></div>
                    <?php }?>
                    <?php if ($est->Worktime) { ?>
                    <p class="name">Время работы:</p><p class="value"><?= $est->Worktime ?></p>
                    <div class="clr"></div>
                    <?php }?>
                    <?php if ($est->Phone) { ?>
                    <p class="name">Телефон:</p><p class="value"><?= $est->Phone ?></p>
                    <div class="clr"></div>
                    <?php }?>
                    <?php if ($est->Address) { ?>
                    <p class="name">Адрес:</p><p class="value"><u><?= $est->Address ?></u></p>
                    <div class="clr"></div>
                    <?php }?>
                    <?php if ($est->Website) { ?>
                    <p class="name">Сайт:</p><p class="value"><?= $est->Website ?></p>
                    <div class="clr"></div>
                    <?php }?>
                    <div class="place">5 место в подразделе <a href="catalog?id=<?= $est->subcategory->ID ?>"><?= $est->subcategory->Name ?></a></div>
                    <div class="stat"><a href="#" class="com"><?= $est->Comments ?></a><a href="#" class="like"><?= $est->Likes ?></a><span class="view"><?= $est->Views ?></span></div>
                    </div>

                    <div id="video" class="live_block">
                        <?php if ($est->Video) { ?>
                            <iframe src="<?= $est->Video ?>" frameborder="0" allowfullscreen></iframe>
                        <?php }?>
                    </div>
                    <div id="about" class="live_block">
                        <?php if ($est->Text) { ?>
                            <div class="about_text"><?= $est->Text ?></div>
                        <?php }?>
                    </div>
                    <div id="map" class="live_block">
                        <?php if ($est->Map) {
                            echo $est->Map;
                        }?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-2 right">
        <div class="banner"><img src="img/banner1.jpg"></div>
        <div class="banner"><img src="img/banner2.jpg"></div>
    </div>
</div>

