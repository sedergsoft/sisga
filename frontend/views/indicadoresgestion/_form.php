<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model frontend\models\Indicadoresgestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indicadoresgestion-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"  >  
        
        <div class="col-lg-3">
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
         ]) ?>

    </div>
        
        <div class="col-lg-4">     
    <?= $form->field($model, 'fecha_chequeo')->widget(\kartik\date\DatePicker::className(),[
      
                                      'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'format' => 'yyyy-mm-dd',
                                                    'todayHighlight' => true,
                                                    'todayBtn' => true,
                                                    ],
                    
                                    
        
        
    ]) ?>
</div>
        <div class="col-lg-3">    
    <?= $form->field($model, 'UM')->textInput(['maxlength' => true]) ?>
</div>
        
        <div class="col-lg-10">       
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 3]) ?>
</div>
          <div class="col-lg-10">       
    <?= $form->field($model, 'objetivoid')->widget(\kartik\select2\Select2::className(),[
        'data'=> \yii\helpers\ArrayHelper::map(\frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->all(), 'id', 'descripcion'),
        'options' => ['placeholder'=>'Selecione el Objetivo al que tributa...']
    ]) ?>
</div>
        <div class="col-lg-4">
    <?= $form->field($model, 'direccionid')->widget(kartik\select2\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(frontend\models\Direccion::find()->andFilterWhere(['status'=>1])->all(), 'id', 'nombre'),
        'pluginOptions'=>['placeholder'=>'Selecione la direcion encargada..'],
    ])?>
</div>

   
    <div class="col-lg-3"> 
 <?= $form->field($modeltope, 'valor')->widget(TouchSpin::className(),[
          
             'options' =>[
                            //'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>50000000,
                                    'step'=>0.0001,
                                    'decimals'=>4,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?>
</div>
    <div class="col-lg-3">
       <?= $form->field($modeltope, 'idsentido')->widget(\kartik\select2\Select2::className(),[
           'data'=> \yii\helpers\ArrayHelper::map(frontend\models\Sentido::find()->all(), 'id', 'sentido'),
            'pluginOptions'=>['placeholder'=>'Selecione el sentido de su valor..'],
           
       ]) ?>
        </div>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
