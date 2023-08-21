<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\IndicadoresEvaluacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores Evaluacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="indicadores-evaluacion-view">


    
    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Indicador de evaluación :'.$model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
           // 'id',
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripción ',
             
              'type'=> DetailView::INPUT_TEXTAREA,  
                 'widgetOptions'=>[
                               'rows'=>'5',
                              
                               ],
            ],
            
            
        ],
        'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ],
    'enableEditMode'=>true,
]);
     ?>

</div>
