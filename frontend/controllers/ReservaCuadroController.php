<?php

namespace frontend\controllers;

use frontend\models\Cuadro;
use Yii;
use frontend\models\ReservaCuadro;
use frontend\models\ReservaCuadroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservaCuadroController implements the CRUD actions for ReservaCuadro model.
 */
class ReservaCuadroController extends Controller
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
     * Lists all ReservaCuadro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservaCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['cuadroid'=>SORT_ASC,'tipo_sel_reservaid'=>SORT_ASC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   

    /**
     * Displays a single ReservaCuadro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       
        
        $model=$this->findModel($id);
          

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ReservaCuadro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ReservaCuadro();
        $cuadro = Cuadro::find()->andFilterWhere(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post())) 
        {   
            $model->cuadroid=$cuadro->id;
            if($model->save())
            {

                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'cuadro' => $cuadro,
                ]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'cuadro' => $cuadro,
        ]);
    }

    /**
     * Updates an existing ReservaCuadro model.
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
     * Deletes an existing ReservaCuadro model.
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
     * Finds the ReservaCuadro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReservaCuadro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReservaCuadro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionComposicion()
   {
    $searchModel = new ReservaCuadroSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->query->orderBy(['cuadroid'=>SORT_ASC,'tipo_sel_reservaid'=>SORT_ASC])->all();
    if(Yii::$app->user->identity->rolid!=2)
    {
    $dataProvider->query->leftJoin( 'cuadro','cuadro.id = reserva_cuadro.cuadroid')->andFilterWhere(['cuadro.entidadid'=>Yii::$app->user->identity->direccionid])->all();
    }
    return $this->render('composicion', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
    
   }
}
