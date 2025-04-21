<?php

use frontend\models\Cuadro;
use frontend\models\ReservaCuadro;
use frontend\models\TipoSelReserva;
use kartik\detail\DetailView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservaCuadro */
/* @var $form kartik\form\ActiveForm; */
?>

<div class="reserva-cuadro-form">

    <?php $form = ActiveForm::begin(); ?>


    
    <div>
      
      <?php echo DetailView::widget([
    'model'=>$cuadro,
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
                    'label'=>'<center style="color: #3c763d"><h1 class="panel-title"><i class="glyphicon glyphicon-user"></i> INFORMACIóN DEL CUADRO</h1></center>',
                    'rowOptions'=>['class'=>DetailView::TYPE_SUCCESS]
                    ],
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
                                    'valueColOptions'=>['style'=>'width:100px'],
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
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->calle,
                                         'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Número',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->numero,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Edificio',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->edif,
                                     // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Apto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->apto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                        ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Piso.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->piso,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre calle uno',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->entre_calle_uno,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre Calle Dos',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->entre_calle_dos,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Reparto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->Reparto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                            ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Municipio',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->municipio->municipio,
                                     'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Provincia',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($cuadro->id)->direcciones->provincia->provincia,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'telefono',
                                    'label'=>'Teléfono',
                                    'value'=>$cuadro->telefono,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'email',
                                    'label'=>'Email',
                                    'value'=>$cuadro->email,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                       
                            
                            
                            
                                   
                      ],
                   ],
                  
                    

      
                 
                    ],
              'enableEditMode'=>FALSE,                   
                   
]);
?>   
        
    </div>
    
    <?= $form->field($model, 'reservaid')->widget(Select2::className(),[
        'data'=>ArrayHelper::map(Cuadro::find()->andwhere(['status'=>1,'reserva_cuadro'=>1])->andWhere(['NOT',['id'=>$cuadro->id]])->andWhere(['not in','id',ReservaCuadro::find()->select('reservaid')->andWhere(['cuadroid'=>$cuadro->id])])->asArray()->all(), 'id','personaCI'),
        'pluginOptions'=>['placeholder'=>'Selecione la reserva..'],
                   
    ]) ?>

    <?= $form->field($model, 'tipo_sel_reservaid')->widget(Select2::className(),[
        'data'=>ArrayHelper::map(TipoSelReserva::find()->where(['status'=>1])->asArray()->all(), 'id','tipo'),
        'pluginOptions'=>['placeholder'=>'Selecione el tipo de Reserva..'],
                   
    ]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
