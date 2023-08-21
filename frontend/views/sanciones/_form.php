<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sanciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sanciones-form">
    <?php $form = ActiveForm::begin(); ?>

     

<div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($model,"tipo")->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoSancion::find()->asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de sanción...'],
                                                                    ]);

                                                                        ?> 
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"sansion")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"motivo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Fecha',
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
