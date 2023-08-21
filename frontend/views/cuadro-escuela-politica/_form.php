<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroEscuelaPolitica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuadro-escuela-politica-form">

    <?php $form = ActiveForm::begin(); ?>

      <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($model,"escuela_politicaid")->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\EscuelaPolitica::find()->asArray()->all(), 'id', 'escuela'),
     'options' => ['placeholder' => 'Seleccione la escuela política...'],
])?> 
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model,"curso")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model,"fecha")->widget(DatePicker::classname(), [
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
                            
                        
                            
                        </div><!-- .row -->
                     

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
