<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Plantilla */

$this->title = frontend\models\Entidad::findOne($model->empresaid)->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plantillas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="plantilla-view">

    <?= DetailView::widget([
        'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> frontend\models\Entidad::findOne($model->empresaid)->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
           // 'id',
           
                   [
             'attribute' =>  'cant_trabajadores',
              //'label' => 'Responsable ',
             // 'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SPIN, 
                 'widgetOptions'=>[
                                  'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
        
                               ],
            ],
                   [
             'attribute' =>  'cant_cuadros',
              //'label' => 'Responsable ',
             // 'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SPIN, 
                 'widgetOptions'=>[
                                  'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
        
                               ],
            ],
                        [
             'attribute' =>  'trabajadores_cubierta',
              //'label' => 'Responsable ',
             // 'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SPIN, 
                 'widgetOptions'=>[
                                  'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
        
                               ],
            ],
            [
             'attribute' =>  'cuadros_cubierta',
              //'label' => 'Responsable ',
             // 'value'=> $model->responsable0->nombre,
              'type'=> DetailView::INPUT_SPIN, 
                 'widgetOptions'=>[
                                  'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
        
                               ],
            ],
            [
             'attribute' =>  'empresaid',
              //'label' => 'Responsable ',
              'value'=> frontend\models\Entidad::findOne($model->empresaid)->nombre,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Entidad::find()->all(), 'id', 'nombre'),
                              
                               ],
                'displayOnly'=>TRUE,
            ],
        ],
             'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    ]) ?>

</div>
