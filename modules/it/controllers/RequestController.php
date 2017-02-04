<?php

namespace app\modules\it\controllers;

use Yii;
use app\models\Tabular;
use app\models\Request;
use \yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\LinkReqTipe;
use app\models\LinkReqItem;
use app\modules\it\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use \yii\base\DynamicModel;



/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count_request_belum_selesai' =>$searchModel->countRequestBelumSelesai(),
            
                
            ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
            'title' => "Request #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
                ]),
            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
            Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                ]);
        }
    }

    /**
     * Creates a new Request model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Request();
        $modelLinkReqTipe = new LinkReqTipe();
        $modelLinkReqItem = [new LinkReqItem];

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                'title' => "Create new Request",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                    'modelLinkReqTipe' => (empty($modelLinkReqTipe)) ? new LinkReqTipe() : $modelLinkReqTipe,
                    'modelLinkReqItem' => (empty($modelLinkReqItem)) ? [new LinkReqItem] : $modelLinkReqItem,
                    ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())  && $modelLinkReqTipe->load($request->post())) {
                
                $modelLinkReqItem = Tabular::createMultiple(LinkReqItem::classname());
                Tabular::loadMultiple($modelLinkReqItem, Yii::$app->request->post());


                               
                //$modelLinkReqTipe = new DynamicModel();
                //$modelLinkReqTipe->defineAttribute('id_tipe', $value=null);
                //$modelLinkReqTipe->addRule(['id_tipe'], 'required');
                //$modelLinkReqTipe->load(Yii::$app->request->post());

                //echo "<pre>";
                //print_r($modelLinkReqTipe['tipe_id']);
                //die();
                              
                
                $valid = $model->validate();
                $valid = $modelLinkReqTipe->validate(['tipe_id']) && $valid; #bug           
                $valid = Tabular::validateMultiple($modelLinkReqItem) && $valid;

                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            //foreach ($modelLinkReqTipe as $index => $modelLinkReqTipe) {
                            //    if ($flag === false) {
                            //        break;
                            //    }
                            //    $modelLinkReqTipe->id_request = $model->id;
                            //    if (!($flag = $modelLinkReqTipe->save(false))) {
                            //        break;
                            //    }
                            //}

                            foreach ($modelLinkReqItem as $indexTools => $modelLinkReqItem) {
                                if ($flag === false) {
                                    break;
                                }
                                $modelLinkReqItem->request_id = $model->id;
                                if (!($flag = $modelLinkReqItem->save(false))) {
                                    break;
                                }
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            \Yii::$app->session->setFlash('success', 'Input data sukses');
                        } else {
                            $transaction->rollBack();
                            \Yii::$app->session->setFlash('error', 'Input data gagal');
                        }
                    }
                    catch (\Exception $e) {
                        $transaction->rollBack();
                        \Yii::$app->session->setFlash('error', 'Input data gagal');
                    }

                    $detailTipe = $modelLinkReqTipe['tipe_id'];
                    $insDetailTipe = array();
                    if ($detailTipe) {
                        foreach ($detailTipe as $v):
                            $insDetailTipe[] = array(
                                'request_id' => $model->getPrimaryKey(),
                                'tipe_id' => $v[0]
                                );
                        endforeach;

                        Yii::$app->db->createCommand()->batchInsert('link_req_tipe', ['request_id', 'tipe_id'], $insDetailTipe)->execute();
                    }

                    return [
                        'forceReload' => '#crud-datatable-pjax',   
                        'title' => "Create new Request",
                        'content' => '<h1 class="text-success">Create Request success</h1> <br> Buat Lagi ? Klik "Create More" di pojok kanan bawah',
                        'footer' => Html::button('Close', ['class' => 'btn btn-danger pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }else{
                    return [
                        'title' => "Create New Request",
                        'test' => $modelLinkReqTipe['tipe_id'],
                        'model' => $model,
                        'modelLinkReqTipe' => $modelLinkReqTipe,
                        'modelLinkReqItem' => $modelLinkReqItem,
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'modelLinkReqTipe' => $modelLinkReqTipe,
                            'modelLinkReqItem' => (empty($modelLinkReqItem)) ? [new LinkReqItem] : $modelLinkReqItem,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-danger pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }
                
            } else {
                return [
                    'title' => "Create New Request",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'modelLinkReqTipe' => (empty($modelLinkReqTipe)) ? new LinkReqTipe() : $modelLinkReqTipe,
                        'modelLinkReqItem' => (empty($modelLinkReqItem)) ? [new LinkReqItem] : $modelLinkReqItem,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
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
     * Updates an existing Request model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $modelLinkReqTipe = new LinkReqTipe();

        $model = $this->findModel($id);
        $modelLinkReqItem = $model->linkReqItems;

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {

                return [
                'title' => "Update Request #" . $id,
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                    'modelLinkReqItem' => $modelLinkReqItem,
                    'modelLinkReqTipe' =>  $modelLinkReqTipe,
                    'selectedTipeRequest' => $modelLinkReqTipe->findAll(['request_id' => $id]),
                    ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                $oldTransactionIds = ArrayHelper::map($modelLinkReqItem, 'id', 'id');

                // load data from form submit
                $modelLinkReqItem = Tabular::createMultiple(LinkReqItem::classname(), $modelLinkReqItem);
                Tabular::loadMultiple($modelLinkReqItem, Yii::$app->request->post());

                $deletedLink = array_diff($oldTransactionIds, array_filter(ArrayHelper::map($modelLinkReqItem, 'id', 'id')));

                // $valid = $model->validate();
                $valid = Model::validateMultiple($modelLinkReqItem);

                if ($valid) {
                    $modelLinkReqTipe->load(Yii::$app->request->post());
                    $detailTipe = $modelLinkReqTipe['tipe_id'];
                    $insDetailTipe = array();
                    foreach ($detailTipe as $v):
                        $insDetailTipe[] = array(
                            'request_id' => $model->getPrimaryKey(),
                            'tipe_id' => $v[0]
                            );
                    endforeach;

                    /** UPDATE TIPE REQUEST* */
                    $modelLinkReqTipe->deleteAll(['request_id' => $id]);
                    Yii::$app->db->createCommand()->batchInsert('link_req_tipe', ['request_id', 'tipe_id'], $insDetailTipe)->execute();


                    /** UPDATE ITEM REQUEST* */
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {

                            if (!empty($deletedLink)) {
                                LinkReqItem::deleteAll(['id' => $deletedLink]);
                            }

                            foreach ($modelLinkReqItem as $indexTools => $modelLinkReqItem) {

                                if ($flag === false) {
                                    \Yii::$app->session->setFlash('error', 'Failed To input');
                                    break;
                                }
                                $modelLinkReqItem->request_id = $model->id;

                                if (!($flag = $modelLinkReqItem->save(false))) {

                                    \Yii::$app->session->setFlash('error', 'Failed_to_input');
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            \Yii::$app->session->setFlash('success', 'Data berhasil di update...');
                            
                        } else {
                            $transaction->rollBack();
                            \Yii::$app->session->setFlash('error', 'Input data gagal');
                            
                        }
                    }
                    catch (\Exception $e) {
                        $transaction->rollBack();
                        \Yii::$app->session->setFlash('error', 'Input data gagal');
                    }

                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'post' => Yii::$app->request->post(),    
                        'title'=> "Request #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
            } else {
                return [
                'title' => "Update Request #" . $id,
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                    'modelLinkReqItem' => $modelLinkReqItem,
                    'modelLinkReqTipe' =>  $modelLinkReqTipe,
                    'selectedTipeRequest' => $selectedTipe->findAll(['request_id' => $id]),
                    ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'tipeRequest' => $tipeRequest,
                    'linkReqItem' => $linkReqItem,
                    'selectedTipeRequest' => $selectedTipe->findAll(['request_id' => $id]),
                    ]);
            }
        }
    }

    /**
     * Delete an existing Request model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Request model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete() {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetItemDetail() {
        $id = Yii::$app->request->post("id");
        $details = Yii::$app->db->createCommand("SELECT * FROM item_request_detail a WHERe a.item_request_id = $id")->queryAll();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $details;
    }

    public function actionRequestBelumSelesai(){
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->searchRequestBelumSelesai(Yii::$app->request->queryParams);
        return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
           'count_request_belum_selesai' =>$searchModel->countRequestBelumSelesai(),
        ]);
    }

}
