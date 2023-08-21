<?php

use yii\helpers\Html;
//use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
     

        

            <?php foreach ($modelsCentroEstudios as $indexCentroEstudios => $modelCentroEstudios): ?>
                <div >
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelCentroEstudios->isNewRecord) {
                                echo Html::activeHiddenInput($modelCentroEstudios, "[{$indexTrayectoriaEst}][{$indexCentroEstudios}]id");
                            }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($modelCentroEstudios, "[{$indexTrayectoriaEst}][{$indexCentroEstudios}]centro")->textInput()?>
                                        </div>

                                    <div class="col-lg-3">  
                                        <?=$form->field($modelCentroEstudios, "[{$indexTrayectoriaEst}][{$indexCentroEstudios}]provinciaid")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                    'pluginOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                ]) ?> 

                                                                       
                                    </div>

                                    <div class="col-lg-3" >           

                                            <?= $form->field($modelCentroEstudios, "[{$indexTrayectoriaEst}][{$indexCentroEstudios}]municipioid")->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(frontend\models\Municipio::find()->asArray()->all(), 'id', 'municipio'),
                                                 'options' => ['placeholder' => 'Seleccione el municipio de nacimiento...'],
                                            ]);?>

                                    </div>

                               </div> 
                                 
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
         

         
   