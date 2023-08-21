<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Enfermedad;
use frontend\models\EnfermedadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\EnfermedadSalud;

/**
 * EnfermedadController implements the CRUD actions for Enfermedad model.
 */
class EnfermedadController extends Controller
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
     * Lists all Enfermedad models.
     * @return mixed
     */
    public function actionIndex()
    {
       if(Yii::$app->user->can('index_enfermedades'))
       {
        $searchModel = new EnfermedadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       }else{
           throw new \yii\web\ForbiddenHttpException("No tiene permiso para realizar esta accion");
       }
    }

    /**
     * Displays a single Enfermedad model.
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
     * Creates a new Enfermedad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($saludid)
    {
        $model = new Enfermedad();
        $cuadro = \frontend\models\Cuadro::findOne(['saludid'=>$saludid]);


        if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                            $modelEnfermedadSalud = new EnfermedadSalud();
                            $modelEnfermedadSalud->saludid = $saludid;
                            $modelEnfermedadSalud->enfermedadid = $model->id;
                            $modelEnfermedadSalud->save();    

            
            return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing Enfermedad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$saludid)
    {
        $model = $this->findModel($id);
        $cuadro = \frontend\models\Cuadro::findOne(['saludid'=>$saludid]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuadro' => $cuadro,
        ]);
    }

    /**
     * Deletes an existing Enfermedad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$saludid)
    {
       
        EnfermedadSalud::findOne(['saludid'=>$saludid,'enfermedadid'=>$id])->delete();
        $model = $this->findModel($id)->delete();
        $cuadro = \frontend\models\Cuadro::findOne(['saludid'=>$saludid]);
        
        return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
    }

    /**
     * Finds the Enfermedad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Enfermedad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enfermedad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
