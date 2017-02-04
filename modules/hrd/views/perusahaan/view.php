<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
?>
<div class="perusahaan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_perusahaan',
            'prefix',
            'nama_perusahaan',
            'description:ntext',
        ],
    ]) ?>

</div>
