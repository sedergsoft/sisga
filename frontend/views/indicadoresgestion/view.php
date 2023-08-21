<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Indicadoresgestion */

$this->title = 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores de gestión'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= 'Indicador '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->id);;
\yii\web\YiiAsset::register($this);
?>
<div class="indicadoresgestion-view">

  
       <?php 
       
    if(Yii::$app->user->identity->rolid == "2")
     {
          
       echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->id),
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'orden',
              'label' => 'No.Orden ',
              'type'=> DetailView::INPUT_SPIN,
                'widgetOptions'=>[
                    
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>50,
                                    'step'=>1,
                                   // 'decimals'=>2,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ],
                
               
            ], 
           
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripción ',
            ], 
            [
             'attribute' =>  'UM',
              'label' => 'Unidad de Medida ',
            ],
          [
             'attribute' =>  'tope[valor]',
              'label' => 'Valor de Cumplimiento',
             'value'=> $model->tope->valor,
                      'type'=> DetailView::INPUT_SPIN,
                'widgetOptions'=>[
                    
              'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                     'min'=>0,
                                    'max'=>50000000,
                                    'step'=>0.0001,
                                    'decimals'=>4,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ],
            ],
        [    
        'attribute' =>  'tope[idsentido]',
              'label' => 'Sentido de Comparación',
             'value'=> $model->tope->sentido->sentido,
            'type'=> DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data'=> ArrayHelper::map(frontend\models\Sentido::find()->all(),'id', 'sentido'),
            ]
             
        
          ],  [
             'attribute' =>  'fecha_chequeo',
              'label' => 'Fecha de Chequeo',
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
             'attribute' =>  'direccionid',
              'label' => 'Responsable ',
              'value'=> $model->direccion->nombre,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
            ],
          [
                'attribute'=> 'objetivoid',
                'label' => 'Objetivo',
                'value'=>$model->objetivo->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
           /* 
                  [
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
         
          
       echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->id),
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'orden',
              'label' => 'No.Orden ',
              'type'=> DetailView::INPUT_SPIN,
                'widgetOptions'=>[
                    
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>50,
                                    'step'=>1,
                                   // 'decimals'=>2,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ],
                
               
            ], 
           
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripcion ',
            ], 
            [
             'attribute' =>  'UM',
              'label' => 'Unidad de Medida ',
            ],
          [
             'attribute' =>  'tope[valor]',
              'label' => 'Valor de Cumplimiento',
             'value'=> $model->tope->valor,
                      'type'=> DetailView::INPUT_SPIN,
                'widgetOptions'=>[
                    
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>300,
                                    'step'=>1,
                                   // 'decimals'=>2,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ],
            ],
        [    
        'attribute' =>  'tope[idsentido]',
              'label' => 'Sentido de Comparaciósn',
             'value'=> $model->tope->sentido->sentido,
            'type'=> DetailView::INPUT_SELECT2,
            'widgetOptions'=>[
                'data'=> ArrayHelper::map(frontend\models\Sentido::find()->all(),'id', 'sentido'),
            ]
             
        
          ],  [
             'attribute' =>  'fecha_chequeo',
              'label' => 'Fecha de Chequeo',
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
             'attribute' =>  'direccionid',
              'label' => 'Responsable ',
              'value'=> $model->direccion->nombre,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
            ],
          [
                'attribute'=> 'objetivoid',
                'label' => 'Objetivo',
                'value'=>$model->objetivo->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
           /* 
                  [
             'attribute' =>  'Status',
              'label' => 'Estado',
            ],*/
            
        ],
           'enableEditMode'=>FALSE,
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
]);
     }
       ?>
    
       
    <?php
    echo Html::a('<i class="glyphicon glyphicon-hand-left"></i> Regresar', ['index'], ['class' => 'btn btn-success']) 
    ?>

    
   

</div>
