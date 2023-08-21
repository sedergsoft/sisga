<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliaresExterior */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiares-exterior-form">

    
      <div >
       
       <?php echo DetailView::widget([
    'model'=>$familiar,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
           'panel'=>[
        'heading'=> 'FAMILIAR',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'personaCI0',
              'label' => 'Nombre ',
                 'value'=> $familiar->personaCI0->Nombre,
            ], 
            [
             'attribute' =>  'personaCI0',
              'label' => 'Primer Apellido ',
            'value'=> $familiar->personaCI0->primer_apellido,
           
                ],
            [
             'attribute' =>  'personaCI0',
              'label' => 'Segundo Apellido ',
                 'value'=> $familiar->personaCI0->segundo_apellido,
           
            ],
        
           [
             'attribute' =>  'personaCI0',
              'label' => 'Número de Identidad',
                'value'=> $familiar->personaCI0->CI,
           
            ],
           [
             'attribute' =>  'personaCI0',
              'label' => 'Sexo',
                'value'=> $familiar->personaCI0->sexo == 1? 'M':'F',
           
            ],
           [
             'attribute' =>  'tipoFamiliar',
              'label' => 'Parentesco',
                'value'=> $familiar->tipoFamiliar->tipo,
           
            ],
         
            
        ],
    'enableEditMode'=>FALSE,
   
    
]);
           
             


?>
        
        
    </div>
  
    
    
    
    <?php $form = ActiveForm::begin(); ?>

      
                        <div class="row">
                                
                            
                            <div class="col-sm-3">
                                <?= $form->field($model,"pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model,"nacionalidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                           
                                                    
                        </div><!-- .row -->
                   
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
