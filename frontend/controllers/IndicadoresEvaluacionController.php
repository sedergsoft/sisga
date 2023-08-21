<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IndicadoresEvaluacion;
use frontend\models\IndicadoresEvaluacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndicadoresEvaluacionController implements the CRUD actions for IndicadoresEvaluacion model.
 */
class IndicadoresEvaluacionController extends Controller
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
     * Lists all IndicadoresEvaluacion models.
     * @return mixed
     */
    public function actionIndex()
    {
     if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $searchModel = new IndicadoresEvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['active'=>1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IndicadoresEvaluacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }   
      $model= IndicadoresEvaluacion::findOne(['id'=>$id,'active'=>'1']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    }

    /**
     * Creates a new IndicadoresEvaluacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $model = new IndicadoresEvaluacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IndicadoresEvaluacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IndicadoresEvaluacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) {
            $id = $post['id'];
            if ($this->findModel($id)->updateAttributes(['active'=>0])) {
                return $this->redirect(['index']);
            } else {
                   return $this->redirect(['view', 'id' => $model->id]);
            }
          
        }
        throw new InvalidCallException("Usted no tiene permitido realiazar esta operación.Contacte con el administrador del sistema.");
    }
    /**
     * Finds the IndicadoresEvaluacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndicadoresEvaluacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndicadoresEvaluacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
