<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Cuadro;
use frontend\models\MiitanciaPolitic;
use frontend\models\MiitanciaPoliticCuadro;
use Yii;
use frontend\models\PreparacionIntelectual;
use frontend\models\PreparacionIntelectualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreparacionIntelectualController implements the CRUD actions for PreparacionIntelectual model.
 */
class PreparacionIntelectualController extends Controller
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
     * Lists all PreparacionIntelectual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreparacionIntelectualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreparacionIntelectual model.
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
     * Creates a new PreparacionIntelectual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new PreparacionIntelectual();
        $cuadro = Cuadro::find()->andFilterWhere(['id'=>$cuadroid])->one();
        
        $modelMiliatanciaPolitica = MiitanciaPoliticCuadro::findOne(['cuadroid'=>$cuadroid]);
        if(!$modelMiliatanciaPolitica)
        {
            $modelMiliatanciaPolitica = new MiitanciaPoliticCuadro();

        }

        if ($model->load(Yii::$app->request->post())&&$modelMiliatanciaPolitica->load(Yii::$app->request->post()) ) 
        {
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                if($model->save())
                {
                    $cuadro->updateAttributes(['preparacion_intelectualid'=>$model->id]);
                    $modelMiliatanciaPolitica->cuadroid = $cuadroid;
                   
                    //return print_r($modelMiliatanciaPolitica);
                    if($modelMiliatanciaPolitica->save())
                    {
                        $transaction->commit();
                        return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
                    }else{

                        $transaction->rollBack();
                       // return print_r($modelMiliatanciaPolitica);
                        return $this->render('create', [
                            'model' => $model,
                            'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
                            'cuadro' => $cuadro,
                        ]);
                    }

                }else{
                    $transaction->rollBack();
                    return $this->render('create', [
                        'model' => $model,
                        'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
                        'cuadro' => $cuadro,
                    ]);
                }
            
            }catch (Exception $e) {
                    $transaction->rollBack();
                }
            
        }
        return $this->render('create', [
            'model' => $model,
            'cuadro' => $cuadro,
            'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
        ]);
    }

    /**
     * Updates an existing PreparacionIntelectual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$cuadroid)
    {
       if($id ==1)
       {
        $this->redirect(['create','cuadroid'=>$cuadroid]);
       }
        $model = $this->findModel($id);
       
        $cuadro = Cuadro::find()->andFilterWhere(['id'=>$cuadroid])->one();
        $modelMiliatanciaPolitica = MiitanciaPoliticCuadro::findOne(['cuadroid'=>$cuadroid]);
        if(!$modelMiliatanciaPolitica)
        {
            $modelMiliatanciaPolitica = new MiitanciaPoliticCuadro();

        }

        if ($model->load(Yii::$app->request->post())&&$modelMiliatanciaPolitica->load(Yii::$app->request->post()) ) 
        {
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                if($model->save())
                {
                    $cuadro->updateAttributes(['preparacion_intelectualid'=>$model->id]);
                    $modelMiliatanciaPolitica->cuadroid = $cuadroid;
                   
                    //return print_r($modelMiliatanciaPolitica);
                    if($modelMiliatanciaPolitica->save())
                    {
                        $transaction->commit();
                        return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
                    }else{

                        $transaction->rollBack();
                       // return print_r($modelMiliatanciaPolitica);
                        return $this->render('update', [
                            'model' => $model,
                            'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
                            'cuadro' => $cuadro,
                        ]);
                    }

                }else{
                    $transaction->rollBack();
                    return $this->render('update', [
                        'model' => $model,
                        'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
                        'cuadro' => $cuadro,
                    ]);
                }
            
            }catch (Exception $e) {
                    $transaction->rollBack();
                }
            
        }
        return $this->render('update', [
            'model' => $model,
            'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
            'cuadro' => $cuadro,
        ]);
    }

    /**
     * Deletes an existing PreparacionIntelectual model.
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
     * Finds the PreparacionIntelectual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PreparacionIntelectual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PreparacionIntelectual::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
