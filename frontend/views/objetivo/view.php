<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
//
/* @var $this yii\web\View */
/* @var $model frontend\models\Objetivo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="objetivo-view">

     
    <?php  if(Yii::$app->user->identity->rolid == "2")
             {?>
       <?php echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'nombre',
              'label' => 'Nombre ',
            ], 
            [
             'attribute' =>  'abreviatura',
              'label' => 'Abreviatura ',
            ],
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripcion ',
            ],
            [
             'attribute' =>  'fechaAct',
              'label' => 'Fecha de puesta en vigor ',
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
            [
             'attribute' =>  'responsable',
              'label' => 'Responsable ',
              'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
            ],
           [
             'attribute' =>  'fechaDesac',
              'label' => 'Fecha de Desactivación',
               'displayOnly'=> TRUE,
            ],
                 /*  [
             'attribute' =>  'Status',
              'label' => 'Estado',
            ],*/
            
        ],
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
]);
             }
             else{
                 ?>
       <?php echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'nombre',
              'label' => 'Nombre ',
            ], 
            [
             'attribute' =>  'abreviatura',
              'label' => 'Abreviatura ',
            ],
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripcion ',
            ],
            [
             'attribute' =>  'fechaAct',
              'label' => 'Fecha de puesta en vigor ',
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
            [
             'attribute' =>  'responsable',
              'label' => 'Responsable ',
              'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
            ],
           [
             'attribute' =>  'fechaDesac',
              'label' => 'Fecha de Desactivación',
            ],
                 /*  [
             'attribute' =>  'Status',
              'label' => 'Estado',
            ],*/
            
        ],
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ],
    'enableEditMode'=>FALSE,
]);
       
                 
             }
  /*  ?>  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'nombre',
            'abreviatura',
            'descripcion:ntext',
            'fechaAct',
            'responsable0.nombre',
            'Status',
            'fechaDesac',
        ],
    ])*/ ?>
    
       
    <?php
    echo Html::a('<i class="glyphicon glyphicon-hand-left"></i> Regresar', ['index'], ['class' => 'btn btn-success']) 
    ?>


</div>
