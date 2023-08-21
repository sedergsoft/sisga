<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FamiliaresExterior;
use frontend\models\FamiliaresExteriorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FamiliaresExteriorController implements the CRUD actions for FamiliaresExterior model.
 */
class FamiliaresExteriorController extends Controller
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
     * Lists all FamiliaresExterior models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliaresExteriorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FamiliaresExterior model.
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
     * Creates a new FamiliaresExterior model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($familiarid)
    {
        $model = new FamiliaresExterior();
        $model->scenario='CFamliarExterior';
         $cuadro = \frontend\models\CuadroFamiliar::findOne(['familiarid'=>$familiarid])->cuadro;
        $familiar = \frontend\models\Familiar::findOne(['id'=>$familiarid]);

        if ($model->load(Yii::$app->request->post()))
                
            {
            $model->familiarid = $familiarid;     
            $model->save(); 
            $familiar->updateAttributes(['residenteExterior'=>1]);
            Yii::$app->session->setFlash('mensaje');
         Yii::$app->session->setFlash('mensaje');
        $mensaje = 'La residencia ha sido agregado correctamente';
        $style = 'alert-success';
         
         return $this->redirect(['cuadro/view', 
                                 'id' => $cuadro->id,
                                 'mensaje'=>$mensaje,
                                 'style'=>$style,
             ]);
        }

        return $this->render('create', [
            'model' => $model,
            'familiar'=>$familiar,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing FamiliaresExterior model.
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
     * Deletes an existing FamiliaresExterior model.
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
     * Finds the FamiliaresExterior model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FamiliaresExterior the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FamiliaresExterior::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
