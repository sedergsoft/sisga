<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlanEvaluacion */

$this->title = 'Plan de Evaluación : '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plan de Evaluación'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="plan-evaluacion-view">

 <?php
if(!$evaluado)
{
    echo DetailView::widget([
       'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Plan de Evaluación',
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
            //'id',
            [
             'attribute' =>  'idevaluador',
             'value'=> $model->evaluador->username,   
             'type' => DetailView::INPUT_SELECT2, 
                      'widgetOptions'=>[
                               'data'=> yii\helpers\ArrayHelper::map(\frontend\models\User::find()->where(['status'=>10,'rolid'=>7])->all(), 'id', 'username'),
         'options' => ['placeholder' => 'Selecione el evaluador...'],
                               ],
               
            ],
           
             [
             'attribute' =>  'idcuadro',
             'value'=> frontend\controllers\CuadroController::nombreCuadro($model->idcuadro),   
             'displayOnly'=> true,
            ], 
            [
             'attribute' =>  'idcuadro',
                'label' => 'N.I.',
             'value'=> $model->cuadro->personaCI,   
             'displayOnly'=> true,
            ],
             [
             'attribute' =>  'fecha',
            
              'type'=> DetailView::INPUT_DATE,
                  'widgetOptions'=>[  
                                      'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'format' => 'yyyy-mm-dd',
                                                    'todayHighlight' => true,
                                                    'todayBtn' => true,
                                                    ],
                    
                                    ],
            
            ],
           // 'status',
            'observaciones',
        ],
        
        
           'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
] ]);
}
else{
      echo DetailView::widget([
       'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Plan de Evaluación',
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
            //'id',
            [
             'attribute' =>  'idevaluador',
             'value'=> $model->evaluador->username,   
             'type' => DetailView::INPUT_SELECT2, 
                      'widgetOptions'=>[
                               'data'=> yii\helpers\ArrayHelper::map(\frontend\models\User::find()->where(['status'=>10,'rolid'=>7])->all(), 'id', 'username'),
         'options' => ['placeholder' => 'Selecione el evaluador...'],
                               ],
               
            ],
           
             [
             'attribute' =>  'idcuadro',
             'value'=> frontend\controllers\CuadroController::nombreCuadro($model->idcuadro),   
             'displayOnly'=> true,
            ], 
            [
             'attribute' =>  'idcuadro',
                'label' => 'N.I.',
             'value'=> $model->cuadro->personaCI,   
             'displayOnly'=> true,
            ],
             [
             'attribute' =>  'fecha',
            
              'type'=> DetailView::INPUT_DATE,
            
            ],
           // 'status',
            'observaciones',
        ],
        
         'enableEditMode'=>FALSE,
         /*  'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
] */]);
    
}?>

</div>
