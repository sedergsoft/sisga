<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use daxslab\thumbnailer\Thumbnailer;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $model frontend\models\Cuadro */

$this->title = "NI: ".$model->personaCI;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuadro-view">

    <?php if(Yii::$app->session->hasFlash("mensaje")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>
    

                <?php 
//                
//                $residencia = frontend\models\LugaresResidencia::find()->where(['cuadroId'=>$model->id])->one();
//                                       // $residencia->find(['cuadroId'=>$model->id,/*'actual'=>1*/]);
//                                        return print_r($residencia->direcciones->calle);                    
//                                       // return $residencia->direcciones->calle;
                                          
   ?>

    <p>
       
        
        <?php if(Yii::$app->user->identity->rolid == "6")
        {
           echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);} ?>
    </p>

   <?php echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
                    [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-calendar"></i> Fecha de ejecución</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Primer Apellido',
                                    'value'=>$model->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$model->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$model->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$model->foto.'"style="width: 100px;height: 100px;"/>',
                                   // 'value'=> Html::img(Yii::$app->thumbnailer->get(Yii::$app->request->baseUrl.'/'.$model->foto, 400, 400, 10)), 
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                                        
                                ],
                        ],
                        [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Numero de Idenditad',
                                    'value'=>$model->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$model->personaCI0->sexo == 0? 'M':'F',
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$model->color_piel == 0? 'B':($model->color_piel == 1? 'M':($model->color_piel == 2? 'N':'A')),
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$model->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$model->color_pelo,
                                    //'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true
                                    ],
                                    
                                ]
                     
                        
                      ],
                      [
                        'columns'=>[
                                    [
                                    'attribute'=>'estatura',
                                    'label'=>'Estatura',
                                    'value'=>$model->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$model->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($model->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$model->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$model->ciudadania,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],    
                                    ]
                      ],
        [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-home"></i>  DIRECCION PARTICULAR </h1></center>',
                 
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
                        'columns'=>[
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Calle',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->calle,
                                         'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Número',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->numero,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Edificio',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->edif,
                                     // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Apto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->apto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                        ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Piso.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->piso,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre calle uno',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->entre_calle_uno,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre Calle Dos',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->entre_calle_dos,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Reparto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->Reparto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                            ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Municipio',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->municipio->municipio,
                                     'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Provincia',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($model->id)->direcciones->provincia->provincia,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'telefono',
                                    'label'=>'Teléfono',
                                    'value'=>$model->telefono,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'email',
                                    'label'=>'Email',
                                    'value'=>$model->email,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                       
                            
                            
                            
                                   
                      ],
                   ],
                    [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-book"></i>  PREPARACION INTELECTUAL </h1></center>',
                 
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
                        'columns'=>[
                                    [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Nivel Escolaridad',
                                    'value'=>$model->preparacionIntelectual->nivelEscolaridad->tipo,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Especialidad',
                                    'value'=>$model->preparacionIntelectual->Especialidad,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Categoria docente',
                                    'value'=>$model->preparacionIntelectual->gradoCientifico->tipo,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Grado Cientifico',
                                    'value'=>$model->preparacionIntelectual->gradoCientifico->tipo,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                   ],
                      ],
                      [
                          'columns'=>[
                                         [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Nivel Informático',
                                    'value'=>$model->preparacionIntelectual->informatica == 0?'Ninguno':($model->preparacionIntelectual->informatica == 1?'Básico':($model->preparacionIntelectual->informatica == 2?'Medio':($model->preparacionIntelectual->informatica == 3?'Avanzado':'Profesional'))),
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],                            
                                        /* [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Nivel Informático',
                                    'value'=>$model->preparacionIntelectual->preparacionIntelectualIdiomas->idiomasid,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],*/
                              
                                    ]                      
                        ],
                     /* [
                          'columns'=>[
                                         [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Nivel Informático',
                                    'value'=>$model->preparacionIntelectual->informatica,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],                            
                                  
                              
                                    ]                      
                        ],*/
        [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-briefcase"></i>  DATOS LABORALES </h1></center>',
                  'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ], 
        [
                        'columns'=>[
                                    [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Centro',
                                    'value'=>$model->centroTrabajo->centro,
                                    //'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Organismo',
                                    'value'=>$model->centroTrabajo->organismo->organismo,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                            ],],
                        [
                        'columns'=>[
  
                            [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Calle',
                                    'value'=>$model->centroTrabajo->direcciones->calle,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Numero',
                                    'value'=>$model->centroTrabajo->direcciones->numero,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Entre calle 1',
                                    'value'=>$model->centroTrabajo->direcciones->entre_calle_uno,
                                   // 'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true
                                    ],
                         
                            [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Entre calle 2',
                                    'labelColOptions'=>['style' =>'width:10%'],
                                    'value'=>$model->centroTrabajo->direcciones->entre_calle_dos,
                                   // 'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true
                                    ],
                            ],],
        [
                        'columns'=>[
                                    [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Municipio',
                                    'value'=>$model->centroTrabajo->direcciones->municipio->municipio,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Provincia',
                                   // 'value'=>$model->centroTrabajo->direcciones->provincia->provincia,
                                    'value'=> function ()use($model){
                                      //  $model = $widget->model;
                                        $value = $model->centroTrabajo->direcciones->provincia->provincia;
                                        return ($value);
       
                                    },
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Telefono',
                                    'value'=>$model->centroTrabajo->telefono,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'centro_trabajoid',
                                    'label'=>'Correo',
                                    'value'=>$model->centroTrabajo->email,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                   ],
                      ],
          [
                        'columns'=>[
                                    [
                                    'attribute'=>'cargoid',
                                    'label'=>'Cargo',
                                    'value'=>$model->cargo->cargo,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'$fecha_inicio_cargo',
                                    'label'=>'Fecha Ocupación',
                                    'value'=>$model->fecha_inicio_cargo,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'cargoid',
                                    'label'=>'Salario',
                                    'value'=>$model->cargo->salario,
                                    'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true,
                                    'format' => ['currency','CUP']   
                                    ],
         ],], 
        [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i>  INFORMACIóN DE SALUD </h1></center>',
                  'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
        [
                        'columns'=>[
                                    [
                                    'attribute'=>'saludid',
                                    'label'=>'Limitaciones Laborales',
                                    'value'=> frontend\models\LimitacionesSalud::find()->where(['saludid'=>$model->salud->id])->one()->limitaciones->limitacion,
                                    //'valueColOptions'=>['style'=>'width:30%'],
                                    'displayOnly'=>true,
                                    ],
                            [
                                    'attribute'=>'saludid',
                                    'label'=>'Estado de Salud',
                                    'value'=>$model->salud->estadoSalud->estado_salud,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                            ],],
                    ],
                                                'enableEditMode'=>FALSE,
                   
]);
?> 
   
    <div>
       
        <?= GridView::widget([
        'dataProvider' => $dataProviderEnfermedades,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> ENFERMEDADES</h1></center> ',
        'type'=>'success',
                 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['enfermedad/create','saludid'=>$model->saludid], ['class' => 'btn btn-success']),
       
    ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

            'enfermedad.enfermedad',
            'enfermedad.tratamiento',
                  ['class' => 'yii\grid\ActionColumn',
             'template' => '{delete} {update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-refresh" style="right: -20px;"></span',
                                                                            $url = Url::toRoute(['enfermedad/update', 'id' => $model->enfermedadid,'saludid'=>$model->salud->id]),
                                                                            
                                                                             [
                                                                                 'title' => 'Actualizar enfermedades ',
                                                                                 'data-confirm'=> 'Esta seguro que desea actualizar las enfermedades'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                       'delete'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-trash"></span',
                                                                            $url = Url::toRoute(['enfermedad/delete', 'id' => $model->enfermedadid,'saludid'=>$model->salud->id]),
                                                                            
                                                                             
                                                                                 
                                                                                 [
                                                                                   'title'=> 'Eliminar enfermedad',
                                                                               'data' => [
                                                                                'confirm' => Yii::t('app', 'Esta seguro que desea Eliminar esta enfermedad.'),
                                                                                'method' => 'post',
                                                                            ],]
                                                                               
                                                                            
                                                                            );    
                                                           },
                ],    
                                        
                        ]
        
            ],
           
    ]); ?>
    </div>
    
     <div>
        
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> TRAYECTORIA LABORAL</h1></center> ',
        'type'=>'success',
    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['trayectoria-laboral/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
       
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

            'centro_trabajo',
            'ocupacion',
            'fecha_inicio',
            'fecha_fin',
            'motivo_cambio',
     ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['trayectoria-laboral/update', 'id' => $model->id,'cuadroid'=>$model->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar trayectoria laboral ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar la trayectoria'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
                        ]
        ],
    ]); ?>
    </div>
    
    <div>
        
        <?= GridView::widget([
        'dataProvider' => $dataProviderlugaresResidencias,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> LUGARES DE RESIDENCIAS DONDE HA VIVIDO EN LOS ULTIMOS 20 AÑOS</h1></center> ',
        'type'=>'success',
                 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['lugares-residencia/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
    ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

            
            'direcciones.calle',
            'direcciones.numero',
            'direcciones.edif',
            'direcciones.apto',
            'direcciones.piso',
            'direcciones.entre_calle_uno',
            'direcciones.entre_calle_dos',
            'direcciones.Reparto',
            'direcciones.municipio.municipio',
            'direcciones.provincia.provincia',
            'fecha_inicio',
            'fecha_fin',
            
     
             ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['lugares-residencia/update', 'id' => $model->id,'cuadroid'=>$model->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Lugar de Residencia ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este lugar de residencia'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ],
                        ]
    ]); ?>
    </div>
    
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderTrayectoriaEstudiantil,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> ESTUDIOS REALIZADOS A PARTIR DE LA ENSEÑANZA MEDIA</h1></center> ',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['trayectoria-estudiantil-centro-estudios/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'centroEstudios.centro',
            'centroEstudios.municipio.municipio',
            'centroEstudios.provincia.provincia',
            'fecha_inicio',
            'fecha_fin',
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['trayectoria-estudiantil-centro-estudios/update', 'trayectoria_estudiantilid' => $model->trayectoria_estudiantilid,'centro_estudiosid'=>$model->centro_estudiosid,'cuadroid'=>$model->trayectoriaEstudiantil->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Centro de Estudios ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este centro de estudios'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ],
            
     
        ],
    ]); ?>
    </div>
    
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderEscuelaPoliticaCuadro,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> ESCUELAS POLITICAS CURSADAS</h1></center> ',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['cuadro-escuela-politica/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
    ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'escuelaPolitica.escuela',
            'curso',
            'fecha',
           
            
        ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['cuadro-escuela-politica/update', 'id' => $model->id,'cuadroid'=>$model->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Escuelas Políticas Cursadas ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar esta Escuela Política'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ],
        ],
    ]); ?>
    </div>
    <div>
     
    <?php echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        //'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
                    [
                    'group'=> true,
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-star-empty"></i> TRAYECTORIA MILITAR</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
                    [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Grado Militar',
                                    'value'=>($model->trayectoriaMilitar == null) ? ("Sin Trayectoria") :$model->trayectoriaMilitar->grado_militar,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'labelColOptions'=>['style' =>'width:10%'],    
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sector',
                                    'value'=>($model->trayectoriaMilitar == null) ? (" ") : \frontend\controllers\TrayectoriaMilitarMilitanciaController::findModel(['trayectoria_militarid'=>$model->trayectoria_militarid])->militancia->tipo,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'labelColOptions'=>['style' =>'width:10%'],    
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Fecha de Ingreso',
                                    'value'=>($model->trayectoriaMilitar == null) ? (" ") : \frontend\controllers\TrayectoriaMilitarMilitanciaController::findModel(['trayectoria_militarid'=>$model->trayectoria_militarid])->fecha_entrada,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                        'type'=>DetailView::INPUT_DATE,
                                        'widgetOptions' => [
                                            'pluginOptions'=>['format'=>'yyyy-mm-dd']
                                        ],
                                    'displayOnly'=>true
                                    ],
                                
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Fecha de Baja',
                                    'value'=> ($model->trayectoriaMilitar == null) ? (" ") : \frontend\controllers\TrayectoriaMilitarMilitanciaController::findModel(['trayectoria_militarid'=>$model->trayectoria_militarid])->fecha_baja,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                
                                                        
                                ],
                        ],
                        [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Causa de la Baja',
                                    'value'=> ($model->trayectoriaMilitar == null) ? (" ") :\frontend\controllers\TrayectoriaMilitarMilitanciaController::findModel(['trayectoria_militarid'=>$model->trayectoria_militarid])->causa_baja,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                
                                    
                                ]
                     
                        
                      ],
                      
                    ],
            'enableEditMode'=>FALSE,
                   
]);
?> 
   
    
    </div>
<div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderPreparacionMilitar,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-list"></i> PREPARACION MILITAR RECIBIDA</h1></center> ',
        'type'=>'success',
    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['preparacion-militar/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'escuela',
            'curso',
            'fecha',
           
         ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['preparacion-militar/update', 'id' => $model->id,'cuadroid'=>$model->trayectoria_militarid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Escuelas Políticas Cursadas ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar esta Escuela Política'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]   
     
        ],
    ]); ?>
    </div>

    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderExtanciaExt,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-plane"></i> ESTANCIA EN EL EXTERIOR</h1></center> ',
        'type'=>'success',
    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['estancia-exterior/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'pais',
            'tipo',
            'fecha',
            'cargo',
            'motivo',
           
         ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['estancia-exterior/update', 'id' => $model->id]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar viajes al Exterior',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este viaje'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]   
     
        ],
    ]); ?>
    </div>
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderCondecoraciones,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>CONDECORACIONES, DISTINCIONES Y ESTIMULOS MÁS IMPORTANTES RECIBIDOS</h1></center> ',
        'type'=>'success',
    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['condecoraciones/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'nombre',
           
            'fecha',
            
           
         ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['condecoraciones/update', 'id' => $model->id]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Escuelas Políticas Cursadas ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar esta información'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]  
            
     
        ],
    ]); ?>
    </div>
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderCuadroSanciones,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>SANCIONES</h1></center> ',
        'type'=>'success',
    'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['sanciones/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
            'sanciones.tipo',
            'sanciones.sansion',
            'sanciones.motivo',
            'sanciones.fecha',
            
            
         ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit""></span',
                                                                            $url = Url::toRoute(['sanciones/update', 'id' => $model->sancionesid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Sanciones ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar esta sanción'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]  
            
     
        ],
    ]); ?>
    </div>
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderVehiculo,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>VEHICULOS</h1></center> ',
        'type'=>'success',
     'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['vehiculo/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
   
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
            'tipoVehiculo.tipo_vehiculo',
           'marca',
           'modelo',
            'matricula',
            
           
        ['class' => 'yii\grid\ActionColumn',
             'template' => '{delete}{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-trash" style="right: -40px;"></span',
                                                                            $url = Url::toRoute(['vehiculo/delete', 'id' => $model->id,'cuadroid'=>$model->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Vehículo ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este vehículo',
                                                                                 'method'=>'POST',
                                                                             ]
                                                                            );    
                                                           },
                            'delete'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit" style="right: -20px;"></span',
                                                                            $url = Url::toRoute(['vehiculo/update', 'id' => $model->id]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Vehículo ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este vehículo'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]    
     
        ],
    ]); ?>
    </div>
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderArma,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>Armas</h1></center> ',
        'type'=>'success',
     'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['armas/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
   
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           'tipoArma.tipo_arma',
           'tipo',
           'marca',
           'modelo',
           'no_licencia',
            
                 ['class' => 'yii\grid\ActionColumn',
             'template' => '{delete}{update}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-trash" style="right: -40px;"></span',
                                                                            $url = Url::toRoute(['armas/delete', 'id' => $model->id,'cuadroid'=>$model->cuadroid]),
                                                                            
                                                                             [
                                                                                 'title' => 'Eliminar Arma ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Elimimar esta Arma',
                                                                                 'method'=>'POST',
                                                                             ]
                                                                            );    
                                                           },
                            'delete'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit" style="right: -20px;"></span',
                                                                            $url = Url::toRoute(['armas/update', 'id' => $model->id]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Arma ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar esta Arma'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
        ]  
            
     
        ],
    ]); ?>
    </div>
    <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderFamiilar,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-user"></i> DATOS FAMILIARES Y OTRAS PERSONAS QUE CONVIVAN EN SU VIVIENDA</h1></center> ',
        'type'=>'success',
     'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['familiar/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
   
                 ],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

        
           
           
           
           
           
            [
                
            'attribute'=>'familiar.tipoFamiliar.tipo',
            'width'=>'80px',
            ],
            [
                
            'attribute'=>'familiar.personaCI0.Nombre',
            'width'=>'80px',
            ],
            [
                
            'attribute'=>'familiar.personaCI0.primer_apellido',
            'width'=>'150px',
            ],
            [
                
            'attribute'=>'familiar.personaCI0.segundo_apellido',
            'width'=>'150px',
            ],
            [
                
            'attribute'=>'familiar.centro_estudio_trabajo',
            'width'=>'300px',
            ],
            [
            'attribute'=>'familiar.conviviente',
            'label' => 'Conviviente',
                'width'=>'50px',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->familiar->conviviente ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
            
            
           
            
     
        ],
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update} {viaje} {sancion} {residente} {delete}',
             'buttons'=>[
                            
                            'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit" style="right: 0px;"></span',
                                                                            $url = Url::toRoute(['familiar/update', 'id' => $model->familiarid,]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Familiar ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este familiar',
                                                                                 'method'=>'post',
                                                                             ]
                                                                            );    
                                                           },
                            'viaje'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-plane" style="left: 10px;"></span',
                                                                            $url = Url::toRoute(['viajes-familiares/create', 'familiarid' => $model->familiarid,]),
                                                                            
                                                                             [
                                                                                 'title' => 'Agregar viaje ',
                                                                                 'data-confirm'=> 'Esta seguro que desea agregar un viaje a este familiar?',
                                                                                 'method'=>'post',
                                                                             ]
                                                                            );    
                                                           },
                            'sancion'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-exclamation-sign" style="left: 20px;"></span',
                                                                            $url = Url::toRoute(['sancionados/create', 'familiarid' => $model->familiarid,]),
                                                                            
                                                                             [
                                                                                 'title' => 'Agregar Sanción ',
                                                                                 'data-confirm'=> 'Esta seguro que desea agregar una sanción a este familiar?',
                                                                                 'method'=>'post',
                                                                             ]
                                                                            );    
                                                           },
                            'residente'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-home" style="left: 30px;"></span',
                                                                            $url = Url::toRoute(['familiares-exterior/create', 'familiarid' => $model->familiarid,]),
                                                                            
                                                                             [
                                                                                 'title' => 'Agregar Residencia Exterior ',
                                                                                 'data-confirm'=> 'Esta seguro que desea agregar una Residencia en el exterior a este familiar?',
                                                                                 'method'=>'post',
                                                                             ]
                                                                            );    
                                                           },
                            'delete'=> function($url,$model)
                                        {
                                       
                                                            return Html::a( '<span class = "glyphicon glyphicon-trash" style="left: 40px;"></span',
                                                                            ['familiar/delete', 'id' => $model->familiarid], [
                                                                                   'title'=> 'Eliminar Familiar',
                                                                               'data' => [
                                                                                'confirm' => Yii::t('app', 'Esta seguro que desea eliminar esta persona'),
                                                                                'method' => 'post',
                                                                            ],]);    
                                                           },
                ],    
                                        
        ]        
    ]]); ?>
    </div>

     <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderViajesFamiilar,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>FAMILIAR O PERSONA QUE HA REALIZADO VIAJES AL EXTRANJERO</h1></center> ',
        'type'=>'success',
    ],
        'columns' => [
          // ['class' => 'yii\grid\SerialColumn'],

        
           // 'familiarid',
            [
                
            'attribute'=>'familiar.personaCI0.Nombre',
            'group'=>true,    
            ],
            [
                
            'attribute'=>'familiar.tipoFamiliar.tipo',
            'group'=>true,
            ],
            'pais',
            'fecha',
            
            
           
            
     
        ],
    ]); ?>
    </div>
    
     <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderFamiliaresResidentes,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>FAMILIARES RESIDENTES EN EL EXTERIOR</h1></center> ',
        'type'=>'success',
    ],
        'columns' => [
          // ['class' => 'yii\grid\SerialColumn'],

        
           // 'familiarid',
            [
                
            'attribute'=>'familiar.personaCI0.Nombre',
            'group'=>true,    
            ],
            [
                
            'attribute'=>'familiar.tipoFamiliar.tipo',
            'group'=>true,
            ],
            'pais',
            'nacionalidad',
            
            
           
            
     
        ],
    ]); ?>
    </div>
    
    
     <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderSancionados,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>FAMILIAR O PERSONA RESIDENTE QUE HA SIDO SANCIONADO</h1></center> ',
        'type'=>'success',
    ],
        'columns' => [
          // ['class' => 'yii\grid\SerialColumn'],

        
           // 'familiarid',
            [
                
            'attribute'=>'familiar.personaCI0.Nombre',
            'group'=>true,    
            ],
            [
                
            'attribute'=>'familiar.personaCI0.primer_apellido',
               
            ],
            [
                
            'attribute'=>'sancion',
            
            ],
            'fecha',
            'motivo',
            
            
           
            
     
        ],
    ]); ?>
    </div>
    
    
     <div>
        <?= GridView::widget([
        'dataProvider' => $dataProviderIngresosFamiliares,
        //'filterModel' => $searchModel,
             'panel' => [
        'heading'=>' <center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>INGRESO MONETARIO QUE RECIBEN ALGUNOS DE SUS FAMILIARES</h1></center> ',
        'type'=>'success',
                  'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> agregar ', ['cuadro-ingresos-monetarios/create','cuadroid'=>$model->id], ['class' => 'btn btn-success']),
    
    ],
        'columns' => [
          // ['class' => 'yii\grid\SerialColumn'],

        
           // 'familiarid',
            [
                
            'attribute'=>'tipoFamiliar.tipo',
           // 'group'=>true,    
            ],
            [
                
            'attribute'=>'tipoIngresos.tipo',
            'group'=>true,
            ],
           
            
            
           
            
     
        
             ['class' => 'yii\grid\ActionColumn',
             'template' => '{update}  {delete}',
             'buttons'=>[
                 'update'=> function($url,$model)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit" style="right: 0px;"></span',
                                                                            $url = Url::toRoute(['cuadro-ingresos-monetarios/update', 'id' => $model->id,]),
                                                                            
                                                                             [
                                                                                 'title' => 'Editar Ingreso Montario ',
                                                                                 'data-confirm'=> 'Esta seguro que desea Editar este Ingreso Montario',
                                                                                 'method'=>'post',
                                                                             ]
                                                                            );    
                                                           },
                 'delete'=> function($url,$model)
                                        {
                                       
                                                            return Html::a( '<span class = "glyphicon glyphicon-trash" style="left: 40px;"></span',
                                                                            ['cuadro-ingresos-monetarios/delete', 'id' => $model->id], [
                                                                                   'title'=> 'Eliminar Ingreso Montario',
                                                                               'data' => [
                                                                                'confirm' => Yii::t('app', 'Esta seguro que desea eliminar este Ingreso Montario'),
                                                                                'method' => 'post',
                                                                            ],]);    
                                                           },
                 
                            ],
                                                                   ]]
    ]); ?>
    </div>
    
</div>
