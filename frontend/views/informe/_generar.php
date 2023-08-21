<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\touchspin\TouchSpin;
?>
<div class="objetivo-form">

    <?php $form = ActiveForm::begin(['action'=>"/sisga/frontend/web/index.php/informe/generarinforme"]); ?>

  
    
    <?=  $form->field($model, 'tipo')->widget(Select2::classname(), 
          [
            'data' => [
                        0 => 'Indicadores de Gestión',
                        1 => 'Criterios de Medida',
                        2 => 'Ind. de Gestión y Criterios de Medida',
                        ],
            'options' => ['placeholder' => 'Seleciones el tipo de Informe'],
                            'pluginOptions' => [
                                                 'allowClear' => true
                                                ],
          ]);
    ?>

    <?= $form->field($model, 'anno')->widget(TouchSpin::classname(), 
          [
            'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'Año:',
                                    'initval'=>date('Y'),
                                    'min'=>1980,
                                    'max'=> date('Y'),
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
      ]); ?>

    <?= $form->field($model, 'mes')->widget(Select2::classname(), 
          [
            'data' =>  [
                1 => 'enero', 
                2 => 'febrero',
              3 => 'marzo', 
                4 => 'abril',
              5 => 'mayo', 
                6 => 'junio',
              7 => 'julio', 
                8 => 'agosto',
              9 => 'septiembre', 
                10 => 'octubre',
              11 => 'noviembre', 
                12 => 'diciembre',
              ],
    'options' => ['placeholder' => 'Seleciona el mes a generar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);?>

    <?= $form->field($model, 'organizacion')->widget(Select2::classname(), 
          [
            'data' => [
                        0 => 'Por Objetivos',
                        1 => 'Por Direciones',
                        //2 => 'Ind. de Gestión y Criterios de Medida',
                        ],
            'options' => ['placeholder' => 'Selecione la forma en que se organizara el informe'],
                            'pluginOptions' => [
                                                 'allowClear' => true
                                                ],
          ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Generar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

