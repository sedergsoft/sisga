<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TrayectoriaEstudiantilCentroEstudios;
use frontend\models\TrayectoriaEstudiantilCentroEstudiosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrayectoriaEstudiantilCentroEstudiosController implements the CRUD actions for TrayectoriaEstudiantilCentroEstudios model.
 */
class TrayectoriaEstudiantilCentroEstudiosController extends Controller
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
     * Lists all TrayectoriaEstudiantilCentroEstudios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrayectoriaEstudiantilCentroEstudiosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrayectoriaEstudiantilCentroEstudios model.
     * @param integer $trayectoria_estudiantilid
     * @param integer $centro_estudiosid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($trayectoria_estudiantilid, $centro_estudiosid)
    {
        return $this->render('view', [
            'model' => $this->findModel($trayectoria_estudiantilid, $centro_estudiosid),
        ]);
    }

    /**
     * Creates a new TrayectoriaEstudiantilCentroEstudios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new TrayectoriaEstudiantilCentroEstudios();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        $modelCentroEstudios = new \frontend\models\CentroEstudios();
        $modelTrayectoriaEst = new \frontend\models\TrayectoriaEstudiantil();
        if ($model->load(Yii::$app->request->post())&&$modelCentroEstudios->load(Yii::$app->request->post()))
            {
            $modelTrayectoriaEst->cuadroid = $cuadroid;
            $modelTrayectoriaEst->save();
            $model->trayectoria_estudiantilid=$modelTrayectoriaEst->id;
            $modelCentroEstudios->save();
            $model->centro_estudiosid=$modelCentroEstudios->id;
            if($model->save())
            {
                
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
            }
            else{
            return $this->render('create', [
            'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
            
            
        ]);     
            }
            }
        return $this->render('create', [
            'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
            
            
        ]);
    }

    /**
     * Updates an existing TrayectoriaEstudiantilCentroEstudios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $trayectoria_estudiantilid
     * @param integer $centro_estudiosid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($trayectoria_estudiantilid, $centro_estudiosid, $cuadroid)
    {
        $model = $this->findModel($trayectoria_estudiantilid, $centro_estudiosid);
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
         $modelCentroEstudios = \frontend\models\CentroEstudios::findOne(['id'=>$centro_estudiosid]);
        //$modelTrayectoriaEst = new \frontend\models\TrayectoriaEstudiantil();
       
         if ($model->load(Yii::$app->request->post())&&$modelCentroEstudios->load(Yii::$app->request->post()))
            {
            $modelCentroEstudios->save();
            $model->centro_estudiosid=$modelCentroEstudios->id;
            $model->save(); 
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
       
            }
        return $this->render('update', [
            'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
           ]);
    }

    /**
     * Deletes an existing TrayectoriaEstudiantilCentroEstudios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $trayectoria_estudiantilid
     * @param integer $centro_estudiosid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($trayectoria_estudiantilid, $centro_estudiosid)
    {
        $this->findModel($trayectoria_estudiantilid, $centro_estudiosid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrayectoriaEstudiantilCentroEstudios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $trayectoria_estudiantilid
     * @param integer $centro_estudiosid
     * @return TrayectoriaEstudiantilCentroEstudios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($trayectoria_estudiantilid, $centro_estudiosid)
    {
        if (($model = TrayectoriaEstudiantilCentroEstudios::findOne(['trayectoria_estudiantilid' => $trayectoria_estudiantilid, 'centro_estudiosid' => $centro_estudiosid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
