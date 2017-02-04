<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\ItemRequest;

/* @var $this yii\web\View */
/* @var $model app\models\AnalisaRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analisa-request-form">

    <?php
    $form = ActiveForm::begin(
                    [
                        'id' => 'dynamic-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-3',
                                'offset' => 'col-sm-offset-1',
                                'wrapper' => 'col-sm-9',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
            )
    ?>
    <div class="row">

        <!-- Kolom Diisi User -->

        <div class="col-md-4">
            <?= $form->field($model, 'waktu')->widget(DatePicker::className(),
                [
                    'attribute' => 'Waktu : ',
                    'name' => 'waktu',
                    'value' => Yii::$app->formatter->asDatetime(strtotime($model->waktu), "php:m-Y"),
                    
                    'options' => [
                        'onclick' => '$(this).attr("value", $(this).val());',
                        'tabindex' => '1',
                    ],
                    'pluginOptions' => [
                        'minViewMode'=>'months',
                        'format' => 'mm-yyyy',
                        'todayBtn' => true,

                    ]
                ]) ?>

            <?= $form->field($model, 'item_id')->widget(Select2::classname(), [
                                        'disabled' => false,
                                        'data' => ArrayHelper::map(ItemRequest::find()->all(), 'id', 'nama_item'),
                                        'id' => 'item_id',
                                        'language' => 'id',
                                        'size' => Select2::LARGE,
                                        'options' => [
                                            'placeholder' => 'Select Item ...',
                                            'class' => 'select2-bootstrap-append',
                                            'width' => '15px'
                                            
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],

                                        'addon' => [
                                                    'append' => [
                                                        'content' => Html::button('Hitung !', [
                                                                    'class' => 'btn btn-primary', 
                                                                    'id' => 'hitung',
                                                                    'title' => 'Please deh...', 
                                                                    'data-toggle' => 'tooltip'
                                                            ]),
                                                        'asButton' => true
                                                                ]
                                                   ]
                                    ]);
                
            ?>


            <?= $form->field($model, 'jumlah_request')->textInput(["readonly" => "readonly"]) ?>
            <?= $form->field($model, 'permasalahan')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'analisa')->textarea(['rows' => 6]) ?>


            <?php if (!Yii::$app->request->isAjax){ ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 
                        'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php } ?>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-8">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">Analisa yang Sudah Dibuat</div>
                <!--<div class="panel-body">-->
                <table class="table table-bordered table-condensed" id="table-analisa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Jenis Permasalahan</th>
                            <th>Permasalahan Yang Timbul</th>
                            <th>Analisa IT</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
                <!--</div>-->
            </div>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">Request Yang Ada : <span id="info" style="color :red"></span></div>
                <!--<div class="panel-body">-->
                
                <table class="table" id="table-request">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat</th>
                            <th>Nama</th>
                            <th>Jenis Masalah</th>
                            <th>Keterangan</th>
                            <th>Tindakan IT</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <!--</div>-->
            </div>

        </div>
    </div>
</div>


<?php 
$getItemAnalyze = \Yii::$app->getUrlManager()->createUrl(['it/analisa-request/find-item-analyze']);
$js =<<<JS
     $('#hitung').click(function(event){    
        $('#info').text('');
        var waktu = $('#analisarequest-waktu').val();
        var item = $('#analisarequest-item_id').val();
        
        if(waktu ){
            $("#table-request").find("tr:gt(0)").remove(); //REMOVE TR DI TBODY
            $("#table-analisa").find("tr:gt(0)").remove(); //REMOVE TR DI TBODY
            $.ajax({
                url : '$getItemAnalyze',
                type : 'post',
                data : {
                    item : item,
                    waktu : waktu
                },
                dataType : 'json',
                success : function(response){
                     console.log(response);

                     $('#analisarequest-jumlah_request').val(response.jumlah);
                     $('#analisarequest-permasalahan').val(response.permasalahan);
                     if(response.jumlah != 0){
                        $.each(response.data, function (i, item) {
                            $('#table-request').find('tbody').append("<tr>" +
                                    "<td>" + ++i + "</td>" +
                                    "<td>" + item.header + "</td>" +
                                    "<td>" + item.first_name + ' ' + item.last_name + "</td>" +
                                    "<td>" + item.keluhan + "</td>" +
                                    "<td>" + item.keterangan_detail + "</td>" +
                                    "<td>" + item.catatan + "</td>" +
                                    "</tr>");
                            i++;
                        });
                    }else{
                        
                        $('#info').text('Not Found');
                        $('#analisarequest-jumlah').val(0);
                    }

                    $.each(response.analisa, function (i, item) {
                            $('#table-analisa').find('tbody').append("<tr>" +
                                    "<td>" + ++i + "</td>" +
                                    "<td>" + item.waktu + "</td>" +
                                    "<td>" + item.item.nama_item + "</td>" +
                                    "<td>" + item.permasalahan + "</td>" +
                                    "<td>" + item.analisa+ "</td>" +
                                    
                                    "</tr>");
                            i++;
                        });

                    return false;
                }
            });
            
        }else{
            $('#analisarequest-waktu').focus();
        }

        
    });
JS;
?>

<?php $this->registerJs($js)  ?>

<?php

if (!$model->isNewRecord){
    
    $waktu = Yii::$app->formatter->asDatetime(strtotime($model->waktu), "php:m-Y");
    
    echo "<script>         
            $('#analisarequest-waktu').val('$waktu');
            $('#table-request').find('tr:gt(0)').remove(); 
            $('#table-analisa').find('tr:gt(0)').remove(); 
          </script>";
    echo '<script> $("#table-analisa").find("tbody").append("';
    $i = 1;
    foreach($pendukung['analisa'] as $value):
        echo '<tr>';
        echo '<td>'. $i++ .'</td>';
        echo '<td>'. $value['waktu'].'</td>';
        echo '<td>'. $value['item']['nama_item'].'</td>';
        echo '<td>'. str_replace(PHP_EOL,"<br>",$value['permasalahan']) . '</td>';
        echo '<td>'. $value['analisa'].'</td>';
        echo '</tr>';
    endforeach;
    echo '");</script>';

    echo '<script> $("#table-request").find("tbody").append("';
    $j = 1;
    foreach($pendukung['data'] as $value):
        echo '<tr>';
        echo '<td>'. $j++ .'</td>';
        echo '<td>'. $value['header'].'</td>';
        echo '<td>'. $value['first_name']. ' '. $value['last_name'].'</td>';
        echo '<td>'. $value['keluhan'].'</td>';
        echo '<td>'. $value['keterangan_detail'].'</td>';
        //echo '<td>'. $value['catatan'].'</td>';
        echo '</tr>';
    endforeach;
    echo '");</script>';

}

?>