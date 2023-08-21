<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $modelCuadro frontend\models\MovimientoCuadro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-cuadro-form">

    <div>
      
      <?php echo DetailView::widget([
    'model'=>$modelCuadro,
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
                                    'value'=>$modelCuadro->personaCI0->primer_apellido,
                                    'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Segundo Apellido',
                                    'value'=>$modelCuadro->personaCI0->segundo_apellido,
                                    'valueColOptions'=>['style'=>'width:2%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Nombre(s)',
                                    'value'=>$modelCuadro->personaCI0->Nombre,
                                    'valueColOptions'=>['style'=>'width:40%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Foto',
                                    'format'=>'raw',    
                                    'value'=> '<img class="etalage_thumb_image" src="'. Yii::$app->request->baseUrl.'/'.$modelCuadro->foto.'"/>',
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
                                    'value'=>$modelCuadro->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'personaCI',
                                    'label'=>'Sexo',
                                    'value'=>$modelCuadro->personaCI0->sexo,
                                   // 'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_piel',
                                    'label'=>'Color de Piel',
                                    'value'=>$modelCuadro->color_piel,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_ojos',
                                    'label'=>'Color de Ojos',
                                    'value'=>$modelCuadro->color_ojos,
                                    //'valueColOptions'=>['style'=>'width:20%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'color_pelo',
                                    'label'=>'Color de Pelo',
                                    'value'=>$modelCuadro->color_pelo,
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
                                    'value'=>$modelCuadro->estatura,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'peso',
                                    'label'=>'Peso',
                                    'value'=>$modelCuadro->peso,
                                    'valueColOptions'=>['style'=>'width:5%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'Lugar_nacimiento',
                                    'label'=>'Lugar De nacimiento',
                                    'value'=> frontend\models\Municipio::findOne($modelCuadro->Lugar_nacimiento)->municipio,
                                    'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'provinciaid',
                                    'label'=>'Prov. de nacimiento',
                                    'value'=>$modelCuadro->provincia->provincia,
                                    'valueColOptions'=>['style'=>'width:25%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'ciudadania',
                                    'label'=>'Ciudadania',
                                    //'value'=>$modelCuadro->ciudadania,
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
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->calle,
                                         'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Número',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->numero,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Edificio',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->edif,
                                     // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Apto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->apto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                        ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Piso.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->piso,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre calle uno',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->entre_calle_uno,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Entre Calle Dos',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->entre_calle_dos,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                             [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Reparto.',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->Reparto,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            
                            
                            
                                   
                      ],
                            ],[
                        'columns'=>[
                                    [
                                   'attribute'=>'lugaresResidencias',
                                    'label'=>'Municipio',
                                   'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->municipio->municipio,
                                     'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                            
                                    [
                                    'attribute'=>'lugaresResidencias',
                                    'label'=>'Provincia',
                                    'value'=>\frontend\controllers\CuadroController::ObtenerLugares($modelCuadro->id)->direcciones->provincia->provincia,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'telefono',
                                    'label'=>'Teléfono',
                                    'value'=>$modelCuadro->telefono,
                                    // 'valueColOptions'=>['style'=>'width:10%'],
                                   'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                                    [
                                    'attribute'=>'email',
                                    'label'=>'Email',
                                    'value'=>$modelCuadro->email,
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
    
    <hr>
    
    <h3 class="center"> Movimiento </h3>
    
    <hr>
    
    
    
    
    
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        
        <div class="col-sm-4">

            <?= $form->field($model, 'entidad')->textInput(['maxlength' => true]) ?>
    
        </div>
        <div class="col-sm-4">
           
            <?= $form->field($model, 'tipo_movimientoid')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(frontend\models\TipoMovimiento::find()->asArray()->all(), 'id', 'tipo_movimiento'),
                         'options' => ['placeholder' => 'Seleccione el tipo de movimiento'],
                    ]);?>
        </div>
        <div class="col-sm-4">
       
            <?= $form->field($model, 'cuadro_sustituido')->widget(Select2::className(),[
                    'data'=> ArrayHelper::map(frontend\models\Cuadro::find()->asArray()->where(['not', ['id' => $modelCuadro->id]])->all(), 'id', 'personaCI'),
                    'options'=>['placeholder'=>'Selecione el Cuadro a Sustituir'],
            ]);?>
               
        </div>
    </div>
    <div class="row">
      
        <div class="col-lg-4">
                   
            <?= $form->field($model, 'idcargo_propuesto')->widget(Select2::className(),[
                    'data'=> ArrayHelper::map(frontend\models\CargosDireccion::find()->where(['status'=>1])->asArray()->all(), 'id','tipo'),
                    'options'=>['placeholder'=>'Selecione el cargo a ocupar'],
            ]);?>
               
        </div>
    
        <div class="col-lg-4">
            <?= $form->field($model, 'causas_sustitucion')->textInput() ?>
        </div>
    </div>
   
    <div class="row">
        <div class="col-lg-12">
            
        <?= $form->field($model, 'sintesis_biografica')->textarea([
            'maxlength' => true,
            'rows'=>'7',
            ]) ?>
        </div>
    
    </div>
   
    <div class="row">
        <div class="col-lg-12">
            
        <?= $form->field($model, 'evaluacion_cuadroid')->widget(Select2::className(),[
                    'data'=> ArrayHelper::map(frontend\models\EvaluacionCuadro::find()->where(['ultima'=>1,'cuadroid'=>$modelCuadro->id])->asArray()->all(), 'id','complemento_textual'),
                    'options'=>['placeholder'=>'Selecione la evaluación'],
            ]);?>
        </div>
    
    </div>
    <div class="row">
        <div class="col-lg-12">
          


        <?= $form->field($model, 'resultados_controles')->textarea([
            'maxlength' => true,
            'rows'=>'7',
            ]) ?>
        </div>
    
    </div>
     <div class="row">
        <div class="col-lg-12">
            
        <?= $form->field($model, 'fundamentacion')->textarea([
            'maxlength' => true,
            'rows'=>'7',
            ]) ?>
        </div>
    
    </div>
     <div class="row">
        <div class="col-lg-12">
            
        <?= $form->field($model, 'consideraciones')->textarea([
            'maxlength' => true,
            'rows'=>'7',
            ]) ?>
        </div>
    
    </div>

        
     
        
      
        

       </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Proponer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
