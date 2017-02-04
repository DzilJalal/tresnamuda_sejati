<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ItemRequest;

/* @var $this yii\web\View */
/* @var $model app\models\ItemRequestDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-request-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_request_id')->dropDownList(ArrayHelper::map(ItemRequest::find()->all(), 'id', 'nama_item')); ?>

    <?= $form->field($model, 'nama_detail')->textInput(['maxlength' => true]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
