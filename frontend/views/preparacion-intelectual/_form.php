<?php

use common\widgets\Alert;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preparacion-intelectual-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form'],['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="cuadro-familiar-form">
<?php if(Yii::$app->session->hasFlash("error_validacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>

<div class="row">
        
        <hr>
        <h3 align = "center"> Preparación Intelectual</h3>
        <hr>

        <div class="col-lg-3" >
                <?= $form->field($model, 'nivel_escolaridad')->widget(Select2::className(), [
                     'data'=> [0=>'9no grado',
                               1=>'Pre-universitario',
                               2=>'Universitario',
                              
                              

                         ],
                    'options' => ['placeholder' => 'Nivel escolar'],])
                   ?>
        </div>
        <div class="col-lg-3" >
                <?= $form->field($model, 'Especialidad')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3" >
                <?= $form->field($model, 'categoria_docente')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Profesor Auxialiar',
                               2=>'Profesor Titular',

                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su categoria docente..'],
                   
                ]) ?> 
        </div>
</div>
    <div class="row">
        <div class="col-lg-3" >
                <?= $form->field($model, 'grado_cientifico')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Licenciado',
                               2=>'Ingeniero',
                               3=>'Master',
                               4=>'Doctor',
                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione el grado cientifico..'],
                   
                ]) ?>
        </div>
    
        <div class="col-lg-3" >
                <?= $form->field($model, 'informatica')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Básico',
                               2=>'Medio',
                               3=>'Avanzado',
                               4=>'Profesional'
                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su nivel informático..'],
                   
                ]) ?>
        </div>
        <div class="col-lg-3">
        
            
            <?php    echo   $form->field($modelMiliatanciaPolitica, 'miitancia_politicid')->widget(Select2::className(), [
                                        'data'=>ArrayHelper::map(frontend\models\MiitanciaPolitic::find()->asArray()->all(), 'id', 'tipo'),
                        'options' => ['placeholder' => 'Seleccione la militancia...'],   'pluginOptions' => [
                                'allowClear' => true
                        ],
                        ]);?>
        
        </div>
   
    </div>

       
    
    
    <div>
            
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Actualizar'), ['class' => 'btn btn-primary']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>
             
    </div>
</div>
    
</div>
