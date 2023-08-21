<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadro */

$this->title = 'Evaluacion del Cuadro :' .$model->cuadro->personaCI0->Nombre." ".$model->cuadro->personaCI0->primer_apellido." ".$model->cuadro->personaCI0->segundo_apellido;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluacion Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evaluacion-cuadro-view">

 
    <?= DetailView::widget([
        'model' => $model,
         'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
            [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-calendar"></i>Periodo evaluado</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
           'columns'=>[
                                    [
                                    'attribute'=>'entidad',
                                    'label'=>'Entidad ',
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    ],
                                    [
                                    'attribute'=>'organismoidorganismo',
                                    'label'=>'Organismo ',
                                    'value'=> frontend\models\Organismo::findOne($model->organismoidorganismo)->organismo,
                                  //  'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Desde ',
                                    'value'=>$model->periodoEvaluado->desde,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Hasta',
                                    'value'=>$model->periodoEvaluado->hasta,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                   
                                                        
                                ],
                        ],
                      
            
            [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-user"></i>CUADRO</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
           'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Primer Apellido',
                                    'value'=>$model->cuadro->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$model->cuadro->personaCI0->segundo_apellido,
                                  'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$model->cuadro->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                               [
                                    'attribute'=>'personaCI',
                                    'label'=>'NI :',
                                    'value'=>$model->cuadro->personaCI0->CI,
                                   // 'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                                        
                                ],
                        ],
           [
           'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nivel Educacional Vencido',
                                    'value'=>$model->cuadro->preparacionIntelectual->nivelEscolaridad->tipo,
                                   // 'valueColOptions'=>['style'=>'width:50%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Graduado de:',
                                    'value'=>$model->cuadro->preparacionIntelectual->Especialidad,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                  
                                                        
                                ],
                        ],[
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-tags"></i> Experiencia como Cuadro</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
           'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Tiempo en el cargo actual',
                                    'value'=>'En el Cargo Actual ('.$model->experiencia->años_cargo_actual.') año(s) y ('.$model->experiencia->meses_cargo_actual.') mes(es).',
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                   
                                [
                                    'label'=>'Tiempo como cuadro',
                                    'value'=>'Como cuadro ('.$model->experiencia->años_cuadro.') año(s) y ('.$model->experiencia->meses_cuadro.') mes(es).',
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                        
                        ],
                        ],
           /* 'complemento_textual:ntext',
            'señalamientos:ntext',
            'concluciones:ntext',
            'resultado_evaluacion',
            'superacion',
            'confecionado',
            'entidad',
            'cuadroid',
            'reservaid',
            'proyeccionid',
            'opinion_evaluadoid',
            'experienciaid',
            'periodo_evaluadoid',
            'organismoidorganismo',*/
        ],
        'enableEditMode'=>FALSE,
    ]) ?>
    
    
     <div>
        
        <?= GridView::widget([
        'dataProvider' => $modelsEvaluaciones,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores</h1></center> ',
        'type'=>'success',
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

            'indicadoresEvaluacion.descripcion',
            [
             'attribute' =>  'evaluacion',
              //'label' => 'Responsable ',
              'value'=> function($model)
                {
                   if($model->evaluacion == 1)
                   {
                       return  'MB';
                   }
                   if($model->evaluacion == 2)
                   {
                       return  'B';
                   }
                   if($model->evaluacion == 3)
                   {
                       return  'R';
                   }
                   if($model->evaluacion == 4)
                   {
                       return  'M';
                   }
                   if($model->evaluacion == 5)
                   {
                       return  'NE';
                   }
                },

            ],
         //   'evaluacion',
          
        ],
    ]); ?>
    </div>
   
    <div>
    <?= DetailView::widget([
        'model' => $model,
         'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
            [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-calendar"></i>Periodo evaluado</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
            'complemento_textual:ntext',
            'señalamientos:ntext',
            'concluciones:ntext',
           [
            'attribute'=>'resultado_evaluacion',
             'value'=> \frontend\models\Calificacion::findOne(['id'=>$model->resultado_evaluacion])->calificacion   
           ],
            'superacion',
            //'entidad',
            //'cuadroid',
           // 'experienciaid',
                                
             [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-inbox"></i> Reserva</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
              [
           'columns'=>[
                          [
            'attribute'=>'resultado_evaluacion',
            'label'=>'Acción',
           'valueColOptions'=>['style'=>'width:20%'],
           'value'=> $model->reserva->tipo0->tipo   
           ],
                                [
            'attribute'=>'resultado_evaluacion',
                                    'label'=>'Observaciones',
             'value'=> $model->reserva->observaciones   
           ],           
                        ],
                        ],          
                        
                    
             [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-facetime-video"></i> Proyección del cuadro</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
              [
           'columns'=>[
                          [
            'attribute'=>'resultado_evaluacion',
            'label'=>'Acción',
             'value'=> $model->proyeccion->tipoProyeccion->tipo   
           ],
                                [
            'attribute'=>'resultado_evaluacion',
            'label'=>'Tipo de Movimiento',
             'value'=> $model->proyeccion->tipoMovimiento->tipo_movimiento   
           ],           
                        ],
                        ],          
             [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-comment"></i>  Opinión de evaluado</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
              [
           'columns'=>[
                          [
            'attribute'=>'resultado_evaluacion',
            'attribute'=>'Opinión',
             'value'=> $model->opinionEvaluado->opinion == 1 ? 'En desacuerdo' :'De acuerdo' 
             ],
                                [
            'attribute'=>'resultado_evaluacion',
            'attribute'=>'¿Reclama?',
             'value'=> $model->opinionEvaluado->reclamacion == 1 ? 'Si' :'No' 
            
           ],           
                                [
            'attribute'=>'resultado_evaluacion',
            'attribute'=>'Elemento  que reclama o esta en desacuerdo ',
             'value'=> $model->opinionEvaluado->reclamacion_desc  
           ],           
                        ],
                        ],            
          [
                    'group'=> true,
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Jefe que confeciona la evaluación</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
              [
           'columns'=>[
                          [
            'attribute'=>'confecionado',
            'attribute'=>'Nombre y apellidos',
             'value'=>$model->confecionado0->Nombre
                              ],
                          [
            'attribute'=>'confecionado',
            'attribute'=>'Cargo',
             'value'=>$model->confecionado0->cargo->tipo
                              ],
                                
                                [
            'attribute'=>'resultado_evaluacion',
            'attribute'=>'Fecha de Evaluación',
             'value'=> $model->fecha  
           ],           
                        ],
                        ],
          
            
           // 'reserva.tipo',
           // 'reserva.observaciones',
          //  'proyeccionid',
           // 'opinion_evaluadoid',
            //'periodo_evaluadoid',
           
          //  'confecionado',
        ],
        'enableEditMode'=>FALSE,
    ]) ?>
    
    
     </div>
    
  

</div>
