<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Condecoraciones;
use frontend\models\CondecoracionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CondecoracionesController implements the CRUD actions for Condecoraciones model.
 */
class CondecoracionesController extends Controller
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
     * Lists all Condecoraciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CondecoracionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Condecoraciones model.
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
     * Creates a new Condecoraciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new Condecoraciones();
        $model ->scenario = 'CCondecoraciones';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);

        if ($model->load(Yii::$app->request->post()))
            {
            $model->cuadroid = $cuadro->id;
            $model->save() ;
           return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
       }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing Condecoraciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'CCondecoraciones';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuadro/view', 'id' => $model->cuadro->id]);
       }

        return $this->render('update', [
            'model' => $model,
            
        ]);
    }

    /**
     * Deletes an existing Condecoraciones model.
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
     * Finds the Condecoraciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Condecoraciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Condecoraciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
