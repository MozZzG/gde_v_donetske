<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = 'Добавить событие';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'items1' => $items1,
        'ests' => $ests,
    ]) ?>

</div>

<script type="text/javascript">
    $('#eventform-cat').change(function() {
        var select = $(this);
        $.ajax({
            url: 'index.php?r=event/getsub&id='+select.val(),
            success: function(response){
                $('#eventform-subcat').html(response);
            }
        });
    });
</script>