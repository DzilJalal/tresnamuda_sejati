<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'waktu',
        'value' => function($data){
                        Yii::$app->formatter->locale = 'ID';
                        return Yii::$app->formatter->asDatetime(strtotime($data->waktu), "php:F - Y");

                   }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'item_id',
        'value' => 'item.nama_item'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jumlah_request',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'permasalahan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'analisa',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   