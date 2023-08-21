<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaEstudiantilCentroEstudios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-estudiantil-centro-estudios-form">

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
                             
                                  <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($modelCentroEstudios,"centro")->textInput()?>
                                        </div>

                                    <div class="col-lg-3">  
                                        <?=$form->field($modelCentroEstudios,"provinciaid")->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                                                                         'options' => ['placeholder' => 'Seleccione el provincia de nacimiento...'],
                                                                    ]);

                                                                        ?> 
                                    </div>

                                   
                                    <div class="col-lg-3" >           

                                            <?= $form->field($modelCentroEstudios,"municipioid")->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Select ...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['centroestudios-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>

                                    </div>

                               </div> 
                                 





    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
