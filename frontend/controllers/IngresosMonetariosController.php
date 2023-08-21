<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IngresosMonetarios;
use frontend\models\IngresosMonetariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngresosMonetariosController implements the CRUD actions for IngresosMonetarios model.
 */
class IngresosMonetariosController extends Controller
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
     * Lists all IngresosMonetarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngresosMonetariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IngresosMonetarios model.
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
     * Creates a new IngresosMonetarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        if(\yii::$app->user->can('create_ingreso'))
        {
        $model = new IngresosMonetarios();
      
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
     * Updates an existing IngresosMonetarios model.
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
     * Deletes an existing IngresosMonetarios model.
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
     * Finds the IngresosMonetarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IngresosMonetarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = IngresosMonetarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
