<?php

namespace app\modules\it\controllers;

use Yii;
use app\models\AnalisaRequest;
use app\modules\it\models\AnalisaRequestSearch;
use app\models\LinkReqItem;
use app\models\LinkReqItemDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * AnalisaRequestController implements the CRUD actions for AnalisaRequest model.
 */
class AnalisaRequestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AnalisaRequest models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new AnalisaRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single AnalisaRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "AnalisaRequest #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new AnalisaRequest model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new AnalisaRequest();  

        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new AnalisaRequest",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new AnalisaRequest",
                    'content'=>'<span class="text-success">Create AnalisaRequest success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new AnalisaRequest",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        
    }

    /**
     * Updates an existing AnalisaRequest model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        $month =  Yii::$app->formatter->asDate(strtotime($model->waktu), "php:m");
        $year =  Yii::$app->formatter->asDate(strtotime($model->waktu), "php:Y");
        $item_id = $model->item_id;

        $pendukung = $this->_getFindItemAnalyze($month, $year, $item_id);

        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update AnalisaRequest #".$id,
                    'pendukung' => $pendukung,    
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'pendukung' => $pendukung,    
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "AnalisaRequest #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                return [
                   'title'=> "Update AnalisaRequest #".$id,
                   'content'=>$this->renderAjax('update', [
                       'model' => $model,
                   ]),
                   'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                               Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
               ];        
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing AnalisaRequest model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing AnalisaRequest model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
    }

    /**
     * Finds the AnalisaRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnalisaRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = AnalisaRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * @tipe : POST
     * @param : string $month, string $year, integer $item_id
     * @return : JSON
     *  
     * */

    public function actionFindItemAnalyze(){
        $pecah            = explode("-", Yii::$app->request->post("waktu"));
        $year             = $pecah[1];
        $month            = $pecah[0];
        $item_id          = Yii::$app->request->post("item");
        $analisa          = AnalisaRequest::find()->joinWith('item')->where(['MONTH([[waktu]])' => $month])->asArray()->all();
        $data             = Yii::$app->db->createCommand("SELECT b.request_id, d.header, e.first_name, e.last_name, GROUP_CONCAT(c.nama_detail SEPARATOR ', ') AS keluhan, GROUP_CONCAT(b.keterangan SEPARATOR ', ') AS keterangan_detail, d.catatan FROM link_req_item b LEFT JOIN item_request_detail c ON b.item_detail_id = c.id LEFT JOIN ytresnamuda_it.request d ON b.request_id = d.id LEFT JOIN ytresnamuda_hrd.karyawan e ON d.karyawan_id = e.id WHERE MONTH(d.tanggal_terima) = '$month' AND  YEAR(d.tanggal_terima) = '$year' AND b.item_id = $item_id GROUP BY b.request_id")->queryAll();
        $arr_permasalahan = Yii::$app->db->createCommand("SELECT CONCAT(c.nama_detail, '    :    ', count(*) , ' pcs') AS permasalahan FROM link_req_item a INNER JOIN item_request b ON a.item_id = b.id INNER JOIN item_request_detail c ON a.item_detail_id = c.id INNER JOIN request d ON a.request_id = d.id WHERE MONTH(d.tanggal_terima) = '$month' AND YEAR(d.tanggal_terima)='$year' AND b.id =$item_id GROUP BY c.nama_detail ORDER BY d.header")->queryAll();
        $permasalahan     = implode("; \n", array_column($arr_permasalahan, 'permasalahan'));       
        
        $count = count($data);
        $count_detail = count($arr_permasalahan);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
                "analisa" => $analisa,
                'permasalahan' => $permasalahan,
                "data"  => $data, 
                'jumlah' => $count != 0 ? $count : 0,
                'jumlah_detail' => $count_detail != 0 ? $count_detail : 0,
                "bulan" => $month,
                "tahun" => $year,
                "item"  => $item_id
            ];    
        
    }

    /*
     * @tipe   : GET
     * @param  : string $month, string $year, integer $item_id
     * @return : JSON
     *  
     * */

    public function _getFindItemAnalyze($month, $year, $item_id){
        $analisa          = AnalisaRequest::find()->joinWith('item')->where(['MONTH([[waktu]])' => $month])->asArray()->all();
        $data             = Yii::$app->db->createCommand("SELECT b.request_id, d.header, e.first_name, e.last_name, GROUP_CONCAT(c.nama_detail SEPARATOR ', ') AS keluhan, GROUP_CONCAT(b.keterangan SEPARATOR ', ') AS keterangan_detail, d.catatan FROM link_req_item b LEFT JOIN item_request_detail c ON b.item_detail_id = c.id LEFT JOIN ytresnamuda_it.request d ON b.request_id = d.id LEFT JOIN ytresnamuda_hrd.karyawan e ON d.karyawan_id = e.id WHERE MONTH(d.tanggal_terima) = '$month' AND  YEAR(d.tanggal_terima) = '$year' AND b.item_id = $item_id GROUP BY b.request_id")->queryAll();
        $arr_permasalahan = Yii::$app->db->createCommand("SELECT CONCAT(c.nama_detail, ',', count(*) , ' pcs, ') AS permasalahan FROM link_req_item a INNER JOIN item_request b ON a.item_id = b.id INNER JOIN item_request_detail c ON a.item_detail_id = c.id INNER JOIN request d ON a.request_id = d.id WHERE MONTH(d.tanggal_terima) = '$month' AND YEAR(d.tanggal_terima)='$year' AND b.id =$item_id GROUP BY c.nama_detail ORDER BY d.header")->queryAll();
        $permasalahan     = implode("\n", array_column($arr_permasalahan, 'permasalahan'));       
        
        $count = count($data);
        $count_detail = count($arr_permasalahan);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
                "analisa" => $analisa,
                'permasalahan' => $permasalahan,
                "data"  => $data, 
                'jumlah' => $count != 0 ? $count : 0,
                'jumlah_detail' => $count_detail != 0 ? $count_detail : 0,
                "bulan" => $month,
                "tahun" => $year,
                "item"  => $item_id
            ];    
        
    }


}
