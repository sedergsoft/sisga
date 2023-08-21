<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model frontend\models\Criteriomedida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criteriomedida-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orden')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>150,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?>

    <?= $form->field($model, 'Descripcion')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'UM')->textInput(['maxlength' => true]) /*?>

    <?= $form->field($model, 'status')->textInput()*/ ?>

    <?= $form->field($model, 'Objetivoid')->widget(\kartik\select2\Select2::className(),[
        'data'=> \yii\helpers\ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'descripcion'),
        'options' => ['placeholder'=>'Selecione el Objetivo al que tributa...']
    ]) ?>

    <?= $form->field($model, 'direccionid')->widget(\kartik\select2\Select2::className(),[
        'data'=> \yii\helpers\ArrayHelper::map(\frontend\models\Direccion::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'nombre'),
        'options' => ['placeholder'=>'Selecione la direccion responsable...']
    ])?>
    <div class=row">

        <div class="col-lg-3"><?= $form->field($modelTope, 'Itrimestre')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>150,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?></div> 
        <div class="col-lg-3"><?= $form->field($modelTope, 'IItrimestre')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>150,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])?></div> 
        <div class="col-lg-3"><?= $form->field($modelTope, 'IIItrimestre')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>150,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?></div> 
        <div class="col-lg-3"><?= $form->field($modelTope, 'IVtrimestre')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>150,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?></div> 
    
    
    
   </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
