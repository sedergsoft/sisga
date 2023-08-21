<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model frontend\models\MovimientoCuadro */

$this->title = 'Propuesta :  '. $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Propuestas de Movimientos de Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movimiento-cuadro-view">
    <div>
        
     <hr>
     
   
    <?php
        if($model->aprobada == 1)
        {
         echo ('   
                <h4 class="float-right" align="right">
                    Estado de la Propuesta : Aprobada ');
                }
        if($model->aprobada == 2)
        {
           echo Html::a(Yii::t('app', 'Actualizar y reenviar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary',
               'data' => [
                'confirm' => Yii::t('app', 'Esta seguro que desea actualizar la propuesta de movimiento y volverla a enviar'),
                'method' => 'post',
            ],]);
      
            echo('
            
                <h4 class="pull-right" align="right">
                    Estado de la Propuesta : Rechazada ');
               }
        if($model->status == 1)
        {
         echo ('   
                <h4 class="pull-right" align="right">
                    Estado de la Propuesta : Pendiente ');
              }
        ?>
    
     </h4>  
    
   
     
    <?php if($model->status == 1)
        {?>
   
    
    <p>
        
        <?= Html::a(Yii::t('app', 'Aprobar'), ['aprobar', 'id' => $model->id], ['class' => 'btn btn-success']);?>
        
       <?=  Html::a(Yii::t('app', 'Rechazar'), ['denegar', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Esta seguro de querer rechazar esta propuesta?'),
                'method' => 'post',
            ],
        ]);?>
        <?= Html::a(Yii::t('app', 'Volver'), ['index', ], ['class' => 'btn btn-primary']);?>
    </p>
    
    
 
        <?php }?>
   <hr>
    </div>
              
   <div>
      
      <?php echo DetailView::widget([
    'model'=>$modelSustituto,
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
                    'label'=>'<center style="color: #31708E"><h1 class="panel-title"><i class="glyphicon glyphicon-user"></i>CUADRO SUSTITUTO</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_INFO]
                    ],
                    [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Primer Apellido',
                                    'value'=>$modelSustituto->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$modelSustituto->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$modelSustituto->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$modelSustituto->foto.'"/>',
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
                                    'value'=>$modelSustituto->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$modelSustituto->personaCI0->sexo,
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$modelSustituto->color_piel,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$modelSustituto->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$modelSustituto->color_pelo,
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
                                    'value'=>$modelSustituto->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$modelSustituto->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($modelSustituto->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$modelSustituto->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$modelSustituto->ciudadania,
                                    'valueColOptions'=>['style'=>'width:15%'],
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
      <?php echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'MOVIMIENTO',
        'type'=>DetailView::TYPE_SUCCESS,
    ], 'attributes' => [
        'entidad', 
        [
                                    'attribute'=>'tipo_movimientoid',
                                    'value'=>$model->tipoMovimiento->tipo_movimiento,
                                    'displayOnly'=>true
                                    ],
        [
                                    'attribute'=>'idcargo_propuesto',
                                    'value'=>$model->cargoPropuesto->tipo,
                                    'displayOnly'=>true
                                    ],
        'causas_sustitucion',
        'sintesis_biografica',
        'resultados_controles',     
           
            'fundamentacion',
            'consideraciones',
            
            
         
               [
                                    'attribute'=>'idcargo_propuesto',
                                    'label'=>'Evaluación',
                                    'value'=>$model->evaluacionCuadro->concluciones,
                                    'displayOnly'=>true
                                    ],
        ],
           'enableEditMode'=>FALSE,
                   
    ]) ?>

</div>

    
    
           
         <div>
      
      <?php echo DetailView::widget([
    'model'=>$modelSustituido,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_DANGER,
    ],
    'attributes'=>[
                    [
                    'group'=> true,
                    'label'=>'<center style="color: #8B0000"><h1 class="panel-title"><i class="glyphicon glyphicon-user"></i> CUADRO SUSTITUIDO</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_DANGER]
                    ],
                    [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Primer Apellido',
                                    'value'=>$modelSustituido->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$modelSustituido->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$modelSustituido->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$modelSustituido->foto.'"/>',
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
                                    'value'=>$modelSustituido->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$modelSustituido->personaCI0->sexo,
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$modelSustituido->color_piel,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$modelSustituido->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$modelSustituido->color_pelo,
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
                                    'value'=>$modelSustituido->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$modelSustituido->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($modelSustituido->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$modelSustituido->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$modelSustituido->ciudadania,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],    
                                    ]
                      ],
           
                    ],
           'enableEditMode'=>FALSE,
                   
                   
]);
?> 
         </div>    
 
</div>         