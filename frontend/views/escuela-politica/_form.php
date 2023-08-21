<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
 

/* @var $this yii\web\View */
/* @var $model frontend\models\EscuelaPolitica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="escuela-politica-form">

    <?php $form = ActiveForm::begin(); ?>
 
    <div class="row">
        
        <div class=" col-lg-6">
            
    <?= $form->field($model, 'escuela')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\EscuelaPolitica::find()->asArray()->all(), 'id', 'escuela'),
     'options' => ['placeholder' => 'Seleccione la escuela política...'],
])?>
        </div>

    </div>     
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
