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
    <table>
        <tr>
            <td class="vert_top">
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
                    <div class="place"><?= $place ?> место в подразделе <a href="catalog?id=<?= $est->subcategory->ID ?>"><?= $est->subcategory->Name ?></a></div>
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
        <ul class="est_tabs">
            <li><a href="#">новости</a></li>
            <!--
            <li><a href="#">товары</a></li>
            <li><a href="#">услуги</a></li>
            <li><a href="#">меню</a></li>
            -->
        </ul>
        <div class="clr"></div>
        <?php if ($events) { ?>
        <div class="est_white">
            <h2 class="text-center">Афиши</h2>
            <ul class="afisha events">
                <?php foreach ($events as $event) { ?>
                <li><a href="#" data-key="<?= $event->ID ?>"><img src="img/events/<?= $event->Photo ?>" alt=""></a></li>
                <?php } ?>
            </ul>
            <?= LinkPager::widget([
                'pagination' => $pages_events,
                'prevPageLabel' => '<img src="img/page_l.png" alt="">',
                'nextPageLabel' => '<img src="img/page_r.png" alt="">',
            ]); ?>
        </div>
        <?php } ?>
        <?php if ($news) { ?>
        <div class="est_white">
            <h2 class="text-center">Новости</h2>
            <ul class="afisha news">
                <?php foreach ($news as $item) { ?>
                <li>
                    <a href="news_item?id=<?= $item->ID ?>&partner=true">
                        <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                        <p class="new_caption"><?= $item->Name ?></p>
                        <p class="new_about"><?= $item->About ?></p>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?= LinkPager::widget([
                'pagination' => $pages_news,
                'prevPageLabel' => '<img src="img/page_l.png" alt="">',
                'nextPageLabel' => '<img src="img/page_r.png" alt="">',
            ]); ?>
        </div>
        <?php } ?>
        <?php if ($recommend) { ?>
        <div class="est_white">
            <h2 class="text-center">Рекомендованные Вам</h2>
            <div class="row podcat">
                <?php
                foreach ($recommend as $rec) {
                    $rate_rec = $rec->Rating * 16 + floor($rec->Rating) * 4;
                ?>
                <div class="col-sm-3">
                    <a href="establishment?id=<?= $rec->ID ?>">
                        <img src="img/establishments/<?= $rec->Photo1 ?>" alt="">
                        <div class="stars_small"><div class="stars_full" style="width: <?= $rate_rec ?>px;"></div></div>
                        <p class="cat"><?= $rec->subcategory->Name ?></p>
                        <h2><?= $rec->Name ?></h2>
                        <p class="about"><?= $rec->About ?></p>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <!--
        <div class="est_white rev_block">
            <table>
                <tr>
                    <td>
                        <form>
                            <h2>Оставить отзыв</h2>
                            <textarea placeholder="напишите объективный отзыв"></textarea>
                            <div class="stars"><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a></div>
                            <div class="send"><a href="#"><img src="img/photo.png" alt=""></a><input type="submit" value="отправить"></div>
                        </form>
                    </td>
                    <td class="rev_ban"><img src="img/banner4.jpg" alt=""></td>
                </tr>
            </table>
        </div>
        <div class="est_white rev_block">
            <table>
                <tr>
                    <td>
                        <ul class="revs">
                            <li>
                                <table>
                                    <tr>
                                        <td class="rev_user">
                                            <div class="av"><img src="img/img1.jpg" alt=""></div>
                                            Ирина Иванова<br>
                                            <span class="rev_com">4</span><span class="rev_ask">2</span><span class="rev_ans">5</span>
                                        </td>
                                        <td class="rev">
                                            <div class="stars"><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a></div>
                                            <div class="clr"></div>
                                            <p>Донецк – достаточно молодой обязанный своим возникно вением огромным запасам полезных  территории. Точкой отсчета в истории города можно считать 1869 год, когда на месте современного Донецка валлийский промышленник Джон Юз начал строитель</p>
                                            <a href="#" class="like">10</a><a href="#" class="dislike">5</a>
                                            <a href="#" class="answer">Ответить</a><span class="date">29 января 2016 14:40</span>
                                            <div class="clr"></div>
                                            <div class="line"></div>
                                            <ul class="revs">
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td class="rev_user">
                                                                <div class="av"><img src="img/img1.jpg" alt=""></div>
                                                                Ирина Иванова<br>
                                                            </td>
                                                            <td class="rev">
                                                                <p>Донецк – достаточно молодой обязанный своим возникно вением огромным запасам полезных  территории. Точкой отсчета в истории города можно считать 1869 год, когда на месте современного Донецка валлийский промышленник Джон Юз начал строитель</p>
                                                                <a href="#" class="like">10</a><a href="#" class="dislike">5</a>
                                                                <a href="#" class="answer">Ответить</a><span class="date">29 января 2016 14:40</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                            <li>
                                <table>
                                    <tr>
                                        <td class="rev_user">
                                            <div class="av"><img src="img/img1.jpg" alt=""></div>
                                            Ирина Иванова<br>
                                            <span class="rev_com">4</span><span class="rev_ask">2</span><span class="rev_ans">5</span>
                                        </td>
                                        <td class="rev">
                                            <div class="stars"><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a><a href="#"></a></div>
                                            <div class="clr"></div>
                                            <p>Донецк – достаточно молодой обязанный своим возникно вением огромным запасам полезных  территории. Точкой отсчета в истории города можно считать 1869 год, когда на месте современного Донецка валлийский промышленник Джон Юз начал строитель</p>
                                            <a href="#" class="like">10</a><a href="#" class="dislike">5</a>
                                            <a href="#" class="answer">Ответить</a><span class="date">29 января 2016 14:40</span>
                                            <div class="clr"></div>
                                            <div class="line"></div>
                                            <ul class="revs">
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td class="rev_user">
                                                                <div class="av"><img src="img/img1.jpg" alt=""></div>
                                                                Ирина Иванова<br>
                                                            </td>
                                                            <td class="rev">
                                                                <p>Донецк – достаточно молодой обязанный своим возникно вением огромным запасам полезных  территории. Точкой отсчета в истории города можно считать 1869 год, когда на месте современного Донецка валлийский промышленник Джон Юз начал строитель</p>
                                                                <a href="#" class="like">10</a><a href="#" class="dislike">5</a>
                                                                <a href="#" class="answer">Ответить</a><span class="date">29 января 2016 14:40</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </td>
                    <td class="rev_ban"></td>
                </tr>
            </table>
        </div>
        -->
            </td>
            <td class="vert_top banner_col">
                <div class="banner">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Внутри заведения -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:600px"
                         data-ad-client="ca-pub-6504546679081073"
                         data-ad-slot="2959940542"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </td>
        </tr>
    </table>
</div>

