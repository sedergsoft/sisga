<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Criteriomedida */

$this->title = frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Criteriomedidas'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->params['tittle'][]= $this->title;
?>
<div class="criteriomedida-view">


   

    <?php 
    
    
     if(Yii::$app->user->identity->rolid == "2")
     {
       
    
    echo DetailView::widget([
    'model'=>$model/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Criterio de Medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id),
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
         'Descripcion',
            'UM',
        [
                'attribute'=> 'Objetivoid',
                'label' => 'Objetivo',
                'value'=>$model->objetivo->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$model->direccion->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
                ],
         
                
         [
                'attribute'=> 'tope[Itrimestre]',
                'label' => 'I trimestre',
                'value'=>$model->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'tope[IItrimestre]',
                'label' => 'II trimestre',
                'value'=>$model->tope->IItrimestre,
               
                ],
         [
                'attribute'=> 'tope[IIItrimestre]',
                'label' => 'III trimestre',
                'value'=>$model->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'tope[IVtrimestre]',
                'label' => 'VI trimestre',
                'value'=>$model->tope->IVtrimestre,
                
                ],
         
            ],
           'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
]);}
     else{
         
         
    
    echo DetailView::widget([
    'model'=>$model/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Criterio de Medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id),
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
         'Descripcion',
            'UM',
        [
                'attribute'=> 'Objetivoid',
                'label' => 'Objetivo',
                'value'=>$model->objetivo->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$model->direccion->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])-> all(), 'id', 'nombre'),
                              
                               ],
                ],
         
                
         [
                'attribute'=> 'tope[Itrimestre]',
                'label' => 'I trimestre',
                'value'=>$model->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'tope[IItrimestre]',
                'label' => 'II trimestre',
                'value'=>$model->tope->IItrimestre,
               
                ],
         [
                'attribute'=> 'tope[IIItrimestre]',
                'label' => 'III trimestre',
                'value'=>$model->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'tope[IVtrimestre]',
                'label' => 'VI trimestre',
                'value'=>$model->tope->IVtrimestre,
                
                ],
         
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
