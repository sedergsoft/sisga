<?php

use kartik\alert\Alert;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\dialog\Dialog;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Familiar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiar-form">
<?php if(Yii::$app->session->hasFlash("existe")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           
           echo Alert::widget([
            'type' => Alert::TYPE_WARNING,
           'title' => '<strong> Nota:<br> </strong>',
           'titleOptions' => ['icon' => 'info-sign'],
           'body' => 'Los datos que intenta guardar ya se encuentran en el sistema. Puede ver consultar los datos existente en el sistema para comprobar que son los mismos o puede modificar los que trata de introducir.<br><br>' . '<button type="button" id="ver_existentes" class="btn btn-warning">Datos Existentes</button>'
        ]);
        echo Dialog::widget([
            'libName' => 'krajeeDialogCust1', // a custom lib name
            'options' => [  // customized BootstrapDialog options
                'size' => Dialog::SIZE_NORMAL, // large dialog text
                'type' => Dialog::TYPE_WARNING, // bootstrap contextual color
                'title' => 'Datos existes',
                'message' => 'Las datos que existen en el sistema coincidentes con los que acaba de introduccir son los siguentes: <br><strong>NI: </strong>'.$enc->CI.'<br><strong>Nombre: </strong>'.$enc->Nombre.'<br><strong>Primer Apellidos: </strong>'.$enc->primer_apellido.'<br><strong>Primer Segundo: </strong>'.$enc->segundo_apellido.'<br><strong>Sexo: </strong>'.$enc->sexo,
                'buttons' => [
                    [
                        'id' => 'cust-btn-1',
                        'label' => 'Editar mis datos',
                        'action' => new JsExpression("function(dialog) {
                            dialog.setTitle('Title 1');
                            dialog.setMessage('This is a custom message for button number 1');
                        }")
                    ],
                    [
                        'id' => 'usar_exist',
                        'label' => 'Usar datos existentes',
                      //  'type'=>'submit',
                       /// 'action' =>  Url::toRoute(['create'])
                        'action' => new JsExpression("function(dialog) {
                            dialog.setTitle('usando datos existentes');
                            dialog.setMessage('This is a custom message for button number 2');
                        }")
                    ],
                    // [
                    //     'id' => 'cust-btn-3',
                    //     'label' => 'Begin Loading',
                    //     'action' => new JsExpression("function(dialog) {
                    //         var $button = this; // 'this' here is a jQuery object wrapping the <button> DOM element.
                    //         dialog.setTitle('Loading...');
                    //         dialog.setMessage('Content loading. Wait...');
                    //         $button.disable();
                    //         $button.spin();
                    //         dialog.setClosable(false);
                    //     }")
                    // ],
                    // [
                    //     'id' => 'cust-btn-4',
                    //     'label' => 'End Loading',
                    //     'action' => new JsExpression("function(dialog) {
                    //         var $button = dialog.getButton('cust-btn-3'); // get loading button
                    //         $button.enable();
                    //         $button.stopSpin();
                    //         dialog.setTitle('Information');
                    //         dialog.setMessage('Loading Complete.');
                    //         dialog.setClosable(true);
                    //     }")
                    // ],
                ]
            ]
        ]);
        ?>
    <?php endif; ?>

    <?php

 
// Custom dialog 1

 
// Custom dialog 2
// echo Dialog::widget([
//     'libName' => 'krajeeDialogCust2', // a custom lib name
//     'options' => [  // customized BootstrapDialog options
//         'size' => Dialog::SIZE_WIDE, // large dialog text
//         'type' => Dialog::TYPE_INFO, // bootstrap contextual color
//         'title' => 'My Dialog',
//         'nl2br' => false,
//         'buttons' => [
//             [
//                 'id' => 'cust-submit-btn',
//                 'label' => 'Submit',
//                 'cssClass' => 'btn-primary',
//                 'hotkey' => 'S',
//                 'action' => new JsExpression("function(dialog) {
//                     if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, true) === false) {
//                         return false;
//                     }
 
//                     return dialog.close();
//                 }")
//             ],
//             [
//                 'id' => 'cust-cancel-btn',
//                 'label' => 'Cancel',
//                 'cssClass' => 'btn-outline-secondary',
//                 'hotkey' => 'C',
//                 'action' => new JsExpression("function(dialog) {
//                     if (typeof dialog.getData('callback') === 'function' && dialog.getData('callback').call(this, false) === false) {
//                         return false;
//                     }
 
//                     return dialog.close();
//                 }")
//             ],
//         ]
//     ]
// ]);
 
// button markups for launching the custom krajee dialog box
//echo '<button type="button" id="btn-custom-1" class="btn btn-success">Custom Dialog 1</button><hr><button type="button" id="btn-custom-2" class="btn btn-info">Custom Dialog 2</button>';
 
// javascript for triggering the dialogs
$js = <<< JS
$("#ver_existentes").on("click", function() {
    krajeeDialogCust1.dialog(
        //"Las datos que existen en el sistema coincidentes con los que acaba de introduccir son los siguentes: <br>",
         'Las datos que existen en el sistema coincidentes con los que acaba de introduccir son los siguentes: <br><strong>NI: </strong>.$enc->CI.<br><strong>Nombre: </strong>.$enc->Nombre.<br><strong>Primer Apellidos: </strong>.$enc->primer_apellido.<br><strong>Primer Segundo: </strong>.$enc->segundo_apellido.<br>',
        function(result) {
            // do something
        }
    );
});
 
$("#usar_exist").on("click", function() {
    krajeeDialogCust2.dialog(
        $('#kv-test-msg').val(), // markup stored in a hidden textarea
        function(result) {
            // do something
        }
    );
});
JS;
 
// register your javascript
$this->registerJs($js);
?>
  

    <?php $form = ActiveForm::begin(); ?>

    
     <div class="row" style="margin-left: 0px;">

         
         
         
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                        </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3" >
                                <?= $form->field($modelPersonaFamiliar,"sexo")->widget(Select2::className(), [
                                                                                                                 'data'=> [1=>'M',
                                                                                                                           2=>'F',


                                                                                                                     ],
                                                                                                                'options' => ['placeholder' => 'Sexo'],
                   
                ]) ?> 
                       
                            </div>
         

                                        <div class="col-sm-3">
                                            <?= $form->field($model,"tipo_familiar")->widget(Select2::className(),[
                                                'data' => ArrayHelper::map(frontend\models\TipoFamiliar::find()->asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de Familiar...'],
                                                                    ]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"centro_estudio_trabajo")->textInput(['maxlength' => true]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"integracions[]")->textInput(['maxlength' => true]) ?>

                                        </div>
                                  </div>
                                  <div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"conviviente")->checkbox([$checked = false, ]) ?>

                                        </div>
                                     
                                     </div>
                             
                                       
                                </div>
                         

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
