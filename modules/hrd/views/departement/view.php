<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departement */
?>
<div class="departement-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'prefix',
            'nama_departement',
        ],
    ]) ?>

</div>
