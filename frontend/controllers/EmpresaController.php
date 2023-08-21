<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Empresa;
use frontend\models\EmpresaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
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
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empresa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamentes');
            // Multiple alerts can be set like below
            //Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empresa model.
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
     * Deletes an existing Empresa model.
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
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
       
    public function actionVerinfoempresa()
    {
        $model = new Empresa();

        if ($model->load(Yii::$app->request->post()) ) {
           
            //return print_r($model);
            return $this->redirect(['verempresa', 'id' => $model->nombre]);
        }

        return $this->render('selecionarempresa', [
            'model' => $model,
        ]);
    }
     public function actionVerempresa($id)
    {
        $model = new Empresa();
        $periodocapital = date('M-Y');
        $empresa = \frontend\models\Empresa::findOne(['id'=>$id]);
         $searchModelimpuesto = new \frontend\models\ImpuestoSearch();
        $dataProviderimpuesto = $searchModelimpuesto->search(Yii::$app->request->queryParams);
        $dataProviderimpuesto->query->andFilterWhere(['empresaid'=> $id, 'status'=>1])->orderBy(['fecha'=>'DESC']);
        
        $searchModelcapital = new \frontend\models\CapitalSearch();
        $dataProvidercapital = $searchModelcapital->search(Yii::$app->request->queryParams);
        $dataProvidercapital->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        if(\frontend\models\Capital::findOne(['empresaid'=>$id]))
        {
        $periodo = \frontend\models\Capital::findOne(['empresaid'=>$id])->fecha;
        $periodocapital = \Yii::$app->formatter->asDate($periodo,'M-Y');
            
        }
        
        $searchModelciclos = new \frontend\models\CiclosSearch();
        $dataProviderciclos = $searchModelciclos->search(Yii::$app->request->queryParams);
        $dataProviderciclos->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        
          $searchModelcomedor = new \frontend\models\ComedorSearch();
        $dataProvidercomedor = $searchModelcomedor->search(Yii::$app->request->queryParams);
        $dataProvidercomedor->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
     
            
         $searchModelcuentas1 = new \frontend\models\CuentasSearch();
        $dataProvidercuentas1 = $searchModelcuentas1->search(Yii::$app->request->queryParams);
        $dataProvidercuentas1->query->andFilterWhere(['empresaid'=>$id,'tipo_cuentaid'=>1,'status'=>1]);
        
         $searchModelcuentas2 = new \frontend\models\CuentasSearch();
        $dataProvidercuentas2 = $searchModelcuentas2->search(Yii::$app->request->queryParams);
        $dataProvidercuentas2->query->andFilterWhere(['empresaid'=>$id,'tipo_cuentaid'=>2,'status'=>1]);
        
        $searchModelsalario = new \frontend\models\FondoSalarioSearch();
        $dataProvidersalario = $searchModelsalario->search(Yii::$app->request->queryParams);
        $dataProvidersalario->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        
        $searchModeltiempo = new \frontend\models\FondoTiempoSearch();
        $dataProvidertiempo = $searchModeltiempo->search(Yii::$app->request->queryParams);
        $dataProvidertiempo->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        
          $searchModellaboratorio = new \frontend\models\InformacionLaboratoriosSearch();
        $dataProviderlaboratorio = $searchModellaboratorio->search(Yii::$app->request->queryParams);
        $dataProviderlaboratorio->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        
        $searchModelperdida1 = new \frontend\models\PerdidaInvestigacionSearch();
        $dataProviderperdida1 = $searchModelperdida1->search(Yii::$app->request->queryParams);
        $dataProviderperdida1->query->andFilterWhere(['empresaid'=>$id,'tipo_expedienteid'=>1,'status'=>1]);
        $searchModelperdida2 = new \frontend\models\PerdidaInvestigacionSearch();
        $dataProviderperdida2 = $searchModelperdida2->search(Yii::$app->request->queryParams);
        $dataProviderperdida2->query->andFilterWhere(['empresaid'=>$id,'tipo_expedienteid'=>2,'status'=>1]);
        $searchModelperdida3 = new \frontend\models\PerdidaInvestigacionSearch();
        $dataProviderperdida3 = $searchModelperdida3->search(Yii::$app->request->queryParams);
        $dataProviderperdida3->query->andFilterWhere(['empresaid'=>$id,'tipo_expedienteid'=>3,'status'=>1]);
             $searchModelproductividad = new \frontend\models\ProductividadSearch;
        $dataProviderproductividad = $searchModelproductividad->search(Yii::$app->request->queryParams);
        $dataProviderproductividad->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
                $searchModelrecla = new \frontend\models\ReclamacionesSearch();
        $dataProviderrecla = $searchModelrecla->search(Yii::$app->request->queryParams);
        $dataProviderrecla->query->andFilterWhere(['empresaid'=>$id,'status'=>1])->orderBy(['tipo_reclamacion'=>'ASC']);
          $searchModelutilidad = new \frontend\models\UtilidadSearch(); 
       $dataProviderutilidad = $searchModelutilidad->search(Yii::$app->request->queryParams);
        $dataProviderutilidad->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        $searchModelutixpeso = new \frontend\models\UtilidadxpesoSearch();
        $dataProviderutixpeso = $searchModelutixpeso->search(Yii::$app->request->queryParams);
        $dataProviderutixpeso->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
         $searchModelvalor = new \frontend\models\ValorAgregadoSearch();
        $dataProvidervalor = $searchModelvalor->search(Yii::$app->request->queryParams);
        $dataProvidervalor->query->andFilterWhere(['empresaid'=>$id,'status'=>1]);
        $searchModelvariacion = new \frontend\models\VariacionGastosSearch();
        $dataProvidervariacion = $searchModelvariacion->search(Yii::$app->request->queryParams);
        $dataProvidervariacion->query->andFilterWhere(['empresaid'=>$id,'status'=>1,'periodo'=>'2018-04'])->orderBy(['periodo'=>'ASC']);
         $searchModelventas1 = new \frontend\models\VentasSearch();
        $dataProviderventas1 = $searchModelventas1->search(Yii::$app->request->queryParams);
        $dataProviderventas1->query->andFilterWhere(['empresaid'=>$id,'tipo_ventaid'=>1,'status'=>1])->orderBy(['productoid'=> 'ASC']);
         $searchModelventas2 = new \frontend\models\VentasSearch();
        $dataProviderventas2 = $searchModelventas2->search(Yii::$app->request->queryParams);
        $dataProviderventas2->query->andFilterWhere(['empresaid'=>$id,'tipo_ventaid'=>2,'status'=>1]);
         $searchModelventas3 = new \frontend\models\VentasSearch();
        $dataProviderventas3 = $searchModelventas3->search(Yii::$app->request->queryParams);
        $dataProviderventas3->query->andFilterWhere(['empresaid'=>$id,'tipo_ventaid'=>3,'status'=>1])->orderBy(['productoid'=> 'ASC']);

        

        

        

      
        
        
        return $this->render('verempresa', [
            'searchModelimpuesto' => $searchModelimpuesto,
            'dataProviderimpuesto' => $dataProviderimpuesto,
            'searchModelcapital' => $searchModelcapital,
            'dataProvidercapital' => $dataProvidercapital,
            'periodocapital' => $periodocapital,
            'searchModelciclos' => $searchModelciclos,
            'dataProviderciclos' => $dataProviderciclos,
        'searchModelcomedor' => $searchModelcomedor,
            'dataProvidercomedor' => $dataProvidercomedor,
            'searchModelcuentas1' => $searchModelcuentas1,
            'dataProvidercuentas1' => $dataProvidercuentas1,
            'searchModelcuentas2' => $searchModelcuentas2,
            'dataProvidercuentas2' => $dataProvidercuentas2,
            
            'searchModelsalario' => $searchModelsalario,
            'dataProvidersalario' => $dataProvidersalario,
            'searchModeltiempo' => $searchModeltiempo,
            'dataProvidertiempo' => $dataProvidertiempo,
            'searchModellaboratorio' => $searchModellaboratorio,
            'dataProviderlaboratorio' => $dataProviderlaboratorio,
            'searchModelperdida1' => $searchModelperdida1,
            'dataProviderperdida1' => $dataProviderperdida1,
            'searchModelperdida2' => $searchModelperdida2,
            'dataProviderperdida2' => $dataProviderperdida2,
            'searchModelperdida3' => $searchModelperdida3,
            'dataProviderperdida3' => $dataProviderperdida3,
            'searchModelproductividad' => $searchModelproductividad,
            'dataProviderproductividad' => $dataProviderproductividad,
            
            'searchModelrecla' => $searchModelrecla,
            'dataProviderrecla' => $dataProviderrecla,
            'searchModelutilidad' => $searchModelutilidad,
            'dataProviderutilidad' => $dataProviderutilidad,
        

            'searchModelutixpeso' => $searchModelutixpeso,
            'dataProviderutixpeso' => $dataProviderutixpeso,       
            
            
            'searchModelvalor' => $searchModelvalor,
            'dataProvidervalor' => $dataProvidervalor,


            'searchModelvariacion' => $searchModelvariacion,
            'dataProvidervariacion' => $dataProvidervariacion,
            
             'searchModelventas1' => $searchModelventas1,
            'dataProviderventas1' => $dataProviderventas1,
           
             'searchModelventas2' => $searchModelventas2,
            'dataProviderventas2' => $dataProviderventas2,
           
             'searchModelventas3' => $searchModelventas3,
            'dataProviderventas3' => $dataProviderventas3,
            'empresa' => $empresa,
            'model'=>$model,
           

            ]);
    }
   
}
