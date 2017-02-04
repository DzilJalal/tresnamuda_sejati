<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\models\Request;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\it\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="request-index">
    <div id="ajaxCrudDatatable">
        <?=
       
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Reload', [''], ['data-pjax' => 1, 'class' => 'btn btn-warning', 'title' => 'Reset Grid']) .
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Data Request IT-06',
                'before' => '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group mr-2" role="group" aria-label="First group">' .
                                Html::a('<i class="glyphicon glyphicon-plus"></i> Add Request', ['create'], ['role' => 'modal-remote', 'title' => 'Create new Requests', 'class' => 'btn btn-success']) .
                                Html::a('<i class="fa fa-group"></i> All Request : ' . Request::find()->count(), ['request/index'], ['data-pjax' => 1, 'class' => 'btn btn-primary', 'title' => 'All Request']).   
                                Html::a('<i class="glyphicon glyphicon-fire"></i> Belum Selesai : ' . $count_request_belum_selesai, ['request/request-belum-selesai'], ['data-pjax' => 1, 'class' => 'btn btn-danger', 'title' => 'Search Belum Selesai']).   
                              '</div>
                            </div>
                            '

                
                    ,
                'after' => BulkButtonWidget::widget([
                    'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All', ["bulk-delete"], [
                        "class" => "btn btn-danger btn-xs",
                        'role' => 'modal-remote-bulk',
                        'data-confirm' => false, 'data-method' => false, // for overide yii data api
                        'data-request-method' => 'post',
                        'data-confirm-title' => 'Are you sure?',
                        'data-confirm-message' => 'Are you sure want to delete this item'
                    ]),
                ]) .
                '<div class="clearfix"></div>',
            ]
        ])
        ?>
    </div>
</div>

<?php
\yii2assets\fullscreenmodal\FullscreenModal::begin([
    "id" => "ajaxCrudModal",
    'header' => '<h4 class="modal-title text-center">Fullscreen Modal</h4>',
    'footer' => '',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
]);


\yii2assets\fullscreenmodal\FullscreenModal::end();
?>

<?php //      ?>

<?php
//Modal::begin([
//    "id" => "ajaxCrudModal",
//    "size" => 'modal-lg',
//    "clientOptions" => [
//        'backdrop' => 'static',
//        'keyboard' => false,
//    ],
//    "footer" => "", // always need it for jquery plugin
//]);
//
//Modal::end();
?>

