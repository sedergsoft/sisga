<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cargo;
use frontend\models\CargoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CargoController implements the CRUD actions for Cargo model.
 */
class CargoController extends Controller
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
     * Lists all Cargo models.
     * @return mixed
     */
    public function actionIndex()
    {
          if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('create_cargo'))
        {
        $searchModel = new CargoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Displays a single Cargo model.
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
       if(\yii::$app->user->can('view_cargo'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Creates a new Cargo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
            if(Yii::$app->user->isGuest)
       {
           return $this->redirect(['site/login']);  
       }
       if(\yii::$app->user->can('create_cargo'))
        {
        $model = new Cargo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('createcuadro', [
            'model' => $model,
        ]);
         }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Updates an existing Cargo model.
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
       if(\yii::$app->user->can('update_cargo'))
        {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
         }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Deletes an existing Cargo model.
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
       if(\yii::$app->user->can('delete_cargo'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
         }else{
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Finds the Cargo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cargo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cargo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
