<?php

use frontend\models\Entidad;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model frontend\models\Plantilla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plantilla-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class=" row">
         <div class="col-lg-12">
            
        <?= $form->field($model, 'empresaid')->widget(Select2::className(), [
                     'data'=> Yii::$app->user->identity->rolid == "2"?ArrayHelper::map(Entidad::find()->asArray()->andFilterWhere(['not', ['id' => ArrayHelper::map(\frontend\models\Plantilla::find()->all(), 'id','empresaid')]])->all(), 'id', 'nombre'):ArrayHelper::map(Entidad::find()->asArray()->andFilterWhere(['id' => Yii::$app->user->identity->direccionid ])->all(), 'id', 'nombre'),

                    'pluginOptions'=>['placeholder'=>'Selecione la Empresa..'],
                   
                ]) ?> 

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            
    <?= $form->field($model, 'cant_trabajadores')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])
          ?> 
        </div>
        <div class="col-lg-3">
            
    <?= $form->field($model, 'cant_cuadros')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ])?>
        </div>

        <div class="col-lg-3">
      
    <?= $form->field($model, 'trabajadores_cubierta')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?>
</div>
        <div class="col-lg-3">
    <?= $form->field($model, 'cuadros_cubierta')->widget(TouchSpin::className(),[
          
             'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'No.',
                                    //'initval'=>1.00,
                                    'min'=>0,
                                    'max'=>2000,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         ]) ?>

</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
