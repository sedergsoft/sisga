<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Ventas;
use frontend\models\VentasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
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
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['anexoid'=>$id]);
$venta = Ventas::findOne(['anexoid'=>$id]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'venta'=>$venta,
        ]);
    }
     public function actionIndexpdf($id)
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['anexoid'=>$id]);
$venta = Ventas::findOne(['anexoid'=>$id]);
        
        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'venta'=>$venta,
        ]);
    }
        public function actionIndexview($id)
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $dataProvider->query->andFilterWhere(['tipo_ventaid' => $id]);
       // $venta = 1;
        if($id == 2)
        {
        return $this->render('indexview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'venta'=>$venta,
        ]);
        }
        if($id == 3)
        {
         return $this->render('indexviewventasliberadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'venta'=>$venta,
        ]);   
        }
    }
 public function actionMostrargrafico($id)
    {
       if($id == 2)
       {
        return $this->render('grafico');
       }
       if($id == 3)
       {
        return $this->render('graficoventasliberadas');
           
       }
    }
     public function actionMostrargraficoxproductos($id)
    {
       
        return $this->render('graficoventasliberadasxproductos',['id'=>$id]);
           
       
    }
    /**
     * Displays a single Ventas model.
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
     * Creates a new Ventas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ventas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ventas model.
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
     * Deletes an existing Ventas model.
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
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ventas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
     public function actionSelecionarmes()
    {
        if(Yii::$app->request->post())
        {
        $mes = $_POST['Mes'];
        $anno = $_POST['Año'];
         return $this->render('graficomes',[
                 'mes'=>$mes,
                 'anno'=>$anno,
                 ]);  
        }
        else{
            return $this->render('selecionarmes'
                                );
            }
        
}
     public function actionSelecionarproducto()
    {
        if(Yii::$app->request->post())
        {
        $id = $_POST['Producto'];
        
         return $this->render('graficoventasliberadasxproductos',[
                 'id'=>$id,
                 
                 ]);  
        }
        else{
            return $this->render('selecionarmes'
                                );
            }
        
}
}
