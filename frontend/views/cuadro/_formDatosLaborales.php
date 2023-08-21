<?php
use kartik\form\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\Alert;
?>
 <?php $form = ActiveForm::begin(['id' => 'dynamic-form'],['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="cuadro-familiar-form">
<?php if(Yii::$app->session->hasFlash("error_validacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'Los datos correspondientes a la  Trayectoria como directivo están incorrectos o incompletos.']);
        ?>
    <?php endif; ?>


<div class="row">
    
    
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelCentroTrab, 'centro')?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($modelCentroTrab, 'idorganismo')->widget(Select2::className(),[
                'data'=> ArrayHelper::map( frontend\models\Organismo::find()->asArray()->andFilterWhere(['Status'=>1])->all(), 'idorganismo', 'organismo'),
                 'pluginOptions'=>['placeholder'=>'Selecione el Organismo..'],
            ])  ?>
        </div>        
    </div>
    
    <div class="row">
        <div class="col-lg-4" >
            <?= $form->field($modelDirCTA, 'calle')->textInput() ?>
        </div>
        <div class="col-lg-2" >
            <?= $form->field($modelDirCTA, 'numero')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'entre_calle_uno')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'entre_calle_dos')->textInput() ?>
        </div>
    </div>
   
    
    <div class="row">
        <div class="col-lg-3" >
            <?= $form->field($modelCentroTrab, 'telefono')->widget(MaskedInput::className()
                    ,[
             'mask'=>'999-999-9999'   
            ]) ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelCentroTrab, 'email')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'provinciaid')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                    'pluginOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                ]) ?> 
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'municipioid')->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Seleccione el Municipio...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['direcciones-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3" >
            <?= $form->field($modelCargoActual, 'cargo')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($model, 'fecha_inicio_cargo')->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelCargoActual, 'salario')->textInput() ?>
        </div>
    </div>
 </div>
    <div class="row">
        <hr>
               
        <h3 align = "center"><?= $form->field($modelDirectivo, 'active')->checkbox(['onclick'=>'mostrar(".directivo")' ]) ?>
         </h3>
        <hr>
        <div class="row directivo" style="display: none">   
        <div class="col-lg-4" >
            <?= $form->field($modelDirectivo, 'años_cargo')->textInput() ?>
        </div>
        <div class="col-lg-6" >
            <?= $form->field($modelDirectivo, 'cargos_direccionid')->widget(Select2::className(),[
              'data'=>ArrayHelper::map(frontend\models\CargosDireccion::find()->asArray()->all(), 'id', 'tipo'),  
                
            ]) ?>
        </div>
            
        </div>
        
</div>
    
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>
            </div>    
<script>
    function mostrar(a)
{
$(document).ready(function()
{
      
    // alert(a);
   $(a).toggle();
     //ObtenerClic2(a);
   
}); 
}
    </script>