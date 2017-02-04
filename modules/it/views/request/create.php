<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
?>
<div class="request-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'modelLinkReqTipe' => $modelLinkReqTipe,
        'modelLinkReqItem' => $modelLinkReqItem,
    ])
    ?>
</div>
