<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstanciaExterior */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estancia-exterior-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($model,"tipo")->widget(Select2::className(),[
                                    'data'=>ArrayHelper::map(frontend\models\TipoExtancia::find()->asArray()->all(), 'id', 'tipo'),
                                            'pluginOptions'=>['placeholder'=>'Selecione tipo de Estancia..'],
                                        ]) ?>

                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model,"pais")->textInput(['maxlength' => true]) ?>
                       
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
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model,"cargo")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($model,"motivo")->textInput(['maxlength' => true]) ?>
                            </div>
                          
                            
                          
                            
                        </div><!-- .row -->
                      

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
