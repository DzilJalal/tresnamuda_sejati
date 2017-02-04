<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
?>
<div class="request-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'karyawan_id',
            'nomor_surat',
            'keterangan:ntext',
            'catatan:ntext',
            'tanggal_permintaan',
            'diketahui_oleh',
            'tanggal_persetujuan',
            'diterima_oleh',
            'tanggal_terima',
            'perkiraan_selesai',
            'tanggal_selesai',
            'pelaksana',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ])
    ?>

</div>
