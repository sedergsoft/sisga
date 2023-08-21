<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

   
        <?php
        if(Yii::$app->user->getId() == $model->id)
        {
        echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->username,
        'type'=>DetailView::TYPE_INFO,
       
            'align'=>'center',
        
    ],
    'attributes'=>[
         'username',
            //'email',
        [
                'attribute'=> 'direccionid',
                'label' => 'Direccion a la que pertenece',
                'value'=>$model->direccion->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\direccion::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
            [
                'attribute'=> 'rolid',
                'label' => 'Tipo de Usuario',
                'value'=>$model->rol->rol,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(backend\models\Rol::find()-> all(), 'id', 'rol'),
                              
                               ],
                ],
         
            ],
            
         'enableEditMode'=>FALSE,    
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
            
    
]); 
        
        echo DetailView::widget([
    'model'=>$trabajador,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->username,
        'type'=>DetailView::TYPE_INFO,
       
            'align'=>'center',
        
    ],
    'attributes'=>[
         'nombre',
         'primerApellido',
         'segundoApellido',
         'CI',
         'telefono',
         'email',
         
            ],
         'enableEditMode'=>FALSE,    
        
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
            
    
]); 
        }else{
            
        echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->username,
        'type'=>DetailView::TYPE_INFO,
       
            'align'=>'center',
        
    ],
    'attributes'=>[
         'username',
            //'email',
        [
                'attribute'=> 'direccionid',
                'label' => 'Direccion a la que pertenece',
                'value'=>$model->direccion->nombre,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(\frontend\models\direccion::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
                              
                               ],
                ],
            [
                'attribute'=> 'rolid',
                'label' => 'Tipo de Usuario',
                'value'=>$model->rol->rol,
                'type'=> DetailView::INPUT_SELECT2,
                                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(backend\models\Rol::find()-> all(), 'id', 'rol'),
                              
                               ],
                ],
         
            ],
            
        
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
            
    
]); 
        
        echo DetailView::widget([
    'model'=>$trabajador,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->username,
        'type'=>DetailView::TYPE_INFO,
       
            'align'=>'center',
        
    ],
    'attributes'=>[
         'nombre',
         'primerApellido',
         'segundoApellido',
         'CI',
         'telefono',
         'email',
         
            ],
         //'enableEditMode'=>FALSE,    
        
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
            
    
]); 
    
        } 
?>
</div>
