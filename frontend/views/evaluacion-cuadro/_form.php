<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;
use yii\bootstrap\Alert;
use kartik\date\DatePicker;
use kartik\touchspin\TouchSpin;
use kartik\builder\TabularForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-cuadro-form">



    <?php $form = ActiveForm::begin(); ?>
    

<div class="row">
        
    <div class="col-sm-3">
         <?= $form->field($model, 'entidad')->textInput(['maxlength' => true]) ?>
       
    </div>
    <div class="col-sm-3">
             <?= $form->field($model, 'organismoidorganismo')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\Organismo::find()-> asArray()->all(), 'idorganismo', 'organismo'),
                                                                         'options' => ['placeholder' => 'Seleccione el Organismo'],
                                                                    ]); ?>

    </div>
    
    
    <div class="col-sm-3">
            
            <?= $form->field($modelPeriodoEvaluado,"desde")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
             </div>
        
        <div class="col-sm-3">
            
            <?= $form->field($modelPeriodoEvaluado,"hasta")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
             </div>
        
    </div>
    
   
    
    <div>
        
        
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
                                    'label'=>'Numero de Idenditad',
                                    'value'=>$cuadro->personaCI0->CI,
                                    //'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                                                        
                                ],
                        ],
                        [
                     'columns'=>[
                         [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Nivel Escolaridad',
                                    'value'=>$cuadro->preparacionIntelectual->nivelEscolaridad->tipo,
                                   'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                            [
                                    'attribute'=>'preparacion_intelectualid',
                                    'label'=>'Especialidad',
                                    'value'=>$cuadro->preparacionIntelectual->Especialidad,
                                   // 'valueColOptions'=>['style'=>'width:10%'],
                                    'displayOnly'=>true
                                    ],
                         [
                                    'attribute'=>'cargoid',
                                    'label'=>'Cargo',
                                    'value'=>$cuadro->cargo->cargo,
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                         
                         [
                                    'attribute'=>'cargoid',
                                    'label'=>'Reserva de cuadro',
                                    'value'=>$cuadro->reserva_cuadro == 1 ? 'Si' :'No',
                                    'valueColOptions'=>['style'=>'width:15%'],
                                    'displayOnly'=>true
                                    ],
                         
                         
                         
                         /*
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
                                  */  
                                ]
                     
                        
                      ],
                    
         
                    ],
       'enableEditMode'=>FALSE,
                                
]);
?>   
        
    </div>
    
        
    </div>
    
    <div class="row"> 
        <div class="col-lg-3">
            <?= $form->field($modelExperiencia, 'años_cargo_actual')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>50,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?>

        </div>
    
        <div class="col-lg-3">
            <?= $form->field($modelExperiencia, 'meses_cargo_actual')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>11,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?>

        </div>
    
        <div class="col-lg-3">
            <?= $form->field($modelExperiencia, 'años_cuadro')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>50,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?>

        </div>
    
        <div class="col-lg-3">
            <?= $form->field($modelExperiencia, 'meses_cuadro')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>11,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?>

        </div>
    
    </div>
    
    
    <div>
        
       <?php echo TabularForm::widget([
    'bsVersion' => '3.x',
    'form' => $form,
    'dataProvider' => $dataProviderIndicadores,
    'actionColumn'=>false,
           'checkboxColumn'=>false,
    'attributes' => [
        'descripcion' => ['type' => TabularForm::INPUT_STATIC],
        'id' => [
            'type' => TabularForm::INPUT_TEXT, 
            //'widgetClass' => \kartik\widgets\ColorInput::classname()
            'columnOptions'=>['hidden'=>true]
        ],
        'active' => [
            'label'=> 'Evaluación',
            'type' => TabularForm::INPUT_DROPDOWN_LIST, 
            'items'=>ArrayHelper::map(frontend\models\Calificacion::find()->orderBy('id')->asArray()->all(), 'id', 'calificacion')
        ],
        
/*        'buy_amount' => [
            'type' => TabularForm::INPUT_TEXT, 
            'options'=>['class'=>'form-control text-right'], 
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT]
        ],
        'sell_amount' => [
            'type' => TabularForm::INPUT_STATIC, 
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT]
        ],*/
    ],
           
    'gridSettings' => [
        'floatHeader' => true,
        'panel' => [
            'heading' => '<i class="fas fa-book"></i> INDICADORES ',
            'type' => GridView::TYPE_INFO,

        ]
    ]     
]); 
        
      ?>  
    </div>
    
    
   
    <?= $form->field($model, 'complemento_textual')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'señalamientos')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'recomendaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'concluciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resultado_evaluacion')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\Calificacion::find()->where(['not',['id'=>'5']])-> asArray()->all(), 'id', 'calificacion'),
                                                                         'options' => ['placeholder' => 'Seleccione el Evaluacion General'],
                                                                    ]); ?>
    <div class=" row ">
        <div class="col-sm-6">
            
    <?= $form->field($modelProyeccion, 'tipo_proyeccionid')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoProyeccion::find()-> asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de proyección'],
                                                                    ]); ?>
        </div>
        <div class="col-sm-6">

    <?= $form->field($modelProyeccion, 'tipo_movimientoid')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoMovimiento::find()-> asArray()->all(), 'id', 'tipo_movimiento'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de movimiento'],
                                                                    ]); ?>
   </div>
    </div>

    <div class=" row ">
        <div class="col-sm-6">
            
    <?= $form->field($modelReserva, 'tipo')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoReserva::find()-> asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de Reserva'],
                                                                    ]); ?>
        </div>
        <div class="col-sm-6">

      <?= $form->field($modelReserva, 'observaciones')->textarea(['row' => 3]) ?>
 </div>
    </div>
    
  <?= $form->field($model, 'superacion')->textarea(['row' => 5]) ?>
    <div class="row"> 
        <div class="col-lg-6">
       <?= $form->field($modelConfeccionado, 'Nombre')->textInput(['placeholder'=>'Nombre y Apellidos de la persona que evalua','maxlength' => true])->label('Confecionado por') ?>
        </div>
        <div class="col-lg-6">
    <?= $form->field($modelConfeccionado, 'idcargo')->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\CargosDireccion::find()-> asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Cargo de la persona que evalua'],
                                                                    ]); ?>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            
        <?= $form->field($modelOpinionEvaluado, 'opinion')->widget(Select2::classname(), [
                                                                      'data'=> [0=>'De Acuerdo',
                                                                               1=>'En desacuerdo',                              
                              

                         ],
   'options' => ['placeholder' => 'Seleccione la opinión'],
                                                                    ]); ?>
    
        </div>
        <div class="col-sm-3">
    <?= $form->field($modelOpinionEvaluado, 'reclamacion')->radioList([0=>'No', 1=>'Si']) ?>
            
        </div>

        <div class="col-sm-6">
    <?= $form->field($modelOpinionEvaluado, 'reclamacion_desc')->textarea(['row' => 6]) ?>

        </div>
        
    
    
    </div>
        


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
