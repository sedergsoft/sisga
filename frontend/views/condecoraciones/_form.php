<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Condecoraciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="condecoraciones-form">

    <?php $form = ActiveForm::begin(); ?>

       <div class="row">

                                        <div class="col-sm-8">
                                            <?= $form->field($model,"nombre")->textInput(['maxlength' => true]) ?>

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
                                       



                                    </div><!-- .row -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
