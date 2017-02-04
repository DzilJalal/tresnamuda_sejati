<?php 

//$tanggal_format = \DateTime::createFromFormat('d-m-Y', $tanggal);
Yii::$app->formatter->locale = 'ID';
$mulai = \Yii::$app->formatter->asDate($start, "full");
$end = \Yii::$app->formatter->asDate($end, "full");


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Mingguan Request Permintaan dan Perbaikan <?= $mulai ." ". $end?></title>
        <style type="text/css">
            .page {
                padding-top: 0cm;
                padding-right: 0.5cm;
                padding-left: 0.5cm;
            }

            table {
                border-spacing: 0;
                border-collapse: collapse;
                width: 100%;
                page-break-inside: auto;
            }

            .table td, .table th {
                border: 0.5px solid black;
            }

            th{
                background-color:#FFFF00;
                color:#0000FF;
            }

            
            td {
                vertical-align : top;
            }

            td.center {
                text-align: center;
            }

            td.left {
                text-align: left;
            }

            td.right {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="page">
            <h3>Periode : <span><?=  $mulai ." s/d ". $end?> </span> </h3>
              
            <table border="0" class="table">
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
                        <th>Uraian</th>
                        <th>Tindakan yang Diambil</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach($rows as $item) : ?>
                        <tr>
                            <td><?= $index ?> </td>
                            <td><?= $item['header'] ?> </td>
                            <td><?= $item['first_name'] . ' ' . $item['last_name'] ?> </td>
                            <td><?= $item['prefix'] ?> </td>
                            <td><?= $item['tanggal_persetujuan'] ?> </td>
                            <td><?= $item['tanggal_terima'] ?> </td>
                            <td><?= $item['perkiraan_selesai'] ?> </td>
                            <td><?= $item['tanggal_selesai'] ?> </td>
                            <td><?= $item['pelaksana'] ?> </td>
                            <td><strong>Keluhan :</strong> <br>
                                <?= $item['keluhan'] ?> <br><br>

                                <strong>Note :</strong> <br>
                                <?= $item['keterangan_detail'] ?> <br><br>

                                <strong>Keterangan :</strong> <br>
                                <?= $item['keterangan'] ?> 
                            </td>
                            <td><?= $item['catatan'] ?> </td>

                        </tr>

                    <?php $index++; ?>
                    <?php endforeach; ?>
                    
                </tbody>

                <tfoot>
                </tfoot>
            </table>

        </div>
    </body>
</html>
