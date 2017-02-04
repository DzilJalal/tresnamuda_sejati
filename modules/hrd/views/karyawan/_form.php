<?php
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\Departement;
use app\models\Branch;
use app\models\Perusahaan;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">

    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-10',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>


     <?=
    $form->field($model, 'date_birth')->widget(
            DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
//        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayBtn' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'place_birth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'M' => 'M', 'F' => 'F', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rt_rw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_perkawinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    

     <?=
    $form->field($model, 'date_in')->widget(
            DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
//        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayBtn' => true
        ]
    ]);
    ?>



    

    <?=
    $form->field($model, 'date_out')->widget(
            DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
//        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayBtn' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

 

    <?=
    $form->field($model, 'perusahaan_id')->dropDownList(
            ArrayHelper::map(Perusahaan::find()->all(), 'id', 'nama_perusahaan'), ['prompt' => 'Select Company']
    )
    ?>

    <?=
    $form->field($model, 'branch_id')->dropDownList(
            ArrayHelper::map(Branch::find()->all(), 'id', 'name_branch'), ['prompt' => 'Select Branch']
    )
    ?>

    <?=
    $form->field($model, 'departement_id')->dropDownList(
            ArrayHelper::map(Departement::find()->all(), 'id', 'nama_departement'), ['prompt' => 'Select Departement']
    )
    ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
