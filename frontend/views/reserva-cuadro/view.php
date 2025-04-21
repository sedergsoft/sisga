<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\ehlpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $cuadro frontend\models\ReservaCuadro */

$this->title = 'Reserva de Cuadro(NI - '.Html::encode(ucwords($model->cuadro->personaCI0->nombrecompleto())).' )';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserva de Cuadro'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserva de Cuadro(NI - '.$this->title), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reserva-cuadro-view">

<div>
      
      <?php echo DetailView::widget([
    'model'=>$cuadro=$model->cuadro,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_SUCCESS,
    ],
    'attributes'=>[
                   
                    [
                     'columns'=>[
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Primer Apellido',
                                    'value'=>$cuadro->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$cuadro->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$cuadro->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$cuadro->foto.'" style="width: 100px;"/>',
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
                                    'value'=>$cuadro->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$cuadro->personaCI0->sexo,
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$cuadro->color_piel,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$cuadro->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$cuadro->color_pelo,
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
                                    'value'=>$cuadro->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$cuadro->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($cuadro->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$cuadro->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$cuadro->ciudadania,
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
    'model'=>$reserva=$model->reserva,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>Html::encode(strtoupper($model->tipoSelReserva->tipo)),
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
                                    'value'=>$reserva->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$reserva->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$reserva->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$reserva->foto.'" style="width: 100px;"/>',
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
                                    'value'=>$reserva->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$reserva->personaCI0->sexo,
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$reserva->color_piel,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$reserva->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$reserva->color_pelo,
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
                                    'value'=>$reserva->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$reserva->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($reserva->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$reserva->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$reserva->ciudadania,
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
