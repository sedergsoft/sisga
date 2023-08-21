<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaLaboral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-laboral-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <div class="row">
                            <div class="col-sm-8">
                                <?= $form->field($model, "centro_trabajo")->textInput(['maxlength' => true])->label('Centro Laboral') ?>
                       
                            </div>
                        
    
    <div class="col-sm-4">
                                <?= $form->field($model, "ocupacion")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class ="row ">
                        
                            <div class="col-sm-4">
                                <?= $form->field($model, "fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, "fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                       
                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($model, "motivo_cambio")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                        </div>  


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
