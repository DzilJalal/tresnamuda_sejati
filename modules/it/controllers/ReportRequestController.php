<?php

namespace app\modules\it\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\JsonParser;
use app\models\AddressEmail;

class ReportRequestController extends \yii\web\Controller
{
    
    private function setHtmlHeader($img, $tipe){
        return "<div style=' border-bottom: 1px solid black;'>
                                <div style='float:left;height: 113px; width:10%; display:inline-block;min-height: 150px;min-width: 150px;margin-left: 10px;margin-right: auto;'>
                                    <img style='padding-top: 0.2cm;height: 100px; width: 100px;      '
                                        src='$img'>    
                                </div>
                                <div style='float:right;width:89%; display:inline-block;'>
                                    <h1 style='font-family: Arial; padding-bottom:-20px;'>Perusahaan Nasional<br>PT. Pelayaran Tresnamuda Sejati</h1>   
                                    <h2 style='font-family: Arial; padding-bottom:-20px;'>Laporan $tipe Request Permintaan / Perbaikan Hardware - Software - Network</h2>
                                </div>
                           </div>";
    }

    private $htmlFooter = '
                <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border : none;">
                    <tr>
                        <td width="33%" style= "border : none;"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
                        <td width="33%" align="center" style="border : none; font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                        <td width="33%" style="border : none; text-align: right; ">Created by : Dep. IT-TMS</td>
                    </tr>
                </table>
        ';

    public function actionIndex(){
        return $this->render('index');
    }

    protected function _getQueryHarian($tanggal){
        return "
            	SELECT a.id, a.header,  f.first_name, f.last_name, g.prefix,
				        DATE_FORMAT(a.tanggal_persetujuan, '%d-%m-%Y %H:%i') AS 'tanggal_persetujuan',
				        DATE_FORMAT(a.tanggal_terima, '%d-%m-%Y %H:%i') AS 'tanggal_terima',
				        DATE_FORMAT(a.perkiraan_selesai, '%d-%m-%Y %H:%i') AS 'perkiraan_selesai',
				        DATE_FORMAT(a.tanggal_selesai, '%d-%m-%Y %H:%i') AS 'tanggal_selesai',
				        a.pelaksana,
				        e.keluhan, 
                        e.keterangan_detail,
                        a.keterangan,
				        a.catatan,
				        e.request_id
                FROM ytresnamuda_it.request a

	            LEFT JOIN (SELECT b.request_id,
								GROUP_CONCAT(c.nama_detail SEPARATOR ', ') AS keluhan, 	GROUP_CONCAT(b.keterangan SEPARATOR ', ') AS keterangan_detail
						   FROM link_req_item b
						
						   LEFT JOIN item_request_detail c
						   ON b.item_detail_id = c.id
					
						   GROUP BY b.request_id) e
	            ON a.id = e.request_id

	            LEFT JOIN ytresnamuda_hrd.karyawan f
	            ON a.karyawan_id = f.id

	            LEFT JOIN ytresnamuda_hrd.departement g
	            ON f.departement_id = g.id

                WHERE DATE_FORMAT(DATE(a.tanggal_terima), '%d-%m-%Y') = '$tanggal'
            ";
    }

    protected function _countRequestHarian($tanggal){
        return "
            SELECT COUNT(*) FROM ytresnamuda_it.request a
                WHERE DATE_FORMAT(DATE(a.tanggal_persetujuan), '%d-%m-%Y') = '$tanggal'
            ";
    }

    public function actionSearchHarian(){
        #$date = Yii::$app->formatter->asDate(strtotime(Yii::$app->request->post("tanggal")), 'php:Y-m-d');
        $date = Yii::$app->request->post("tanggal");
        $rows = Yii::$app->db->createCommand($this->_getQueryHarian($date))->queryAll();
        $total = Yii::$app->db->createCommand($this->_countRequestHarian($date))->queryScalar();
       
       	if($total != 0){
       		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	        return [
	            "status" => $total,
	            "rows"   => $rows,
	        ];	
       	}else{
       		return 0;
       	}
    }

    /*
     * 
     * Export to PDF Harian
     * 
     * Parameter : 
     * $tanggal
     * $modus : fly, file
     * 
     * */
    public function actionExportToPdfHarian($tanggal, $modus){
        $nama_file = "";
           
        $html = $this->renderPartial('_report_harian', [
                'tanggal' => $tanggal,
                'rows'    => Yii::$app->db->createCommand($this->_getQueryHarian($tanggal, 'Harian'))->queryAll()
            ]);

        $img = Url::to('@web/img/logo.png');
        $mpdf = new \mPDF('c', 'A4-L', '', '', 0, 0, 34, 20, 2, 0);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        $mpdf->SetHTMLHeader($this->setHtmlHeader($img, 'Harian'));
        $mpdf->WriteHTML($html);
        
        if($modus == "fly" ){
            $mpdf->Output(); 
        }else{
            $tanggal_format = \Yii::$app->formatter->asDatetime($tanggal, "php:Y-m-d h:i");
            $moment = new \Moment\Moment($tanggal_format);
            \Moment\Moment::setLocale('id_ID');

            $nama_file = "reports/it/request/harian/Laporan Harian Request Permintaan & Perbaikan,  ". $moment->format('l, d-F-Y') .".pdf";
            $mpdf->Output( $nama_file, 'F');
        }
       
        return $nama_file;
         
        
    }

    public function actionEmailReportHarian(){
        $request = Yii::$app->request;
        $date = $request->post('tanggal');
        $file_pdf = $this->actionExportToPdfHarian($date, "file");
        $full_path = realpath(dirname(__FILE__).'/../../../'.'web/'.$file_pdf);
        
        $to = AddressEmail::find()->where(['degree' => 'to'])->all();
        $stringTo = [];
        foreach ($to as $key => $value) {
           array_push($stringTo, $value['email']);
        }

        $cc = AddressEmail::find()->where(['degree' => 'cc'])->all();
        $stringCc= [];
        foreach ($cc as $k => $v) {
           array_push($stringCc, $v['email'])  ;
        }

        try{
            $mail = Yii::$app->mailer->compose();
            $mail->attach($full_path);
            $mail->setFrom('itjkt@tresnamuda.co.id')
                ->setTo($stringTo)
                ->setCc($stringCc)
                ->setSubject("David - Laporan Harian Request Permintaan dan Perbaikan : $date")
                ->setHtmlBody("Kepada Yth. <br>
                               Bapak David V. Lengkong <br><br>
                               Berikut ini Kami laporkan mengenai Laporan Harian Request Permintaan atau Perbaikan <br>
                               dari user Ke Dept IT  : <strong> </strong> <br><br>
                               <b> Laporan Terlampir </b> <br><br>
                               Sekian yang dapat Kami sampaikan. <br>
                               Atas perhatian Bapak, Kami ucapkan terima kasih. <br><br>

                               Salam <br>

                               IT Departement <br>
                               PT.TRESNAMUDA SEJATI <br>
                               Komplek Ruko Sunter Permai Indah <br>
                               Blok B No.12 - 16 <br>
                               Jl. Mitra Sunter Boulevard <br>
                               Jakarta Utara 14350. <br>
                               Phone : 021-6522333 ext.400, 410, 401 <br>
                               Fax : 021-6522336/37 <br>

                               <i>Email ini merupakan email dari system inhouse Deparetement IT</i>");
            $sending = $mail->send();
            echo json_encode(array(
                    "status" => true,
                    "message" => "Email terkirim"
                ));
        }catch(\Swift_SwiftException $exception){
            echo json_encode(array(
                    "status" => false,
                    "message" => $exception
                ));
        }
    }

    protected function _getQueryMingguan($tanggal_awal, $tanggal_akhir){
        return "
            SELECT a.id, a.header,  f.first_name, f.last_name, g.prefix,
				        DATE_FORMAT(a.tanggal_persetujuan, '%d-%m-%Y %H:%i') AS 'tanggal_persetujuan',
				        DATE_FORMAT(a.tanggal_terima, '%d-%m-%Y %H:%i') AS 'tanggal_terima',
				        DATE_FORMAT(a.perkiraan_selesai, '%d-%m-%Y %H:%i') AS 'perkiraan_selesai',
				        DATE_FORMAT(a.tanggal_selesai, '%d-%m-%Y %H:%i') AS 'tanggal_selesai',
				        a.pelaksana, e.keluhan, a.catatan,e.request_id, a.keterangan,e.keterangan_detail
                FROM ytresnamuda_it.request a
	            LEFT JOIN (SELECT b.request_id,
						    GROUP_CONCAT(c.nama_detail SEPARATOR ', ') AS keluhan, 	GROUP_CONCAT(b.keterangan SEPARATOR ', ') AS keterangan_detail
						   FROM link_req_item b			
						   LEFT JOIN item_request_detail c
						   ON b.item_detail_id = c.id
						   GROUP BY b.request_id) e
	            ON a.id = e.request_id

	            LEFT JOIN ytresnamuda_hrd.karyawan f
	            ON a.karyawan_id = f.id

	            LEFT JOIN ytresnamuda_hrd.departement g
	            ON f.departement_id = g.id			

                WHERE a.tanggal_terima
 	                BETWEEN '$tanggal_awal' AND ' $tanggal_akhir' + INTERVAL 1 DAY 
                ORDER BY a.nomor_surat ASC
        ";
    }

    protected function _countRequestMingguan($tanggal_awal, $tanggal_akhir ){
        return "
            SELECT COUNT(*) FROM ytresnamuda_it.request a
                WHERE a.tanggal_terima
 	                BETWEEN '$tanggal_awal' AND ' $tanggal_akhir' + INTERVAL 1 DAY 
                ORDER BY a.nomor_surat ASC
            ";
    }

    public function actionSearchMingguan(){
        $start = Yii::$app->formatter->asDate(strtotime(Yii::$app->request->post("start")), 'php:Y-m-d');
        $end   = Yii::$app->formatter->asDate(strtotime(Yii::$app->request->post("end")), 'php:Y-m-d');
        
        $rows = Yii::$app->db->createCommand($this->_getQueryMingguan($start, $end))->queryAll();
        $total = Yii::$app->db->createCommand($this->_countRequestMingguan($start, $end))->queryScalar();
        
        if($total != 0){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	        return [
                "start" => $start,
                "end" => $end,
	            "status" => $total,
	            "rows"   => $rows,
	        ];	
        }else{
            return 0;
        }
    }

    /*
     * 
     * Export to PDF Mingguan
     * 
     * Parameter : 
     * $tanggal
     * $modus : fly, file
     * 
     * */
    public function actionExportToPdfMingguan($start, $end, $modus){
        $nama_file = "";
        
        $mulai = Yii::$app->formatter->asDate(strtotime($start), 'php:Y-m-d');
        $akhir   = Yii::$app->formatter->asDate(strtotime($end), 'php:Y-m-d');
        $html = $this->renderPartial('_report_mingguan', [
                'start'   => $start,
                'end'     => $end,
                'test'     => $mulai,
                'rows'    => Yii::$app->db->createCommand($this->_getQueryMingguan($mulai, $akhir))->queryAll()
            ]);

        $img = Url::to('@web/img/logo.png');
        $mpdf = new \mPDF('c', 'A4-L', '', '', 0, 0, 34, 20, 2, 0);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        $mpdf->SetHTMLHeader($this->setHtmlHeader($img, "Mingguan"));
        $mpdf->SetHTMLFooter($this->htmlFooter);
        $mpdf->WriteHTML($html);
        
        if($modus == "fly" ){
            $mpdf->Output(); 
        }else{
            $nama_file = "reports/it/request/mingguan/Laporan Mingguan Request Permintaan & Perbaikan,  ". $mulai ."-" . $akhir .".pdf";
            $mpdf->Output( $nama_file, 'F');
        }
        
        return $nama_file;
    }

    public function actionEmailReportMingguan(){
        $request = Yii::$app->request;
        $start   = Yii::$app->formatter->asDate(strtotime($request->post('start')), 'php:Y-m-d');
        $end     = Yii::$app->formatter->asDate(strtotime($request->post('end')), 'php:Y-m-d');
        $file_pdf = $this->actionExportToPdfMingguan($start,$end, "file");
        $full_path = realpath(dirname(__FILE__).'/../../../'.'web/'.$file_pdf);
        
        $to = AddressEmail::find()->where(['degree' => 'to'])->all();
        $stringTo = [];
        foreach ($to as $key => $value) {
            array_push($stringTo, $value['email']);
        }

        $cc = AddressEmail::find()->where(['degree' => 'cc'])->all();
        $stringCc= [];
        foreach ($cc as $k => $v) {
            array_push($stringCc, $v['email'])  ;
        }

        $mulai = $request->post('start');
        $akhir = $request->post('end');
        try{
            $mail = Yii::$app->mailer->compose();
            $mail->attach($full_path);
            $mail->setFrom('itjkt@tresnamuda.co.id')
                ->setTo($stringTo)
                ->setCc($stringCc)
                ->setSubject("David - Laporan Mingguan Request Permintaan dan Perbaikan : $mulai s/d $akhir")
                ->setHtmlBody("Kepada Yth. <br>
                               Bapak David V. Lengkong <br><br>
                               Berikut ini Kami laporkan mengenai Laporan Mingguan Request Permintaan atau Perbaikan <br>
                               dari user Ke Dept IT  : <strong>$mulai s/d $akhir </strong> <br><br>
                               <b> Laporan Terlampir </b> <br><br>
                               Sekian yang dapat Kami sampaikan. <br>
                               Atas perhatian Bapak, Kami ucapkan terima kasih. <br><br>

                               Salam <br>

                               IT Departement <br>
                               PT.TRESNAMUDA SEJATI <br>
                               Komplek Ruko Sunter Permai Indah <br>
                               Blok B No.12 - 16 <br>
                               Jl. Mitra Sunter Boulevard <br>
                               Jakarta Utara 14350. <br>
                               Phone : 021-6522333 ext.400, 410, 401 <br>
                               Fax : 021-6522336/37 <br>

                               <i>Email ini merupakan email dari system inhouse Deparetement IT</i>");
            $sending = $mail->send();
            echo json_encode(array(
                    "status" => true,
                    "message" => "Email terkirim"
                ));
        }
        catch(\Swift_SwiftException $exception){
            echo json_encode(array(
                    "status" => false,
                    "message" => $exception
                ));
        }
    }


    protected function _getQueryBulanan($bulan, $tahun){
        return "
             SELECT a.id, a.header,  f.first_name, f.last_name, g.prefix,
				        DATE_FORMAT(a.tanggal_persetujuan, '%d-%m-%Y %H:%i') AS 'tanggal_persetujuan',
				        DATE_FORMAT(a.tanggal_terima, '%d-%m-%Y %H:%i') AS 'tanggal_terima',
				        DATE_FORMAT(a.perkiraan_selesai, '%d-%m-%Y %H:%i') AS 'perkiraan_selesai',
				        DATE_FORMAT(a.tanggal_selesai, '%d-%m-%Y %H:%i') AS 'tanggal_selesai',
				        a.pelaksana, e.keluhan, a.catatan,e.request_id, a.keterangan, e.keterangan_detail
                FROM ytresnamuda_it.request a
	            LEFT JOIN (SELECT b.request_id,
						    GROUP_CONCAT(c.nama_detail SEPARATOR ', ') AS keluhan, 	GROUP_CONCAT(b.keterangan SEPARATOR ', ') AS keterangan_detail
						   FROM link_req_item b			
						   LEFT JOIN item_request_detail c
						   ON b.item_detail_id = c.id
						   GROUP BY b.request_id) e
	            ON a.id = e.request_id

	            LEFT JOIN ytresnamuda_hrd.karyawan f
	            ON a.karyawan_id = f.id

	            LEFT JOIN ytresnamuda_hrd.departement g
	            ON f.departement_id = g.id			

                WHERE MONTH(a.tanggal_terima) = $bulan AND YEAR(a.tanggal_terima) = $tahun
                ORDER BY a.nomor_surat ASC

        ";
    }

    protected function _countRequestBulanan($bulan, $tahun){
        return "
            SELECT COUNT(*) FROM ytresnamuda_it.request a
                WHERE MONTH(a.tanggal_terima) = '$bulan'  AND YEAR(a.tanggal_terima) = '$tahun'
            ";
    }

    public function actionSearchBulanan(){
        $pecah = explode("-", Yii::$app->request->post("bulan"));
        $tahun = $pecah[1];
        $bulan = $pecah[0];

        $rows = Yii::$app->db->createCommand($this->_getQueryBulanan($bulan, $tahun))->queryAll();
        $total = Yii::$app->db->createCommand($this->_countRequestBulanan($bulan, $tahun))->queryScalar();
        
        if($total != 0){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                "status" => $total,
                "rows"   => $rows,
            ];	
        }else{
            return 0;
        }
    }

    /*
     * 
     * Export to PDF Mingguan
     * 
     * Parameter : 
     * $tanggal
     * $modus : fly, file
     * 
     * */
    public function actionExportToPdfBulanan($bulan, $modus){
        $nama_file = "";
        
        $pecah = explode("-", $bulan);
        $month = $pecah[0];
        $year = $pecah[1];
        

        $html = $this->renderPartial('_report_bulanan', [
                'bulan'   => $bulan,
                'rows'    =>  Yii::$app->db->createCommand($this->_getQueryBulanan($month, $year))->queryAll()
            ]);

        $img = Url::to('@web/img/logo.png');
        //new mPDF($mode, $format, $font_size, $font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);
        $mpdf = new \mPDF('c', 'A4-L', '', '', 0, 0, 34, 20, 2, 0);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        $mpdf->SetHTMLHeader($this->setHtmlHeader($img, "Bulanan"));
        $mpdf->SetHTMLFooter($this->htmlFooter);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        
        if($modus == "fly" ){
            $mpdf->Output(); 
        }else{
            $nama_file = "reports/it/request/bulanan/Laporan Bulanan Request Permintaan & Perbaikan,  ". $bulan .".pdf";
            $mpdf->Output( $nama_file, 'F');
        }
        
        return $nama_file;
    }

    public function actionEmailReportBulanan(){
        $request = Yii::$app->request;
        $bulan = $request->post('bulan');
        
        $file_pdf = $this->actionExportToPdfBulanan($bulan, "file");
        $full_path = realpath(dirname(__FILE__).'/../../../'.'web/'.$file_pdf);
        
        $to = AddressEmail::find()->where(['degree' => 'to'])->all();
        $stringTo = [];
        foreach ($to as $key => $value) {
            array_push($stringTo, $value['email']);
        }

        $cc = AddressEmail::find()->where(['degree' => 'cc'])->all();
        $stringCc= [];
        foreach ($cc as $k => $v) {
            array_push($stringCc, $v['email'])  ;
        }

        try{
            $mail = Yii::$app->mailer->compose();
            $mail->attach($full_path);
            $mail->setFrom('itjkt@tresnamuda.co.id')
                ->setTo($stringTo)
                ->setCc($stringCc)
                ->setSubject("David - Laporan Bulanan Request Permintaan dan Perbaikan : $bulan")
                ->setHtmlBody("Kepada Yth. <br>
                               Bapak David V. Lengkong <br><br>
                               Berikut ini Kami laporkan mengenai Laporan Bulanan Request Permintaan atau Perbaikan <br>
                               dari user Ke Dept IT  : <strong> </strong> <br><br>
                               <b> Laporan Terlampir </b> <br><br>
                               Sekian yang dapat Kami sampaikan. <br>
                               Atas perhatian Bapak, Kami ucapkan terima kasih. <br><br>

                               Salam <br>

                               IT Departement <br>
                               PT.TRESNAMUDA SEJATI <br>
                               Komplek Ruko Sunter Permai Indah <br>
                               Blok B No.12 - 16 <br>
                               Jl. Mitra Sunter Boulevard <br>
                               Jakarta Utara 14350. <br>
                               Phone : 021-6522333 ext.400, 410, 401 <br>
                               Fax : 021-6522336/37 <br>

                               <i>Email ini merupakan email dari system inhouse Deparetement IT</i>");
            $sending = $mail->send();
            echo json_encode(array(
                    "status" => true,
                    "message" => "Email terkirim"
                ));
        }
        catch(\Swift_SwiftException $exception){
            echo json_encode(array(
                    "status" => false,
                    "message" => $exception
                ));
        }
    }
}
