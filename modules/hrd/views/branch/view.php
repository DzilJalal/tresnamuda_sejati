<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Branch */
?>
<div class="branch-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'prefix',
            'name_branch',
        ],
    ]) ?>

</div>
