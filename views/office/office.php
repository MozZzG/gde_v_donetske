<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
$this->registerJsFile('js/bootstrap.min.js');
$this->registerJsFile('js/establishment.js');
$this->registerJsFile('js/office.js');
$this->registerJsFile('js/jquery-ui.js');
$this->registerJsFile('js/datepicker-ru.js');

$this->title = $est->Name.' | Информационный портал где в Донецке?';
$rate = $est->Rating * 19 + floor($est->Rating) * 6;
?>

<div class="row">
    <table>
    <tr>
    <td class="vert_top">
        <form enctype="multipart/form-data" action="add_img" method="post" name="add_img" id="adding_img" target="hiddenframe" style="display: none;">
            <input id="add_photo" name="photo" type="file">
            <input id="photo_num" name="photo_num" type="hidden" value="1">
            <input id="est_id" name="est_id" type="hidden" value="<?= $est->ID ?>">
        </form>
        <iframe id="hiddenframe" name="hiddenframe" style="display: none;"></iframe>
        <iframe id="hiddenframe1" name="hiddenframe1" style="display: none;"></iframe>
        <?php $form = ActiveForm::begin([
            'id' => 'est_edit',
            'fieldConfig' => [
                'template' => '{input}',
            ],
            'options' => [
                'autocomplete' => 'off',
            ],
        ]); ?>
        <table class="establ_block">
            <tr>
                <td class="photos_block">
                    <div class="shadow">
                        <ul id="photos">
                            <li>
                                <div id="myCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="active item" data-key="1">
                                            <img src="img/<?= $est->Photo1 ? 'establishments/'.$est->Photo1 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo1')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="2">
                                            <img src="img/<?= $est->Photo2 ? 'establishments/'.$est->Photo2 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo2')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="3">
                                            <img src="img/<?= $est->Photo3 ? 'establishments/'.$est->Photo3 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo3')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="4">
                                            <img src="img/<?= $est->Photo4 ? 'establishments/'.$est->Photo4 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo4')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="5">
                                            <img src="img/<?= $est->Photo5 ? 'establishments/'.$est->Photo5 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo5')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="6">
                                            <img src="img/<?= $est->Photo6 ? 'establishments/'.$est->Photo6 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo6')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="7">
                                            <img src="img/<?= $est->Photo7 ? 'establishments/'.$est->Photo7 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo7')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="8">
                                            <img src="img/<?= $est->Photo8 ? 'establishments/'.$est->Photo8 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo8')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="9">
                                            <img src="img/<?= $est->Photo9 ? 'establishments/'.$est->Photo9 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo9')->hiddenInput()->label(false) ?>
                                        </div>
                                        <div class="item" data-key="10">
                                            <img src="img/<?= $est->Photo10 ? 'establishments/'.$est->Photo10 : 'photo_null.jpg' ?>" alt="">
                                            <?= $form->field($model, 'Photo10')->hiddenInput()->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                                <a class="prev carousel-control left" href="#myCarousel"></a><a class="next carousel-control left" href="#myCarousel"></a>

                                <div class="stars_big">
                                        <a href="#" class="add_photo" <?= $est->Photo1 ? 'style="display: none;"' : '' ?>>добавить фото</a><br>
                                        <a href="#" class="del_photo" <?= $est->Photo1 ? '' : 'style="display: none;"' ?>>удалить фото</a>
                                        <div class="stars_full" style="width: 0px;"></div>
                                </div>
                                <div class="about">
                                    <h1><?= $form->field($model, 'Name')->textInput(['class' => 'on_photo', 'placeholder' => 'Добавить название'])->label(false) ?><!--<input type="text" value="Трям" class="on_photo">--></h1>
                                    <?= $form->field($model, 'About')->textInput(['class' => 'on_photo', 'placeholder' => 'Дополнительная информация'])->label(false) ?>
                                </div>
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
                    <div class="about_text"><?= $form->field($model, 'Text')->textarea(['placeholder' => 'Редактировать текст...', 'class' => 'text']) ?></div>
                    <div class="line"></div>
                    <p class="name"><input type="text" placeholder="редактировать" class="on_photo" name="EsttestForm[Field1Name]" value="<?= $model->Field1Name ?>"></p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Field1Value]" value="<?= $model->Field1Value ?>"></p>
                    <div class="clr"></div>
                    <p class="name"><input type="text" placeholder="редактировать" class="on_photo" name="EsttestForm[Field2Name]" value="<?= $model->Field2Name ?>"></p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Field2Value]" value="<?= $model->Field2Value ?>"></p>
                    <div class="clr"></div>
                    <p class="name">Время работы:</p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Worktime]" value="<?= $model->Worktime ?>"></p>
                    <div class="clr"></div>
                    <p class="name">Телефон:</p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Phone]" value="<?= $model->Phone ?>"></p>
                    <div class="clr"></div>
                    <p class="name">Адрес:</p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Address]" value="<?= $model->Address ?>"></p>
                    <div class="clr"></div>
                    <p class="name">Сайт:</p><p class="value"><input type="text" placeholder="редактировать" class="on_photo value" name="EsttestForm[Website]" value="<?= $model->Website ?>"></p>
                    <div class="clr"></div>
                    </div>

                    <div id="video" class="live_block">
                        <?= $form->field($model, 'Video')->textInput(['class' => 'video', 'placeholder' => 'https://www.youtube.com/watch?v=41Va2G6i-I4'])->label(false) ?>
                    </div>
                    <div id="about" class="live_block">

                    </div>
                    <div id="map" class="live_block">
                        <a href="http://www.google.com/maps" target="_blank">http://www.google.com/maps</a>
                        <?= $form->field($model, 'Map')->textInput(['class' => 'video'])->label(false) ?>
                        <p>1. Перейти по ссылке<br>2. Ввести адрес вашего заведения<br>3. Нажать поделиться<br>4. Скопировать <strong>КОД</strong> и вставить в поле</p>
                    </div>
                </td>
            </tr>
        </table>
        <!--<button id="read">ознакомьтесь с условиями заполнения!</button>-->
        <div class="clr"></div>
        <?= Html::submitButton('отправить на проверку') ?>
        <div class="clr"></div>
        <?php ActiveForm::end(); ?>

        <h2 class="text-center">Афиши</h2>
        <div class="est_white test_events_block">
            <ul class="afisha events">
                <?php
                    $i = 0;
                    foreach ($events as $event) {
                        $i++;
                ?>
                    <li><a href="#" data-key="<?= $event->ID ?>"><img src="img/events/<?= $event->Photo ?>" alt=""></a></li>
                <?php
                    }
                    if ($i < 5) {
                ?>
                    <li><a href="#" data-key="0"><img src="img/afisha_null.jpg" alt=""></a></li>
                <?php } ?>
            </ul>
            <?= LinkPager::widget([
                'pagination' => $pages_events,
                'prevPageLabel' => '<img src="img/page_l.png" alt="">',
                'nextPageLabel' => '<img src="img/page_r.png" alt="">',
            ]); ?>
        </div>
        <h2 class="text-center">Новости</h2>
        <div class="est_white test_events_block">
            <ul class="afisha news">
                <?php
                    $j= 0;
                    foreach ($news as $item) {
                        $j++;
                ?>
                    <li>
                        <a href="news_item?id=<?= $item->ID ?>&partner=true">
                            <div class="new_img"><img src="img/news/<?= $item->Photo ?>" alt=""></div>
                            <p class="new_caption"><?= $item->Name ?></p>
                            <p class="new_about"><?= $item->About ?></p>
                        </a>
                    </li>
                <?php
                    }
                if ($j < 5) {
                    ?>
                    <li>
                        <a href="#" id="add_news">
                            <div class="new_img"><img src="img/news_null.jpg" alt=""></div>
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
    </td>
    <td class="banner_col vert_top">
        <div class="banner"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Личный кабинет -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6504546679081073"
                 data-ad-slot="7467205342"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </td>
    </tr>
    </table>
</div>

<div id="window_afisha" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div id="window_add_new" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Укажите номер, по которому наш редактор<br>может уточнить все детали<br>
                <input type="text" id="new_number" class="form-control">
                <a href="#">отправить</a>
            </div>
        </div>
    </div>
</div>

<div id="window_thanks" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">

            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                С уважением, администрация портала "Где в Донецке..?"
            </div>
        </div>
    </div>
</div>

