<?php

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
        'vAlign' => 'top',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
        'vAlign' => 'top',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'header',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'karyawan_id',
        'value' => 'karyawan.first_name',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'tanggal_permintaan',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'diketahui_oleh',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'width' => '60px',
        'attribute' => 'tanggal_persetujuan',
        'format' => 'datetime'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        //'width' => '16.97%',
        'width' => '34%',
        'attribute' => 'keluhan',
        'format' => 'raw',
        'value' => function ($data) {
                    $request_id = $data->id;
                    $keluhan = app\models\LinkReqItem::find()
                                    ->joinWith('itemDetail')
                                    ->where(['request_id' => $request_id])->all();

                    $string = '<ul>';
                    $no = '1';
                    foreach ($keluhan as $value) {
                        $string .= '<li>' . $value->itemDetail->nama_detail . '<br><b>Note : </b><br> <i>'. $value->keterangan  .'</i> <br><br></li>';


                        $no++;
                    }

                    $string .= '</ul>';

                    return $string;
                }
            ],

            // [
            //    'class' => '\kartik\grid\DataColumn',
            //    'attribute' => 'keterangan',
            //    'width' => '17.43%',
            //],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'catatan',
                'width' => '19.26%',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'diterima_oleh',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'tanggal_terima',
                'format' => 'datetime'
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'perkiraan_selesai',
                'format' => 'datetime'
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'tanggal_selesai',
                'format' => 'datetime'
            ],
           [
               'class' => '\kartik\grid\DataColumn',
               'attribute' => 'pelaksana',
           ],
            // [
            // 'class'=>'\kartik\grid\DataColumn',
            // 'attribute'=>'created_at',
            // ],
            // [
            // 'class'=>'\kartik\grid\DataColumn',
            // 'attribute'=>'updated_at',
            // ],
            // [
            // 'class'=>'\kartik\grid\DataColumn',
            // 'attribute'=>'created_by',
            // ],
            // [
            // 'class'=>'\kartik\grid\DataColumn',
            // 'attribute'=>'updated_by',
            // ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'width' => '160px',
                'dropdown' => false,
                'vAlign' => 'top',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Url::to([$action, 'id' => $key]);
                },
                        'viewOptions' => ['role' => 'modal-remote', 'class' => 'btn btn-xs btn-default', 'title' => 'View', 'data-toggle' => 'tooltip'],
                        'updateOptions' => ['role' => 'modal-remote', 'class' => 'btn btn-xs btn-primary', 'title' => 'Update', 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['role' => 'modal-remote', 'class' => 'btn btn-xs btn-danger', 'title' => 'Delete',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-toggle' => 'tooltip',
                            'data-confirm-title' => 'Are you sure?',
                            'data-confirm-message' => 'Are you sure want to delete this item'],
                    ],
                ];
