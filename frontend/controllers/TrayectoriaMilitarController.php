<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TrayectoriaMilitar;
use frontend\models\TrayectoriaMilitarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrayectoriaMilitarController implements the CRUD actions for TrayectoriaMilitar model.
 */
class TrayectoriaMilitarController extends Controller
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
     * Lists all TrayectoriaMilitar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrayectoriaMilitarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrayectoriaMilitar model.
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
     * Creates a new TrayectoriaMilitar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid,$mensaje = null,$style=null)
    {
        $model = new TrayectoriaMilitar();
        $model->scenario = 'CTrayectoriamilitar';
        $modelsTrayecctoriaMiliMili = new \frontend\models\TrayectoriaMilitarMilitancia(); 
        $modelsTrayecctoriaMiliMili->scenario ='CTrayectoriaMilitarMili';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        
        if ($model->load(Yii::$app->request->post())&& $modelsTrayecctoriaMiliMili->load(Yii::$app->request->post()))
        {
                
            
            if($model->save())
                {
                $modelsTrayecctoriaMiliMili->trayectoria_militarid = $model->id;   
                if($modelsTrayecctoriaMiliMili->save())
                {
                $cuadro->updateAttributes(['trayectoria_militarid'=>$model->id]);
                Yii::$app->session->setFlash('mensaje');
                $mensaje = 'La trayectoria Militar fue creada de forma satisfactoria, ahora puede agreagar la preparación militar.';
                $style = 'alert-success';
            
               return $this->redirect(['preparacion-militar/create',
                   'cuadroid' => $cuadro->id,
                    'mensaje'=>$mensaje,
                    'style'=>$style,
                   ]);
                
                }
                }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsTrayecctoriaMiliMili'=>$modelsTrayecctoriaMiliMili,
            'cuadro'=>$cuadro,
            'mensaje'=>$mensaje,
            'style'=>$style,
            
            ]);
    }

    /**
     * Updates an existing TrayectoriaMilitar model.
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
     * Deletes an existing TrayectoriaMilitar model.
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
     * Finds the TrayectoriaMilitar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrayectoriaMilitar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrayectoriaMilitar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
