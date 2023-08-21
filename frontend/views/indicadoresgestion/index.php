<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IndicadoresgestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Indicadores de Gestión');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="indicadoresgestion-index">

     <?php if(Yii::$app->session->hasFlash("error_no_editable")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Este Indicador de gestión ya no se puede evaluar, su periodo de evaluacion ya culminó o su evaluación ya fue cerificada"]);
        ?>
    <?php endif; ?>     
     <?php if(Yii::$app->session->hasFlash("error_certificado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Este Indicador de gestión ya no se puede evaluar, porque su evaluación ya fue cerificada"]);
        ?>
    <?php endif; ?>     
    
     <?php if(Yii::$app->session->hasFlash("error_no_existe")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "No se pueden mostrar los detalles de este indicador porque fueron eliminados"]);
        ?>
    <?php endif; ?>     
    
      <?php  if(Yii::$app->session->hasFlash("error_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'Ya se ha cerrado el periodo de edición y no se pueden modificar las evaluaciones de los Indicadores de Gestión. ']);
        ?>
    <?php endif; ?>
    
     
      <?php  if(Yii::$app->session->hasFlash("ok_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El periodo de edición se ha cerrado correctamente, los Indicadores no se podran editar hasta que se vuelva a activar el periodo de edición. ']);
        ?>
    <?php endif; ?>
      <?php  if(Yii::$app->session->hasFlash("ok_mes_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El mes se ha cerrado correctamente, todas evaluaciones de los indicadores han sido reiniciadas. ']);
        ?>
    <?php endif; ?>
    
          <?php  if(Yii::$app->session->hasFlash("ok_activado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El periodo de edición se ha abierto correctamente, los Indicadores ya se podran editar. ']);
        ?>
    <?php endif; ?>
    
       <?php  if(Yii::$app->session->hasFlash("ya_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'El periodo de edición ya se encuentra cerrado, no se puede cerrar nuevamente. ']);
        ?>
    <?php endif; ?>
    
<?php  if(Yii::$app->session->hasFlash("ya_abierto")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'El periodo de edición ya se encuentraba abierto, no se puede abrir nuevamente. ']);
        ?>
    <?php endif; ?>
         
 <?php
      
      
    if(Yii::$app->user->identity->rolid == "2")
     {
     
     
     
      if($forma ==1)
      {
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores  de Gestión</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
              
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que lo tributa',
             'value'=>function($model){
                return $model->direccion->nombre;
             },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione la Direción'],
                
             ], 
            [
            'attribute'=>'fecha_chequeo',
            'label' => 'Fecha de cierre',
            
            ],
                          [
            'attribute'=>'evaluado',
            'label' => 'Evaluado',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->evaluado ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                       'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'estado'],
                
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                
                     'template' => '{edit}{update}', 
                  'buttons' => [
                     'edit' => function ($url, $model){
               
                        return Html::a(
                                 '<span class = "glyphicon glyphicon-edit" stytle ="right:5px"></span',
                                 $url 
                                 
                                 ); 
              
                          },
                                  ]
                ],
        ],
    ]);  
      }
      else{
          echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
               'toolbar' =>  [
        ['content' => 
           // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Agregar Indicador']). ' '.
            Html::a('<i class="glyphicon glyphicon-ok-sign"></i>', ['activarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-info', 'title' => 'Activar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer activar el periodo de edición de los indicadores de gestión?'])  . ' '.
           // Html::button('<i class="glyphicon glyphicon-minus-sign"></i>', ['value'=>Url::to(['indicadoresgestion/cerrarperiodoevaluacion']),'type' => 'button', 'title' => 'Cerrar periodo de evaluacion', 'class' => 'btn btn-danger','data-confirm'=>'Está seguro de querer cerrar el periodo de edicion de los indicadores de gestión?'])
            Html::a('<i class="glyphicon glyphicon-minus-sign"></i>', ['cerrarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'Cerrar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer cerrar el periodo de edición de los indicadores de gestión?']). ' '. 
            Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['cerrarmes'], ['data-pjax' => 0, 'class' => 'btn btn-warning', 'title' => 'Cerrar la información del mes','data-confirm'=>'Está seguro de querer cerrar el mes?...Tenga en cuenta que con esta acción reiniciara todas las evaluaciones de los indicadores']) 
        ],
        '{export}',
        '{toggleData}',
    ],
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores  de Gestión</h3>',
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
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
              
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que lo tributa',
             'value'=>function($model){
                return $model->direccion->nombre;
             },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione la Direción'],
                
             ],    
            
            
            [
            'attribute'=>'fecha_chequeo',
            'label' => 'Fecha de cierre',
            
            ],
                          [
            'attribute'=>'evaluado',
            'label' => 'Evaluado',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->evaluado ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                       'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'estado'],
                
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                
                     'template' => '{view}',
                
            
                ],
        ],
    ]); 
          
      }
     }else{
         
          
      if($forma ==1)
      {
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores  de Gestión</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
              
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que lo tributa',
             'value'=>function($model){
                return $model->direccion->nombre;
             },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione la Direción'],
                
             ], 
            [
            'attribute'=>'fecha_chequeo',
            'label' => 'Tope',
            
            ],
                          [
            'attribute'=>'evaluado',
            'label' => 'Evaluado',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->evaluado ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                       'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'estado'],
                
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                
                     
                         'template' => '{edit}{update}{view}', 
                  'buttons' => [
                     'edit' => function ($url, $model){
               
                if( $model->evaluado ==1){
                return Html::a(
                                 '<span class = "glyphicon glyphicon-edit" stytle ="right:5px" style="color:#DBDBDB"></span',
                                 $url  = NULL
                                 
                                 ); 
                  
                            }else{
                                return Html::a(
                                 '<span class = "glyphicon glyphicon-edit" stytle ="right:5px"></span',
                                 $url 
                                 
                                 ); 
                
                            }        
                
                
                          },
                              'update' => function ($url, $model){
               
                if( $model->evaluado ==0){
                return Html::a(
                                 '<span class = "glyphicon glyphicon-repeat" stytle ="right:5px;color" style="color:#DBDBDB"></span',
                                 $url  = NULL
                                 
                                 ); 
                  
                            }else{
                                return Html::a(
                                 '<span class = "glyphicon glyphicon-repeat" stytle ="right:5px"></span',
                                 $url 
                                 
                                 ); 
                
                            }        
                
                
                          },      
                                  'view' => function ($url, $model){
               
                if( $model->evaluado ==0){
                return Html::a(
                                 '<span class = "glyphicon glyphicon-eye-open" stytle ="right:5px;color" style="color:#DBDBDB"></span',
                                 $url  = NULL
                                 
                                 ); 
                  
                            }else{
                                
                                return Html::a(
                                 '<span class = "glyphicon glyphicon-eye-open" stytle ="right:5px"></span',
                                 $url = Url::toRoute(['cumplimiento/vieweval', 'id' => $model->id])
                                                                            
                                 
                                 ); 
                
                            }        
                
                
                          },      
                              
                                  ]
                ],
        ],
    ]);  
      }
      else{
          echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores  de Gestión</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
              
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que lo tributa',
             'value'=>function($model){
                return $model->direccion->nombre;
             },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione la Direción'],
                
             ],    
            
            
            [
            'attribute'=>'fecha_chequeo',
            'label' => 'Tope',
            
            ],
                          [
            'attribute'=>'evaluado',
            'label' => 'Evaluado',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->evaluado ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                       'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'estado'],
                
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                
                     'template' => '{view}',
                
            
                ],
        ],
    ]); 
          
      }
    
         
         
         
     }  
      
    ?>
    
</div>
