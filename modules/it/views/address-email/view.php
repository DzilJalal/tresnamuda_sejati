<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AddressEmail */
?>
<div class="address-email-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'email:email',
            'degree',
        ],
    ]) ?>

</div>
