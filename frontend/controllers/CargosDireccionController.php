<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CargosDireccion;
use frontend\models\CargosDireccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CargosDireccionController implements the CRUD actions for CargosDireccion model.
 */
class CargosDireccionController extends Controller
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
     * Lists all CargosDireccion models.
     * @return mixed
     */
    public function actionIndex()
    {      if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('view_cargosDireccion'))
        {
        $searchModel = new CargosDireccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Displays a single CargosDireccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('update_cargosDireccion'))
        {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamentes');
            // Multiple alerts can be set like below
            //Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        } 
        }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
        
        }
        

    /**
     * Creates a new CargosDireccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('create_cargosDireccion'))
        {
        $model = new CargosDireccion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Updates an existing CargosDireccion model.
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

    /**
     * Deletes an existing CargosDireccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('delete_cargosDireccion'))
        {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) {
            $id = $post['id'];
            if ($this->findModel($id)->updateAttributes(['status'=>0])) {
                return $this->redirect(['index']);
            } else {
                   return $this->redirect(['view', 'id' => $model->idorganismo]);
            }
          
        }
        throw new InvalidCallException("You are not allowed to do this operation. Contact the administrator.");
        }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Finds the CargosDireccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CargosDireccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CargosDireccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
