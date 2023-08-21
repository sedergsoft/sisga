<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\LugaresResidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lugares-residencia-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($model,"fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que llego a esta residencia',
                                                                                                                        'label'=> 'Desde',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                                                                  
                                        </div>

                                        <div class="col-lg-6">
                                           <?= $form->field($model,"fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que abandono la esta residencia ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                        </div>
                   
                                </div>
    
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">

                                        <div class="col-lg-3">
                                            <?= $form->field($modelDireResidencia, "calle")->textInput()?>
                                        </div>

                                      <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "edif")->textInput()?>
                                        </div>
                                      <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "numero")->textInput()?>
                                        </div>
                                      

                                        <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "apto")->textInput()?>
                                        </div>


                                        <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "piso")->textInput()?>
                                        </div>

                                </div>
                                <div class="row">
                                   <div class="col-lg-4" >
                                        <?= $form->field($modelDireResidencia, "entre_calle_uno")->textInput() ?>
                                    </div>
                                    <div class="col-lg-4" >
                                        <?= $form->field($modelDireResidencia, "entre_calle_dos")->textInput() ?>
                                    </div>
                                    <div class="col-lg-3" >
                                        <?= $form->field($modelDireResidencia, "Reparto")->textInput() ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">  
                                        <?=$form->field($modelDireResidencia, "provinciaid")->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                                                                         'options' => ['placeholder' => 'Seleccione el provincia de nacimiento...'],
                                                                    ]);

                                                                        ?> 
                                    </div>

                                    <div class="col-lg-5" >           

                                                                                 
                                         <?= $form->field($modelDireResidencia,"municipioid")->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Seleccione el municipio de nacimiento...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['direcciones-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>

                                    </div>

                               </div> 
                                 
                        </div>
                      
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
