<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PlanEvaluacion;
use frontend\models\PlanEvaluacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanEvaluacionController implements the CRUD actions for PlanEvaluacion model.
 */
class PlanEvaluacionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PlanEvaluacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanEvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->query->andWhere(['cuadro.status'=>1 ])->orderBy(['idevaluador'=> 'ASC','fecha'=>'DESC']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
 public function actionIndexuser()
    {
        $searchModel = new PlanEvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['plan_evaluacion.status'=>0,'cuadro.status'=>1])->andWhere(['idevaluador'=> \Yii::$app->user->getId()])->all();

        return $this->render('indexuser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single PlanEvaluacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model= PlanEvaluacion::findOne(['id'=>$id]);
        $evaluado = $this->evaluado($id);
        if(!$evaluado)
        {
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
         {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id,'evaluado'=> $evaluado]);
        } else {
            return $this->render('view', ['model'=>$model,'evaluado'=> $evaluado]);
        }}else{
            Yii::$app->session->setFlash('kv-detail-warning', '<b>Nota:</b> Este usuario ya fue evaluado, por tanto esta planifición no puede ser modificada.');
            
            return $this->render('view', ['model'=>$model,'evaluado'=> $evaluado]);
        }
    }

    /**
     * Creates a new PlanEvaluacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanEvaluacion();

        if ($model->load(Yii::$app->request->post()))
        {     
           if( $model->save())
           {
               $this->actualizarstatusagregar($model->idcuadro);    
            return $this->redirect(['view', 'id' => $model->id]);
           }        
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PlanEvaluacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
  
    public function actualizarstatusagregar($idcuadro) 
    {
     if($model = PlanEvaluacion::find()->where(['idcuadro'=>$idcuadro, 'status'=>1,'ultima'=>1])->one())
     {
     $this->findModel($model->id)->updateAttributes(['ultima'=>0]); 
     }
     
     }

    /**
     * Deletes an existing PlanEvaluacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlanEvaluacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlanEvaluacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanEvaluacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function evaluado($id) 
    {
     if($this->findModel($id)->status == 1)
     {
         return TRUE;
         
    }else{
        return FALSE;
    }
    }
}
