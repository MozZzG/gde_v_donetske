<table class="month <?=$monthRendered?>">
<thead>
    <th colspan="8">

        <div class="calendar_head">
                <a href="" class="navigate ch_m" data-show="<?=$monthRendered-1?>" data-hide="<?=$monthRendered?>"><img src="img/cal_back.png"></a>
            <?php

            $translate = array(
                "January" => "Январь",
                "February" => "Февраль",
                "March" => "Март",
                "April" => "Апрель",
                "May" => "Май",
                "June" => "Июнь",
                "Jule" => "Июль",
                "August" => "Август",
                "September" => "Сентябрь",
                "October" => "Октябрь",
                "November" => "Ноябрь",
                "December" => "Декабрь",
            );

            ?>
            <a href="" class="navigate btn btn-primary hidden-xs hidden-sm"><?=strtr($title, $translate)?></a>
                <a href="" class="navigate btn btn-primary hidden-md hidden-lg"><?=strtr($title, $translate)?></a>
                <a href="" class="navigate ch_m" data-show="<?=$monthRendered+1?>" data-hide="<?=$monthRendered?>"><img src="img/cal_forw.png"></a>
        </div>
    </th>
</thead>
<thead>
<th class="hidden-xs hidden-sm">понедельник</th>
<th class="hidden-xs hidden-sm">вторник</th>
<th class="hidden-xs hidden-sm">среда</th>
<th class="hidden-xs hidden-sm">четверг</th>
<th class="hidden-xs hidden-sm">пятница</th>
<th class="hidden-xs hidden-sm">суббота</th>
<th class="hidden-xs hidden-sm">воскресенье</th>
<th class="hidden-md hidden-lg">пн</th>
<th class="hidden-md hidden-lg">вт</th>
<th class="hidden-md hidden-lg">ср</th>
<th class="hidden-md hidden-lg">чт</th>
<th class="hidden-md hidden-lg">пт</th>
<th class="hidden-md hidden-lg">сб</th>
<th class="hidden-md hidden-lg">вс</th>
</thead>

<?=$content?>

</table>