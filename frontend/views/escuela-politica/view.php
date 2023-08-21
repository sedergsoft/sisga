<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\EscuelaPolitica */

$this->title = $model->escuela;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Escuela Politicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="escuela-politica-view">

  
    <p>
        
    </p>

    <?= DetailView::widget([
         'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->escuela,
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
           // 'id',
            'escuela',
        ],
        //  'enableEditMode'=>FALSE,      
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    ]) ?>

</div>
