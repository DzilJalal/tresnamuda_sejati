<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
?>
<div class="karyawan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nik',
            'first_name',
            'last_name',
            'date_birth',
            'place_birth',
            'sex',
            'address:ntext',
            'rt_rw',
            'kelurahan',
            'kecamatan',
            'religion',
            'status_perkawinan',
            'citizen',
            'phone',
            'date_in',
            'date_out',
            'is_active',
            'departement_id',
            'branch_id',
            'perusahaan_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
