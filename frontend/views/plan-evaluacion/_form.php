<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlanEvaluacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-evaluacion-form">

   
       <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            
    <?= $form->field($model, 'idevaluador')->widget(kartik\select2\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(\frontend\models\User::find()->where(['status'=>10,'rolid'=>7])->all(), 'id', 'username'),
         'options' => ['placeholder' => 'Selecione el evaluador...'],
    ]) ?>
        </div>
        <div class="col-lg-6">

    <?= $form->field($model, 'idcuadro')->widget(kartik\select2\Select2::className(),[
       // 'data'=> yii\helpers\ArrayHelper::map(\frontend\models\cuadro::find()->where('SELECT cuadro.id, plan_evaluacion.status, cuadro.personaCI FROM cuadro LEFT JOIN plan_evaluacion ON cuadro.id = plan_evaluacion.idcuadro WHERE cuadro.status = 1 AND plan_evaluacion.status=1 UNION SELECT cuadro.id, plan_evaluacion.status, cuadro.personaCI FROM cuadro LEFT JOIN plan_evaluacion ON cuadro.id = plan_evaluacion.idcuadro WHERE cuadro.status = 1 AND plan_evaluacion.status IS NULL')->andWhere(['status'=>1])->all(), 'id', 'personaCI'),
        'data'=> yii\helpers\ArrayHelper::map(\frontend\models\cuadro::findBySql('SELECT cuadro.id, plan_evaluacion.status, cuadro.personaCI FROM cuadro LEFT JOIN plan_evaluacion ON cuadro.id = plan_evaluacion.idcuadro WHERE cuadro.status = 1 AND plan_evaluacion.status=1 AND plan_evaluacion.ultima=1  UNION SELECT cuadro.id, plan_evaluacion.status, cuadro.personaCI FROM cuadro LEFT JOIN plan_evaluacion ON cuadro.id = plan_evaluacion.idcuadro WHERE cuadro.status = 1 AND plan_evaluacion.status IS NULL')->all(), 'id', 'personaCI'),
         'options' => ['placeholder' => 'Selecione el cuadro a evaluar...'],
    ]) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-6">
            
    <?= $form->field($model, 'fecha')->widget(\kartik\date\DatePicker::className(),[
         'options' => [
          'value' => date('Y-m-d')],
    
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
        
    ]) ?>
        </div>
         <div class="col-lg-6">
 
    <?= $form->field($model, 'observaciones')->textInput() ?>
     </div>
         </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Crear'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
