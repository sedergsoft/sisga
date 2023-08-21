<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ControlUsuario */

$this->title = 'Preguntas de control';
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="control-usuario-view">

   

    <?php echo  DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Preguntas de control del Usuario: ' .frontend\controllers\UserController::findModel($model->userid)->username ,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
     
           
            [
             'attribute' =>  'preg_1',
              'label' => 'Pregunta No.1',
            ], 
            [
             'attribute' =>  'resp_1',
              'label' => 'Respuesta No.1',
            ],
            [
             'attribute' =>  'preg_2',
              'label' => 'Pregunta No.2',
            ], 
            [
             'attribute' =>  'resp_2',
              'label' => 'Respuesta No.2',
            ],
            [
             'attribute' =>  'preg_3',
              'label' => 'Pregunta No.3',
            ], 
            [
             'attribute' =>  'resp_3',
              'label' => 'Respuesta No.3',
            ],
            [
             'attribute' =>  'preg_4',
              'label' => 'Pregunta No.4',
            ], 
            [
             'attribute' =>  'resp_4',
              'label' => 'Respuesta No.4',
            ],
            [
             'attribute' =>  'preg_5',
              'label' => 'Pregunta No.5',
            ], 
            [
             'attribute' =>  'resp_5',
              'label' => 'Respuesta No.5',
            ],
          
            
        ],
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
]);

    
    ?>

</div>
