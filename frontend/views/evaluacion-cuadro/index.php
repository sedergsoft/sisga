<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluacion Cuadros');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="evaluacion-cuadro-index">

  
    <?= GridView::widget(['dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Evaluaciones </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],/*
        'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
             [
            'attribute'=>'cuadro.personaCI0.Nombre',
            'label' => 'Nombre',
           
            ],
             [
            'attribute'=>'cuadro.personaCI0.primer_apellido',
            'label' => 'Primer Apellido',
           
            ],
             [
            'attribute'=>'cuadro.personaCI0.segundo_apellido',
            'label' => 'Segudo Apellido',
           
            ],
             [
            'attribute'=>'periodoEvaluado.Desde',
            'label' => 'Segudo Apellido',
                 'value'=> function ($model) 
                 {
    
                return 'Desde '.$model->periodoEvaluado->desde.' Hasta '.$model->periodoEvaluado->hasta;
                 }           
            ],
              [
            'attribute'=>'fecha',
            'label' => 'Fecha de Evauación',
           
            ],
           

            ['class' => 'yii\grid\ActionColumn',  'template'=>'{view}'],
        ],
    ]); ?>
</div>
