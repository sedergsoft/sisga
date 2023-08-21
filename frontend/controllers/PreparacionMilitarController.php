<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PreparacionMilitar;
use frontend\models\PreparacionMilitarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreparacionMilitarController implements the CRUD actions for PreparacionMilitar model.
 */
class PreparacionMilitarController extends Controller
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
     * Lists all PreparacionMilitar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreparacionMilitarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreparacionMilitar model.
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
     * Creates a new PreparacionMilitar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid,$mensaje = null,$style = null)
    {
        $model = new PreparacionMilitar();
        $model->scenario = 'CPreparacionmilitar';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=> $cuadroid]);
        if($cuadro->trayectoria_militarid == NULL)
        {
        Yii::$app->session->setFlash('mensaje');
        $mensaje = 'Antes de agregar la preparación militar debe crear una tratectoria militar. Luego podra agregar la preparacion militar';
        $style = 'alert-info';
        
           return $this->redirect(['trayectoria-militar/create',
               'cuadroid'=>$cuadroid,
               'mensaje'=>$mensaje,
               'style'=>$style,
            
               ]);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $model->trayectoria_militarid = $cuadro->trayectoria_militarid;
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
         }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
             'mensaje'=>$mensaje,
             'style'=>$style,
            
        ]);
    }

    /**
     * Updates an existing PreparacionMilitar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $cuadroid)
    {
        $model = $this->findModel($id);
        $model->scenario = 'CPreparacionmilitar';
        $cuadro  = \frontend\models\Cuadro::findOne(['trayectoria_militarid'=>$cuadroid]);
        if ($model->load(Yii::$app->request->post()))
        {
            $model->trayectoria_militarid = $cuadro->trayectoria_militarid;
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
         }

        return $this->render('update', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Deletes an existing PreparacionMilitar model.
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
     * Finds the PreparacionMilitar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PreparacionMilitar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PreparacionMilitar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
