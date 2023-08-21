<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Armas;
use frontend\models\ArmasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArmasController implements the CRUD actions for Armas model.
 */
class ArmasController extends Controller
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
     * Lists all Armas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArmasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Armas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Armas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
         if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       } 
        if(\yii::$app->user->can('create_arma'))
        {
        $model = new Armas();
        $model->scenario = 'CArma';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        

        if ($model->load(Yii::$app->request->post()))
            {
            $model->cuadroid = $cuadro->id;
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $model->cuadroid]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuadro' => $cuadro,
        ]);
        }
        else{
            
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Updates an existing Armas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
          if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
        if(\yii::$app->user->can('update_arma'))
        {
        $model = $this->findModel($id);
        $model->scenario='CArma';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuadro/view', 'id' => $model->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        
         }
        else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Deletes an existing Armas model.
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
       if(\yii::$app->user->can('delete_arma'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
         else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Finds the Armas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Armas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Armas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
