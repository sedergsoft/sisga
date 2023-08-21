<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TrayectoriaLaboral;
use frontend\models\TrayectoriaLaboralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrayectoriaLaboralController implements the CRUD actions for TrayectoriaLaboral model.
 */
class TrayectoriaLaboralController extends Controller
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
     * Lists all TrayectoriaLaboral models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrayectoriaLaboralSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrayectoriaLaboral model.
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
     * Creates a new TrayectoriaLaboral model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new TrayectoriaLaboral();
          $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);


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
     * Updates an existing TrayectoriaLaboral model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$cuadroid)
    {
        $model = $this->findModel($id);
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);


        if ($model->load(Yii::$app->request->post()))
        {
            $model->cuadroid = $cuadroid;
            $model->save(); 
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Deletes an existing TrayectoriaLaboral model.
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
     * Finds the TrayectoriaLaboral model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrayectoriaLaboral the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrayectoriaLaboral::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
