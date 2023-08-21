<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CriteriomedidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Criterios de medidas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="criteriomedida-index">
   
    
<?php if(Yii::$app->session->hasFlash("error_no_editable")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Este Indicador de gestión ya no se puede evaluar, su periodo de evaluacion ya culminó"]);
        ?>
    <?php endif; ?>     
    
      <?php  if(Yii::$app->session->hasFlash("error_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'Ya se ha cerrado el periodo de edición y no se pueden modificar las evaluaciones de los criterios de medida. ']);
        ?>
    <?php endif; ?>
    
     
      <?php  if(Yii::$app->session->hasFlash("ok_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El periodo de edición se ha cerrado correctamente, los Criterios no se podran editar hasta que se vuelva a activar el periodo de edición. ']);
        ?>
    <?php endif; ?>
    
          <?php  if(Yii::$app->session->hasFlash("ok_activado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El periodo de edición se ha abierto correctamente, los Criterios ya se podran editar. ']);
        ?>
    <?php endif; ?>
     <?php if(Yii::$app->session->hasFlash("error_certificado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Este criterio de medida ya no se puede evaluar, porque su evaluación ya fue cerificada"]);
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
      <?php  if(Yii::$app->session->hasFlash("ok_mes_cerrado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => 'El mes se ha cerrado correctamente, todas evaluaciones de los indicadores han sido reiniciadas. ']);
        ?>
    <?php endif; ?>
    
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    

  
      <?php  
      
      
     if(Yii::$app->user->identity->rolid == "2") //si el usuario es de tipo 
     {
     
     
    
      
      if($forma ==0)
      {
      echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
           'toolbar' =>  [
        ['content' => 
           // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Agregar Indicador']). ' '.
            Html::a('<i class="glyphicon glyphicon-ok-sign"></i>', ['activarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-info', 'title' => 'Activar periodo de edicion de los critertio','data-confirm'=>'Está seguro de querer activar el periodo de edición de los indicadores de gestión?'])  . ' '.
           // Html::button('<i class="glyphicon glyphicon-minus-sign"></i>', ['value'=>Url::to(['indicadoresgestion/cerrarperiodoevaluacion']),'type' => 'button', 'title' => 'Cerrar periodo de evaluacion', 'class' => 'btn btn-danger','data-confirm'=>'Está seguro de querer cerrar el periodo de edicion de los indicadores de gestión?'])
            Html::a('<i class="glyphicon glyphicon-minus-sign"></i>', ['cerrarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'Cerrar periodo de edicion de los criterio','data-confirm'=>'Está seguro de querer cerrar el periodo de edición de los indicadores de gestión?']) . ' '.
          Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['cerrarmes'], ['data-pjax' => 0, 'class' => 'btn btn-warning', 'title' => 'Cerrar la información del mes','data-confirm'=>'Está seguro de querer cerrar el mes?...Tenga en cuenta que con esta acción reiniciara todas las evaluaciones de los criterios']) 
       
            ],
        '{export}',
        '{toggleData}',
    ],
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Criterios de Medida</h3>',
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
           

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'Descripcion',
            'label' => 'Descripcion',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
                           [
             'attribute'=>'Objetivoid',
            'label' => 'Objetivo', 
            'value'=> function ($model)
             {
              return $model->objetivo->nombre;
                
             },
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Objetivo::find()->where(['Status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione el Objetivo..'],
                
             
             ],
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que tributa',
             'value'=> function ($model)
                 {
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
            'attribute'=>'evaluado',
            'label' => 'Informado',
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
      }else{
          
          echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
              
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Criterios de Medida</h3>',
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
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'Descripcion',
            'label' => 'Descripcion',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
                          [
             'attribute'=>'Objetivoid',
            'label' => 'Objetivo', 
            'value'=> function ($model)
             {
              return $model->objetivo->nombre;
                
             },
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Objetivo::find()->where(['Status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione el Objetivo..'],
                
             
             ],
              [
            'attribute'=>'direccionid',
            'label' => 'Dirección que tributa',
             'value'=> function ($model)
                 {
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
            /*[
            'attribute'=>'tope.valor',
            'label' => 'Tope',
            
            ],*/
           
            ['class' => 'yii\grid\ActionColumn',
                   'template' => '{Llenar}',
             'buttons' => [
                     'Llenar' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-edit" ></span',
                                                                            $url = Url::toRoute(['evaluacion/create','id' => $data['id']/*, 'platoid' =>$data['platoid']*/]),
                                                                            
                                                                             [
                                                                                 'title' => 'Llenar indicador',
                                                                              //    'data-confirm'=>'Est� seguro de querer cambiar este pedido a servido?',
                                                                             ]
                                                                            );    
                                                           }, 
                ],],
        ],
    ]); 
            }
     }
     else{
         
    
      
      if($forma ==0)
      {
      echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Criterios de Medida</h3>',
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
           

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'Descripcion',
            'label' => 'Descripcion',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
                           [
             'attribute'=>'Objetivoid',
            'label' => 'Objetivo', 
            'value'=> function ($model)
             {
              return $model->objetivo->nombre;
                
             },
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Objetivo::find()->where(['Status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione el Objetivo..'],
                
             
             ],
             [
            'attribute'=>'direccionid',
            'label' => 'Dirección que tributa',
             'value'=> function ($model)
                 {
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
            'attribute'=>'evaluado',
            'label' => 'Informado',
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
      }else{
          
          echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Criterios de Medida</h3>',
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
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'Descripcion',
            'label' => 'Descripcion',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
                          [
             'attribute'=>'Objetivoid',
            'label' => 'Objetivo', 
            'value'=> function ($model)
             {
              return $model->objetivo->nombre;
                
             },
              'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Objetivo::find()->where(['Status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione el Objetivo..'],
                
             
             ],
              [
            'attribute'=>'direccionid',
            'label' => 'Dirección que tributa',
             'value'=> function ($model)
                 {
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
            /*[
            'attribute'=>'tope.valor',
            'label' => 'Tope',
            
            ],*/
           
            ['class' => 'yii\grid\ActionColumn',
                   'template' => '{Llenar}{update}{view}' ,
             'buttons' => [
                      'Llenar' => function ($url, $model){
               
                if( $model->evaluado ==1){
                return Html::a(
                                 '<span class = "glyphicon glyphicon-edit" stytle ="right:5px" style="color:#DBDBDB"></span',
                                 $url  = NULL
                                 
                                 ); 
                  
                            }else{
                                return Html::a(
                                 '<span class = "glyphicon glyphicon-edit" stytle ="right:5px"></span',
                                
                                 $url = Url::toRoute(['evaluacion/create','id' => $model->id/*, 'platoid' =>$data['platoid']*/]),
                                                                            
                                                                             [
                                                                                 'title' => 'Llenar indicador',
                                                                              //    'data-confirm'=>'Est� seguro de querer cambiar este pedido a servido?',
                                                                             ]
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
                                 $url = Url::toRoute(['evaluacion/vieweval', 'id' => $model->id])
                                                                            
                                 
                                 ); 
                
                            }        
                
                
                          }, 
                   ],],
        ],
    ]); 
            }
     }
    ?>
            
          
</div>
<script>


</script>