<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EstanciaExterior;
use frontend\models\EstanciaExteriorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstanciaExteriorController implements the CRUD actions for EstanciaExterior model.
 */
class EstanciaExteriorController extends Controller
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
     * Lists all EstanciaExterior models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstanciaExteriorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstanciaExterior model.
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
     * Creates a new EstanciaExterior model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new EstanciaExterior();
        $model->scenario = 'CExtancia';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=> $cuadroid]);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->cuadroid = $cuadroid;
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
       }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing EstanciaExterior model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
       return $this->redirect(['cuadro/view', 'id' => $model->cuadro->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuadro' =>$model->cuadro,
        ]);
    }

    /**
     * Deletes an existing EstanciaExterior model.
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
     * Finds the EstanciaExterior model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstanciaExterior the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstanciaExterior::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
