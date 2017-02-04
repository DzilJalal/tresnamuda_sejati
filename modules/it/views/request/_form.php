<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Karyawan;
use app\models\TipeRequest;
use app\models\ItemRequest;
use app\models\ItemRequestDetail;
use yii\bootstrap\ActiveForm;
use nkovacs\datetimepicker\DateTimePicker;
use kartik\dialog\Dialog;
use yii\web\JsExpression;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
$this->registerCss(
    "th, td {
        padding: 1px;
        text-align: left;
    } "
    
    );
?>

<div class="request-form">

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





        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="panel-title">Form :Diisi Oleh User</h1>
                </div>
                <div class="panel-body">
                    <?=
                    $form->field($model, 'karyawan_id')->dropDownList(
                            ArrayHelper::map(Karyawan::find()->all(), 'id', 'first_name'), ['prompt' => 'Select Karyawan']
                    )
                    ?>


                    <?php

                    # Control form buat update 
                    if (isset($selectedTipeRequest)) {
                        $selectedChecked = [];
                        foreach ($selectedTipeRequest as $selected) {
                            array_push($selectedChecked, $selected->tipe_id);
                        }
                        $modelLinkReqTipe->tipe_id = $selectedChecked;
                    }

                    $dataTipe = ArrayHelper::map(TipeRequest::find()->all(), 'id', 'nama_tipe');
                    echo $form->field($modelLinkReqTipe,'tipe_id')->checkBoxList($dataTipe);
                    ?>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Keluhan</label>
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 10, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelLinkReqItem[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'item_id',
                                'item_detail_id',
                            ],
                        ]);
                        ?>
                        <div class="col-sm-9">
                            <!-- widgetContainer -->
                            <table class="table table-bordered" border="1">
                                <tbody class="container-items">
                                    <?php foreach ($modelLinkReqItem as $indexLink => $modelLinkReqItem): ?>
                                    <tr class="item">
                                        <td class="vcenter">
                                            <?=
                                              $form->field($modelLinkReqItem, "[{$indexLink}]item_id")->label(false)->widget(Select2::classname(), [
                                                  'disabled' => false,
                                                  'data' => ArrayHelper::map(ItemRequest::find()->all(), 'id', 'nama_item'),
                                                  'language' => 'id',
                                                  'options' => [
                                                      'placeholder' => 'Select Item ...',
                                                      'class' => 'item-request',
                                                      'required' => 'required',
                                                      'onchange' => "
                                                    var \$this = \$(this);
                                                    var \$row = \$this.closest('tr');
                                                    var select = \$row.find('.item-detail');

                                                    $.post('" . \Yii::$app->getUrlManager()->createUrl(['it/request/get-item-detail/']) . "',{ id : this.value}, function(response){
                                                        var option;
                                                        select.find('option').remove().end();

                                                        $.each(response, function (i, value) {
                                                             option = new Option(response[i].nama_detail, response[i].id);
                                                             select.append(option);
                                                        });

                                                        select.trigger('change');

                                                    });"
                                                  ],
                                                  'pluginOptions' => [
                                                      'allowClear' => true
                                                  ],
                                              ]);
                                            ?>
                                        </td>
                                        <td class="vcenter">
                                            <?=
                                              $form->field($modelLinkReqItem, "[{$indexLink}]item_detail_id")->label(false)->widget(Select2::classname(), [
                                                  'disabled' => false,
                                                  'data' => ArrayHelper::map(ItemRequestDetail::find()->all(), 'id', 'nama_detail'),
                                                  'language' => 'id',
                                                  'options' => [
                                                      'placeholder' => 'Select Item ...',
                                                      'class' => 'item-detail',
                                                  ],
                                                  'pluginOptions' => [
                                                      'allowClear' => true
                                                  ],
                                              ]);
                                            ?>
                                        </td>

                                        <td class="vcenter">
                                            <?=
                                              $form->field($modelLinkReqItem, "[{$indexLink}]keterangan")->label(false)->textArea(['rows' => '2', 'placeholder'=> 'Keterangan Per Item']) ;
                                            ?>
                                        </td>
                                        <td class="text-center vcenter" style="width: 2px;">
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus-sign"></span></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>
                                            <?=
                                            Html::button('<span class="fa fa-plus"></span> Tambah', ['class' => 'add-item btn btn-success btn-sm',]);
                                            ?>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>

                    <?=
                    $form->field($model, 'keterangan')->textarea([
                        'rows' => 4,
                        'placeholder' => 'Keterangan Umum Request, Dari Atasan...'
                    ])
                    ?>
                    <?=
                    $form->field($model, 'tanggal_permintaan')->widget(DateTimePicker::className(), [
                        'format' => 'dd-MM-y HH:mm',
                        'clientOptions' => [
                            'extraFormats' => ['YYYY-MM-DD HH:mm'],
                            'sideBySide' => false,
                            'showTodayButton' => true,
                            'allowInputToggle' => true,
                            'widgetPositioning' => [
                                'horizontal' => 'auto',
                                'vertical' => 'auto'
                            ]
                        ],
                            ]
                    )
                    ?>
                    <?=
                    $form->field($model, 'tanggal_persetujuan')->widget(DateTimePicker::className(), [
                        'format' => 'dd-MM-y HH:mm',
                        'clientOptions' => [
                            'extraFormats' => ['YYYY-MM-DD HH:mm'],
                            'sideBySide' => false,
                            'showTodayButton' => true,
                            'allowInputToggle' => true,
                            'widgetPositioning' => [
                                'horizontal' => 'auto',
                                'vertical' => 'auto'
                            ]
                        ],
                            ]
                    )
                    ?>
                    <?= $form->field($model, 'diketahui_oleh')->textInput(['maxlength' => true]) ?>
                    <?=
                    $form->field($model, 'tanggal_selesai')->widget(DateTimePicker::className(), [
                        'format' => 'dd-MM-y HH:mm',
                        'clientOptions' => [
                            'extraFormats' => ['YYYY-MM-DD HH:mm'],
                            'sideBySide' => false,
                            'showTodayButton' => true,
                            'allowInputToggle' => true,
                            'widgetPositioning' => [
                                'horizontal' => 'auto',
                                'vertical' => 'auto'
                            ]
                        ],
                            ]
                    )
                    ?>

                </div>
            </div>
        </div>



        <!-- Kolom Diisi IT -->
        <div class="col-md-4">

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Form : Diisi Oleh IT</h3>
                </div>
                <div class="panel-body">

                    

                    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>
                    <?=
                    $form->field($model, 'tanggal_terima')->widget(DateTimePicker::className(), [
                        'format' => 'dd-MM-y HH:mm',
                        'clientOptions' => [
                            'extraFormats' => ['YYYY-MM-DD HH:mm'],
                            'sideBySide' => false,
                            'showTodayButton' => true,
                            'allowInputToggle' => true,
                            'widgetPositioning' => [
                                'horizontal' => 'auto',
                                'vertical' => 'auto'
                            ]
                        ],
                            ]
                    )
                    ?>

                    <?=
                    $form->field($model, 'perkiraan_selesai')->widget(DateTimePicker::className(), [
                        'format' => 'dd-MM-y HH:mm',
                        'clientOptions' => [
                            'extraFormats' => ['YYYY-MM-DD HH:mm'],
                            'sideBySide' => false,
                            'showTodayButton' => true,
                            'allowInputToggle' => true,
                            'widgetPositioning' => [
                                'horizontal' => 'auto',
                                'vertical' => 'auto'
                            ]
                        ],
                            ]
                    )
                    ?>

                    <?= $form->field($model, 'diterima_oleh')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'pelaksana')->textInput(['maxlength' => true]) ?>

                </div>
            </div>
        </div>

    </div>
    <?php //  $form->field($model, 'nomor_surat')->textInput(['maxlength' => true])                        ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>


</div>

<?php
// widget with advanced custom options
echo Dialog::widget([
    'options' => [  // customized BootstrapDialog options
        'size' => Dialog::SIZE_WIDE, // large dialog text
        'type' => Dialog::TYPE_INFO, // bootstrap contextual color
        'title' => 'Konfirmasi',
    ]
]);
?>

<?php
$getDetailItem = \Yii::$app->getUrlManager()->createUrl(['it/request/get-item-detail']);
$js = <<<JS
    var \$pop = $("input[type='checkbox'][name='ItemRequest[id][]']");

    function in_array (needle, haystack, argStrict) { // eslint-disable-line camelcase
      //  discuss at: http://locutus.io/php/in_array/
      // original by: Kevin van Zonneveld (http://kvz.io)
      // improved by: vlado houba
      // improved by: Jonas Sciangula Street (Joni2Back)
      //    input by: Billy
      // bugfixed by: Brett Zamir (http://brett-zamir.me)
      //   example 1: in_array('van', ['Kevin', 'van', 'Zonneveld'])
      //   returns 1: true
      //   example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'})
      //   returns 2: false
      //   example 3: in_array(1, ['1', '2', '3'])
      //   example 3: in_array(1, ['1', '2', '3'], false)
      //   returns 3: true
      //   returns 3: true
      //   example 4: in_array(1, ['1', '2', '3'], true)
      //   returns 4: false

      var key = ''
      var strict = !!argStrict

      // we prevent the double check (strict && arr[key] === ndl) || (!strict && arr[key] === ndl)
      // in just one for, in order to improve the performance
      // deciding wich type of comparation will do before walk array
      if (strict) {
        for (key in haystack) {
          if (haystack[key] === needle) {
            return true
          }
        }
      } else {
        for (key in haystack) {
          if (haystack[key] == needle) { // eslint-disable-line eqeqeq
            return true
          }
        }
      }

      return false
    }


    var getSelectedCheckBox = function (groupName){
        var init = [];
        var result = $('input[name="'+ groupName +'"]:checked');
        var checked = $('#request-keluhan').attr('data-checked');
        var defaultData = $('#request-keluhan').attr('data-default');
        var posit = (tab, value) => {var pos = -1;tab.forEach((x, index) => {if (x.value === value) pos = index;});return pos;}
        var winda = "";

        if (result.length > 0 ){
            //unique initialization
            var unique =[];
            var temp = [];

            if(checked){checkedArr = JSON.parse(checked);}else{checkedArr = [];}

            // --- hasil checked di push ke init -- //
            // result.each(function(i, element){init.push(
            //     {
            //         // label : $(this).data('label'),
            //         value : $(this).val(),});
            // });

            result.each(function(i, element){
                init.push($(this).val())
            });


            if(checkedArr.length != 0){
                // init = init.filter((x,i,arr) => posit(arr, x.value) === i); //get unique init
                unique = checkedArr;

                $.each(init, function(i, item){
                    unique.push(init[i]);
                });

                unique = unique.filter(function(item,i, a){return i==a.indexOf(item);});

                $.each(init, function(i, item){
                    check = in_array(init[i], unique);

                });

            }else{
                unique = init;
            }

            $('#request-keluhan').attr('data-checked', JSON.stringify(unique));
            $('#request-keluhan').val(JSON.stringify(unique));

        }else{
            $('#div' + groupName).html("No checked");
        }
    }

    $(".item-request").change(function(e){
        alert();
       var defaultCheck = [];
        var detail = [];
        var value = $(this).val();
        var checked = $('#request-keluhan').attr('data-checked');

        if($(this).is(':checked')){
            if(checked){
                checkedArr = JSON.parse(checked);
            }else{
                checkedArr = [];
            }

            remo = checkedArr.filter(Boolean);

            var label = $("label[for='cb-"+value+"']").text();
            $.ajax({
                url : '$getDetailItem',
                type : 'post',
                data : {id : $(this).val()},
                dataType : 'json',
                success : function(response){
                    var checkbox="";

                    $.each(response, function(i, item){
                        defaultCheck.push(response[i].nama_detail);
                    });

                    $('#request-keluhan').attr('data-default', JSON.stringify(defaultCheck));

                    $.each(response, function(i, item){
                        detail.push("<div><input name='detail-tipe' data-label='"+label+"' type='checkbox' value='" + response[i].nama_detail + "' class='detail-tipe' /> " + response[i].nama_detail.toString() + "</div>");
                            for ( var j=0, k = checkedArr.length; j < k; j++ ) {
                            if( response[i].nama_detail == remo[j].value ){
                                detail.pop();
                                detail.push("<div><input name='detail-tipe' data-label='"+label+"' checked type='checkbox' value='" + response[i].nama_detail + "' class='detail-tipe' /> " + response[i].nama_detail.toString() + "</div>");
                            };
                        }
                    });

                    detail.map(function(item){
                        checkbox += item;
                    });

                    krajeeDialog.prompt("<p id='pilih'>Pilihan dalam item: <strong>" + label + "</strong> </p> " + checkbox,
                        function(result){
                            getSelectedCheckBox("detail-tipe");
                        });
                }
            });
        }else{

        }

    });
JS;
?>
<?php // $this->registerJs($js)  ?>

<?php //$this->registerJs("$(document).ready(function(){ $('[data-toggle=\'tooltip\']').tooltip();$('[data-toggle=\'popover\']').popover();});")    ?>
