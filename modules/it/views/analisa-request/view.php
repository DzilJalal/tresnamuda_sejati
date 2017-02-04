<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnalisaRequest */
?>
<div class="analisa-request-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'waktu',
            'item_id',
            'jumlah_request',
            'permasalahan:ntext',
            'analisa:ntext',
        ],
    ]) ?>

</div>
