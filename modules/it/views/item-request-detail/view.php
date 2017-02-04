<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemRequestDetail */
?>
<div class="item-request-detail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'item_request_id',
            'nama_detail',
        ],
    ]) ?>

</div>
