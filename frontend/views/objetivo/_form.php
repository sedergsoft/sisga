<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\touchspin\TouchSpin;


/* @var $this yii\web\View */
/* @var $model frontend\models\Objetivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetivo-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'orden')->widget(TouchSpin::className(),[
          
             'options' =>[
                            //'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>60,
                                    'step'=>1,
                                   // 'decimals'=>2,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]);?>
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6])/* ?>

    <?= $form->field($model, 'fechaAct')->textInput()*/ ?>

    <?= $form->field($model, 'responsable')->widget(kartik\select2\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])-> all(), 'id', 'nombre'),
        'pluginOptions'=>['placeholder'=>'Selecione la direcion encargada..'],
    ]) /*?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'fechaDesac')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
