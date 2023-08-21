<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MovimientoCuadro;
use frontend\models\MovimientoCuadroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Modal;

/**
 * MovimientoCuadroController implements the CRUD actions for MovimientoCuadro model.
 */
class MovimientoCuadroController extends Controller
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
     * Lists all MovimientoCuadro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovimientoCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAprobadas()
    {
        $searchModel = new MovimientoCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>0,'aprobada'=>1]);
        
        return $this->render('aprobadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRechazadas()
    {
        $searchModel = new MovimientoCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>0,'aprobada'=>2]);
        
        return $this->render('rechazadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MovimientoCuadro model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       $model = $this->findModel($id);
       $modelSustituido = CuadroController::findModel($model->cuadro_sustituido);
       $modelSustituto = CuadroController::findModel($model->cuadroid);
        
      // return print_r($modelSustituido);
       return $this->render('view', [
            'model' => $model,
            'modelSustituido' => $modelSustituido,
            'modelSustituto' => $modelSustituto,
        ]);
    }

    /**
     * Creates a new MovimientoCuadro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $modelCuadro = CuadroController::findModel($id);
      // return print_r(CuadroController::evaluado($modelCuadro->id)); 
      // return print_r(CuadroController::evaluacionValida($modelCuadro->id)); 
        
       if(CuadroController::evaluado($modelCuadro->id)== false || CuadroController::evaluacionValida($modelCuadro->id)==false)
       {
         
           //return print_r(CuadroController::evaluacionValida($modelCuadro)) ;
           Yii::$app->session->setFlash('mensaje');
        $mensaje = 'Para realizar una propuesta de movimiento el cuadro debe de tener una Evaluación realizada con un tiempo menor a 6 meses';
        $style = 'alert-danger';
        
     
           
           $this->redirect(['evaluacion-cuadro/create', 
               'id'=>$modelCuadro->id,
               'mensaje'=>$mensaje,
               'style'=>$style]);   
       }
        
        $model = new MovimientoCuadro();
        if ($model->load(Yii::$app->request->post())) 
            {
              
            $model->cuadroid = $modelCuadro->id;
                if( $model->save())
                {

                    return $this->redirect(['view', 'id' => $model->id]);

                }
            }

        return $this->render('create', [
            'model' => $model,
            'modelCuadro' => $modelCuadro,
        ]);
    }

    /**
     * Updates an existing MovimientoCuadro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelCuadro = CuadroController::findModel($model->cuadroid);
        if ($model->load(Yii::$app->request->post())) 
            {
              
            $model->cuadroid = $modelCuadro->id;
            $model->aprobada = 0;
            $model->status = 1;
            
          // return print_r($model->validate());
                if( $model->save())
                {

                    return $this->redirect(['view', 'id' => $model->id]);

                }
              //  else{return print_r('no guardaddo');}
            }


        return $this->render('update', [
            'model' => $model,
            'modelCuadro' => $modelCuadro,
       
        ]);
    }

    /**
     * Deletes an existing MovimientoCuadro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MovimientoCuadro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MovimientoCuadro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MovimientoCuadro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function actionAprobar($id) 
    {
      // return print_r($id);
        
        $this->findModel($id)->updateAttributes(['status'=>0,'aprobada'=>1]);
        return $this->redirect(['index']);
                
        
    }
    public function actionDenegar($id) 
    {
        $this->findModel($id)->updateAttributes(['status'=>0,'aprobada'=>2]);
        return $this->redirect(['index']);        
        
    }
    public function contarRechazadas($cuadroid) 
    {
    $searchModel = new MovimientoCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>0])->andWhere(['cuadroid'=>$cuadroid])->andWhere(['aprobada'=>2])->all();
        if($dataProvider->count == 0)
            return false;
        else{
            return $dataProvider;
        }
    }
    public function actionRechazada($id) 
    {
        $dataProvider = $this->contarRechazadas($id);
        //return print_r($dataProvider);
        if($dataProvider == false)
        {
            return $this->redirect(['create','id'=>$id]);
        }else{
              Yii::$app->session->setFlash('mensaje');
        $mensaje = 'El cuadro '.CuadroController::nombreCuadro($id) .' tiene '.$dataProvider->count.' propuesta(s) de movimientos rechazada(s), Usted puede consultar la propuesta rechazada o agregar una nueva propuesta de movimiento.';
        $style = 'alert-danger';
       
        return $this->render('movrechazadas', [
           // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id,
            'mensaje' =>$mensaje,
            'style'=>$style,
        ]);
        }
        
    }
}
