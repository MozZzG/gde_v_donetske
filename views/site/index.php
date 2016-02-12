<?php

/* @var $this yii\web\View */

$this->title = 'Информационный портал где в Донецке?';
$this->registerJsFile('js/index.js');
?>

<div class="row map_hide">
    все услуги Донецка на карте
</div>
<div class="row">
    <table>
        <tr>
            <td class="main_top_col vert_top">
        <div class="row main_top">
            <div class="col-sm-4">
                <div class="podcat_top">
                    <?php
                    foreach ($establishments as $est) {
                        $rate = $est->Rating * 16 + floor($est->Rating) * 4;
                        ?>
                        <div>
                        <a href="establishment?id=<?= $est->ID ?>">
                            <div class="img"><img src="img/establishments/<?= $est->Photo1 ?>" alt=""></div>
                            <p class="est_com"><?= $est->Comments ?></p><p class="est_like"><?= $est->Likes ?></p><p class="est_view"><?= $est->Views ?></p>
                            <div class="clr"></div>
                            <div class="stars_big"><div class="stars_full" style="width: <?= $rate ?>px;"></div></div>
                            <p class="cat"><?= $est->subcategory->Name ?></p>
                            <h2><?= $est->Name ?></h2>
                            <p class="about"><?= $est->About ?></p>
                        </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-3 sales_block">
                <img src="img/sales.jpg" alt="">
                <ul class="sales">
                    <li><a href="#">-50% на косметику от Loreal, Только 3 дня. Первым трем девушкам -75%</a></li>
                    <li class="line"></li>
                    <li><a href="#">второе пиво в подарок от ресторана Юзовская пивоварня</a></li>
                    <li class="line"></li>
                    <li><a href="#">дарим всем девушкам клубную карту в НК Лица</a></li>
                    <li class="line"></li>
                    <li><a href="#">Подарок всем девушкам клубную карту в ночной клуб Чикаго</a></li>
                    <li class="line"></li>
                    <li><a href="#">второе пиво в подарок от ресторана Юзовская пивоварня</a></li>
                    <li class="line"></li>
                    <li><a href="#">Подарок всем девушкам клубную карту в ночной клуб Чикаго</a></li>
                    <li class="line"></li>
                    <li><a href="#">второе пиво в подарок от ресторана Юзовская пивоварня</a></li>
                </ul>
            </div>
            <div class="col-sm-5">
                <ul class="main_tabs">
                    <li class="party_link active">вечеринки</li>
                    <li class="cinema_link">кино</li>
                    <li class="theatre_link">театр</li>
                </ul>
                <div class="afisha_index party">
                    <ul class="main_afisha">
                        <?php foreach ($parties as $party) { ?>
                            <li><a href="establishment?id=<?= $party->EstablishmentID ?>"><img src="img/events/<?= $party->Photo ?>" alt=""></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="afisha_index cinema">
                    <ul class="main_afisha">
                        <?php foreach ($cinemas as $cinema) { ?>
                        <li><a href="establishment?id=<?= $cinema->EstablishmentID ?>"><img src="img/events/<?= $cinema->Photo ?>" alt=""></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="afisha_index theatre">
                    <ul class="main_afisha">
                        <?php foreach ($theatres as $theatre) { ?>
                            <li><a href="establishment?id=<?= $theatre->EstablishmentID ?>"><img src="img/events/<?= $theatre->Photo ?>" alt=""></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <a href="calendar" class="calendar_link">Подробный календарь<br>событий Донецка</a>
            </div>
        </div>
            </td>
            <td class="banner_col vert_top">
                <div class="banner"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Главная станица блок 1 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:600px"
                         data-ad-client="ca-pub-6504546679081073"
                         data-ad-slot="2263766547"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script></div>
            </td>
        </tr>
    </table>
</div>
<div class="row white_cont">
    <h2 class="text-center"><a href="news">Жизнь города</a></h2>
    <ul class="city_news">
        <?php
        foreach ($news as $item) {
        ?>
        <li>
            <a href="news_item?id=<?= $item->ID ?>&partner=false">
                <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                <p class="new_cat"><?= $item->categorynews->Name ?></p><p class="new_view"><?= $item->Views ?></p>
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

<div class="row forum_block">
    <table>
        <tr>
            <td class="vert_top">
        <h2 class="forum_zag">Вопросы жителей города<a href="http://gdevdonetske.com/forum">задать вопрос</a></h2>
        <ul class="last_quests large">
            <?php
            foreach ($posts as $p) {
            ?>
                <li>
                    <div class="avatar"><img src="http://gdevdonetske.com/forum/<?= $p['Avatar'] ?>" alt=""></div>
                    <div class="last_quest">
                        <p>
                            <a href="http://gdevdonetske.com/forum/question.php?id=<?= $p['ID'] ?>"><?= $p['Caption'] ?></a>
                        </p>
                        <p class="about"><?= $p['Name'].' '.$p['LastName'] ?>  в "<?= $p['Cat'] ?>", <?= $dates[$p['ID']] ?> назад</p>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
            </td>
            <td class="index_banner2 vert_top">
                <div class="banner"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Главная страница блок 2 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:600px"
                         data-ad-client="ca-pub-6504546679081073"
                         data-ad-slot="3740499746"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="row white_cont part_news">
    <h2 class="text-center"><a href="news_partner">Новости партнеров</a></h2>
    <ul class="city_news pn1">
        <?php
        foreach ($news_partner1 as $item) {
            ?>
            <li>
                <a href="news_item?id=<?= $item->ID ?>&partner=true">
                    <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                    <p class="partner_new_view"><?= $item->Views ?></p>
                    <div class="clr"></div>
                    <h5><?= $item->Name ?></h5>
                    <p class="text"><?= $item->About ?></p>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="banner_big">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Главная страница блок 3 прямоугольный -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:980px;height:120px"
             data-ad-client="ca-pub-6504546679081073"
             data-ad-slot="5217232946"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <ul class="city_news pn2">
        <?php
        foreach ($news_partner2 as $item) {
            ?>
            <li>
                <a href="news_item?id=<?= $item->ID ?>&partner=true">
                    <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                    <p class="partner_new_view"><?= $item->Views ?></p>
                    <div class="clr"></div>
                    <h5><?= $item->Name ?></h5>
                    <p class="text"><?= $item->About ?></p>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>

    <div class="row widgets">
        <div class="col-sm-4"><div id="vk_groups"></div></div>
        <div class="col-sm-4">
            <div class="fb-page" data-href="https://www.facebook.com/GdevDonetskecom" data-height="240" data-width="500" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
        </div>
        <div class="col-sm-4"><iframe id="instaw" src='inwidget/index.php?toolbar=false&view=18&inline=6' scrolling='no' frameborder='no'></iframe></div>
    </div>

</div>

<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
