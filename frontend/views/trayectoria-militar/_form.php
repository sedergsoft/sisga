<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaMilitar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-militar-form">

    <?php $form = ActiveForm::begin(); ?>
     
            <div class="row">
                <div class="col-sm-4">
                   
                    <?= $form->field($model, 'grado_militar')->textInput() ?>

                </div>
        
                
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'militanciaid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\Militancia::find()->asArray()->all(), 'id', 'tipo'),
     'options' => ['placeholder' => 'Organizaciones a las que pertenece...'],
]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'fecha_entrada')->widget(DatePicker::classname(), [
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
            </div>
            <div class="row">
                
                <div class="col-sm-4">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'fecha_baja')->widget(DatePicker::classname(), [
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
                <div class="col-sm-6">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'causa_baja')->textInput(['maxlength' => true]) ?>
                </div>
                
            </div>
                   
        
          
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
