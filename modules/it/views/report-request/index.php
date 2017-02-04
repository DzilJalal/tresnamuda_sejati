<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\DatePicker;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
?>

<?php 
$today = date('d-m-Y');

$dailyPrint = Url::toRoute(['export-to-pdf-harian']);
$dailyEmail = Url::toRoute(['email-report-harian']);

$weeklyPrint = Url::toRoute(['export-to-pdf-mingguan']);
$weeklyEmail = Url::toRoute(['email-report-mingguan']);

$monthlyPrint = Url::toRoute(['export-to-pdf-bulanan']);
$monthlyEmail = Url::toRoute(['email-report-bulanan']);

?>


<?php $this->title = 'Reporting Request'; ?>

<div class="report-request-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-address-card-o"></i>Report Panel
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- widgetContainer -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Harian</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Mingguan</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Bulanan</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <?php
                                $form = ActiveForm::begin([
                                            'id' => 'harian',
                                            'type' => ActiveForm::TYPE_INLINE,
                                            'method' => "POST",
                                            'action' => Url::toRoute(['search-harian']),
                                            'fieldConfig' => ['autoPlaceholder' => true],
                                            'options' => [
                                            ]
                                ]);
                                ?>

                                <div class="form-group">
                                    <?= Html::label("Tanggal : ", "Tanggal", []) ?>
                                    <?=
                                    
                                    DatePicker::widget([
                                        'attribute' => 'Tanggal : ',
                                        'name' => 'tanggal',
                                        'id' => 'tanggal',
                                        'value' => date('d-m-Y'),
                                        'options' => [
                                            'onclick' => '$(this).attr("value", $(this).val());',
                                            /*'onblur' => '$(this).attr("value", $(this).val());'
                                                       ."$('.btn-print').attr('href', \"$cetakHarian&tanggal=\"+ $('#tanggal').val());" */
                                        ],
                                        'pluginOptions' => [
                                            'format' => 'dd-mm-yyyy',
                                            'todayBtn' => true,
                                        ]
                                    ]);
                                    
                                    ?>
                                </div>

                                <?= Html::submitButton("<i class='fa fa-search'></i> Cari", ['class' => 'btn btn-primary']) ?>


                                <?php ActiveForm::end(); ?>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_2">
                                <?php
                                $form = ActiveForm::begin([
                                            'id' => 'mingguan',
                                            'type' => ActiveForm::TYPE_INLINE,
                                            'method' => "POST",
                                            'action' => Url::toRoute(['search-mingguan']),
                                            'fieldConfig' => ['autoPlaceholder' => true],
                                            'options' => [
                                            ]
                                ]);
                                ?>

                                <div class="form-group">
                                    <?= Html::label("Start : ", "Start", []) ?>
                                    <?=
                                    
                                    DatePicker::widget([
                                        'attribute' => 'Start : ',
                                        'name' => 'start',
                                        'id' => 'start',
                                        'options' => [
                                            'onclick' => '$(this).attr("value", $(this).val());',
                                            /*'onblur' => '$(this).attr("value", $(this).val());'
                                                       ."$('.btn-print').attr('href', \"$cetakHarian&tanggal=\"+ $('#tanggal').val());" */
                                        ],
                                        'pluginOptions' => [
                                            'format' => 'dd-mm-yyyy',
                                            'todayBtn' => true,
                                        ]
                                    ]);
                                    
                                    ?>
                                </div>

                                <div class="form-group">
                                    <?= Html::label("End : ", "End", []) ?>
                                    <?=
                                    
                                    DatePicker::widget([
                                        'attribute' => 'End : ',
                                        'name' => 'end',
                                        'id' => 'end',
                                        'options' => [
                                            'onclick' => '$(this).attr("value", $(this).val());',
                                            /*'onblur' => '$(this).attr("value", $(this).val());'
                                                       ."$('.btn-print').attr('href', \"$cetakHarian&tanggal=\"+ $('#tanggal').val());" */
                                        ],
                                        'pluginOptions' => [
                                            'format' => 'dd-mm-yyyy',
                                            'todayBtn' => true,
                                        ]
                                    ]);
                                    
                                    ?>
                                </div>

                                <?= Html::submitButton("<i class='fa fa-search'></i> Cari", ['class' => 'btn btn-primary']) ?>


                                <?php ActiveForm::end(); ?>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <?php
                                $form = ActiveForm::begin([
                                            'id' => 'bulanan',
                                            'type' => ActiveForm::TYPE_INLINE,
                                            'method' => "POST",
                                            'action' => Url::toRoute(['search-bulanan']),
                                            'fieldConfig' => ['autoPlaceholder' => true],
                                            'options' => [
                                            ]
                                ]);
                                ?>

                                <div class="form-group">
                                    <?= Html::label("Bulan : ", "Bulan", []) ?>
                                    <?=
                                    
                                    DatePicker::widget([
                                        'attribute' => 'Bulan : ',
                                        'name' => 'bulan',
                                        'id' => 'bulan',
                                        'value' => date('m-Y'),
                                        'options' => [
                                            'onclick' => '$(this).attr("value", $(this).val());',
                                            /*'onblur' => '$(this).attr("value", $(this).val());'
                                                       ."$('.btn-print').attr('href', \"$cetakHarian&tanggal=\"+ $('#tanggal').val());" */
                                        ],
                                        'pluginOptions' => [
                                            'minViewMode'=>'months',
                                            'format' => 'mm-yyyy',
                                            'todayBtn' => true,

                                        ]
                                    ]);
                                    
                                    ?>
                                </div>

                                <?= Html::submitButton("<i class='fa fa-search'></i> Cari", ['class' => 'btn btn-primary']) ?>


                                <?php ActiveForm::end(); ?>

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->

                    <p class="help-block" style="color: red;" id="info"></p>

                    <?= Html::button("<i class='fa fa-print'></i> Cetak Report ", ['class'  => 'btn btn-success btn-print','id'=> 'btn-print-laporan',])?>
                    <?= Html::button("<i class='fa fa-envelope'></i> Email Report",  ['class' => 'btn btn-warning','id' => 'btn-email'])?>
                    <br>
                    <table class="table table-striped table-bordered table-responsive table-hover" id="table-request" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Request</th>
                                <th>Nama</th>
                                <th>Dep</th>
                                <th>Tgl Request</th>
                                <th>Tgl Terima</th>
                                <th>Estimasi</th>
                                <th>Tgl Selesai</th>
                                <th>Pelaksana</th>
                                <th>Keluhan</th>
                                <th>Keterangan</th>
                                <th style="width: 20%;">Tindakan Yang Diambil</th>

                            </tr>
                        </thead>

                        <tbody id="hasil-pencarian">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
$scriptHitung = <<< JS
    var jenis_laporan;
    var url_l;
    var tgl_persetujuan;

    
    $('body').on('submit', '#harian', function(event){     
        jenis_laporan = 'harian';
        event.preventDefault();
        tangggal_terima = "";
        estimasi = "";
        tanggal_selesai = "";
        keterangan_detail = "";

        $('#info').text('');
        $("#table-request").find("tr:gt(0)").remove(); //REMOVE TR DI TBODY

        var \$form  = $(this);
        $('.panel-primary').showLoading();
        $.ajax({
            url:  \$form.attr('action'),
            type: 'POST',
            data: \$(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if(response != 0){
                    $.each(response.rows, function (i, item) {
                        tanggal_terima = item.tanggal_terima != null ? item.tanggal_terima : "";
                        estimasi = item.perkiraan_selesai != null ? item.perkiraan_selesai : "";
                        keterangan_detail = item.keterangan_detail != null ? item.keterangan_detail : "-";
                        tanggal_selesai = item.tanggal_selesai != null ? item.tanggal_selesai : "<label class='label label-danger'> Still Progress... </label>";
                        $('#table-request').find('tbody').append("<tr>" +
                                "<td>" + ++i + "</td>" +
                                "<td>" + item.header + "</td>" +
                                "<td>" + item.first_name + ' ' + item.last_name + "</td>" +
                                "<td>" + item.prefix + "</td>" +
                                "<td>" + item.tanggal_persetujuan + "</td>" +
                                "<td>" + tanggal_terima + "</td>" +
                                "<td>" + estimasi + "</td>" +
                                "<td>" + tanggal_selesai + "</td>" +
                                "<td>" + item.pelaksana + "</td>" +
                                "<td>" + item.keluhan + "<br><b>Note: </b><br>" + keterangan_detail + "</td>" +
                                "<td>" + item.keterangan + "</td>" +
                                "<td>" + item.catatan + "</td>" +
                                "</tr>");
                        i++;
                    });
                }else{
                    $('#info').text('Not Found');
                }
            }
        }).done(function(){
            $('.panel-primary').hideLoading();
        });
    
        return false;
    });

 $('body').on('submit', '#mingguan', function(event){     
        event.preventDefault();
        jenis_laporan = 'mingguan';
        
        tangggal_terima = "";
        estimasi = "";
        tanggal_selesai = "";
        keterangan_detail = "";
        $('#info').text('');

        $("#table-request").find("tr:gt(0)").remove(); //REMOVE TR DI TBODY

        var \$form  = $(this);
        $('.panel-primary').showLoading();
        $.ajax({
            url:  \$form.attr('action'),
            type: 'POST',
            data: \$(this).serialize(),
            dataType: 'json',
            success: function (response) {

               
                if(response != 0){
                    $.each(response.rows, function (i, item) {
                        tanggal_terima = item.tanggal_terima != null ? item.tanggal_terima : "";
                        estimasi = item.perkiraan_selesai != null ? item.perkiraan_selesai : "";
                        keterangan_detail = item.keterangan_detail != null ? item.keterangan_detail : "-";
                        tanggal_selesai = item.tanggal_selesai != null ? item.tanggal_selesai : "<label class='label label-danger'> Still Progress... </label>";
                        $('#table-request').find('tbody').append("<tr>" +
                                "<td>" + ++i + "</td>" +
                                "<td>" + item.header + "</td>" +
                                "<td>" + item.first_name + ' ' + item.last_name + "</td>" +
                                "<td>" + item.prefix + "</td>" +
                                "<td>" + item.tanggal_persetujuan + "</td>" +
                                "<td>" + tanggal_terima + "</td>" +
                                "<td>" + estimasi + "</td>" +
                                "<td>" + tanggal_selesai + "</td>" +
                                "<td>" + item.pelaksana + "</td>" +
                                "<td>" + item.keluhan + "<br><b>Note: </b><br>" + keterangan_detail + "</td>" +
                                "<td>" + item.keterangan + "</td>" +
                                "<td>" + item.catatan + "</td>" +
                                "</tr>");
                        i++;
                    });
                }else{
                    $('#info').text('Not Found');
                }
            }
        }).done(function(){
            $('.panel-primary').hideLoading();
        });
    
        return false;
    });

    $('body').on('submit', '#bulanan', function(event){     
        event.preventDefault();
        jenis_laporan = 'bulanan';
        
        tangggal_terima = "";
        estimasi = "";
        tanggal_selesai = "";
        keterangan_detail = "";
        $('#info').text('');

        $("#table-request").find("tr:gt(0)").remove(); //REMOVE TR DI TBODY

        var \$form  = $(this);
        $('.panel-primary').showLoading();
        $.ajax({
            url:  \$form.attr('action'),
            type: 'POST',
            data: \$(this).serialize(),
            dataType: 'json',
            success: function (response) {

               
                if(response != 0){
                    $.each(response.rows, function (i, item) {
                        tanggal_terima = item.tanggal_terima != null ? item.tanggal_terima : "";
                        estimasi = item.perkiraan_selesai != null ? item.perkiraan_selesai : "";
                        keterangan_detail = item.keterangan_detail != null ? item.keterangan_detail : "-";  
                        tanggal_selesai = item.tanggal_selesai != null ? item.tanggal_selesai : "<label class='label label-danger'> Still Progress... </label>";
                        $('#table-request').find('tbody').append("<tr>" +
                                "<td>" + ++i + "</td>" +
                                "<td>" + item.header + "</td>" +
                                "<td>" + item.first_name + ' ' + item.last_name + "</td>" +
                                "<td>" + item.prefix + "</td>" +
                                "<td>" + item.tanggal_persetujuan + "</td>" +
                                "<td>" + tanggal_terima + "</td>" +
                                "<td>" + estimasi + "</td>" +
                                "<td>" + tanggal_selesai + "</td>" +
                                "<td>" + item.pelaksana + "</td>" +
                                "<td>" + item.keluhan + "<br><b>Note: </b><br>" + keterangan_detail + "</td>" +
                                "<td>" + item.keterangan + "</td>" +
                                "<td>" + item.catatan + "</td>" +
                                "</tr>");
                        i++;
                    });
                }else{
                    $('#info').text('Not Found');
                }
            }
        }).done(function(){
            $('.panel-primary').hideLoading();
        });
    
        return false;
    });
    
    $('body').on('click', '#btn-print-laporan', function(event){
        var result = $("#hasil-pencarian").clone().end().html();

        if(jenis_laporan === 'bulanan'){
            window.open("$monthlyPrint&bulan="+ $("#bulan").val() + "&modus=fly" , "_blank", "top=25, left=250, toolbar=no, width=1000, height=600");
        }else if(jenis_laporan === 'mingguan'){
            window.open("$weeklyPrint&start="+ $("#start").val() + "&end=" + $("#end").val()  + "&modus=fly" , "_blank", "top=25, left=250, toolbar=no, width=1000, height=600");
        }else{
            window.open("$dailyPrint&tanggal="+ $("#tanggal").val() + "&modus=fly" , "_blank", "top=25, left=250, toolbar=no, width=1000, height=600");
        }

        

    });

    $('body').on('click', '#btn-email', function(event){
        if(jenis_laporan == "bulanan"){
            url_l = "$monthlyEmail";        
            dataForAjax = {
                bulan : $("#bulan").val()
            };
        }else if(jenis_laporan == "mingguan"){
            url_l = "$weeklyEmail";        
            dataForAjax = {
                start : $("#start").val(),
                end : $("#end").val(),
            };
        }else{
            url_l = "$dailyEmail";        
            dataForAjax = {
                tanggal : $("#tanggal").val(),
            };
        }

        

        if(confirm('Apakah Anda yakin akan mengirim email tersebut')){
            $('.panel-primary').showLoading();
            $.ajax({
                url: url_l,
                type: 'POST',
                data: dataForAjax,
                dataType: 'json',
                success: function (response) {
                    $('.panel-primary').hideLoading();
                    $('#info').text(response.message);
                }
              }).always(function(){
                    $('.panel-primary').hideLoading();
              });  
        }
    });


JS;
$this->registerJs($scriptHitung, yii\web\View::POS_READY);
?>