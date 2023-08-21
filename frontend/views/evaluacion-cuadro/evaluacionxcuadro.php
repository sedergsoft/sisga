<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluaciones del cuadro :{name}',[
    'name'=>ucwords($cuadro->personaCI0->Nombre).' '.ucwords($cuadro->personaCI0->primer_apellido).' '.ucwords($cuadro->personaCI0->segundo_apellido),]);

$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="empresa-form">

    <?php $form = ActiveForm::begin(['action'=>"/sisga/frontend/web/index.php/evaluacion-cuadro/evaluacionxcuadro"]); ?>

    <?= $form->field($model, 'id')->widget(Select2::classname(), [
    'data' =>ArrayHelper::map(frontend\models\Cuadro::find()/*->where([])*/->orderBy('id')->asArray()->all(), 'id', 'personaCI'),
    'options' => ['placeholder' => 'Seleciona el cuadro a mostrar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('N.I.');?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Mostrar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





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
            'label' => 'Periodo evaluado',
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
