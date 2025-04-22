<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Composicion de la Reserva');
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
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Reservas</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
       // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
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
            'label' => 'Entidad',
             'width' => '10%',   
            'value'=> function ($model)
             {
              return strtoupper($model->cuadro->entidad->nombre_corto);
             },
             'group'=>true,
            ],
            [
            'attribute'=>'personaCI',
            'label' => 'Cargo para el cual es reserva',
             'width' => '10%',   
            'value'=> function ($model)
             {
              return strtoupper($model->cuadro->cargo->cargo).' ('.strtoupper($model->cuadro->personaCI0->nombrecompleto().')');
             },
             'group'=>true,
            ],
            
            [
            'attribute'=>'reservaid',
            'label' => 'Tipo de Reserva',
                'width' => '10%',
            'value'=> function ($model)
             {
              return strtoupper($model->tipoSelReserva->tipo);
             },
             'group'=>true,
            
            ],
            [
            'attribute'=>'reservaid',
            'label' => 'Nombre Y Apellidos',
                'width' => '10%',
            'value'=> function ($model)
             {
              return strtoupper($model->reserva->personaCI0->nombrecompleto());
             }
            
            ],
            [
            'attribute'=>'reservaid',
            'label' => 'Cargo',
                'width' => '10%',
            'value'=> function ($model)
             {
              return strtoupper($model->reserva->cargo->cargo);
             }
            
            ],
            [
            'attribute'=>'reservaid',
            'label' => 'Foto',
                'width' => '150px',
                'format'=>'raw',
            'value'=> function ($model)
             {
              return '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$model->reserva->foto.'"style="width: 100px;height: 100px;"/>';
             }
            
            ],
              
            [
            'attribute'=>'reservaid',
            'label' => 'Sexo',
            'width' => '10%',
            'value'=> function ($model)
             {
              return $model->reserva->personaCI0->sexo == 0? 'Masculino':'Femenino';
             }
            
            ],
            [
            'attribute'=>'reservaid',
            'label' => 'Color de Piel',
            'width' => '5%',
            'value'=> function ($model)
             {
              return  $model->reserva->color_piel == 0? 'B':($model->reserva->color_piel == 1? 'M':($model->reserva->color_piel == 2? 'N':'A'));
             }
            
            ],
            [
            'attribute'=>'reservaid',
            'label' => 'Militancia',
            'width' => '10%',
            'value'=> function ($model)
             {
              return $model->reserva->obtenerMilitanciapolitica();
             }
            
            ],
            [
                'attribute'=>'personaCI',
                'label' => 'Fecha Nac.',
               'width' => '10%',
                'value'=> function ($model)
                {
                 
                     return Yii::$app->formatter->asDate($model->reserva->personaCI0->fechaNac(),'long'); 
                  
                 }
                
                ],
                [
                'attribute'=>'personaCI',
                'label' => 'Edad',
                 'width' => '10%',
                'value'=> function ($model)
                {
                 
                     return  $model->reserva->personaCI0->edad(). ' años'; 
                  
                 }
                
                ],
           
          
           
            ['class' => 'yii\grid\ActionColumn',
             // 'width' => '50px',  
                
                     'template' => '{view} ',
                'buttons' => [
                     'move' => function ($url, $data){
                         return Html::a( '<i class="glyphicon glyphicon-share"></i>',
                         $url = Url::toRoute(['movimiento-cuadro/rechazada', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                'class' => 'btn btn-warning btn-xs',
                                                                                 'title' => 'Mover Cuadro ',
                                                                                 'data-confirm'=> 'Esta seguro que desea hacer un movimiento a este cuadro'
                                                                               
                                                                             ] 
                                 ); 
              
                          },
                     'view' => function ($url, $data){
                         return Html::a( '<i class="glyphicon glyphicon-eye-open"></i>',
                         $url = Url::toRoute(['view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                'class' => 'btn btn-primary btn-xs',
                                                                                  
                                                                             ] 
                                 ); 
              
                          },
                     'reserva' => function ($url, $data){
                         return Html::a( '<i class="glyphicon glyphicon-registration-mark"></i>',
                         $url = Url::toRoute(['reserva-cuadro/create', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                'class' => 'btn btn-success btn-xs',
                                                                                  
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
