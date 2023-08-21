<?php

use yii\helpers\Html;
//use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

?>
     

        

            <?php foreach ($modelDirResidencia as $indexDirResidencia => $modelDireResidencia): ?>
                <div >
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelDireResidencia->isNewRecord) {
                                echo Html::activeHiddenInput($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]id");
                            }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]calle")->textInput(['name'=>'Direcciones[0][calle]'])?>
                                        </div>

                                        <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]numero")->textInput()?>
                                        </div>

                                        <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]apto")->textInput()?>
                                        </div>


                                        <div class="col-lg-2">
                                            <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]piso")->textInput()?>
                                        </div>

                                </div>
                                <div class="row">
                                   <div class="col-lg-4" >
                                        <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]entre_calle_uno")->textInput() ?>
                                    </div>
                                    <div class="col-lg-4" >
                                        <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]entre_calle_dos")->textInput() ?>
                                    </div>
                                    <div class="col-lg-3" >
                                        <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]Reparto")->textInput() ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">  
                                        <?=$form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]provinciaid")->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                                                 'options' => ['placeholder' => 'Seleccione el provincia de nacimiento...'],
                                            ]);?>
                                    </div>

                                    <div class="col-lg-5" >           

                                            <?= $form->field($modelDireResidencia, "[{$indexResidencia}][{$indexDirResidencia}]municipioid")->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Seleccione el Municipio de nacimiento...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['direcciones-0-0-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>

                                    </div>

                               </div> 
                                 
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
         

         
   