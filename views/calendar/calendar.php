<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use marekpetras\calendarview\CalendarView;

$this->registerJsFile('js/calendar.js');

$this->title = 'Календарь событий | Информационный портал где в Донецке?';

?>
<table id="calendar_block">
    <tr>
        <td class="calendar_left">
            <div class="calendar_h"><h1>Календарь событий</h1></div>
            <div class="black">
                <?php
                $i = 1;
                if (!$open_cat) {
                ?>
                <ul class="calendar_category" id="cal_cat">
                <?php
                    foreach ($cats as $cat) {
                ?>
                <li><a href="#" data-key="<?= $cat->ID ?>"><span class="icon"><img src="img/calendar_icon<?= $i ?>.png" alt=""></span><?= $cat->Name ?><span class="label label-default"><?= $cat->Count ?></span></a></li>
                <?php
                    $i++;
                }?>
                </ul>
                <?php }
                else if ($open_sub) {
                ?>
                    <div class="cat_h"><div><span class="icon"><img src="img/calendar_icon<?= $c->ID ?>.png" alt=""></span><span class="text"><?= $c->Name ?></span><span class="label label-default"><?= $c->Count ?></span><div class="clr"></div></div></div>
                    <a href="#" id="sub_back" data-key="<?= $c->ID ?>"><img src="img/calendar_cat_back.png" alt=""> назад</a>
                    <ul class="calendar_category calendar_subcategory">
                        <?php
                        foreach ($cats as $cat) {
                            ?>
                            <li><a href="#" data-key="<?= $cat->ID ?>" <?= ($cat->ID == $s->ID) ? 'class="active_sub"' : '' ?>><?= $cat->Name ?><span class="label label-default"><?= $cat->Count ?></span></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                else {
                ?>
                <div class="cat_h"><div><span class="icon"><img src="img/calendar_icon<?= $c->ID ?>.png" alt=""></span><span class="text"><?= $c->Name ?></span><span class="label label-default"><?= $c->Count ?></span><div class="clr"></div></div></div>
                <a href="#" id="cat_back"><img src="img/calendar_cat_back.png" alt=""> назад</a>
                <ul class="calendar_category calendar_subcategory">
                <?php
                    foreach ($cats as $cat) {
                ?>
                <li><a href="#" data-key="<?= $cat->ID ?>"><?= $cat->Name ?><span class="label label-default"><?= $cat->Count ?></span></a></li>
                <?php
                    }
                ?>
                </ul>
                <?php
                }
                ?>
            </div>
            <img src="img/calendar_img.jpg" alt="" class="da">
            <div class="calendar_banner"><img src="img/calendar_banner.jpg" alt=""></div>
        </td>
        <td>
            <?= CalendarView::widget(
            [
            // mandatory
            'dataProvider'  => $dataProvider,
            'dateField'     => 'Date',
            'valueField'    => 'Photo',


            // optional params with their defaults
            'weekStart' => 1, // date('w') // which day to display first in the calendar
            'title'     => 'Calendar',

            'views'     => [
            'calendar' => '@vendor/marekpetras/calendarview/views/calendar',
            'month' => '@vendor/marekpetras/calendarview/views/month',
            'day' => '@vendor/marekpetras/calendarview/views/day',
            ],

            'startYear' => date('Y') - 1,
            'endYear' => date('Y') + 1,

            'link' => false,
            /* alternates to link , is called on every models valueField, used in Html::a( valueField , link )
            'link' => 'site/view',
            'link' => function($model,$calendar){
            return ['calendar/view','id'=>$model->id];
            },
            */

            'dayRender' => false,
            /* alternate to dayRender
            'dayRender' => function($model,$calendar) {
            return '<p>'.$model->id.'</p>';
            },
            */

            ]
            );

            ?>
        </td>
    </tr>
</table>