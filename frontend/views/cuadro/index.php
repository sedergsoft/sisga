<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuadros');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="cuadro-index">

 
    

    <?php
    
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
              /* 'toolbar' =>  [
        ['content' => 
           // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Agregar Indicador']). ' '.
            Html::a('<i class="glyphicon glyphicon-ok-sign"></i>', ['activarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-info', 'title' => 'Activar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer activar el periodo de edición de los indicadores de gestión?'])  . ' '.
           // Html::button('<i class="glyphicon glyphicon-minus-sign"></i>', ['value'=>Url::to(['indicadoresgestion/cerrarperiodoevaluacion']),'type' => 'button', 'title' => 'Cerrar periodo de evaluacion', 'class' => 'btn btn-danger','data-confirm'=>'Está seguro de querer cerrar el periodo de edicion de los indicadores de gestión?'])
            Html::a('<i class="glyphicon glyphicon-minus-sign"></i>', ['cerrarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'Cerrar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer cerrar el periodo de edición de los indicadores de gestión?']). ' '. 
            Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['cerrarmes'], ['data-pjax' => 0, 'class' => 'btn btn-warning', 'title' => 'Cerrar la información del mes','data-confirm'=>'Está seguro de querer cerrar el mes?...Tenga en cuenta que con esta acción reiniciara todas las evaluaciones de los indicadores']) 
        ],
        '{export}',
        '{toggleData}',
    ],*/
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Cuadros</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
           ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'personaCI',
            'label' => 'Nombre',
             'width' => '18%',   
            'value'=> function ($model)
             {
              return strtoupper($model->personaCI0->Nombre);
             }
            
            ],
            
            [
            'attribute'=>'personaCI',
            'label' => 'Primer Apellido',
                'width' => '18%',
            'value'=> function ($model)
             {
              return strtoupper($model->personaCI0->primer_apellido);
             }
            
            ],
            [
            'attribute'=>'personaCI',
            'label' => 'Segundo Apellido',
                'width' => '18%',
            'value'=> function ($model)
             {
              return strtoupper($model->personaCI0->segundo_apellido);
             }
            
            ],
              
            [
            'attribute'=>'personaCI',
            'label' => 'NI',
            'width' => '14%',
            'value'=> function ($model)
             {
              return $model->personaCI0->CI;
             }
            
            ],
            [
            'attribute'=>'id',
            'label' => 'última Evaluación',
            'width' => '14%',
            'value'=> function ($model)
             {
              if($evaluacion = frontend\models\EvaluacionCuadro::findOne(['cuadroid'=>$model->id,'ultima'=>1]))
             {
                 
                return frontend\models\EvaluacionCuadro::findOne(['cuadroid'=>$model->id,'ultima'=>1])->fecha;
             }
             else {
                 return "No evaluado"; 
                }
             }
            
            ],
           
            [
            'attribute'=>'id',
            'label' => 'Evaluación Válida',
            'format'=>"raw",
           /* 'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'estado'],
                  */
            'width' => '10%',
            'value'=> function ($model)
            {
             if($evaluacion = frontend\models\EvaluacionCuadro::findOne(['cuadroid'=>$model->id,'ultima'=>1]))
             {
                if(\frontend\controllers\CuadroController::evaluacionValida($model->id)== true)
                {
                    return '<span class = "glyphicon glyphicon-ok" style="color:green";></span">';
                }else{return  '<span class = "glyphicon glyphicon-remove" style="color:red";></span">';}
                return frontend\models\EvaluacionCuadro::findOne(['cuadroid'=>$model->id])->fecha;
             }
             else {
                 return  '<span class = "glyphicon glyphicon-remove" style="color:red";></span">'; 
                }
             }
            
            ],
           
            ['class' => 'yii\grid\ActionColumn',
             // 'width' => '50px',  
                
                     'template' => '{view} {move}',
                'buttons' => [
                     'move' => function ($url, $data){
               
                           
                     return Html::a(
                                '<span class = "glyphicon glyphicon-share";></span',
                                $url = Url::toRoute(['movimiento-cuadro/rechazada', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Mover Cuadro ',
                                                                                 'data-confirm'=> 'Esta seguro que desea hacer un movimiento a este cuadro',
                                                                                 'class' => 'btn btn-success btn-xs', 
                                                                                 'style'=>"margin-left: 10px",
                                                                               
                                                                             ] 
                                 ); 
              
                          },
                     'view' => function ($url, $data){
               
                           
                     return Html::a(
                                '<span class = "glyphicon glyphicon-eye-open";></span',
                                $url = Url::toRoute(['view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver Cuadro ',
                                                                                 'class' => 'btn btn-primary btn-xs', 
                                                                                 'style'=>"margin-left: 10px",
                                                                               
                                                                             ] 
                                 ); 
              
                          },
                                  ]
                
            
                ],
        ],
    ]); 
       
    
    
    
    /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Información de los criterios de medida a certificar </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           /*   
            'id',
            'personaCI',
            'Lugar_nacimiento',
            'ciudadania',
            'color_piel',
            //'color_ojos',
            //'color_pelo',
            //'estatura',
            //'peso',
            //'telefono',
            //'email:email',
            //'preparacion_intelectualid',
            //'centro_trabajoid',
            //'cargoid',
            //'trayectoria_militarid',
            //'ubicacion_tiempo_guerra',
            //'foto',
            //'vehiculo',
            //'arma',
            //'ingresos_monetarios',
            //'beneficio_ingreso',
            //'reserva_cuadro',
            //'saludid',
        
            ['class' => 'yii\grid\ActionColumn'],
],
       
    ]);*/ ?>
</div>
